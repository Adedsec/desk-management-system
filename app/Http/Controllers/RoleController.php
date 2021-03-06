<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    //show roles index page
    public function index()
    {
        $roles = Auth::user()->activeDesk->roles;
        return view('roles.list', compact('roles'));
    }


    //store new Role
    public function store(Request $request)
    {

        $this->validateForm($request);


        try {
            Auth::user()->activeDesk->roles()->create($request->only(['name', 'persian_name']));
            return back()->with('success', 'نقش جدید باموفقیت ایجاد شد');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }


    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'persian_name' => ['required']
        ]);
    }

    //Show Edit Role Form
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('permissions', 'role'));

    }


    //Update Role

    public function update(Request $request, Role $role)
    {
        $this->validateForm($request);

        try {
            $role->update($request->only(['name', 'persian_name']));
            $role->refreshPermissions($request->only('permissions'));
            return back()->with('success', 'عملیات با موفقیت انجام شد ');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }


    //delete Role
    public function delete(Role $role)
    {
        try {
            $role->delete();
            return back()->with('success', 'نقش موردنظر حذف شد');
        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }
}
