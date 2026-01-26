@extends('layouts.admin')

@section('title', 'Historial de Habitación')
@section('page-title', 'Historial de Ocupación')
@section('page-subtitle', 'Registro completo de reservas de esta habitación')

@section('content')
<div class="space-y-6">
    <div class="card-premium p-6 flex items-center justify-between">
        <div>
            <h3 class="text-xl font-display font-bold text-[#0F0F0F]">{{ $room->formatted_name }}</h3>
            <p class="text-sm text-gray-500 mt-1">Historial completo de ocupación</p>
        </div>
        <a href="{{ route('admin.room-status.index') }}" class="btn-premium-outline">
            Volver al Control
        </a>
    </div>

    <div class="card-premium p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Huésped</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Check-in</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Check-out</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Duración</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($history as $reservation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $reservation->guest_name }}</p>
                                @if($reservation->user)
                                <p class="text-xs text-gray-500">{{ $reservation->user->email }}</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $reservation->check_in->format('d/m/Y') }}
                            @if($reservation->checked_in_at)
                            <span class="block text-xs text-green-600">✓ Check-in: {{ $reservation->checked_in_at->format('H:i') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $reservation->check_out->format('d/m/Y') }}
                            @if($reservation->checked_out_at)
                            <span class="block text-xs text-blue-600">✓ Check-out: {{ $reservation->checked_out_at->format('H:i') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $reservation->check_in->diffInDays($reservation->check_out) }} días
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-[#C9A24D]">
                            S/ {{ number_format($reservation->total_price, 2) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            No hay historial de reservas para esta habitación
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($history->hasPages())
        <div class="mt-6">
            {{ $history->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

