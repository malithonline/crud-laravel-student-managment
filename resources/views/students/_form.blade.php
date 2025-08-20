@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">First Name</label>
    <input name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" class="form-control" required>
    @error('first_name')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">Last Name</label>
    <input name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" class="form-control" required>
    @error('last_name')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" class="form-control" required>
    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">Contact Number</label>
    <input name="contact_number" value="{{ old('contact_number', $student->contact_number ?? '') }}" class="form-control">
  </div>
  <div class="col-md-4">
    <label class="form-label">Date of Birth</label>
    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}" class="form-control">
  </div>
  <div class="col-md-4">
    <label class="form-label">Gender</label>
    <select name="gender" class="form-select">
      <option value="">Select</option>
      <option value="male" @selected(old('gender', $student->gender ?? '')==='male')>Male</option>
      <option value="female" @selected(old('gender', $student->gender ?? '')==='female')>Female</option>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Type</label>
    <select name="type" class="form-select">
      <option value="">Select</option>
      <option value="IT" @selected(old('type', $student->type ?? '')==='IT')>IT</option>
      <option value="Business" @selected(old('type', $student->type ?? '')==='Business')>Business</option>
      <option value="Arts" @selected(old('type', $student->type ?? '')==='Arts')>Arts</option>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
      <option value="1" @selected(old('status', ($student->status ?? true) ? '1':'0')==='1')>Active</option>
      <option value="0" @selected(old('status', ($student->status ?? true) ? '1':'0')==='0')>Inactive</option>
    </select>
  </div>
  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $student->description ?? '') }}</textarea>
  </div>
</div>
