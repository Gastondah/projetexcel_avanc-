<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin =\App\Models\User::factory()->create([
            'name' => 'Admin Excel',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin123!'), // Définissez votre mot de passe
        ]);

        \App\Models\Article::create([
            'title' => 'Maîtriser la fonction RECHERCHEV',
            'slug' => 'maitriser-recherchev',
            'content' => 'Voici un tutoriel complet sur Excel...',
            'user_id' => $admin->id,
            'category' => 'MAITRISER EXCEL', // Assurez-vous que ce champ existe dans votre migration
        ]);

        // 2. Création d'Articles
        \App\Models\Article::create([
            'title' => 'Maîtriser la fonction RECHERCHEV',
            'slug' => 'maitriser-recherchev',
            'content' => 'Voici un tutoriel complet sur Excel...',
            'user_id' => $admin->id,
            'category' => 'Fonctions',
        ]);

        // 3. Création de Webinaires (Données fictives)
        \App\Models\Webinar::create([
            'title' => 'Atelier Tableaux Croisés Dynamiques',
            'description' => 'Apprenez à analyser vos données en 1 heure.',
            'scheduled_at' => now()->addDays(7),
            'link' => 'https://zoom.us/j/exemple',
        ]);

        // 4. Création de Logiciels (Données fictives)
        \App\Models\Software::create([
            'name' => 'Calculateur de Paie Pro',
            'description' => 'Un outil Excel complet pour gérer la paie.',
            'version' => '1.0.2',
            'download_url' => 'https://votre-site.com/telecharger/paie',
            'is_free' => true,
        ]);
    }
}
