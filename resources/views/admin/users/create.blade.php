@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3 col-md-6" >
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3 col-md-6" >
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone"  value="{{ old('phone') }}">
        </div>
        <div class="mb-3 col-md-6" >
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3 col-md-6" >
            <button type="submit" class="btn btn-primary">Add New Member</button>
        </div>
    </form>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif
</div>
  @endsection
