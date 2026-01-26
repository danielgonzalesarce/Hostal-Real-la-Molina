@extends('layouts.admin')

@section('title', 'Libro de Reclamaciones')
@section('page-title', 'Libro de Reclamaciones')
@section('page-subtitle', 'Gestiona los reclamos de los clientes')

@section('content')
<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Reclamos</p>
                <p class="text-3xl font-display font-bold text-[#0F0F0F]">{{ $complaints->total() }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Pendientes</p>
                <p class="text-3xl font-display font-bold text-yellow-600">{{ $complaints->where('status', 'pending')->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">En Proceso</p>
                <p class="text-3xl font-display font-bold text-blue-600">{{ $complaints->where('status', 'in_progress')->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="card-premium p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Resueltos</p>
                <p class="text-3xl font-display font-bold text-green-600">{{ $complaints->where('status', 'resolved')->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Complaints Table -->
<div class="card-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-[#F5EFE6]">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">Reclamante</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">DNI</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-[#0F0F0F] uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($complaints as $complaint)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F0F0F]">#{{ $complaint->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-[#0F0F0F]">{{ $complaint->claimant_name }}</div>
                        <div class="text-xs text-gray-500">{{ $complaint->claimant_email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2C2C2C]">{{ $complaint->claimant_dni }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2C2C2C]">
                        {{ $complaint->created_at->format('d/m/Y') }}<br>
                        <span class="text-xs text-gray-500">{{ $complaint->created_at->format('H:i') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                            @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $complaint->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.complaints.show', $complaint->id) }}" 
                           class="text-[#C9A24D] hover:text-[#B8943F] font-semibold">
                            Ver Detalles
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-600 font-semibold">No hay reclamos registrados</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($complaints->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $complaints->links() }}
    </div>
    @endif
</div>
@endsection

