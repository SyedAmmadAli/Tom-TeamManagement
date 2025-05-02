<!DOCTYPE html>
<html>
<head>
    <title>Facebook User Info</title>
</head>
<body>
    <h1>Facebook User Details</h1>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <img src="{{ $user->avatar }}" alt="Profile Picture">

    <br><br>
    <a href="{{ url('/') }}">Go Back</a>
</body>
</html>
