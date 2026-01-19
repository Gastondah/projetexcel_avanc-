<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'category',
        'is_resolved'
    ];

    // Relation avec l'utilisateur (pour afficher qui a posé la question)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Dans app/Models/Question.php
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}