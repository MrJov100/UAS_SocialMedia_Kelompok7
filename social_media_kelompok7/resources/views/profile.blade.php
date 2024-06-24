<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .profile h1 {
            font-size: 2em;
            margin: 0.5em 0;
        }
        .profile p {
            font-size: 1em;
            color: #666;
        }

        /* CSS untuk postingan */
        .posts {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            overflow: hidden;
        }
        .post {
            width: calc(33.33% - 20px);
            float: left;
            margin: 10px;
            box-sizing: border-box;
            text-align: center;
        }
        .post img {
            max-width: 100%;
            height: 150px;
            object-fit: cover; /* Memastikan semua gambar memiliki ukuran seragam */
            border-radius: 8px;
            cursor: pointer; /* Menunjukkan gambar bisa diklik */
        }
        .post p {
            margin-top: 10px;
        }
        .post form {
            margin-top: 10px;
        }
        .post button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Gaya tombol kembali */
        .back-button, .settings-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a, .settings-button a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .back-button a:hover, .settings-button a:hover {
            background-color: #0056b3;
        }

        /* Lightbox CSS */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
        }
        .lightbox img {
            max-width: 90%;
            max-height: 80%;
        }
    </style>
</head>
<body>
    <div class="profile">
        @if(auth()->user()->profile_picture)
            <div class="profile-picture">
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" width="150">
            </div>
        @endif

        <h1>{{ Auth::user()->username }}</h1>
        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        @if (Auth::user()->birth_date)
            <p>Tanggal Lahir: {{ \Carbon\Carbon::parse(Auth::user()->birth_date)->format('d M Y') }}</p>
        @else
            <p>Tanggal Lahir: Belum diatur</p>
        @endif
        <p>Jenis Kelamin: {{ Auth::user()->gender }}</p>
    </div>

    <div class="settings-button">
        <a href="{{ route('profile.settings') }}">Pengaturan Profil</a>
    </div>

    <div class="back-button">
        <a href="{{ route('beranda') }}">Kembali ke Beranda</a>
    </div>

    <div class="posts">
        <h2>Postingan</h2>
        <div class="post-grid">
            @foreach ($postingans as $index => $postingan)
                <div class="post" style="order: {{ $index }}">
                    <img src="{{ asset('foto/' . $postingan->foto) }}" alt="Postingan" onclick="openLightbox(this)">
                    <p>{{ $postingan->caption }}</p>
                    <form action="{{ route('post.destroy', $postingan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </div>
            @endforeach
            <div style="clear: both;"></div>
        </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="" alt="Enlarged Image">
    </div>

    <script>
        function openLightbox(element) {
            document.getElementById('lightbox-img').src = element.src;
            document.getElementById('lightbox').style.display = 'flex';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }
    </script>
</body>
</html>
