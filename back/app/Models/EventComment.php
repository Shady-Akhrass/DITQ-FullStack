<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_name',
        'comment',
        'is_approved',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
