<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant_total',
        'statut',
        'date_commande',
        'adresse_livraison',
        'produits',
        'user_id',
    ];
}
