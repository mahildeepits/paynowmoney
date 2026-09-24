<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterationBonus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bonus_amount',
        'tds',
        'net_amount',
        'admin_charges'
    ];

    protected $casts = [
        'bonus_amount' => 'integer',
        'tds' => 'integer',
        'net_amount' => 'integer',
        'admin_charges' => 'integer',
    ];
}
