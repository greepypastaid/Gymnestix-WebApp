<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Halo Admin - {{ Auth::user()->nama }}</h1>
    <p>Ini halaman dashboard untuk Admin.</p>
    <p>Role: {{ Auth::user()->getRoleName() }}</p>
    
    <div>
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="#">Manage Users</a></li>
            <li><a href="#">Manage Trainers</a></li>
            <li><a href="#">Manage Members</a></li>
            <li><a href="#">Manage Classes</a></li>
            <li><a href="#">View Reports</a></li>
        </ul>
    </div>
    
    <hr>
    <a href="{{ route('profile.edit') }}">Profile</a> |
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>