<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'role_id',
        'estado',
    ];

    protected $hidden = [
        'contrasena',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function getNameAttribute(): string
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function adminlte_image()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->correo)) . '?d=mp';
    }

    public function adminlte_desc()
    {
        return $this->getRoleNames()->first() ?? 'Empleado';
    }

    public function adminlte_profile_url()
    {
        return '#';
    }
}
