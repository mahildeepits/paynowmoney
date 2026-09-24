<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $fillable = ['id','name', 'parent_id', 'category_type', 'category_images','category_slug','status'];
    use SoftDeletes;
    use HasFactory;
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }

}
