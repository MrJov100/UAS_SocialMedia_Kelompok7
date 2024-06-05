<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Profil Pengguna: {{ $user->username }}</h1>
    </header>
    <main>
        <p>Nama: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <!-- Informasi lain yang ingin ditampilkan -->
    </main>
    <footer>
        <p>&copy; 2024 Universitas Tarumanagara</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>