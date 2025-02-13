<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.user-management.roles.index', compact('roles'));
    }

    public function create()
    {
        // $permissions = Permission::all(); // Fetch all permissions
        // return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
            'display_name' => 'required|string',
            'permissions' => 'array' // Validate as an array
        ]);

        $role = Role::create($request->only(['name', 'display_name']));
        $role->permissions()->sync($request->permissions); // Assign permissions

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show(string $id)
{
    $role = Role::with('permissions')->findOrFail($id); // Fetch role with its permissions
    return view('admin.user-management.roles.show', compact('role'));
}

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Fetch all permissions from DB
        return view('admin.user-management.roles.edit', compact('role', 'permissions'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'display_name' => 'required|string',
            'permissions' => 'array'
        ]);
    
        $role = Role::findOrFail($id);
        $role->update($request->only(['name', 'display_name']));
    
        $permissions = $request->input('permissions', []); // Fetch permissions from form
        $role->permissions()->sync($permissions); // Sync permissions
    
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }
    

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach(); // Remove permissions before deletion
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
