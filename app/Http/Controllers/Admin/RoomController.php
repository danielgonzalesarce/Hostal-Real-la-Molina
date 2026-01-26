<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Mapear nombres de tipos en español
        $typeNames = [
            'simple' => 'Simple',
            'doble' => 'Doble',
            'matrimonial' => 'Matrimonial',
            'triple' => 'Triple',
            'cuadruple' => 'Cuádruple',
        ];
        
        // Ordenar los tipos en el orden deseado
        $orderedTypes = ['matrimonial', 'simple', 'doble', 'triple', 'cuadruple'];
        
        // Si hay un tipo seleccionado, mostrar solo esas habitaciones
        if ($request->has('type') && $request->type) {
            $selectedType = $request->type;
            $rooms = Room::with('primaryImage')
                ->where('room_type', $selectedType)
                ->orderBy('sort_order')
                ->get();
            
            // Contar habitaciones por tipo para el sidebar
            $roomsByType = Room::selectRaw('room_type, COUNT(*) as count')
                ->groupBy('room_type')
                ->pluck('count', 'room_type')
                ->toArray();
            
            return view('admin.rooms.index', compact('rooms', 'typeNames', 'orderedTypes', 'selectedType', 'roomsByType'));
        }
        
        // Si no hay tipo seleccionado, mostrar solo las categorías
        $roomsByType = Room::selectRaw('room_type, COUNT(*) as count, AVG(price_per_night) as avg_price')
            ->groupBy('room_type')
            ->get()
            ->keyBy('room_type');
        
        return view('admin.rooms.index', compact('typeNames', 'orderedTypes', 'roomsByType'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|in:simple,doble,matrimonial,triple,cuadruple',
            'description' => 'required|string',
            'amenities' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $room = Room::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'room_type' => $request->room_type,
            'description' => $request->description,
            'amenities' => $request->amenities,
            'capacity' => $request->capacity,
            'price_per_night' => $request->price_per_night,
            'is_available' => $request->has('is_available'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        // Limpiar cache relacionado
        Cache::forget('home.featured_rooms');
        Cache::forget('rooms.price_range');
        Cache::forget('rooms.total_available');
        Cache::flush(); // Limpiar todo el cache de habitaciones ya que puede afectar listados

        return redirect()->route('admin.rooms.index')->with('success', 'Habitación creada exitosamente.');
    }

    public function show($id)
    {
        $room = Room::with('images')->findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::with('images')->findOrFail($id);
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|in:simple,doble,matrimonial,triple,cuadruple',
            'description' => 'required|string',
            'amenities' => 'nullable|string',
            'capacity' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'is_available' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $room->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'room_type' => $request->room_type,
            'description' => $request->description,
            'amenities' => $request->amenities,
            'capacity' => $request->capacity,
            'price_per_night' => $request->price_per_night,
            'is_available' => $request->has('is_available'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $room->images()->count() + $index,
                ]);
            }
        }

        // Limpiar cache relacionado con esta habitación
        Cache::forget("room.{$room->slug}");
        Cache::forget("room.{$room->slug}.reviews.approved");
        Cache::forget("room.{$room->slug}.related");
        Cache::forget('home.featured_rooms');
        Cache::forget('rooms.price_range');
        Cache::forget('rooms.total_available');
        // Limpiar cache de listados (puede haber múltiples combinaciones de filtros)
        Cache::flush();

        return redirect()->route('admin.rooms.index')->with('success', 'Habitación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        
        foreach ($room->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $slug = $room->slug;
        $room->delete();

        // Limpiar cache relacionado
        Cache::forget("room.{$slug}");
        Cache::forget("room.{$slug}.reviews.approved");
        Cache::forget("room.{$slug}.related");
        Cache::forget('home.featured_rooms');
        Cache::forget('rooms.price_range');
        Cache::forget('rooms.total_available');
        Cache::flush(); // Limpiar todo el cache de habitaciones

        return redirect()->route('admin.rooms.index')->with('success', 'Habitación eliminada exitosamente.');
    }

    /**
     * Eliminar una imagen individual de una habitación
     */
    public function deleteImage($roomId, $imageId)
    {
        $room = Room::findOrFail($roomId);
        $image = RoomImage::where('room_id', $roomId)->findOrFail($imageId);
        
        // Eliminar archivo físico
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        // Si era la imagen principal, establecer otra como principal
        if ($image->is_primary) {
            $otherImage = RoomImage::where('room_id', $roomId)
                ->where('id', '!=', $imageId)
                ->first();
            if ($otherImage) {
                $otherImage->update(['is_primary' => true]);
            }
        }
        
        $image->delete();

        // Limpiar cache de la habitación
        Cache::forget("room.{$room->slug}");
        Cache::forget("room.{$room->slug}.related");
        Cache::forget('home.featured_rooms');

        return redirect()->back()->with('success', 'Imagen eliminada exitosamente.');
    }

    /**
     * Establecer una imagen como principal
     */
    public function setPrimaryImage($roomId, $imageId)
    {
        $room = Room::findOrFail($roomId);
        $image = RoomImage::where('room_id', $roomId)->findOrFail($imageId);
        
        // Quitar la marca de principal de todas las imágenes de esta habitación
        RoomImage::where('room_id', $roomId)->update(['is_primary' => false]);
        
        // Establecer esta imagen como principal
        $image->update(['is_primary' => true]);

        // Limpiar cache de la habitación
        Cache::forget("room.{$room->slug}");
        Cache::forget("room.{$room->slug}.related");
        Cache::forget('home.featured_rooms');

        return redirect()->back()->with('success', 'Imagen principal actualizada exitosamente.');
    }
}
