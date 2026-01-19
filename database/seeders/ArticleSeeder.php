<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User; // Importez le modèle User
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // On récupère le premier utilisateur (ex: l'admin)
        $user = User::first();

        // Sécurité : si aucun utilisateur n'existe, on en crée un
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@excel.com',
                'password' => bcrypt('password'),
            ]);
        }

        $data = [
            ['title' => 'Planifier un projet avec la méthode Agile', 'cat' => 'gestion-projet-info'],
            ['title' => 'Les 5 piliers de la réussite d\'un projet IT', 'cat' => 'gestion-projet-info'],
            ['title' => 'Maîtriser la fonction RECHERCHEV Avancée', 'cat' => 'maitriser-excel'],
            ['title' => 'Créer votre première macro VBA en 5 minutes', 'cat' => 'programmation-vba'],
            ['title' => 'Nettoyer des données complexes avec Power Query', 'cat' => 'power-query'],
            ['title' => 'Dashboard commercial 2026 : Le guide complet', 'cat' => 'tableaux-de-bord'],
        ];

        foreach ($data as $item) {
            Article::create([
                'user_id' => $user->id, // On ajoute l'ID de l'utilisateur ici
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['cat'],
                'content' => 'Ceci est un contenu d\'exemple pour tester l\'affichage de ' . $item['title'],
                'image_cover' => null,
            ]);
        }
    }
}