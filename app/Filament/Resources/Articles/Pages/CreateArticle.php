<?php

namespace App\Filament\Resources\Articles\Pages; // Vérifiez bien le "s" à Articles

use App\Filament\Resources\Articles\ArticleResource; // Import correct
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth; // Pour corriger l'erreur id()

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Utilisation de la façade Auth pour éviter l'erreur de méthode undefined
        $data['user_id'] = Auth::id();
    
        return $data;
    }
}