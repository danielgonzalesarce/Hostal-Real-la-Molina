@extends('layouts.app')

@section('title', $room->name . ' - Hostal Real La Molina')

@section('content')
<!-- Breadcrumb Premium -->
<div class="bg-gradient-to-r from-[#F5EFE6] to-white border-b border-[#C9A24D]/10 py-3 sm:py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-1 sm:space-x-2 text-xs sm:text-sm overflow-x-auto">
            <a href="{{ route('home') }}" class="text-[#2C2C2C] hover:text-[#C9A24D] transition-colors whitespace-nowrap">Inicio</a>
            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('rooms.index') }}" class="text-[#2C2C2C] hover:text-[#C9A24D] transition-colors whitespace-nowrap">Habitaciones</a>
            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-[#C9A24D] font-semibold truncate">{{ $room->formatted_name }}</span>
        </nav>
    </div>
</div>

<div class="bg-white min-h-screen py-6 sm:py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-12">
            <!-- Left Column - Images and Details -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Premium Image Gallery -->
                @if($room->images->count() > 0)
                @php
                    // Obtener todas las imágenes ordenadas (primero la principal, luego por sort_order)
                    $allImages = $room->images->sortByDesc('is_primary')->sortBy('sort_order')->values();
                @endphp
                <div class="room-gallery" data-total="{{ $allImages->count() }}">
                    <!-- Main Image -->
                    <div class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-premium-lg mb-4 sm:mb-6 group bg-gray-100">
                        @foreach($allImages as $index => $image)
                        <div class="gallery-image absolute inset-0 transition-opacity duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" 
                             data-index="{{ $index }}"
                             style="display: {{ $index === 0 ? 'block' : 'none' }};">
                            <img src="{{ $image->url }}" 
                                 alt="{{ $image->alt_text ?? $room->name . ' - Imagen ' . ($index + 1) }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'"
                                 loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                        </div>
                        @endforeach
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                        
                        <!-- Image Counter -->
                        <div class="absolute top-3 right-3 sm:top-6 sm:right-6 bg-black/60 backdrop-blur-sm text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs sm:text-sm font-semibold z-20">
                            <span class="current-index">1</span> / <span class="total-images">{{ $allImages->count() }}</span>
                        </div>
                        
                        <!-- Navigation Arrows -->
                        <button type="button" class="gallery-prev absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-white/95 backdrop-blur-md rounded-full flex items-center justify-center hover:bg-white transition-all shadow-xl hover:shadow-2xl opacity-0 group-hover:opacity-100 z-10 transform hover:scale-110">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-[#0F0F0F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button type="button" class="gallery-next absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 bg-white/95 backdrop-blur-md rounded-full flex items-center justify-center hover:bg-white transition-all shadow-xl hover:shadow-2xl opacity-0 group-hover:opacity-100 z-10 transform hover:scale-110">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-[#0F0F0F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Thumbnails Gallery - Show All Images -->
                    <div class="mt-4 sm:mt-6">
                        <h3 class="text-base sm:text-lg font-display font-semibold text-[#0F0F0F] mb-3 sm:mb-4">Todas las Imágenes</h3>
                        @if($allImages->count() > 1)
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 sm:gap-3 md:gap-4">
                            @foreach($allImages as $index => $image)
                            <div class="gallery-thumb relative group cursor-pointer transition-all duration-300 {{ $index === 0 ? 'ring-4 ring-[#C9A24D] scale-105 shadow-xl' : 'ring-2 ring-gray-200 hover:ring-[#C9A24D] hover:scale-105 hover:shadow-lg' }} rounded-xl overflow-hidden bg-gray-100"
                                 data-index="{{ $index }}">
                                <div class="aspect-square relative overflow-hidden">
                                    <img src="{{ $image->url }}" 
                                         alt="{{ $image->alt_text ?? $room->name . ' - Imagen ' . ($index + 1) }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'">
                                    <!-- Overlay on hover -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div class="bg-white/90 backdrop-blur-sm rounded-full p-2 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- Active indicator -->
                                    <div class="absolute top-2 left-2 bg-[#C9A24D] text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        {{ $index + 1 }}
                                    </div>
                                    @if($image->is_primary)
                                    <div class="absolute top-2 right-2 bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>Principal</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <p>Esta habitación tiene una imagen disponible</p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const gallery = document.querySelector('.room-gallery');
                    if (!gallery) return;
                    
                    const images = gallery.querySelectorAll('.gallery-image');
                    const thumbs = gallery.querySelectorAll('.gallery-thumb');
                    const prevBtn = gallery.querySelector('.gallery-prev');
                    const nextBtn = gallery.querySelector('.gallery-next');
                    const currentIndexSpan = gallery.querySelector('.current-index');
                    const totalImages = parseInt(gallery.dataset.total);
                    let currentIndex = 0;
                    
                    function showImage(index) {
                        if (index < 0 || index >= totalImages) return;
                        
                        images.forEach((img, i) => {
                            if (i === index) {
                                img.style.display = 'block';
                                setTimeout(() => img.classList.add('opacity-100'), 10);
                                img.classList.remove('opacity-0');
                            } else {
                                img.classList.add('opacity-0');
                                img.classList.remove('opacity-100');
                                setTimeout(() => {
                                    if (i !== index) img.style.display = 'none';
                                }, 500);
                            }
                        });
                        
                        thumbs.forEach((thumb, i) => {
                            if (i === index) {
                                thumb.classList.add('ring-4', 'ring-[#C9A24D]', 'scale-105', 'shadow-xl');
                                thumb.classList.remove('ring-2', 'ring-gray-200', 'hover:ring-[#C9A24D]');
                            } else {
                                thumb.classList.remove('ring-4', 'ring-[#C9A24D]', 'scale-105', 'shadow-xl');
                                thumb.classList.add('ring-2', 'ring-gray-200');
                            }
                        });
                        
                        // Scroll thumbnail into view if needed
                        if (thumbs[index]) {
                            thumbs[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                        }
                        
                        if (currentIndexSpan) {
                            currentIndexSpan.textContent = index + 1;
                        }
                        
                        currentIndex = index;
                    }
                    
                    if (prevBtn) {
                        prevBtn.addEventListener('click', () => {
                            const newIndex = (currentIndex - 1 + totalImages) % totalImages;
                            showImage(newIndex);
                        });
                    }
                    
                    if (nextBtn) {
                        nextBtn.addEventListener('click', () => {
                            const newIndex = (currentIndex + 1) % totalImages;
                            showImage(newIndex);
                        });
                    }
                    
                    thumbs.forEach((thumb, index) => {
                        thumb.addEventListener('click', () => {
                            showImage(index);
                        });
                    });
                });
                </script>
                @else
                <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl sm:rounded-3xl h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] flex items-center justify-center">
                    <div class="text-center px-4">
                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-gray-400 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        <p class="text-gray-500 text-base sm:text-lg font-medium">No hay imágenes disponibles</p>
                        <p class="text-gray-400 text-xs sm:text-sm mt-2">Las imágenes se agregarán desde el panel de administrador</p>
                    </div>
                </div>
                @endif

                <!-- Room Info -->
                <div class="reveal">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-display font-bold text-[#0F0F0F] mb-3 sm:mb-4 whitespace-normal break-words">{{ $room->formatted_name }}</h1>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 mb-4 sm:mb-6">
                        <div class="flex items-center text-sm sm:text-base text-[#2C2C2C]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-[#C9A24D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.654.07-.98a7.07 7.07 0 00-1.025-3.712M9 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="font-semibold">{{ $room->capacity }} personas</span>
                        </div>
                        @php
                            $avgRating = $room->reviews->count() > 0 ? $room->reviews->avg('rating') : 4.5;
                        @endphp
                        <div class="flex items-center text-sm sm:text-base text-[#2C2C2C]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 text-[#C9A24D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-semibold">{{ number_format($avgRating, 1) }} <span class="hidden sm:inline">({{ $room->reviews->count() }} reseñas)</span><span class="sm:hidden">({{ $room->reviews->count() }})</span></span>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base md:text-lg text-[#2C2C2C] leading-relaxed mb-6 sm:mb-8">{{ $room->description }}</p>
                </div>

                <!-- Services Included Premium -->
                <div class="card-premium p-4 sm:p-6 md:p-8 reveal">
                    <h2 class="text-2xl sm:text-3xl font-display font-bold text-[#0F0F0F] mb-4 sm:mb-6 md:mb-8">Servicios Incluidos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6">
                        @if($room->amenities)
                            @foreach(explode(',', $room->amenities) as $amenity)
                            <div class="flex items-center p-3 sm:p-4 bg-[#F5EFE6] rounded-xl hover:bg-[#C9A24D]/5 transition-colors group">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#C9A24D] mr-2 sm:mr-3 flex-shrink-0 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-xs sm:text-sm md:text-base text-[#2C2C2C] font-medium break-words">{{ trim($amenity) }}</span>
                            </div>
                            @endforeach
                        @else
                            <div class="flex items-center p-4 bg-[#F5EFE6] rounded-xl">
                                <svg class="w-6 h-6 text-[#C9A24D] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                                </svg>
                                <span class="text-[#2C2C2C] font-medium">WiFi</span>
                            </div>
                            <div class="flex items-center p-4 bg-[#F5EFE6] rounded-xl">
                                <svg class="w-6 h-6 text-[#C9A24D] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-[#2C2C2C] font-medium">TV</span>
                            </div>
                            <div class="flex items-center p-4 bg-[#F5EFE6] rounded-xl">
                                <svg class="w-6 h-6 text-[#C9A24D] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-[#2C2C2C] font-medium">Aire Acondicionado</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Guest Reviews Premium -->
                <div class="card-premium p-4 sm:p-6 md:p-8 reveal">
                    <h2 class="text-2xl sm:text-3xl font-display font-bold text-[#0F0F0F] mb-4 sm:mb-6 md:mb-8">Reseñas de Huéspedes</h2>
                    
                    @if($room->reviews->count() > 0)
                    <div class="space-y-4 sm:space-y-6 mb-6 sm:mb-8">
                        @foreach($room->reviews->take(5) as $review)
                        <div class="group relative bg-gradient-to-br from-white via-[#FAF7F2] to-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:border-[#C9A24D]/30 {{ !$review->is_approved ? 'ring-2 ring-yellow-200 bg-yellow-50/50' : '' }}">
                            <!-- Decorative Gold Accent -->
                            <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-[#C9A24D] via-[#D4B366] to-[#B8943F] rounded-l-xl sm:rounded-l-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="flex items-start gap-3 sm:gap-4">
                                <!-- Avatar Circle -->
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-[#C9A24D] via-[#D4B366] to-[#B8943F] flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                                        <span class="text-white font-display font-bold text-lg sm:text-xl">
                                            {{ strtoupper(substr($review->guest_name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header: Name, Status, Date -->
                                    <div class="flex items-start justify-between mb-2 sm:mb-3 flex-wrap gap-2">
                                        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                                            <h4 class="font-display font-bold text-base sm:text-lg md:text-xl text-[#0F0F0F] break-words">{{ $review->guest_name }}</h4>
                                            @if(!$review->is_approved)
                                            <span class="px-2 sm:px-3 py-1 sm:py-1.5 bg-gradient-to-r from-yellow-100 to-yellow-50 text-yellow-800 text-xs font-semibold rounded-full flex items-center gap-1 sm:gap-1.5 shadow-sm border border-yellow-200 whitespace-nowrap">
                                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-xs">Pendiente</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-1 sm:gap-2 text-gray-400 text-xs sm:text-sm">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="whitespace-nowrap">{{ $review->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Star Rating -->
                                    <div class="flex items-center gap-0.5 sm:gap-1 mb-3 sm:mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform duration-200 hover:scale-110 {{ $i <= $review->rating ? 'text-[#C9A24D]' : 'text-gray-300' }}" 
                                             fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" 
                                             stroke="{{ $i <= $review->rating ? 'currentColor' : '#D1D5DB' }}" 
                                             stroke-width="1.5"
                                             viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        @endfor
                                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-semibold text-[#2C2C2C]">{{ $review->rating }}/5</span>
                                    </div>
                                    
                                    <!-- Review Comment -->
                                    <div class="relative">
                                        <p class="text-sm sm:text-base text-[#2C2C2C] leading-relaxed mb-2 font-normal break-words">{{ $review->comment }}</p>
                                        <!-- Quote Icon (Decorative) -->
                                        <div class="absolute -top-2 -left-2 opacity-5 group-hover:opacity-10 transition-opacity duration-300 hidden sm:block">
                                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-[#C9A24D]" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.996 3.638-3.996 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Verified Badge (if approved) -->
                            @if($review->is_approved)
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="flex items-center gap-1 sm:gap-1.5 px-2 sm:px-2.5 py-0.5 sm:py-1 bg-green-50 rounded-full border border-green-200">
                                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-green-700 hidden sm:inline">Verificada</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 sm:py-12">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <p class="text-base sm:text-lg text-gray-500 mb-2">Aún no hay reseñas para esta habitación</p>
                        <p class="text-xs sm:text-sm text-gray-400">Sé el primero en compartir tu experiencia</p>
                    </div>
                    @endif

                    <!-- Formulario de Reseña (Solo para usuarios autenticados) -->
                    @auth
                        @if(!$userHasReviewed)
                        <div class="border-t border-gray-200 pt-6 sm:pt-8 mt-6 sm:mt-8">
                            <h3 class="text-xl sm:text-2xl font-display font-bold text-[#0F0F0F] mb-4 sm:mb-6">Deja tu Reseña</h3>
                            
                            @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-red-800 font-semibold mb-2">Por favor corrige los siguientes errores:</p>
                                        <ul class="list-disc list-inside text-sm text-red-700">
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                
                                <!-- Calificación por Estrellas -->
                                <div>
                                    <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-2 sm:mb-3">Tu Calificación *</label>
                                    <div class="flex items-center space-x-1 sm:space-x-2" id="rating-container">
                                        @for($i = 1; $i <= 5; $i++)
                                        <button type="button" 
                                                class="star-rating-btn w-10 h-10 sm:w-12 sm:h-12 p-0 border-0 bg-transparent cursor-pointer transition-transform hover:scale-110 focus:outline-none"
                                                data-rating="{{ $i }}"
                                                aria-label="{{ $i }} estrella{{ $i > 1 ? 's' : '' }}">
                                            <svg class="w-10 h-10 sm:w-12 sm:h-12 star-icon" 
                                                 fill="none" 
                                                 stroke="currentColor" 
                                                 viewBox="0 0 20 20"
                                                 data-rating="{{ $i }}">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="rating-input" value="" required>
                                    <p class="text-xs text-gray-500 mt-1 sm:mt-2" id="rating-text">Selecciona una calificación</p>
                                    @error('rating')
                                    <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Comentario -->
                                <div>
                                    <label for="comment" class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-2">Tu Comentario *</label>
                                    <textarea name="comment" 
                                              id="comment" 
                                              rows="4" 
                                              required
                                              minlength="10"
                                              maxlength="1000"
                                              class="input-premium w-full resize-y text-sm sm:text-base @error('comment') border-red-300 @enderror"
                                              placeholder="Comparte tu experiencia en esta habitación... (mínimo 10 caracteres)">{{ old('comment') }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1 sm:mt-2">
                                        <span id="char-count">0</span> / 1000 caracteres
                                    </p>
                                    @error('comment')
                                    <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-premium w-full">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    Enviar Reseña
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <div class="bg-[#F5EFE6] p-6 rounded-xl border-2 border-[#C9A24D]/30">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-[#C9A24D] mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <h4 class="font-bold text-[#0F0F0F] mb-1">Ya has dejado una reseña</h4>
                                        <p class="text-sm text-[#2C2C2C]">Gracias por compartir tu experiencia. Tu reseña será revisada antes de publicarse.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                    <div class="border-t border-gray-200 pt-8 mt-8">
                        <div class="bg-gradient-to-r from-[#F5EFE6] to-[#FAF7F2] p-6 rounded-xl border-2 border-[#C9A24D]/30">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-[#C9A24D] mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <div class="flex-1">
                                    <h4 class="font-bold text-[#0F0F0F] mb-2">Inicia sesión para dejar una reseña</h4>
                                    <p class="text-sm text-[#2C2C2C] mb-4">Debes estar registrado para compartir tu experiencia y calificar esta habitación.</p>
                                    <a href="{{ route('login') }}" class="btn-premium inline-flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                        </svg>
                                        Iniciar Sesión
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Right Column - Premium Booking Panel -->
            <div class="lg:col-span-1">
                <div class="card-premium p-4 sm:p-6 md:p-8 sticky top-24 sm:top-32">
                    <!-- Availability Status -->
                    @if(isset($room->availability_status))
                        @if(!$room->availability_status['available'])
                        <div class="mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-red-200">
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-red-800 font-bold text-sm sm:text-base mb-1">Habitación No Disponible</p>
                                        @if(isset($room->availability_status['occupied_until']))
                                            <p class="text-red-700 text-xs sm:text-sm">Ocupada hasta el <strong>{{ $room->availability_status['occupied_until'] }}</strong></p>
                                            <p class="text-red-600 text-xs mt-1">Disponible a partir del <strong>{{ $room->availability_status['occupied_until'] }}</strong></p>
                                        @elseif(isset($room->availability_status['next_available_date']))
                                            <p class="text-red-700 text-xs sm:text-sm">Disponible a partir del <strong>{{ $room->availability_status['next_available_date'] }}</strong></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-green-200">
                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="text-green-800 font-bold text-sm sm:text-base">Habitación Disponible</p>
                                        <p class="text-green-700 text-xs sm:text-sm mt-1">Puedes hacer tu reserva ahora</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                    
                    <!-- Price -->
                    <div class="mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-gray-200">
                        <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">S/ {{ number_format($room->price_per_night, 0) }}</div>
                        <div class="text-[#2C2C2C] text-base sm:text-lg">por noche</div>
                    </div>

                    <!-- Check-in/Check-out -->
                    <div class="mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-gray-200">
                        <div class="flex items-start">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#F5EFE6] rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="text-sm sm:text-base text-[#2C2C2C]">
                                <div class="font-semibold mb-1">Check-in: 12:00 p.m.</div>
                                <div class="font-semibold">Check-out: 12:00 p.m.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Form -->
                    <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm" class="space-y-4 sm:space-y-6 mb-6 sm:mb-8">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        @if(isset($room->availability_status) && !$room->availability_status['available'])
                            @php
                                $minDate = isset($room->availability_status['next_available_date_raw']) 
                                    ? $room->availability_status['next_available_date_raw'] 
                                    : (isset($room->availability_status['occupied_until_raw']) 
                                        ? date('Y-m-d', strtotime($room->availability_status['occupied_until_raw'] . ' +1 day'))
                                        : date('Y-m-d', strtotime('+1 day')));
                            @endphp
                        @else
                            @php
                                $minDate = date('Y-m-d', strtotime('+1 day'));
                            @endphp
                        @endif
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Fecha de Entrada</label>
                            <input type="date" 
                                   name="check_in" 
                                   id="check_in"
                                   min="{{ $minDate }}"
                                   @if(isset($room->availability_status) && !$room->availability_status['available'])
                                   value="{{ $minDate }}"
                                   @endif
                                   required
                                   class="input-premium text-sm sm:text-base {{ isset($room->availability_status) && !$room->availability_status['available'] ? 'bg-gray-100' : '' }}"
                                   @if(isset($room->availability_status) && !$room->availability_status['available']) readonly @endif>
                            @if(isset($room->availability_status) && !$room->availability_status['available'])
                            <p class="text-xs text-gray-500 mt-1">La fecha mínima es {{ isset($room->availability_status['next_available_date']) ? $room->availability_status['next_available_date'] : (isset($room->availability_status['occupied_until']) ? $room->availability_status['occupied_until'] : 'mañana') }}</p>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Fecha de Salida</label>
                            <input type="date" 
                                   name="check_out" 
                                   id="check_out"
                                   min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                                   required
                                   class="input-premium text-sm sm:text-base">
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Huéspedes</label>
                            <input type="number" 
                                   name="guests" 
                                   min="1" 
                                   max="{{ $room->capacity }}"
                                   value="1"
                                   required
                                   class="input-premium text-sm sm:text-base">
                        </div>
                        
                        <div id="priceDisplay" class="bg-gradient-to-br from-[#F5EFE6] to-[#C9A24D]/10 p-4 sm:p-6 rounded-xl border-2 border-[#C9A24D]/30">
                            <div class="flex justify-between items-center mb-1 sm:mb-2">
                                <span class="text-xs sm:text-sm font-semibold text-[#2C2C2C]">Total estimado:</span>
                                <span class="text-xl sm:text-2xl font-display font-bold text-[#C9A24D]" id="totalPrice">S/ 0.00</span>
                            </div>
                            <p class="text-xs text-gray-500" id="nightsInfo">0 noches</p>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Nombre Completo *</label>
                            <input type="text" 
                                   name="guest_name" 
                                   value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                   required
                                   class="input-premium text-sm sm:text-base"
                                   placeholder="Ingresa tu nombre completo">
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Email *</label>
                            <input type="email" 
                                   name="guest_email" 
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                   required
                                   class="input-premium text-sm sm:text-base"
                                   placeholder="tu@email.com">
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Teléfono</label>
                            <input type="tel" 
                                   name="guest_phone" 
                                   value="{{ auth()->check() ? auth()->user()->phone : '' }}"
                                   class="input-premium text-sm sm:text-base"
                                   placeholder="+51 999 999 999">
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-[#0F0F0F] mb-1 sm:mb-2">Solicitudes Especiales (Opcional)</label>
                            <textarea name="special_requests" 
                                      rows="3"
                                      class="input-premium text-sm sm:text-base resize-y"
                                      placeholder="Comentarios adicionales sobre tu reserva..."></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="btn-premium w-full text-sm sm:text-base py-2.5 sm:py-3 {{ isset($room->availability_status) && !$room->availability_status['available'] ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if(isset($room->availability_status) && !$room->availability_status['available']) disabled @endif>
                            @if(isset($room->availability_status) && !$room->availability_status['available'])
                                No Disponible
                            @else
                                Reservar Ahora
                            @endif
                        </button>
                        
                        @guest
                        <p class="text-xs text-gray-500 text-center mt-2 sm:mt-3 px-2">
                            ¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}" class="text-[#C9A24D] hover:text-[#B8943F] font-semibold underline break-words">
                                Inicia sesión
                            </a> 
                            para una experiencia más rápida
                        </p>
                        @endguest
                    </form>

                    <!-- Benefits -->
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex items-start">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 bg-green-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 mt-0.5 flex-shrink-0">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-[#2C2C2C] leading-relaxed">Cancelación gratuita 24h antes</span>
                        </div>
                        <div class="flex items-start">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 bg-green-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 mt-0.5 flex-shrink-0">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-[#2C2C2C] leading-relaxed">Confirmación inmediata</span>
                        </div>
                        <div class="flex items-start">
                            <div class="w-5 h-5 sm:w-6 sm:h-6 bg-green-100 rounded-full flex items-center justify-center mr-2 sm:mr-3 mt-0.5 flex-shrink-0">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-xs sm:text-sm text-[#2C2C2C] leading-relaxed">Mejor precio garantizado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const priceDisplay = document.getElementById('totalPrice');
    const nightsInfo = document.getElementById('nightsInfo');
    const pricePerNight = {{ $room->price_per_night }};
    
    if (checkIn && checkOut && priceDisplay && nightsInfo) {
        function calculatePrice() {
            if (checkIn.value && checkOut.value) {
                const start = new Date(checkIn.value);
                const end = new Date(checkOut.value);
                
                if (end > start) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const total = pricePerNight * diffDays;
                    
                    priceDisplay.textContent = 'S/ ' + total.toFixed(2);
                    nightsInfo.textContent = diffDays + ' noche' + (diffDays !== 1 ? 's' : '');
                } else {
                    priceDisplay.textContent = 'S/ 0.00';
                    nightsInfo.textContent = '0 noches';
                }
            } else {
                priceDisplay.textContent = 'S/ 0.00';
                nightsInfo.textContent = '0 noches';
            }
        }
        
        if (checkIn) {
            checkIn.addEventListener('change', function() {
                if (checkOut.value && new Date(checkOut.value) <= new Date(checkIn.value)) {
                    const nextDay = new Date(checkIn.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    checkOut.value = nextDay.toISOString().split('T')[0];
                    checkOut.min = nextDay.toISOString().split('T')[0];
                }
                calculatePrice();
            });
        }
        
        if (checkOut) {
            checkOut.addEventListener('change', function() {
                calculatePrice();
                checkAvailability();
            });
        }
        
        // Verificar disponibilidad en tiempo real
        async function checkAvailability() {
            if (!checkIn.value || !checkOut.value) return;
            
            try {
                const response = await fetch('{{ route("reservations.check") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        room_id: {{ $room->id }},
                        check_in: checkIn.value,
                        check_out: checkOut.value
                    })
                });
                
                const data = await response.json();
                
                // Mostrar mensaje de disponibilidad
                let availabilityMsg = document.getElementById('availability-message');
                if (!availabilityMsg) {
                    availabilityMsg = document.createElement('div');
                    availabilityMsg.id = 'availability-message';
                    availabilityMsg.className = 'mt-2 text-sm';
                    checkOut.parentElement.appendChild(availabilityMsg);
                }
                
                if (data.available) {
                    availabilityMsg.className = 'mt-2 text-sm text-green-600 font-semibold';
                    availabilityMsg.innerHTML = '<svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Disponible para estas fechas';
                } else {
                    availabilityMsg.className = 'mt-2 text-sm text-red-600 font-semibold';
                    availabilityMsg.innerHTML = '<svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg> No disponible para estas fechas';
                }
            } catch (error) {
                console.error('Error al verificar disponibilidad:', error);
            }
        }
        
        // Verificar disponibilidad cuando cambia la fecha de entrada
        if (checkIn) {
            checkIn.addEventListener('change', function() {
                if (checkOut.value) {
                    checkAvailability();
                }
            });
        }
    }
    
    // Scroll Reveal
    const reveals = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    reveals.forEach(reveal => {
        revealObserver.observe(reveal);
    });

    // Sistema de Calificación por Estrellas
    const ratingContainer = document.getElementById('rating-container');
    const ratingInput = document.getElementById('rating-input');
    const ratingText = document.getElementById('rating-text');
    
    if (ratingContainer && ratingInput && ratingText) {
        let selectedRating = 0;
        const stars = ratingContainer.querySelectorAll('.star-icon');
        
        stars.forEach((star, index) => {
            const rating = index + 1;
            
            star.addEventListener('mouseenter', function() {
                highlightStars(rating);
            });
            
            star.addEventListener('click', function() {
                selectedRating = rating;
                ratingInput.value = rating;
                highlightStars(rating);
                updateRatingText(rating);
            });
        });
        
        ratingContainer.addEventListener('mouseleave', function() {
            if (selectedRating > 0) {
                highlightStars(selectedRating);
            } else {
                highlightStars(0);
            }
        });
        
        function highlightStars(rating) {
            stars.forEach((star, index) => {
                const starRating = index + 1;
                if (starRating <= rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-[#C9A24D]');
                    star.setAttribute('fill', 'currentColor');
                } else {
                    star.classList.remove('text-[#C9A24D]');
                    star.classList.add('text-gray-300');
                    star.setAttribute('fill', 'none');
                }
            });
        }
        
        function updateRatingText(rating) {
            const texts = {
                1: 'Muy malo',
                2: 'Malo',
                3: 'Regular',
                4: 'Bueno',
                5: 'Excelente'
            };
            ratingText.textContent = texts[rating] || 'Selecciona una calificación';
        }
        
        // Restaurar calificación si hay un valor anterior (por ejemplo, después de un error de validación)
        @if(old('rating'))
        selectedRating = {{ old('rating') }};
        ratingInput.value = selectedRating;
        highlightStars(selectedRating);
        updateRatingText(selectedRating);
        @endif
    }

    // Contador de Caracteres para el Comentario
    const commentTextarea = document.getElementById('comment');
    const charCount = document.getElementById('char-count');
    
    if (commentTextarea && charCount) {
        function updateCharCount() {
            const length = commentTextarea.value.length;
            charCount.textContent = length;
            
            if (length < 10) {
                charCount.classList.remove('text-green-600', 'text-gray-500');
                charCount.classList.add('text-red-600');
            } else if (length >= 10 && length < 900) {
                charCount.classList.remove('text-red-600', 'text-gray-500');
                charCount.classList.add('text-green-600');
            } else {
                charCount.classList.remove('text-red-600', 'text-green-600');
                charCount.classList.add('text-gray-500');
            }
        }
        
        commentTextarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Inicializar contador
    }
});
</script>
@endsection
