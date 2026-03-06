<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminRequest;
use App\Models\User;
use App\Models\Role;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:super_admin']);
    }

    // Dashboard Super Admin
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    // Liste toutes les demandes d'admin
    public function listRequests()
    {
        $requests = AdminRequest::with('user')->orderBy('created_at','desc')->get();
        return view('superadmin.admin_requests', compact('requests'));
    }

    // Accepter une demande
    public function acceptRequest($id)
    {
        $request = AdminRequest::findOrFail($id);
        $request->status = 'accepted';
        $request->save();

        // Transformer le client en admin
        $adminRole = Role::where('name','admin')->first();
        $request->user->roles()->attach($adminRole);

        return redirect()->back()->with('success','Demande acceptée et utilisateur promu admin.');
    }

    // Refuser une demande
    public function refuseRequest($id)
    {
        $request = AdminRequest::findOrFail($id);
        $request->status = 'refused';
        $request->save();

        return redirect()->back()->with('success','Demande refusée.');
    }

    // Gestion complète des utilisateurs
    public function manageUsers()
    {
        $users = User::with('roles')->get();
        return view('superadmin.users', compact('users'));
    }

    // Modifier rôle d'un utilisateur (exclut super_admin)
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($user->hasRole('super_admin')){
            return redirect()->back()->with('error','Impossible de modifier le super admin.');
        }

        $user->roles()->sync([$request->role_id]); // remplace tous les rôles
        return redirect()->back()->with('success','Rôle modifié.');
    }

    // Supprimer un utilisateur (exclut super_admin)
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if($user->hasRole('super_admin')){
            return redirect()->back()->with('error','Impossible de supprimer le super admin.');
        }

        $user->delete();
        return redirect()->back()->with('success','Utilisateur supprimé.');
    }
}
