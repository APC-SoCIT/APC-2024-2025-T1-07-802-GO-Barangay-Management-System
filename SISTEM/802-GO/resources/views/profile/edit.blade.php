<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>802-GO: Profile</title>
    <link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Include Tailwind CSS if needed -->
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <!-- Custom Full-Width Header -->
    <header class="bg-[#11468F] text-white py-4 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo on the Left -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo/802-GO-LOGO.png') }}" 
                        alt="Logo" 
                        style="height: 80px; width: auto; cursor: pointer;">
                </a>
            </div>

            <!-- Logout Button on the Right -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    style="color: #11468F; padding: 8px 16px; border-radius: 6px; background-color: white; transition: all 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#ff4444'; this.style.color='white'; this.style.fontWeight='bold'" 
                    onmouseout="this.style.backgroundColor='white'; this.style.color='#11468F'; this.style.fontWeight='normal'">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Profile Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

</body>
</html>