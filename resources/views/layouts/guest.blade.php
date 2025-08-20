<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Student Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Brand -->
        <div class="text-center mb-8">
            <a href="/" class="text-3xl font-bold text-primary">Student Manager</a>
            <p class="text-base-content opacity-70 mt-2">@yield('subtitle', 'Create your account')</p>
        </div>

        <!-- Content Card -->
        <div class="card bg-base-100 border border-base-300">
            <div class="card-body">
                @yield('content')
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-6 text-sm text-base-content opacity-60">
            <p>Student Management System</p>
        </div>
    </div>
</body>
</html>
