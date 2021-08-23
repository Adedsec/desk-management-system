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

    public function acceptRequest(JoinRequest $joinRequest)
    {
        if (Auth::user()->id == $joinRequest->user->id) {

            $joinRequest->desk->users()->attach($joinRequest->user);
            Auth::user()->active_desk_id = $joinRequest->desk->id;
            Auth::user()->save();
            $joinRequest->delete();
            return redirect()->route('home')->with('success', 'با موفقیت به میزکار اضافه شدید');
        }

        return back()->with('error', 'مشکلی رخ داده است !');
    }

    public function deleteRequest(JoinRequest $joinRequest)
    {
        $joinRequest->delete();
        return back()->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function changePasswordForm()
    {
        $user = Auth::user();

        return view('auth.passwords.change', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $this->validateForm($request);
        User::find(Auth::user()->id)->update(['password' => Hash::make($request->get('password'))]);
        return redirect()->route('user.profile')->with('success', 'رمزعبور با موفقیت تغییر کرد . لطفا با رمز عبور جدید وارد شوید !');
    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'currentPassword' => ['required', 'string', new CurrentPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:currentPassword'],
        ]);
    }

}
