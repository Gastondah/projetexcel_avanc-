<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Webinar;
use App\Models\Software;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. UTILISATEUR (Admin)
        $user = User::firstOrCreate(
            ['email' => 'votre-email@exemple.com'], // On vérifie par l'email
            [
                'name' => 'Admin Excel',
                'password' => Hash::make('votre_mot_de_passe_secret'),
            ]
        );

        // 2. ARTICLES (On vérifie par le slug pour éviter l'erreur UNIQUE)
        Article::firstOrCreate(
            ['slug' => 'maitriser-recherchev'],
            [
                'title' => 'Maîtriser la fonction RECHERCHEV',
                'content' => 'Voici un tutoriel complet sur Excel...',
                'category' => 'Fonctions',
                'user_id' => $user->id,
                'sections' => [], // Casté en array dans ton modèle
            ]
        );

        // 3. WEBINAIRES (Selon ton modèle Webinar)
        Webinar::firstOrCreate(
            ['title' => 'Excel Avancé Live'],
            [
                'youtube_id' => 'dQw4w9WgXcQ',
                'scheduled_at' => now()->addDays(7),
                'is_finished' => false,
            ]
        );

        // 4. LOGICIELS (Selon ton modèle Software)
        Software::firstOrCreate(
            ['name' => 'Calculateur Pro V1'],
            [
                'category' => 'Productivité',
                'description' => 'Un outil puissant pour automatiser vos tâches.',
                'price' => 0,
                'video_demo_id' => 'xyz123',
                'file_path' => 'software/calc.xlsx',
                'screenshots' => [], // Casté en array
            ]
        );

        // 5. MEMBRE DE L'ÉQUIPE (Selon ton modèle TeamMember)
        TeamMember::firstOrCreate(
            ['name' => 'Gaston Dah'],
            [
                'role' => 'Expert Excel',
                'bio' => 'Consultant en automation.',
                'is_active' => true,
                'order' => 1,
            ]
        );
    }
}