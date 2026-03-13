<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer la dernière demande admin
        $lastAdminRequest = AdminRequest::where('user_id', $user->id)
            ->latest()
            ->first();

        // Déterminer si le client peut faire une nouvelle demande
        $canRequestAdmin = true;
        if ($lastAdminRequest && $lastAdminRequest->status == 'pending') {
            $canRequestAdmin = false; // interdit si une demande est en attente
        }

        // Notifications non lues
        $notifications = Notification::where('user_id', $user->id)
            ->where('read', false)
            ->get();

        // Marquer comme lues
        Notification::where('user_id', $user->id)
            ->where('read', false)
            ->update(['read' => true]);

        $pendingRequests = AdminRequest::where('status','pending')->count();

        return view('profile.index', compact('user', 'lastAdminRequest', 'canRequestAdmin', 'notifications', 'pendingRequests'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // changer mot de passe si rempli
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        // upload photo
        if($request->hasFile('photo')){

            // supprimer ancienne photo
            if($user->profile_photo){
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $request->file('photo')->store('profiles','public');
            $user->profile_photo = $path;
        }

        $user->save();

        return back()->with('success','Profil mis à jour');
    }
}
