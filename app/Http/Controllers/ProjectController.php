<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projects = $user->projects;

        return view('projects.index', ['projects' => $projects]);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', ['project' => $project]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $project = Project::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        $user = auth()->user();
        $user->projects()->attach($project->id);

        return redirect()->route('project.index');
    }
}
