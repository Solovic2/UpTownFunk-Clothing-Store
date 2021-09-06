@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <form method="POST" action="{{ route('admin.categories.update',$cat->id) }}">
        @csrf
        @method('put')
        <div class="mb-3 col-md-6" >
            <label for="name" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type',$cat->type) }}">
        </div>
        <div class="mb-3 col-md-6" >
            <button type="submit" class="btn btn-primary">Update</button>
            @if(session()->has('status'))
            <div class="alert alert-success animate__animated animate__pulse font-weight-bold mt-3">{{ session()->get('status') }}</div>
            @endif
        </div>
    </form>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif
</div>
  @endsection
