<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href={{ url('css/generalStyle.css') }}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <h1>Courses Management System</h1>
    </header>
    <nav>
        @auth
            <div class="w-12 h-12 rounded-lg overflow-hidden inline-block relative left-3 top-3.5 mr-3">
                <img id="profileImageLayout"
                    src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : url('uploads/avatar.svg') }}"
                    class="w-12 h-12 rounded-lg object-cover" alt="Profile Image">
            </div>
            <div class="nav_links"><a href="{{ route('logout') }}">Logout 🔐</a></div>
            <div class="nav_links"><a href="{{ route('profile') }}">Profile</a></div>
            <div class="nav_links"><a href="{{ route('home') }}">Home</a></div>
            <div class="nav_links"><a href="{{ route('Student.create') }}">Add Courses</a></div>
            <div class="nav_links"><a href="{{ route('Student.index') }}">View Courses</a></div>
        @else
            <div class="nav_links"><a href="{{ route('login') }}">Login 🔓</a></div>
            <div class="nav_links"><a href="{{ route('register') }}">Register</a></div>
        @endauth
        <div class="nav_links"><a href="#">About</a></div>
        <div class="nav_links"><a href="#">Contact</a></div>
    </nav>
    <main>
        @yield('summary')
        @yield('add-form')
        @yield('login-form')
        @yield('register-form')
        @yield('view-courses')
        @yield('profile')
    </main>
    <footer>
        <p>&copy; 2023 M.Crowned. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
