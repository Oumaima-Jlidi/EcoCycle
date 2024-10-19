<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'max_participants',
        'image',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function isAvailable()
{
    return $this->registrations()->count() < $this->max_participants;
}

public function registerUser($userId)
{
    if ($this->isAvailable()) {
        return $this->registrations()->create([
            'user_id' => $userId,
            'registration_date' => now(),
            'status' => 'registered',
        ]);
    }

    return false; // or throw an exception if you prefer
}
}
