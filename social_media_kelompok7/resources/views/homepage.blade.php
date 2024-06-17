<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda Media Sosial</title>
    <style>
        .uploaded-photo {
            margin-top: 20px;
        }
        .photo-container {
            position: relative; /* Tambahkan posisi relatif */
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
            max-width: 400px; /* Maksimal lebar kontainer foto */
            overflow: hidden; /* Mengatasi overflow */
            display: block; /* Menampilkan foto secara vertikal */
            margin-bottom: 20px; /* Memberikan jarak antar foto */
        }
        .photo-container img {
            max-width: 100%; /* Maksimal lebar gambar mengikuti kontainer */
            height: auto; /* Mengatur tinggi secara otomatis sesuai dengan proporsi gambar */
        }
        .photo-container .caption {
            margin-top: 5px;
            font-size: 14px;
        }
        .photo-container .upload-time {
            font-size: 12px;
            color: #666;
        }
        .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #ff6666; /* Warna latar merah yang sedikit lebih terang saat dihover */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="username">{{ Auth::user()->username }}</div>
    <button class="profile-button" onclick="window.location.href='/profile'">Profil Pengguna</button>
    
    <form method="POST" action="/logout">
        @csrf
        <button class="logout-button" type="submit">Log Out</button>
    </form>

    <div class="upload-section">
        <input type="file" id="fileUpload">
        <textarea id="caption" placeholder="Tulis caption Anda di sini..."></textarea>
    </div>
    <button class="post-button" onclick="postPhoto()">Post Foto</button>

    <!-- Div untuk menampilkan foto yang diunggah -->
    <div class="uploaded-photo" id="uploadedPhoto"></div>
</div>

<script>
    function postPhoto() {
        const fileUpload = document.getElementById('fileUpload');
        const caption = document.getElementById('caption').value;

        if (fileUpload.files.length === 0) {
            alert("Pilih file gambar terlebih dahulu.");
            return;
        }

        const file = fileUpload.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('caption', caption);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("has been uploaded")) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoContainer = document.createElement('div');
                    photoContainer.classList.add('photo-container');

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const captionDiv = document.createElement('div');
                    captionDiv.classList.add('caption');
                    captionDiv.textContent = caption;

                    const uploadTimeDiv = document.createElement('div');
                    uploadTimeDiv.classList.add('upload-time');
                    uploadTimeDiv.textContent = "Tanggal Unggah: " + getCurrentDate(); // Tampilkan tanggal unggah

                    photoContainer.appendChild(img);
                    photoContainer.appendChild(captionDiv);
                    photoContainer.appendChild(uploadTimeDiv);

                    document.getElementById('uploadedPhoto').appendChild(photoContainer);

                    // Reset form setelah upload
                    fileUpload.value = "";
                    caption.value = "";
                }
                reader.readAsDataURL(file);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Ada kesalahan saat mengunggah foto.");
        });
    }

    // Fungsi untuk mendapatkan tanggal saat ini (format: dd-mm-yyyy)
    function getCurrentDate() {
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();
        return dd + '-' + mm + '-' + yyyy;
    }

    function deletePhoto(filename, button) {
        if (confirm("Apakah Anda yakin ingin menghapus foto ini?")) {
            fetch('delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    filename: filename
                })
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                if (data.includes("has been deleted")) {
                    // Hapus foto dari tampilan
                    const container = button.closest('.photo-container');
                    container.parentNode.removeChild(container);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Ada kesalahan saat menghapus foto.");
            });
        }
    }
</script>

</body>
</html>
