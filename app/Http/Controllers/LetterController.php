<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function input()
    {
        $letters = Auth::user()->activeDesk->letters;
        return view('letter.input');
    }

    public function sent()
    {
        $letters = Auth::user()->activeDesk->letters;
        return view('letter.sent');
    }
}
