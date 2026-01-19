<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre')
                    ->required()
                    ->live(onBlur: true) // AJOUTÉ : permet de déclencher la mise à jour du slug
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                Select::make('category')
                    ->options([
                        'maitriser-excel' => 'Maîtriser Excel',
                        'programmation-vba' => 'Programmation VBA',
                        'bibliotheque-fonctions' => 'Bibliothèque de Fonctions',
                        'scripts-automatisation' => 'Scripts & Automatisation',
                    ])
                    ->required()
                    ->native(false),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated(),

                FileUpload::make('image_cover')
                    ->label('Image de couverture')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                    ->disk('public') // FORCE l'enregistrement dans le dossier public
                    ->directory('articles') // AJOUTÉ : crée automatiquement le dossier 'articles'
                    ->visibility('public'), // AJOUTÉ : rend le fichier accessible publiquement

                // ... dans le schéma du formulaire
                RichEditor::make('content')
                    ->label('Introduction ou contenu principal')
                    ->required()
                    ->columnSpanFull(),

                Repeater::make('sections')
                    ->label('Étapes du cours (Images + Explications)')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('article-sections'),
                        TextInput::make('title')->label('Titre de cette étape'),
                        Textarea::make('description')->label('Explication détaillée')->rows(3),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Nouvelle étape'),
            ]);
    }
}