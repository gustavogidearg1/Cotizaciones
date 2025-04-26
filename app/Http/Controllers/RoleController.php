<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update(['role_id' => $request->role_id]);

        return back()->with('success', 'Rol actualizado correctamente');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
}
