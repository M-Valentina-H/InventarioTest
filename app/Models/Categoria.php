<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    protected $fillable = [
        'nombre', 
        'estado'
    ];

    public function subCategorias()
    {
        return $this->hasMany(SubCategoria::class, 'categoria_id');
    }
}
