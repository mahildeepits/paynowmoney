<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleEntry extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'created_on', 'created_by'];

    protected $casts = [
        'amount' => 'integer'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
