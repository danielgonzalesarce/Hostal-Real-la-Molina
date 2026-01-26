@extends('layouts.admin')

@section('title', 'Detalle de Reclamo')
@section('page-title', 'Detalle de Reclamo')
@section('page-subtitle', 'Información completa del reclamo')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Complaint Info -->
        <div class="card-premium p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-display font-bold text-[#0F0F0F]">Reclamo #{{ $complaint->id }}</h3>
                <span class="px-4 py-2 text-sm font-semibold rounded-full 
                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                    @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ $complaint->status_label }}
                </span>
            </div>

            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-2">Descripción del Reclamo</h4>
                    <p class="text-[#2C2C2C] leading-relaxed whitespace-pre-wrap">{{ $complaint->complaint_description }}</p>
                </div>

                @if($complaint->response)
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="text-sm font-bold text-gray-500 uppercase mb-2">Respuesta del Establecimiento</h4>
                    <p class="text-[#2C2C2C] leading-relaxed whitespace-pre-wrap">{{ $complaint->response }}</p>
                    @if($complaint->response_date)
                    <p class="text-xs text-gray-500 mt-2">Fecha de respuesta: {{ $complaint->response_date->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Claimant Info -->
        <div class="card-premium p-6">
            <h4 class="font-display font-bold text-lg text-[#0F0F0F] mb-4">Datos del Reclamante</h4>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-500">Nombre:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->claimant_name }}</p>
                </div>
                <div>
                    <span class="text-gray-500">DNI:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->claimant_dni }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Teléfono:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->claimant_phone }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Email:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->claimant_email }}</p>
                </div>
                @if($complaint->claimant_address)
                <div>
                    <span class="text-gray-500">Dirección:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->claimant_address }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Dates -->
        <div class="card-premium p-6">
            <h4 class="font-display font-bold text-lg text-[#0F0F0F] mb-4">Información</h4>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-500">Fecha de registro:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->created_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($complaint->user)
                <div>
                    <span class="text-gray-500">Usuario registrado:</span>
                    <p class="font-semibold text-[#0F0F0F]">{{ $complaint->user->name }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="card-premium p-6">
            <h4 class="font-display font-bold text-lg text-[#0F0F0F] mb-4">Actualizar Estado</h4>
            <form method="POST" action="{{ route('admin.complaints.update', $complaint->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Estado</label>
                    <select name="status" class="input-premium w-full">
                        <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>En Proceso</option>
                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resuelto</option>
                        <option value="dismissed" {{ $complaint->status === 'dismissed' ? 'selected' : '' }}>Desestimado</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#0F0F0F] mb-2">Respuesta</label>
                    <textarea name="response" 
                              rows="6"
                              class="input-premium w-full"
                              placeholder="Escribe la respuesta al reclamo...">{{ old('response', $complaint->response) }}</textarea>
                </div>

                <button type="submit" class="btn-premium w-full">
                    Actualizar Reclamo
                </button>
            </form>

            <form method="POST" action="{{ route('admin.complaints.destroy', $complaint->id) }}" 
                  class="mt-4"
                  onsubmit="return confirm('¿Estás seguro de eliminar este reclamo?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-secondary w-full">
                    Eliminar Reclamo
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

