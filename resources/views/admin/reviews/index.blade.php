@extends('layouts.admin')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Reseñas')
@section('page-title', 'Gestión de Reseñas')
@section('page-subtitle', 'Administra las reseñas de los huéspedes')

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
    <div class="card-premium p-6 hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Total Reseñas</p>
                <p class="text-3xl font-display font-bold text-[#0F0F0F]">{{ $stats['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6 hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Aprobadas</p>
                <p class="text-3xl font-display font-bold text-green-600">{{ $stats['approved'] }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6 hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Pendientes</p>
                <p class="text-3xl font-display font-bold text-yellow-600">{{ $stats['pending'] }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6 hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Destacadas</p>
                <p class="text-3xl font-display font-bold text-[#C9A24D]">{{ $stats['featured'] }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6 hover-lift">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 mb-1">Calificación Promedio</p>
                <p class="text-3xl font-display font-bold text-[#C9A24D]">{{ number_format($stats['avg_rating'], 1) }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Filters and Actions -->
<div class="card-premium p-6 mb-6">
    <form method="GET" action="{{ route('admin.reviews.index') }}" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Buscar por nombre, email o comentario..."
                   class="input-premium w-full">
        </div>
        <div class="w-full md:w-48">
            <select name="status" class="input-premium w-full">
                <option value="">Todas las reseñas</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Aprobadas</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes</option>
                <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Destacadas</option>
            </select>
        </div>
        <button type="submit" class="btn-premium whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar
        </button>
        @if(request('search') || request('status'))
        <a href="{{ route('admin.reviews.index') }}" class="btn-secondary whitespace-nowrap">
            Limpiar
        </a>
        @endif
    </form>
</div>

<!-- Reviews Table -->
<div class="card-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Huésped</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Habitación</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Calificación</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Comentario</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($reviews as $review)
                <tr class="hover:bg-[#F5EFE6]/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-mono text-[#0F0F0F]">#{{ $review->id }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-semibold text-[#0F0F0F]">{{ $review->guest_name }}</div>
                            <div class="text-xs text-gray-500">{{ $review->guest_email }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <span class="text-sm font-semibold text-[#0F0F0F]">{{ $review->room->formatted_name ?? $review->room->name ?? 'N/A' }}</span>
                            @if($review->room)
                            <p class="text-xs text-gray-500 mt-1">ID: {{ $review->room->id }}</p>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                            <span class="ml-2 text-sm font-semibold text-[#0F0F0F]">{{ $review->rating }}/5</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-[#2C2C2C] line-clamp-2">{{ Str::limit($review->comment, 80) }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            @if($review->is_approved)
                            <span class="px-2 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">Aprobada</span>
                            @else
                            <span class="px-2 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                            @endif
                            @if($review->is_featured)
                            <span class="px-2 py-1 text-xs font-bold rounded-full bg-[#C9A24D]/20 text-[#C9A24D]">Destacada</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.reviews.show', $review->id) }}" 
                               class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Ver detalles">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.reviews.edit', $review->id) }}" 
                               class="p-2 text-[#C9A24D] hover:bg-[#C9A24D]/10 rounded-lg transition-colors" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta reseña?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <p class="text-lg font-semibold">No hay reseñas</p>
                            <p class="text-sm">Las reseñas aparecerán aquí cuando los huéspedes las publiquen.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($reviews->hasPages())
    <div class="p-6 border-t border-gray-200">
        {{ $reviews->links() }}
    </div>
    @endif
</div>
@endsection

