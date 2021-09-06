@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <button class=" float-right btn btn-primary add-img"><i class="far fa-plus-square"></i></button>

    <form method="POST" class="row dt" enctype="multipart/form-data" action="{{ route('admin.products.store',$catID) }}">
        @csrf
        <div class="col-12 col-md-6  parent-img row" >
            <div class="col-6 col-md-4">
                <p><img class="img-fluid imgs"  id="output" src=" " /></p>
                <p><input type="file"  accept="image/*" name="img[]"  id="file"  onchange="loadFile(event,'output')" style="display: none;"></p>
                <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3" >
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label mr-5">Type</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="Male"  id="male" checked >
                    <label class="form-check-label" for="male">
                      Male
                    </label>
                </div>
                <div class="form-check form-check-inline" >
                    <input class="form-check-input" type="radio" name="type" value="Female" id="female">
                    <label class="form-check-label" for="female">
                      Female
                    </label>
                </div>
            </div>
            <div class="mb-3" >
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div class="mb-3" >
                <button type="submit" class="btn btn-primary">Add New Product</button>
                @if(session()->has('status'))
                <div class="alert alert-success animate__animated animate__pulse font-weight-bold mt-3">{{ session()->get('status') }}</div>
                @endif
            </div>
        </div>

       

    </form>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif


</div>
  @endsection
