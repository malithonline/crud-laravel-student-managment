@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="max-w-4xl mx-auto">
  <!-- Header -->
  <div class="mb-6">
    <div class="flex items-center gap-3 mb-2">
      <a href="{{ route('students.index') }}" class="btn btn-ghost btn-circle">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </a>
      <h1 class="text-3xl font-bold text-base-content">Add New Student</h1>
    </div>
    <p class="text-base-content opacity-70">Fill in the student information below</p>
  </div>

  <!-- Form Card -->
  <div class="card bg-base-100 border border-base-300">
    <div class="card-body">
      <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
        @csrf
        @include('students._form', ['student' => new \App\Models\Student])
        
        <!-- Form Actions -->
        <div class="divider"></div>
        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
          <a href="{{ route('students.index') }}" class="btn btn-ghost w-full sm:w-auto">
            Cancel
          </a>
          <button type="submit" class="btn btn-primary w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Student
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
