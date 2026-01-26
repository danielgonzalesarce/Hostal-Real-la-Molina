<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomStatusController extends Controller
{
    /**
     * Mostrar el dashboard de estado de habitaciones
     */
    public function index()
    {
        // Cargar todas las habitaciones con sus reservas confirmadas (pasadas, presentes y futuras)
        $rooms = Room::with(['reservations' => function($query) {
            $query->where('status', 'confirmed')
                  ->where('check_out', '>=', now()->subDays(1)); // Incluir reservas que terminaron ayer o después
        }])->orderBy('name')->get();
        
        // Refrescar las relaciones para asegurar que las fechas se carguen correctamente
        foreach ($rooms as $room) {
            $room->load(['reservations' => function($query) {
                $query->where('status', 'confirmed')
                      ->where('check_out', '>=', now()->subDays(1));
            }]);
        }

        // Calcular estados de todas las habitaciones
        $roomsWithStatus = collect();
        foreach ($rooms as $room) {
            $roomsWithStatus->push($this->calculateRoomStatus($room));
        }

        // Agrupar habitaciones por categoría (tipo de habitación)
        $roomsByCategory = $this->groupRoomsByCategory($rooms);
        
        // Calcular estadísticas
        $stats = $this->calculateStats($rooms);
        
        // Obtener notificaciones (habitaciones que salen hoy)
        $notifications = $this->getNotifications($rooms);
        
        return view('admin.room-status.index', compact('rooms', 'roomsByCategory', 'stats', 'notifications', 'roomsWithStatus'));
    }

    /**
     * Obtener estado de una habitación específica
     */
    public function getRoomStatus($roomId)
    {
        $room = Room::with(['reservations' => function($query) {
            $query->where('status', 'confirmed')
                  ->where('check_out', '>=', now())
                  ->orderBy('check_in', 'desc');
        }])->findOrFail($roomId);

        $status = $this->calculateRoomStatus($room);
        
        return response()->json($status);
    }

    /**
     * Cambiar estado de una habitación (libre, ocupada, mantenimiento)
     */
    public function updateStatus(Request $request, $roomId)
    {
        $request->validate([
            'status' => 'required|in:available,occupied,maintenance,auto',
            'maintenance_note' => 'nullable|string|max:500',
        ]);

        $room = Room::findOrFail($roomId);
        
        if ($request->status === 'maintenance') {
            $room->is_available = false;
            $room->manual_status = null; // Quitar estado manual si está en mantenimiento
            $room->maintenance_note = $request->maintenance_note;
            $room->maintenance_since = now();
        } elseif ($request->status === 'auto') {
            // Volver a modo automático (basado en reservas)
            $room->manual_status = null;
            $room->is_available = true;
            $room->maintenance_note = null;
            $room->maintenance_since = null;
        } else {
            // Estado manual: available u occupied
            $room->manual_status = $request->status;
            $room->is_available = ($request->status === 'available');
            $room->maintenance_note = null;
            $room->maintenance_since = null;
        }
        
        $room->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'room' => $this->calculateRoomStatus($room)
        ]);
    }

    /**
     * Obtener historial de ocupación de una habitación
     */
    public function getHistory($roomId)
    {
        $room = Room::findOrFail($roomId);
        
        $history = Reservation::where('room_id', $roomId)
            ->where('status', 'confirmed')
            ->orderBy('check_in', 'desc')
            ->with('user')
            ->paginate(20);

        return view('admin.room-status.history', compact('room', 'history'));
    }

    /**
     * Procesar check-in
     */
    public function checkIn($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        
        if ($reservation->status !== 'confirmed') {
            return response()->json([
                'success' => false,
                'message' => 'Solo se puede hacer check-in de reservas confirmadas'
            ], 400);
        }

        $reservation->checked_in_at = now();
        $reservation->save();

        return response()->json([
            'success' => true,
            'message' => 'Check-in realizado correctamente'
        ]);
    }

    /**
     * Procesar check-out
     */
    public function checkOut($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        
        if (!$reservation->checked_in_at) {
            return response()->json([
                'success' => false,
                'message' => 'No se puede hacer check-out sin check-in previo'
            ], 400);
        }

        $reservation->checked_out_at = now();
        $reservation->save();

        return response()->json([
            'success' => true,
            'message' => 'Check-out realizado correctamente'
        ]);
    }

    /**
     * Agrupar habitaciones por categoría (tipo de habitación)
     */
    private function groupRoomsByCategory($rooms)
    {
        $categories = [];
        
        // Mapeo de tipos de habitación a nombres legibles
        $categoryMap = [
            'matrimonial' => 'Matrimonial',
            'simple' => 'Simple',
            'doble' => 'Doble',
            'triple' => 'Triple',
            'cuadruple' => 'Cuádruple',
            'cuádruple' => 'Cuádruple',
        ];
        
        foreach ($rooms as $room) {
            $category = $categoryMap[$room->room_type] ?? ucfirst($room->room_type ?? 'Sin categoría');
            
            if (!isset($categories[$category])) {
                $categories[$category] = [];
            }
            
            $categories[$category][] = $this->calculateRoomStatus($room);
        }
        
        // Ordenar habitaciones por número dentro de cada categoría
        foreach ($categories as &$categoryRooms) {
            usort($categoryRooms, function($a, $b) {
                return $a['room_number'] <=> $b['room_number'];
            });
        }
        
        // Ordenar categorías en un orden específico
        $categoryOrder = ['Matrimonial', 'Doble', 'Triple', 'Cuádruple', 'Simple'];
        uksort($categories, function($a, $b) use ($categoryOrder) {
            $posA = array_search($a, $categoryOrder);
            $posB = array_search($b, $categoryOrder);
            $posA = $posA === false ? 999 : $posA;
            $posB = $posB === false ? 999 : $posB;
            return $posA <=> $posB;
        });
        
        return $categories;
    }

    /**
     * Calcular estado de una habitación
     */
    public function calculateRoomStatus($room)
    {
        $now = now();
        
        // Si hay estado manual, usarlo (tiene prioridad)
        if ($room->manual_status === 'occupied') {
            $status = 'occupied';
            $statusLabel = 'Ocupada (Manual)';
            $statusColor = 'red';
            $reservationInfo = null;
            $daysRemaining = null;
            $checkoutToday = false;
            
            // Extraer número de habitación
            preg_match('/(\d+)/', $room->name, $matches);
            $roomNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            
            return [
                'id' => $room->id,
                'name' => $room->name,
                'formatted_name' => $room->formatted_name,
                'room_number' => $roomNumber,
                'room_type' => $room->room_type,
                'capacity' => $room->capacity,
                'price_per_night' => $room->price_per_night,
                'status' => $status,
                'status_label' => $statusLabel,
                'status_color' => $statusColor,
                'is_available' => $room->is_available,
                'manual_status' => $room->manual_status,
                'reservation' => $reservationInfo,
                'days_remaining' => $daysRemaining,
                'checkout_today' => $checkoutToday,
                'maintenance_note' => $room->maintenance_note ?? null,
            ];
        }
        
        if ($room->manual_status === 'available') {
            $status = 'available';
            $statusLabel = 'Disponible (Manual)';
            $statusColor = 'green';
            $reservationInfo = null;
            $daysRemaining = null;
            $checkoutToday = false;
            
            // Extraer número de habitación
            preg_match('/(\d+)/', $room->name, $matches);
            $roomNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            
            return [
                'id' => $room->id,
                'name' => $room->name,
                'formatted_name' => $room->formatted_name,
                'room_number' => $roomNumber,
                'room_type' => $room->room_type,
                'capacity' => $room->capacity,
                'price_per_night' => $room->price_per_night,
                'status' => $status,
                'status_label' => $statusLabel,
                'status_color' => $statusColor,
                'is_available' => $room->is_available,
                'manual_status' => $room->manual_status,
                'reservation' => $reservationInfo,
                'days_remaining' => $daysRemaining,
                'checkout_today' => $checkoutToday,
                'maintenance_note' => $room->maintenance_note ?? null,
            ];
        }
        
        // Si no hay estado manual, calcular automáticamente basado en reservas
        // Buscar reservas confirmadas que se superpongan con la fecha actual
        $activeReservation = null;
        
        // Primero, buscar reservas activas (ya comenzaron)
        foreach ($room->reservations as $reservation) {
            if ($reservation->status !== 'confirmed') {
                continue;
            }
            
            // Asegurar que las fechas sean objetos Carbon
            $checkIn = $reservation->check_in instanceof Carbon 
                ? $reservation->check_in->copy()->startOfDay() 
                : Carbon::parse($reservation->check_in)->startOfDay();
            $checkOut = $reservation->check_out instanceof Carbon 
                ? $reservation->check_out->copy()->startOfDay() 
                : Carbon::parse($reservation->check_out)->startOfDay();
            $nowDate = $now->copy()->startOfDay();
            
            // La reserva está activa si: check_in <= now <= check_out
            if ($checkIn <= $nowDate && $checkOut >= $nowDate) {
                $activeReservation = $reservation;
                break;
            }
        }
        
        // Si no hay reserva activa ahora, buscar la próxima reserva confirmada futura
        if (!$activeReservation) {
            $futureReservations = [];
            foreach ($room->reservations as $reservation) {
                if ($reservation->status !== 'confirmed') {
                    continue;
                }
                
                $checkIn = $reservation->check_in instanceof Carbon 
                    ? $reservation->check_in->copy()->startOfDay() 
                    : Carbon::parse($reservation->check_in)->startOfDay();
                $checkOut = $reservation->check_out instanceof Carbon 
                    ? $reservation->check_out->copy()->startOfDay() 
                    : Carbon::parse($reservation->check_out)->startOfDay();
                $nowDate = $now->copy()->startOfDay();
                
                // Reserva futura que aún no ha comenzado pero ya está confirmada
                if ($checkIn > $nowDate && $checkOut >= $nowDate) {
                    $futureReservations[] = $reservation;
                }
            }
            
            // Ordenar por fecha de check-in y tomar la primera
            if (!empty($futureReservations)) {
                usort($futureReservations, function($a, $b) {
                    $checkInA = $a->check_in instanceof Carbon 
                        ? $a->check_in 
                        : Carbon::parse($a->check_in);
                    $checkInB = $b->check_in instanceof Carbon 
                        ? $b->check_in 
                        : Carbon::parse($b->check_in);
                    return $checkInA <=> $checkInB;
                });
                $activeReservation = $futureReservations[0];
            }
        }

        $status = 'available'; // libre
        $statusLabel = 'Disponible';
        $statusColor = 'green';
        $reservationInfo = null;
        $daysRemaining = null;
        $checkoutToday = false;

        if ($activeReservation) {
            $checkInDate = Carbon::parse($activeReservation->check_in)->startOfDay();
            $checkoutDate = Carbon::parse($activeReservation->check_out)->startOfDay();
            $nowDate = $now->copy()->startOfDay();
            
            // Verificar si la reserva ya comenzó o es futura
            if ($checkInDate <= $nowDate && $checkoutDate >= $nowDate) {
                // Reserva activa (ya comenzó)
                $status = 'occupied';
                $statusLabel = 'Ocupada';
                $statusColor = 'red';
                
                $daysRemaining = $now->diffInDays($checkoutDate, false);
                
                if ($daysRemaining === 0) {
                    $status = 'checkout_today';
                    $statusLabel = 'Sale Hoy';
                    $statusColor = 'yellow';
                    $checkoutToday = true;
                } elseif ($daysRemaining < 0) {
                    // Check-out pasado, debería estar libre (por si acaso)
                    $status = 'available';
                    $statusLabel = 'Disponible';
                    $statusColor = 'green';
                }
            } else {
                // Reserva futura (aún no ha comenzado)
                $status = 'reserved';
                $statusLabel = 'Reservada';
                $statusColor = 'orange';
                $daysRemaining = $now->diffInDays($checkInDate, false);
            }
            
            $reservationInfo = [
                'id' => $activeReservation->id,
                'guest_name' => $activeReservation->user ? $activeReservation->user->name : $activeReservation->guest_name,
                'check_in' => $activeReservation->check_in->format('d/m/Y'),
                'check_out' => $activeReservation->check_out->format('d/m/Y'),
                'guests' => $activeReservation->guests,
                'total_price' => $activeReservation->total_price,
                'checked_in_at' => $activeReservation->checked_in_at ? $activeReservation->checked_in_at->format('d/m/Y H:i') : null,
                'checked_out_at' => $activeReservation->checked_out_at ? $activeReservation->checked_out_at->format('d/m/Y H:i') : null,
            ];
        }

        // Verificar si está en mantenimiento
        if (!$room->is_available && !$activeReservation) {
            $status = 'maintenance';
            $statusLabel = 'Mantenimiento';
            $statusColor = 'gray';
        }

        // Extraer número de habitación
        preg_match('/(\d+)/', $room->name, $matches);
        $roomNumber = isset($matches[1]) ? (int)$matches[1] : 0;

        return [
            'id' => $room->id,
            'name' => $room->name,
            'formatted_name' => $room->formatted_name,
            'room_number' => $roomNumber,
            'room_type' => $room->room_type,
            'capacity' => $room->capacity,
            'price_per_night' => $room->price_per_night,
            'status' => $status,
            'status_label' => $statusLabel,
            'status_color' => $statusColor,
            'is_available' => $room->is_available,
            'manual_status' => $room->manual_status,
            'reservation' => $reservationInfo,
            'days_remaining' => $daysRemaining,
            'checkout_today' => $checkoutToday,
            'maintenance_note' => $room->maintenance_note ?? null,
        ];
    }

    /**
     * Calcular estadísticas generales
     */
    private function calculateStats($rooms)
    {
        $total = $rooms->count();
        $available = 0;
        $occupied = 0;
        $checkoutToday = 0;
        $maintenance = 0;

        foreach ($rooms as $room) {
            $status = $this->calculateRoomStatus($room);
            
            switch ($status['status']) {
                case 'available':
                    $available++;
                    break;
                case 'occupied':
                case 'reserved':
                    $occupied++;
                    break;
                case 'checkout_today':
                    $checkoutToday++;
                    $occupied++; // También cuenta como ocupada
                    break;
                case 'maintenance':
                    $maintenance++;
                    break;
            }
        }

        return [
            'total' => $total,
            'available' => $available,
            'occupied' => $occupied,
            'checkout_today' => $checkoutToday,
            'maintenance' => $maintenance,
            'occupancy_rate' => $total > 0 ? round(($occupied / $total) * 100, 1) : 0,
        ];
    }

    /**
     * Obtener notificaciones (habitaciones que salen hoy)
     */
    private function getNotifications($rooms)
    {
        $notifications = [];
        
        foreach ($rooms as $room) {
            $status = $this->calculateRoomStatus($room);
            
            if ($status['checkout_today']) {
                $notifications[] = [
                    'room' => $status['formatted_name'],
                    'room_id' => $room->id,
                    'guest' => $status['reservation']['guest_name'] ?? 'Sin nombre',
                    'checkout_time' => $status['reservation']['check_out'] ?? 'Hoy',
                ];
            }
        }
        
        return $notifications;
    }
}

