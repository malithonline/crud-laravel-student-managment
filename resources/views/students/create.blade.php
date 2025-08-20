@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  
  <!-- Student form -->
  <div class="border border-base-300 p-6">
    <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
      @csrf
      
      <!-- Basic info section -->
      <div>
        <h3 class="text-lg font-medium text-base-content mb-4">Basic Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- First name -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">First Name *</span>
            </label>
            <input type="text" 
                   name="first_name" 
                   value="{{ old('first_name') }}" 
                   class="input input-bordered w-full @error('first_name') input-error @enderror" 
                   placeholder="Enter first name" 
                   required>
            @error('first_name')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Last name -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Last Name *</span>
            </label>
            <input type="text" 
                   name="last_name" 
                   value="{{ old('last_name') }}" 
                   class="input input-bordered w-full @error('last_name') input-error @enderror" 
                   placeholder="Enter last name" 
                   required>
            @error('last_name')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
      </div>

      <!-- Contact info section -->
      <div>
        <h3 class="text-lg font-medium text-base-content mb-4">Contact Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Email -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Email *</span>
            </label>
            <input type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   class="input input-bordered w-full @error('email') input-error @enderror" 
                   placeholder="student@example.com" 
                   required>
            @error('email')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Contact number -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Contact Number</span>
            </label>
            <input type="tel" 
                   name="contact_number" 
                   value="{{ old('contact_number') }}" 
                   class="input input-bordered w-full @error('contact_number') input-error @enderror" 
                   placeholder="Enter contact number">
            @error('contact_number')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
      </div>

      <!-- Personal info section -->
      <div>
        <h3 class="text-lg font-medium text-base-content mb-4">Personal Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Date of birth -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Date of Birth</span>
            </label>
            <input type="date" 
                   name="date_of_birth" 
                   value="{{ old('date_of_birth') }}" 
                   class="input input-bordered w-full @error('date_of_birth') input-error @enderror"
                   placeholder="YYYY-MM-DD">
            @error('date_of_birth')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Gender -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Gender</span>
            </label>
            <select name="gender" 
                    class="select select-bordered w-full @error('gender') select-error @enderror">
              <option value="">Select gender</option>
              <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>

          <!-- Course -->
          <div class="form-control">
            <label class="label">
              <span class="label-text font-medium">Course</span>
            </label>
            <select name="type" 
                    class="select select-bordered w-full @error('type') select-error @enderror">
              <option value="">Select course</option>
              <option value="IT" {{ old('type') == 'IT' ? 'selected' : '' }}>IT</option>
              <option value="Business" {{ old('type') == 'Business' ? 'selected' : '' }}>Business</option>
              <option value="Arts" {{ old('type') == 'Arts' ? 'selected' : '' }}>Arts</option>
            </select>
            @error('type')
              <label class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
              </label>
            @enderror
          </div>
        </div>
      </div>

      <!-- Status section -->
      <div>
        <h3 class="text-lg font-medium text-base-content mb-4">Status</h3>
        <div class="flex items-center gap-6">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" 
                   name="status" 
                   value="1" 
                   class="radio radio-primary" 
                   {{ old('status', '1') == '1' ? 'checked' : '' }}>
            <span class="label-text">Active</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" 
                   name="status" 
                   value="0" 
                   class="radio radio-primary" 
                   {{ old('status', '1') == '0' ? 'checked' : '' }}>
            <span class="label-text">Inactive</span>
          </label>
        </div>
        @error('status')
          <label class="label">
            <span class="label-text-alt text-error">{{ $message }}</span>
          </label>
        @enderror
      </div>

      <!-- Form actions -->
      <div class="border-t border-base-300 pt-6">
        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
          <a href="{{ route('students.index') }}" class="btn btn-outline">
            Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            Add Student
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
