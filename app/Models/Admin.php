<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $table = 'admins';
    
    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'email',
        'telefono',
        'contrasena',
    ];

    protected $hidden = [
        'contrasena',
    ];
}