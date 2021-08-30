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

    public function paraph()
    {
        return view('letter.paraph');
    }

    //show one Letter
    public function show(Letter $letter)
    {
        $letter->load(['users', 'tags']);
        $paraphs = $letter->getUserParaphs(Auth::user());
        return view('letter.show', compact('letter', 'paraphs'));
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

    public function addParaph(Request $request, Letter $letter)
    {
        $request->validate([
            'body' => ['required', 'string'],
            'users' => ['nullable', 'array']
        ]);

        $paraph = $letter->paraphs()->create([
            'body' => $request->get('body'),
            'user_id' => Auth::user()->id
        ]);

        $paraph->users()->attach($request->get('users'));

        $paraph->save();

        return back()->with('success', 'عملیات با موفقیت انجام شد ');
    }
}
