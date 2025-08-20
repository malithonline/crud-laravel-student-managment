@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Student</h1>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <form id="edit-form" action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PATCH')
            @include('students._form')
            
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  Update Student
                </button>
            </div>
        </form>
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
    submitBtn.classList.add('loading');
    
    const url = form.action;
    const data = new FormData(form);
    data.append('_method', 'PATCH');
    
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
