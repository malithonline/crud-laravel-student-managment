@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="space-y-6">
  <!-- Page header -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-base-content">Students</h1>
      <p class="text-base-content opacity-70">Manage all student records</p>
    </div>
    <div class="flex gap-2">
      @if($students->count() > 0)
        <div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-outline">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            Export
          </label>
          <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 border border-base-300">
            <li><a href="{{ route('export.excel') }}">Download CSV</a></li>
            <li><a href="{{ route('export.xlsx') }}">Download Excel</a></li>
            <li><a href="{{ route('export.pdf') }}">Download PDF</a></li>
          </ul>
        </div>
      @endif
      <a href="{{ route('students.create') }}" class="btn btn-primary">
        Add New Student
      </a>
    </div>
  </div>

  <!-- Quick stats -->
  @if($students->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <div class="border border-base-300 p-4 text-center">
        <div class="text-2xl font-bold text-primary">{{ $students->total() }}</div>
        <div class="text-sm text-base-content opacity-70">Total Students</div>
      </div>
      <div class="border border-base-300 p-4 text-center">
        <div class="text-2xl font-bold text-success">{{ $students->where('status', true)->count() }}</div>
        <div class="text-sm text-base-content opacity-70">Active</div>
      </div>
      <div class="border border-base-300 p-4 text-center">
        <div class="text-2xl font-bold text-error">{{ $students->where('status', false)->count() }}</div>
        <div class="text-sm text-base-content opacity-70">Inactive</div>
      </div>
      <div class="border border-base-300 p-4 text-center">
        <div class="text-2xl font-bold text-accent">{{ $students->whereNotNull('type')->count() }}</div>
        <div class="text-sm text-base-content opacity-70">With Course</div>
      </div>
    </div>
  @endif

  <!-- Search and filters -->
  <div class="border border-base-300 p-4">
    <form action="{{ route('students.index') }}" method="GET" class="w-full">
      <div class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
          <input type="text" name="q" 
                 placeholder="Search students by name or email..." 
                 class="input input-bordered w-full" 
                 value="{{ request('q') }}">
        </div>
        <button type="submit" class="btn btn-primary">
          Search
        </button>
        @if(request('q'))
          <a href="{{ route('students.index') }}" class="btn btn-outline">
            Clear
          </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Students table -->
  <div class="bg-base-100 border border-base-300">
    <div class="overflow-x-auto">
      <table class="table w-full">
        <thead class="border-b border-base-300">
          <tr>
            <th class="text-left font-medium py-3">Name</th>
            <th class="text-left font-medium py-3 hidden sm:table-cell">Email</th>
            <th class="text-left font-medium py-3 hidden md:table-cell">Contact</th>
            <th class="text-left font-medium py-3 hidden lg:table-cell">Course</th>
            <th class="text-center font-medium py-3 hidden lg:table-cell">Status</th>
            <th class="text-center font-medium py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($students as $student)
            <tr class="border-b border-base-200">
              <td class="py-4">
                <div>
                  <div class="font-medium text-base-content">
                    {{ $student->first_name }} {{ $student->last_name }}
                  </div>
                  <div class="text-sm text-base-content opacity-60">
                    {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->age . ' years old' : 'Age not set' }}
                  </div>
                  <!-- Mobile info -->
                  <div class="sm:hidden mt-2 space-y-1">
                    <div class="text-sm text-base-content opacity-70">
                      {{ $student->email }}
                    </div>
                    @if($student->contact_number)
                      <div class="text-sm text-base-content opacity-70">
                        {{ $student->contact_number }}
                      </div>
                    @endif
                    <div class="flex items-center gap-2">
                      @if($student->type)
                        <span class="badge badge-outline badge-sm">{{ $student->type }}</span>
                      @endif
                      <button class="status-toggle badge badge-sm {{ $student->status ? 'badge-success' : 'badge-error' }} hover:opacity-80 cursor-pointer"
                              data-url="{{ route('students.toggle', $student) }}"
                              title="Click to toggle status">
                        {{ $student->status ? 'Active' : 'Inactive' }}
                      </button>
                    </div>
                  </div>
                </div>
              </td>
              <td class="hidden sm:table-cell py-4">
                <div class="text-sm text-base-content">
                  {{ $student->email }}
                </div>
              </td>
              <td class="hidden md:table-cell py-4">
                <div class="text-sm text-base-content">
                  {{ $student->contact_number ?? 'Not provided' }}
                </div>
              </td>
              <td class="hidden lg:table-cell py-4">
                @if($student->type)
                  <span class="badge badge-outline">{{ $student->type }}</span>
                @else
                  <span class="text-base-content opacity-50">Not set</span>
                @endif
              </td>
              <td class="hidden lg:table-cell text-center py-4">
                <button class="status-toggle badge {{ $student->status ? 'badge-success' : 'badge-error' }} hover:opacity-80 cursor-pointer"
                        data-url="{{ route('students.toggle', $student) }}"
                        title="Click to toggle status">
                  {{ $student->status ? 'Active' : 'Inactive' }}
                </button>
              </td>
              <td class="text-center py-4">
                <div class="flex justify-center gap-2">
                  <a href="{{ route('students.edit', $student) }}" 
                     class="btn btn-ghost btn-sm" 
                     title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </a>
                  <form action="{{ route('students.destroy', $student) }}" 
                        method="POST" 
                        class="inline ajax-delete-form"
                        data-confirm="Delete this student?"
                        data-student-name="{{ $student->first_name }} {{ $student->last_name }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-ghost btn-sm text-error" 
                            title="Delete">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-12">
                <div class="flex flex-col items-center gap-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-base-content opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                  </svg>
                  <div>
                    <h3 class="font-medium text-base-content">No students found</h3>
                    <p class="text-sm text-base-content opacity-70 mt-1">
                      @if(request('q'))
                        No students match your search.
                      @else
                        Start by adding your first student.
                      @endif
                    </p>
                  </div>
                  @unless(request('q'))
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                      Add First Student
                    </a>
                  @endunless
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Page numbers -->
  @if($students->hasPages())
    <div class="flex justify-center">
      {{ $students->appends(request()->query())->links() }}
    </div>
  @endif
</div>
@endsection
