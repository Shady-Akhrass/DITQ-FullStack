<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'details',
        'date',
        'image',
        'status'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
