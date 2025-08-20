<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Student Management')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-100 text-base-content min-h-screen">

  <div class="navbar bg-base-200 border-b border-base-300">
    <div class="container mx-auto px-4">
      <div class="flex-1">
        <a href="/" class="text-xl font-bold">StudentApp</a>
      </div>
      <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
          <li><a href="{{ route('students.index') }}">Students</a></li>
          @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          @else
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                  Logout
                </a>
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto p-4 mt-4">
    @if (session('success'))
      <div role="alert" class="alert alert-success mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif
    
    @yield('content')
  </main>

</body>
</html>
