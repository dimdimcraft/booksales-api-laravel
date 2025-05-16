<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat datang</title>
</head>
<body>
    <h1>Hello world</h1>
    <p>Selamat datang di toko booksales</p>

    <h2>Daftar Buku</h2>
    @foreach ($books as $item)
    <ul>
        <li>{{ $item['title'] }}</li>
        <li>{{ $item['description'] }}</li>
        <li>{{ $item['price'] }}</li>
        <li>{{ $item['stok'] }}</li>
    </ul>
    @endforeach
</body>
</html>