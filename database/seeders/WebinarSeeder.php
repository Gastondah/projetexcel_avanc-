<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebinarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Futurs
        $futures = [
            ['title' => 'Maîtriser les Tableaux Croisés Dynamiques', 'days' => 7],
            ['title' => 'VBA Avancé : Automatisez vos reportings', 'days' => 14],
            ['title' => 'Dashboard 2026 : Nouvelles tendances', 'days' => 21],
        ];

        foreach ($futures as $f) {
            \App\Models\Webinar::create([
                'title' => $f['title'],
                'youtube_id' => 'scWpXAs_U6M', 
                'scheduled_at' => now()->addDays($f['days']),
                'is_finished' => false,
                // 'description' supprimé ici
            ]);
        }

        // 2. Passés
        $replays = [
            ['title' => 'Introduction aux Macros VBA', 'date' => now()->subDays(10), 'id' => 'm9LAtS95n90'],
            ['title' => 'Les fonctions de recherche (XLOOKUP)', 'date' => now()->subDays(20), 'id' => 'TQ7mhbS3dCM'],
            ['title' => 'Nettoyage de données avec Power Query', 'date' => now()->subDays(30), 'id' => 'lXRAUbeNeyY'],
        ];

        foreach ($replays as $replay) {
            \App\Models\Webinar::create([
                'title' => $replay['title'],
                'youtube_id' => $replay['id'], 
                'scheduled_at' => $replay['date'],
                'is_finished' => true,
                // 'description' supprimé ici
            ]);
        }
    }
}
