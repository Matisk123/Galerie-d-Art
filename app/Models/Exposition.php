<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exposition extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'lieu',
        'date_debut',
        'date_fin',
        'image',
        'is_published',
        'user_id'
    ];
}
