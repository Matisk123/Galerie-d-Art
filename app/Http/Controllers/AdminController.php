<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    // Dashboard admin classique
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
