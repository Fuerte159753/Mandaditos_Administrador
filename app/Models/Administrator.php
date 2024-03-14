<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    protected $table = 'administradores';

    protected $fillable = [
        'name',
        'last_name',
        'mother_last_name',
        'phone',
        'username',
        'email',
        'password',
        'password_reset_token',
        'password_reset_token_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'password_reset_token',
    ];
}

