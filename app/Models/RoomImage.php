<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    protected $fillable = [
        'room_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Obtiene la URL completa de la imagen
     */
    public function getUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800';
        }

        // Si es una URL completa (http/https), retornarla directamente
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        // Si es una ruta relativa, construir la URL del storage
        return asset('storage/' . ltrim($this->image_path, '/'));
    }
}
