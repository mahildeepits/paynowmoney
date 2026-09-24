<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','nominee_name','nominee_relation','nominee_dob','bank_name','bank_address','pan_number',
        'account_number','ifsc_code',
        'account_holder_name',
        'bank_branch',
        'bank_city',
        'google_pay',
        'bhim_pay',
        'paytm_no',
        'phone_pay',
        'canceled_cheque'
    ];

    protected static function newFactory()
    {
        return \Modules\Member\Database\factories\UserBankDetailFactory::new();
    }
}
