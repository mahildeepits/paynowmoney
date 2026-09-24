<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditionalInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'education',
        'tech_education',
        'language',
        'skills',
        'experiences',
        'inspirations',
    ];

    protected $casts = [
        'skills' => 'array',
        'experiences' => 'array',
        'inspirations' => 'array',
    ];
}
