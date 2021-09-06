@extends('admin.layouts.main')
@section('content')

<div class="container" >
    <div class="row">
        @forelse($product->images as $img)
        <div class="col-sm-4 mb-2 parent-img"style=" position: relative;width: 100%;">
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
