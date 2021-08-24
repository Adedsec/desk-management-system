<?php

namespace App\Http\Controllers;

use App\Models\JoinRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //show desk users list
    public function index()
    {
        $users = Auth::user()->activeDesk->users()->with('roles')->get();
        return view('users.list', compact('users'));
    }


    //show user profile
    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));

    }

    //show user edit role form
    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Auth::user()->activeDesk->roles;
        $user->load('roles', 'permissions');
        return view('users.edit', compact('permissions', 'user', 'roles'));
    }

    //update user's roles
    public function update(Request $request, User $user)
    {
        try {
            $user->refreshPermissions($request->get('permissions'));
            $user->refreshRoles($request->get('roles'));
            return back()->with('success', 'اطلاعات کاربر با موفقیت ثبت شد ');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    // handling user accept request
    public function acceptRequest(JoinRequest $joinRequest)
    {

        try {
            //check if user is valid
            if (Auth::user()->id == $joinRequest->user->id) {
                $joinRequest->desk->users()->attach($joinRequest->user);
                Auth::user()->active_desk_id = $joinRequest->desk->id;
                Auth::user()->save();
                $joinRequest->delete();
                return redirect()->route('home')->with('success', 'با موفقیت به میزکار اضافه شدید');
            }

            return back()->with('error', 'مشکلی رخ داده است !');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    // delete join request
    public function deleteRequest(JoinRequest $joinRequest)
    {
        try {
            $joinRequest->delete();
            return back()->with('success', 'عملیات با موفقیت انجام شد');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    //show change password form
    public function changePasswordForm()
    {
        $user = Auth::user();
        return view('auth.passwords.change', compact('user'));
    }

    // change password of user
    public function changePassword(Request $request)
    {
        $this->validateForm($request);

        try {
            User::find(Auth::user()->id)->update(['password' => Hash::make($request->get('password'))]);
            return redirect()->route('user.profile')->with('success', 'رمزعبور با موفقیت تغییر کرد . لطفا با رمز عبور جدید وارد شوید !');

        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'currentPassword' => ['required', 'string', new CurrentPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:currentPassword'],
        ]);
    }

}
