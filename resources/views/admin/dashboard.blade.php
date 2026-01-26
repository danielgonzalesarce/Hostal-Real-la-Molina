@extends('layouts.admin')

@section('title', 'Dashboard Premium')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Panel de control completo y profesional')

@section('content')
<!-- Premium Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Reservations -->
    <div class="card-premium p-6 hover-lift reveal">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-gray-500 text-sm font-medium mb-2 uppercase tracking-wider">Total Reservas</p>
                <p class="text-4xl font-display font-bold text-[#0F0F0F]">{{ $stats['total_reservations'] }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-gray-400">Todas las reservas</span>
                </div>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue -->
    <div class="card-premium p-6 hover-lift reveal" style="animation-delay: 0.1s">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-gray-500 text-sm font-medium mb-2 uppercase tracking-wider">Ingresos del Mes</p>
                <p class="text-4xl font-display font-bold text-[#C9A24D]">S/ {{ number_format($stats['monthly_revenue'], 2) }}</p>
                <div class="flex items-center mt-2">
                    @if($stats['revenue_growth'] > 0)
                    <span class="text-xs text-green-600 font-semibold">↑ {{ abs($stats['revenue_growth']) }}%</span>
                    @elseif($stats['revenue_growth'] < 0)
                    <span class="text-xs text-red-600 font-semibold">↓ {{ abs($stats['revenue_growth']) }}%</span>
                    @else
                    <span class="text-xs text-gray-400">Sin cambios</span>
                    @endif
                    <span class="text-xs text-gray-400 ml-2">vs mes anterior</span>
                </div>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Pending Reservations -->
    <div class="card-premium p-6 hover-lift reveal" style="animation-delay: 0.2s">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-gray-500 text-sm font-medium mb-2 uppercase tracking-wider">Pendientes</p>
                <p class="text-4xl font-display font-bold text-yellow-600">{{ $stats['pending_reservations'] }}</p>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-gray-400">Requieren atención</span>
                </div>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Average Rating -->
    <div class="card-premium p-6 hover-lift reveal" style="animation-delay: 0.3s">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-gray-500 text-sm font-medium mb-2 uppercase tracking-wider">Calificación Promedio</p>
                <p class="text-4xl font-display font-bold text-green-600">{{ $stats['average_rating'] }}/5</p>
                <div class="flex items-center mt-2">
                    <span class="text-xs text-gray-400">{{ $stats['approved_reviews'] }} reseñas</span>
                </div>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats Row -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Revenue -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Ingresos Totales</p>
                <p class="text-2xl font-display font-bold text-[#0F0F0F]">S/ {{ number_format($stats['total_revenue'], 2) }}</p>
            </div>
            <div class="w-12 h-12 bg-[#C9A24D]/10 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Rooms -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Habitaciones</p>
                <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $stats['total_rooms'] }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['available_rooms'] }} disponibles</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Usuarios</p>
                <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $stats['total_users'] }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['new_users_month'] }} este mes</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Reviews -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium mb-1">Reseñas</p>
                <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $stats['total_reviews'] }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['pending_reviews'] }} pendientes</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Analytics Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-display font-bold text-[#0F0F0F]">Ingresos (Últimos 6 Meses)</h3>
            <span class="text-sm text-gray-500">S/ {{ number_format($stats['yearly_revenue'], 2) }} anual</span>
        </div>
        <div class="h-64 flex items-end justify-between gap-2">
            @foreach($revenueByMonth as $month)
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gray-200 rounded-t-lg relative group cursor-pointer" style="height: {{ $month['revenue'] > 0 ? max(20, ($month['revenue'] / max(array_column($revenueByMonth, 'revenue'))) * 100) : 0 }}%">
                    <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-[#0F0F0F] text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                        S/ {{ number_format($month['revenue'], 2) }}
                    </div>
                </div>
                <span class="text-xs text-gray-500 mt-2 text-center">{{ $month['month'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Reservations Status Chart -->
    <div class="card-premium p-6">
        <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Estado de Reservas</h3>
        <div class="space-y-4">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-[#0F0F0F]">Confirmadas</span>
                    <span class="text-sm font-bold text-green-600">{{ $reservationsByStatus['confirmed'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-green-500 h-3 rounded-full" style="width: {{ $stats['total_reservations'] > 0 ? ($reservationsByStatus['confirmed'] / $stats['total_reservations']) * 100 : 0 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-[#0F0F0F]">Pendientes</span>
                    <span class="text-sm font-bold text-yellow-600">{{ $reservationsByStatus['pending'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-yellow-500 h-3 rounded-full" style="width: {{ $stats['total_reservations'] > 0 ? ($reservationsByStatus['pending'] / $stats['total_reservations']) * 100 : 0 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-[#0F0F0F]">Canceladas</span>
                    <span class="text-sm font-bold text-red-600">{{ $reservationsByStatus['cancelled'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-red-500 h-3 rounded-full" style="width: {{ $stats['total_reservations'] > 0 ? ($reservationsByStatus['cancelled'] / $stats['total_reservations']) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top Rooms and Recent Reservations -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Top Rooms -->
    <div class="card-premium p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-display font-bold text-[#0F0F0F]">Habitaciones Más Reservadas</h3>
            <a href="{{ route('admin.rooms.index') }}" class="text-sm text-[#C9A24D] hover:text-[#B8943F] font-semibold">
                Ver todas
            </a>
        </div>
        <div class="space-y-4">
            @forelse($topRooms as $room)
            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    @if($room->primaryImage)
                    <img src="{{ $room->primaryImage->url }}" alt="{{ $room->name }}" class="w-16 h-16 object-cover rounded-lg">
                    @else
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    @endif
                    <div>
                        <p class="font-semibold text-[#0F0F0F]">{{ $room->name }}</p>
                        <p class="text-sm text-gray-500">S/ {{ number_format($room->price_per_night, 2) }}/noche</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-display font-bold text-[#C9A24D]">{{ $room->reservations_count }}</p>
                    <p class="text-xs text-gray-500">reservas</p>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 py-8">No hay datos disponibles</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-[#F5EFE6] to-white">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F]">Reservas Recientes</h3>
                <a href="{{ route('admin.reservations.index') }}" class="text-sm text-[#C9A24D] hover:text-[#B8943F] font-semibold">
                    Ver todas
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Habitación</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Huésped</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentReservations as $reservation)
                    <tr class="hover:bg-[#F5EFE6]/30 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-mono text-[#0F0F0F]">#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->room->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-[#2C2C2C]">{{ $reservation->guest_name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-bold rounded-full
                                @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">No hay reservas recientes</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Scroll Reveal Animation
document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.reveal');
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    reveals.forEach(reveal => {
        revealObserver.observe(reveal);
    });
});
</script>
@endsection
