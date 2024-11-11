<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'message',
        'is_read',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}