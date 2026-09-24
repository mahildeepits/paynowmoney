<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'transaction_id', 'receipt_image', 'status', 'remarks'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'member_id');
    }
}
