@extends('admin.layouts.main')

@section('content')
    <div class="container" >
        @if(session()->has('img'))
        <div class="alert alert-success animate__animated animate__pulse font-weight-bold text-center mb-1">{{ session()->get('img') }}</div>
    @endif
        <form method="POST" action="{{ route('admin.products.updatePictures',$product->id) }}" class="text-right mb-4" enctype="multipart/form-data">
            @csrf
            @method('put')
            <p><input type="file"  accept="image/*" name="new-img" id="new-img" onchange="form.submit()" autocomplete="off"  style="display: none;"></p>
            <p><label for="new-img" class="btn btn-sm btn-primary shadow-sm" style="cursor: pointer;"> Add <i class="fas fa-images"></i></label></p>
        </form>
        <div class="row">
            @forelse($product->images as $img)
            <div class="col-sm-4 mb-2 parent-img"style=" position: relative;width: 100%;">
            <form method="POST" action="{{ route('admin.products.deleteProduct',[$product->id,$img->id])}}">
                @csrf
                @method('DELETE')
                    <button name='delete-img' type="submit" class="close-delete btn btn-danger">
                        <i class="fas fa-times fa-lg"></i>
                    </button>
            </form>

                <img id="image-link-{{ $img->id }}" onclick="popImg('image-link-{{ $img->id }}')"
                    class="img-fluid normal-img  mr-2"
                    src=" {{ Storage::url($img->path)  }}"
                    alt="{{$img->id}}" />
            </div>
            @empty
            <h2 >No Images Yet! Add One?</h2>
            @endforelse
        </div>
        <div id="myModal" class="modal">
            <!-- The Close Button -->
            <span class="close">&times;</span>
            <!-- Modal Content (The Image) -->
            <img class="modal-content" id="img01">
            <!-- Modal Caption (Image Text) -->
            <div id="caption"></div>
        </div>
    </div>

@endsection