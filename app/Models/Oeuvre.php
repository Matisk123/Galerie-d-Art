<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Oeuvre extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'artist_name',
        'categorie',
        'largeur',
        'hauteur',
        'prix',
        'image',
        'is_published',
    ];

    public function vendeur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorites');
    }
}
