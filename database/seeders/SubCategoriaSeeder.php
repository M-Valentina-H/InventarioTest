<?php

namespace Database\Seeders;

use App\Models\{Categoria, SubCategoria};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $redes = Categoria::where('nombre', 'Redes')->first()->id;
        $computacion = Categoria::where('nombre', 'Computación')->first()->id;
        $movil = Categoria::where('nombre', 'Móvil')->first()->id;

        $subcategorias = [
            ['categoria_id' => $redes, 'nombre' => 'Routers', 'estado' => true],
            ['categoria_id' => $redes, 'nombre' => 'Switches', 'estado' => true],
            ['categoria_id' => $computacion, 'nombre' => 'Laptops', 'estado' => true],
            ['categoria_id' => $computacion, 'nombre' => 'Monitores', 'estado' => true],
            ['categoria_id' => $movil, 'nombre' => 'Smartphones', 'estado' => true],
        ];

        foreach ($subcategorias as $sub) {
            SubCategoria::updateOrCreate(['nombre' => $sub['nombre']], $sub);
        }
    }
}
