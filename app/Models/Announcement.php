<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute(){
        return asset('storage/uploads/announcements/'. $this->image);
    }
}
