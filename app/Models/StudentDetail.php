<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['profile_picture','user_id','course_id','father_name','mother_name','address','phone',
        'country','district','aadhaar_no','language','qualification','class_type','class_center'];

    protected $tempCenters = [
        'center_one' => 'Center One',
        'center_two' => 'Center Two'
    ];
    protected $classTypes = [
        'online' => 'Online',
        'offline' => 'Offline'
    ];

    public function getClassTypes(){
        return $this->classTypes;
    }

    public function getTempCenters(){
        return $this->tempCenters;
    }
}
