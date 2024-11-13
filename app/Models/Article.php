<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  protected $fillable = ['titre', 'contenu', 'image', 'Nom_auteur', 'date_publication'];

  public function categorie()
  {
      return $this->hasOne(CategorieArticle::class);
  }}
