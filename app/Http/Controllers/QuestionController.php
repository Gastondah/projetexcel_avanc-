<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        // On récupère les questions de la communauté (les plus récentes en premier)
        $questions = Question::with('user')->latest()->paginate(10);
        return view('community.index', compact('questions'));
    }

    public function create()
    {
        return view('community.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Question::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'user_id' => $request->user()->id, // On lie l'utilisateur connecté
        ]);

        return redirect()->route('community.index')->with('success', 'Votre question est en ligne !');
    }

    // Pour afficher la question et ses réponses
    public function show($slug)
    {
        $question = Question::with(['user', 'answers.user'])->where('slug', $slug)->firstOrFail();
        return view('community.show', compact('question'));
    }

    // Pour enregistrer une réponse
    public function storeAnswer(Request $request, Question $question)
    {
        $request->validate(['content' => 'required']);

        $question->answers()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Votre aide a été publiée !');
    }

    public function resolve(Request $request, Question $question)
    {
        // Vérifier que c'est bien l'auteur qui clique sur le bouton
        if ($request->user()->id !== $question->user_id) {
            abort(403);
        }

        $question->update(['is_resolved' => true]);

        return back()->with('success', 'Félicitations ! Votre problème est marqué comme résolu.');
    }

    public function destroy(Request $request, Question $question)
    {
        // Sécurité : on vérifie que c'est bien l'auteur qui supprime
        if ($request->user()->id !== $question->user_id) {
            abort(403);
        }

        $question->delete();

        return redirect()->back()->with('success', 'Question supprimée avec succès.');
    }

}