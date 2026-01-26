@extends('layouts.app')

@section('title', 'Mis Reservas - Hostal Real La Molina')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl font-display font-bold text-[#0F0F0F] mb-6 sm:mb-8">Mis Reservas</h1>
        
        @if($reservations->count() > 0)
        <div class="space-y-4 sm:space-y-6">
            @foreach($reservations as $reservation)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-4 gap-3">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xl sm:text-2xl font-display font-semibold text-[#0F0F0F] mb-2 break-words">
                                {{ $reservation->room->name }}
                            </h3>
                            <p class="text-sm sm:text-base text-[#2C2C2C]">Reserva #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-block px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold 
                                @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                @if($reservation->status === 'pending') Pendiente
                                @elseif($reservation->status === 'confirmed') Confirmada
                                @else Cancelada
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 mb-4">
                        <div class="bg-[#F5EFE6]/50 rounded-lg p-3 sm:p-4">
                            <p class="text-xs sm:text-sm text-gray-500 mb-1">Fecha de Entrada</p>
                            <p class="text-sm sm:text-base font-semibold text-[#0F0F0F]">{{ $reservation->check_in->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-[#F5EFE6]/50 rounded-lg p-3 sm:p-4">
                            <p class="text-xs sm:text-sm text-gray-500 mb-1">Fecha de Salida</p>
                            <p class="text-sm sm:text-base font-semibold text-[#0F0F0F]">{{ $reservation->check_out->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-[#F5EFE6]/50 rounded-lg p-3 sm:p-4 sm:col-span-2 lg:col-span-1">
                            <p class="text-xs sm:text-sm text-gray-500 mb-1">Huéspedes</p>
                            <p class="text-sm sm:text-base font-semibold text-[#0F0F0F]">{{ $reservation->guests }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-4 border-t border-gray-200 gap-3">
                        <div>
                            <p class="text-xs sm:text-sm text-gray-500">Total</p>
                            <p class="text-xl sm:text-2xl font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</p>
                        </div>
                        <div class="text-xs sm:text-sm text-gray-500">
                            <p>Reservado el {{ $reservation->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    
                    @if($reservation->special_requests)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs sm:text-sm text-gray-500 mb-1">Solicitudes Especiales</p>
                        <p class="text-sm sm:text-base text-[#2C2C2C] break-words">{{ $reservation->special_requests }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-lg shadow-md p-8 sm:p-12 text-center">
            <svg class="w-16 h-16 sm:w-24 sm:h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-xl sm:text-2xl font-display font-semibold text-[#0F0F0F] mb-2">No tienes reservas aún</h3>
            <p class="text-sm sm:text-base text-[#2C2C2C] mb-6">Explora nuestras habitaciones y realiza tu primera reserva.</p>
            <a href="{{ route('rooms.index') }}" 
               class="inline-block bg-[#C9A24D] text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg text-sm sm:text-base font-semibold hover:bg-[#C9A24D]/90 transition-colors">
                Ver Habitaciones
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

