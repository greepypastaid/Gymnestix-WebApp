<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Trainer Dashboard</title>
</head>

<body>
    <h1>Halo Trainer - {{ Auth::user()->nama }}</h1>
    <p>Ini halaman dashboard untuk Trainer.</p>
    <p>Role: {{ Auth::user()->getRoleName() }}</p>
    
    <div>
        <h2>Trainer Menu</h2>
        <ul>
            <li><a href="#">My Classes</a></li>
            <li><a href="#">Schedule</a></li>
            <li><a href="#">My Members</a></li>
            <li><a href="#">Progress Reports</a></li>
            <li><a href="#">Equipment Management</a></li>
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