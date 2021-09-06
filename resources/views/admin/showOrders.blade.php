@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($relations as $relation)
            <div class="mb-3 col-12 col-sm-4">
                <div class="card" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-4 col-md-4">
                            <img class="img-fluid rounded-start img-svg" src="{{ Storage::url($relation->product->images[0]->path  ?? "Nothing") }}"alt="...">
                        </div>
                        <div class="col-8 col-md-8">
                            <div class="card-body">
                            <div class="card-title">
                                <span class="font-weight-bold"> {{ $relation->product->name }}</span> 
                                <span class="text-danger float-right " > {{ $relation->product->price }} EGP</span> 
                            </div>
                            <div class="card-text">
                                <p>Username :   <span>{{ $relation->user->name }}</span></p> 
                                <p>Phone : <span class="text-danger"> {{ $relation->user->phone }}</span></p> 
                                @if (isset($relation->user->details))
                                    <p>Address : <span> {{ $relation->user->details->address }}</span></p> 
                                    <p>Country : <span>{{ $relation->user->details->country }}</span> </p> 
                                    <p>Tower : <span>{{ $relation->user->details->tower }}</span> </p> 
                                    <p>Department : <span>{{ $relation->user->details->department }}</span> </p> 
                                    <p>Floor : <span>{{ $relation->user->details->floor }}</span> </p> 
                                @endif
                            </div>
                            <div>
                                <span class="card-text"><small class="text-muted">Booked : {{ \Carbon\Carbon::parse($relation->updated_at)->diffForHumans()  }}</small></span>
                                <span class="float-right text-danger">( {{ $relation->quantity }} ) {{ $relation->size->size }}</span> 
                            </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
                     
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{  $relations->links()  }}
        </div>
    </div>
@endsection