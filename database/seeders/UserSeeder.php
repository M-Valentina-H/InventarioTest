<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = [
            ['name' => 'Marly Hernandez', 'email' => 'admin@skina.com', 'password' => Hash::make('admin123'), 'rol_id' => 1, 'estado' => true,],
            ['name' => 'Evelyn Cordero', 'email' => 'estandar@skina.com', 'password' => Hash::make('usuario123'), 'rol_id' => 2, 'estado' => true,],
        ];

        foreach ($usuarios as $usuario) {
            User::updateOrCreate(['email' => $usuario['email']], $usuario);
        }
    }
}
