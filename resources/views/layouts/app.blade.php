<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body { background: #f8f9fa; }
    .navbar { border-bottom: 1px solid #dee2e6; }
    .card { border-radius: 0; }
    .btn, .form-control, .form-select { border-radius: 0; }
  </style>
</head>
<body>
<nav class="navbar bg-white">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand m-0" href="{{ route('students.index') }}">Students</a>
    <div class="d-flex align-items-center gap-2">
      @auth
        <span class="text-muted small">{{ auth()->user()->email }}</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-outline-secondary btn-sm" type="submit">Logout</button>
        </form>
      @endauth
      @guest
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('login') }}">Login</a>
      @endguest
      <a class="btn btn-outline-secondary" href="{{ route('students.create') }}">New</a>
    </div>
  </div>
</nav>
<main class="container py-4">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</main>
</body>
</html>
