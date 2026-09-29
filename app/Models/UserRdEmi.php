<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRdEmi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userRd()
    {
        return $this->belongsTo(UserRd::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
