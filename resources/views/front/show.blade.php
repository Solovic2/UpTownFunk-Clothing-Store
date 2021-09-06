@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12 col-md-6 mb-3">
            <div class="mainImg">
                <img class="img-fluid" id="main-img" src="{{ Storage::url($product->images[0]->path ?? "Nothing") }}" alt="image_"/>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div id="gallery"  class="show carousel slide mb-3" data-ride="carousel">
                <div class="carousel-inner">
                    @for($i = 0 ; $i < sizeof($product->images) ; $i+=2)
                    <div class="carousel-item @if($i == 0)active @endif">
                        <div class="row">
                            @for($j = 0 ; $j < 2 && ($j+$i) < sizeof($product->images); $j++)
                                <div class="col-6 col-sm-6 mb-2 ">
                                    <img class="img-fluid" src="{{ Storage::url($product->images[$i+$j]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
                </div>
                <a class="carousel-control-prev" href="#gallery" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#gallery" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <hr>
            <p class="warn-buy"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur doloribus illum quia vel, minima, fuga, ipsum optio ex quam dolores autem. Consequuntur, nam vel temporibus asperiores alias optio autem adipisci!</p>
            <form method="POST" class="mb-3" action="{{ route('category.completeData',$product->id) }}" >
                @csrf
                <div class="row">
                    <div class="col-6  col-md-6 form-group">
                        <label for="size" class="form-label" >Size</label>

                        <select class="form-control select"  name="size" id="size" aria-label="size">
                            @foreach($product->sizes as $size)
                            <option {{ old('size') == $size->id ? "selected" : "" }} value="{{$size->id}}" data-val = "{{ $size->pivot->quantity }}">{{ $size->size }}</option>

                            @endforeach
                        </select>
                        
                    </div>
                    
                    <div class="col-6 col-md-6 mb-3" >
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                        <span class="float-right mt-1 text-primary quantity_available">Available : {{ old('available',$product->sizes[0]->pivot->quantity) }}</span>
                        <input type="hidden"class="available"  value="{{ old('available',$product->sizes[0]->pivot->quantity) }}" name="available">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary form-control buybtn">Buy It</button>
            </form>
            @if($booked)
                <div class="alert alert-info">You Booked {{ $booked }} Items from this product    </div>
            @endif
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
                @endforeach
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ session()->get('error') }}</div>
            @endif
        </div>
       

    </div>
   

</div>

<script type="text/javascript">
 
</script>
@endsection

