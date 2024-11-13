<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieArticle extends Model
{
  use HasFactory;

    protected $fillable = ['nom', 'description', 'article_id'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}