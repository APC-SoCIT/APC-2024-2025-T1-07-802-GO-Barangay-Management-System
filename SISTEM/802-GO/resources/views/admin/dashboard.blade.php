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

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            width: 280px;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            color: #1e40af;
        }

        .brand img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            margin-right: 12px;
            object-fit: contain;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #4b5563;
            font-size: 1rem;
            padding: 0.875rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .sidebar a:hover {
            background-color: #f3f4f6;
            color: #1e40af;
        }

        .sidebar a.active {
            background-color: #e0e7ff;
            color: #1e40af;
            font-weight: 600;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: all 0.3s ease;
        }

        /* Logout container */
        .logout-container {
            margin-top: auto;
            width: 100%;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        .logout-btn {
            width: 100%;
            padding: 0.875rem 1rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #4b5563;
            font-size: 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .logout-btn i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        /* Page Header */
        .page-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .page-description {
            color: #6b7280;
        }

        /* Cards */
        .card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .card-subtitle {
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Forms */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
            color: #1f2937;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #3b82f6;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .form-control-file {
            display: block;
            width: 100%;
        }

        .form-control-static {
            padding: 0.5rem 0;
            margin-bottom: 0;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .form-text {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.5rem;
            margin-left: -0.5rem;
        }

        .form-row > .col {
            padding-right: 0.5rem;
            padding-left: 0.5rem;
            flex: 1;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.375rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
        }

        .btn:focus, .btn:hover {
            text-decoration: none;
        }

        .btn-primary {
            color: #ffffff;
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .btn-secondary {
            color: #ffffff;
            background-color: #6b7280;
            border-color: #6b7280;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            border-color: #4b5563;
        }

        .btn-danger {
            color: #ffffff;
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            border-color: #dc2626;
        }

        .btn-success {
            color: #ffffff;
            background-color: #10b981;
            border-color: #10b981;
        }

        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.25rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.5rem;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #1f2937;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #e5e7eb;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e5e7eb;
            background-color: #f9fafb;
            color: #4b5563;
            font-weight: 600;
            text-align: left;
        }

        .table tbody + tbody {
            border-top: 2px solid #e5e7eb;
        }

        .table-bordered {
            border: 1px solid #e5e7eb;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #e5e7eb;
        }

        .table-hover tbody tr:hover {
            background-color: #f3f4f6;
        }

        /* Alerts */
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.375rem;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }

        .alert-warning {
            color: #664d03;
            background-color: #fff3cd;
            border-color: #ffecb5;
        }

        .alert-info {
            color: #055160;
            background-color: #cff4fc;
            border-color: #b6effb;
        }

        .alert-dismissible {
            padding-right: 4rem;
        }

        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        /* Utilities */
        .d-flex {
            display: flex;
        }

        .flex-column {
            flex-direction: column;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .ml-1 {
            margin-left: 0.25rem;
        }

        .ml-2 {
            margin-left: 0.5rem;
        }

        .mr-1 {
            margin-right: 0.25rem;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-3 {
            padding: 1rem;
        }

        .p-4 {
            padding: 1.5rem;
        }

        .text-primary {
            color: #3b82f6;
        }

        .text-secondary {
            color: #6b7280;
        }

        .text-success {
            color: #10b981;
        }

        .text-danger {
            color: #ef4444;
        }

        .text-warning {
            color: #f59e0b;
        }

        .text-info {
            color: #3b82f6;
        }

        .bg-light {
            background-color: #f9fafb;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .rounded-circle {
            border-radius: 50%;
        }

        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            max-width: 400px; /* Changed from 500px to 400px */
            padding: 0 1rem; /* Added padding for smaller screens */
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #ffffff;
            border-radius: 0.5rem;
            outline: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            min-height: 250px; /* Reduced height */
        }

        .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('logo/802-GO-LOGO.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100px; /* Smaller logo */
            opacity: 0.1; /* Very subtle */
            z-index: 0;
        }

        .modal-header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border-bottom: none; /* Removed border */
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            background-color: #1e40af;
            z-index: 1; /* Ensure header stays above the background */
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1.5rem 1rem;
            text-align: center;
            z-index: 1;
            background-color: transparent;
        }

        .modal-footer {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border-top: none;
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
            gap: 1rem;
            z-index: 1;
            background-color: transparent;
        }

        /* Make modal content readable over the background image */
        .modal-body p {
            position: relative;
            z-index: 1;
            font-size: 1.1rem; /* Added larger font size */
            font-weight: 500;
            text-shadow: 0 0 10px #ffffff, 0 0 10px #ffffff, 0 0 10px #ffffff;  /* Enhanced glow effect */
        }

        /* Remove the header logo styles */
        .modal-header::before {
            display: none;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 1.5rem; /* Increased from 1.25rem */
            font-weight: 600;
            color: #ffffff; /* Added white text color */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Added text shadow */
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
            text-align: center; /* Add this line */
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
            border-top: none; /* Removed border */
            border-bottom-right-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
            gap: 1rem; /* Add space between buttons */
        }

        .modal-footer > * {
            margin: 0; /* Remove default margins */
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            transition: all 0.2s;
        }

        .action-btn-view {
            color: #3b82f6;
        }

        .action-btn-view:hover {
            background-color: #dbeafe;
        }

        .action-btn-edit {
            color: #f59e0b;
        }

        .action-btn-edit:hover {
            background-color: #fef3c7;
        }

        .action-btn-delete {
            color: #ef4444;
        }

        .action-btn-delete:hover {
            background-color: #fee2e2;
        }

        /* Back button */
        .back-link {
            display: inline-flex;
            align-items: center;
            color: #3b82f6;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Search form */
        .search-form {
            margin-bottom: 1.5rem;
        }

        .search-input-group {
            position: relative;
            display: flex;
        }

        .search-input {
            padding-left: 2.5rem;
            flex: 1;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .search-button {
            margin-left: 0.5rem;
        }

        /* Empty state */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .empty-state-description {
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 1.5rem 0.75rem;
            }
            
            .sidebar .brand span {
                display: none;
            }
            
            .sidebar a span {
                display: none;
            }
            
            .sidebar a i {
                margin-right: 0;
                font-size: 1.25rem;
            }
            
            .main-content {
                margin-left: 80px;
                width: calc(100% - 80px);
            }
            
            .logout-btn span {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
            
            .form-row > .col {
                margin-bottom: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-header .btn {
                margin-top: 1rem;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                width: 0;
                padding: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .menu-toggle {
                display: block;
            }
        }

        /* Toggle button for mobile */
        .menu-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 20;
            background: #ffffff;
            border-radius: 0.5rem;
            padding: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: none;
        }

        /* When sidebar is open on mobile */
        .sidebar-open .sidebar {
            width: 280px;
            padding: 1.5rem;
        }
        
        .sidebar-open .sidebar .brand span,
        .sidebar-open .sidebar a span,
        .sidebar-open .logout-btn span {
            display: inline;
        }
        
        .sidebar-open .sidebar a i {
            margin-right: 12px;
        }
        
        .sidebar-open .main-content {
            margin-left: 280px;
        }

        /* Alert styles */
        [role="alert"] {
            transition: opacity 1s ease;
        }

        /* Grid system */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12,
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12,
        .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12,
        .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }

        .col-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
        .col-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
        .col-3 { flex: 0 0 25%; max-width: 25%; }
        .col-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
        .col-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
        .col-6 { flex: 0 0 50%; max-width: 50%; }
        .col-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
        .col-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
        .col-9 { flex: 0 0 75%; max-width: 75%; }
        .col-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
        .col-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
        .col-12 { flex: 0 0 100%; max-width: 100%; }

        @media (min-width: 576px) {
            .col-sm-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
            .col-sm-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
            .col-sm-3 { flex: 0 0 25%; max-width: 25%; }
            .col-sm-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-sm-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
            .col-sm-6 { flex: 0 0 50%; max-width: 50%; }
            .col-sm-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
            .col-sm-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
            .col-sm-9 { flex: 0 0 75%; max-width: 75%; }
            .col-sm-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
            .col-sm-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
            .col-sm-12 { flex: 0 0 100%; max-width: 100%; }
        }

        @media (min-width: 768px) {
            .col-md-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
            .col-md-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
            .col-md-3 { flex: 0 0 25%; max-width: 25%; }
            .col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-md-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
            .col-md-6 { flex: 0 0 50%; max-width: 50%; }
            .col-md-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
            .col-md-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
            .col-md-9 { flex: 0 0 75%; max-width: 75%; }
            .col-md-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
            .col-md-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
            .col-md-12 { flex: 0 0 100%; max-width: 100%; }
        }

        @media (min-width: 992px) {
            .col-lg-1 { flex: 0 0 8.333333%; max-width: 8.333333%; }
            .col-lg-2 { flex: 0 0 16.666667%; max-width: 16.666667%; }
            .col-lg-3 { flex: 0 0 25%; max-width: 25%; }
            .col-lg-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-lg-5 { flex: 0 0 41.666667%; max-width: 41.666667%; }
            .col-lg-6 { flex: 0 0 50%; max-width: 50%; }
            .col-lg-7 { flex: 0 0 58.333333%; max-width: 58.333333%; }
            .col-lg-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
            .col-lg-9 { flex: 0 0 75%; max-width: 75%; }
            .col-lg-10 { flex: 0 0 83.333333%; max-width: 83.333333%; }
            .col-lg-11 { flex: 0 0 91.666667%; max-width: 91.666667%; }
            .col-lg-12 { flex: 0 0 100%; max-width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <img src="{{ asset('logo/802-GO-LOGO.png') }}" alt="Logo">
            <span>802-GO Admin</span>
        </div>
        
        <div class="sidebar-nav">
            <a href="{{ route('admin.residents.index') }}" class="{{ request()->routeIs('admin.residents.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Barangay Residents</span>
            </a>
            <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Manage News</span>
            </a>
            <a href="#" class="{{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Document Approval</span>
            </a>
        </div>
        
        <div class="logout-container">
            <a href="#" class="logout-btn" onclick="showLogoutModal()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Logout Confirmation Modal -->
    <div class="modal" id="logoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">802-GO Admin</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeLogoutModal()">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-open');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 640 && 
                !document.getElementById('sidebar').contains(event.target) && 
                !document.getElementById('menuToggle').contains(event.target) &&
                document.body.classList.contains('sidebar-open')) {
                document.body.classList.remove('sidebar-open');
            }
        });

        // Logout modal functions
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('logoutModal');
            if (event.target === modal) {
                closeLogoutModal();
            }
        }

        // Auto-hide alert messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 1s';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 1000);
                }, 5000);
            });
        });
    </script>
</body>
</html>

