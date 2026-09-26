<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_type_id',
        'status',
        'approved_at',
        'rejection_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    public function emis()
    {
        return $this->hasMany(Emi::class);
    }
}
