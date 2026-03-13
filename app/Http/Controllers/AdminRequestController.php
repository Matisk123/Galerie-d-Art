<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AdminRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class AdminRequestController extends Controller
{
    public function create()
    {

        return view('admin_request.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|min:10'
        ]);

        $adminRequest = AdminRequest::create([
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        // Notifier tous les super admins
        $superAdmins = User::whereHas('roles', function($q){
            $q->where('name','super_admin');
        })->get();

        foreach($superAdmins as $admin){
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'new_admin_request',
                'read' => false
            ]);
        }

        return redirect('/home')->with('success','Demande envoyée');
    }
}
