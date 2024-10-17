<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieArticleController extends Controller
{
  public function index()
  {
      $categories = CategorieArticle::all();
      return view('categorie_articles.index', compact('categories'));
  }

  public function create()
  {
      return view('categorie_articles.create');
  }

  public function store(Request $request)
  {
      $request->validate([
          'nom' => 'required',
          'description' => 'required',
      ]);

      CategorieArticle::create($request->all());

      return redirect()->route('categorie-articles.index')->with('success', 'Catégorie créée avec succès');
  }

  public function show(CategorieArticle $categorieArticle)
  {
      return view('categorie_articles.show', compact('categorieArticle'));
  }

  public function edit(CategorieArticle $categorieArticle)
  {
      return view('categorie_articles.edit', compact('categorieArticle'));
  }

  public function update(Request $request, CategorieArticle $categorieArticle)
  {
      $request->validate([
          'nom' => 'required',
          'description' => 'required',
      ]);

      $categorieArticle->update($request->all());

      return redirect()->route('categorie-articles.index')->with('success', 'Catégorie mise à jour avec succès');
  }

  public function destroy(CategorieArticle $categorieArticle)
  {
      $categorieArticle->delete();
      return redirect()->route('categorie-articles.index')->with('success', 'Catégorie supprimée avec succès');
  }
}
