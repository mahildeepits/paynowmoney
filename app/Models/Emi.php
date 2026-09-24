<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_loan_id',
        'amount',
        'emi_number',
        'due_date',
        'month',
        'status',
        'screenshot',
        'paid_at',
        'approved_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userLoan()
    {
        return $this->belongsTo(UserLoan::class);
    }

    public function getScreenshotUrlAttribute()
    {
        return $this->screenshot ? asset('storage/' . $this->screenshot) : null;
    }
}
