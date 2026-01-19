<?php
namespace App\Http\Controllers;

use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        // On récupère les membres actifs triés par ordre
        $team = TeamMember::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('pages.about', compact('team'));
    }
}