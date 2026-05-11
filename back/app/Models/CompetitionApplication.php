<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionApplication extends Model
{
    protected $fillable = [
        'student_name',
        'age',
        'mobile_number',
        'whatsapp_number',
        'governorate',
        'address',
        'memorizer_name',
        'participation_field',
        'video_path',
        'video_link'
    ];
}
