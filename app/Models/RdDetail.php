<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdDetail extends Model
{
    use HasFactory;

    protected $fillable = ['rd_master_id', 'emi_amount', 'months', 'return_percentage'];

    public function rdMaster()
    {
        return $this->belongsTo(RdMaster::class, 'rd_master_id');
    }
}
