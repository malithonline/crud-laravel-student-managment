<!doctype html>
<html lang="en" data-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Student System</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-sm">
    <!-- Logo/Brand -->
    <div class="text-center mb-8">
      <div class="text-3xl font-bold text-primary mb-2">Student System</div>
      <p class="text-base-content opacity-70">Sign in to your account</p>
    </div>

    <!-- Login Card -->
    <div class="card bg-base-100 border border-base-300 shadow-lg">
      <div class="card-body p-6">
        <h1 class="text-xl font-medium text-center mb-6">Admin Login</h1>
        
        @if ($errors->any())
          <div class="alert alert-error mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <div>
              <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
          @csrf
          
          <!-- Email Field -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Email Address</span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="input input-bordered @error('email') input-error @enderror" 
                   placeholder="admin@example.com" required autofocus>
          </div>

          <!-- Password Field -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Password</span>
            </label>
            <input type="password" name="password" 
                   class="input input-bordered @error('password') input-error @enderror" 
                   placeholder="Enter your password" required>
          </div>

          <!-- Remember Me -->
          <div class="form-control">
            <label class="label cursor-pointer justify-start gap-2">
              <input type="checkbox" name="remember" value="1" class="checkbox checkbox-sm">
              <span class="label-text">Remember me</span>
            </label>
          </div>

          <!-- Submit Button -->
          <button class="btn btn-primary w-full" type="submit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Sign In
          </button>
        </form>
      </div>
    </div>

    <!-- Footer Info -->
    <div class="text-center mt-6 text-sm opacity-70">
      <p>Use admin credentials to access the system</p>
    </div>
  </div>
</body>
</html>
