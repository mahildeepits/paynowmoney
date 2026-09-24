<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCharge extends Model
{
    use HasFactory;
    protected $fillable = ['tds_charges','admin_charges','direct_amount','pair_amount','capping_of_pair', 'first_sale_entry_amount','id_prefix', 'activation_fee'];
}
