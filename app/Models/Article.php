<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    // Ajoutez cette ligne avec tous vos champs
    protected $fillable = [
        'title',
        'slug',
        'content',
        'sections',
        'category', // Ajouté ici
        'image_cover',
        'user_id',
    ];

    protected $casts = [
        'sections' => 'array', // Pour stocker les images + textes explicatifs
    ];
}