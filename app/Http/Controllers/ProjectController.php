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

    //show project index page --->shows live wire component : Project.TasksPage
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }


    //shows create project form
    public function create()
    {
        if (Gate::allows('manage_project')) {
            $activeDesk = Auth::user()->activeDesk;
            return view('project.create', compact('activeDesk'));

        } else {
            return abort(403);
        }
    }


    //create new project
    public function store(Request $request)
    {
        $this->validateForm($request);

        try {

            //storing form data
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
        } catch (\Exception $exception) {
            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }

    }


    //show project index page --->shows live wire component : Project.TasksPage
    public function show(Project $project)
    {
        return view('project.index', compact('project'));
    }


    //show project board page --->shows live wire component : Project.Board
    public function board(Project $project)
    {
        return view('project.board', compact('project'));
    }

    //update users of project
    public function updateUsers(Request $request, Project $project)
    {
        try {
            $project->users()->sync($request->get('users'));
            $project->users()->syncWithoutDetaching($project->admin_id);
            return back()->with('success', 'عملیات با موفقیت انجام شد');
        } catch (\Exception $exception) {
            return back()->with('error', 'مشکلی در انجام عملیات رخ داده است');
        }
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

    //delete project
    public function delete(Project $project)
    {
        $project->tasks()->delete();
        $project->delete();
        return redirect()->route('home')->with('success', 'پروژه با موفقیت حذف شد');
    }
}
