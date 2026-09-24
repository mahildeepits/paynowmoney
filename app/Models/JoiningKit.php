<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoiningKit extends Model
{
    use HasFactory;

    protected $fillable = ['kit_name','kit_pv','amount', 'direct_income', 'bonus_amount', 'level2_5', 'level6_15', 'level16_25','autopool_id','upgrade_require_user_count'];

    protected $casts = [
        'amount' => 'integer',
        'direct_income' => 'integer',
        'bonus_amount' => 'integer',
        'level2_5' => 'integer',
        'level6_15' => 'integer',
        'level26_25' => 'integer',
    ];

    public function pins(){
        return $this->hasMany(Epin::class,'joining_kit');
    }
    public function unUsedPins(){
        return $this->hasMany(Epin::class,'joining_kit')->whereNull('used_by')->whereNull('used_at');
    }
    public function getNameAttribute(){
        return ucwords($this->kit_name?? '');
    }
    public function autoPool(){
        return $this->belongsTo(AutoPool::class,'autopool_id','id');
    }
}
