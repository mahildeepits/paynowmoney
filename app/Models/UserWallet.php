<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;
    protected $fillable = ['username','amount'];

    public static function getWalletAmount(){
        $user = \Auth::guard('member')->user();
        return $user->total_income;
    }
}
