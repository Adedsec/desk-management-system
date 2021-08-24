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

    //show input letters page --->shows live wire component : Letter.InputPage
    public function input()
    {
        return view('letter.input');
    }


    //show Sent letters page --->shows live wire component : Letter.SentPage
    public function sent()
    {
        return view('letter.sent');
    }

    //show one Letter
    public function show(Letter $letter)
    {
        $letter->load(['users', 'tags']);
        return view('letter.show', compact('letter'));
    }

    //show archived letters page --->shows live wire component : Letter.ArchivePage
    public function archive()
    {
        return view('letter.archive');
    }

    // if letter is archive ,remove it and if not archived , archive it
    public function ToggleArchive(Letter $letter)
    {

        try {

            $letter->toggleArchive(Auth::user());
            return redirect()->route('letters.archive')->with('success', 'عملیات با موفقیت انجام شد');
        } catch (\Exception $exception) {

            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }
}
