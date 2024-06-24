<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
        }
        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pengaturan Profil</h1>

        <h2>Akun</h2>
        <!-- Form untuk mengubah username dan email -->
        <form action="{{ route('profile.updateUsernameEmail') }}" method="POST">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" required>
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan Akun</button>
        </form>

        <hr>

        <h2>Password</h2>
        <!-- Form untuk mengubah password -->
        <form action="{{ route('profile.updatePassword') }}" method="POST">
            @csrf
            @method('PUT') 
            
            <div class="form-group">
                <label for="current_password">Password Lama:</label>
                <input type="password" name="current_password" id="current_password" required>
                @error('current_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru:</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan Password</button>
        </form>

        <hr>

        <h2>Nama</h2>
        <form action="{{ route('profile.updateName') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">Nama Depan:</label>
                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" required>
            </div>

            <div class="form-group">
                <label for="last_name">Nama Belakang:</label>
                <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan Nama</button>
        </form>

        <hr>

        <h2>Ubah Foto Profil</h2>
        <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="profile_picture">Foto Profil:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload Foto Profil</button>
        </form>

        <div class="back-button">
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Kembali ke Profil</a>
        </div>
    </div>
</body>
</html>
