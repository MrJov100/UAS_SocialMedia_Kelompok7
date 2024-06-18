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
    </style>
</head>
<body>
    <div class="profile">
        <img src="{{ $user->profile_picture }}" alt="Foto Profil">

        <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

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
</body>
</html>
