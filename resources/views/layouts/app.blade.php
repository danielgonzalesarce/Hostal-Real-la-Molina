<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $metaSiteName = \App\Models\SiteSetting::get('site_name', 'Hostal Real La Molina');
        $metaDescription = \App\Models\SiteSetting::get('site_description', 'Experiencia premium en el corazón de La Molina. Habitaciones elegantes, servicio excepcional y confort de lujo.');
    @endphp
    <meta name="description" content="{{ $metaSiteName }} - {{ $metaDescription }}">
    <title>@yield('title', $metaSiteName . ' - Experiencia Premium')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased" x-data="{ mobileMenuOpen: false, scrolled: false }" 
      @scroll.window="scrolled = window.scrollY > 20">
    <!-- Premium Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-out"
         :class="scrolled ? 'bg-white/98 backdrop-blur-lg shadow-xl border-b border-[#C9A24D]/10 py-2' : 'bg-white/95 backdrop-blur-md py-3'">
        <div class="w-full" style="padding-left: 2.5rem; padding-right: 2.5rem;">
            <div class="flex items-center justify-between h-24 md:h-28">
                <!-- Logo Premium - Izquierda a 5cm del borde -->
                <div class="flex items-center flex-shrink-0 animate-slide-in-left">
                    <a href="{{ route('home') }}" class="group flex items-center space-x-3 md:space-x-4">
                        @php
                            $siteLogo = \App\Models\SiteSetting::get('site_logo', '');
                            $siteName = \App\Models\SiteSetting::get('site_name', 'Hostal Real');
                            $siteTagline = \App\Models\SiteSetting::get('site_tagline', 'La Molina');
                            $defaultLogo = asset('img/LogoHostal.png');
                            $logoUrl = null;
                            
                            if ($siteLogo && \Storage::disk('public')->exists($siteLogo)) {
                                $logoUrl = asset('storage/' . $siteLogo) . '?v=' . time();
                            } elseif (file_exists(public_path('img/LogoHostal.png'))) {
                                $logoUrl = $defaultLogo;
                            }
                        @endphp
                        <div class="relative flex-shrink-0">
                            @if($logoUrl)
                            <img src="{{ $logoUrl }}" 
                                 alt="{{ $siteName }}"
                                 class="w-20 h-20 md:w-24 md:h-24 object-contain rounded-xl shadow-xl group-hover:shadow-2xl transition-all duration-500 transform group-hover:scale-105 bg-white p-2 border border-[#C9A24D]/20">
                            @else
                            <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-[#C9A24D] via-[#D4B366] to-[#B8943F] rounded-xl flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-500 transform group-hover:scale-105 group-hover:rotate-3 border border-[#C9A24D]/30">
                                <span class="text-white font-display font-bold text-3xl md:text-4xl drop-shadow-lg">{{ substr($siteName, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-[#C9A24D] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-lg"></div>
                        </div>
                        <div class="hidden sm:block">
                            <div class="text-2xl md:text-3xl font-display font-bold leading-tight tracking-tight" style="color: #C9A24D !important; text-shadow: none !important;">{{ $siteName }}</div>
                            @if($siteTagline)
                            <div class="text-sm md:text-base font-display leading-tight font-medium tracking-wider uppercase mt-1" style="color: #C9A24D !important; text-shadow: none !important;">{{ $siteTagline }}</div>
                            @endif
                        </div>
                    </a>
                </div>
                
                <!-- Menú de Navegación - Centrado con espacio distribuido -->
                <div class="hidden lg:flex items-center justify-center flex-1 mx-8 animate-fade-in">
                    <nav class="flex items-center space-x-12">
                        <a href="{{ route('home') }}" 
                           class="text-[#C9A24D] hover:text-[#B8943F] transition-all duration-300 font-display font-semibold text-lg tracking-wide relative group">
                            <span class="relative z-10">Inicio</span>
                            <span class="absolute -bottom-1 left-0 w-0 h-1 bg-gradient-to-r from-[#C9A24D] via-[#D4B366] to-[#C9A24D] transition-all duration-500 group-hover:w-full rounded-full"></span>
                            <span class="absolute -bottom-1 left-0 w-full h-1 bg-[#C9A24D]/20 rounded-full"></span>
                        </a>
                        <a href="{{ route('rooms.index') }}" 
                           class="text-[#C9A24D] hover:text-[#B8943F] transition-all duration-300 font-display font-semibold text-lg tracking-wide relative group">
                            <span class="relative z-10">Habitaciones</span>
                            <span class="absolute -bottom-1 left-0 w-0 h-1 bg-gradient-to-r from-[#C9A24D] via-[#D4B366] to-[#C9A24D] transition-all duration-500 group-hover:w-full rounded-full"></span>
                            <span class="absolute -bottom-1 left-0 w-full h-1 bg-[#C9A24D]/20 rounded-full"></span>
                        </a>
                        <a href="{{ route('contact') }}" 
                           class="text-[#C9A24D] hover:text-[#B8943F] transition-all duration-300 font-display font-semibold text-lg tracking-wide relative group">
                            <span class="relative z-10">Contacto</span>
                            <span class="absolute -bottom-1 left-0 w-0 h-1 bg-gradient-to-r from-[#C9A24D] via-[#D4B366] to-[#C9A24D] transition-all duration-500 group-hover:w-full rounded-full"></span>
                            <span class="absolute -bottom-1 left-0 w-full h-1 bg-[#C9A24D]/20 rounded-full"></span>
                        </a>
                    </nav>
                </div>
                
                <!-- Elementos Derecha - Redes Sociales, Usuario y Botón Salir -->
                <div class="hidden lg:flex items-center flex-shrink-0 space-x-5 animate-slide-in-right">
                    <!-- Social Media Icons Premium -->
                    @php
                        $facebookUrl = \App\Models\SiteSetting::get('social_facebook', 'https://www.facebook.com/hostalreallamolina/');
                        $instagramUrl = \App\Models\SiteSetting::get('social_instagram', 'https://www.instagram.com/hostalreallamolinaa/');
                    @endphp
                    <div class="flex-shrink-0">
                        <div class="flex flex-col items-center space-y-2">
                            <p class="text-xs text-[#C9A24D] font-semibold tracking-wider uppercase mb-1">Encuéntranos en</p>
                            <div class="flex items-center space-x-2.5 bg-gradient-to-br from-[#F5EFE6]/50 to-[#FAF7F2]/30 px-4 py-2.5 rounded-2xl border border-[#C9A24D]/20 shadow-md backdrop-blur-sm">
                                @if($facebookUrl)
                                <a href="{{ $facebookUrl }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="w-11 h-11 bg-gradient-to-br from-[#1877F2] to-[#166FE5] rounded-xl flex items-center justify-center hover:shadow-2xl transition-all transform hover:scale-110 hover:-translate-y-1 shadow-lg group relative overflow-hidden ring-2 ring-transparent hover:ring-[#1877F2]/30"
                                   aria-label="Síguenos en Facebook"
                                   title="Facebook">
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <svg class="w-5 h-5 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                @endif
                                
                                @if($instagramUrl)
                                <a href="{{ $instagramUrl }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="w-11 h-11 bg-gradient-to-br from-[#E4405F] via-[#C13584] to-[#833AB4] rounded-xl flex items-center justify-center hover:shadow-2xl transition-all transform hover:scale-110 hover:-translate-y-1 shadow-lg group relative overflow-hidden ring-2 ring-transparent hover:ring-[#E4405F]/30"
                                   aria-label="Síguenos en Instagram"
                                   title="Instagram">
                                    <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <svg class="w-5 h-5 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            {{-- Solo mostrar opciones de usuario si NO es admin --}}
                            <a href="{{ route('profile.show') }}" 
                               class="w-11 h-11 bg-gradient-to-br from-[#C9A24D] to-[#D4B366] rounded-full flex items-center justify-center hover:shadow-xl transition-all transform hover:scale-110 hover:-translate-y-1 shadow-lg group relative overflow-hidden ring-2 ring-transparent hover:ring-[#C9A24D]/30 flex-shrink-0"
                               aria-label="Mi Perfil"
                               title="Mi Perfil">
                                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <svg class="w-5 h-5 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline flex-shrink-0">
                                @csrf
                                <button type="submit" 
                                        class="px-5 py-2.5 text-[#2C2C2C] hover:text-white hover:bg-gradient-to-r hover:from-[#C9A24D] hover:to-[#B8943F] transition-all duration-300 font-semibold rounded-xl shadow-md hover:shadow-xl transform hover:scale-105">
                                    Salir
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-6 py-2.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 hover:from-[#B8943F] hover:to-[#C9A24D] relative overflow-hidden group flex-shrink-0">
                            <span class="relative z-10 flex items-center space-x-2">
                                <span>Acceder</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button Premium - Al lado derecho -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="lg:hidden ml-auto p-3 rounded-xl text-[#2C2C2C] hover:bg-gradient-to-r hover:from-[#F5EFE6] hover:to-[#FAF7F2] transition-all duration-300 relative group">
                    <div class="absolute inset-0 bg-[#C9A24D]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <svg class="w-6 h-6 relative z-10 transform transition-transform duration-300" :class="mobileMenuOpen ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu Premium -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform -translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 transform -translate-y-8 scale-95"
             style="display: none;"
             class="lg:hidden border-t-2 border-gradient-to-r from-[#C9A24D]/20 to-transparent bg-white/98 backdrop-blur-xl shadow-2xl">
            <div class="px-6 pt-6 pb-8 space-y-3">
                <a href="{{ route('home') }}" 
                   class="block px-5 py-3.5 text-[#2C2C2C] hover:text-[#C9A24D] hover:bg-gradient-to-r hover:from-[#F5EFE6] hover:to-[#FAF7F2] rounded-xl transition-all duration-300 font-semibold transform hover:translate-x-2 hover:shadow-md relative group">
                    <span class="flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 bg-[#C9A24D] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span>Inicio</span>
                    </span>
                </a>
                <a href="{{ route('rooms.index') }}" 
                   class="block px-5 py-3.5 text-[#2C2C2C] hover:text-[#C9A24D] hover:bg-gradient-to-r hover:from-[#F5EFE6] hover:to-[#FAF7F2] rounded-xl transition-all duration-300 font-semibold transform hover:translate-x-2 hover:shadow-md relative group">
                    <span class="flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 bg-[#C9A24D] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span>Habitaciones</span>
                    </span>
                </a>
                <a href="{{ route('contact') }}" 
                   class="block px-5 py-3.5 text-[#2C2C2C] hover:text-[#C9A24D] hover:bg-gradient-to-r hover:from-[#F5EFE6] hover:to-[#FAF7F2] rounded-xl transition-all duration-300 font-semibold transform hover:translate-x-2 hover:shadow-md relative group">
                    <span class="flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 bg-[#C9A24D] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span>Contacto</span>
                    </span>
                </a>
                
                <!-- Social Media in Mobile Menu Premium -->
                @php
                    $facebookUrl = \App\Models\SiteSetting::get('social_facebook', 'https://www.facebook.com/hostalreallamolina/');
                    $instagramUrl = \App\Models\SiteSetting::get('social_instagram', 'https://www.instagram.com/hostalreallamolinaa/');
                @endphp
                <div class="px-5 py-5 border-t-2 border-[#C9A24D]/10 mt-4">
                    <div class="flex flex-col items-center space-y-3">
                        <p class="text-sm text-[#C9A24D] font-bold tracking-wider uppercase mb-1 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Encuéntranos en</span>
                        </p>
                        <div class="flex items-center space-x-3 bg-gradient-to-br from-[#F5EFE6]/60 to-[#FAF7F2]/40 px-5 py-3.5 rounded-2xl border-2 border-[#C9A24D]/25 shadow-lg backdrop-blur-sm w-full justify-center">
                            @if($facebookUrl)
                            <a href="{{ $facebookUrl }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-[#1877F2] to-[#166FE5] rounded-xl flex items-center justify-center hover:shadow-2xl transition-all transform hover:scale-110 hover:-translate-y-1 shadow-xl group relative overflow-hidden ring-2 ring-transparent hover:ring-[#1877F2]/40"
                               aria-label="Facebook">
                                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <svg class="w-7 h-7 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            @endif
                            
                            @if($instagramUrl)
                            <a href="{{ $instagramUrl }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-[#E4405F] via-[#C13584] to-[#833AB4] rounded-xl flex items-center justify-center hover:shadow-2xl transition-all transform hover:scale-110 hover:-translate-y-1 shadow-xl group relative overflow-hidden ring-2 ring-transparent hover:ring-[#E4405F]/40"
                               aria-label="Instagram">
                                <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <svg class="w-7 h-7 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                
                @auth
                    @if(auth()->user()->role !== 'admin')
                        {{-- Solo mostrar opciones de usuario si NO es admin --}}
                        <a href="{{ route('profile.show') }}" 
                           class="block px-5 py-3.5 text-[#2C2C2C] hover:text-[#C9A24D] hover:bg-gradient-to-r hover:from-[#F5EFE6] hover:to-[#FAF7F2] rounded-xl transition-all duration-300 font-semibold transform hover:translate-x-2 hover:shadow-md relative group">
                            <span class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-[#C9A24D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Mi Perfil</span>
                            </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-5 py-3.5 text-[#2C2C2C] hover:text-white hover:bg-gradient-to-r hover:from-[#C9A24D] hover:to-[#B8943F] rounded-xl transition-all duration-300 font-semibold transform hover:translate-x-2 hover:shadow-md">
                                Salir
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="block px-5 py-3.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] text-white rounded-xl text-center font-bold shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:from-[#B8943F] hover:to-[#C9A24D] relative overflow-hidden group mt-4">
                        <span class="relative z-10 flex items-center justify-center space-x-2">
                            <span>Acceder</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-28 md:pt-32">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-gradient-to-b from-[#0F0F0F] to-[#1a1a1a] text-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-transparent via-[#C9A24D] to-transparent opacity-80"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#C9A24D]/50 to-transparent"></div>
        
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #C9A24D 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-16 mb-20">
                <!-- Brand Column -->
                <div class="lg:col-span-2 reveal reveal-left">
                    @php
                        $footerSiteName = \App\Models\SiteSetting::get('site_name', 'Hostal Real La Molina');
                        $footerSiteTagline = \App\Models\SiteSetting::get('site_tagline', 'La Molina');
                        $footerLogo = \App\Models\SiteSetting::get('site_logo', '');
                        $footerDefaultLogo = asset('img/LogoHostal.png');
                        $footerLogoUrl = null;
                        
                        if ($footerLogo && \Storage::disk('public')->exists($footerLogo)) {
                            $footerLogoUrl = asset('storage/' . $footerLogo) . '?v=' . time();
                        } elseif (file_exists(public_path('img/LogoHostal.png'))) {
                            $footerLogoUrl = $footerDefaultLogo;
                        }
                    @endphp
                    <div class="flex items-center space-x-6 mb-8 group">
                        <div class="relative flex-shrink-0 hover-glow">
                            @if($footerLogoUrl)
                            <img src="{{ $footerLogoUrl }}" 
                                 alt="{{ $footerSiteName }}"
                                 class="w-24 h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 object-contain rounded-2xl shadow-2xl group-hover:shadow-[#C9A24D]/50 transition-all duration-500 transform group-hover:scale-105 bg-white/10 p-2 border border-[#C9A24D]/30 animate-float">
                            @else
                            <div class="w-24 h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 bg-gradient-to-br from-[#C9A24D] via-[#D4B366] to-[#B8943F] rounded-2xl flex items-center justify-center shadow-2xl group-hover:shadow-[#C9A24D]/50 transition-all duration-500 transform group-hover:scale-105 group-hover:rotate-3 border border-[#C9A24D]/40">
                                <span class="text-white font-display font-bold text-4xl md:text-5xl drop-shadow-lg">{{ substr($footerSiteName, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-[#C9A24D] rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-lg"></div>
                        </div>
                        <div>
                            <div class="text-3xl md:text-4xl font-display font-bold text-white mb-2 tracking-tight">{{ $footerSiteName }}</div>
                            @if($footerSiteTagline)
                            <div class="text-base md:text-lg font-display text-[#C9A24D] font-semibold tracking-wider uppercase">{{ $footerSiteTagline }}</div>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-300 leading-relaxed max-w-md mb-8 text-base">
                        Tu experiencia premium en el corazón de La Molina. Confort, elegancia y hospitalidad excepcional en cada detalle.
                    </p>
                    <div class="mb-6">
                        <h5 class="text-white font-bold mb-4 text-lg flex items-center space-x-2">
                            <span class="w-1 h-6 bg-gradient-to-b from-[#C9A24D] to-[#D4B366] rounded-full"></span>
                            <span>Síguenos</span>
                        </h5>
                    </div>
                    <div class="flex space-x-3">
                        @php
                            $facebookUrl = \App\Models\SiteSetting::get('social_facebook', 'https://www.facebook.com/hostalreallamolina/');
                            $instagramUrl = \App\Models\SiteSetting::get('social_instagram', 'https://www.instagram.com/hostalreallamolinaa/');
                            $whatsappUrl = \App\Models\SiteSetting::get('contact_whatsapp', '51948070603');
                        @endphp
                        
                        @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-12 h-12 bg-gradient-to-br from-[#1877F2] to-[#166FE5] rounded-xl flex items-center justify-center hover:shadow-2xl hover:shadow-[#1877F2]/50 transition-all transform hover:scale-110 hover:-translate-y-1 shadow-xl group relative overflow-hidden ring-2 ring-transparent hover:ring-[#1877F2]/40"
                           aria-label="Síguenos en Facebook">
                            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="w-6 h-6 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        @endif
                        
                        @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-12 h-12 bg-gradient-to-br from-[#E4405F] via-[#C13584] to-[#833AB4] rounded-xl flex items-center justify-center hover:shadow-2xl hover:shadow-[#E4405F]/50 transition-all transform hover:scale-110 hover:-translate-y-1 shadow-xl group relative overflow-hidden ring-2 ring-transparent hover:ring-[#E4405F]/40"
                           aria-label="Síguenos en Instagram">
                            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="w-6 h-6 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        @endif
                        
                        @if($whatsappUrl)
                        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $whatsappUrl) }}?text=Hola,%20me%20interesa%20reservar%20en%20Hostal%20Real%20La%20Molina" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="w-12 h-12 bg-gradient-to-br from-[#25D366] to-[#20BA5A] rounded-xl flex items-center justify-center hover:shadow-2xl hover:shadow-[#25D366]/50 transition-all transform hover:scale-110 hover:-translate-y-1 shadow-xl group relative overflow-hidden ring-2 ring-transparent hover:ring-[#25D366]/40"
                           aria-label="Contáctanos por WhatsApp">
                            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="w-6 h-6 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .96 4.534.96 10.09c0 1.792.473 3.47 1.3 4.925L.06 23.878l8.917-2.295a11.717 11.717 0 003.072.403c6.554 0 11.89-5.335 11.89-11.89 0-3.18-1.256-6.188-3.536-8.465"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="reveal reveal-scale reveal-delay-100">
                    <h4 class="font-display font-bold text-white mb-7 text-xl flex items-center space-x-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-[#C9A24D] to-[#D4B366] rounded-full"></span>
                        <span>Enlaces Rápidos</span>
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('home') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rooms.index') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Habitaciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Contacto</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('complaints.create') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Libro de Reclamaciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Legal Links -->
                <div class="reveal reveal-scale reveal-delay-200">
                    <h4 class="font-display font-bold text-white mb-7 text-xl flex items-center space-x-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-[#C9A24D] to-[#D4B366] rounded-full"></span>
                        <span>Información Legal</span>
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('pages.privacy') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Política de Privacidad</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.terms') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Términos y Condiciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('complaints.create') }}" 
                               class="text-gray-300 hover:text-[#C9A24D] transition-all duration-300 inline-flex items-center group text-base font-medium">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-gradient-to-r from-[#C9A24D] to-[#D4B366] mr-0 group-hover:mr-3 transition-all duration-500 rounded-full"></span>
                                <span class="transform group-hover:translate-x-1 transition-transform duration-300">Libro de Reclamaciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="reveal reveal-right reveal-delay-300">
                    <h4 class="font-display font-bold text-white mb-7 text-xl flex items-center space-x-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-[#C9A24D] to-[#D4B366] rounded-full"></span>
                        <span>Contacto</span>
                    </h4>
                    <ul class="space-y-5">
                        <li class="flex items-start group">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D]/20 to-[#D4B366]/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 group-hover:from-[#C9A24D]/30 group-hover:to-[#D4B366]/20 transition-all duration-300">
                                <svg class="w-5 h-5 text-[#C9A24D] group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <a href="mailto:hostalreallamolina@hotmail.com" class="text-gray-300 hover:text-[#C9A24D] transition-colors duration-300 text-base font-medium pt-1.5">hostalreallamolina@hotmail.com</a>
                        </li>
                        <li class="flex items-start group">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D]/20 to-[#D4B366]/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 group-hover:from-[#C9A24D]/30 group-hover:to-[#D4B366]/20 transition-all duration-300">
                                <svg class="w-5 h-5 text-[#C9A24D] group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <a href="tel:+51948070603" class="text-gray-300 hover:text-[#C9A24D] transition-colors duration-300 text-base font-medium pt-1.5">+51 948 070 603</a>
                        </li>
                        <li class="flex items-start group">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D]/20 to-[#D4B366]/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 group-hover:from-[#C9A24D]/30 group-hover:to-[#D4B366]/20 transition-all duration-300">
                                <svg class="w-5 h-5 text-[#C9A24D] group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-gray-300 text-base font-medium pt-1.5 leading-relaxed">Av. La Molina 688<br>La Molina, Lima, Perú</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800/50 pt-10 relative reveal reveal-delay-400">
                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#C9A24D]/30 to-transparent"></div>
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 pt-8">
                    @php
                        $copyrightName = \App\Models\SiteSetting::get('site_name', 'Hostal Real La Molina');
                    @endphp
                    <p class="text-gray-400 text-sm font-medium">&copy; {{ date('Y') }} {{ $copyrightName }}. Todos los derechos reservados.</p>
                    <div class="flex flex-wrap items-center justify-center gap-3 text-sm">
                        <a href="{{ route('pages.privacy') }}" class="text-gray-400 hover:text-[#C9A24D] transition-colors duration-300 font-medium px-2 py-1 rounded-lg hover:bg-[#C9A24D]/10">Política de Privacidad</a>
                        <span class="text-gray-600 w-1 h-1 bg-[#C9A24D]/30 rounded-full"></span>
                        <a href="{{ route('pages.terms') }}" class="text-gray-400 hover:text-[#C9A24D] transition-colors duration-300 font-medium px-2 py-1 rounded-lg hover:bg-[#C9A24D]/10">Términos y Condiciones</a>
                        <span class="text-gray-600 w-1 h-1 bg-[#C9A24D]/30 rounded-full"></span>
                        <a href="{{ route('complaints.create') }}" class="text-gray-400 hover:text-[#C9A24D] transition-colors duration-300 font-medium px-2 py-1 rounded-lg hover:bg-[#C9A24D]/10">Libro de Reclamaciones</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button Premium -->
    <a href="https://wa.me/51948070603?text=Hola,%20me%20interesa%20reservar%20en%20Hostal%20Real%20La%20Molina" 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-8 right-8 bg-[#25D366] text-white p-5 rounded-full shadow-2xl hover:bg-[#20BA5A] transition-all transform hover:scale-110 z-50 group whatsapp-button animate-float"
       aria-label="Contactar por WhatsApp">
        <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .96 4.534.96 10.09c0 1.792.473 3.47 1.3 4.925L.06 23.878l8.917-2.295a11.717 11.717 0 003.072.403c6.554 0 11.89-5.335 11.89-11.89 0-3.18-1.256-6.188-3.536-8.465" stroke="white" stroke-width="0.3"/>
        </svg>
        <!-- Mensaje animado -->
        <div class="whatsapp-message absolute -top-12 right-0 bg-[#0F0F0F] text-white px-4 py-2 rounded-lg shadow-2xl whitespace-nowrap opacity-0 invisible transition-all duration-500 transform translate-y-2">
            <span class="text-sm font-semibold">¡Escríbenos!</span>
            <div class="absolute bottom-0 right-6 w-0 h-0 border-l-8 border-r-8 border-t-8 border-transparent border-t-[#0F0F0F]"></div>
        </div>
    </a>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // WhatsApp Button Animation
        const whatsappButton = document.querySelector('.whatsapp-button');
        const whatsappMessage = document.querySelector('.whatsapp-message');
        
        if (whatsappButton && whatsappMessage) {
            function showMessage() {
                whatsappMessage.classList.remove('opacity-0', 'invisible', 'translate-y-2');
                whatsappMessage.classList.add('opacity-100', 'visible', 'translate-y-0');
            }
            
            function hideMessage() {
                whatsappMessage.classList.remove('opacity-100', 'visible', 'translate-y-0');
                whatsappMessage.classList.add('opacity-0', 'invisible', 'translate-y-2');
            }
            
            // Mostrar mensaje inmediatamente al cargar
            setTimeout(showMessage, 1000);
            
            // Ocultar después de 5 segundos
            setTimeout(hideMessage, 6000);
            
            // Ciclo cada 10 segundos
            setInterval(function() {
                showMessage();
                setTimeout(hideMessage, 5000);
            }, 10000);
        }
        
        // Scroll Reveal Animation
        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
        
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        revealElements.forEach(element => {
            revealObserver.observe(element);
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.length > 1) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
        
        // Add fade-in animation to body content
        const mainContent = document.querySelector('main, .main-content, [role="main"]');
        if (mainContent) {
            mainContent.classList.add('fade-in-on-load');
        }
        
        // Smooth header scroll effect
        let lastScroll = 0;
        const nav = document.querySelector('nav');
        let ticking = false;
        
        function updateHeader() {
            const currentScroll = window.pageYOffset;
            
            if (nav) {
                if (currentScroll > lastScroll && currentScroll > 200) {
                    nav.style.transform = 'translateY(-100%)';
                    nav.style.transition = 'transform 0.3s ease-out';
                } else if (currentScroll < lastScroll) {
                    nav.style.transform = 'translateY(0)';
                    nav.style.transition = 'transform 0.3s ease-out';
                }
            }
            
            lastScroll = currentScroll;
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateHeader);
                ticking = true;
            }
        });
        
        // Add hover effects to cards with smooth transitions
        const cards = document.querySelectorAll('.card-premium, .bg-white.rounded-lg, .bg-white.rounded-xl');
        cards.forEach(card => {
            card.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease';
            
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
                this.style.boxShadow = '0 12px 40px rgba(0, 0, 0, 0.12)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
        
        // Add smooth transitions to all links
        const links = document.querySelectorAll('a');
        links.forEach(link => {
            link.style.transition = 'all 0.3s ease';
        });
        
        // Add animation to buttons
        const buttons = document.querySelectorAll('button, .btn-premium, .btn-secondary');
        buttons.forEach(button => {
            button.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
    </script>
</body>
</html>
