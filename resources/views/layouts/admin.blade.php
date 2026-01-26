<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Administrativo') - Hostal Real La Molina</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5EFE6] font-sans antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">
    <div class="flex h-screen overflow-hidden">
        <!-- Premium Sidebar -->
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" 
               class="bg-gradient-to-b from-[#0F0F0F] to-[#1a1a1a] text-white transition-all duration-300 shadow-2xl relative z-30">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-[#2C2C2C]">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3" x-show="sidebarOpen" x-transition>
                        <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-display font-bold text-xl">H</span>
                        </div>
                        <div>
                            <div class="text-lg font-display font-bold text-white">Admin Panel</div>
                            <div class="text-xs text-gray-400">Hostal Real</div>
                        </div>
                    </div>
                    <button @click="sidebarOpen = !sidebarOpen" 
                            class="p-2 rounded-lg hover:bg-[#2C2C2C] transition-colors text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="p-4 space-y-2 flex-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.rooms.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.rooms.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Habitaciones</span>
                </a>
                
                <a href="{{ route('admin.room-status.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.room-status.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Control Habitaciones</span>
                </a>
                
                <a href="{{ route('admin.reservations.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.reservations.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Reservas</span>
                </a>
                
                <a href="{{ route('admin.reviews.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.reviews.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Reseñas</span>
                </a>
                
                <a href="{{ route('admin.complaints.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.complaints.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Reclamaciones</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Usuarios</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 group {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-[#C9A24D] to-[#B8943F] text-[#0F0F0F] shadow-lg' : 'hover:bg-[#2C2C2C] text-gray-300 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Configuración</span>
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 w-full p-4 border-t border-[#2C2C2C] bg-[#0F0F0F]">
                <a href="{{ route('home') }}" 
                   class="flex items-center px-4 py-3 rounded-xl hover:bg-[#2C2C2C] transition-colors text-gray-300 hover:text-white group">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-semibold">Volver al Sitio</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Premium Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 z-20">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-2xl font-display font-bold text-[#0F0F0F]">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Panel de administración')</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-[#0F0F0F]">{{ auth('admin')->user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrador</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-[#C9A24D] to-[#B8943F] rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-sm">{{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors font-medium">
                                Salir
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-[#F5EFE6]">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm animate-slide-up">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm animate-slide-up">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
