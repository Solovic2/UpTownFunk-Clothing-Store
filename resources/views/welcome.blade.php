
@extends('layouts.main')

@section('content')

<!-- Image Gif Intro -->
<div class="header-gif">
    <img src="{{ asset('assets/front/images/main.gif')  }}" >
</div>
<!-- Products -->
<div class="container">
                    <!-- Jackets -->
    <div class="mt-5">
        <h1 class="text-center mb-4">Jackets</h1>
        <div id="gallery" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if ($agent->isMobile())
                    @for($i = 0 ; $i < sizeof($jackets) ; $i+=2)
                        <div class="carousel-item @if($i == 0)active @endif">
                            <div class="row">
                                @for($j = 0 ; $j < 2 && ($j+$i) < sizeof($jackets); $j++)
                                    <div class="col-6 mb-2 ">
                                        <a href="{{ route('product.show',$jackets[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($jackets[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                @elseif($agent->isTablet())
                    @for($i = 0 ; $i < sizeof($jackets) ; $i+=3)
                        <div class="carousel-item @if($i == 0)active @endif">
                            <div class="row">
                                @for($j = 0 ; $j < 3 && ($j+$i) < sizeof($jackets); $j++)
                                    <div class="col-4 mb-2 ">
                                        <a href="{{ route('product.show',$jackets[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($jackets[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                @else
                    @for($i = 0 ; $i < sizeof($jackets) ; $i+=4)
                        <div class="carousel-item @if($i == 0)active @endif">
                            <div class="row">
                                @for($j = 0 ; $j < 4 && ($j+$i) < sizeof($jackets); $j++)
                                    <div class="col-3 col-sm-3 mb-2 ">
                                        <a href="{{ route('product.show',$jackets[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($jackets[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                @endif
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
    </div>
                    <!-- Shirts -->
    <div class="mt-5">
        <h1 class="text-center mb-4">Shirts</h1>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 mb-3">
                <div class="other-cat">
                    <img src="{{ asset('assets/front/images/1.jpg')  }}" alt="">
                    <a class="overlay text" href="#">
                    <div class="text">Shirts</div>
                    </a>
                </div>
                
            </div>
            <div class="col-12 col-sm-6 other-cat mb-3">
                <div class="other-cat">
                    <img src="{{ asset('assets/front/images/2.jpg')  }}" alt="">
                    <a class="overlay text" href="#">
                    <div class="text">Shirts</div>
                    </a>
                </div>
            </div>
        </div>
        <div id="shirt-gallary" class="carousel slide mb-3" data-ride="carousel">
            <div class="carousel-inner">
                @if ($agent->isMobile())
                    @for($i = 0 ; $i < sizeof($shirts) ; $i+=2)
                        <div class="carousel-item  @if($i==0) active @endif ">
                            <div class="row">
                                @for($j = 0 ; $j < 2 && ($j+$i) < sizeof($shirts); $j++)
                                    <div class="col-6 mb-2 ">
                                        <a href="{{ route('product.show',$shirts[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($shirts[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                @elseif ($agent->isTablet())
                    @for($i = 0 ; $i < sizeof($shirts) ; $i+=3)
                        <div class="carousel-item  @if($i==0) active @endif ">
                            <div class="row">
                                @for($j = 0 ; $j < 3 && ($j+$i) < sizeof($shirts); $j++)
                                    <div class="col-4  col-sm-4 mb-2 ">
                                        <a href="{{ route('product.show',$shirts[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($shirts[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor                     
                @else
                    @for($i = 0 ; $i < sizeof($shirts) ; $i+=4)
                        <div class="carousel-item  @if($i==0) active @endif ">
                            <div class="row">
                                @for($j = 0 ; $j < 4 && ($j+$i) < sizeof($shirts); $j++)
                                
                                    <div class="col-3  col-sm-3 mb-2 ">
                                        <a href="{{ route('product.show',$shirts[$i+$j]->id) }}">
                                            <img class="img-fluid" src="{{ Storage::url($shirts[$i+$j]->images[0]->path ?? "profile_pictures/avatar.png") }}" alt="image_{{ $i+$j }}"/>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
            <a class="carousel-control-prev" href="#shirt-gallary" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#shirt-gallary" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection



