<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aadhar_no',
        'aadhar_front',
        'aadhar_back',
        'aadhar_status',
        'aadhar_reject_reason',
        'pan_no',
        'pan_front',
        'pan_back',
        'pan_status',
        'pan_reject_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
