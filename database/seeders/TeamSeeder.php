<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création du Chef d'équipe (Léonce)
        TeamMember::create([
            'name' => 'Léonce Toundé SODJINOU',
            'role' => 'Fondateur & Expert Principal',
            'photo' => null, // Sera remplacé par l'image par défaut dans la vue
            'bio' => 'Expert certifié avec plus de 15 ans d\'expérience dans l\'optimisation des flux de données. Spécialiste Excel et Power BI, passionné par la transmission du savoir.',
            'facebook' => 'https://facebook.com/leonce.sodjinou',
            'linkedin' => 'https://linkedin.com/in/leonce-sodjinou',
            'instagram' => 'https://instagram.com/leonce_excel',
            'order' => 0,
            'is_active' => true,
        ]);

        // 2. Création de 12 autres membres fictifs pour le slider
        $roles = ['Consultant VBA', 'Data Analyst', 'Formateur Power BI', 'Expert Excel', 'Architecte de Données'];

        for ($i = 1; $i <= 12; $i++) {
            $name = fake()->name();
            TeamMember::create([
                'name' => $name,
                'role' => fake()->randomElement($roles),
                'photo' => null,
                'bio' => fake()->paragraph(3),
                // Génération de liens fictifs basés sur le nom
                'facebook' => 'https://facebook.com/' . strtolower(str_replace(' ', '.', $name)),
                'linkedin' => 'https://linkedin.com/in/' . strtolower(str_replace(' ', '-', $name)),
                'instagram' => fake()->boolean(70) ? 'https://instagram.com/' . strtolower(str_replace(' ', '_', $name)) : null,
                'order' => $i,
                'is_active' => true,
            ]);
        }
    }
}