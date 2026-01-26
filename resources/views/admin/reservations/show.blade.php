@extends('layouts.admin')

@section('title', 'Detalles de Reserva')
@section('page-title', 'Detalles de Reserva')
@section('page-subtitle', 'Información completa de la reserva')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="card-premium p-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">Reserva #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</h2>
            <p class="text-sm text-gray-500 mt-1">Creada el {{ $reservation->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="flex items-center gap-3">
            @if($reservation->status === 'pending')
            <form method="POST" action="{{ route('admin.reservations.confirm', $reservation->id) }}" class="inline">
                @csrf
                <button type="submit" class="btn-premium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Confirmar
                </button>
            </form>
            @endif
            @if($reservation->status !== 'cancelled')
            <form method="POST" action="{{ route('admin.reservations.cancel', $reservation->id) }}" class="inline" onsubmit="return confirm('¿Estás seguro de cancelar esta reserva?');">
                @csrf
                <button type="submit" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancelar
                </button>
            </form>
            @endif
            <a href="{{ route('admin.reservations.index') }}" class="btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Guest Information -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Información del Huésped</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nombre</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->guest_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->guest_email }}</p>
                    </div>
                    @if($reservation->guest_phone)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Teléfono</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->guest_phone }}</p>
                    </div>
                    @endif
                    @if($reservation->user)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Usuario Registrado</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->user->name }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Reservation Details -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Detalles de la Reserva</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Habitación</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->room->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Número de Huéspedes</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->guests }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Check-in</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->check_in->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Check-out</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->check_out->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Noches</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $reservation->check_in->diffInDays($reservation->check_out) }} noche{{ $reservation->check_in->diffInDays($reservation->check_out) > 1 ? 's' : '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Precio Total</p>
                        <p class="text-2xl font-display font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Special Requests -->
            @if($reservation->special_requests)
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Solicitudes Especiales</h3>
                <p class="text-[#2C2C2C] leading-relaxed">{{ $reservation->special_requests }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Estado</h3>
                <div class="space-y-4">
                    <div>
                        <span class="px-4 py-2 text-sm font-bold rounded-full
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
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Fecha de Creación</p>
                        <p class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Última Actualización</p>
                        <p class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Acciones</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}" 
                          onsubmit="return confirm('¿Estás seguro de eliminar esta reserva? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full btn-secondary text-red-600 border-red-300 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar Reserva
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

