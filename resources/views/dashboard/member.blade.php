<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Member Dashboard</title>
</head>

<body>
    <h1>Halo Member - {{ Auth::user()->nama }}</h1>
    <p>Ini halaman dashboard untuk Member.</p>
    <p>Role: {{ Auth::user()->getRoleName() }}</p>
    
    <div>
        <h2>Member Menu</h2>
        <ul>
            <li><a href="#">My Membership</a></li>
            <li><a href="#">Book Classes</a></li>
            <li><a href="#">My Bookings</a></li>
            <li><a href="#">Workout Progress</a></li>
            <li><a href="#">Equipment Booking</a></li>
            <li><a href="#">Billing History</a></li>
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