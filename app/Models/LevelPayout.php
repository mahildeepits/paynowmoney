<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelPayout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'level',
        'amount',
        'tds',
        'admin_charges',
        'net_amount',
    ];
}
