<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletOtp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'otp',
        'is_used',
        'is_expired',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
