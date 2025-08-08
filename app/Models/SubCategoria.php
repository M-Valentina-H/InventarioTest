<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = 'subcategoria';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'estado',
        'cantidad_productos'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_subcategoria', 'subcategoria_id', 'producto_id');
    }
}
