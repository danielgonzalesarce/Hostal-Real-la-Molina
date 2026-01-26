@extends('layouts.admin')

@section('title', 'Editar Usuario')
@section('page-title', 'Editar Usuario')
@section('page-subtitle', 'Modifica la información del usuario')

@section('content')
<div class="card-premium p-8 max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Basic Information -->
            <div>
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Información Básica</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Nombre Completo *</label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $user->name) }}"
                               required
                               class="input-premium w-full @error('name') border-red-300 @enderror">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Email *</label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}"
                               required
                               class="input-premium w-full @error('email') border-red-300 @enderror">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Teléfono</label>
                        <input type="text" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               class="input-premium w-full @error('phone') border-red-300 @enderror">
                        @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Password Change -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-6">Cambiar Contraseña</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Nueva Contraseña</label>
                        <input type="password" 
                               name="password" 
                               class="input-premium w-full @error('password') border-red-300 @enderror"
                               placeholder="Dejar en blanco para no cambiar">
                        <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres</p>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Confirmar Contraseña</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="input-premium w-full"
                               placeholder="Repite la nueva contraseña">
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn-premium">
                    Guardar Cambios
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary">
                    Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

