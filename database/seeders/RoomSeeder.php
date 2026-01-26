<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar habitaciones existentes (solo si no hay datos importantes)
        // Si ya tienes habitaciones con reservas, comenta las siguientes líneas
        if (Room::count() > 0) {
            $this->command->warn('⚠️  Ya existen ' . Room::count() . ' habitaciones en la base de datos.');
            $this->command->warn('⚠️  Si deseas recrear todas las habitaciones, elimínalas primero desde el panel de administrador.');
            $this->command->info('📝 Creando solo habitaciones nuevas (sin duplicar números de habitación)...');
            
            // Obtener números de habitación existentes
            $existingNumbers = Room::all()->map(function($room) {
                preg_match('/\d+/', $room->name, $matches);
                return isset($matches[0]) ? (int)$matches[0] : null;
            })->filter()->toArray();
        } else {
            $existingNumbers = [];
        }

        $rooms = [];

        // Descripciones variadas para habitaciones matrimoniales
        $matrimonialDescriptions = [
            'Acogedora habitación matrimonial con cama king size, ideal para parejas. Decoración elegante y ambiente romántico.',
            'Espaciosa habitación matrimonial con vista exterior, perfecta para una escapada romántica. Incluye todas las comodidades premium.',
            'Habitación matrimonial con balcón privado, disfruta de la brisa fresca y la tranquilidad. Ambiente acogedor y relajante.',
            'Habitación matrimonial premium con diseño contemporáneo. Espacios amplios y comodidades de lujo para tu máximo confort.',
            'Habitación matrimonial con excelente iluminación natural. Perfecta para descansar después de un día de actividades.',
            'Habitación matrimonial con cama king size y área de descanso. Decoración moderna y elegante para tu estadía.',
            'Habitación matrimonial espaciosa con todas las comodidades. Ideal para parejas que buscan confort y privacidad.',
            'Habitación matrimonial con vista panorámica. Ambiente tranquilo y relajante para una estadía memorable.',
            'Habitación matrimonial con diseño premium. Incluye área de trabajo y espacio adicional para tu comodidad.',
            'Habitación matrimonial con cama king size y baño privado amplio. Perfecta para una experiencia de lujo.',
            'Habitación matrimonial con decoración elegante. Espacios bien distribuidos y ambiente acogedor para parejas.',
            'Habitación matrimonial premium con todas las comodidades. Ideal para una estadía romántica e inolvidable.',
        ];

        // Habitaciones Matrimoniales (12 habitaciones) - S/ 90.00
        $matrimonialRooms = [101, 204, 205, 301, 305, 310, 400, 406, 407, 502, 504, 506];
        foreach ($matrimonialRooms as $index => $roomNumber) {
            $rooms[] = [
                'name' => "Habitación Matrimonial {$roomNumber}",
                'room_type' => 'matrimonial',
                'description' => $matrimonialDescriptions[$index] ?? $matrimonialDescriptions[0],
                'amenities' => 'WiFi gratuito, TV LED 32", Aire acondicionado, Baño privado, Agua caliente, Secador de pelo, Cama King Size, Caja fuerte',
                'capacity' => 2,
                'price_per_night' => 90.00,
                'is_available' => true,
                'sort_order' => $index + 1,
            ];
        }

        // Descripciones variadas para habitaciones simples
        $simpleDescriptions = [
            'Habitación simple y funcional, perfecta para viajeros individuales. Incluye todas las comodidades básicas para una estadía cómoda.',
            'Habitación simple con cama individual, ideal para estadías cortas. Ambiente limpio y acogedor con excelente relación calidad-precio.',
            'Habitación simple económica, perfecta para presupuestos ajustados. Todas las comodidades esenciales incluidas para tu confort.',
            'Habitación simple funcional con excelente iluminación. Perfecta para descansar después de un día de actividades.',
            'Habitación simple con diseño moderno y espacios bien distribuidos. Ideal para viajeros que buscan comodidad sin complicaciones.',
            'Habitación simple con cama individual cómoda. Ambiente tranquilo y relajante para una estadía placentera.',
            'Habitación simple con todas las comodidades necesarias. Perfecta para viajeros que valoran la simplicidad y el confort.',
            'Habitación simple con baño privado y excelente ventilación. Ideal para estadías individuales cómodas y económicas.',
            'Habitación simple con espacio suficiente para una persona. Incluye todas las comodidades básicas para tu estadía.',
            'Habitación simple funcional con cama individual. Ambiente acogedor y limpio para tu máximo confort.',
            'Habitación simple con diseño práctico. Perfecta para viajeros que buscan una estadía cómoda y económica.',
            'Habitación simple con excelente ubicación. Incluye todas las comodidades esenciales para una estadía agradable.',
            'Habitación simple con cama individual y escritorio. Ideal para viajeros de negocios o estudiantes.',
            'Habitación simple con ambiente tranquilo. Perfecta para descansar y recargar energías durante tu viaje.',
            'Habitación simple con todas las comodidades básicas. Excelente opción para estadías individuales económicas.',
            'Habitación simple con diseño funcional. Incluye baño privado y todas las comodidades necesarias.',
            'Habitación simple con cama individual cómoda. Ambiente limpio y acogedor para tu estadía.',
            'Habitación simple con excelente relación calidad-precio. Perfecta para viajeros que buscan comodidad y economía.',
            'Habitación simple con todas las comodidades esenciales. Ideal para estadías cortas o largas.',
        ];

        // Habitaciones Simple (19 habitaciones) - S/ 70.00
        $simpleRooms = [102, 103, 105, 106, 201, 206, 208, 304, 306, 307, 311, 401, 404, 402, 405, 503, 507, 508, 509];
        foreach ($simpleRooms as $index => $roomNumber) {
            $rooms[] = [
                'name' => "Habitación Simple {$roomNumber}",
                'room_type' => 'simple',
                'description' => $simpleDescriptions[$index] ?? $simpleDescriptions[0],
                'amenities' => 'WiFi gratuito, TV LED, Aire acondicionado, Baño privado, Agua caliente, Cama individual, Escritorio',
                'capacity' => 1,
                'price_per_night' => 70.00,
                'is_available' => true,
                'sort_order' => count($matrimonialRooms) + $index + 1,
            ];
        }

        // Descripciones variadas para habitaciones dobles
        $doubleDescriptions = [
            'Habitación doble espaciosa con dos camas individuales. Perfecta para amigos o familiares que viajan juntos.',
            'Habitación doble con camas cómodas y espacio amplio. Ideal para compartir con compañero de viaje.',
            'Habitación doble moderna con todas las comodidades. Diseño funcional y espacios bien distribuidos.',
            'Habitación doble con excelente iluminación. Ambiente acogedor para dos personas con todas las comodidades.',
            'Habitación doble premium con espacio adicional. Perfecta para estadías más largas en compañía.',
            'Habitación doble con dos camas individuales cómodas. Ideal para parejas de amigos o familiares.',
        ];

        // Habitaciones Doble (6 habitaciones) - S/ 100.00
        $doubleRooms = [202, 207, 308, 309, 500, 505];
        foreach ($doubleRooms as $index => $roomNumber) {
            $rooms[] = [
                'name' => "Habitación Doble {$roomNumber}",
                'room_type' => 'doble',
                'description' => $doubleDescriptions[$index] ?? $doubleDescriptions[0],
                'amenities' => 'WiFi gratuito, TV LED 32", Aire acondicionado, Baño privado, Agua caliente, Dos camas individuales, Escritorio, Mesa de trabajo',
                'capacity' => 2,
                'price_per_night' => 100.00,
                'is_available' => true,
                'sort_order' => count($matrimonialRooms) + count($simpleRooms) + $index + 1,
            ];
        }

        // Descripciones variadas para habitaciones triples
        $tripleDescriptions = [
            'Habitación triple espaciosa con tres camas individuales. Ideal para grupos pequeños o familias con un niño.',
            'Habitación triple con distribución cómoda. Perfecta para tres personas que viajan juntas.',
            'Habitación triple moderna con espacio amplio. Todas las comodidades para tres huéspedes.',
            'Habitación triple con excelente ventilación. Ambiente fresco y cómodo para toda la familia.',
        ];

        // Habitaciones Triple (4 habitaciones) - S/ 130.00
        $tripleRooms = [203, 303, 403, 501];
        foreach ($tripleRooms as $index => $roomNumber) {
            $rooms[] = [
                'name' => "Habitación Triple {$roomNumber}",
                'room_type' => 'triple',
                'description' => $tripleDescriptions[$index] ?? $tripleDescriptions[0],
                'amenities' => 'WiFi gratuito, TV LED 40", Aire acondicionado, Baño privado, Agua caliente, Tres camas individuales, Mesa de trabajo, Sillas adicionales',
                'capacity' => 3,
                'price_per_night' => 130.00,
                'is_available' => true,
                'sort_order' => count($matrimonialRooms) + count($simpleRooms) + count($doubleRooms) + $index + 1,
            ];
        }

        // Descripciones variadas para habitaciones cuádruples
        $quadrupleDescriptions = [
            'Habitación cuádruple muy espaciosa con cuatro camas individuales. Perfecta para grupos grandes o familias numerosas.',
            'Habitación cuádruple con distribución funcional. Ideal para grupos de amigos o familiares que buscan comodidad.',
            'Habitación cuádruple premium con espacio adicional. Todas las comodidades para cuatro huéspedes con máximo confort.',
        ];

        // Habitaciones Cuádruple (3 habitaciones) - S/ 160.00
        $quadrupleRooms = [302, 408, 409];
        foreach ($quadrupleRooms as $index => $roomNumber) {
            $rooms[] = [
                'name' => "Habitación Cuádruple {$roomNumber}",
                'room_type' => 'cuadruple',
                'description' => $quadrupleDescriptions[$index] ?? $quadrupleDescriptions[0],
                'amenities' => 'WiFi gratuito, TV LED 43", Aire acondicionado, Baño privado, Agua caliente, Cuatro camas individuales, Mesa de trabajo grande, Mini nevera, Sofá',
                'capacity' => 4,
                'price_per_night' => 160.00,
                'is_available' => true,
                'sort_order' => count($matrimonialRooms) + count($simpleRooms) + count($doubleRooms) + count($tripleRooms) + $index + 1,
            ];
        }

        $created = 0;
        $skipped = 0;
        
        foreach ($rooms as $roomData) {
            // Verificar si ya existe una habitación con el mismo slug
            $slug = Str::slug($roomData['name']);
            $exists = Room::where('slug', $slug)->exists();
            
            if (!$exists) {
                Room::create([
                    'name' => $roomData['name'],
                    'slug' => $slug,
                    'room_type' => $roomData['room_type'],
                    'description' => $roomData['description'],
                    'amenities' => $roomData['amenities'],
                    'capacity' => $roomData['capacity'],
                    'price_per_night' => $roomData['price_per_night'],
                    'is_available' => $roomData['is_available'],
                    'sort_order' => $roomData['sort_order'],
                ]);
                $created++;
            } else {
                $skipped++;
            }
        }
        
        // Limpiar cache relacionado
        \Illuminate\Support\Facades\Cache::forget('rooms.total_available');
        \Illuminate\Support\Facades\Cache::forget('rooms.price_range');
        \Illuminate\Support\Facades\Cache::forget('home.featured_rooms');

        $this->command->info('');
        $this->command->info('✅ Proceso completado!');
        $this->command->info("   📦 {$created} habitaciones creadas");
        if ($skipped > 0) {
            $this->command->warn("   ⏭️  {$skipped} habitaciones omitidas (ya existían)");
        }
        $this->command->info('');
        $this->command->info('📊 Resumen de habitaciones:');
        $this->command->info('   - ' . count($matrimonialRooms) . ' Habitaciones Matrimoniales (S/ 90.00)');
        $this->command->info('   - ' . count($simpleRooms) . ' Habitaciones Simple (S/ 70.00)');
        $this->command->info('   - ' . count($doubleRooms) . ' Habitaciones Doble (S/ 100.00)');
        $this->command->info('   - ' . count($tripleRooms) . ' Habitaciones Triple (S/ 130.00)');
        $this->command->info('   - ' . count($quadrupleRooms) . ' Habitaciones Cuádruple (S/ 160.00)');
        $this->command->info('   📊 Total: ' . count($rooms) . ' habitaciones');
        $this->command->info('');
        $this->command->warn('⚠️  Nota: Las habitaciones fueron creadas sin imágenes. Agrega las imágenes desde el panel de administrador.');
        $this->command->info('💡 Total de habitaciones en BD: ' . Room::where('is_available', true)->count());
    }
}
