<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio', 'descuento', 'imagen', 'seccion', 'vendedor_id'];

    public static function rules($data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'imagen' => 'required|string|max:255',
            'seccion' => 'required|string|max:255',
            'vendedor_id' => 'required|exists:vendedores,id',
        ])->validate();
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
}
