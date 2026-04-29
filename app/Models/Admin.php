<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $table = 'admins';
    protected $guard_name = 'admin';
    
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

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
    
    public function adminlte_image()
    {
    return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?d=mp';
    }

    public function adminlte_desc()
    {
    return 'Administrador';
    }

    public function adminlte_profile_url()
    {
    return '#';
    }

}