<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'title',
        'details',
        'views',
        'likes',
        'status',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    public function comments()
    {
        return $this->hasMany(EventComment::class);
    }
}
