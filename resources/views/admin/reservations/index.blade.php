@extends('layouts.admin')

@section('title', 'Reservas')
@section('page-title', 'Gestión de Reservas')
@section('page-subtitle', 'Administra todas las reservas del sistema')

@section('content')
<!-- Filters -->
<div class="card-premium p-6 mb-6">
    <form method="GET" action="{{ route('admin.reservations.index') }}" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Buscar por nombre, email o ID..."
                   class="input-premium w-full">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="input-premium w-full">
                <option value="">Todos los estados</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmadas</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Canceladas</option>
            </select>
        </div>
        <button type="submit" class="btn-premium whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar
        </button>
        @if(request('search') || request('status'))
        <a href="{{ route('admin.reservations.index') }}" class="btn-secondary whitespace-nowrap">
            Limpiar
        </a>
        @endif
    </form>
</div>

<!-- Reservations Table -->
<div class="card-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Habitación</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Huésped</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Fechas</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Huéspedes</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reservations as $reservation)
                <tr class="hover:bg-[#F5EFE6]/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-mono text-[#0F0F0F]">#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->room->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-semibold text-[#0F0F0F]">{{ $reservation->guest_name }}</div>
                            <div class="text-xs text-gray-500">{{ $reservation->guest_email }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-[#2C2C2C]">
                            <div>{{ $reservation->check_in->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500">al {{ $reservation->check_out->format('d/m/Y') }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-[#2C2C2C]">{{ $reservation->guests }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1.5 text-xs font-bold rounded-full
                            @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            @if($reservation->status === 'pending') Pendiente
                            @elseif($reservation->status === 'confirmed') Confirmada
                            @else Cancelada
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            @if($reservation->status === 'pending')
                            <form method="POST" action="{{ route('admin.reservations.confirm', $reservation->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" title="Confirmar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            </form>
                            @endif
                            @if($reservation->status !== 'cancelled')
                            <form method="POST" action="{{ route('admin.reservations.cancel', $reservation->id) }}" class="inline" onsubmit="return confirm('¿Estás seguro de cancelar esta reserva?');">
                                @csrf
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Cancelar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-lg font-semibold">No hay reservas</p>
                            <p class="text-sm">Las reservas aparecerán aquí cuando los clientes las realicen.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($reservations->hasPages())
    <div class="p-6 border-t border-gray-200">
        {{ $reservations->links() }}
    </div>
    @endif
</div>
@endsection

