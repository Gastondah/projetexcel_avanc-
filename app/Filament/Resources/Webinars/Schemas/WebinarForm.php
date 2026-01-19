<?php

namespace App\Filament\Resources\Webinars\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WebinarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('youtube_id')
                ->label('ID de la vidéo YouTube')
                ->helperText('L\'ID est la partie après v= ou après le dernier / (ex: dQw4w9WgXcQ)')
                ->required(),
            DateTimePicker::make('scheduled_at')
                ->label('Date et heure du direct')
                ->required(),

                // AJOUTE CECI :
            Toggle::make('is_finished')
            ->label('Webinaire terminé (Replay)')
            ->default(false),
        ]);
    }
}
