@extends('layouts.admin')

@section('title', 'Habitaciones')
@section('page-title', 'Gestión de Habitaciones')
@section('page-subtitle', isset($selectedType) ? 'Habitaciones ' . ($typeNames[$selectedType] ?? ucfirst($selectedType)) : 'Administra las habitaciones disponibles')

@section('content')
<!-- Actions -->
<div class="card-premium p-6 mb-6 flex items-center justify-between">
    <div>
        <h3 class="text-lg font-display font-bold text-[#0F0F0F]">
            @if(isset($selectedType))
                Habitaciones {{ $typeNames[$selectedType] ?? ucfirst($selectedType) }}
            @else
                Categorías de Habitaciones
            @endif
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            @if(isset($selectedType))
                Total: {{ $rooms->count() }} habitación{{ $rooms->count() > 1 ? 'es' : '' }}
            @else
                Selecciona una categoría para ver las habitaciones
            @endif
        </p>
    </div>
    @if(isset($selectedType))
    <a href="{{ route('admin.rooms.index') }}" class="btn-premium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver a Categorías
    </a>
    @else
    <a href="{{ route('admin.rooms.create') }}" class="btn-premium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nueva Habitación
    </a>
    @endif
</div>

@if(!isset($selectedType))
<!-- Categories Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($orderedTypes as $type)
        @php
            $categoryData = $roomsByType[$type] ?? null;
            $count = $categoryData ? $categoryData->count : 0;
            $avgPrice = $categoryData ? number_format($categoryData->avg_price, 2) : 0;
        @endphp
        
        @if($count > 0)
        <a href="{{ route('admin.rooms.index', ['type' => $type]) }}" 
           class="card-premium overflow-hidden group hover-lift transform transition-all duration-300 hover:scale-105">
            <div class="relative">
                <!-- Category Header with Gradient -->
                <div class="bg-gradient-to-br from-[#C9A24D] to-[#D4B366] p-8 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl">
                            @if($type === 'matrimonial')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            @elseif($type === 'simple')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @elseif($type === 'doble')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            @elseif($type === 'triple')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            @elseif($type === 'cuadruple')
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-display font-bold">{{ $count }}</div>
                            <div class="text-sm text-white/80">habitaciones</div>
                        </div>
                    </div>
                    <h3 class="text-2xl font-display font-bold mb-2">{{ $typeNames[$type] ?? ucfirst($type) }}</h3>
                    <p class="text-white/90 text-sm">Desde S/ {{ $avgPrice }} por noche</p>
                </div>
                
                <!-- Category Footer -->
                <div class="p-6 bg-white">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Ver habitaciones</span>
                        <svg class="w-5 h-5 text-[#C9A24D] transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endif
    @endforeach
</div>

@if($roomsByType->isEmpty())
<div class="card-premium p-12 text-center">
    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
    </svg>
    <p class="text-lg font-semibold text-gray-600 mb-2">No hay habitaciones registradas</p>
    <p class="text-sm text-gray-500 mb-6">Crea tu primera habitación para comenzar.</p>
    <a href="{{ route('admin.rooms.create') }}" class="btn-premium inline-flex">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Crear Primera Habitación
    </a>
</div>
@endif

@else
<!-- Rooms Grid for Selected Category -->
@if($rooms->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($rooms as $room)
    <div class="card-premium overflow-hidden group hover-lift border border-gray-100">
        <div class="relative aspect-video overflow-hidden bg-gray-100">
            @php
                $displayImage = $room->primaryImage ?? $room->images->first();
            @endphp
            @if($displayImage)
            <img src="{{ $displayImage->url }}" 
                 alt="{{ $room->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @if($displayImage->is_primary)
            <div class="absolute top-2 right-2 bg-[#C9A24D] text-white text-xs px-2 py-1 rounded font-semibold shadow-lg">
                Principal
            </div>
            @endif
            @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                <div class="text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <p class="text-xs text-gray-500 font-medium">Sin imagen</p>
                </div>
            </div>
            @endif
            @if(!$room->is_available)
            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                <span class="text-white font-bold text-sm bg-red-500 px-3 py-1 rounded">No Disponible</span>
            </div>
            @endif
        </div>
        <div class="p-5">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <h4 class="font-display font-bold text-lg text-[#0F0F0F] mb-1">{{ $room->name }}</h4>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        {{ $room->capacity }} persona{{ $room->capacity > 1 ? 's' : '' }}
                    </p>
                </div>
                <span class="text-xl font-display font-bold text-[#C9A24D] ml-3">S/ {{ number_format($room->price_per_night, 2) }}</span>
            </div>
            <p class="text-sm text-[#2C2C2C] line-clamp-2 mb-4 leading-relaxed">{{ $room->description }}</p>
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.rooms.edit', $room->id) }}" 
                       class="p-2.5 text-[#C9A24D] hover:bg-[#C9A24D]/10 rounded-lg transition-all transform hover:scale-110"
                       title="Editar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <a href="{{ route('admin.rooms.show', $room->id) }}" 
                       class="p-2.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all transform hover:scale-110"
                       title="Ver detalles">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </a>
                </div>
                <form method="POST" action="{{ route('admin.rooms.destroy', $room->id) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta habitación?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2.5 text-red-600 hover:bg-red-50 rounded-lg transition-all transform hover:scale-110" title="Eliminar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="card-premium p-12 text-center">
    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
    </svg>
    <p class="text-lg font-semibold text-gray-600 mb-2">No hay habitaciones en esta categoría</p>
    <p class="text-sm text-gray-500 mb-6">Crea una nueva habitación para esta categoría.</p>
    <a href="{{ route('admin.rooms.create') }}" class="btn-premium inline-flex">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Crear Nueva Habitación
    </a>
</div>
@endif
@endif
@endsection
