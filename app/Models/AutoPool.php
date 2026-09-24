<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoPool extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'count_4',
        'count_16',
        'count_64',
        'count_256',
        'count_1024',
        'count_4096',
        'count_16384',
    ];

    protected $casts = [
        'count_4' => 'integer',
        'count_16' => 'integer',
        'count_64' => 'integer',
        'count_256' => 'integer',
        'count_1024' => 'integer',
        'count_4096' => 'integer',
        'count_16384' => 'integer',
    ];
    public function joiningKit(){
        return $this->hasOne(JoiningKit::class,'autopool_id','id');
    }
}
