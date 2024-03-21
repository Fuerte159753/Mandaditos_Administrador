<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Ruta extends Model
{
    protected $table = 'rutas';
    public $timestamps = false;
    protected $fillable = [
        'nombre'
    ];
}
