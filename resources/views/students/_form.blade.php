@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <!-- First Name -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">First Name <span class="text-error">*</span></span>
    </label>
    <input name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" 
           class="input input-bordered @error('first_name') input-error @enderror" 
           placeholder="Enter first name" required>
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
    <input name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" 
           class="input input-bordered @error('last_name') input-error @enderror" 
           placeholder="Enter last name" required>
    @error('last_name')
      <label class="label">
        <span class="label-text-alt text-error">{{ $message }}</span>
      </label>
    @enderror
  </div>

  <!-- Email -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Email Address <span class="text-error">*</span></span>
    </label>
    <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" 
           class="input input-bordered @error('email') input-error @enderror" 
           placeholder="student@example.com" required>
    @error('email')
      <label class="label">
        <span class="label-text-alt text-error">{{ $message }}</span>
      </label>
    @enderror
  </div>
</div>

<!-- Description (Full Width) -->
<div class="form-control mt-4">
  <label class="label">
    <span class="label-text font-medium">Description</span>
  </label>
  <textarea name="description" rows="3" class="textarea textarea-bordered" 
            placeholder="Additional notes about the student...">{{ old('description', $student->description ?? '') }}</textarea>
</div>
