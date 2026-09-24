<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycDoc extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','kyc_type','card_no','card_front','card_back'];

    public static $kycTypes = [1=>'Aadhar Card', 2=>'Voter Card', 3=>'Driving Licence', 4=>'Passport No',5=>'Pan Card'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
