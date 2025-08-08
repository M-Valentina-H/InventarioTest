<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\SubCategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSubCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asociaciones = [
            ['producto' => 'Router TP-Link', 'subcategorias' => ['Routers']],
            ['producto' => 'Switch Cisco', 'subcategorias' => ['Switches']],
            ['producto' => 'Laptop Dell XPS', 'subcategorias' => ['Laptops']],
            ['producto' => 'Monitor LG 24"', 'subcategorias' => ['Monitores']],
            ['producto' => 'iPhone 14', 'subcategorias' => ['Smartphones']],
        ];

        foreach ($asociaciones as $asoc) {
            $producto = Producto::where('nombre', $asoc['producto'])->first();

            foreach ($asoc['subcategorias'] as $subNombre) {
                $sub = SubCategoria::where('nombre', $subNombre)->first();
                $producto->subCategorias()->syncWithoutDetaching([$sub->id]);
            }
        }
    }
}
