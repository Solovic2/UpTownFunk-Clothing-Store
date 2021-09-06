@extends('admin.layouts.main')
@section('content')

<div class="container" >
    <form method="POST" enctype="multipart/form-data" class="row md-form" action="{{ route('admin.users.update',$user->id) }}">
        @csrf
        @method('put')
        <div class="col-md-6">
            <div class="mb-3" >
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$user->name) }}">
            </div>
            <div class="mb-3" >
                <button type="submit" class="btn btn-primary">Edit</button>
                @if(session()->has('status'))
                <div class="alert alert-success animate__animated animate__pulse font-weight-bold mt-3">{{ session()->get('status') }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-6 text-center" style="max-height:200px">
            <p><img class="img-fluid imgs"  id="op" src="{{Storage::url($user->path)}}" /></p>
            <p><input type="file"  accept="image/*" name="image"  id="file" onchange="loadFile(event,'op')" style="display: none;" /></p>
            <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
        </div>

    </form>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif
</div>
  @endsection
