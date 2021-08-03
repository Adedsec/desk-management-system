<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.list', compact('users'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));

    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $user->load('roles', 'permissions');
        return view('users.edit', compact('permissions', 'user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->refreshPermissions($request->get('permissions'));
        $user->refreshRoles($request->get('roles'));
        return back()->with('success', 'اطلاعات کاربر با موفقیت ثبت شد ');
    }
}
