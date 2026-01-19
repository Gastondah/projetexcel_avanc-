<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        // Au lieu de User::create, on utilise updateOrCreate ou firstOrCreate
        $admin = User::firstOrCreate(
            ['email' => 'expert@excel.com'],
            [
                'name' => 'Expert Excel',
                'password' => bcrypt('password'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'jean@exemple.com'],
            [
                'name' => 'Jean Informatique',
                'password' => bcrypt('password'),
            ]
        );

        $questions = [
            [
                'title' => 'Erreur #N/A avec RechercheV',
                'content' => "Bonjour, j'essaie de faire une RechercheV sur une autre feuille mais j'obtiens toujours l'erreur #N/A alors que la valeur existe. Quelqu'un peut m'aider ?",
                'cat' => 'Excel Fonctions',
                'resolved' => true,
                'answers' => [
                    "Vérifie que le format de tes cellules est identique (Texte vs Nombre). C'est souvent la cause du #N/A.",
                    "Merci ! C'était bien un problème de format, ça fonctionne maintenant."
                ]
            ],
            [
                'title' => 'Comment boucler sur des lignes en VBA ?',
                'content' => "Je débute en VBA et je voudrais savoir comment parcourir toutes les lignes de ma colonne A jusqu'à la dernière cellule non vide.",
                'cat' => 'VBA & Macros',
                'resolved' => false,
                'answers' => [
                    "Tu peux utiliser : For i = 1 To Cells(Rows.Count, 1).End(xlUp).Row"
                ]
            ],
            [
                'title' => 'Power Query : Fusionner 10 fichiers CSV',
                'content' => "Est-il possible d'automatiser l'import de 10 fichiers CSV situés dans un même dossier sans faire de copier-coller ?",
                'cat' => 'Power Query',
                'resolved' => true,
                'answers' => [
                    "Oui, utilise 'Données > Obtenir des données > À partir d'un fichier > À partir d'un dossier'. Power Query fera tout le travail !",
                    "C'est magique, merci beaucoup !"
                ]
            ],
            [
                'title' => 'Problème de lenteur sur gros fichier Excel',
                'content' => "Mon fichier fait 50 Mo et met 3 minutes à s'ouvrir. Il y a beaucoup de mises en forme conditionnelles.",
                'cat' => 'Optimisation',
                'resolved' => false,
                'answers' => []
            ],
            [
                'title' => 'Extraire du texte entre deux parenthèses',
                'content' => "J'ai des données comme 'Produit (ID_123)'. Je veux extraire uniquement ID_123 via une formule.",
                'cat' => 'Excel Fonctions',
                'resolved' => true,
                'answers' => [
                    "Utilise la fonction STXT combinée avec TROUVE, ou plus simple si tu as Excel 365 : TEXTE.APRES(TEXTE.AVANT(A1; ')'); '(' )"
                ]
            ]
        ];

        foreach ($questions as $q) {
            $newQuestion = Question::create([
                'user_id' => $user2->id,
                'title' => $q['title'],
                'slug' => Str::slug($q['title']) . '-' . uniqid(),
                'content' => $q['content'],
                'category' => $q['cat'],
                'is_resolved' => $q['resolved'],
            ]);

            foreach ($q['answers'] as $index => $aContent) {
                Answer::create([
                    'question_id' => $newQuestion->id,
                    'user_id' => ($index % 2 == 0) ? $admin->id : $user2->id,
                    'content' => $aContent,
                ]);
            }
        }
    }
}