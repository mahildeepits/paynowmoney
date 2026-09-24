<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'loan_amount',
        'emi_amount',
        'total_emis',
        'payable_amount',
        'required_direct_users',
        'status',
    ];
}
