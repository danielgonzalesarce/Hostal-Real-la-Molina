@extends('layouts.app')

@section('title', 'Registrarse - Hostal Real La Molina')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#F5EFE6] via-white to-[#F5EFE6] py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#C9A24D]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-[#C9A24D]/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 max-w-md w-full">
        <!-- Premium Card -->
        <div class="card-premium p-6 sm:p-8 lg:p-10 animate-fade-in">
            <!-- Logo & Header -->
            <div class="text-center mb-6 sm:mb-8 lg:mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl mb-4 sm:mb-6 shadow-lg">
                    <span class="text-white font-display font-bold text-2xl sm:text-3xl">H</span>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-display font-bold text-[#0F0F0F] mb-2 sm:mb-3">Crear Cuenta</h2>
                <p class="text-sm sm:text-base text-[#2C2C2C]">Únete a nuestra comunidad</p>
            </div>
            
            <!-- Form -->
            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-bold text-[#0F0F0F] mb-2">Nombre Completo</label>
                        <input id="name" 
                               name="name" 
                               type="text" 
                               required 
                               autocomplete="name"
                               value="{{ old('name') }}"
                               class="input-premium @error('name') border-red-300 @enderror"
                               placeholder="Juan Pérez">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-bold text-[#0F0F0F] mb-2">Email</label>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               required 
                               autocomplete="email"
                               value="{{ old('email') }}"
                               class="input-premium @error('email') border-red-300 @enderror"
                               placeholder="tu@email.com">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-bold text-[#0F0F0F] mb-2">
                            Teléfono 
                            <span class="text-gray-400 font-normal">(opcional)</span>
                        </label>
                        <input id="phone" 
                               name="phone" 
                               type="tel" 
                               autocomplete="tel"
                               value="{{ old('phone') }}"
                               class="input-premium @error('phone') border-red-300 @enderror"
                               placeholder="+51 999 999 999">
                        @error('phone')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-bold text-[#0F0F0F] mb-2">Contraseña</label>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="new-password"
                               class="input-premium @error('password') border-red-300 @enderror"
                               placeholder="••••••••">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-[#0F0F0F] mb-2">Confirmar Contraseña</label>
                        <input id="password_confirmation" 
                               name="password_confirmation" 
                               type="password" 
                               required 
                               autocomplete="new-password"
                               class="input-premium"
                               placeholder="••••••••">
                    </div>
                </div>
                
                <!-- Términos y Condiciones -->
                <div class="flex items-start">
                    <div class="flex items-center h-5 flex-shrink-0 mt-0.5">
                        <input id="terms" 
                               name="terms" 
                               type="checkbox" 
                               required
                               value="1"
                               class="w-4 h-4 text-[#C9A24D] border-gray-300 rounded focus:ring-[#C9A24D] @error('terms') border-red-300 @enderror">
                    </div>
                    <div class="ml-3 text-xs sm:text-sm">
                        <label for="terms" class="text-[#2C2C2C] leading-relaxed">
                            Acepto los 
                            <a href="{{ route('pages.terms') }}" target="_blank" class="text-[#C9A24D] hover:text-[#B8943F] font-semibold underline break-words">
                                Términos y Condiciones
                            </a>
                            <span class="text-red-500">*</span>
                        </label>
                        @error('terms')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="btn-premium w-full">
                        Crear Cuenta
                    </button>
                </div>
                
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-xs sm:text-sm text-[#2C2C2C]">
                        ¿Ya tienes cuenta? 
                        <a href="{{ route('login') }}" class="text-[#C9A24D] hover:text-[#B8943F] font-semibold transition-colors underline">
                            Inicia Sesión
                        </a>
                    </p>
                </div>
            </form>
        </div>
        
        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-[#2C2C2C] hover:text-[#C9A24D] transition-colors group">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al inicio
            </a>
        </div>
    </div>
</div>
@endsection
