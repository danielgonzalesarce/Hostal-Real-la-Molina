@extends('layouts.admin')

@section('title', 'Detalles de Habitación')
@section('page-title', 'Detalles de Habitación')
@section('page-subtitle', 'Información completa de la habitación')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="card-premium p-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $room->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">ID: #{{ $room->id }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn-premium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
            <a href="{{ route('admin.rooms.index') }}" class="btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Images -->
            @if($room->images->count() > 0)
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Imágenes</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($room->images as $image)
                    <div class="relative aspect-video overflow-hidden rounded-lg bg-gray-100">
                        <img src="{{ $image->url }}" 
                             alt="{{ $room->name }}"
                             class="w-full h-full object-cover">
                        @if($image->is_primary)
                        <span class="absolute top-2 left-2 bg-[#C9A24D] text-white text-xs px-2 py-1 rounded">Principal</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Description -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Descripción</h3>
                <p class="text-[#2C2C2C] leading-relaxed">{{ $room->description }}</p>
            </div>

            <!-- Amenities -->
            @if($room->amenities)
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Amenidades</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $room->amenities) as $amenity)
                    <span class="px-3 py-1 bg-[#F5EFE6] text-[#0F0F0F] rounded-full text-sm font-medium">
                        {{ trim($amenity) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Details Card -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Detalles</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Precio por Noche</p>
                        <p class="text-2xl font-display font-bold text-[#C9A24D]">S/ {{ number_format($room->price_per_night, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Capacidad</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $room->capacity }} persona{{ $room->capacity > 1 ? 's' : '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Estado</p>
                        <span class="px-3 py-1.5 text-sm font-bold rounded-full
                            {{ $room->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $room->is_available ? 'Disponible' : 'No Disponible' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Orden de Visualización</p>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $room->sort_order }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Estadísticas</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total de Reservas</p>
                        <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $room->reservations->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Reseñas</p>
                        <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $room->reviews->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Imágenes</p>
                        <p class="text-2xl font-display font-bold text-[#0F0F0F]">{{ $room->images->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

