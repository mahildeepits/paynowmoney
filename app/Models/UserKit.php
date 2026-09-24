<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kit_id',
        'epin_id',
    ];
}
