@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
</div>

<div class="mb-4">
    <form action="{{ route('students.index') }}" method="GET">
        <div class="form-control">
            <div class="input-group">
                <input type="text" name="q" placeholder="Search…" class="input input-bordered w-full" value="{{ request('q') }}">
                <button class="btn btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="overflow-x-auto">
    <table class="table w-full">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-ghost btn-xs">Edit</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-ghost btn-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $students->links() }}
</div>
@endsection
