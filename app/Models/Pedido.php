<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos'; // Especificamos el nombre de la tabla

    protected $primaryKey = 'pedido_id'; // Especificamos el nombre de la llave primaria

    protected $fillable = [ // Especificamos los campos que pueden ser asignados en masa
        'cliente_id',
        'fecha_pedido',
        'direccion',
        'descripcion',
        'cantidad',
        'estado_pedido',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }
}
