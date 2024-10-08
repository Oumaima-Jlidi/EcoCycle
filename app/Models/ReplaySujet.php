<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplaySujet extends Model
{
    use HasFactory;
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'sujet_id', 'user_id'];

    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
