@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h4 m-0">Student List</h1>
      <div class="d-flex gap-2">
        <a href="{{ route('export.excel') }}" class="btn btn-outline-secondary">CSV</a>
        <a href="{{ route('export.xlsx') }}" class="btn btn-outline-secondary">XLSX</a>
        <a href="{{ route('export.pdf') }}" class="btn btn-outline-secondary">PDF</a>
        <form method="GET" class="d-flex gap-2">
          <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search">
          <button class="btn btn-outline-secondary" type="submit">Find</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered m-0" id="students-table">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Type</th>
            <th>Status</th>
            <th style="width:200px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($students as $s)
          <tr data-id="{{ $s->id }}">
            <td>{{ $s->id }}</td>
            <td>{{ $s->first_name }}</td>
            <td>{{ $s->last_name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->contact_number }}</td>
            <td>{{ $s->date_of_birth?->format('Y-m-d') }}</td>
            <td class="text-capitalize">{{ $s->gender }}</td>
            <td>{{ $s->type }}</td>
            <td class="status-cell">
              @if($s->status)
                <span class="badge text-bg-success">Active</span>
              @else
                <span class="badge text-bg-secondary">Inactive</span>
              @endif
            </td>
            <td class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-secondary btn-toggle" data-url="{{ route('students.toggle', $s) }}">Toggle</button>
              <a href="{{ route('students.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
              <button class="btn btn-sm btn-outline-danger btn-delete" data-url="{{ route('students.destroy', $s) }}">Delete</button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="10" class="text-center">No data</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $students->links() }}
    </div>
  </div>
</div>

<script>
(function(){
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

  document.querySelectorAll('.btn-toggle').forEach(btn => {
    btn.addEventListener('click', async () => {
      const url = btn.dataset.url;
      const row = btn.closest('tr');
      try {
        await window.axios.patch(url);
        const cell = row.querySelector('.status-cell');
        const isActive = cell.textContent.includes('Active');
        cell.innerHTML = isActive ? '<span class="badge text-bg-secondary">Inactive</span>' : '<span class="badge text-bg-success">Active</span>';
      } catch(e){ console.error(e); }
    });
  });

  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', async () => {
      if(!confirm('Delete this student?')) return;
      const url = btn.dataset.url;
      const row = btn.closest('tr');
      try {
        await window.axios.delete(url);
        row.remove();
      } catch(e){ console.error(e); }
    });
  });
})();
</script>
@endsection
