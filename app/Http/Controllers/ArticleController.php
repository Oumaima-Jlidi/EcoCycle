<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\CategorieArticle; // Assurez-vous que cette ligne est présente
use Illuminate\Http\Request;

class ArticleController extends Controller
{

  public function indexfront()
    {
        $articles = Article::all();
        return view('Front.pages.article.index')->with('articles', $articles);

    }
    public function index()
    {
        $articles = Article::all();
        $categories = CategorieArticle::all(); // Inclure les catégories
        return view('Back.pages.articles.index', compact('articles', 'categories'));
    }

    
    public function create()
    {
      $categories = CategorieArticle::all(); // Récupérer toutes les catégories
      
      return view('Back.pages.articles.create', compact('categories'));    }
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // image facultative
            'Nom_auteur' => 'required|string|max:255',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categorie_articles,id', // Valider que la catégorie existe
        ]);
    
        // Gestion de l'upload d'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        // Créer un nouvel article
        Article::create([
            'titre' => $request->input('titre'),
            'contenu' => $request->input('contenu'),
            'image' => $imagePath,
            'Nom_auteur' => $request->input('Nom_auteur'),
            'date_publication' => $request->input('date_publication'),
            'categorie_id' => $request->input('categorie_id'), // Enregistrement de la catégorie
        ]);
    
        return redirect()->route('articles.index')->with('success', 'Article ajouté avec succès');
    }
    

    
  
    public function edit($id)
    {
      $article = Article::findOrFail($id);
      $categories = CategorieArticle::all(); // Récupérer toutes les catégories
      return view('Back.pages.articles.edit', compact('article', 'categories'));
    }
    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        // Validation des champs
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // image facultative
            'Nom_auteur' => 'required|string|max:255',
            'date_publication' => 'required|date',
            'categorie_id' => 'required|exists:categories,id',

        ]);
    
        // Trouver l'article à mettre à jour
        $article = Article::findOrFail($id);
    
        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
    
            // Enregistrer la nouvelle image
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Si aucune nouvelle image, garder l'ancienne
            $imagePath = $article->image;
        }
    
        // Mise à jour de l'article
        $article->update([
            'titre' => $request->input('titre'),
            'contenu' => $request->input('contenu'),
            'image' => $imagePath,
            'Nom_auteur' => $request->input('Nom_auteur'),
            'date_publication' => $request->input('date_publication'),
            'categorie_id' =>  $request->input('categorie_id'),
        ]);
    
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès');
    }
    

  
    public function destroy($id)
    {
      $article = Article::findOrFail($id);
      $article->delete();

      return redirect()->route('articles.index')->with('success', 'article supprimée avec succès');
    }
}
