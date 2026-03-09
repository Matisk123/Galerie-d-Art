<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            return view('menus.super_admin');
        }

        if ($user->hasRole('admin')) {
            return view('menus.admin');
        }

        return view('menus.client');
    }
}
