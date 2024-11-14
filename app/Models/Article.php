<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = ['titre', 'contenu', 'image', 'Nom_auteur', 'date_publication', 'categorie_id'];

  public function categorieArticle()
  {
      return $this->belongsTo(CategorieArticle::class, 'categorie_id');
  }}
