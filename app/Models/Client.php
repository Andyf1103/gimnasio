<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
    ];

    protected $casts = [
        'fecha_inscripcion' => 'datetime',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function controls(): HasMany
    {
        return $this->hasMany(ClientControl::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}