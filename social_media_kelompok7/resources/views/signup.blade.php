<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 300px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 15px;
            text-align: center;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Buat Akun</h2>
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="input-group">
                    <label for="first-name">Nama Depan</label>
                    <input type="text" id="first-name" name="first_name" required>
                    @error('first_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="last-name">Nama Belakang</label>
                    <input type="text" id="last-name" name="last_name" required>
                    @error('last_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Tambahkan sisa form fields dengan pesan kesalahan -->
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    @error('username')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="password_confirmation" required>
                    @error('password_confirmation')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="dob">Tanggal Lahir</label>
                    <input type="date" id="dob" name="dob" required>
                    @error('dob')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select id="gender" name="gender" required>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                        <option value="other">Lainnya</option>
                    </select>
                    @error('gender')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Tombol "Buat Akun" -->
                <button type="submit">Buat Akun</button>
            </form>
            <p>Sudah punya akun? <a href="/">Login</a></p>
        </div>
    </div>
</body>
</html>