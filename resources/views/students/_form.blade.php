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

  <!-- Contact Number -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Contact Number</span>
    </label>
    <input name="contact_number" value="{{ old('contact_number', $student->contact_number ?? '') }}" 
           class="input input-bordered" 
           placeholder="Enter phone number">
  </div>

  <!-- Date of Birth -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Date of Birth</span>
    </label>
    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}" 
           class="input input-bordered">
  </div>

  <!-- Gender -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Gender</span>
    </label>
    <select name="gender" class="select select-bordered">
      <option value="">Select Gender</option>
      <option value="male" @selected(old('gender', $student->gender ?? '')==='male')>Male</option>
      <option value="female" @selected(old('gender', $student->gender ?? '')==='female')>Female</option>
    </select>
  </div>

  <!-- Type -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Program Type</span>
    </label>
    <select name="type" class="select select-bordered">
      <option value="">Select Type</option>
      <option value="IT" @selected(old('type', $student->type ?? '')==='IT')>Information Technology</option>
      <option value="Business" @selected(old('type', $student->type ?? '')==='Business')>Business</option>
      <option value="Arts" @selected(old('type', $student->type ?? '')==='Arts')>Arts</option>
    </select>
  </div>

  <!-- Status -->
  <div class="form-control">
    <label class="label">
      <span class="label-text font-medium">Status</span>
    </label>
    <select name="status" class="select select-bordered">
      <option value="1" @selected(old('status', ($student->status ?? true) ? '1':'0')==='1')>Active</option>
      <option value="0" @selected(old('status', ($student->status ?? true) ? '1':'0')==='0')>Inactive</option>
    </select>
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
