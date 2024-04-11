<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Auth;

class ProjectController extends Controller
{
    // Used for creating project
    public function create()
    {  
        $user = auth()->user();
        $users = User::all();  
        // Passing current user and all users to view to be able to create <select> element
        // of all possible members of the project
        return view('projects.create', ['users' => $users, 'u' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Create project from form entry
        $project = Project::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'tasks_completed' => $request->input('tasks_completed'),   
        ]);
        // Enter leader into DB
        $user = auth()->id();
        $project->teamMembers()->attach($user, ['is_leader' => 1]);

        // Enter other members into DB
        $users = $request->input('users');
        $project->teamMembers()->attach($users);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $users = User::all();
        $user = auth()->user();  
        // Check if the user is leader, used to disable input fields in the form if not
        $isLeader = $project->teamMembers()->wherePivot('user_id', auth()->user()->id)->wherePivot('is_leader', 1)->exists();
        return view('projects.edit', ['users' => $users, 'project' => $project, 'u' => $user, 'isLeader' => $isLeader]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $isLeader = $project->teamMembers()->wherePivot('user_id', auth()->user()->id)->wherePivot('is_leader', 1)->exists();

        // Allow updating only if the user is the leader
        if ( $isLeader) {
            $project->name = $request->input('name');
            $project->description = $request->input('description');
            $project->price = $request->input('price');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
        }
        $project->tasks_completed = $request->input('tasks_completed');        
        $users = $request->input('users');
        $project->teamMembers()->attach($users);
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
