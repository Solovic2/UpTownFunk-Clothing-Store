@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <form method="POST" action="{{ route('admin.products.update',[$catID ,$product->id]) }}">
        @csrf
        @method('put')
        <div class="mb-3 col-md-6" >
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$product->name) }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="type" class="form-label mr-5">Type</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" value="Male"  id="male" {{ $product->type =='Male'? 'checked' :'' }}>
                <label class="form-check-label" for="male">
                  Male
                </label>
            </div>
            <div class="form-check form-check-inline" >
                <input class="form-check-input" type="radio" name="type" value="Female" id="female" {{ $product->type =='Female'? 'checked' :'' }}>
                <label class="form-check-label" for="female">
                  Female
                </label>
            </div>
        </div>
        <div class="mb-3 col-md-6" >
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price',$product->price) }}">
        </div>
        <div class="mb-3 col-md-6" >
            <button type="submit" class="btn btn-primary">Edit</button>
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
