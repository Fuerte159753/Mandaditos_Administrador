<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    protected $table = 'repartidores';

    protected $primaryKey = 'repartidor_id';
    protected $fillable = [
        'correo', 'password', 'nombre', 'apellido', 'telefono', 'username', 'ruta_asignada', 'password_reset_token', 'password_reset_token_expires_at'
    ];
    public $timestamps = false;
    public static function rules1($data)
    {
        return Validator::make($data, [
            'correo' => 'required|email|unique:repartidores,correo,' . $data['repartidor_id'] . ',repartidor_id',
            'username' => 'required|string|max:255|unique:repartidores,username,' . $data['repartidor_id'] . ',repartidor_id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ])->validate();
    }
    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'ruta_asignada', 'id');
    }
}
