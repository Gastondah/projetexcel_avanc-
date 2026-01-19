<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Software;

class SoftwareSeeder extends Seeder
{
    public function run(): void
    {
        $softwares = [
            [
                'name' => 'Excel Automator Pro',
                'description' => 'Générez vos factures et rapports PDF automatiquement.',
                'price' => 49.99,
                'video' => 'scWpXAs_U6M'
            ],
            [
                'name' => 'Gestion de Stock V3',
                'description' => 'Suivi des stocks en temps réel avec alertes de seuil critique.',
                'price' => 0.00,
                'video' => 'm9LAtS95n90'
            ],
            [
                'name' => 'Analyseur de Paie',
                'description' => 'Vérifiez la conformité de vos bulletins de paie en un clic.',
                'price' => 29.00,
                'video' => 'TQ7mhbS3dCM'
            ],
            [
                'name' => 'Planificateur Projet IT',
                'description' => 'Diagramme de Gantt dynamique pour la gestion de projets informatiques.',
                'price' => 15.00,
                'video' => 'lXRAUbeNeyY'
            ],
            [
                'name' => 'Convertisseur CSV Expert',
                'description' => 'Nettoyez et convertissez vos fichiers bancaires pour Excel.',
                'price' => 0.00,
                'video' => 'scWpXAs_U6M'
            ],
        ];

        foreach ($softwares as $s) {
            \App\Models\Software::create([
                'name' => $s['name'],
                'description' => $s['description'],
                'price' => $s['price'],
                'video_demo_id' => $s['video'],
                'file_path' => 'softwares/demo.xlsx', // chemin fictif
            ]);
        }
    }
}
