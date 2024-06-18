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

        .edit-button {
            position: absolute;
            top: 40px;
            right: 10px;
            background-color: #ffc107;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .user-info {
            margin-bottom: 8px;
        }

        .username {
            font-weight: bold;
            font-size: 16px;
            /* sesuaikan ukuran font */
        }

        .upload-section input[type="file"],
        .interaction textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-button {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .comment-section-2 {
            display: flex;
            align-items: center;
        }

        .comment-section-2 p {
            margin-right: 10px;
        }

        .edit-comment-button,
        .delete-comment-button {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .edit-comment-button:hover,
        .delete-comment-button:hover {
            background-color: #c82333;
        }

        .edit-comment-form {
            display: none;
            margin-top: 10px;
        }

        .edit-comment-form textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <div class="username">{{ Auth::user()->username }}</div>
            <button class="profile-button" onclick="window.location.href='/profile'">Profil Pengguna</button>

            <form method="POST" action="/logout">
                @csrf
                <button class="logout-button" type="submit">Log Out</button>
            </form>
        </div>

        <div class="upload-section">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return checkFileSize()">
                @csrf
                <input type="file" name="foto" id="fileUpload" required>
                <textarea name="caption" id="caption" placeholder="Tulis caption Anda..." required></textarea>
                <button type="submit" class="post-button">Post Foto</button>
            </form>
        </div>

        <div class="uploaded-photo" id="uploadedPhoto">
            @if ($postingans->isEmpty())
                <p>Tidak ada postingan.</p>
            @else
                @foreach ($postingans as $postingan)
                    <div class="photo-container">
                        <div class="user-info">
                            <span class="username">@ {{ $postingan->user->username }}</span>
                        </div>
                        <img src="{{ asset('foto/' . $postingan->foto) }}" alt="Uploaded Photo">
                        <div class="caption">
                            <p id="caption-{{ $postingan->id }}">{{ $postingan->caption }}</p>
                        </div>
                        <div class="upload-time">{{ $postingan->created_at->format('d-m-Y') }}</div>
                        @foreach ($postingan->comments as $comment)
                            <div class="comment-section">
                                <h5>@ {{ $comment->user->username }}</h5>
                                <div class="comment-section-2">
                                    <p>{{ $comment->comment }}</p>
                                    @if (Auth::id() == $comment->user_id)
                                        <!-- Edit form -->
                                        <form id="edit-comment-form-{{ $comment->id }}"
                                            action="{{ route('comment.update', $comment->id) }}" method="POST"
                                            class="edit-comment-form">
                                            @csrf
                                            @method('post')
                                            <textarea name="comment" required>{{ $comment->comment }}</textarea>
                                            <button type="submit" class="edit-comment-button">Simpan</button>
                                        </form>
                                        <button onclick="editComment({{ $comment->id }})">Edit</button>
                                        <!-- Delete form -->
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                            style="display: inline; margin-left: 10px">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-comment-button">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="interaction">
                            <form action="{{ route('comment.store', $postingan->id) }}" method="POST"
                                class="comment-form">
                                @csrf
                                <textarea name="comment" placeholder="Tulis komentar Anda..." required></textarea>
                                <button type="submit" class="comment-button">Komentar</button>
                            </form>
                        </div>
                        @if (Auth::user()->id == $postingan->user_id)
                            <form action="{{ route('post.destroy', $postingan->id) }}" method="POST"
                                onsubmit="return confirmDelete(this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Hapus</button>
                            </form>
                            <button onclick="editCaption({{ $postingan->id }})" class="edit-button">Edit</button>
                            <form id="edit-form-{{ $postingan->id }}"
                                action="{{ route('postingan.update', $postingan->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="caption" value="{{ $postingan->caption }}">
                                <button type="submit" class="save-button">Simpan</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Handle comment form submission via AJAX
                $('.comment-form').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: form.serialize(),
                        success: function(response) {
                            alert('Komentar berhasil ditambahkan.');
                            form.find('textarea').val(''); // Clear textarea after submission
                            window.location.reload();
                        },
                        error: function(error) {
                            alert('Terjadi kesalahan saat menambahkan komentar.');
                        }
                    });
                });

                // Handle edit comment button click
                window.editComment = function(commentId) {
                    $(`#edit-comment-form-${commentId}`).show();
                }

                // Handle edit comment form submission via AJAX
                $('.edit-comment-form').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: form.serialize(),
                        success: function(response) {
                            alert('Komentar berhasil diperbarui.');
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });

                // Fungsi konfirmasi hapus foto
                window.confirmDelete = function(form) {
                    if (confirm("Anda yakin ingin menghapus foto ini?")) {
                        form.submit();
                    } else {
                        return false;
                    }
                }

                // Fungsi untuk cek ukuran foto
                window.checkFileSize = function() {
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

                window.editCaption = function(postId) {
                    document.getElementById(`caption-${postId}`).style.display = 'none';
                    document.getElementById(`edit-form-${postId}`).style.display = 'block';
                }
            });
        </script>

        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif
    </div>
</body>

</html>
