<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'nombre_establecimiento', 'username', 'correo', 'contraseña', 'telefono', 'verificado', 'codigo_verificacion', 'password_reset_token', 'password_reset_token_expires_at'
    ];

    public static function rules($data)
    {
        return Validator::make($data, [
            'nombre_establecimiento' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:vendedores',
            'correo' => 'required|string|email|max:255|unique:vendedores',
            'contraseña' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:255',
            'verificado' => 'required|boolean',
            'codigo_verificacion' => 'nullable|string|max:255',
            'password_reset_token' => 'nullable|string|max:255',
            'password_reset_token_expires_at' => 'nullable|date',
        ])->validate();
    }
}
