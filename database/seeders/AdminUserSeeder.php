<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::updateOrCreate(
            ['email' => 'admin@hostalreal.com'],
            [
                'name' => 'Administrador Hostal Real',
                'password' => Hash::make('HostalReal2024!'),
                'role' => 'admin',
                'phone' => '+51999999999',
            ]
        );

        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ Usuario Administrador creado exitosamente!');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('📧 Email: admin@hostalreal.com');
        $this->command->info('🔑 Contraseña: HostalReal2024!');
        $this->command->info('🔗 URL Login Admin: /admin/login');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->warn('⚠️  IMPORTANTE: Guarda estas credenciales de forma segura');
        $this->command->warn('⚠️  El login admin NO está visible en la navegación pública');
    }
}
