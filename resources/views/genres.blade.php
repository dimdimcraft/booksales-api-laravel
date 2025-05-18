<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>genres</title>
</head>
<body>
    <h1>ini adalah halaman genres</h1>

    <h1>Genre List</h1>
    <ul>
        @foreach($genres as $genre)
            <li>{{ $genre['name'] }}</li>
            <li>{{ $genre['description']}}</li>
            <br>
        @endforeach
    </ul>
</body>
</html>