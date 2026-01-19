<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftwareController extends Controller
{
    public function index()
    {
        // On récupère simplement la liste triée par date
        $softwares = Software::latest()->get();
        
        return view('software.index', compact('softwares'));
    }

    public function download(Software $software)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        // On cherche le fichier dans le dossier public
        $path = storage_path('app/public/' . $software->file_path);

        if (!file_exists($path)) {
            abort(404, "Le fichier n'existe pas sur le serveur.");
        }

        return response()->download($path);
    }
}