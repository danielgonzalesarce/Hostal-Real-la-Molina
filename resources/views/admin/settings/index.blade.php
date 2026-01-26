@extends('layouts.admin')

@section('title', 'Configuración Avanzada')
@section('page-title', 'Configuración del Sistema')
@section('page-subtitle', 'Panel de configuración completo y profesional')

@section('content')
@if(session('success'))
<div class="mb-6 card-premium p-4 bg-green-50 border-l-4 border-green-500">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <p class="text-green-700 font-semibold">{{ session('success') }}</p>
    </div>
</div>
@endif

@if($errors->any())
<div class="mb-6 card-premium p-4 bg-red-50 border-l-4 border-red-500">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p class="text-red-700 font-semibold mb-2">Errores encontrados:</p>
            <ul class="list-disc list-inside text-red-600 text-sm">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<div x-data="{ activeTab: 'general' }" class="space-y-6">
    <!-- Tabs Navigation -->
    <div class="card-premium p-2">
        <div class="flex flex-wrap gap-2">
            <button @click="activeTab = 'general'" 
                    :class="activeTab === 'general' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                General
            </button>
            <button @click="activeTab = 'contact'" 
                    :class="activeTab === 'contact' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Contacto
            </button>
            <button @click="activeTab = 'social'" 
                    :class="activeTab === 'social' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Redes Sociales
            </button>
            <button @click="activeTab = 'seo'" 
                    :class="activeTab === 'seo' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                SEO
            </button>
            <button @click="activeTab = 'email'" 
                    :class="activeTab === 'email' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Email
            </button>
            <button @click="activeTab = 'notifications'" 
                    :class="activeTab === 'notifications' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                Notificaciones
            </button>
            <button @click="activeTab = 'appearance'" 
                    :class="activeTab === 'appearance' ? 'bg-[#C9A24D] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-lg font-semibold text-sm transition-all">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
                Apariencia
            </button>
        </div>
    </div>

    <!-- Tab Content -->
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" id="settings-form" novalidate>
        @csrf
        
        <!-- Hidden fields for validation (all tabs must be present) -->
        <div style="display: none;">
            <input type="text" name="settings[site_name]" value="{{ $defaultGroups['general']['site_name'] }}">
            <input type="email" name="settings[contact_email]" value="{{ $defaultGroups['contact']['contact_email'] }}">
        </div>
        
        <!-- General Tab -->
        <div x-show="activeTab === 'general'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Configuración General</h3>
            <div class="space-y-6">
                <!-- Logo Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h4 class="text-lg font-semibold text-[#0F0F0F] mb-4">Logo del Hostal</h4>
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="flex-shrink-0">
                            @php
                                $currentLogo = \App\Models\SiteSetting::get('site_logo', '');
                                $defaultLogoPath = public_path('img/LogoHostal.png');
                                $hasDefaultLogo = file_exists($defaultLogoPath);
                            @endphp
                            @if($currentLogo && \Storage::disk('public')->exists($currentLogo))
                            <div class="relative">
                                <img src="{{ asset('storage/' . $currentLogo) }}?v={{ time() }}" 
                                     alt="Logo personalizado" 
                                     id="logo-preview"
                                     class="w-32 h-32 object-contain bg-gray-50 rounded-xl border-2 border-[#C9A24D] p-2">
                                <button type="button" 
                                        onclick="if(confirm('¿Estás seguro de eliminar el logo personalizado? Se mostrará el logo por defecto del hostal.')) { document.getElementById('logo').value = ''; document.getElementById('site_logo').value = ''; document.getElementById('logo-preview').src = '{{ asset('img/LogoHostal.png') }}'; document.getElementById('logo-preview').classList.remove('border-[#C9A24D]'); document.getElementById('logo-preview').classList.add('border-gray-200'); }"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                                        title="Eliminar logo personalizado">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                <p class="text-xs text-green-600 mt-2 font-semibold">✓ Logo personalizado activo</p>
                            </div>
                            @elseif($hasDefaultLogo)
                            <div class="relative">
                                <img src="{{ asset('img/LogoHostal.png') }}" 
                                     alt="Logo por defecto" 
                                     id="logo-preview"
                                     class="w-32 h-32 object-contain bg-gray-50 rounded-xl border-2 border-gray-200 p-2">
                                <p class="text-xs text-blue-600 mt-2 font-semibold">ℹ Logo por defecto del hostal</p>
                                <p class="text-xs text-gray-500 mt-1">Sube un logo personalizado para reemplazarlo</p>
                            </div>
                            @else
                            <div class="w-32 h-32 bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 flex items-center justify-center relative">
                                <div class="w-14 h-14 bg-gradient-to-br from-[#C9A24D] via-[#D4B366] to-[#B8943F] rounded-xl flex items-center justify-center">
                                    <span class="text-white font-display font-bold text-2xl">H</span>
                                </div>
                                <p class="absolute bottom-2 text-xs text-gray-500 text-center px-2">Sin logo</p>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Subir Nuevo Logo</label>
                            <input type="file" 
                                   name="logo" 
                                   id="logo"
                                   accept="image/*"
                                   class="input-premium w-full"
                                   onchange="previewLogo(this)">
                            <p class="text-xs text-gray-500 mt-2">
                                Formatos aceptados: JPG, PNG, GIF, WEBP, SVG. El sistema ajustará automáticamente el tamaño de la imagen. Tamaño máximo: 10MB.
                            </p>
                            <input type="hidden" name="settings[site_logo]" id="site_logo" value="{{ $currentLogo }}">
                        </div>
                    </div>
                </div>

                <!-- Site Name Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h4 class="text-lg font-semibold text-[#0F0F0F] mb-4">Información del Hostal</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Nombre del Hostal *</label>
                            <input type="text" 
                                   name="settings[site_name]" 
                                   value="{{ $defaultGroups['general']['site_name'] }}" 
                                   class="input-premium w-full" 
                                   placeholder="Ej: Hostal Real La Molina">
                            <p class="text-xs text-gray-500 mt-1">Este nombre aparecerá en el header y footer del sitio</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Tagline / Subtítulo</label>
                            <input type="text" 
                                   name="settings[site_tagline]" 
                                   value="{{ $defaultGroups['general']['site_tagline'] }}" 
                                   class="input-premium w-full" 
                                   placeholder="Ej: La Molina">
                            <p class="text-xs text-gray-500 mt-1">Aparecerá debajo del nombre del hostal</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Descripción del Sitio</label>
                            <textarea name="settings[site_description]" 
                                      rows="4" 
                                      class="input-premium w-full"
                                      placeholder="Describe tu hostal...">{{ $defaultGroups['general']['site_description'] }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Esta descripción se usará en meta tags y en la página principal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Tab -->
        <div x-show="activeTab === 'contact'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Información de Contacto</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Email de Contacto *</label>
                    <input type="email" name="settings[contact_email]" value="{{ $defaultGroups['contact']['contact_email'] }}" class="input-premium w-full">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Teléfono</label>
                    <input type="text" name="settings[contact_phone]" value="{{ $defaultGroups['contact']['contact_phone'] }}" class="input-premium w-full">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">WhatsApp</label>
                    <input type="text" name="settings[contact_whatsapp]" value="{{ $defaultGroups['contact']['contact_whatsapp'] }}" class="input-premium w-full" placeholder="+51999999999">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Dirección Completa</label>
                    <textarea name="settings[contact_address]" rows="3" class="input-premium w-full">{{ $defaultGroups['contact']['contact_address'] }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media Tab -->
        <div x-show="activeTab === 'social'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Redes Sociales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Facebook URL</label>
                    <input type="url" name="settings[social_facebook]" value="{{ $defaultGroups['social']['social_facebook'] }}" class="input-premium w-full" placeholder="https://facebook.com/tu-pagina">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Instagram URL</label>
                    <input type="url" name="settings[social_instagram]" value="{{ $defaultGroups['social']['social_instagram'] }}" class="input-premium w-full" placeholder="https://instagram.com/tu-cuenta">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Twitter URL</label>
                    <input type="url" name="settings[social_twitter]" value="{{ $defaultGroups['social']['social_twitter'] }}" class="input-premium w-full" placeholder="https://twitter.com/tu-cuenta">
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">LinkedIn URL</label>
                    <input type="url" name="settings[social_linkedin]" value="{{ $defaultGroups['social']['social_linkedin'] }}" class="input-premium w-full" placeholder="https://linkedin.com/company/tu-empresa">
                </div>
            </div>
        </div>

        <!-- SEO Tab -->
        <div x-show="activeTab === 'seo'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Configuración SEO</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Título SEO</label>
                    <input type="text" name="settings[seo_title]" value="{{ $defaultGroups['seo']['seo_title'] }}" class="input-premium w-full" placeholder="Título para motores de búsqueda">
                    <p class="text-xs text-gray-500 mt-1">Recomendado: 50-60 caracteres</p>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Descripción SEO</label>
                    <textarea name="settings[seo_description]" rows="3" class="input-premium w-full" placeholder="Descripción para motores de búsqueda">{{ $defaultGroups['seo']['seo_description'] }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Recomendado: 150-160 caracteres</p>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Palabras Clave</label>
                    <input type="text" name="settings[seo_keywords]" value="{{ $defaultGroups['seo']['seo_keywords'] }}" class="input-premium w-full" placeholder="palabra1, palabra2, palabra3">
                    <p class="text-xs text-gray-500 mt-1">Separa las palabras clave con comas</p>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Google Analytics ID</label>
                    <input type="text" name="settings[seo_google_analytics]" value="{{ $defaultGroups['seo']['seo_google_analytics'] }}" class="input-premium w-full" placeholder="G-XXXXXXXXXX">
                </div>
            </div>
        </div>

        <!-- Email Tab -->
        <div x-show="activeTab === 'email'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Configuración de Email</h3>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Nombre del Remitente</label>
                        <input type="text" name="settings[email_from_name]" value="{{ $defaultGroups['email']['email_from_name'] }}" class="input-premium w-full">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Email del Remitente</label>
                        <input type="email" name="settings[email_from_address]" value="{{ $defaultGroups['email']['email_from_address'] }}" class="input-premium w-full">
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-[#0F0F0F] mb-4">Configuración SMTP</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Servidor SMTP</label>
                            <input type="text" name="settings[email_smtp_host]" value="{{ $defaultGroups['email']['email_smtp_host'] }}" class="input-premium w-full" placeholder="smtp.gmail.com">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Puerto SMTP</label>
                            <input type="number" name="settings[email_smtp_port]" value="{{ $defaultGroups['email']['email_smtp_port'] }}" class="input-premium w-full" placeholder="587">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Usuario SMTP</label>
                            <input type="text" name="settings[email_smtp_username]" value="{{ $defaultGroups['email']['email_smtp_username'] }}" class="input-premium w-full">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Contraseña SMTP</label>
                            <input type="password" name="settings[email_smtp_password]" value="{{ $defaultGroups['email']['email_smtp_password'] }}" class="input-premium w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Tab -->
        <div x-show="activeTab === 'notifications'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Notificaciones por Email</h3>
            <div class="space-y-4">
                <label class="flex items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <input type="checkbox" name="settings[notify_new_reservation]" value="1" {{ $defaultGroups['notifications']['notify_new_reservation'] ? 'checked' : '' }} class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded">
                    <div class="ml-4">
                        <p class="font-semibold text-[#0F0F0F]">Nueva Reserva</p>
                        <p class="text-sm text-gray-500">Recibir email cuando se cree una nueva reserva</p>
                    </div>
                </label>
                <label class="flex items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <input type="checkbox" name="settings[notify_reservation_confirmed]" value="1" {{ $defaultGroups['notifications']['notify_reservation_confirmed'] ? 'checked' : '' }} class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded">
                    <div class="ml-4">
                        <p class="font-semibold text-[#0F0F0F]">Reserva Confirmada</p>
                        <p class="text-sm text-gray-500">Enviar email al cliente cuando se confirme una reserva</p>
                    </div>
                </label>
                <label class="flex items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <input type="checkbox" name="settings[notify_reservation_cancelled]" value="1" {{ $defaultGroups['notifications']['notify_reservation_cancelled'] ? 'checked' : '' }} class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded">
                    <div class="ml-4">
                        <p class="font-semibold text-[#0F0F0F]">Reserva Cancelada</p>
                        <p class="text-sm text-gray-500">Enviar email al cliente cuando se cancele una reserva</p>
                    </div>
                </label>
                <label class="flex items-center cursor-pointer p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <input type="checkbox" name="settings[notify_new_review]" value="1" {{ $defaultGroups['notifications']['notify_new_review'] ? 'checked' : '' }} class="w-5 h-5 text-[#C9A24D] border-gray-300 rounded">
                    <div class="ml-4">
                        <p class="font-semibold text-[#0F0F0F]">Nueva Reseña</p>
                        <p class="text-sm text-gray-500">Recibir email cuando se publique una nueva reseña</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Appearance Tab -->
        <div x-show="activeTab === 'appearance'" class="card-premium p-8">
            <h3 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Apariencia</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Color Primario</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="settings[primary_color]" value="{{ $defaultGroups['appearance']['primary_color'] }}" class="w-16 h-12 rounded-lg border-2 border-gray-300">
                        <input type="text" value="{{ $defaultGroups['appearance']['primary_color'] }}" class="input-premium flex-1" readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Color Secundario</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="settings[secondary_color]" value="{{ $defaultGroups['appearance']['secondary_color'] }}" class="w-16 h-12 rounded-lg border-2 border-gray-300">
                        <input type="text" value="{{ $defaultGroups['appearance']['secondary_color'] }}" class="input-premium flex-1" readonly>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Texto del Footer</label>
                    <textarea name="settings[footer_text]" rows="3" class="input-premium w-full">{{ $defaultGroups['appearance']['footer_text'] }}</textarea>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="card-premium p-6">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-500">Los cambios se guardarán en todas las pestañas</p>
                <button type="submit" class="btn-premium">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Guardar Todas las Configuraciones
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function previewLogo(input) {
    const preview = document.getElementById('logo-preview');
    const hiddenInput = document.getElementById('site_logo');
    const errorMsg = document.getElementById('logo-error');
    
    // Reset error
    if (errorMsg) {
        errorMsg.style.display = 'none';
        errorMsg.textContent = '';
    }
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 10 * 1024 * 1024; // 10MB
        
        // Validate file size
        if (file.size > maxSize) {
            if (errorMsg) {
                errorMsg.textContent = 'El archivo es demasiado grande. Tamaño máximo: 10MB';
                errorMsg.style.display = 'block';
            }
            input.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!validTypes.includes(file.type)) {
            if (errorMsg) {
                errorMsg.textContent = 'Tipo de archivo no válido. Use JPG, PNG, GIF, WEBP o SVG';
                errorMsg.style.display = 'block';
            }
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (!preview) {
                // Crear preview si no existe
                const container = input.closest('.flex-1').previousElementSibling;
                container.innerHTML = `
                    <div class="relative">
                        <img src="${e.target.result}" 
                             alt="Vista previa del logo" 
                             id="logo-preview"
                             class="w-32 h-32 object-contain bg-gray-50 rounded-xl border-2 border-gray-200 p-2">
                        <button type="button" 
                                onclick="document.getElementById('logo').value = ''; document.getElementById('site_logo').value = ''; document.getElementById('logo-preview').src = ''; document.getElementById('logo-preview').style.display = 'none';"
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors"
                                title="Eliminar logo">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                `;
            } else {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        
        reader.onerror = function() {
            if (errorMsg) {
                errorMsg.textContent = 'Error al leer el archivo';
                errorMsg.style.display = 'block';
            }
        };
        
        reader.readAsDataURL(file);
        
        // Limpiar el valor del hidden input para que se suba el nuevo archivo
        if (hiddenInput) {
            hiddenInput.value = '';
        }
    }
}
</script>
@endsection
