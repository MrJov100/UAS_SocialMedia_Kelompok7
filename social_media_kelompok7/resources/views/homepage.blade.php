<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Beranda Media Sosial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .username {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .profile-button, .logout-button, .post-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button {
            background-color: #dc3545;
        }
        .post-button {
            background-color: #28a745;
        }
        .upload-section {
            margin: 20px 0;
        }
        .upload-section input[type="file"] {
            margin-bottom: 10px;
        }
        .upload-section textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="username">Username: @username</div>
    <button class="profile-button" onclick="window.location.href='profile.html'">Profil Pengguna</button>
    <button class="logout-button" onclick="window.location.href='logout.html'">Log Out</button>

    <div class="upload-section">
        <input type="file" id="fileUpload">
        <textarea id="caption" placeholder="Tulis caption Anda di sini..."></textarea>
    </div>
    <button class="post-button" onclick="postPhoto()">Post Foto</button>
</div>

<script>
    function postPhoto() {
        const fileUpload = document.getElementById('fileUpload');
        const caption = document.getElementById('caption').value;

        if (fileUpload.files.length === 0) {
            alert("Pilih file gambar terlebih dahulu.");
            return;
        }

        // Contoh logika upload gambar dan caption
        // Anda bisa menggantinya dengan logika sebenarnya untuk mengunggah file dan caption ke server
        const formData = new FormData();
        formData.append('file', fileUpload.files[0]);
        formData.append('caption', caption);

        // Simulasi proses upload
        alert("Foto dan caption berhasil diunggah!");
        // Di sini Anda dapat menambahkan logika untuk mengirim formData ke server

        // Reset form setelah upload
        fileUpload.value = "";
        caption.value = "";
    }
</script>

</body>
</html>
