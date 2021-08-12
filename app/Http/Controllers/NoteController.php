<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $desk = Auth::user()->activeDesk;
        return view('note.index', compact('desk'));
    }
}
