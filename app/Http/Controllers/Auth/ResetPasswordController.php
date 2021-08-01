<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {

        return view('auth.passwords.reset', [
            'email' => $request->query('email'),
            'token' => $request->query('token')
        ]);
    }

    public function reset(Request $request)
    {
        $this->validateForm($request);

        $response = Password::broker()->reset($request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'رمز عبور شما با موفقیت تغییر کرد . لطفا با رمز عبور جدید وارد شوید ')
            : back()->with('error', 'تغییر رمزعبور ناموفق بود');

    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }


    private function validateForm(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token' => ['required']
        ]);
    }
}
