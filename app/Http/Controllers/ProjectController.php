<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Auth;

class ProjectController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $users = User::all();   
        return view('projects.create', ['users' => $users, 'u' => $user]);
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
            'tasks_completed' => $request->input('tasks_completed'),   
        ]);

        $user = auth()->id();
        $project->users()->attach($user, ['is_leader' => 1]);

        $users = $request->input('users');
        $project->teamMembers()->attach($users);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        $user = auth()->user();  
        $isLeader = $project->teamMembers()->wherePivot('user_id', auth()->user()->id)->wherePivot('is_leader', 1)->exists();
        return view('projects.edit', ['users' => $users, 'project' => $project, 'u' => $user, 'isLeader' => $isLeader]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $isLeader = $project->teamMembers()->wherePivot('user_id', auth()->user()->id)->wherePivot('is_leader', 1)->exists();

        if ( $isLeader) {
            $project->name = $request->input('name');
            $project->description = $request->input('description');
            $project->price = $request->input('price');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
        }
        $project->tasks_completed = $request->input('tasks_completed');        

        $project->save();

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('dashboard');
    }
}
