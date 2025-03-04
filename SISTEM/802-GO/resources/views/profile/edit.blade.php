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

        /* Collapsible Section Styles */
        .collapse-button {
            @apply w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-700 
                   hover:bg-gray-100 dark:hover:bg-gray-600 
                   transition-all duration-300 ease-in-out;
        }

        .section-icon {
            @apply w-5 h-5 transition-all duration-300;
        }

        /* Profile icon hover effect */
        .section-icon.text-blue-500:hover {
            @apply text-blue-400;
            filter: drop-shadow(0 0 4px rgba(59, 130, 246, 0.5));
        }

        /* Password icon hover effect */
        .section-icon.text-yellow-500:hover {
            @apply text-yellow-400;
            filter: drop-shadow(0 0 4px rgba(234, 179, 8, 0.5));
        }

        /* Delete icon hover effect */
        .section-icon.text-red-500:hover {
            @apply text-red-400;
            filter: drop-shadow(0 0 4px rgba(239, 68, 68, 0.5));
        }

        .chevron-icon {
            width: 12px !important;
            height: 12px !important;
            min-width: 12px !important;
            min-height: 12px !important;
            @apply text-gray-500 dark:text-gray-400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
            position: relative;
            top: 0;
        }

        [x-cloak] { display: none !important; }

        /* Chevron states */
        .chevron-icon.expanded {
            transform: rotate(180deg);
            top: 2px;
        }
        
        .chevron-icon.collapsed {
            transform: rotate(0deg);
            top: -2px;
        }

        /* Updated Section Container Base Styles */
        .section-container {
            @apply bg-white dark:bg-gray-800 shadow-md 
                   transition-all duration-300;
            border: 2px solid rgba(0, 0, 0, 0.2);
            border-radius: 24px; /* Increased border radius */
            position: relative;
            isolation: isolate;
            padding: 4px; /* Added padding around entire container */
        }

        /* Profile Section Hover Styles */
        .section-container.profile-section:hover {
            border-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.15),
                       0 0 0 2px rgba(0, 0, 0, 0.2),
                       0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        /* Password Section Hover Styles */
        .section-container.password-section:hover {
            border-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 20px rgba(234, 179, 8, 0.15),
                       0 0 0 2px rgba(0, 0, 0, 0.2),
                       0 0 0 4px rgba(234, 179, 8, 0.1);
        }

        /* Delete Section Hover Styles */
        .section-container.delete-section:hover {
            border-color: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.15),
                       0 0 0 2px rgba(0, 0, 0, 0.2),
                       0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        /* Update collapse button styles to match new rounded corners */
        .collapse-button {
            @apply w-full bg-gray-50 dark:bg-gray-700 
                   transition-all duration-300 ease-in-out;
            border-radius: 20px; /* Slightly reduced to nest inside container */
            padding: 16px 24px; /* Increased padding */
        }

        /* Adjust spacing for button content */
        .collapse-button .flex.items-center.space-x-2 {
            @apply space-x-4; /* Increased space between icon and text */
        }

        /* Update chevron positioning */
        .chevron-icon {
            margin-right: 8px; /* Add some space from the right edge */
            width: 12px !important;
            height: 12px !important;
            min-width: 12px !important;
            min-height: 12px !important;
            @apply text-gray-500 dark:text-gray-400;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
            position: relative;
            top: 0;
        }

        /* Update content border radius for smoother appearance */
        .collapse-content {
            @apply p-8 border-t dark:border-gray-600; /* Increased padding */
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin: 4px; /* Added margin to match container padding */
        }
    </style>
</head>


    <!-- Custom Full-Width Header -->
    <header class="bg-[#11468F] text-white py-4 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Empty div with same width as logout button to maintain balance -->
            <div class="w-[88px]"></div>
            
            <!-- Center Logo -->
            <div class="flex-1 flex justify-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('logo/802-GO-LOGO.png') }}" 
                        alt="Logo" 
                        style="height: 80px; width: auto; cursor: pointer;">
                </a>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="button" 
                    onclick="showLogoutModal()"
                    style="color: white; padding: 8px 16px; border-radius: 6px; background-color: #cc0000; transition: all 0.3s ease;"
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
            <!-- Profile Information Section -->
            <div class="section-container profile-section">
                <div x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="collapse-button flex justify-between items-center w-full">
                        <div class="flex items-center space-x-4">
                            <svg class="section-icon text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h2 class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Profile Information') }}
                            </h2>
                        </div>
                        <svg :class="{'expanded': open, 'collapsed': !open}" 
                             class="chevron-icon" 
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2.5" 
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="collapse-content p-8 border-t dark:border-gray-600">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="section-container password-section">
                <div x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="collapse-button flex justify-between items-center w-full">
                        <div class="flex items-center space-x-4">
                            <svg class="section-icon text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            <h2 class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Password') }}
                            </h2>
                        </div>
                        <svg :class="{'expanded': open, 'collapsed': !open}" 
                             class="chevron-icon" 
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2.5" 
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="collapse-content p-8 border-t dark:border-gray-600">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="section-container delete-section">
                <div x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="collapse-button flex justify-between items-center w-full">
                        <div class="flex items-center space-x-4">
                            <svg class="section-icon text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <h2 class="text-base font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Delete Account') }}
                            </h2>
                        </div>
                        <svg :class="{'expanded': open, 'collapsed': !open}" 
                             class="chevron-icon" 
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2.5" 
                                  d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-y-0"
                         x-transition:leave-end="opacity-0 transform -translate-y-2"
                         class="collapse-content p-8 border-t dark:border-gray-600">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Back to Dashboard Button -->
            <div class="flex justify-center mt-8">
                <a href="{{ route('dashboard') }}"
                   id="dashboardButton"
                   style="background-color: #22C55E; color: white; padding: 12px 24px; border-radius: 8px; 
                          display: inline-flex; align-items: center; font-weight: 600; text-decoration: none;
                          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         style="width: 20px; height: 20px; margin-right: 8px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span style="font-size: 16px;">Back to Dashboard</span>
                </a>
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

        // Add hover effects for dashboard button
        const dashboardButton = document.getElementById('dashboardButton');
        
        dashboardButton.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.backgroundColor = '#16A34A';
            this.style.boxShadow = '0 8px 15px rgba(0, 0, 0, 0.2)';
        });
        
        dashboardButton.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.backgroundColor = '#22C55E';
            this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
    </script>
</body>
</html>