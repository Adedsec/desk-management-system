<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        if (Gate::allows('manage_project')) {
            $activeDesk = Auth::user()->activeDesk;
            return view('project.create', compact('activeDesk'));

        } else {
            return abort(403);
        }
    }


    public function store(Request $request)
    {
        //storing form data
        $this->validateForm($request);
        $data = array_merge($request->except('_token', 'users'), ['admin_id' => Auth::user()->id]);
        $project = Auth::user()->activeDesk->projects()->create($data);

        //check if image exists and upload it
        if ($request->has('image')) {
            $file = $request->file('image');
            $name = 'project_' . $project->id . '.' . $file->extension();
            $path = 'project/';
            Storage::disk('public')->putFileAs($path, $file, $name);
            $image = Storage::url($path . $name);
            $project->image = $image;
            $project->save();
        }
        //add users to project
        $project->users()->attach(Auth::user()->id);
        $project->users()->attach($request->get('users'));
        return redirect()->route('projects.index')->with('success', 'پروژه جدید با موفقیت ایجاد شد ');
    }

    public function show(Project $project)
    {
        return view('project.index', compact('project'));
    }

    public function board(Project $project)
    {
        return view('project.board', compact('project'));
    }

    public function updateUsers(Request $request, Project $project)
    {
        $project->users()->sync($request->get('users'));
        return back()->with('success', 'عملیات با موفقیت انجام شد');
    }

    private function validateForm(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => [Rule::in(['white', 'red', 'green', 'yellow', 'purple', 'orange'])],
            'image' => ['file', 'image'],
            'users' => ['array'],
            'users.*' => ['exists:users,id']
        ]);
    }

    public function delete(Project $project)
    {
        $project->tasks()->delete();
        $project->delete();
        return redirect()->route('home')->with('success', 'پروژه با موفقیت حذف شد');
    }
}
