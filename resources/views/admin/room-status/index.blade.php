@extends('layouts.admin')

@section('title', 'Control de Habitaciones')
@section('page-title', 'Control Visual de Habitaciones')
@section('page-subtitle', 'Gestión en tiempo real del estado de todas las habitaciones')

@section('content')
<div x-data="roomStatusApp()" x-init="init()" class="space-y-6">
    <!-- Notificaciones de habitaciones que salen hoy -->
    @if(count($notifications) > 0)
    <div class="card-premium p-4 bg-yellow-50 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="font-bold text-yellow-800">Habitaciones que salen hoy ({{ count($notifications) }})</h3>
                    <p class="text-sm text-yellow-700">Se requiere atención inmediata</p>
                </div>
            </div>
            <button @click="showNotifications = !showNotifications" class="text-yellow-600 hover:text-yellow-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="showNotifications ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'"/>
                </svg>
            </button>
        </div>
        <div x-show="showNotifications" x-transition class="mt-4 space-y-2">
            @foreach($notifications as $notification)
            <div class="bg-white rounded-lg p-3 flex items-center justify-between">
                <div>
                    <p class="font-semibold text-gray-800">{{ $notification['room'] }}</p>
                    <p class="text-sm text-gray-600">Huésped: {{ $notification['guest'] }}</p>
                </div>
                <span class="text-sm text-gray-500">Check-out: {{ $notification['checkout_time'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Estadísticas Rápidas -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="card-premium p-4 text-center">
            <div class="text-2xl font-bold text-[#0F0F0F]">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Total</div>
        </div>
        <div class="card-premium p-4 text-center bg-green-50">
            <div class="text-2xl font-bold text-green-600">{{ $stats['available'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Disponibles</div>
        </div>
        <div class="card-premium p-4 text-center bg-red-50">
            <div class="text-2xl font-bold text-red-600">{{ $stats['occupied'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Ocupadas</div>
        </div>
        <div class="card-premium p-4 text-center bg-yellow-50">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['checkout_today'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Salen Hoy</div>
        </div>
        <div class="card-premium p-4 text-center bg-gray-50">
            <div class="text-2xl font-bold text-gray-600">{{ $stats['maintenance'] }}</div>
            <div class="text-sm text-gray-600 mt-1">Mantenimiento</div>
        </div>
    </div>

    <!-- Controles y Filtros -->
    <div class="card-premium p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       x-model="searchQuery" 
                       @input="filterRooms()"
                       placeholder="Buscar habitación..." 
                       class="input-premium w-full">
            </div>
            <select x-model="statusFilter" @change="filterRooms()" class="input-premium">
                <option value="">Todos los estados</option>
                <option value="available">Disponibles</option>
                <option value="occupied">Ocupadas</option>
                <option value="checkout_today">Salen Hoy</option>
                <option value="maintenance">Mantenimiento</option>
            </select>
            <select x-model="categoryFilter" @change="filterRooms()" class="input-premium">
                <option value="">Todas las categorías</option>
                <option value="Matrimonial">Matrimonial</option>
                <option value="Doble">Doble</option>
                <option value="Triple">Triple</option>
                <option value="Cuádruple">Cuádruple</option>
                <option value="Simple">Simple</option>
            </select>
        </div>
    </div>

    <!-- Vista por Categorías -->
    <div class="space-y-6">
        @foreach($roomsByCategory as $categoryName => $categoryRooms)
        <div class="card-premium p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-display font-bold text-[#0F0F0F]">{{ $categoryName }}</h3>
                <span class="text-sm text-gray-500">
                    {{ count($categoryRooms) }} habitaciones
                </span>
            </div>
            @if(count($categoryRooms) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-3 sm:gap-4">
                @foreach($categoryRooms as $roomData)
                <div class="room-card 
                    @if($roomData['status'] === 'available') bg-green-50 border-green-300 hover:bg-green-100
                    @elseif($roomData['status'] === 'occupied') bg-red-50 border-red-300 hover:bg-red-100
                    @elseif($roomData['status'] === 'checkout_today') bg-yellow-50 border-yellow-300 hover:bg-yellow-100
                    @elseif($roomData['status'] === 'reserved') bg-orange-50 border-orange-300 hover:bg-orange-100
                    @else bg-gray-50 border-gray-300 hover:bg-gray-100
                    @endif
                    rounded-lg p-3 sm:p-4 border-2 cursor-pointer transition-all shadow-sm"
                    @click="showRoomDetails({{ $roomData['id'] }})"
                    data-room-id="{{ $roomData['id'] }}"
                    data-status="{{ $roomData['status'] }}"
                    data-room-number="{{ $roomData['room_number'] }}"
                    data-room-name="{{ strtolower($roomData['formatted_name']) }}"
                    data-room-type="{{ $roomData['room_type'] }}">
                    <div class="text-center">
                        <div class="text-base sm:text-lg font-bold text-gray-800 mb-1">{{ $roomData['room_number'] }}</div>
                        <div class="text-xs text-gray-600 mb-2 line-clamp-2">{{ $roomData['formatted_name'] }}</div>
                        <div class="inline-block px-2 py-1 rounded-full text-xs font-semibold mb-2
                            @if($roomData['status'] === 'available') bg-green-200 text-green-800
                            @elseif($roomData['status'] === 'occupied') bg-red-200 text-red-800
                            @elseif($roomData['status'] === 'checkout_today') bg-yellow-200 text-yellow-800
                            @elseif($roomData['status'] === 'reserved') bg-orange-200 text-orange-800
                            @else bg-gray-200 text-gray-800
                            @endif">
                            {{ $roomData['status_label'] }}
                        </div>
                        @if($roomData['reservation'])
                        <div class="mt-2 text-xs text-gray-600 space-y-1">
                            <div class="font-medium">Hasta: {{ $roomData['reservation']['check_out'] }}</div>
                            @if($roomData['days_remaining'] !== null && $roomData['days_remaining'] >= 0)
                            <div class="font-bold text-[#C9A24D]">{{ $roomData['days_remaining'] }} {{ $roomData['days_remaining'] === 1 ? 'día' : 'días' }}</div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <p class="text-gray-500">No hay habitaciones en esta categoría</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Modal de Detalles de Habitación -->
    <div x-show="showModal" 
         x-transition
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click.self="showModal = false"
         style="display: none;">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-2xl font-display font-bold text-[#0F0F0F]" x-text="selectedRoom?.formatted_name || 'Detalles'"></h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="p-6" x-show="selectedRoom">
                <template x-if="selectedRoom">
                    <div class="space-y-4">
                        <!-- Información de la Habitación -->
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Información</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Tipo</p>
                                    <p class="font-semibold" x-text="selectedRoom.room_type"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Capacidad</p>
                                    <p class="font-semibold" x-text="selectedRoom.capacity + ' personas'"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Precio/Noche</p>
                                    <p class="font-semibold" x-text="'S/ ' + selectedRoom.price_per_night"></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Estado</p>
                                    <div class="flex flex-col gap-1">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold"
                                              :class="{
                                                  'bg-green-100 text-green-800': selectedRoom.status === 'available',
                                                  'bg-red-100 text-red-800': selectedRoom.status === 'occupied',
                                                  'bg-yellow-100 text-yellow-800': selectedRoom.status === 'checkout_today',
                                                  'bg-orange-100 text-orange-800': selectedRoom.status === 'reserved',
                                                  'bg-gray-100 text-gray-800': selectedRoom.status === 'maintenance'
                                              }"
                                              x-text="selectedRoom.status_label"></span>
                                        <span class="text-xs text-gray-500" 
                                              x-show="selectedRoom.manual_status"
                                              x-text="selectedRoom.manual_status === 'occupied' ? '(Manual - Ocupada)' : '(Manual - Disponible)'"></span>
                                        <span class="text-xs text-blue-500" 
                                              x-show="!selectedRoom.manual_status && selectedRoom.status !== 'maintenance'"
                                              x-text="'(Automático)'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Reserva -->
                        <div x-show="selectedRoom.reservation">
                            <h4 class="font-semibold text-gray-700 mb-2">Reserva Activa</h4>
                            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Huésped:</span>
                                    <span class="font-semibold" x-text="selectedRoom.reservation.guest_name"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Check-in:</span>
                                    <span class="font-semibold" x-text="selectedRoom.reservation.check_in"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Check-out:</span>
                                    <span class="font-semibold" x-text="selectedRoom.reservation.check_out"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Días restantes:</span>
                                    <span class="font-semibold" x-text="selectedRoom.days_remaining + ' días'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total:</span>
                                    <span class="font-semibold" x-text="'S/ ' + selectedRoom.reservation.total_price"></span>
                                </div>
                                <div class="flex gap-2 mt-4">
                                    <button @click="checkIn(selectedRoom.reservation.id)" 
                                            x-show="!selectedRoom.reservation.checked_in_at"
                                            class="btn-premium flex-1">
                                        Check-in
                                    </button>
                                    <button @click="checkOut(selectedRoom.reservation.id)" 
                                            x-show="selectedRoom.reservation.checked_in_at && !selectedRoom.reservation.checked_out_at"
                                            class="btn-premium-outline flex-1">
                                        Check-out
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Estado Manual -->
                        <div class="pt-4 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-700 mb-3">Control Manual</h4>
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r-lg mb-3">
                                <p class="text-sm text-blue-800">
                                    <strong>Modo:</strong> 
                                    <span x-text="selectedRoom.manual_status === 'occupied' ? 'Ocupada (Manual)' : (selectedRoom.manual_status === 'available' ? 'Disponible (Manual)' : 'Automático (Basado en Reservas)')"></span>
                                </p>
                                <p class="text-xs text-blue-600 mt-1">
                                    Use el control manual para clientes que vienen directamente al hostal sin reserva web.
                                </p>
                            </div>
                            <div class="grid grid-cols-3 gap-2">
                                <button @click="changeStatus('occupied')" 
                                        :class="selectedRoom.manual_status === 'occupied' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-red-100'"
                                        class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                                    Marcar Ocupada
                                </button>
                                <button @click="changeStatus('available')" 
                                        :class="selectedRoom.manual_status === 'available' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-green-100'"
                                        class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                                    Marcar Libre
                                </button>
                                <button @click="changeStatus('auto')" 
                                        :class="!selectedRoom.manual_status ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100'"
                                        class="px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                                    Modo Automático
                                </button>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="flex gap-2 pt-4 border-t border-gray-200">
                            <button @click="changeStatus('maintenance')" 
                                    x-show="selectedRoom.status !== 'maintenance'"
                                    class="btn-premium-outline flex-1">
                                Marcar Mantenimiento
                            </button>
                            <button @click="changeStatus('available')" 
                                    x-show="selectedRoom.status === 'maintenance'"
                                    class="btn-premium flex-1">
                                Liberar Mantenimiento
                            </button>
                            <button @click="viewHistory(selectedRoom.id)" class="btn-premium-outline flex-1">
                                Ver Historial
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<style>
.room-card {
    transition: all 0.3s ease;
}

.room-card:hover {
    transform: translateY(-4px);
}
</style>

<script>
function roomStatusApp() {
    return {
        showModal: false,
        selectedRoom: null,
        searchQuery: '',
        statusFilter: '',
        categoryFilter: '',
        showNotifications: true,
        roomsData: @json($roomsWithStatus->values()),

        init() {
            // Auto-refresh cada 30 segundos
            setInterval(() => {
                this.refreshData();
            }, 30000);
        },


        async showRoomDetails(roomId) {
            try {
                const response = await fetch(`/admin/room-status/${roomId}/status`);
                const data = await response.json();
                this.selectedRoom = data;
                this.showModal = true;
            } catch (error) {
                console.error('Error:', error);
                alert('Error al cargar los detalles de la habitación');
            }
        },

        async changeStatus(status) {
            if (!this.selectedRoom) return;
            
            let confirmMessage = '';
            let note = null;
            
            if (status === 'occupied') {
                confirmMessage = '¿Marcar esta habitación como OCUPADA manualmente? Esto sobrescribirá el estado automático.';
            } else if (status === 'available' && this.selectedRoom.manual_status !== 'occupied') {
                confirmMessage = '¿Marcar esta habitación como DISPONIBLE manualmente?';
            } else if (status === 'auto') {
                confirmMessage = '¿Volver al modo AUTOMÁTICO? El estado se calculará basado en las reservas.';
            } else if (status === 'maintenance') {
                note = prompt('Motivo del mantenimiento:');
                if (!note) return;
                confirmMessage = '¿Marcar esta habitación como EN MANTENIMIENTO?';
            }
            
            if (confirmMessage && !confirm(confirmMessage)) return;

            try {
                const response = await fetch(`/admin/room-status/${this.selectedRoom.id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status, maintenance_note: note })
                });

                const data = await response.json();
                if (data.success) {
                    this.selectedRoom = data.room;
                    this.refreshData();
                    alert('Estado actualizado correctamente');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al actualizar el estado');
            }
        },

        async checkIn(reservationId) {
            try {
                const response = await fetch(`/admin/room-status/reservations/${reservationId}/check-in`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                if (data.success) {
                    await this.showRoomDetails(this.selectedRoom.id);
                    alert('Check-in realizado correctamente');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al realizar el check-in');
            }
        },

        async checkOut(reservationId) {
            if (!confirm('¿Confirmar check-out de esta reserva?')) return;

            try {
                const response = await fetch(`/admin/room-status/reservations/${reservationId}/check-out`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                if (data.success) {
                    await this.showRoomDetails(this.selectedRoom.id);
                    alert('Check-out realizado correctamente');
                    this.refreshData();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al realizar el check-out');
            }
        },

        viewHistory(roomId) {
            window.location.href = `/admin/room-status/${roomId}/history`;
        },

        filterRooms() {
            const query = this.searchQuery.toLowerCase().trim();
            const status = this.statusFilter;
            const category = this.categoryFilter;
            
            document.querySelectorAll('.room-card').forEach(card => {
                const roomStatus = card.getAttribute('data-status');
                const roomNumber = card.getAttribute('data-room-number');
                const roomName = card.getAttribute('data-room-name');
                const roomType = card.getAttribute('data-room-type');
                
                let show = true;
                
                // Filtro por búsqueda
                if (query) {
                    if (!roomNumber.includes(query) && !roomName.includes(query)) {
                        show = false;
                    }
                }
                
                // Filtro por estado
                if (status && roomStatus !== status) {
                    show = false;
                }
                
                // Filtro por categoría
                if (category) {
                    const categoryMap = {
                        'Matrimonial': 'matrimonial',
                        'Doble': 'doble',
                        'Triple': 'triple',
                        'Cuádruple': 'cuadruple',
                        'Simple': 'simple'
                    };
                    const expectedType = categoryMap[category] || category.toLowerCase();
                    if (roomType !== expectedType) {
                        show = false;
                    }
                }
                
                card.style.display = show ? 'block' : 'none';
                
                // Ocultar el contenedor de la categoría si no hay habitaciones visibles
                const categoryContainer = card.closest('.card-premium');
                if (categoryContainer) {
                    const visibleRooms = categoryContainer.querySelectorAll('.room-card[style*="block"], .room-card:not([style*="none"])');
                    if (visibleRooms.length === 0 && (query || status || category)) {
                        categoryContainer.style.display = 'none';
                    } else {
                        categoryContainer.style.display = 'block';
                    }
                }
            });
        },

        async refreshData() {
            try {
                const response = await fetch('/admin/room-status');
                // Recargar la página para obtener datos actualizados
                location.reload();
            } catch (error) {
                console.error('Error al refrescar:', error);
            }
        }
    }
}
</script>
@endsection

