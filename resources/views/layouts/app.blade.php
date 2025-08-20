<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>@yield('title', 'Student Management')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen">

  <!-- Top Navigation -->
  <div class="navbar bg-base-200 border-b border-base-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex-1">
        <a href="/" class="text-xl font-bold text-primary">Student Manager</a>
      </div>
      <div class="flex-none">
        <ul class="menu menu-horizontal p-0 gap-2">
          <li><a href="{{ route('students.index') }}" class="btn btn-ghost">Students</a></li>
          @guest
            <li><a href="{{ route('login') }}" class="btn btn-ghost">Login</a></li>
            <li><a href="{{ route('register') }}" class="btn btn-outline btn-primary">Register</a></li>
          @else
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost">Logout</button>
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    @if (session('success'))
      <div role="alert" class="alert alert-success mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if (session('error'))
      <div role="alert" class="alert alert-error mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('error') }}</span>
      </div>
    @endif
    
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer footer-center p-6 bg-base-200 border-t border-base-300 mt-auto">
    <div>
      <p class="text-base-content">Student Management System - Built with Laravel</p>
    </div>
  </footer>

</body>
</html>
