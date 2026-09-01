<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuário de teste técnico
        User::updateOrCreate(
            ['email' => 'tecnico@site.com'],
            [
                'name' => 'Técnico Exemplo',
                'password' => bcrypt('tecnico123'),
                'perfil' => 'tecnico',
                'email_verified_at' => now(),
            ]
        );

        // Cria o papel admin se não existir
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $tecnicoRole = Role::firstOrCreate(['name' => 'tecnico']);
        $clienteRole = Role::firstOrCreate(['name' => 'cliente']);

        // Cria o usuário admin e atribui o papel
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'perfil' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // Cria o usuário cliente e atribui o papel
        $cliente = User::updateOrCreate(
            ['email' => 'cliente@site.com'],
            [
                'name' => 'Cliente Exemplo',
                'password' => bcrypt('cliente123'),
                'perfil' => 'cliente',
                'email_verified_at' => now(),
            ]
        );
        $cliente->assignRole($clienteRole);

        // Garante que o técnico tenha o papel correto
        $tecnico = User::where('email', 'tecnico@site.com')->first();
        if ($tecnico) {
            $tecnico->assignRole($tecnicoRole);
        }

        // Executa primeiro o seeder de validação de imagens
        $this->call([
            ImageValidationSeeder::class,
        ]);

        // Executa os seeders de posts e banners
        $this->call([
            TestSeeder::class,
            BannerSeeder::class,
            PostSeeder::class,
            PostSeeder2::class,
            PostSeeder3::class,
            PostSeeder4::class,
            PostSeeder5::class,
        ]);
    }
}
