<?php

namespace App\Console\Commands;

use App\Models\RoomImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearRoomImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rooms:clear-images {--force : Forzar eliminación sin confirmación}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina todas las imágenes de habitaciones de la base de datos y del storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = RoomImage::count();
        
        if ($count === 0) {
            $this->info('No hay imágenes de habitaciones para eliminar.');
            return 0;
        }

        if (!$this->option('force')) {
            if (!$this->confirm("¿Estás seguro de eliminar todas las {$count} imágenes de habitaciones? Esta acción no se puede deshacer.")) {
                $this->info('Operación cancelada.');
                return 0;
            }
        }

        $this->info("Eliminando {$count} imágenes de habitaciones...");

        $deleted = 0;
        $errors = 0;

        foreach (RoomImage::all() as $image) {
            try {
                // Eliminar archivo físico si existe
                if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                
                // Eliminar registro de la base de datos
                $image->delete();
                $deleted++;
            } catch (\Exception $e) {
                $this->error("Error al eliminar imagen ID {$image->id}: {$e->getMessage()}");
                $errors++;
            }
        }

        $this->info("✅ Proceso completado:");
        $this->info("   - Imágenes eliminadas: {$deleted}");
        if ($errors > 0) {
            $this->warn("   - Errores: {$errors}");
        }

        return 0;
    }
}
