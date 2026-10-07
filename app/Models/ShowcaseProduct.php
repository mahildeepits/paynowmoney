<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mrp', 'image', 'description', 'status'];
    protected $appends = ['image_url'];

    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
