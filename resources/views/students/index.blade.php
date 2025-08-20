@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h1 class="text-3xl font-bold text-base-content">Students</h1>
      <p class="text-base-content mt-1">Manage student information</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary w-full sm:w-auto">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Add Student
    </a>
  </div>

  <!-- Search Section -->
  <div class="card bg-base-100 border border-base-300">
    <div class="card-body p-4">
      <form action="{{ route('students.index') }}" method="GET" class="w-full">
        <div class="flex flex-col sm:flex-row gap-3">
          <div class="flex-1">
            <input type="text" name="q" 
                   placeholder="Search by name or email..." 
                   class="input input-bordered w-full" 
                   value="{{ request('q') }}">
          </div>
          <button type="submit" class="btn btn-outline btn-primary w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
          </button>
          @if(request('q'))
            <a href="{{ route('students.index') }}" class="btn btn-ghost w-full sm:w-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
              Clear
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>

  <!-- Students Table -->
  <div class="card bg-base-100 border border-base-300">
    <div class="card-body p-0">
      <div class="overflow-x-auto">
        <table class="table">
          <thead>
            <tr class="border-b border-base-300">
              <th class="text-left font-medium">Student</th>
              <th class="text-left font-medium hidden sm:table-cell">Contact</th>
              <th class="text-left font-medium hidden md:table-cell">Course</th>
              <th class="text-left font-medium hidden lg:table-cell">Status</th>
              <th class="text-center font-medium">Actions</th>
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
                    <div class="text-sm text-base-content opacity-70">
                      {{ $student->email }}
                    </div>
                    <div class="sm:hidden mt-1">
                      @if($student->contact_number)
                        <div class="text-xs text-base-content opacity-60">
                          {{ $student->contact_number }}
                        </div>
                      @endif
                      <div class="flex items-center gap-2 mt-1">
                        @if($student->type)
                          <span class="badge badge-sm badge-outline">{{ $student->type }}</span>
                        @endif
                        <span class="badge badge-sm {{ $student->status ? 'badge-success' : 'badge-error' }}">
                          {{ $student->status ? 'Active' : 'Inactive' }}
                        </span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="hidden sm:table-cell py-4">
                  <div class="text-sm">
                    {{ $student->contact_number ?? 'Not provided' }}
                  </div>
                </td>
                <td class="hidden md:table-cell py-4">
                  @if($student->type)
                    <span class="badge badge-outline">{{ $student->type }}</span>
                  @else
                    <span class="text-base-content opacity-50">Not set</span>
                  @endif
                </td>
                <td class="hidden lg:table-cell py-4">
                  <span class="badge {{ $student->status ? 'badge-success' : 'badge-error' }}">
                    {{ $student->status ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td class="py-4">
                  <div class="flex justify-center gap-2">
                    <a href="{{ route('students.edit', $student) }}" 
                       class="btn btn-ghost btn-sm" 
                       title="Edit student">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <form action="{{ route('students.destroy', $student) }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this student?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" 
                              class="btn btn-ghost btn-sm text-error" 
                              title="Delete student">
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
                <td colspan="5" class="text-center py-12">
                  <div class="flex flex-col items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-base-content opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    <div>
                      <h3 class="font-medium text-base-content">No students found</h3>
                      <p class="text-sm text-base-content opacity-70 mt-1">
                        @if(request('q'))
                          No students match your search criteria.
                        @else
                          Get started by adding your first student.
                        @endif
                      </p>
                    </div>
                    @unless(request('q'))
                      <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm mt-2">
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
  </div>

  <!-- Pagination -->
  @if($students->hasPages())
    <div class="flex justify-center">
      {{ $students->appends(request()->query())->links() }}
    </div>
  @endif
</div>
@endsection
