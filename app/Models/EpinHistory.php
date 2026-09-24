<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpinHistory extends Model
{
    use HasFactory;

    protected $table = 'epin_history';

    protected $fillable = ['pin_no','transfer_from','transfer_to','joining_kit'];
}
