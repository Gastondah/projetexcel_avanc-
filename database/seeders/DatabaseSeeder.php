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
        \App\Models\User::factory()->create([
            'name' => 'Admin Excel',
            'email' => 'admin@example.com',
        ]);

        \App\Models\Article::create([
            'title' => 'Maîtriser la fonction RECHERCHEV',
            'slug' => 'maitriser-recherchev',
            'content' => 'Voici un tutoriel complet sur Excel...',
            'user_id' => 1
        ]);
    }
}
