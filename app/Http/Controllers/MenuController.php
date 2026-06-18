<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $oeuvresCount = Oeuvre::where('is_published', true)->count();

        $artistesCount = User::whereHas('oeuvres', function ($q) {
            $q->where('is_published', true);
        })->count();

        $oeuvresPopulaires = Oeuvre::where('is_published', true)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $artistesPopulaires = User::whereHas('oeuvres', function ($q) {
            $q->where('is_published', true);
        })
            ->withCount(['oeuvres' => function ($q) {
                $q->where('is_published', true);
            }])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('menus.client', compact(
            'oeuvresCount',
            'artistesCount',
            'oeuvresPopulaires',
            'artistesPopulaires'
        ));
    }
}
