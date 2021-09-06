@extends('admin.layouts.main')
@section('content')

<div class="container" >

    <form method="POST" class=" justify-content-center"  action="{{ route('admin.products.updateSizes',[$id,$size]) }}">
        @csrf
        <div class="row mb-3 text-center justify-content-center">
            @foreach($sizes as $size)
            <div class="col-6  col-sm-1 form-group">
                <label for="size" class="form-label">Num</label>
                <select class="form-control " name="size" id="size" aria-label="size">
                    <option selected value="{{$size->id}}">{{ $size->size }}</option>
                    @foreach($available as $in)
                        <option value="{{$in->id}}">{{ $in->size }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-sm-1 mb-3" >
                <label for="quantity" class="form-label">Num</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity',$size->pivot->quantity) }}">
            </div>
            <div class="col-4 col-sm-1" >
                <label for="length" class="form-label">Length</label>
                <input type="text" class="form-control" id="length" name="length" value="{{ old('length',$size->pivot->length) }}">
            </div>
            <div class="col-4 col-sm-1" >
                <label for="width" class="form-label">Width</label>
                <input type="text" class="form-control" id="width" name="width" value="{{ old('width',$size->pivot->width) }}">
            </div>
            <div class="col-4 col-sm-1" >
                <label for="depth" class="form-label">Depths</label>
                <input type="text" class="form-control" id="depth" name="depth" value="{{ old('depth',$size->pivot->depth) }}">
            </div>
            @endforeach

        </div>
        <div class="text-center">
            <input class="btn btn-primary" type="submit" value="Edit">
        </div>

    </form>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif


</div>
  @endsection
