<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    protected $table = 'repartidores';

    protected $primaryKey = 'repartidor_id';
    protected $fillable = [
        'correo', 'password', 'nombre', 'apellido', 'telefono'
    ];
    public $timestamps = false;

    public static function rules($data)
    {
        return Validator::make($data, [
            'correo' => 'required|string|max:255|unique:repartidores,correo,' . $data['repartidor_id'] . ',repartidor_id', // Corrección de 'requiered' a 'required' y agregado de validación unique
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ])->validate();
    }
}
