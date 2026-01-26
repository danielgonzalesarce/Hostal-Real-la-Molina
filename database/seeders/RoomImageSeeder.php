<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class RoomImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * NOTA: Este seeder ya no crea imágenes por defecto.
     * Las imágenes deben ser agregadas manualmente desde el panel de administrador.
     */
    public function run(): void
    {
        // Este seeder ya no crea imágenes por defecto
        // Las imágenes deben ser agregadas manualmente desde el panel de administrador
        $this->command->info('Las imágenes de habitaciones deben ser agregadas desde el panel de administrador.');
    }
}
