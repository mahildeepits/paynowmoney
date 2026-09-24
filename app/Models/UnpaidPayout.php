<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnpaidPayout extends Model
{
    use HasFactory;

    protected $fillable = ['username','tree','pair_count','pair_amount','direct_income','tds','admin_charges','net_amount','credit_or_cut'];

    protected $casts = [
        'pair_count' => 'integer',
        'pair_amount' => 'integer',
        'direct_income' => 'integer',
        'tds' => 'integer',
        'admin_charges' => 'integer',
        'net_amount' => 'integer',
    ];
}
