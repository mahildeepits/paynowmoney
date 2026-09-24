<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdMaster extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function details()
    {
        return $this->hasMany(RdDetail::class, 'rd_master_id');
    }
}
