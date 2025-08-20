@extends('layouts.app')

@section('content')
<div class="max-w-2xl">
  <!-- Breadcrumb -->
  <div class="breadcrumbs text-sm mb-4">
    <ul>
      <li><a href="{{ route('students.index') }}">Students</a></li>
      <li>Add Student</li>
    </ul>
  </div>

  <!-- Form Card -->
  <div class="card bg-base-100 border border-base-300">
    <div class="card-body">
      <div class="flex items-center gap-2 mb-6">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <h1 class="text-xl font-medium">Add New Student</h1>
      </div>

      <div id="alert" class="alert alert-error hidden mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span id="alert-message"></span>
      </div>

      <form id="create-form" action="{{ route('students.store') }}" method="POST">
        @include('students._form')
        
        <div class="flex gap-2 pt-6 border-t border-base-300 mt-6">
          <button class="btn btn-primary" type="submit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Save Student
          </button>
          <a href="{{ route('students.index') }}" class="btn btn-ghost">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
(function(){
  const form = document.getElementById('create-form');
  const alertBox = document.getElementById('alert');
  const alertMessage = document.getElementById('alert-message');
  
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    alertBox.classList.add('hidden');
    
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.classList.add('loading');
    
    const url = form.action;
    const data = new FormData(form);
    
    try {
      const res = await window.axios.post(url, data, { headers: { 'Accept': 'application/json' } });
      if (res.data.redirect) window.location.href = res.data.redirect;
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
      submitBtn.classList.remove('loading');
    }
  });
})();
</script>
@endsection
