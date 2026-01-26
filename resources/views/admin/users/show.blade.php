@extends('layouts.admin')

@section('title', 'Detalles de Usuario')
@section('page-title', 'Detalles de Usuario')
@section('page-subtitle', 'Información completa del usuario')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="card-premium p-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">Usuario desde {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-premium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- User Information -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Información Personal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nombre Completo</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Teléfono</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $user->phone ?? 'No registrado' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Rol</p>
                        <span class="px-3 py-1 text-sm font-bold rounded-full bg-blue-100 text-blue-800">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Reservations -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Reservas ({{ $user->reservations->count() }})</h3>
                @if($user->reservations->count() > 0)
                <div class="space-y-3">
                    @foreach($user->reservations->take(5) as $reservation)
                    <div class="p-4 bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-[#0F0F0F]">{{ $reservation->room->name }}</p>
                                <p class="text-sm text-gray-500">{{ $reservation->check_in->format('d/m/Y') }} - {{ $reservation->check_out->format('d/m/Y') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-[#C9A24D]">S/ {{ number_format($reservation->total_price, 2) }}</p>
                                <span class="px-2 py-1 text-xs font-bold rounded-full
                                    @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if($user->reservations->count() > 5)
                    <a href="{{ route('admin.reservations.index', ['search' => $user->email]) }}" class="block text-center text-[#C9A24D] hover:text-[#B8943F] font-semibold">
                        Ver todas las reservas
                    </a>
                    @endif
                </div>
                @else
                <p class="text-center text-gray-500 py-8">Este usuario no tiene reservas</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Statistics -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Estadísticas</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Reservas</p>
                        <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $user->reservations->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Reseñas Publicadas</p>
                        <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $user->reviews->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Miembro desde</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

