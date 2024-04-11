

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add project</title>
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
        input[type="number"] {
            width: 10%;
        }

    </style>
</head>
<body>
    <form action="{{ route('project.store') }}" method="POST">
        @csrf

        <label for="name">Project name:</label>
        <input type="text" name="name" id="name">

        <label for="description">Project description:</label>
        <input type="text" name="description" id="description">

        <label for="number">Project price:</label>
        <input type="number" name="price" id="price">

        <label for="tasks_completed">Completed tasks:</label>
        <input type="text" name="tasks_completed" id="tasks_completed">

        <label for="start_date">Start date:</label>
        <input type="date" name="start_date" id="start_date">
        <label for="end_date">End date:</label>
        <input type="date" name="end_date" id="end_date">
        <label for="users">Users (for multiple selection press CTRL + left click):</label>
        <select name="users[]" multiple>
            <!-- Fill with all available users except for the current user -->
            @foreach ($users as $user)
                @if ($user != $u)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endif
            @endforeach
        </select>

        <button type="submit">Create project</button>
    </form>
</body>
</html>
