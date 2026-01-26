@extends('layouts.app')

@section('title', 'Libro de Reclamaciones - Hostal Real La Molina')

@section('content')
<div class="bg-gradient-to-br from-[#F5EFE6] to-white min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-[#0F0F0F] mb-4">
                Libro de <span class="text-[#C9A24D]">Reclamaciones</span>
            </h1>
            <p class="text-lg text-[#2C2C2C] max-w-2xl mx-auto">
                Tu opinión es importante para nosotros. Registra tu reclamo y nos comprometemos a atenderlo de manera oportuna.
            </p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Form -->
        <div class="card-premium p-8 md:p-10">
            <form method="POST" action="{{ route('complaints.store') }}" class="space-y-6">
                @csrf

                <!-- Datos del Reclamante -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Datos del Reclamante</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                                Nombres y Apellidos <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="claimant_name" 
                                   value="{{ old('claimant_name') }}"
                                   required
                                   class="input-premium w-full @error('claimant_name') border-red-300 @enderror"
                                   placeholder="Juan Pérez García">
                            @error('claimant_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                                DNI <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="claimant_dni" 
                                   value="{{ old('claimant_dni') }}"
                                   required
                                   maxlength="20"
                                   class="input-premium w-full @error('claimant_dni') border-red-300 @enderror"
                                   placeholder="12345678">
                            @error('claimant_dni')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                                Teléfono <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" 
                                   name="claimant_phone" 
                                   value="{{ old('claimant_phone') }}"
                                   required
                                   class="input-premium w-full @error('claimant_phone') border-red-300 @enderror"
                                   placeholder="+51 987 654 321">
                            @error('claimant_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                                Correo Electrónico <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="claimant_email" 
                                   value="{{ old('claimant_email', auth()->check() ? auth()->user()->email : '') }}"
                                   required
                                   class="input-premium w-full @error('claimant_email') border-red-300 @enderror"
                                   placeholder="correo@ejemplo.com">
                            @error('claimant_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                                Dirección
                            </label>
                            <textarea name="claimant_address" 
                                      rows="2"
                                      class="input-premium w-full @error('claimant_address') border-red-300 @enderror"
                                      placeholder="Calle, número, distrito, ciudad">{{ old('claimant_address') }}</textarea>
                            @error('claimant_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Descripción del Reclamo -->
                <div>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6">Descripción del Reclamo</h2>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">
                            Detalle tu reclamo <span class="text-red-500">*</span>
                        </label>
                        <textarea name="complaint_description" 
                                  rows="8"
                                  required
                                  minlength="10"
                                  class="input-premium w-full @error('complaint_description') border-red-300 @enderror"
                                  placeholder="Describe detalladamente tu reclamo, incluyendo fecha, hora y cualquier información relevante...">{{ old('complaint_description') }}</textarea>
                        <p class="mt-2 text-xs text-gray-500">Mínimo 10 caracteres. Sé lo más específico posible.</p>
                        @error('complaint_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <span class="text-red-500">*</span> Campos obligatorios
                    </p>
                    <button type="submit" class="btn-premium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Enviar Reclamo
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Información Importante</h3>
                    <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                        <li>Nos comprometemos a responder tu reclamo en un plazo máximo de 15 días hábiles.</li>
                        <li>Todos los reclamos son tratados con confidencialidad y seriedad.</li>
                        <li>Recibirás una confirmación por correo electrónico al registrar tu reclamo.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

