<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        $now = now();
        
        // Le prochain webinaire à venir (direct)
        // Au lieu de ->first(), on prend tout
        $upcomingWebinars = Webinar::where('scheduled_at', '>', now())
            ->orderBy('scheduled_at', 'asc')
            ->get();

        // Les webinaires passés (replays)
        $pastWebinars = Webinar::where('scheduled_at', '<', now())
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('webinars.index', compact('upcomingWebinars', 'pastWebinars'));
    }
}