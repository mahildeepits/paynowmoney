<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'income_type',
        'amount',
        'tds',
        'admin_charges',
        'net_amount',
        'is_requested',
        'is_paid',
        'transaction_id',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
        'tds' => 'integer',
        'admin_charges' => 'integer',
        'net_amount' => 'integer',
    ];

    protected $appends = ['income_name'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getIncomeNameAttribute() {
        $incomeType = $this->income_type;
        if (in_array($incomeType, ['direct', 'direct_income'])) { return "Direct Income"; } 
        else if (in_array($incomeType, ['pair_income', 'pair'])) { return "Pair Matching Income"; } 
        else if (in_array($incomeType, ['reward_income', 'reward'])) { return "Reward Income"; } 
        else if (in_array($incomeType, ['withdrawal', 'withdrawal_income'])) { return "Withdrawal"; } 
        else { return ucwords(str_replace('_', ' ', $incomeType)); }
    }
}
