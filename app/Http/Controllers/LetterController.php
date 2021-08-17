<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function input()
    {

        return view('letter.input');
    }

    public function sent()
    {
        return view('letter.sent');
    }

    public function show(Letter $letter)
    {
        $letter->load(['users', 'tags']);
        return view('letter.show', compact('letter'));
    }

    public function archive()
    {
        $letters = Letter::where('archived', true)->get();
        return view('letter.input', compact('letters'));
    }

    public function ToggleArchive(Letter $letter)
    {
        $letter->toggleArchive();
        return redirect()->route('letters.archive')->with('success', 'عملیات با موفقیت انجام شد');
    }
}
