<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Member\Database\factories\UserAddressFactory::new();
    }

    public function city_rel(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
