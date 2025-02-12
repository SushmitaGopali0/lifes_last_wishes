<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Management')</title>
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="{{ route('users.index') }}" class="logo">User Management</a>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
