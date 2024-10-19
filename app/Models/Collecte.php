<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    use HasFactory;
    protected $table = 'collectes';
    protected $primarykey = 'id';
    protected $fillable = [
        'nom_collecte',     // Type de déchet collecté
        'zone_collecte',   // Zone de collecte
        'statut',          // Statut de la collecte
        'date_collecte',   // Date de la collecte
        'quantite_collecte'
    ];
}
