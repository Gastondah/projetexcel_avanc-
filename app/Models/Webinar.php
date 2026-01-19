<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'youtube_id',
        'scheduled_at',
        'is_finished'
    ];

    // On indique à Laravel que c'est une date pour pouvoir faire ->format()
    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_finished' => 'boolean',
    ];

    // Dans App\Models\Webinar.php

    protected $appends = ['is_past'];

    public function getIsPastAttribute()
    {
        return $this->scheduled_at->isPast();
    }
}