<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    // use HasFactory;
    protected $fillable = [
        'main',
        'secondary1',
        'secondary2',
        'sound',
    ];
}
