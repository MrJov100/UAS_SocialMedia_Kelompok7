<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .username {
            font-size: 18px;
            font-weight: bold;
        }
        .header button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .header button:hover {
            background-color: #0056b3;
        }
        .upload-section {
            margin-bottom: 20px;
        }
        .upload-section input[type="file"],
        .upload-section textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .upload-section .post-button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        .upload-section .post-button:hover {
            background-color: #218838;
        }
        .uploaded-photo {
            margin-top: 20px;
        }
        .photo-container {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            max-width: 100%;
            overflow: hidden;
            background-color: #fafafa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .photo-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .photo-container .caption {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }
        .photo-container .upload-time {
            margin-top: 5px;
            font-size: 12px;
            color: #999;
        }
        .delete-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <div class="username">Username: @username</div>
        <div>
            <button class="profile-button" onclick="window.location.href='profile.html'">Profil Pengguna</button>
            <button class="logout-button" onclick="window.location.href='logout.html'">Log Out</button>
        </div>
    </div>

    <div class="upload-section">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return checkFileSize()">
            @csrf
            <input type="file" name="foto" id="fileUpload" required>
            <textarea name="caption" id="caption" placeholder="Tulis caption Anda di sini..." required></textarea>
            <button type="submit" class="post-button">Post Foto</button>
        </form>
    </div>

    <div class="uploaded-photo" id="uploadedPhoto">
        @if ($postingans->isEmpty())
            <p>Tidak ada postingan.</p>
        @else
            @foreach($postingans as $postingan)
                <div class="photo-container">
                    <img src="{{ asset('foto/'.$postingan->foto) }}" alt="Uploaded Photo">
                    <div class="caption">{{ $postingan->caption }}</div>
                    <div class="upload-time">{{ $postingan->created_at->format('d-m-Y') }}</div>
                    <form action="{{ route('post.destroy', $postingan->id) }}" method="POST" onsubmit="return confirmDelete(this);">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button">Hapus</button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    // Fungsi konfirmasi hapus foto
    function confirmDelete(form) {
        if (confirm("Anda yakin ingin menghapus foto ini?")) {
            form.submit(); 
        } else {
            return false; 
        }
    }

    // Fungsi untuk cek ukuran foto
    function checkFileSize() {
        var input = document.getElementById('fileUpload');
        if ('files' in input && input.files.length > 0) {
            var fileSize = input.files[0].size; // dalam bytes
            var maxSize = 5 * 1024 * 1024; // 5MB

            if (fileSize > maxSize) {
                alert('Ukuran foto terlalu besar! Maksimum 5MB.');
                return false;
            }
        }
        return true;
    }
</script>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

</body>
</html>