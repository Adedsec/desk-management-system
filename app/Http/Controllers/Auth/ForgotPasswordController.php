<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $this->validateForm($request);

        $response = Password::broker()->sendResetLink($request->only('email'));

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('success', 'لینک بازیابی رمز عبور برای شما ارسال شد');
        }

        return back()->with('error', 'خطایی در ارسال لینک بازیابی رمز عبور رخ داده است');
    }

    private function validateForm(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users']
        ]);
    }
}
