<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = ['username','tree','pair_count','pair_amount','direct_income','tds','admin_charge','net_amount', 'level', 'level_income'];

    protected $casts = [
        'pair_count' => 'integer',
        'pair_amount' => 'integer',
        'direct_income' => 'integer',
        'tds' => 'integer',
        'admin_charge' => 'integer',
        'net_amount' => 'integer',
        'level' => 'integer',
        'level_income' => 'integer',
    ];

    public function user_rel(){
        return $this->belongsTo(User::class,'member_id','username');
    }
}
