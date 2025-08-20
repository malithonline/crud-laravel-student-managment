@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
  <div>
    <h1 class="text-2xl font-medium">Student List</h1>
    <p class="text-sm opacity-70">Manage student records</p>
  </div>
  
  <!-- Action Buttons -->
  <div class="flex flex-wrap gap-2">
    <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-sm">
        Export
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
      <ul tabindex="0" class="dropdown-content menu bg-base-100 border border-base-300 w-40 p-2 shadow">
        <li><a href="{{ route('export.excel') }}">CSV File</a></li>
        <li><a href="{{ route('export.xlsx') }}">Excel File</a></li>
        <li><a href="{{ route('export.pdf') }}">PDF File</a></li>
      </ul>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">Add Student</a>
  </div>
</div>

<!-- Search Section -->
<div class="card bg-base-100 border border-base-300 mb-6">
  <div class="card-body p-4">
    <form method="GET" class="flex gap-2">
      <input type="text" name="q" value="{{ $q }}" class="input input-bordered flex-1" placeholder="Search students...">
      <button class="btn btn-neutral" type="submit">Search</button>
      @if($q)
        <a href="{{ route('students.index') }}" class="btn btn-ghost">Clear</a>
      @endif
    </form>
  </div>
</div>

<!-- Students Table -->
<div class="card bg-base-100 border border-base-300">
  <div class="card-body p-0">
    <div class="overflow-x-auto">
      <table class="table table-zebra">
        <thead>
          <tr class="border-base-300">
            <th class="bg-base-200">ID</th>
            <th class="bg-base-200">Name</th>
            <th class="bg-base-200">Email</th>
            <th class="bg-base-200">Contact</th>
            <th class="bg-base-200">Birth Date</th>
            <th class="bg-base-200">Gender</th>
            <th class="bg-base-200">Type</th>
            <th class="bg-base-200">Status</th>
            <th class="bg-base-200 w-48">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse($students as $s)
          <tr data-id="{{ $s->id }}" class="border-base-300">
            <td class="font-mono text-sm">{{ $s->id }}</td>
            <td>
              <div class="font-medium">{{ $s->first_name }} {{ $s->last_name }}</div>
            </td>
            <td class="text-sm">{{ $s->email }}</td>
            <td class="text-sm">{{ $s->contact_number }}</td>
            <td class="text-sm">{{ $s->date_of_birth?->format('M d, Y') }}</td>
            <td>
              <div class="badge badge-ghost badge-sm">{{ ucfirst($s->gender) }}</div>
            </td>
            <td>
              <div class="badge badge-outline badge-sm">{{ $s->type }}</div>
            </td>
            <td class="status-cell">
              @if($s->status)
                <div class="badge badge-success badge-sm">Active</div>
              @else
                <div class="badge badge-neutral badge-sm">Inactive</div>
              @endif
            </td>
            <td>
              <div class="flex gap-1">
                <button class="btn btn-ghost btn-xs btn-toggle" data-url="{{ route('students.toggle', $s) }}" title="Toggle Status">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                  </svg>
                </button>
                <a href="{{ route('students.edit', $s) }}" class="btn btn-ghost btn-xs" title="Edit">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </a>
                <button class="btn btn-ghost btn-xs text-error btn-delete" data-url="{{ route('students.destroy', $s) }}" title="Delete">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center py-8">
              <div class="flex flex-col items-center gap-2">
                <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                <div class="text-lg font-medium">No students found</div>
                <div class="text-sm opacity-70">Start by adding your first student</div>
                <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm mt-2">Add Student</a>
              </div>
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
    
    @if($students->hasPages())
      <div class="p-4 border-t border-base-300">
        {{ $students->links() }}
      </div>
    @endif
  </div>
</div>

<script>
(function(){
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  if (window.axios) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

    document.querySelectorAll('.btn-toggle').forEach(btn => {
      btn.addEventListener('click', async () => {
        const url = btn.dataset.url;
        const row = btn.closest('tr');
        try {
          btn.classList.add('loading');
          await window.axios.patch(url);
          const cell = row.querySelector('.status-cell');
          const isActive = cell.textContent.includes('Active');
          cell.innerHTML = isActive ? 
            '<div class="badge badge-neutral badge-sm">Inactive</div>' : 
            '<div class="badge badge-success badge-sm">Active</div>';
        } catch(e) { 
          console.error(e);
          alert('Error updating status');
        } finally {
          btn.classList.remove('loading');
        }
      });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', async () => {
        if(!confirm('Are you sure you want to delete this student?')) return;
        const url = btn.dataset.url;
        const row = btn.closest('tr');
        try {
          btn.classList.add('loading');
          await window.axios.delete(url);
          row.remove();
        } catch(e) { 
          console.error(e);
          alert('Error deleting student');
        } finally {
          btn.classList.remove('loading');
        }
      });
    });
  }
})();
</script>
@endsection
