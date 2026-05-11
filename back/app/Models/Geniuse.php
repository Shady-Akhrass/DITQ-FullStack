<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geniuse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'details',
        'image',
        'status'
    ];
}
