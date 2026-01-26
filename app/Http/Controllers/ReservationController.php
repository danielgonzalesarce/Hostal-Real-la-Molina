<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        // Solo considerar reservas CONFIRMADAS (no pendientes)
        $conflictingReservations = Reservation::where('room_id', $room->id)
            ->where('status', 'confirmed') // Solo reservas confirmadas bloquean
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price_per_night * $nights;

        return response()->json([
            'available' => !$conflictingReservations,
            'nights' => $nights,
            'total_price' => $totalPrice,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        // Verificar disponibilidad - Solo reservas CONFIRMADAS bloquean
        $conflictingReservations = Reservation::where('room_id', $room->id)
            ->where('status', 'confirmed') // Solo reservas confirmadas bloquean
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        if ($conflictingReservations) {
            return back()->withErrors(['error' => 'La habitación no está disponible para las fechas seleccionadas.'])->withInput();
        }

        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $room->price_per_night * $nights;

        $reservation = Reservation::create([
            'user_id' => Auth::id(), // Puede ser null si el usuario no está autenticado
            'room_id' => $request->room_id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $request->guests,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('reservations.success', $reservation->id)
            ->with('success', 'Reserva realizada exitosamente. Te contactaremos pronto para confirmar.');
    }

    public function success($id)
    {
        $reservation = Reservation::with('room')->findOrFail($id);
        return view('reservations.success', compact('reservation'));
    }

    public function myReservations()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $reservations = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }
}
