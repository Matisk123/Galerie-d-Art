<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index()
    {
        $oeuvres = Oeuvre::where('user_id', Auth::id())
            ->withCount('favorites')
            ->get();

        return view('admin.stats.index', compact('oeuvres'));
    }
}
