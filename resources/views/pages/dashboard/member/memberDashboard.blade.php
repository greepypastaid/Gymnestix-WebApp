<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Member Dashboard</title>
</head>

<body>
    <h1>Halo Member</h1>
    <p>Ini halaman dashboard untuk Member.</p>
    <a href="{{ route('profile.edit') }}">Profile</a> |
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>