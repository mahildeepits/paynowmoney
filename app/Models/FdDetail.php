<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'fd_master_id',
        'amount',
        'months',
        'return_percentage'
    ];

    public function master()
    {
        return $this->belongsTo(FdMaster::class, 'fd_master_id');
    }
}
