<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdMaster extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function details()
    {
        return $this->hasMany(FdDetail::class);
    }
}
