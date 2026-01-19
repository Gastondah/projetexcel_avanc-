<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Envoie l'email à ton adresse pro
        Mail::to('contact@excelavance.com')->send(new ContactMessage($data));

        return back()->with('success', 'Votre message a bien été envoyé !');
    }
}