<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFd extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fd_master_id',
        'amount',
        'duration_months',
        'total_expected_return',
        'status',
        'payment_screenshot',
        'payment_method',
        'transaction_id',
        'admin_remarks',
        'start_date',
        'maturity_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(FdMaster::class, 'fd_master_id');
    }
}
