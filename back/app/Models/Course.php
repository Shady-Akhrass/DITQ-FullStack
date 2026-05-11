<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course_Image;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function images()
    {
        return $this->hasMany(Course_Image::class);
    }
}
