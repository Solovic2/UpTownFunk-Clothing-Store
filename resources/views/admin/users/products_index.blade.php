@extends('admin.layouts.main')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0  text-gray-800">{{ $user_name }} - Products</h1>
        <div>
            @if(session()->has('status'))
            <span class="text-danger font-weight-bold">{{ session()->get('status') }}</span>
            @endif
        </div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="row">
        @foreach($relations as $relation)
        {{-- @foreach($relation->product as $product) --}}
        {{-- {{ dd($relation->product->id) }} --}}
        <div class="col-sm-4 mb-2">
            <div class="card text-center">
                <div class="card-header">
                    {{  $relation->product->name }}
                </div>
                <div class="card-body">
                  <h5 class="card-title"><a href="{{ route('admin.users.showProductPictures',[$id,$relation->product->id]) }}" class="btn btn-info" style="width:100%">Product Images</a></h5>
                  <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item">Type : {{ $relation->product->type[0] }}</li>
                        <li class="list-group-item">Take : ({{ $relation->quantity }})  {{ $relation->size->size }}</li>
                        <li class="list-group-item">Price : <span class="text-danger">{{  $relation->product->price }} </span></li>
                    </ul>
                  </p>
                  <form method="POST" action="{{ route('admin.users.destroyProduct',[$id,$relation->id]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" name="Delete" class="btn btn-danger" >Delete</button>
                </form>
                </div>
              </div>
        </div>
        {{-- @endforeach --}}

        @endforeach

    </div>

</div>
@endsection
