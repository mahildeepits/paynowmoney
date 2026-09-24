<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairCount extends Model
{
    protected $fillable = ['pair_count','amount','user_id'];
}
