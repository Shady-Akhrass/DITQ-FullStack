<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donate_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'plan',
        'donated_at',
        'stripe_session_id',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'donated_at' => 'date',
    ];

    public function donate()
    {
        return $this->belongsTo(Donate::class);
    }
}
