<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DeskController extends Controller
{
    public function create()
    {
        return view('desk.create');
    }

    public function store(Request $request)
    {
        $this->validateForm($request);
        $name = $request->get('name');
        $slug = Str::slug($name);
        $admin = Auth::user();
        $desk = Desk::create([
            'name' => $name,
            'slug' => $slug,
            'admin_id' => $admin->id
        ]);

        $desk->users()->attach($admin);

        $admin->active_desk_id = $desk->id;

        $admin->save();

        return redirect('/dashboard')->with('success', 'میزکار با موفقیت ایجاد و انتخاب شد');

    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
    }

    public function select(Desk $desk)
    {
        $admin = Auth::user();
        $admin->active_desk_id = $desk->id;
        $admin->save();
        return redirect('/dashboard')->with('success', 'میزکار شما با موفقیت تغییر کرد');
    }

    public function setting()
    {
        $desk_id = Auth::user()->active_desk_id;
        $desk = Desk::findOrFail($desk_id);
        return view('desk.setting', compact('desk'));
    }

    public function update(Request $request, Desk $desk)
    {
        $this->validateForm($request);
        $desk->name = $request->get('name');
        $desk->slug = Str::slug($request->get('name'));
        $desk->save();
        return back()->with('success', 'نام طرح با موفقیت تغییر کرد');
    }

    public function SendRequest(Request $request, Desk $desk)
    {

        $request->validate([
            'email' => ['required', 'email', 'string']
        ]);
        $email = $request->get('email');

        if ($desk->users->contains('email', $email)) {
            return back()->with('error', 'کاربر مورد هم اکنون عضو میز کار است');
        }

        if (User::all()->contains('email', $email)) {
            //send JoinRequest

            return back()->with('success', 'درخواست برای کاربر ارسال شد');
        } else {
            // register user

            //send email

            return back()->with('success', 'ایمیل ثبت نام در سیستم برای کاربر ارسال شد');

        }

    }
}
