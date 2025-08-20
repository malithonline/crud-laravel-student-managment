<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen">
  <!-- Navbar -->
  <div class="navbar bg-base-200 border-b border-base-300">
    <div class="container mx-auto px-4">
      <div class="navbar-start">
        <a class="text-xl font-medium" href="{{ route('students.index') }}">Student System</a>
      </div>
      
      <div class="navbar-end gap-2">
        @auth
          <div class="text-sm opacity-70">{{ auth()->user()->email }}</div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-ghost btn-sm" type="submit">Logout</button>
          </form>
        @endauth
        @guest
          <a class="btn btn-ghost btn-sm" href="{{ route('login') }}">Login</a>
        @endguest
        <a class="btn btn-primary btn-sm" href="{{ route('students.create') }}">Add Student</a>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto p-4 max-w-7xl">
    @if (session('success'))
      <div class="alert alert-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif
    
    @yield('content')
  </main>
</body>
</html>
