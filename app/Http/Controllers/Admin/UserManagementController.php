<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{

    public function index()
    {

        $users = User::all();

        return view('admin.users.index', compact('users'));

    }

    public function updateRole(Request $request, User $user)
    {

        $request->validate([
            'role' => 'required'
        ]);

        $role = \App\Models\Role::where('name', $request->role)->first();

        if(!$role){
            return back()->with('error','Rôle introuvable');
        }

        $user->roles()->sync([$role->id]);

        return back()->with('success','Rôle mis à jour');

    }

    public function destroy(User $user)
    {

        if($user->hasRole('super_admin')){
            return back()->with('error','Impossible de supprimer le super admin');
        }

        $user->delete();

        return back()->with('success','Utilisateur supprimé');

    }

}
