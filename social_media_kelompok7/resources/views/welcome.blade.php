<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>
<body>
    <header>
        <h1>Selamat Datang di Beranda</h1>
    </header>
    <main>
        <p>HALAMAN BERANDA</p>
        <a href="{{ url('/profile') }}">
            <button>Profil Pengguna</button>
        </a>
        <br>
        <br>
        <a href="{{ url('/logout') }}">
            <button>Logout</button>
        </a>
        <br>
        <br>
        <p><<< Upload foto anda disini >>></p>
        <form action="{{ url('/upload-foto') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="foto" accept="image/*">
            <br>
            <label for="caption">Caption:</label>
            <input type="text" name="caption" placeholder="Masukkan caption foto">
            <br>
            <button type="submit">Kirim Foto</button>
        </form>
        <br>
        <br>
        <h2>Foto yang telah diupload:</h2>
        @if(count($fotos) > 0)
            @foreach($fotos as $foto)
                <div>
                    <img src="{{ asset('storage/'. $foto->foto) }}" alt="Foto" width="200px">
                    <p>Caption: {{ $foto->caption }}</p>
                </div>
            @endforeach
        @else
            <p>Belum ada foto yang diupload.</p>
        @endif
    </main>
    <footer>
        <p>&copy; 2024 Universitas Tarumanagara</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


