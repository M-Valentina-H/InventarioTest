<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'estado'
    ];

    public function subCategorias()
    {
        return $this->belongsToMany(SubCategoria::class, 'producto_subcategoria', 'producto_id', 'subcategoria_id');
    }
}
