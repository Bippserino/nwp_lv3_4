<style>
    * {
            margin: 0;
            padding: 0;
    }
    .projects>h1 {
            margin-bottom: 2rem;
            font-size: 1.5rem;
    }
    ul {
        list-style-type: none;
    }
    .projects>div {
        background-color: whitesmoke;
        margin-bottom: 2rem;
        margin-left: 1rem;
        width: 50vw;
        padding: 1rem;
        border-radius: 1rem;
    }
    .projects {
        margin-bottom: 2rem;
    }
    h2, p, h3 {
        margin-bottom: 0.5rem;
    }
    .edit {
        margin-right: 2rem;
    }
    .edit:hover {
        color: blue;
    }
    .delete:hover {
        color: red;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="projects">
                    <h1>User projects</h1>
                    @if ($projects->isEmpty())
                        <p>No projects found.</p>
                    @else
                            @foreach ($projects as $project)
                                <div>
                                    <h2>{{ $project->name }}</h2>
                                    <p><b>Description: </b>{{ $project->description}}</p>
                                    <h3><b>Price: </b>{{ $project->price }} EUR</h3>
                                    <h3><b>Completed Tasks:</b> {{ $project->tasks_completed }}</h3>
                                    <a class="edit" href="./dashboard/edit/{{ $project->id}}">Edit</a>
                                    <form action="{{ route('project.destroy', $project->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete" type="submit">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                    @endif
                    </div>
                    <a class="add-button" style="background-color: whitesmoke;padding: 1rem; border-radius: 1rem;" href="./dashboard/create">Add project</a>
                </div>
            </div>
        </div>  
    </div>
</x-app-layout>
