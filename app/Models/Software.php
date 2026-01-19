<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    //
    protected $fillable = [
        'name', 
        'category',
        'description', 
        'price', 
        'video_demo_id', 
        'screenshots',
        'file_path'
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];
}
