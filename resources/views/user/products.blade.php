@extends('layouts.main')
@section('content')
<div class="container mt-5">

    <!-- Page Heading -->
    <div class=" text-center align-items-center  mb-4">
        <h1 class="h3 mb-0 text-gray-800">Your Products</h1>
        <div>
            @if(session()->has('status'))
            <span class="text-danger font-weight-bold">{{ session()->get('status') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($relations as $relation)
        <div class="col-12 col-sm-6 mb-2">
            <div class="card text-center">
                <div class="card-header">
                    {{  $relation->product->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('product.show',$relation->product->id ) }}" class="btn btn-info" style="width:100%">Product Details</a></h5>
                    <p class="card-text">
                    <ul class="list-group">
                        <li class="list-group-item">Type : {{ $relation->product->type[0] }}</li>
                        <li class="list-group-item">Take : ({{ $relation->quantity }})  {{ $relation->size->size }}</li>
                        <li class="list-group-item">Price : <span class="text-danger">{{  $relation->product->price }} </span></li>
                    </ul>
                    </p>
                    <form method="POST" action="{{ route('profile.product-destroy',$relation->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" name="Delete" class="btn btn-danger" >Delete</button>
                </form>
                </div>
                </div>
        </div>
        @endforeach

    </div>

</div>


@endsection
