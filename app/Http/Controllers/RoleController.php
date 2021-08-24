<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->activeDesk->roles;
        return view('roles.list', compact('roles'));
    }

    public function store(Request $request)
    {

        $this->validateForm($request);

        Auth::user()->activeDesk->roles()->create($request->only(['name', 'persian_name']));
        return back()->with('success', 'نقش جدید باموفقیت ایجاد شد');

    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'persian_name' => ['required']
        ]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('permissions', 'role'));

    }

    public function update(Request $request, Role $role)
    {
        $this->validateForm($request);
        $role->update($request->only(['name', 'persian_name']));
        $role->refreshPermissions($request->only('permissions'));
        return back()->with('success', 'عملیات با موفقیت انجام شد ');
    }

    public function delete(Role $role)
    {
        $role->delete();

        return back()->with('success', 'نقش موردنظر حذف شد');
    }
}
