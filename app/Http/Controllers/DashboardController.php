<?php

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // On récupère l'utilisateur avec ses questions
        $user = $request->user();
        $myQuestions = $user->questions()->latest()->get();

        return view('dashboard', compact('user', 'myQuestions'));
    }
}*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // On récupère l'utilisateur avec ses questions et ses réponses en une seule fois
        $user = $request->user();
        
        // On récupère les questions de l'utilisateur avec le compte des réponses pour chaque question
        $myQuestions = $user->questions()
            ->withCount('answers')
            ->latest()
            ->get();

        // On peut aussi calculer des stats spécifiques ici si besoin
        $stats = [
            'total_answers_given' => $user->answers()->count(),
            'resolved_count' => $myQuestions->where('is_resolved', true)->count(),
        ];

        return view('dashboard', compact('user', 'myQuestions', 'stats'));
    }
}