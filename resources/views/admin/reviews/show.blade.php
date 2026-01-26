@extends('layouts.admin')

@section('title', 'Detalles de Reseña')
@section('page-title', 'Detalles de Reseña')
@section('page-subtitle', 'Información completa de la reseña')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="card-premium p-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">Reseña #{{ $review->id }}</h2>
            <p class="text-sm text-gray-500 mt-1">Publicada el {{ $review->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn-premium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Editar
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Review Content -->
            <div class="card-premium p-6">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-2">{{ $review->guest_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $review->guest_email }}</p>
                    </div>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                        <span class="ml-2 text-lg font-bold text-[#0F0F0F]">{{ $review->rating }}/5</span>
                    </div>
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-[#2C2C2C] leading-relaxed whitespace-pre-line">{{ $review->comment }}</p>
                </div>
            </div>

            <!-- Room Information -->
            @if($review->room)
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Habitación</h3>
                <div class="flex items-center gap-4">
                    @if($review->room->primaryImage)
                    <img src="{{ $review->room->primaryImage->url }}" 
                         alt="{{ $review->room->name }}"
                         class="w-24 h-24 object-cover rounded-lg">
                    @endif
                    <div>
                        <p class="text-lg font-semibold text-[#0F0F0F]">{{ $review->room->name }}</p>
                        <p class="text-sm text-gray-500">S/ {{ number_format($review->room->price_per_night, 2) }} por noche</p>
                    </div>
                </div>
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
                        <p class="text-sm text-gray-500 mb-2">Aprobación</p>
                        <span class="px-3 py-1.5 text-sm font-bold rounded-full
                            {{ $review->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $review->is_approved ? 'Aprobada' : 'Pendiente' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-2">Destacada</p>
                        <span class="px-3 py-1.5 text-sm font-bold rounded-full
                            {{ $review->is_featured ? 'bg-[#C9A24D]/20 text-[#C9A24D]' : 'bg-gray-100 text-gray-600' }}">
                            {{ $review->is_featured ? 'Sí' : 'No' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Fecha de Publicación</p>
                        <p class="text-sm font-semibold text-[#0F0F0F]">{{ $review->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if($review->user)
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Usuario Registrado</p>
                        <p class="text-sm font-semibold text-[#0F0F0F]">{{ $review->user->name }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="card-premium p-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Acciones</h3>
                <div class="space-y-3">
                    <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" 
                          onsubmit="return confirm('¿Estás seguro de eliminar esta reseña? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full btn-secondary text-red-600 border-red-300 hover:bg-red-50">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar Reseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

