@extends('layouts.app')

@section('title', 'Reserva Exitosa - Hostal Real La Molina')

@section('content')
<div class="bg-[#F5EFE6] min-h-screen py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 text-center">
            <div class="mb-4 sm:mb-6">
                <svg class="w-16 h-16 sm:w-24 sm:h-24 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold text-[#0F0F0F] mb-3 sm:mb-4">¡Reserva Realizada Exitosamente!</h1>
            <p class="text-base sm:text-lg lg:text-xl text-[#2C2C2C] mb-6 sm:mb-8">Te contactaremos pronto para confirmar tu reserva.</p>
            
            <div class="bg-[#F5EFE6] rounded-lg p-4 sm:p-6 mb-6 sm:mb-8 text-left">
                <h2 class="text-xl sm:text-2xl font-display font-semibold text-[#0F0F0F] mb-3 sm:mb-4">Detalles de tu Reserva</h2>
                
                <div class="space-y-2 sm:space-y-3">
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C] font-medium">Número de Reserva:</span>
                        <span class="text-sm sm:text-base text-[#0F0F0F] font-bold break-all">#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C] font-medium">Habitación:</span>
                        <span class="text-sm sm:text-base text-[#0F0F0F] break-words text-right sm:text-left">{{ $reservation->room->name }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C] font-medium">Fecha de Entrada:</span>
                        <span class="text-sm sm:text-base text-[#0F0F0F]">{{ $reservation->check_in->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C] font-medium">Fecha de Salida:</span>
                        <span class="text-sm sm:text-base text-[#0F0F0F]">{{ $reservation->check_out->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-1 sm:gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C] font-medium">Huéspedes:</span>
                        <span class="text-sm sm:text-base text-[#0F0F0F]">{{ $reservation->guests }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center pt-3 border-t border-gray-300 gap-2">
                        <span class="text-lg sm:text-xl font-semibold text-[#0F0F0F]">Total:</span>
                        <span class="text-xl sm:text-2xl font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center mt-2 gap-2">
                        <span class="text-sm sm:text-base text-[#2C2C2C]">Estado:</span>
                        <span class="inline-block px-3 py-1 rounded-full text-xs sm:text-sm font-semibold 
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
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="{{ route('reservations.my') }}" 
                   class="bg-[#C9A24D] text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg text-sm sm:text-base font-semibold hover:bg-[#C9A24D]/90 transition-colors">
                    Ver Mis Reservas
                </a>
                <a href="{{ route('home') }}" 
                   class="bg-[#0F0F0F] text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-lg text-sm sm:text-base font-semibold hover:bg-[#2C2C2C] transition-colors">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

