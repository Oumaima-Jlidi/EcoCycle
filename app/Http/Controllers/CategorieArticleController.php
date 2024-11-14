<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategorieArticle;
use App\Models\Article;


class CategorieArticleController extends Controller
{

    // affichage back office 
    public function index()
    {
        $categories = CategorieArticle::withCount('articles')->get();
        return view('Back.pages.articles.index_categorie', compact('categories'));
    }

  /*  // affichage front office 
    public function shop()
    {
        $categories = CategorieArticle::withCount('articles')->get();
        return view('Front.pages.shop.shop', compact('categories'));
    }*/
    public function showArticles()
    {
        $categories = CategorieArticle::all(); // Récupère toutes les catégories
        $articles = Article::all(); // Récupère tous les articles
    
        return view('front.pages.articles', compact('articles', 'categories')); // Envoie les catégories et les articles à la vue
    }
    

    // create
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        CategorieArticle::create($data);
        return redirect()->route('categorie_articles.index')->with('success', 'Catégorie ajoutée avec succès');
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $categorie = CategorieArticle::findOrFail($id);
        $categorie->nom = $request->nom;
        $categorie->description = $request->description;
        $categorie->save();

        return redirect()->route('categorie_articles.index')->with('success', 'Catégorie mise à jour avec succès.');
    }


    // delete
    public function destroy($id)
    {
        $categorie = CategorieArticle::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categorie_articles.index')->with('success', 'Catégorie supprimée avec succès');
    }
}
