<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }
    
    public function create() {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }
    
    public function store(Request $request) {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Rôle créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
    
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $role->id,
        'permissions' => 'required|array',
    ]);

    $role->update(['name' => $request->name]);

    $role->syncPermissions($request->permissions);

    return redirect()->route('roles.index')->with('success', 'Rôle mis à jour avec succès.');
}

public function destroy(Role $role)
{
    $role->delete();

    return redirect()->route('roles.index')->with('success', 'Rôle supprimé avec succès.');
}

}
