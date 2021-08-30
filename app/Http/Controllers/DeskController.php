<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\JoinRequestMail;
use App\Models\Desk;
use App\Models\JoinRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DeskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // show create desk form
    public function create()
    {
        return view('desk.create');
    }


    //create new desk
    public function store(Request $request)
    {
        $this->validateForm($request);

        try {
            $name = $request->get('name');
            $slug = Str::slug($name);
            $admin = Auth::user();
            $desk = Desk::create([
                'name' => $name,
                'slug' => $slug,
                'admin_id' => $admin->id
            ]);
            //add admin user to users of desk
            $desk->users()->attach($admin);

            //set desk as Active desk
            $admin->active_desk_id = $desk->id;

            $admin->save();

            //create admin role for desk
            $admin_role = $desk->roles()->create([
                'name' => 'admin',
                'persian_name' => 'مدیر',
            ]);
            //attach all permissions to admin role
            $admin_role->permissions()->attach(Permission::all());

            //give admin role to admin of desk
            $admin->giveRolesTo('admin');

            return redirect('/dashboard')->with('success', 'میزکار با موفقیت ایجاد و انتخاب شد');

        } catch (\Exception $e) {
            return back()->with('error', 'عملیات با خطا مواجه شد !');
        }


    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
    }

    //change active desk of user
    public function select(Desk $desk)
    {
        try {
            $admin = Auth::user();
            $admin->active_desk_id = $desk->id;
            $admin->save();
            return redirect()->route('home')->with('success', 'میزکار شما با موفقیت تغییر کرد');
        } catch (\Exception $exception) {
            return redirect()->route('home')->with('error', 'مشکلی در انجام عملیات رخ داده است');

        }
    }

    //show setting page
    public function setting()
    {
        $desk_id = Auth::user()->active_desk_id;
        $desk = Desk::findOrFail($desk_id);
        return view('desk.setting', compact('desk'));
    }

    //change name of desk
    public function update(Request $request, Desk $desk)
    {
        $this->validateForm($request);
        try {

            $desk->name = $request->get('name');
            $desk->slug = Str::slug($request->get('name'));
            $desk->save();
            return back()->with('success', 'نام طرح با موفقیت تغییر کرد');
        } catch (\Exception $e) {

            return back()->with('error', 'عملیات با مشکل  مواجه شد !!');
        }
    }


    //handling invite users to desk requests
    public function SendRequest(Request $request, Desk $desk)
    {

        $request->validate([
            'email' => ['required', 'email', 'string']
        ]);

        try {
            $email = $request->get('email');

            //check if user exists in desk
            if ($desk->users->contains('email', $email)) {
                return back()->with('error', 'کاربر مورد هم اکنون عضو میز کار است');
            }


            //check if user exists in the web app
            if (User::all()->contains('email', $email)) {
                //send JoinRequest
                $user = User::where('email', $email)->first();

                //check if user is in desk or not

                //check if Request not sent before
                if (!(JoinRequest::all()->where('desk_id', $desk->id)->where('user_id', $user->id)->isEmpty()))
                    return back()->with('error', 'درخواست قبلا ارسال شده است');

                //send join request to user
                JoinRequest::create([
                    'sender_id' => Auth::user()->id,
                    'desk_id' => $desk->id,
                    'user_id' => $user->id
                ]);
                return back()->with('success', 'درخواست برای کاربر ارسال شد');
            } else {
                // register user in web app
                $name = explode('@', $email)[0];
                $password = mt_rand(10000000, 99999999);

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'active_desk_id' => $desk->id
                ]);

                //send login information email to user
                SendEmail::dispatchNow($user, new JoinRequestMail($desk, $password, Auth::user()));

                //send join request to user

                JoinRequest::create([
                    'sender_id' => Auth::user()->id,
                    'desk_id' => $desk->id,
                    'user_id' => $user->id
                ]);
                return back()->with('success', 'ایمیل ثبت نام در سیستم برای کاربر ارسال شد');

            }
        } catch (\Exception $exception) {
            //dd($exception);
            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }

    //remove user from desk
    public function deleteUser(Desk $desk, User $user)
    {

        try {
            $desk->users()->detach($user);
            $user->roles()->detach($desk->roles);
            foreach ($desk->projects as $project) {
                foreach ($project->tasks as $task) {
                    $task->users()->detach($user);
                }
                $project->users()->detach($user);
            }
            return back()->with('success', 'کاربر با موفقیت از میزکار حذف شد');
        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }


    }

    //delete desk
    public function delete(Desk $desk)
    {

        try {
            $desk->tasks()->delete();
            $desk->projects()->delete();
            foreach ($desk->projects as $project) {
                $project->lists()->delete();
            }
            $desk->letters()->delete();
            $desk->notes()->delete();
            $desk->tags()->delete();
            $desk->delete();

            $user = Auth::user();
            $user->active_desk_id = Auth::user()->desks->sortBy('id')->first()->id ?? null;
            $user->save();

            return redirect()->route('home')->with('success', 'میزکار با موفقیت حذف شد');
        } catch (\Exception $e) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }


    }
}
