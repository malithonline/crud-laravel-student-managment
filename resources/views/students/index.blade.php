@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h4 m-0">Student List</h1>
      <div class="d-flex gap-2">
        <form method="GET" class="d-flex gap-2">
          <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search">
          <button class="btn btn-outline-secondary" type="submit">Find</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered m-0">
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
          <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->first_name }}</td>
            <td>{{ $s->last_name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->contact_number }}</td>
            <td>{{ $s->date_of_birth?->format('Y-m-d') }}</td>
            <td class="text-capitalize">{{ $s->gender }}</td>
            <td>{{ $s->type }}</td>
            <td>
              @if($s->status)
                <span class="badge text-bg-success">Active</span>
              @else
                <span class="badge text-bg-secondary">Inactive</span>
              @endif
            </td>
            <td class="d-flex gap-2">
              <form action="{{ route('students.toggle', $s) }}" method="POST">
                @csrf
                @method('PATCH')
                <button class="btn btn-sm btn-outline-secondary" type="submit">Toggle</button>
              </form>
              <a href="{{ route('students.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
              <form action="{{ route('students.destroy', $s) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
              </form>
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
@endsection
