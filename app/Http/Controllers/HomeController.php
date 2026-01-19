<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Software;
use App\Models\Question;
use App\Models\Webinar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   /* public function index()
    {
        return view('home', [
            'latestArticles' => Article::latest()->take(3)->get(),
            'topSoftwares' => Software::latest()->take(2)->get(),
            'latestQuestions' => Question::latest()->take(5)->get(),
        ]);
    }*/
    public function index() {
        $nextWebinar = Webinar::where('scheduled_at', '>', now())->orderBy('scheduled_at', 'asc')->first();
        $latestReplay = Webinar::where('scheduled_at', '<=', now())->orderBy('scheduled_at', 'desc')->first();
        $latestArticles = Article::latest()->take(3)->get();

        return view('home', compact('nextWebinar', 'latestReplay', 'latestArticles'));
    }
}