<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $thisYear = Carbon::now()->startOfYear();
        
        // Reservations Stats
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $confirmedReservations = Reservation::where('status', 'confirmed')->count();
        $cancelledReservations = Reservation::where('status', 'cancelled')->count();
        
        // Revenue Stats
        $monthlyRevenue = Reservation::where('status', 'confirmed')
            ->where('created_at', '>=', $thisMonth)
            ->sum('total_price');
        $lastMonthRevenue = Reservation::where('status', 'confirmed')
            ->whereBetween('created_at', [$lastMonth, $thisMonth])
            ->sum('total_price');
        $yearlyRevenue = Reservation::where('status', 'confirmed')
            ->where('created_at', '>=', $thisYear)
            ->sum('total_price');
        $totalRevenue = Reservation::where('status', 'confirmed')->sum('total_price');
        
        // Revenue Growth
        $revenueGrowth = $lastMonthRevenue > 0 
            ? (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 
            : 0;
        
        // Rooms Stats
        $totalRooms = Room::count();
        $availableRooms = Room::where('is_available', true)->count();
        $occupiedRooms = Reservation::where('status', 'confirmed')
            ->where('check_in', '<=', $today)
            ->where('check_out', '>=', $today)
            ->distinct('room_id')
            ->count('room_id');
        
        // Reviews Stats
        $totalReviews = Review::count();
        $approvedReviews = Review::where('is_approved', true)->count();
        $pendingReviews = Review::where('is_approved', false)->count();
        $featuredReviews = Review::where('is_featured', true)->count();
        $averageRating = Review::where('is_approved', true)->avg('rating') ?? 0;
        
        // Users Stats
        $totalUsers = \App\Models\User::where('role', 'client')->count();
        $newUsersThisMonth = \App\Models\User::where('role', 'client')
            ->where('created_at', '>=', $thisMonth)
            ->count();
        
        // Recent Activity
        $recentReservations = Reservation::with(['room', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Revenue by Month (Last 6 months)
        $revenueByMonth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->startOfMonth();
            $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();
            $revenueByMonth[] = [
                'month' => $month->format('M Y'),
                'revenue' => Reservation::where('status', 'confirmed')
                    ->whereBetween('created_at', [$month, $monthEnd])
                    ->sum('total_price')
            ];
        }
        
        // Reservations by Status
        $reservationsByStatus = [
            'pending' => $pendingReservations,
            'confirmed' => $confirmedReservations,
            'cancelled' => $cancelledReservations,
        ];
        
        // Top Rooms
        $topRooms = Room::withCount(['reservations' => function($query) {
            $query->where('status', 'confirmed');
        }])
        ->orderBy('reservations_count', 'desc')
        ->take(5)
        ->get();

        $stats = [
            'total_reservations' => $totalReservations,
            'pending_reservations' => $pendingReservations,
            'confirmed_reservations' => $confirmedReservations,
            'cancelled_reservations' => $cancelledReservations,
            'total_rooms' => $totalRooms,
            'available_rooms' => $availableRooms,
            'occupied_rooms' => $occupiedRooms,
            'monthly_revenue' => $monthlyRevenue,
            'last_month_revenue' => $lastMonthRevenue,
            'yearly_revenue' => $yearlyRevenue,
            'total_revenue' => $totalRevenue,
            'revenue_growth' => round($revenueGrowth, 2),
            'pending_reviews' => $pendingReviews,
            'total_reviews' => $totalReviews,
            'approved_reviews' => $approvedReviews,
            'featured_reviews' => $featuredReviews,
            'average_rating' => round($averageRating, 1),
            'total_users' => $totalUsers,
            'new_users_month' => $newUsersThisMonth,
        ];

        return view('admin.dashboard', compact(
            'stats', 
            'recentReservations', 
            'revenueByMonth', 
            'reservationsByStatus',
            'topRooms'
        ));
    }
}
