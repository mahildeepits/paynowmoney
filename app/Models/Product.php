<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['id','category_id', 'sub_category_id', 'name','price','description','stock_available', 'discount','quantity','delivery_charge','sizes'];
    public function album(){
        return $this->hasMany(Image::class,'product_id','id');
    }
    public function subcategory(){
            return $this->belongsTo(Category::class,'category_id','id');
    }
    public function category(){
            return $this->belongsTo(Category::class,'category_id','parent');
    }
}
