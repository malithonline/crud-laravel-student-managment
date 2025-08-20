@csrf
<div class="space-y-6">
  <!-- Basic Information -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- First Name -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">First Name <span class="text-error">*</span></span>
      </label>
      <input type="text" 
             name="first_name" 
             value="{{ old('first_name', $student->first_name ?? '') }}" 
             class="input input-bordered @error('first_name') input-error @enderror" 
             placeholder="Enter first name" 
             required>
      @error('first_name')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>

    <!-- Last Name -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">Last Name <span class="text-error">*</span></span>
      </label>
      <input type="text" 
             name="last_name" 
             value="{{ old('last_name', $student->last_name ?? '') }}" 
             class="input input-bordered @error('last_name') input-error @enderror" 
             placeholder="Enter last name" 
             required>
      @error('last_name')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>
  </div>

  <!-- Contact Information -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Email -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">Email Address <span class="text-error">*</span></span>
      </label>
      <input type="email" 
             name="email" 
             value="{{ old('email', $student->email ?? '') }}" 
             class="input input-bordered @error('email') input-error @enderror" 
             placeholder="student@example.com" 
             required>
      @error('email')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>

    <!-- Contact Number -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">Contact Number</span>
      </label>
      <input type="tel" 
             name="contact_number" 
             value="{{ old('contact_number', $student->contact_number ?? '') }}" 
             class="input input-bordered @error('contact_number') input-error @enderror" 
             placeholder="+1234567890">
      @error('contact_number')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>
  </div>

  <!-- Personal Information -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Date of Birth -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">Date of Birth</span>
      </label>
      <input type="date" 
             name="date_of_birth" 
             value="{{ old('date_of_birth', $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}" 
             class="input input-bordered @error('date_of_birth') input-error @enderror">
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
              class="select select-bordered @error('gender') select-error @enderror">
        <option value="">Select gender</option>
        <option value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
      </select>
      @error('gender')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>

    <!-- Course Type -->
    <div class="form-control">
      <label class="label">
        <span class="label-text font-medium">Course</span>
      </label>
      <select name="type" 
              class="select select-bordered @error('type') select-error @enderror">
        <option value="">Select course</option>
        <option value="IT" {{ old('type', $student->type ?? '') == 'IT' ? 'selected' : '' }}>IT</option>
        <option value="Business" {{ old('type', $student->type ?? '') == 'Business' ? 'selected' : '' }}>Business</option>
        <option value="Arts" {{ old('type', $student->type ?? '') == 'Arts' ? 'selected' : '' }}>Arts</option>
      </select>
      @error('type')
        <label class="label">
          <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
      @enderror
    </div>
  </div>

  <!-- Status -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Status</span>
    </label>
    <div class="flex items-center gap-4">
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="radio" 
               name="status" 
               value="1" 
               class="radio radio-primary" 
               {{ old('status', $student->status ?? '1') == '1' ? 'checked' : '' }}>
        <span class="label-text">Active</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="radio" 
               name="status" 
               value="0" 
               class="radio radio-primary" 
               {{ old('status', $student->status ?? '1') == '0' ? 'checked' : '' }}>
        <span class="label-text">Inactive</span>
      </label>
    </div>
    @error('status')
      <label class="label">
        <span class="label-text-alt text-error">{{ $message }}</span>
      </label>
    @enderror
  </div>

  <!-- Description -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Description</span>
    </label>
    <textarea name="description" 
              rows="4" 
              class="textarea textarea-bordered @error('description') textarea-error @enderror" 
              placeholder="Additional notes about the student...">{{ old('description', $student->description ?? '') }}</textarea>
    @error('description')
      <label class="label">
        <span class="label-text-alt text-error">{{ $message }}</span>
      </label>
    @enderror
  </div>
</div>
