@extends('layouts.app')

@section('title', 'Habitaciones Premium - Hostal Real La Molina')

@section('content')
<!-- Hero Header Premium -->
<section class="relative h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] flex items-center justify-center overflow-hidden">
    <!-- Background Image with Parallax Effect -->
    <div class="absolute inset-0">
        @php
            $heroImage = asset('img/carrusel foto 1.jpeg');
            if (!file_exists(public_path('img/carrusel foto 1.jpeg'))) {
                $heroImage = 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1920';
            }
        @endphp
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transform scale-105 transition-transform duration-700 hover:scale-100" 
             style="background-image: url('{{ $heroImage }}');"></div>
        <!-- Multiple Gradient Overlays for Depth -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#0F0F0F]/95 via-[#0F0F0F]/80 to-[#0F0F0F]/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F0F0F] via-transparent to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F0F0F]/50 via-transparent to-[#0F0F0F]/50"></div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 sm:top-20 left-5 sm:left-10 w-20 h-20 sm:w-32 sm:h-32 border-2 border-[#C9A24D]/20 rounded-full opacity-50 animate-pulse"></div>
    <div class="absolute bottom-10 sm:bottom-20 right-5 sm:right-10 w-16 h-16 sm:w-24 sm:h-24 border-2 border-[#C9A24D]/30 rounded-full opacity-30"></div>
    <div class="absolute top-1/2 right-5 sm:right-20 w-12 h-12 sm:w-16 sm:h-16 border border-[#C9A24D]/20 rounded-full opacity-40"></div>
    
    <!-- Content -->
    <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
        <!-- Badge -->
        <div class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-[#C9A24D]/20 backdrop-blur-sm rounded-full mb-4 sm:mb-6 md:mb-8 border border-[#C9A24D]/30 animate-fade-in">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-[#C9A24D]" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
            </svg>
            <span class="text-[#C9A24D] font-semibold text-xs sm:text-sm uppercase tracking-wider">Explora Nuestras</span>
        </div>
        
        <!-- Main Title -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-display font-bold mb-4 sm:mb-6 animate-fade-in" style="animation-delay: 0.2s;">
            <span class="block text-white drop-shadow-2xl">Nuestras</span>
            <span class="block text-[#C9A24D] drop-shadow-2xl mt-1 sm:mt-2 bg-gradient-to-r from-[#C9A24D] via-[#D4B366] to-[#C9A24D] bg-clip-text text-transparent animate-gradient">
                Habitaciones
            </span>
        </h1>
        
        <!-- Subtitle -->
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-4 sm:mb-6 md:mb-8 max-w-2xl mx-auto leading-relaxed px-2 animate-slide-up" style="animation-delay: 0.4s;">
            Encuentra la habitación perfecta para tu estadía
        </p>
        
        <!-- Decorative Line -->
        <div class="flex items-center justify-center gap-2 sm:gap-4 mb-4 sm:mb-6 md:mb-8 animate-fade-in" style="animation-delay: 0.6s;">
            <div class="h-px w-8 sm:w-16 bg-gradient-to-r from-transparent to-[#C9A24D]"></div>
            <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#C9A24D]"></div>
            <div class="h-px w-8 sm:w-16 bg-gradient-to-l from-transparent to-[#C9A24D]"></div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 sm:gap-6 md:gap-8 max-w-2xl mx-auto px-2 animate-slide-up" style="animation-delay: 0.8s;">
            <div class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">{{ $totalRooms ?? \App\Models\Room::where('is_available', true)->count() }}</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Habitaciones</div>
            </div>
            <div class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">{{ number_format($avgRating ?? 5.0, 1) }}★</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Calificación</div>
            </div>
            <div class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">24/7</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Disponible</div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-5 sm:bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<div class="bg-white min-h-screen py-6 sm:py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 md:gap-8">
            <!-- Premium Sidebar Filters -->
            <aside class="lg:w-80 flex-shrink-0">
                <div class="card-premium p-4 sm:p-6 sticky top-24 sm:top-32">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">Filtros</h2>
                        <a href="{{ route('rooms.index') }}" 
                           class="text-sm text-[#C9A24D] hover:text-[#B8943F] font-semibold transition-colors">
                            Limpiar
                        </a>
                    </div>
                    
                    <form method="GET" action="{{ route('rooms.index') }}" class="space-y-8" 
                          x-data="{
                              minPriceLimit: {{ $minPrice ?? 70 }},
                              maxPriceLimit: {{ $maxPrice ?? 500 }},
                              minPrice: {{ request('min_price', $minPrice ?? 70) }},
                              maxPrice: {{ request('max_price', $maxPrice ?? 500) }},
                              roomType: '{{ request('room_type', '') }}',
                              minRating: '{{ request('min_rating', '') }}',
                              submitForm() {
                                  // Asegurar que los valores estén dentro del rango
                                  if (this.minPrice < this.minPriceLimit) this.minPrice = this.minPriceLimit;
                                  if (this.maxPrice > this.maxPriceLimit) this.maxPrice = this.maxPriceLimit;
                                  if (this.minPrice > this.maxPrice) this.maxPrice = this.minPrice;
                                  this.$el.submit();
                              }
                          }"
                          @change="submitForm()">
                        <!-- Price Range Slider -->
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-4">Precio por noche</label>
                            <div class="space-y-4">
                                <div class="flex justify-between text-sm font-semibold text-[#2C2C2C]">
                                    <span>S/ <span x-text="minPrice"></span></span>
                                    <span>S/ <span x-text="maxPrice"></span></span>
                                </div>
                                <div class="relative h-2 bg-gray-200 rounded-lg">
                                    <div class="absolute h-2 bg-gradient-to-r from-[#C9A24D] to-[#B8943F] rounded-lg" 
                                         :style="'left: ' + (((minPrice - minPriceLimit) / (maxPriceLimit - minPriceLimit)) * 100) + '%; width: ' + (((maxPrice - minPrice) / (maxPriceLimit - minPriceLimit)) * 100) + '%;'"></div>
                                    <input type="range" 
                                           x-model="minPrice"
                                           @input="if (minPrice > maxPrice) maxPrice = minPrice; if (minPrice < minPriceLimit) minPrice = minPriceLimit; submitForm()"
                                           :min="minPriceLimit" 
                                           :max="maxPriceLimit" 
                                           step="10"
                                           class="absolute w-full h-2 bg-transparent appearance-none cursor-pointer z-10">
                                    <input type="range" 
                                           x-model="maxPrice"
                                           @input="if (maxPrice < minPrice) minPrice = maxPrice; if (maxPrice > maxPriceLimit) maxPrice = maxPriceLimit; submitForm()"
                                           :min="minPriceLimit" 
                                           :max="maxPriceLimit" 
                                           step="10"
                                           class="absolute w-full h-2 bg-transparent appearance-none cursor-pointer z-20">
                                </div>
                                <input type="hidden" name="min_price" :value="minPrice">
                                <input type="hidden" name="max_price" :value="maxPrice">
                            </div>
                        </div>
                        
                        <!-- Room Type -->
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-4">Tipo de Habitación</label>
                            <select name="room_type" 
                                    x-model="roomType"
                                    class="input-premium">
                                <option value="">Todas las habitaciones</option>
                                <option value="matrimonial">Matrimonial</option>
                                <option value="simple">Simple</option>
                                <option value="doble">Doble</option>
                                <option value="triple">Triple</option>
                                <option value="cuadruple">Cuádruple</option>
                            </select>
                        </div>
                        
                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-4">Calificación Mínima</label>
                            <select name="min_rating" 
                                    x-model="minRating"
                                    class="input-premium">
                                <option value="">Todas las calificaciones</option>
                                <option value="5">5 estrellas</option>
                                <option value="4">4+ estrellas</option>
                                <option value="3">3+ estrellas</option>
                            </select>
                        </div>
                        
                        <div class="pt-6 border-t border-gray-200 text-center">
                            <p class="text-sm font-bold text-[#0F0F0F]">
                                <span class="text-2xl text-[#C9A24D] font-display">{{ $rooms->count() }}</span>
                                <span class="block mt-1 text-gray-500 font-normal">habitaciones encontradas</span>
                            </p>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Premium Room Cards -->
            <main class="flex-1">
                @if($rooms->count() > 0)
                <div class="space-y-6">
                    @foreach($rooms as $index => $room)
                    <div class="card-premium overflow-hidden group reveal" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="flex flex-col md:flex-row">
                            <!-- Image -->
                            <div class="md:w-2/5 relative h-72 md:h-auto overflow-hidden">
                                @if($room->images->count() > 0)
                                <img src="{{ $room->images->first()->url }}" 
                                     alt="{{ $room->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <span class="text-gray-400">Sin imagen</span>
                                </div>
                                @endif
                                
                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Badges -->
                                <div class="absolute top-6 right-6 flex flex-col gap-2 items-end">
                                    @php
                                        $roomType = strtolower($room->name);
                                        $tag = 'Habitación';
                                        if (str_contains($roomType, 'matrimonial')) {
                                            $tag = 'Matrimonial';
                                        } elseif (str_contains($roomType, 'simple')) {
                                            $tag = 'Simple';
                                        } elseif (str_contains($roomType, 'doble')) {
                                            $tag = 'Doble';
                                        } elseif (str_contains($roomType, 'triple')) {
                                            $tag = 'Triple';
                                        } elseif (str_contains($roomType, 'cuádruple') || str_contains($roomType, 'cuadruple')) {
                                            $tag = 'Cuádruple';
                                        }
                                    @endphp
                                    <span class="bg-[#C9A24D] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        {{ $tag }}
                                    </span>
                                    @if(isset($room->availability_status))
                                        @if($room->availability_status['available'])
                                            <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Disponible
                                            </span>
                                        @else
                                            <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                No Disponible
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="md:w-3/5 p-4 sm:p-6 md:p-8 flex flex-col justify-between min-w-0">
                                <div class="min-w-0">
                                    <h3 class="text-xl sm:text-2xl md:text-3xl font-display font-bold text-[#0F0F0F] mb-3 sm:mb-4 whitespace-normal break-words">{{ $room->formatted_name }}</h3>
                                    
                                    <!-- Details -->
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 mb-3 sm:mb-4">
                                        <span class="flex items-center text-sm sm:text-base text-[#2C2C2C]">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-[#C9A24D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.654.07-.98a7.07 7.07 0 00-1.025-3.712M9 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="font-semibold">{{ $room->capacity }} personas</span>
                                        </span>
                                        @php
                                            $avgRating = $room->reviews->count() > 0 ? $room->reviews->avg('rating') : 4.5;
                                        @endphp
                                        <span class="flex items-center text-sm sm:text-base text-[#2C2C2C]">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 text-[#C9A24D] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="font-semibold">{{ number_format($avgRating, 1) }}</span>
                                        </span>
                                    </div>
                                    
                                    <!-- Availability Info -->
                                    @if(isset($room->availability_status) && !$room->availability_status['available'])
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 rounded-r-lg">
                                        <div class="flex items-start">
                                            <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            <div>
                                                <p class="text-red-800 font-semibold text-sm sm:text-base mb-1">Habitación Ocupada</p>
                                                @if(isset($room->availability_status['occupied_until']))
                                                    <p class="text-red-700 text-xs sm:text-sm">Disponible a partir del <strong>{{ $room->availability_status['occupied_until'] }}</strong></p>
                                                @elseif(isset($room->availability_status['next_available_date']))
                                                    <p class="text-red-700 text-xs sm:text-sm">Disponible a partir del <strong>{{ $room->availability_status['next_available_date'] }}</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Description -->
                                    <p class="text-[#2C2C2C] mb-6 leading-relaxed line-clamp-2">
                                        {{ Str::limit($room->description, 120) }}
                                    </p>
                                    
                                    <!-- Amenities -->
                                    @if($room->amenities)
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @php
                                            $amenities = array_map('trim', explode(',', $room->amenities));
                                            $displayAmenities = array_slice($amenities, 0, 3);
                                            $remaining = count($amenities) - 3;
                                        @endphp
                                        @foreach($displayAmenities as $amenity)
                                        <span class="bg-[#F5EFE6] text-[#2C2C2C] px-4 py-2 rounded-lg text-sm font-medium border border-[#C9A24D]/20">
                                            {{ $amenity }}
                                        </span>
                                        @endforeach
                                        @if($remaining > 0)
                                        <span class="bg-[#C9A24D]/10 text-[#C9A24D] px-4 py-2 rounded-lg text-sm font-semibold border border-[#C9A24D]/30">
                                            +{{ $remaining }} más
                                        </span>
                                        @endif
                                    </div>
                                    @else
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        <span class="bg-[#F5EFE6] text-[#2C2C2C] px-4 py-2 rounded-lg text-sm font-medium border border-[#C9A24D]/20">WiFi</span>
                                        <span class="bg-[#F5EFE6] text-[#2C2C2C] px-4 py-2 rounded-lg text-sm font-medium border border-[#C9A24D]/20">TV</span>
                                        <span class="bg-[#F5EFE6] text-[#2C2C2C] px-4 py-2 rounded-lg text-sm font-medium border border-[#C9A24D]/20">Aire Acondicionado</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Footer -->
                                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                    <div>
                                        <span class="text-3xl font-display font-bold text-[#C9A24D]">S/ {{ number_format($room->price_per_night, 0) }}</span>
                                        <span class="text-gray-500 text-sm block mt-1">por noche</span>
                                    </div>
                                    <a href="{{ route('rooms.show', $room->slug) }}" 
                                       class="bg-[#0F0F0F] text-white px-8 py-3 rounded-lg hover:bg-[#C9A24D] transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:scale-105 inline-flex items-center group">
                                        <span>Ver Detalles</span>
                                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card-premium p-16 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">No se encontraron habitaciones</h3>
                    <p class="text-[#2C2C2C] mb-6">Intenta ajustar los filtros de búsqueda para encontrar más opciones.</p>
                    <a href="{{ route('rooms.index') }}" class="btn-premium-outline inline-flex items-center">
                        <span>Limpiar Filtros</span>
                    </a>
                </div>
                @endif
            </main>
        </div>
    </div>
</div>

<script>
// Scroll Reveal Animation
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
@endsection
