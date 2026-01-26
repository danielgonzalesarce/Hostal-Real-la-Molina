<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Administrador - Hostal Real La Molina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-[#0F0F0F] via-[#1a1a1a] to-[#0F0F0F] font-sans antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#C9A24D]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#C9A24D]/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#C9A24D]/3 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 max-w-md w-full px-4 sm:px-6 lg:px-8">
        <!-- Premium Card -->
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-10 animate-fade-in border border-white/20">
            <!-- Logo & Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-2xl mb-6 shadow-xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-4xl font-display font-bold text-[#0F0F0F] mb-3">Panel Administrativo</h2>
                <p class="text-[#2C2C2C] text-sm">Acceso exclusivo para administradores</p>
            </div>
            
            <!-- Status Message -->
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <p class="text-sm text-green-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('status') }}
                </p>
            </div>
            @endif
            
            <!-- Error Message -->
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <p class="text-sm text-red-800 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </p>
            </div>
            @endif
            
            <!-- Form -->
            <form class="space-y-6" method="POST" action="{{ route('admin.login') }}">
                @csrf
                
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-bold text-[#0F0F0F] mb-2">
                            Email Administrador
                        </label>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               required 
                               autocomplete="email"
                               autofocus
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-[#C9A24D] focus:ring-2 focus:ring-[#C9A24D]/20 outline-none transition-all text-[#0F0F0F] placeholder-gray-400 @error('email') border-red-300 @enderror"
                               placeholder="admin@hostalreal.com">
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
                        <label for="password" class="block text-sm font-bold text-[#0F0F0F] mb-2">
                            Contraseña
                        </label>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-[#C9A24D] focus:ring-2 focus:ring-[#C9A24D]/20 outline-none transition-all text-[#0F0F0F] placeholder-gray-400 @error('password') border-red-300 @enderror"
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
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               class="w-4 h-4 text-[#C9A24D] border-gray-300 rounded focus:ring-[#C9A24D] focus:ring-2">
                        <label for="remember" class="ml-2 block text-sm text-[#2C2C2C]">Recordarme</label>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Acceder al Panel
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Security Notice -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-400 flex items-center justify-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                Acceso restringido - Solo personal autorizado
            </p>
        </div>
    </div>
</body>
</html>

