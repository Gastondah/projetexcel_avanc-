<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Concevoir un Dashboard Commercial Dynamique',
                'category' => 'tableaux-de-bord',
                'slug' => 'concevoir-dashboard-commercial-dynamique',
                'content' => 'Apprenez à lier vos segments à vos graphiques...'
            ],
            [
                'title' => 'Automatiser l\'importation de 50 fichiers CSV en 1 clic',
                'category' => 'power-query',
                'slug' => 'automatiser-importation-power-query',
                'content' => 'Power Query est l\'outil ultime pour fusionner des données...'
            ],
            [
                'title' => 'Nettoyer des données sales avec les fonctions de texte',
                'category' => 'power-query',
                'slug' => 'nettoyer-donnees-sales-power-query',
                'content' => 'Supprimer les espaces inutiles et transformer les dates...'
            ]
        ];

        foreach ($data as $item) {
            \App\Models\Article::create($item + [
                'image_cover' => null, // Utilise l'image par défaut d'Unsplash
                'user_id' => 1, // Assurez-vous que l'ID 1 existe
            ]);
        }
    }
}
