<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'room_type',
        'description',
        'amenities',
        'capacity',
        'price_per_night',
        'is_available',
        'sort_order',
        'maintenance_note',
        'maintenance_since',
        'manual_status',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_per_night' => 'decimal:2',
        'capacity' => 'integer',
        'sort_order' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(RoomImage::class)->where('is_primary', true);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function featuredReviews(): HasMany
    {
        return $this->hasMany(Review::class)
            ->where('is_approved', true)
            ->where('is_featured', true);
    }

    /**
     * Obtiene el nombre formateado con el número de habitación
     * Ejemplo: "Matrimonial N° 204"
     */
    public function getFormattedNameAttribute(): string
    {
        // Extraer el número de habitación del nombre
        preg_match('/(\d+)$/', $this->name, $matches);
        $roomNumber = $matches[1] ?? '';
        
        // Obtener el tipo de habitación
        $typeMap = [
            'matrimonial' => 'Matrimonial',
            'simple' => 'Simple',
            'doble' => 'Doble',
            'triple' => 'Triple',
            'cuadruple' => 'Cuádruple',
        ];
        
        $type = $typeMap[$this->room_type] ?? 'Habitación';
        
        if ($roomNumber) {
            return "{$type} N° {$roomNumber}";
        }
        
        // Si no se encuentra el número, retornar el nombre original sin "Habitación"
        $name = $this->name;
        $name = preg_replace('/^Habitación\s+/i', '', $name);
        return $name;
    }

    /**
     * Verifica si la habitación está disponible actualmente
     */
    public function isCurrentlyAvailable(): bool
    {
        if (!$this->is_available) {
            return false; // En mantenimiento
        }
        
        // Si tiene estado manual "occupied", no está disponible
        if ($this->manual_status === 'occupied') {
            return false;
        }

        $now = now();
        
        // Verificar si tiene reservas confirmadas activas o futuras
        $hasActiveOrFutureReservation = $this->reservations()
            ->where('status', 'confirmed')
            ->where(function($query) use ($now) {
                // Reservas activas (ya comenzaron)
                $query->where(function($activeQ) use ($now) {
                    $activeQ->where('check_in', '<=', $now)
                            ->where('check_out', '>=', $now);
                })
                // O reservas futuras confirmadas (aún no han comenzado)
                ->orWhere(function($futureQ) use ($now) {
                    $futureQ->where('check_in', '>', $now)
                            ->where('check_out', '>=', $now);
                });
            })
            ->exists();

        return !$hasActiveOrFutureReservation;
    }

    /**
     * Obtiene la próxima fecha disponible para reservar
     */
    public function getNextAvailableDate(): ?\Carbon\Carbon
    {
        if (!$this->is_available) {
            return null; // En mantenimiento, no hay fecha disponible
        }

        $now = now();
        
        // Obtener todas las reservas confirmadas que aún no han terminado
        $upcomingReservations = $this->reservations()
            ->where('status', 'confirmed')
            ->where('check_out', '>=', $now)
            ->orderBy('check_out', 'asc')
            ->get();

        // Si no hay reservas, está disponible desde hoy
        if ($upcomingReservations->isEmpty()) {
            return $now->copy()->startOfDay();
        }

        // Buscar el primer hueco disponible
        $currentDate = $now->copy()->startOfDay();
        
        foreach ($upcomingReservations as $reservation) {
            $reservationCheckIn = \Carbon\Carbon::parse($reservation->check_in)->startOfDay();
            $reservationCheckOut = \Carbon\Carbon::parse($reservation->check_out)->startOfDay();
            
            // Si hay un hueco antes de esta reserva
            if ($currentDate->lt($reservationCheckIn)) {
                return $currentDate;
            }
            
            // Actualizar la fecha actual al día después del check-out
            if ($reservationCheckOut->gt($currentDate)) {
                $currentDate = $reservationCheckOut->copy();
            }
        }

        // Si llegamos aquí, la próxima fecha disponible es después de la última reserva
        $lastReservation = $upcomingReservations->last();
        return \Carbon\Carbon::parse($lastReservation->check_out)->startOfDay();
    }

    /**
     * Obtiene información de la reserva activa actual
     */
    public function getActiveReservation()
    {
        $now = now();
        return $this->reservations()
            ->where('status', 'confirmed')
            ->where('check_in', '<=', $now)
            ->where('check_out', '>=', $now)
            ->with('user')
            ->first();
    }

    /**
     * Obtiene el estado de disponibilidad con información detallada
     */
    public function getAvailabilityStatus(): array
    {
        $isAvailable = $this->isCurrentlyAvailable();
        $nextAvailableDate = $this->getNextAvailableDate();
        $activeReservation = $this->getActiveReservation();

        $status = [
            'available' => $isAvailable,
            'status' => $isAvailable ? 'available' : 'occupied',
            'status_label' => $isAvailable ? 'Disponible' : 'No Disponible',
            'next_available_date' => $nextAvailableDate ? $nextAvailableDate->format('d/m/Y') : null,
            'next_available_date_raw' => $nextAvailableDate ? $nextAvailableDate->format('Y-m-d') : null,
        ];

        if ($activeReservation) {
            $checkoutDate = \Carbon\Carbon::parse($activeReservation->check_out);
            $status['occupied_until'] = $checkoutDate->format('d/m/Y');
            $status['occupied_until_raw'] = $checkoutDate->format('Y-m-d');
            $status['days_until_available'] = now()->diffInDays($checkoutDate, false);
            $status['guest_name'] = $activeReservation->user ? $activeReservation->user->name : $activeReservation->guest_name;
        }

        if (!$this->is_available) {
            $status['status'] = 'maintenance';
            $status['status_label'] = 'En Mantenimiento';
            $status['maintenance_note'] = $this->maintenance_note;
        }

        return $status;
    }
}
