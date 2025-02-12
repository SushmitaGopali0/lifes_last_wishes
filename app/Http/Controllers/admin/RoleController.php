<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admin.user-management.roles.index', compact('roles'));
    }

    /**
     * Show the details of a specific role.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.user-management.roles.show', compact('role'));
    }
}

