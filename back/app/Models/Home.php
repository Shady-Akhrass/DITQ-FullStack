<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;

class Home extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
