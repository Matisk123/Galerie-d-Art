<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ici on peut charger dynamiquement le menu, actualités, catégories
        return view('menu.index');
    }
}
