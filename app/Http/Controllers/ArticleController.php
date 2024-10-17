<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
  public function index()
  {
    $articles = Article::paginate(10); // Nombre d'articles par page
      return view('TemplateForum.dashPosts', compact('articles'));
  }

  public function create()
  {
      return view('TemplateForum.create');
  }

  public function store(Request $request)
  {
      $request->validate([
          'titre' => 'required',
          'contenu' => 'required',
          'image' => 'nullable|image',
          'Nom_auteur' => 'required',
      ]);
// Enregistrer l'image si elle est présente
      $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;
 // Créer l'article
      Article::create([
          'titre' => $request->titre,
          'contenu' => $request->contenu,
          'image' => $imagePath,
          'Nom_auteur' => $request->Nom_auteur,
          'date_publication' => now(),
      ]);

      return redirect()->route('articles.index')->with('success', 'Article créé avec succès');
  }

  public function show(Article $article)
  {
      return view('articles.show', compact('article'));
  }

  public function edit(Article $article)
  {
      return view('articles.edit', compact('article'));
  }

  public function update(Request $request, Article $article)
  {
      $request->validate([
          'titre' => 'required',
          'contenu' => 'required',
          'image' => 'nullable|image',
          'Nom_auteur' => 'required',
      ]);
 // Mettre à jour l'image si elle est présente
      if ($request->file('image')) {
          $imagePath = $request->file('image')->store('images', 'public');
          $article->image = $imagePath;
      }
 // Mettre à jour l'article
      $article->update($request->only('titre', 'contenu', 'Nom_auteur'));

      return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
  }

  public function destroy(Article $article)
  {
      $article->delete();
      return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès');
  }
}
