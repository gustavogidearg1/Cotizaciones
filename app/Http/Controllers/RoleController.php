<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleController extends Controller
{
    // Métodos del controlador para manejar las rutas

    public function index()
    {
        /*
        $roles = Role::with('users')->get();
        return view('ruta.de.la.vista', compact('roles'));
        */
    }

    public function create()
    {
       // return view('roles.create');
    }

    public function store(Request $request)
    {
        /*
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');
        */
    }

    public function show(Role $role)
    {
        /*
        return view('roles.show', compact('role'));
        */
    }

    public function edit(Role $role)
    {
        /*
        return view('roles.edit', compact('role'));
        */
    }

    public function update(Request $request, Role $role)
    {
        /*
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
        */
    }

    public function destroy(Role $role)
    {
        /*
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
        */
    }
}
