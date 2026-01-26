@extends('layouts.app')

@section('title', 'Contacto - Hostal Real La Molina')

@section('content')
<!-- Hero Header Premium -->
<section class="relative h-[400px] sm:h-[500px] md:h-[600px] lg:h-[650px] flex items-center justify-center overflow-hidden">
    <!-- Background Image with Parallax Effect -->
    <div class="absolute inset-0">
        @php
            $heroImage = asset('img/carrusel foto 2.jpeg');
            if (!file_exists(public_path('img/carrusel foto 2.jpeg'))) {
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
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span class="text-[#C9A24D] font-semibold text-xs sm:text-sm uppercase tracking-wider">Estamos Aquí</span>
        </div>
        
        <!-- Main Title -->
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-display font-bold mb-4 sm:mb-6 animate-fade-in" style="animation-delay: 0.2s;">
            <span class="block text-white drop-shadow-2xl">Contáctanos</span>
        </h1>
        
        <!-- Subtitle -->
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-200 mb-4 sm:mb-6 md:mb-8 max-w-2xl mx-auto leading-relaxed px-2 animate-slide-up" style="animation-delay: 0.4s;">
            Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos lo antes posible.
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
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">24/7</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Disponible</div>
            </div>
            <div class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">+51</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Teléfono</div>
            </div>
            <div class="text-center">
                <div class="text-2xl sm:text-3xl md:text-4xl font-display font-bold text-[#C9A24D] mb-1 sm:mb-2">100%</div>
                <div class="text-xs sm:text-sm text-gray-300 uppercase tracking-wider">Respuesta</div>
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
            <!-- Premium Sidebar - Contact Info -->
            <aside class="lg:w-80 flex-shrink-0">
                <div class="card-premium p-4 sm:p-6 sticky top-24 sm:top-32">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">Información</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Contact Information -->
                        <div class="space-y-4">
                            <div class="flex items-start p-4 bg-gradient-to-br from-[#F5EFE6] to-white rounded-xl hover:shadow-lg transition-all group">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mr-3 flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-bold text-[#0F0F0F] mb-1">Dirección</h3>
                                    <p class="text-xs text-[#2C2C2C] leading-relaxed break-words">Av. La Molina 688<br>La Molina, Lima, Perú</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-gradient-to-br from-[#F5EFE6] to-white rounded-xl hover:shadow-lg transition-all group">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mr-3 flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-bold text-[#0F0F0F] mb-1">Teléfono</h3>
                                    <a href="tel:+51948070603" class="text-base text-[#C9A24D] hover:text-[#B8943F] font-bold transition-colors block break-words">
                                        +51 948 070 603
                                    </a>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-4 bg-gradient-to-br from-[#F5EFE6] to-white rounded-xl hover:shadow-lg transition-all group">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center mr-3 flex-shrink-0 group-hover:scale-110 transition-transform shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0 pr-2">
                                    <h3 class="text-sm font-bold text-[#0F0F0F] mb-1">Email</h3>
                                    <a href="mailto:hostalreallamolina@hotmail.com" 
                                       class="text-xs text-[#2C2C2C] hover:text-[#C9A24D] transition-colors block break-all"
                                       style="word-break: break-all; overflow-wrap: break-word; max-width: 100%;">
                                        hostalreallamolina@hotmail.com
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Business Hours -->
                        <div class="pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-display font-bold text-[#0F0F0F] mb-4">Horarios</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-gradient-to-r from-[#F5EFE6] to-white rounded-xl">
                                    <span class="font-semibold text-sm text-[#0F0F0F]">Lunes - Domingo</span>
                                    <span class="text-xs text-[#2C2C2C] font-medium">12:00 AM - 12:00 PM</span>
                                </div>
                                <div class="flex items-center justify-center p-3 bg-gradient-to-r from-green-50 to-green-100/50 rounded-xl border border-green-200">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                        <span class="text-xs text-green-700 font-semibold">Disponible 24 horas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content: Form and Additional Info -->
            <main class="flex-1 space-y-6 sm:space-y-8">
                <!-- Premium Contact Form -->
                <div class="card-premium p-6 sm:p-8 md:p-10 reveal shadow-2xl border-2 border-[#C9A24D]/10 overflow-hidden">
                    <div class="mb-6 sm:mb-8 md:mb-10">
                        <div class="inline-flex items-center px-4 sm:px-5 py-2 sm:py-2.5 bg-gradient-to-r from-[#F5EFE6] to-[#FAF7F2] rounded-full mb-4 sm:mb-6 border border-[#C9A24D]/20">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-[#C9A24D] font-semibold text-xs sm:text-sm uppercase tracking-wider">Mensaje</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-display font-bold text-[#0F0F0F] mb-3 sm:mb-4">
                            Envíanos un Mensaje
                        </h2>
                        <p class="text-[#2C2C2C] text-sm sm:text-base md:text-lg leading-relaxed">Completa el formulario y nos pondremos en contacto contigo lo antes posible</p>
                    </div>
                
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="group">
                            <label for="name" class="block text-sm font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Nombre Completo
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   class="input-premium focus:ring-2 focus:ring-[#C9A24D]/50 focus:border-[#C9A24D] transition-all"
                                   placeholder="Juan Pérez">
                        </div>
                        
                        <div class="group">
                            <label for="email" class="block text-sm font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Email
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="input-premium focus:ring-2 focus:ring-[#C9A24D]/50 focus:border-[#C9A24D] transition-all"
                                   placeholder="tu@email.com">
                        </div>
                        
                        <div class="group">
                            <label for="phone" class="block text-sm font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Teléfono
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone"
                                   class="input-premium focus:ring-2 focus:ring-[#C9A24D]/50 focus:border-[#C9A24D] transition-all"
                                   placeholder="+51 999 999 999">
                        </div>
                        
                        <div class="group">
                            <label for="message" class="block text-sm font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Mensaje
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="6" 
                                      required
                                      class="input-premium resize-none focus:ring-2 focus:ring-[#C9A24D]/50 focus:border-[#C9A24D] transition-all"
                                      placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn-premium w-full group relative overflow-hidden shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300">
                            <span class="relative z-10 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Enviar Mensaje
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#B8943F] to-[#C9A24D] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </form>
                </div>

                <!-- Social Media -->
                <div class="card-premium p-4 sm:p-6 md:p-8 reveal overflow-hidden">
                    <h2 class="text-2xl sm:text-3xl font-display font-bold text-[#0F0F0F] mb-4 sm:mb-6">Síguenos en Redes Sociales</h2>
                    <p class="text-sm sm:text-base text-[#2C2C2C] mb-4 sm:mb-6">Mantente conectado con nosotros y descubre nuestras últimas promociones y novedades.</p>
                    <div class="flex space-x-4">
                        @php
                            $facebookUrl = \App\Models\SiteSetting::get('social_facebook', 'https://www.facebook.com/hostalreallamolina/');
                            $instagramUrl = \App\Models\SiteSetting::get('social_instagram', 'https://www.instagram.com/hostalreallamolinaa/');
                            $whatsappUrl = \App\Models\SiteSetting::get('contact_whatsapp', '51948070603');
                        @endphp
                        
                        @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="flex-1 flex flex-col items-center justify-center p-6 bg-gradient-to-br from-[#1877F2] to-[#166FE5] rounded-xl hover:shadow-xl transition-all transform hover:scale-105 group">
                            <svg class="w-8 h-8 text-white mb-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-white font-semibold">Facebook</span>
                        </a>
                        @endif
                        
                        @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="flex-1 flex flex-col items-center justify-center p-6 bg-gradient-to-br from-[#E4405F] via-[#C13584] to-[#833AB4] rounded-xl hover:shadow-xl transition-all transform hover:scale-105 group">
                            <svg class="w-8 h-8 text-white mb-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span class="text-white font-semibold">Instagram</span>
                        </a>
                        @endif
                    </div>
                </div>
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
