@extends('layouts.admin')

@section('title', 'Editar Habitación')
@section('page-title', 'Editar Habitación')
@section('page-subtitle', 'Modifica los detalles de la habitación')

@section('content')
<div class="card-premium p-8 max-w-4xl">
    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Basic Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Información Básica</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Nombre de la Habitación *</label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $room->name) }}"
                               required
                               class="input-premium w-full @error('name') border-red-300 @enderror">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Tipo de Habitación *</label>
                        <select name="room_type" 
                                required
                                class="input-premium w-full @error('room_type') border-red-300 @enderror">
                            <option value="">Seleccione un tipo</option>
                            <option value="simple" {{ old('room_type', $room->room_type) === 'simple' ? 'selected' : '' }}>Simple</option>
                            <option value="doble" {{ old('room_type', $room->room_type) === 'doble' ? 'selected' : '' }}>Doble</option>
                            <option value="matrimonial" {{ old('room_type', $room->room_type) === 'matrimonial' ? 'selected' : '' }}>Matrimonial</option>
                            <option value="triple" {{ old('room_type', $room->room_type) === 'triple' ? 'selected' : '' }}>Triple</option>
                            <option value="cuadruple" {{ old('room_type', $room->room_type) === 'cuadruple' ? 'selected' : '' }}>Cuádruple</option>
                        </select>
                        @error('room_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Capacidad *</label>
                        <input type="number" 
                               name="capacity" 
                               value="{{ old('capacity', $room->capacity) }}"
                               required
                               min="1"
                               class="input-premium w-full @error('capacity') border-red-300 @enderror">
                        @error('capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Precio por Noche (S/) *</label>
                        <input type="number" 
                               name="price_per_night" 
                               value="{{ old('price_per_night', $room->price_per_night) }}"
                               required
                               step="0.01"
                               min="0"
                               class="input-premium w-full @error('price_per_night') border-red-300 @enderror">
                        @error('price_per_night')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Orden de Visualización</label>
                        <input type="number" 
                               name="sort_order" 
                               value="{{ old('sort_order', $room->sort_order) }}"
                               min="0"
                               class="input-premium w-full">
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Descripción</h3>
                
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Descripción *</label>
                    <textarea name="description" 
                              rows="6" 
                              required
                              class="input-premium w-full @error('description') border-red-300 @enderror">{{ old('description', $room->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Amenidades</label>
                    <textarea name="amenities" 
                              rows="4" 
                              class="input-premium w-full">{{ old('amenities', $room->amenities) }}</textarea>
                </div>
            </div>

            <!-- Current Images -->
            @if($room->images->count() > 0)
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Imágenes Actuales</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($room->images as $image)
                    <div class="relative group">
                        <img src="{{ $image->url }}" 
                             alt="{{ $room->name }}"
                             class="w-full h-32 object-cover rounded-lg">
                        @if($image->is_primary)
                        <span class="absolute top-2 left-2 bg-[#C9A24D] text-white text-xs px-2 py-1 rounded font-semibold">Principal</span>
                        @endif
                        
                        <!-- Overlay con acciones -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center gap-2">
                            @if(!$image->is_primary)
                            <form method="POST" action="{{ route('admin.rooms.images.set-primary', [$room->id, $image->id]) }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="px-3 py-1.5 bg-[#C9A24D] text-white text-xs rounded hover:bg-[#B8943F] transition-colors"
                                        title="Establecer como principal">
                                    Principal
                                </button>
                            </form>
                            @endif
                            
                            <form method="POST" 
                                  action="{{ route('admin.rooms.images.delete', [$room->id, $image->id]) }}" 
                                  class="inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta imagen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1.5 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition-colors"
                                        title="Eliminar imagen">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="mt-4 text-sm text-gray-600">
                    <span class="font-semibold">Nota:</span> La imagen marcada como "Principal" será la que se muestre en el listado de habitaciones. 
                    Puedes cambiar la imagen principal haciendo clic en el botón "Principal" sobre cualquier imagen.
                </p>
            </div>
            @else
            <div class="border-b border-gray-200 pb-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-sm text-yellow-800">
                        <span class="font-semibold">⚠️ Sin imágenes:</span> Esta habitación no tiene imágenes. 
                        Agrega imágenes a continuación para que se muestren en el sitio web.
                    </p>
                </div>
            </div>
            @endif

            <!-- New Images -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-4">Agregar Nuevas Imágenes</h3>
                <p class="text-sm text-gray-600 mb-6">
                    Puedes agregar múltiples imágenes a la vez. Selecciona todas las imágenes que deseas subir en una sola vez.
                </p>
                
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-[#C9A24D] transition-colors bg-gray-50">
                    <input type="file" 
                           name="images[]" 
                           id="images"
                           accept="image/*"
                           multiple
                           class="hidden"
                           onchange="previewImages(this)">
                    <label for="images" class="cursor-pointer block">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 group-hover:text-[#C9A24D] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-base font-semibold text-[#0F0F0F] mb-2">Haz clic para seleccionar imágenes</p>
                        <p class="text-sm text-gray-500 mb-4">Puedes seleccionar múltiples imágenes a la vez (Ctrl + Click o Cmd + Click)</p>
                        <span class="inline-block px-4 py-2 bg-[#C9A24D] text-white rounded-lg font-medium hover:bg-[#B8943F] transition-colors">
                            Seleccionar Imágenes
                        </span>
                    </label>
                    <div id="preview-container" class="hidden mt-8">
                        <p class="text-sm font-semibold text-[#0F0F0F] mb-4 text-left">Vista Previa de Imágenes Seleccionadas:</p>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="preview-grid">
                        </div>
                        <p class="text-xs text-gray-500 mt-4 text-left">
                            <span class="font-semibold">Nota:</span> Las nuevas imágenes se agregarán a las existentes. La primera imagen que selecciones será marcada como principal si no hay ninguna imagen principal actualmente.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" 
                           name="is_available" 
                           value="1"
                           {{ old('is_available', $room->is_available) ? 'checked' : '' }}
                           class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded focus:ring-[#C9A24D]">
                    <span class="ml-3 text-sm font-semibold text-[#0F0F0F]">Disponible para reservas</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn-premium">
                    Guardar Cambios
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>

<script>
function previewImages(input) {
    const container = document.getElementById('preview-container');
    const grid = document.getElementById('preview-grid');
    grid.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        container.classList.remove('hidden');
        
        const fileCount = input.files.length;
        const fileSize = Array.from(input.files).reduce((total, file) => total + file.size, 0);
        const maxSize = 10 * 1024 * 1024; // 10MB por imagen
        
        Array.from(input.files).forEach((file, index) => {
            // Validar tamaño de archivo
            if (file.size > maxSize) {
                alert(`La imagen "${file.name}" es demasiado grande. El tamaño máximo es 10MB.`);
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <div class="relative aspect-square overflow-hidden rounded-lg border-2 border-gray-200 group-hover:border-[#C9A24D] transition-colors">
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">Imagen ${index + 1}</span>
                        </div>
                        <div class="absolute top-2 left-2 bg-[#C9A24D] text-white text-xs px-2 py-1 rounded font-semibold">
                            ${(file.size / 1024 / 1024).toFixed(2)} MB
                        </div>
                    </div>
                `;
                grid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
        
        // Mostrar resumen
        const summary = document.createElement('div');
        summary.className = 'mt-4 p-4 bg-[#F5EFE6] rounded-lg';
        summary.innerHTML = `
            <p class="text-sm font-semibold text-[#0F0F0F]">
                <span class="text-[#C9A24D]">${fileCount}</span> imagen${fileCount > 1 ? 'es' : ''} seleccionada${fileCount > 1 ? 's' : ''}
            </p>
            <p class="text-xs text-gray-600 mt-1">Tamaño total: ${(fileSize / 1024 / 1024).toFixed(2)} MB</p>
        `;
        grid.parentNode.insertBefore(summary, grid.nextSibling);
    } else {
        container.classList.add('hidden');
    }
}
</script>
@endsection

