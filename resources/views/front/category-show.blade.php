@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5">
    <div class="row ">
        <div class="d-none d-sm-block col-md-2 mb-3 text-center ">
            @foreach ($cats as $cat)
                <p class="cat-type"><a href="{{ route('category.show',$cat->id) }}">{{ $cat->type }}</a> </p>
            @endforeach
        </div>
        <div class="col-12 col-md-9">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($categories->products as $item)
                         @if( count($item->images) > 0 )
                            <div class="col-6 col-sm-4 mb-3 cat-products">
                                <a href="{{ route('product.show',$item->id) }}">
                                    <img class="img-fluid" src="{{ Storage::url($item->images[0]->path ?? "Nothing") }} " alt="image_{{ $item->images[0]->id }}"  />
                                    <div class="text-center mt-3 ">{{ $item->name }}</div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

   
   
@endsection