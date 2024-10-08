<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',     // Add this to allow mass assignment
        'description',
        'image',
        'statut',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replays()
    {
        return $this->hasMany(ReplaySujet::class);
    }
}
