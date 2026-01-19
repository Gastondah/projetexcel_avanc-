<?php
/*
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Affiche tous les articles (Page Blog)
    public function index(Request $request)
    {
        $query = Article::query();

        // Si on filtre par catégorie (ex: ?category=VBA)
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(9);

        return view('articles.index', compact('articles'));
    }

    // Affiche un article seul (Page Lecture)
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }
 }*/



namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Filtrage pour la grille centrale
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(9);

        // On récupère TOUS les articles pour la sidebar (Index des cours)
        $allArticles = Article::select('id', 'title', 'slug', 'category')->get();

        return view('articles.index', compact('articles', 'allArticles'));
    }

    public function show($slug)
    {
        // On récupère l'article avec son auteur pour éviter les erreurs
        $article = Article::where('slug', $slug)->firstOrFail();
        
        return view('articles.show', compact('article'));
    }
}