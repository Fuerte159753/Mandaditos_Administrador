<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'cliente_id';
    protected $fillable = [
        'nombre', 'apellido', 'localidad', 'telefono', 'correo', 'verificado'
    ];
    public $timestamps = false;
    public static function rules($data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:clientes,correo,' . $data['cliente_id'] . ',cliente_id',
            'verificado' => 'required|boolean',
        ])->validate();
    }
}
