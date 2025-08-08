<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Router TP-Link', 'estado' => true],
            ['nombre' => 'Switch Cisco', 'estado' => true],
            ['nombre' => 'Laptop Dell XPS', 'estado' => true],
            ['nombre' => 'Monitor LG 24"', 'estado' => true],
            ['nombre' => 'iPhone 14', 'estado' => true],
        ];

        foreach ($productos as $prod) {
            Producto::updateOrCreate(['nombre' => $prod['nombre']], $prod);
        }
    }
}
