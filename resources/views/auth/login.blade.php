<!doctype html>
<html lang="en" data-theme="clean">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>Login - Student Manager</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-base-100 min-h-screen">
  <!-- Main container for login page -->
  <div class="min-h-screen flex">
    
    <!-- Left side - Brand info (hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 bg-primary">
      <div class="flex flex-col justify-center px-12 py-24 w-full">
        <div class="text-primary-content">
          <h1 class="text-4xl font-bold mb-6">Student Manager</h1>
          <p class="text-xl mb-8 opacity-90">Manage student data with ease and efficiency</p>
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <div class="w-2 h-2 bg-primary-content"></div>
              <span class="text-lg">Create and edit student records</span>
            </div>
            <div class="flex items-center gap-3">
              <div class="w-2 h-2 bg-primary-content"></div>
              <span class="text-lg">Track student information</span>
            </div>
            <div class="flex items-center gap-3">
              <div class="w-2 h-2 bg-primary-content"></div>
              <span class="text-lg">Generate reports and exports</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right side - Login form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12">
      <div class="w-full max-w-md">
        
        <!-- Mobile brand header -->
        <div class="text-center mb-8 lg:hidden">
          <h1 class="text-2xl font-bold text-primary mb-2">Student Manager</h1>
          <p class="text-base-content opacity-70">Sign in to continue</p>
        </div>

        <!-- Desktop form header -->
        <div class="hidden lg:block mb-8">
          <h2 class="text-2xl font-bold text-base-content mb-2">Welcome back</h2>
          <p class="text-base-content opacity-70">Please sign in to your account</p>
        </div>

        <!-- Error messages -->
        @if ($errors->any())
          <div role="alert" class="alert alert-error mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <div>
              @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
              @endforeach
            </div>
          </div>
        @endif

        <!-- Login form -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
          @csrf
          
          <!-- Email input -->
          <div class="form-control">
            <label class="label">
              <span class="label-text text-base-content font-medium">Email</span>
            </label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="input input-bordered w-full @error('email') input-error @enderror" 
                   placeholder="Enter your email"
                   required 
                   autofocus>
            @error('email')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Password input -->
          <div class="form-control">
            <label class="label">
              <span class="label-text text-base-content font-medium">Password</span>
            </label>
            <input type="password" 
                   name="password" 
                   class="input input-bordered w-full @error('password') input-error @enderror" 
                   placeholder="Enter your password"
                   required>
            @error('password')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Remember me checkbox -->
          <div class="form-control">
            <label class="label cursor-pointer justify-start gap-3">
              <input type="checkbox" name="remember" value="1" class="checkbox checkbox-sm">
              <span class="label-text">Keep me signed in</span>
            </label>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary w-full">
            Sign In
          </button>
        </form>

        <!-- Demo credentials info -->
        <div class="mt-8 p-4 bg-base-200">
          <p class="text-sm text-base-content opacity-70 text-center mb-2">Demo Credentials</p>
          <div class="text-xs text-base-content space-y-1">
            <div class="flex justify-between">
              <span>Email:</span>
              <span class="font-mono">malith@mail.com</span>
            </div>
            <div class="flex justify-between">
              <span>Password:</span>
              <span class="font-mono">malith1234</span>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
          <p class="text-xs text-base-content opacity-50">Student Management System v1.0</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
