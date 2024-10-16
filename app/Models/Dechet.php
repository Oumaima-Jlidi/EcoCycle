<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dechet extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_dechet', 
        'quantite', 
        'origine', 
        'date_collecte', 
        'statut', 
        'collecte_id'
    ];

    public function collecte()
    {
        return $this->belongsTo(Collecte::class);
    }
}
