<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>802-GO: Profile</title>
    <link rel="icon" href="{{ asset('logo/802-GO-LOGO.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .modal-background-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
            opacity: 0.1;
            z-index: 1;
        }

        .modal-header {
            background-color: #11468F;
            color: white;
            padding: 15px;
            margin: -20px -20px 15px -20px;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .modal-content p,
        .modal-buttons {
            position: relative;
            z-index: 2;
        }

        .modal-buttons {
            margin-top: 20px;
        }

        .modal-button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .cancel-btn {
            background-color: #11468F;
            color: white;
        }

        .cancel-btn:hover {
            transform: scale(1.10);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-weight: bold;
        }

        .confirm-btn {
            background-color: #ff4444;
            color: white;
        }

        .confirm-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-weight: bold;
        }
    </style>
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
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="button" 
                    onclick="showLogoutModal()"
                    style="color: white; padding: 8px 16px; border-radius: 6px; background-color: #ff4444; transition: all 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#ff4444'; this.style.transform='scale(1.1)'" 
                    onmouseout="this.style.backgroundColor='#cc0000'; this.style.transform='scale(1)'">
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

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <img src="{{ asset('logo/802-GO-LOGO.png') }}" alt="Background Logo" class="modal-background-logo">
            <div class="modal-header">
                <h3>802-GO</h3>
            </div>
            <p>Are you sure you want to logout?</p>
            <div class="modal-buttons">
                <button class="modal-button confirm-btn" onclick="confirmLogout()">Logout</button>
                <button class="modal-button cancel-btn" onclick="closeLogoutModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('logoutModal');
        const logoutForm = document.getElementById('logout-form');

        function showLogoutModal() {
            modal.style.display = 'flex';
        }

        function closeLogoutModal() {
            modal.style.display = 'none';
        }

        function confirmLogout() {
            logoutForm.submit();
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeLogoutModal();
            }
        }
    </script>
</body>
</html>