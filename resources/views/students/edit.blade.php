@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h1 class="h4 mb-3">Edit Student</h1>

    <div id="alert" class="alert d-none"></div>

    <form id="edit-form" action="{{ route('students.update', $student) }}" method="POST">
      @csrf
      @method('PATCH')
      @include('students._form')
      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
(function(){
  const form = document.getElementById('edit-form');
  const alertBox = document.getElementById('alert');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    alertBox.className = 'alert d-none';
    const url = form.action;
    const data = new FormData(form);
    data.append('_method', 'PATCH');
    try {
      const res = await window.axios.post(url, data, { headers: { 'Accept': 'application/json' } });
      if (res.data.redirect) window.location.href = res.data.redirect;
    } catch (err) {
      if (err.response && err.response.status === 422) {
        const msgs = Object.values(err.response.data.errors).flat();
        alertBox.className = 'alert alert-danger';
        alertBox.innerHTML = '<ul class="m-0 ps-3">' + msgs.map(m => `<li>${m}</li>`).join('') + '</ul>';
      } else {
        console.error(err);
      }
    }
  });
})();
</script>
@endsection
