@extends('layouts.app')

@section('title', 'Mi Perfil - Hostal Real La Molina')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen py-6 sm:py-8 md:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header del Perfil -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6 sm:mb-8">
            <div class="bg-gradient-to-br from-[#C9A24D] via-[#D4B366] to-[#B8943F] p-6 sm:p-8 md:p-10 relative overflow-hidden">
                <!-- Badge Cliente Frecuente -->
                @if($stats['is_frequent_client'])
                <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/30">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-white font-semibold text-sm">Cliente Frecuente</span>
                        <span class="text-white font-bold text-sm">{{ $stats['discount_percentage'] }}% OFF</span>
                    </div>
                </div>
                @endif
                
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-8 md:gap-10">
                    <!-- Avatar -->
                    <div class="relative flex-shrink-0">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 bg-white rounded-2xl flex items-center justify-center shadow-2xl ring-4 ring-white/30">
                            <span class="text-5xl sm:text-6xl md:text-7xl font-display font-bold text-[#C9A24D]">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Información Principal -->
                    <div class="flex-1 text-center sm:text-left w-full">
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-white mb-3 sm:mb-4">
                            {{ $user->name }}
                        </h1>
                        <div class="space-y-2 sm:space-y-2.5 mb-4 sm:mb-5">
                            <div class="flex items-center justify-center sm:justify-start text-white/95">
                                <svg class="w-5 h-5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm sm:text-base break-words">{{ $user->email }}</span>
                            </div>
                            @if($user->phone)
                            <div class="flex items-center justify-center sm:justify-start text-white/95">
                                <svg class="w-5 h-5 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-sm sm:text-base">{{ $user->phone }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                                <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm text-white">Miembro desde {{ $user->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full">
                                <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm text-white">{{ $stats['total_visits'] }} {{ $stats['total_visits'] === 1 ? 'Visita' : 'Visitas' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Mejoradas -->
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 sm:gap-5 md:gap-6 mb-6 sm:mb-8">
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-[#C9A24D]/10">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-[#C9A24D] to-[#D4B366] rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-[#C9A24D] text-center mb-1">
                    {{ $stats['total_reservations'] }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Total Reservas</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-purple-200">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-purple-600 text-center mb-1">
                    {{ $stats['total_visits'] }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Visitas</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-green-200">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-green-400 to-green-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-green-600 text-center mb-1">
                    S/ {{ number_format($stats['total_spent'], 0) }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Total Gastado</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-yellow-200">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-yellow-600 text-center mb-1">
                    {{ $stats['pending_reservations'] }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Pendientes</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-blue-200">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-blue-600 text-center mb-1">
                    {{ $stats['total_reviews'] }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Reseñas</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-5 md:p-6 hover:shadow-xl transition-shadow border border-red-200">
                <div class="flex items-center justify-center mb-2 sm:mb-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-gradient-to-br from-red-400 to-red-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-display font-bold text-red-600 text-center mb-1">
                    {{ $stats['total_complaints'] }}
                </div>
                <div class="text-xs sm:text-sm text-gray-600 text-center font-medium">Reclamos</div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap -mb-px" aria-label="Tabs">
                    <button onclick="showTab('reservations')" id="tab-reservations" class="tab-button active flex-1 sm:flex-none px-4 sm:px-6 py-4 text-sm font-semibold text-center border-b-2 border-[#C9A24D] text-[#C9A24D]">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Reservas
                        </span>
                    </button>
                    <button onclick="showTab('reviews')" id="tab-reviews" class="tab-button flex-1 sm:flex-none px-4 sm:px-6 py-4 text-sm font-semibold text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                            Reseñas
                        </span>
                    </button>
                    <button onclick="showTab('complaints')" id="tab-complaints" class="tab-button flex-1 sm:flex-none px-4 sm:px-6 py-4 text-sm font-semibold text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Reclamos
                        </span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content: Reservas -->
        <div id="content-reservations" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                @if($recentReservations->count() > 0)
                <div class="space-y-4">
                    @foreach($recentReservations as $reservation)
                    <div class="bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl p-5 sm:p-6 border border-[#C9A24D]/10 hover:shadow-lg transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg sm:text-xl font-display font-bold text-[#0F0F0F] mb-2 break-words">
                                    {{ $reservation->room->formatted_name ?? $reservation->room->name }}
                                </h3>
                                <p class="text-sm text-gray-500 font-medium">
                                    Reserva #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                                </p>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold flex-shrink-0
                                @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800 border border-green-200
                                @else bg-red-100 text-red-800 border border-red-200
                                @endif">
                                @if($reservation->status === 'pending') Pendiente
                                @elseif($reservation->status === 'confirmed') Confirmada
                                @else Cancelada
                                @endif
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#C9A24D]/10 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-500 mb-0.5">Check-in</p>
                                    <p class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->check_in->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#C9A24D]/10 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-500 mb-0.5">Check-out</p>
                                    <p class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->check_out->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-[#C9A24D]/10 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-5 h-5 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs text-gray-500 mb-0.5">Total</p>
                                    <p class="text-base font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 sm:py-16">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-display font-semibold text-[#0F0F0F] mb-2">Aún no tienes reservas</h3>
                    <p class="text-gray-500 text-sm sm:text-base mb-6">Explora nuestras habitaciones y realiza tu primera reserva.</p>
                    <a href="{{ route('rooms.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-[#C9A24D] to-[#D4B366] text-white px-6 py-3 rounded-lg font-semibold hover:from-[#B8943F] hover:to-[#C9A24D] transition-all shadow-md hover:shadow-lg text-sm sm:text-base">
                        Explorar Habitaciones
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Tab Content: Reseñas -->
        <div id="content-reviews" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                @if($allReviews->count() > 0)
                <div class="space-y-4">
                    @foreach($allReviews as $review)
                    <div class="bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl p-5 sm:p-6 border border-[#C9A24D]/10 hover:shadow-lg transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="text-lg sm:text-xl font-display font-bold text-[#0F0F0F] break-words">
                                        {{ $review->room->formatted_name ?? $review->room->name ?? 'Habitación no disponible' }}
                                    </h3>
                                </div>
                                <div class="flex items-center gap-1 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-[#C9A24D]' : 'text-gray-300' }}" 
                                         fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" 
                                         stroke="currentColor" 
                                         viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    @endfor
                                </div>
                                <p class="text-sm sm:text-base text-[#2C2C2C] mb-3">{{ $review->comment }}</p>
                                <p class="text-xs text-gray-500">{{ $review->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold flex-shrink-0
                                @if($review->is_approved) bg-green-100 text-green-800 border border-green-200
                                @else bg-yellow-100 text-yellow-800 border border-yellow-200
                                @endif">
                                @if($review->is_approved)
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Aprobada
                                @else
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Pendiente
                                @endif
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 sm:py-16">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-display font-semibold text-[#0F0F0F] mb-2">Aún no has dejado reseñas</h3>
                    <p class="text-gray-500 text-sm sm:text-base mb-6">Comparte tu experiencia después de tu estadía.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Tab Content: Reclamos -->
        <div id="content-complaints" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 border border-gray-100">
                @if($allComplaints->count() > 0)
                <div class="space-y-4">
                    @foreach($allComplaints as $complaint)
                    <div class="bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl p-5 sm:p-6 border border-[#C9A24D]/10 hover:shadow-lg transition-all">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg sm:text-xl font-display font-bold text-[#0F0F0F] mb-2">
                                    Reclamo #{{ str_pad($complaint->id, 6, '0', STR_PAD_LEFT) }}
                                </h3>
                                <p class="text-sm sm:text-base text-[#2C2C2C] mb-3">{{ $complaint->complaint_description }}</p>
                                <div class="flex flex-wrap gap-4 text-xs sm:text-sm text-gray-500">
                                    <span>Fecha: {{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                                    @if($complaint->response_date)
                                    <span>Respuesta: {{ $complaint->response_date->format('d/m/Y H:i') }}</span>
                                    @endif
                                </div>
                                @if($complaint->response)
                                <div class="mt-4 p-4 bg-green-50 rounded-lg border border-green-200">
                                    <p class="text-sm font-semibold text-green-800 mb-2">Respuesta:</p>
                                    <p class="text-sm text-green-700">{{ $complaint->response }}</p>
                                </div>
                                @endif
                            </div>
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold flex-shrink-0
                                @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($complaint->status === 'resolved') bg-green-100 text-green-800 border border-green-200
                                @else bg-red-100 text-red-800 border border-red-200
                                @endif">
                                {{ $complaint->status_label }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 sm:py-16">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-display font-semibold text-[#0F0F0F] mb-2">No tienes reclamos registrados</h3>
                    <p class="text-gray-500 text-sm sm:text-base mb-6">Si tienes alguna queja o sugerencia, puedes registrarla en nuestro libro de reclamaciones.</p>
                    <a href="{{ route('complaints.create') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-[#C9A24D] to-[#D4B366] text-white px-6 py-3 rounded-lg font-semibold hover:from-[#B8943F] hover:to-[#C9A24D] transition-all shadow-md hover:shadow-lg text-sm sm:text-base">
                        Registrar Reclamo
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-[#C9A24D]', 'text-[#C9A24D]');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active class to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.add('active', 'border-[#C9A24D]', 'text-[#C9A24D]');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
}
</script>
@endsection
