<?php

namespace App\Filament\Resources\Software\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;

class SoftwareForm
{
    public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('name')->required(),
            Select::make('category')
                ->options([
                    'gestion' => 'Gestion',
                    'comptabilite' => 'Comptabilité',
                    'productivite' => 'Productivité',
                    'vba-expert' => 'VBA Expert',
                ])->required(),
            RichEditor::make('description')->required()->columnSpanFull(),
            TextInput::make('price')->numeric()->prefix('€')->required(),
            TextInput::make('video_demo_id')->label('ID Vidéo YouTube')->required(),
            Repeater::make('screenshots')
                ->label('Galerie de fonctionnalités (Captures + Infos)')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']) // Spécifie les types MIME
                        ->disk('public') // <--- AJOUTEZ CECI
                        ->directory('software-previews')
                        ->required(),
                    TextInput::make('title')
                        ->label('Nom de la fonctionnalité')
                        ->placeholder('Ex: Gestion des stocks')
                        ->required(),
                    Textarea::make('description')
                        ->label('courte description')
                        ->rows(2),
                ])
                ->collapsible() // Permet de réduire chaque bloc pour gagner de la place
                ->grid(2)// Affiche les entrées sur 2 colonnes dans l'admin
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
            FileUpload::make('file_path')
                ->label('Fichier Logiciel (.xlsx, .zip)')
                ->disk('public') // <--- AJOUTEZ CECI
                ->directory('software-files')
                ->required(),
        ]);
}
}
