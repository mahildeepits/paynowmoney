<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutopoolIncome extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'child_ids',
        'level',
        'income',
        'autopool_id',
    ];
    protected $casts = [
        'child_ids' => 'array',
        'income' => 'integer'
    ];
    public function autopool(){
        return $this->belongsTo(AutoPool::class,'autopool_id','id');
    }
}
