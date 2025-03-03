<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* General Styles */
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: 'Figtree', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            position: relative;
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;  /* Changed from height to min-height */
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .brand img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #e3e3e3;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        /* Add these new styles */
        .logout-container {
            margin-top: auto;  /* This pushes the container to the bottom */
            width: 100%;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin-top: 20px;  /* Add some space above the logout button */
        }

        .logout-btn:hover {
            background-color: #ff4444 !important;
            color: white;
        }

        .logout-btn i {
            margin-right: 10px;
        }
    </style>

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <a><img src="{{ asset('logo/802-GO-LOGO.png') }}" alt="Logo"> 802-GO Admin</a>
        </div>
        <a href="#"><i class="fas fa-users"></i> Barangay Residents</a>
        <a href="{{ route('admin.news.index') }}"><i class="fas fa-newspaper"></i> Manage News</a>
        <a href="#"><i class="fas fa-file-alt"></i> Document Approval</a>
        
        <div class="logout-container" style="justify-content: center; align-items: center;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" 
                   class="logout-btn"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
