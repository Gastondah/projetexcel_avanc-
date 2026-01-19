<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // N'oubliez pas l'import en haut
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/blog/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Route pour la page des logiciels
Route::get('/logiciels', [SoftwareController::class, 'index'])->name('software.index');
Route::get('/logiciels/telecharger/{software}', [SoftwareController::class, 'download'])->name('software.download')->middleware('auth');
// Route pour la page des webinaires
Route::get('/webinaires', [WebinarController::class, 'index'])->name('webinars.index');

//Route::view('/a-propos', 'pages.about')->name('about');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about');

// Route pour les mentions légales
Route::view('/mentions-legales', 'pages.legal')->name('legal');

Route::get('/contact', function () {
    return view('pages.contact'); // Assurez-vous que le fichier est bien resources/views/pages/contact.blade.php
})->name('contact');

// Route pour la page de contact
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Page liste des questions
    Route::get('/communaute', [QuestionController::class, 'index'])->name('community.index');

// Voir une question précise et répondre
    Route::get('/communaute/discussion/{slug}', [QuestionController::class, 'show'])->name('community.show');



// Dashboard (Protégé par Breeze)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Les routes de Breeze pour le profil (déjà présentes normalement)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Routes de la Communauté (Protégées par Breeze)
Route::middleware(['auth', 'verified'])->group(function () {
    
    
    
    // Formulaire pour poser une question
    Route::get('/communaute/poser', [QuestionController::class, 'create'])->name('community.create');
    // Suppression d'une question
    Route::delete('/communaute/question/{question}', [QuestionController::class, 'destroy'])->name('community.destroy');
    
    // Enregistrement de la question
    Route::post('/communaute/stocker', [QuestionController::class, 'store'])->name('community.store');
    
    
    Route::post('/communaute/discussion/{question}/repondre', [QuestionController::class, 'storeAnswer'])->name('community.answer.store');
    // Marquer une question comme résolue
    //Route::post('/communaute/discussion/{question}/resoudre', [QuestionController::class, 'resolve'])->name('community.resolve');
    Route::patch('/communaute/resolve/{question}', [QuestionController::class, 'resolve'])->name('community.resolve');
});


require __DIR__.'/auth.php';
