<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['room', 'user']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('guest_name', 'like', '%' . $request->search . '%')
                    ->orWhere('guest_email', 'like', '%' . $request->search . '%')
                    ->orWhere('id', $request->search);
            });
        }

        $reservations = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::with(['room', 'user'])->findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function confirm($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);

        return back()->with('success', 'Reserva confirmada exitosamente.');
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reserva cancelada exitosamente.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}
