<!-- resources/views/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
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
        <h1>{{ $user->username }}</h1>
        <p>{{ $user->bio }}</p>
    </div>
</body>
</html>
