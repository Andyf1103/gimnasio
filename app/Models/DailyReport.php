<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $table = 'daily_reports';
    
    protected $fillable = [
        'fecha',
        'total_membresias',
        'total_efectivo',
        'total_digital',
        'total_general',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];
}