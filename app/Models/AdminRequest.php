<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminRequest extends Model
{
    protected $fillable = [
        'user_id',
        'reason',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
