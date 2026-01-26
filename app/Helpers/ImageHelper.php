<?php

if (!function_exists('getImageUrl')) {
    /**
     * Obtiene la URL completa de una imagen
     * 
     * @param string|null $imagePath
     * @param string $defaultImage
     * @return string
     */
    function getImageUrl(?string $imagePath, string $defaultImage = 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'): string
    {
        if (empty($imagePath)) {
            return $defaultImage;
        }

        // Si es una URL completa (http/https), retornarla directamente
        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            return $imagePath;
        }

        // Si es una ruta relativa, construir la URL del storage
        return asset('storage/' . ltrim($imagePath, '/'));
    }
}

