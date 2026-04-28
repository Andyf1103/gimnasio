<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasRoles;

    protected $table = 'employees';
    protected $guard_name = 'employee';
    
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'contrasena',
        'estado',
    ];

    protected $hidden = [
        'contrasena',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}