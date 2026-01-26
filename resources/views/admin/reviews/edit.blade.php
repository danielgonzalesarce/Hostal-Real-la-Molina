@extends('layouts.admin')

@section('title', 'Editar Reseña')
@section('page-title', 'Editar Reseña')
@section('page-subtitle', 'Modifica los detalles de la reseña')

@section('content')
<div class="card-premium p-8 max-w-4xl">
    <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Review Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Huésped</label>
                    <div class="input-premium bg-gray-50">{{ $review->guest_name }}</div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Email</label>
                    <div class="input-premium bg-gray-50">{{ $review->guest_email }}</div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Habitación</label>
                    <div class="input-premium bg-gray-50">{{ $review->room->name ?? 'N/A' }}</div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Fecha</label>
                    <div class="input-premium bg-gray-50">{{ $review->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <!-- Rating -->
            <div>
                <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Calificación</label>
                <select name="rating" class="input-premium" required>
                    @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} Estrella{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <!-- Comment -->
            <div>
                <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Comentario</label>
                <textarea name="comment" 
                          rows="6" 
                          class="input-premium w-full" 
                          required>{{ old('comment', $review->comment) }}</textarea>
            </div>

            <!-- Status Checkboxes -->
            <div class="flex flex-col gap-4">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_approved" 
                           value="1"
                           {{ $review->is_approved ? 'checked' : '' }}
                           class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded focus:ring-[#C9A24D]">
                    <span class="ml-3 text-sm font-semibold text-[#0F0F0F]">Aprobada (visible en el sitio)</span>
                </label>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_featured" 
                           value="1"
                           {{ $review->is_featured ? 'checked' : '' }}
                           class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded focus:ring-[#C9A24D]">
                    <span class="ml-3 text-sm font-semibold text-[#0F0F0F]">Destacada (aparece en la página principal)</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn-premium">
                    Guardar Cambios
                </button>
                <a href="{{ route('admin.reviews.index') }}" class="btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

