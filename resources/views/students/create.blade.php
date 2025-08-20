@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <h1 class="h4 mb-3">Add Student</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0 ps-3">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
      @include('students._form')
      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
