<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            padding: 1rem 2rem;
        }
        h1 {
            margin-bottom: 2rem;
        }
        ul {
  list-style-type: none;
}
div {
    background-color: whitesmoke;
    margin-bottom: 2rem;
    margin-left: 1rem;
    width: 50vw;
    padding: 1rem;
    border-radius: 1rem;
}
h2, p, h3 {
    margin-bottom: 0.5rem;
}

    </style>
</head>
<body>
    <h1>User projects</h1>

    @if ($projects->isEmpty())
        <p>No projects found.</p>
    @else
            @foreach ($projects as $project)
                <div>
                    <h2>{{ $project->name }}</h2>
                    @if ($project->leader())
                        <h3>Leader</h3>
                    @else
                        <h3>Member</h3>
                    @endif
                    <p><b>Description: </b>{{ $project->description}}</p>
                    <h3><b>Price: </b>{{ $project->price }} EUR</h3>
                </div>
            @endforeach
    @endif
</body>
</html>
