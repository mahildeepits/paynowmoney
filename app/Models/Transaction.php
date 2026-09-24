<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_address',
        'type',
        'amount',
        'transaction_fees',
        'net_amount',
        'transaction_hash',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
        'transaction_fees' => 'integer',
        'net_amount' => 'integer',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
