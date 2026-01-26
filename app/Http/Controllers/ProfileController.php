<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Mostrar el perfil del usuario autenticado
     */
    public function show()
    {
        $user = Auth::user();
        
        // Cargar relaciones
        $user->load(['reservations.room', 'reviews.room', 'complaints']);
        
        // Calcular estadísticas de reservas
        $confirmedReservations = $user->reservations()->where('status', 'confirmed')->get();
        
        // Calcular número de visitas (reservas confirmadas completadas)
        $completedReservations = $confirmedReservations->filter(function($reservation) {
            return $reservation->check_out->isPast();
        });
        $totalVisits = $completedReservations->count();
        
        // Calcular gastos totales
        $totalSpent = $confirmedReservations->sum('total_price');
        
        // Determinar si es cliente frecuente (más de 3 visitas)
        $isFrequentClient = $totalVisits >= 3;
        $discountPercentage = $isFrequentClient ? min(10 + ($totalVisits - 3) * 2, 25) : 0; // Máximo 25% de descuento
        
        // Estadísticas completas
        $stats = [
            'total_reservations' => $user->reservations()->count(),
            'pending_reservations' => $user->reservations()->where('status', 'pending')->count(),
            'confirmed_reservations' => $user->reservations()->where('status', 'confirmed')->count(),
            'total_reviews' => $user->reviews()->count(),
            'approved_reviews' => $user->reviews()->where('is_approved', true)->count(),
            'pending_reviews' => $user->reviews()->where('is_approved', false)->count(),
            'total_complaints' => $user->complaints()->count(),
            'pending_complaints' => $user->complaints()->where('status', 'pending')->count(),
            'total_visits' => $totalVisits,
            'total_spent' => $totalSpent,
            'is_frequent_client' => $isFrequentClient,
            'discount_percentage' => $discountPercentage,
        ];
        
        // Obtener datos para las secciones
        $recentReservations = $user->reservations()->with('room')->latest()->take(5)->get();
        $allReviews = $user->reviews()->with('room')->latest()->get();
        $allComplaints = $user->complaints()->latest()->get();
        
        return view('profile.show', compact('user', 'stats', 'recentReservations', 'allReviews', 'allComplaints'));
    }
}

