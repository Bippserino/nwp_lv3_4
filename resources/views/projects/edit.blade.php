

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit project</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 50vw;
        }
        form input, form textarea {
            margin-bottom: 1rem;
        }
        button {
            width: 50%;
            margin: 0 auto;
        }
        label[for="tasks_completed"] {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <form id="updateForm{{ $project->id }}" action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Project name:</label>
        <!-- if function inside input checks if the user is leader and disables edit of certain inputs if not -->
        <input type="text" name="name" id="name" value="{{$project->name}}" @if (!$isLeader) disabled @endif>

        <label for="description">Project description:</label>
        <input type="text" name="description" id="description" value="{{$project->description}}" @if (!$isLeader) disabled @endif>

        <label for="number">Project price:</label>
        <input type="number" name="price" id="price" value="{{$project->price}}" @if (!$isLeader) disabled @endif>

        

        <label for="start_date">Start date:</label>
        <input type="date" name="start_date" id="start_date" value="{{$project->start_date}}" @if (!$isLeader) disabled @endif>
        <label for="end_date">End date:</label>
        <input type="date" name="end_date" id="end_date" value="{{$project->end_date}}" @if (!$isLeader) disabled @endif>
        <label for="users">Users (for multiple selection press CTRL + left click):</label>
        <select name="users[]" multiple @if (!$isLeader) disabled @endif>
            @foreach ($users as $user)
                @if ($user != $u)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
            @endforeach
        </select>
        <label for="tasks_completed">Completed tasks:</label>
        <input type="text" name="tasks_completed" id="tasks_completed" value="{{$project->tasks_completed}}">

        <button type="submit">Edit project</button>
    </form>
</body>
</html>
