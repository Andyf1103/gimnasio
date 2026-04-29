<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanType extends Model
{
    protected $table = 'plan_types';
    
    protected $fillable = [
        'nombre_plan',
        'descripcion',
        'precio_plan',
        'precio_matricula',
        'duracion_dias',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}