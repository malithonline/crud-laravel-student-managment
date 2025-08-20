@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add Student</h1>

<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            @include('students._form', ['student' => new \App\Models\Student])
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
