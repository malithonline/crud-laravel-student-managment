@extends('layouts.app')

@section('title', 'Edit Student')

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
      <div>
        <h1 class="text-3xl font-bold text-base-content">Edit Student</h1>
        <p class="text-base-content opacity-70 mt-1">Update {{ $student->first_name }} {{ $student->last_name }}'s information</p>
      </div>
    </div>
  </div>

  <!-- Alert for Errors -->
  <div id="alert" class="alert alert-error mb-6 hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <div id="alert-message"></div>
  </div>

  <!-- Form Card -->
  <div class="card bg-base-100 border border-base-300">
    <div class="card-body">
      <form id="edit-form" action="{{ route('students.update', $student) }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH')
        @include('students._form')
        
        <!-- Form Actions -->
        <div class="divider"></div>
        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
          <a href="{{ route('students.index') }}" class="btn btn-ghost w-full sm:w-auto">
            Cancel
          </a>
          <button type="submit" class="btn btn-primary w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Update Student
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function(){
  const form = document.getElementById('edit-form');
  const alertBox = document.getElementById('alert');
  const alertMessage = document.getElementById('alert-message');
  
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    alertBox.classList.add('hidden');
    
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="loading loading-spinner loading-sm"></span> Updating...';
    submitBtn.disabled = true;
    
    const url = form.action;
    const data = new FormData(form);
    data.append('_method', 'PATCH');
    
    try {
      const res = await fetch(url, {
        method: 'POST',
        body: data,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      });
      
      const result = await res.json();
      
      if (res.ok) {
        if (result.redirect) {
          window.location.href = result.redirect;
        }
      } else {
        throw new Error(result.message || 'An error occurred');
      }
    } catch (err) {
      if (err.response && err.response.status === 422) {
        const msgs = Object.values(err.response.data.errors).flat();
        alertMessage.innerHTML = '<ul class="list-disc list-inside">' + msgs.map(m => `<li>${m}</li>`).join('') + '</ul>';
        alertBox.classList.remove('hidden');
      } else {
        console.error(err);
        alertMessage.textContent = 'An error occurred. Please try again.';
        alertBox.classList.remove('hidden');
      }
    } finally {
      submitBtn.innerHTML = originalContent;
      submitBtn.disabled = false;
    }
  });
})();
</script>
@endsection
