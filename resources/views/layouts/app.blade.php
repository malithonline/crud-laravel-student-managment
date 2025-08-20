<!doctype html>
<html lang="en" data-theme="clean">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>@yield('title', 'Student Management')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen flex flex-col">

  <!-- Top nav bar -->
  <div class="navbar bg-base-100 border-b border-base-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
      <div class="flex-1">
        <a href="/" class="text-xl font-bold text-primary">Student Manager</a>
      </div>
      <div class="flex-none">
        @guest
          <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @else
          <div class="flex items-center gap-3">
            <span class="text-sm text-base-content opacity-70">Welcome, Admin</span>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-outline btn-sm">Logout</button>
            </form>
          </div>
        @endguest
      </div>
    </div>
  </div>

  <!-- Main content area -->
  <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1">
    @if (session('success'))
      <div role="alert" class="alert alert-success mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if (session('error'))
      <div role="alert" class="alert alert-error mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
        </svg>
        <span>{{ session('error') }}</span>
      </div>
    @endif
    
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="border-t border-base-300 py-4 mt-auto">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <p class="text-center text-sm text-base-content opacity-50">Student Management System v1.0</p>
    </div>
  </footer>

</body>
</html>
