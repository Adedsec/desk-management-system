<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'send');
    }

    public function send()
    {

        if (Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
        Auth::user()->sendEmailVerificationNotification();
        return back()->with('success', 'ایمیل تاییدیه برای شما ارسال شد');
    }

    public function verify(Request $request)
    {

        if ($request->user()->email !== $request->query('email')) {
            throw new AuthenticationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->markEmailAsVerified();

        session()->forget('mostVerifyEmail');

        return redirect()->route('home')->with('success', 'ایمیل شما با موفقیت تایید شد ');
    }
}
