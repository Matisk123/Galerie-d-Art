<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Oeuvre $oeuvre)
    {
        $user = Auth::user();

        $fav = Favorite::where('user_id', $user->id)
            ->where('oeuvre_id', $oeuvre->id)
            ->first();

        if ($fav) {
            $fav->delete();
            return response()->json(['status' => 'removed']);
        }

        Favorite::create([
            'user_id' => $user->id,
            'oeuvre_id' => $oeuvre->id,
        ]);

        return response()->json(['status' => 'added']);
    }
}
