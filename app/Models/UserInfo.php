<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'user_id',
        'birth_date',
        'phone',
        'country',
        'language',
        'currency',
        'address',
        'city',
        'postal_code',
        'iban',
        'bic'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }}
