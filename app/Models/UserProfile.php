<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','profile_image','father_name','mother_name','dob','gender','address','pin_code',
        'pan_card_number','pan_card_image','city','state','country','nominee_name','nominee_relation','is_pancard_approve'];
}
