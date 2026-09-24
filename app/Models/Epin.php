<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epin extends Model
{
    use HasFactory;

    protected $fillable = ['joining_kit','pin_no','transfer_from','transfer_to','used_by','used_at'];

    public function joining_kit_rel(){
        return $this->belongsTo(JoiningKit::class,'joining_kit','id');
    }

    public function transfer_rel(){
        return $this->belongsTo(User::class,'transfer_to','id');
    }

    public function used_by_rel(){
        return $this->belongsTo(User::class,'used_by','id');
    }

    public function pin_trasnfer_from_rel(){
        return $this->belongsTo(User::class,'transfer_from','id');
    }
}
