@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">

        <div class="col-12 col-sm-6 mb-4">
              <img id="image-link-{{ $user->id }}" onclick="popImg('image-link-{{ $user->id }}')"
                 class="img-fluid normal-img  mr-2"
                 src="@if(substr($user->path,0,4) == "http"){{ $user->path }} @else {{  Storage::url($user->path) }}@endif"
                 alt="{{$user->name}}" />
        </div>
        <div class="col-12 col-sm-6">
           <h1 class="text-center">Information</h1>
           <div class="information text-center mb-3">
               <div class="row">
                    <div class="col-6 col-sm-6">
                        <p>Name</p>
                        <p>Phone</p>
                        @if(isset($user->details) )
                            <p>Address</p> 
                            <p>Country</p>
                            <p>Tower</p>
                            <p>Department</p>
                            <p>Floor</p>
                        @endif
                    </div>
                    <div class="col-6 col-sm-6">
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->phone }}</p>
                        @if(isset($user->details) )
                            <p>{{ $user->details->address }}</p> 
                            <p>{{ $user->details->country }}</p>
                            <p>{{ $user->details->tower }}</p>
                            <p>{{ $user->details->department }}</p>
                            <p>{{ $user->details->floor }}</p>
                        @endif
                    </div>
               </div>
               @if($user->details == null)
                 <div class="text-center"> 
                     <span> Address Details Not Added Yet!</span>  
                     <span><a href="{{ route('profile.create') }}"class="alert alert-link">Add it !</a> </span></div>
                @endif
           </div>
           <div class="float-right">
            <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-success"><i class="fas fa-edit"></i> Edit Profile</a>
           </div>
           <div class="float-left">
            <a href="{{ route('profile.products',$user->id) }}" class="btn btn-primary"><i class="fab fa-product-hunt"></i> My Products</a>

           </div>


        </div>

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