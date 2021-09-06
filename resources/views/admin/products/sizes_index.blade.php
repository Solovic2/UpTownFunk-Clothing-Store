@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <div class="text-right mb-3">
        <a href="{{ route('admin.products.createSizes',$product->id) }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus "></i>  Add New Size</a>
    </div>
    <div class="text-center mb-3">
        @if(Session::has('status'))
        <span class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ session()->get('status') }}</span>
        @elseif(Session::has('upload'))
        <span class="alert alert-success animate__animated animate__pulse font-weight-bold">{{ session()->get('upload') }}</span>
        @elseif(Session::has('add'))
        <span class="alert alert-info animate__animated animate__pulse font-weight-bold">{{ session()->get('add') }}</span>
        @endif
    </div>
    <div class="row">
        @foreach($product->sizes as $size)
        <div class="col-sm-6 mb-2">
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item "><span class="ml-3">Size :</span><span class=" ml-5  font-weight-bold text-primary">{{ $size->size }}</span> </li>
                    <li class="list-group-item"><span class="ml-3">Num :</span><span class="ml-5 font-weight-bold text-primary"> {{ $size->pivot->quantity }}</span></li>
                    <li class="list-group-item">
                        <ul class="nav">
                            <li class="nav-link">Length</li>
                            <li class="nav-link ml-auto">Width</li>
                            <li class="nav-link ml-auto">Depth</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <ul class="nav">
                            <li class="nav-link font-weight-bold text-primary">{{ $size->pivot->length }}</li>
                            <li class="nav-link ml-auto font-weight-bold text-primary">{{ $size->pivot->width }}</li>
                            <li class="nav-link ml-auto font-weight-bold text-primary">{{ $size->pivot->depth }}</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('admin.products.editSizes',[$product->id,$size->pivot->size_id]) }}" class="btn btn-success float-left" >Edit</a>
                        <form method="POST" class="float-right"  action="{{ route('admin.products.destroySizes',[$product->id,$size->pivot->size_id]) }}">
                              @csrf
                              @method('delete')
                              <button type="submit" name="Delete" class="btn btn-danger" >Delete</button>
                          </form> </li>

                </ul>
            </div>
        </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
