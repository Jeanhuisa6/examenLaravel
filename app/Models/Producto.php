<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['categoria_id', 'nombre', 'descripcion', 'precio', 'stock'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class);
    }
}