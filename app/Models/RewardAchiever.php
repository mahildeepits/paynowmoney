<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardAchiever extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','reward_id','pairs','is_given'];

    public function reward(){
        return $this->belongsTo(Reward::class,'reward_id','id');
    }
}
