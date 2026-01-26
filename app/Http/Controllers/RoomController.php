<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Generar clave de cache única basada en los filtros
        $cacheKey = 'rooms.index.' . md5(json_encode($request->all()));
        
        // Cache de 5 minutos para resultados filtrados (los filtros cambian frecuentemente)
        $rooms = Cache::remember($cacheKey, 300, function () use ($request) {
            $query = Room::where('is_available', true);

            // Filtro por precio mínimo - aplicar siempre que se especifique, mínimo 70
            if ($request->filled('min_price')) {
                $minPriceFilter = max(70, (int) $request->min_price);
                $query->where('price_per_night', '>=', $minPriceFilter);
            }

            // Filtro por precio máximo - aplicar siempre que se especifique
            if ($request->filled('max_price')) {
                $maxPriceFilter = (int) $request->max_price;
                if ($maxPriceFilter > 0) {
                    $query->where('price_per_night', '<=', $maxPriceFilter);
                }
            }

            // Filtro por capacidad
            if ($request->has('capacity') && $request->capacity) {
                $query->where('capacity', '>=', $request->capacity);
            }

            // Filtro por tipo de habitación - solo aplicar si se especifica explícitamente y no está vacío
            if ($request->filled('room_type') && trim($request->room_type) !== '') {
                $roomType = strtolower(trim($request->room_type));
                // Normalizar nombres de tipos
                $typeMap = [
                    'matrimonial' => 'matrimonial',
                    'simple' => 'simple',
                    'doble' => 'doble',
                    'triple' => 'triple',
                    'cuadruple' => 'cuadruple',
                    'cuádruple' => 'cuadruple',
                ];
                $normalizedType = $typeMap[$roomType] ?? $roomType;
                if ($normalizedType && $normalizedType !== '') {
                    $query->where('room_type', $normalizedType);
                }
            }

            // Ordenamiento
            $sortBy = $request->get('sort', 'sort_order');
            $sortOrder = $request->get('order', 'asc');
            
            if ($sortBy === 'price') {
                $query->orderBy('price_per_night', $sortOrder);
            } elseif ($sortBy === 'price_desc') {
                $query->orderBy('price_per_night', 'desc');
            } else {
                $query->orderBy('sort_order', $sortOrder);
            }

            return $query->with(['images', 'reviews', 'reservations' => function($q) {
                $q->where('status', 'confirmed')
                  ->where('check_out', '>=', now());
            }])->get();
        });
        
        // Agregar información de disponibilidad a cada habitación (mostrar todas, sin filtrar)
        $rooms = $rooms->map(function($room) {
            $room->availability_status = $room->getAvailabilityStatus();
            return $room;
        });
        
        // Filtro por calificación mínima (después de obtener los resultados)
        if ($request->has('min_rating') && $request->min_rating) {
            $minRating = (float) $request->min_rating;
            $rooms = $rooms->filter(function($room) use ($minRating) {
                $avgRating = $room->reviews->avg('rating') ?? 0;
                return $avgRating >= $minRating;
            });
        }
        
        // Cache de precios (30 minutos) - estos valores cambian poco
        $priceCacheKey = 'rooms.price_range';
        $priceData = Cache::remember($priceCacheKey, 1800, function () {
            return [
                'max' => Room::where('is_available', true)->max('price_per_night') ?? 500,
                'min_available' => Room::where('is_available', true)->min('price_per_night') ?? 70,
            ];
        });
        
        $maxPrice = $priceData['max'];
        $minPriceAvailable = $priceData['min_available'];
        // El precio mínimo del filtro siempre será 70 (precio de la habitación simple más barata)
        $minPrice = 70;
        
        // Total de habitaciones (todas, sin filtrar por disponibilidad)
        $totalRooms = Cache::remember('rooms.total', 300, function () {
            return Room::where('is_available', true)->count();
        });
        
        // Calificación promedio de todas las reseñas aprobadas
        $avgRating = Cache::remember('reviews.average_rating', 1800, function () {
            return round(Review::where('is_approved', true)->avg('rating') ?? 0, 1);
        });

        return view('rooms.index', compact('rooms', 'maxPrice', 'minPrice', 'minPriceAvailable', 'totalRooms', 'avgRating'));
    }

    public function show($slug)
    {
        // Cache de detalles de habitación (10 minutos) - datos que cambian poco
        $room = Cache::remember("room.{$slug}", 600, function () use ($slug) {
            return Room::where('slug', $slug)
                ->where('is_available', true)
                ->with(['images' => function($query) {
                    $query->orderBy('is_primary', 'desc')->orderBy('sort_order');
                }, 'reservations' => function($q) {
                    $q->where('status', 'confirmed')
                      ->where('check_out', '>=', now());
                }])
                ->firstOrFail();
        });
        
        // Agregar información de disponibilidad
        $room->availability_status = $room->getAvailabilityStatus();

        // Cache de reseñas aprobadas (5 minutos) - pueden cambiar más frecuentemente
        $approvedReviews = Cache::remember("room.{$slug}.reviews.approved", 300, function () use ($room) {
            return $room->reviews()->where('is_approved', true)->orderBy('created_at', 'desc')->get();
        });
        
        // Si el usuario está autenticado, también cargar su reseña pendiente si existe
        // NO cachear esto porque es específico del usuario
        $userPendingReview = null;
        $userHasReviewed = false;
        
        if (auth()->check()) {
            $userPendingReview = \App\Models\Review::where('user_id', auth()->id())
                ->where('room_id', $room->id)
                ->where('is_approved', false)
                ->first();
            
            $userHasReviewed = \App\Models\Review::where('user_id', auth()->id())
                ->where('room_id', $room->id)
                ->exists();
        }
        
        // Combinar reseñas aprobadas con la reseña pendiente del usuario (si existe)
        $allReviews = $approvedReviews;
        if ($userPendingReview) {
            $allReviews = $approvedReviews->prepend($userPendingReview);
        }
        
        // Asignar las reseñas combinadas a la habitación
        $room->setRelation('reviews', $allReviews);

        // Cache de habitaciones relacionadas (15 minutos)
        $relatedRooms = Cache::remember("room.{$slug}.related", 900, function () use ($room) {
            return Room::where('is_available', true)
                ->where('id', '!=', $room->id)
                ->orderBy('sort_order')
                ->with(['primaryImage', 'images'])
                ->take(3)
                ->get();
        });

        return view('rooms.show', compact('room', 'relatedRooms', 'userHasReviewed'));
    }
}
