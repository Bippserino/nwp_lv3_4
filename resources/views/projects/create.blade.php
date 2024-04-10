

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodavanje projekta</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 50vw;
        }
        form * {
            margin-bottom: 0.5rem;
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

        <label for="name">Naziv projekta:</label>
        <input type="text" name="name" id="name">

        <label for="description">Opis projekta:</label>
        <textarea name="description" id="description"></textarea>

        <label for="number">Cijena projekta:</label>
        <input type="number" name="price" id="price">
        <input type="date" name="start_date" id="start_date">

        <button type="submit">Stvori projekt</button>
    </form>
</body>
</html>
