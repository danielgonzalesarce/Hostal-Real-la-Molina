@extends('layouts.app')

@section('title', 'Hostal Real La Molina - Experiencia Premium en La Molina')

@section('content')
<!-- Premium Hero Section with Slider -->
@php
    $carouselImages = [
        asset('img/carrusel foto 1.jpeg'),
        asset('img/carrusel foto 2.jpeg'),
        asset('img/carrusel foto 3.jpeg')
    ];
@endphp
<section class="relative h-screen flex items-center justify-center overflow-hidden hero-carousel" 
         data-images='@json($carouselImages)'>
    <!-- Background Slides -->
    <div class="absolute inset-0 z-0">
        @foreach($carouselImages as $index => $image)
        <div class="carousel-slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
             data-index="{{ $index }}">
            <div class="h-full w-full bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ $image }}');"></div>
        </div>
        @endforeach
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F0F0F] via-[#0F0F0F]/60 to-[#0F0F0F]/40 z-20"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-30 text-center text-white px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
        <div class="mb-8 animate-fade-in">
            <span class="inline-flex items-center px-6 py-3 bg-[#C9A24D]/20 backdrop-blur-md border border-[#C9A24D]/40 rounded-full text-[#C9A24D] text-sm font-semibold shadow-2xl">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                Experiencia Premium
            </span>
        </div>
        
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-display font-bold mb-8 animate-fade-in leading-none">
            <span class="block" style="color: #C9A24D !important;">Hostal Real</span>
            <span class="block mt-2" style="color: #C9A24D !important;">La Molina</span>
        </h1>
        
        <p class="text-2xl md:text-3xl lg:text-4xl mb-12 text-gray-100 animate-slide-up font-light max-w-3xl mx-auto leading-relaxed">
            Elegancia y confort en el corazón de La Molina
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center animate-slide-up">
            <a href="{{ route('rooms.index') }}" 
               class="group btn-premium inline-flex items-center">
                <span>Explorar Habitaciones</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('contact') }}" 
               class="btn-premium-outline inline-flex items-center">
                <span>Contactar</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </a>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30 animate-bounce">
        <div class="flex flex-col items-center text-white/70">
            <span class="text-xs mb-2 font-medium">Desliza</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
    
    <!-- Slide Indicators -->
    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 z-30 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index"
                    class="w-2 h-2 rounded-full transition-all duration-300"
                    :class="currentSlide === index ? 'bg-[#C9A24D] w-8' : 'bg-white/40 hover:bg-white/60'">
            </button>
        </template>
    </div>
</section>

<!-- Welcome Section Premium -->
<section class="section-spacing bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-[#C9A24D]/30 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- Content -->
            <div class="reveal">
                <div class="inline-flex items-center px-4 py-2 bg-[#F5EFE6] rounded-full mb-6">
                    <span class="text-[#C9A24D] font-semibold text-sm uppercase tracking-wider">Bienvenido</span>
                </div>
                <h2 class="text-5xl md:text-6xl font-display font-bold text-[#0F0F0F] mb-8 leading-tight">
                    Una Experiencia<br>
                    <span class="text-[#C9A24D]">Única</span>
                </h2>
                <div class="space-y-6 mb-10">
                    <p class="text-lg text-[#2C2C2C] leading-relaxed">
                        Ubicado estratégicamente en el corazón de <strong class="text-[#0F0F0F] font-semibold">La Molina</strong>, 
                        nuestro hostal boutique premium ofrece una experiencia única de confort y elegancia.
                    </p>
                    <p class="text-lg text-[#2C2C2C] leading-relaxed">
                        A solo <strong class="text-[#C9A24D]">6 km del hipódromo de Monterrico</strong> y 
                        <strong class="text-[#C9A24D]">17 km del aeropuerto Jorge Chávez</strong>. 
                        Cada habitación está diseñada pensando en tu comodidad y bienestar.
                    </p>
                </div>
                
                <!-- Features Grid -->
                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="p-6 bg-[#F5EFE6] rounded-2xl hover:bg-[#C9A24D]/5 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#0F0F0F] mb-2">WiFi Gratuito</h4>
                        <p class="text-sm text-[#2C2C2C]">Alta velocidad en todas las áreas</p>
                    </div>
                    
                    <div class="p-6 bg-[#F5EFE6] rounded-2xl hover:bg-[#C9A24D]/5 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#0F0F0F] mb-2">Recepción 24h</h4>
                        <p class="text-sm text-[#2C2C2C]">Siempre disponible para ti</p>
                    </div>
                    
                    <div class="p-6 bg-[#F5EFE6] rounded-2xl hover:bg-[#C9A24D]/5 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#0F0F0F] mb-2">TV por Cable</h4>
                        <p class="text-sm text-[#2C2C2C]">Entretenimiento premium</p>
                    </div>
                    
                    <div class="p-6 bg-[#F5EFE6] rounded-2xl hover:bg-[#C9A24D]/5 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#0F0F0F] mb-2">Baño Privado</h4>
                        <p class="text-sm text-[#2C2C2C]">Comodidad total</p>
                    </div>
                </div>
                
                <a href="{{ route('rooms.index') }}" 
                   class="btn-premium inline-flex items-center">
                    <span>Explorar Habitaciones</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            
            <!-- Image -->
            <div class="reveal">
                <div class="relative">
                    <div class="absolute -inset-6 bg-gradient-to-r from-[#C9A24D]/20 to-transparent rounded-3xl blur-3xl"></div>
                    <div class="relative aspect-[4/5] rounded-3xl overflow-hidden shadow-premium-lg">
                        <img src="{{ asset('img/fachada.png') }}" 
                             alt="Fachada del Hostal Real La Molina" 
                             class="w-full h-full object-cover hover-zoom">
                    </div>
                    <!-- Decorative Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-[#C9A24D] text-white px-8 py-4 rounded-2xl shadow-2xl">
                        <div class="text-3xl font-display font-bold">6km</div>
                        <div class="text-sm font-medium">Del Hipódromo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms Premium -->
<section class="section-spacing bg-gradient-to-b from-white to-[#F5EFE6]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center px-4 py-2 bg-[#F5EFE6] rounded-full mb-6">
                <span class="text-[#C9A24D] font-semibold text-sm uppercase tracking-wider">Habitaciones</span>
            </div>
            <h2 class="text-5xl md:text-6xl font-display font-bold text-[#0F0F0F] mb-6">
                Habitaciones <span class="text-[#C9A24D]">Destacadas</span>
            </h2>
            <p class="text-xl text-[#2C2C2C] max-w-2xl mx-auto leading-relaxed">
                Descubre nuestras suites más exclusivas, diseñadas para ofrecerte el máximo confort y elegancia
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredRooms as $index => $room)
            <div class="reveal card-premium overflow-hidden group" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="relative h-80 overflow-hidden">
                    @if($room->primaryImage)
                    <img src="{{ $room->primaryImage->url }}" 
                         alt="{{ $room->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @elseif($room->images->count() > 0)
                    <img src="{{ $room->images->first()->url }}" 
                         alt="{{ $room->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <span class="text-gray-400">Sin imagen</span>
                    </div>
                    @endif
                    
                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Badge -->
                    <div class="absolute top-6 right-6">
                        <span class="bg-[#C9A24D] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            Destacada
                        </span>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4 min-w-0">
                        <h3 class="text-xl md:text-2xl font-display font-bold text-[#0F0F0F] whitespace-normal break-words flex-1 min-w-0">{{ $room->formatted_name }}</h3>
                        <div class="flex items-center text-sm text-[#2C2C2C] bg-[#F5EFE6] px-3 py-1.5 rounded-lg">
                            <svg class="w-4 h-4 mr-1.5 text-[#C9A24D]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.654.07-.98a7.07 7.07 0 00-1.025-3.712M9 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $room->capacity }} personas
                        </div>
                    </div>
                    
                    <p class="text-[#2C2C2C] mb-6 line-clamp-2 leading-relaxed min-h-[3rem]">
                        {{ Str::limit($room->description, 100) }}
                    </p>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <div>
                            <span class="text-3xl font-bold text-[#C9A24D]">S/ {{ number_format($room->price_per_night, 0) }}</span>
                            <span class="text-gray-500 text-sm block">/ noche</span>
                        </div>
                        <a href="{{ route('rooms.show', $room->slug) }}" 
                           class="bg-[#0F0F0F] text-white px-6 py-3 rounded-lg hover:bg-[#C9A24D] transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:scale-105">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12 reveal">
            <a href="{{ route('rooms.index') }}" 
               class="inline-flex items-center text-[#C9A24D] hover:text-[#B8943F] font-semibold text-lg transition-colors group">
                <span>Ver Todas las Habitaciones</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Services Premium -->
<section class="section-spacing bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center px-4 py-2 bg-[#F5EFE6] rounded-full mb-6">
                <span class="text-[#C9A24D] font-semibold text-sm uppercase tracking-wider">Servicios</span>
            </div>
            <h2 class="text-5xl md:text-6xl font-display font-bold text-[#0F0F0F] mb-6">
                Nuestros <span class="text-[#C9A24D]">Servicios</span>
            </h2>
            <p class="text-xl text-[#2C2C2C] max-w-2xl mx-auto">
                Todo lo que necesitas para una estancia perfecta y memorable
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center p-10 card-premium hover-lift">
                <div class="w-20 h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3">WiFi Gratuito</h3>
                <p class="text-[#2C2C2C] leading-relaxed">Conexión de alta velocidad en todas las áreas del hostal</p>
            </div>
            
            <div class="text-center p-10 card-premium hover-lift">
                <div class="w-20 h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3">Recepción 24h</h3>
                <p class="text-[#2C2C2C] leading-relaxed">Atención personalizada disponible en todo momento</p>
            </div>
            
            <div class="text-center p-10 card-premium hover-lift">
                <div class="w-20 h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3">Seguridad</h3>
                <p class="text-[#2C2C2C] leading-relaxed">Ambiente seguro y protegido para tu tranquilidad</p>
            </div>
            
            <div class="text-center p-10 card-premium hover-lift">
                <div class="w-20 h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3">Ubicación Estratégica</h3>
                <p class="text-[#2C2C2C] leading-relaxed">Cerca de principales puntos de interés y transporte</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Reviews Premium -->
@if($featuredReviews->count() > 0)
<section class="section-spacing bg-gradient-to-b from-[#F5EFE6] via-white to-[#F5EFE6] relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#C9A24D]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 bg-[#C9A24D]/5 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <div class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-[#C9A24D]/10 to-[#D4B366]/10 rounded-full mb-6 border border-[#C9A24D]/20 shadow-sm">
                <svg class="w-4 h-4 text-[#C9A24D] mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-[#C9A24D] font-semibold text-sm uppercase tracking-wider">Testimonios</span>
            </div>
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-display font-bold text-[#0F0F0F] mb-4 sm:mb-6">
                Lo Que Dicen <span class="text-[#C9A24D]">Nuestros Huéspedes</span>
            </h2>
            <p class="text-lg sm:text-xl text-[#2C2C2C] max-w-2xl mx-auto leading-relaxed">
                Reseñas destacadas de clientes satisfechos que han disfrutado de nuestra hospitalidad
            </p>
        </div>
        
        <div class="max-w-5xl mx-auto">
            <!-- Reviews Carousel Container -->
            <div class="relative">
                <div id="reviewsCarousel" class="relative overflow-hidden rounded-2xl">
                    @foreach($featuredReviews as $index => $review)
                    <div class="review-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                        <div class="card-premium p-8 sm:p-10 md:p-12 text-center relative overflow-hidden group">
                            <!-- Quote Icon -->
                            <div class="absolute top-6 left-6 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-[#C9A24D]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.984zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                            </div>
                            
                            <!-- Stars Rating -->
                            <div class="flex justify-center items-center gap-1 mb-6 relative z-10">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 {{ $i <= $review->rating ? 'text-[#C9A24D]' : 'text-gray-300' }}" 
                                     fill="{{ $i <= $review->rating ? 'currentColor' : 'none' }}" 
                                     stroke="currentColor" 
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            
                            <!-- Review Comment -->
                            <blockquote class="text-lg sm:text-xl md:text-2xl text-[#2C2C2C] italic mb-8 leading-relaxed relative z-10 px-4">
                                "{{ $review->comment }}"
                            </blockquote>
                            
                            <!-- Reviewer Info -->
                            <div class="relative z-10">
                                <div class="flex items-center justify-center mb-2">
                                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-[#C9A24D] to-[#D4B366] rounded-full flex items-center justify-center shadow-lg">
                                        <span class="text-white font-display font-bold text-lg sm:text-xl">
                                            {{ strtoupper(substr($review->guest_name, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <h4 class="font-display font-bold text-[#0F0F0F] text-lg sm:text-xl mb-1">
                                    {{ $review->guest_name }}
                                </h4>
                                @if($review->room)
                                <p class="text-sm sm:text-base text-gray-500 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    {{ $review->room->formatted_name ?? $review->room->name }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows -->
                <button id="prevReview" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 sm:-translate-x-6 md:-translate-x-8 w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-full shadow-xl flex items-center justify-center text-[#C9A24D] hover:bg-[#C9A24D] hover:text-white transition-all duration-300 z-20 group">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="nextReview" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 sm:translate-x-6 md:translate-x-8 w-12 h-12 sm:w-14 sm:h-14 bg-white rounded-full shadow-xl flex items-center justify-center text-[#C9A24D] hover:bg-[#C9A24D] hover:text-white transition-all duration-300 z-20 group">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Review Indicators -->
            <div class="flex justify-center items-center gap-2 sm:gap-3 mt-8 sm:mt-10">
                @foreach($featuredReviews as $index => $review)
                <button class="review-indicator w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'active' : '' }}"
                        data-index="{{ $index }}"
                        aria-label="Ir a reseña {{ $index + 1 }}">
                </button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.review-slide {
    display: none;
    animation: fadeIn 0.6s ease-in-out;
}

.review-slide.active {
    display: block;
}

.review-indicator {
    background-color: #d1d5db;
    cursor: pointer;
}

.review-indicator:hover {
    background-color: #9ca3af;
}

.review-indicator.active {
    background-color: #C9A24D;
    width: 2rem;
}

@media (min-width: 640px) {
    .review-indicator.active {
        width: 2.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.review-slide');
    const indicators = document.querySelectorAll('.review-indicator');
    const prevBtn = document.getElementById('prevReview');
    const nextBtn = document.getElementById('nextReview');
    let currentIndex = 0;
    let autoPlayInterval;

    function showSlide(index) {
        // Remove active class from all slides and indicators
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));

        // Add active class to current slide and indicator
        if (slides[index]) {
            slides[index].classList.add('active');
        }
        if (indicators[index]) {
            indicators[index].classList.add('active');
        }

        currentIndex = index;
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', () => {
        nextSlide();
        stopAutoPlay();
        startAutoPlay();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        stopAutoPlay();
        startAutoPlay();
    });

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
            stopAutoPlay();
            startAutoPlay();
        });
    });

    // Start auto-play
    startAutoPlay();

    // Pause on hover
    const carousel = document.getElementById('reviewsCarousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoPlay);
        carousel.addEventListener('mouseleave', startAutoPlay);
    }
});
</script>
@endif

<!-- Location Section Premium -->
<section class="section-spacing bg-[#0F0F0F] text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-[#0F0F0F] via-[#1a1a1a] to-[#0F0F0F]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <div class="inline-flex items-center px-4 py-2 bg-[#C9A24D]/20 rounded-full mb-6">
                    <span class="text-[#C9A24D] font-semibold text-sm uppercase tracking-wider">Ubicación</span>
                </div>
                <h2 class="text-5xl md:text-6xl font-display font-bold mb-6 text-[#C9A24D]">
                    Encuéntranos
                </h2>
                <p class="text-2xl mb-6 text-gray-200 leading-relaxed font-light">
                    Av. La Molina 688<br>La Molina, Lima, Perú
                </p>
                <p class="text-lg text-gray-400 mb-10 leading-relaxed">
                    Ubicado estratégicamente en el corazón de La Molina, a solo 
                    <strong class="text-white">6 km del hipódromo de Monterrico</strong> 
                    y <strong class="text-white">17 km del aeropuerto Jorge Chávez</strong>. 
                    Fácil acceso y excelente conectividad para tus desplazamientos.
                </p>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all group">
                        <div class="w-14 h-14 bg-[#C9A24D]/20 rounded-xl flex items-center justify-center mr-5 group-hover:bg-[#C9A24D] transition-colors">
                            <svg class="w-7 h-7 text-[#C9A24D] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-white text-lg">6 km del Hipódromo de Monterrico</p>
                            <p class="text-sm text-gray-400">Acceso rápido y directo</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all group">
                        <div class="w-14 h-14 bg-[#C9A24D]/20 rounded-xl flex items-center justify-center mr-5 group-hover:bg-[#C9A24D] transition-colors">
                            <svg class="w-7 h-7 text-[#C9A24D] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-white text-lg">17 km del Aeropuerto Jorge Chávez</p>
                            <p class="text-sm text-gray-400">Conveniente para viajeros</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all group">
                        <div class="w-14 h-14 bg-[#C9A24D]/20 rounded-xl flex items-center justify-center mr-5 group-hover:bg-[#C9A24D] transition-colors">
                            <svg class="w-7 h-7 text-[#C9A24D] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-white text-lg">+51 948 070 603</p>
                            <p class="text-sm text-gray-400">Disponible 24/7</p>
                        </div>
                    </div>
                </div>
                
                <a href="https://maps.google.com/?q=Av.+La+Molina+688,+La+Molina,+Lima" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="btn-premium inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Ver en Google Maps
                </a>
            </div>
            
            <div class="reveal">
                <div class="relative">
                    <div class="absolute -inset-6 bg-[#C9A24D]/20 rounded-3xl blur-3xl"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-2 border-[#C9A24D]/20">
                        <iframe 
                            src="https://www.google.com/maps?q=Av.+La+Molina+688,+La+Molina,+Lima,+Peru&output=embed" 
                            width="100%" 
                            height="500" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="w-full">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
    
    // Hero Carousel
    const carousel = document.querySelector('.hero-carousel');
    if (carousel) {
        const slides = carousel.querySelectorAll('.carousel-slide');
        let currentSlide = 0;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                }
            });
        }
        
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 5000);
    }
});
</script>
@endsection
