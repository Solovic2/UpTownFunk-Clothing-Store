@extends('layouts.main')
@section('content')

<div class="container mt-5" >
    <form method="POST" enctype="multipart/form-data" class="row md-form" action="{{ route('profile.update',$user->id) }}">
        @csrf
        @method('put')
        <div class="col-md-6 text-center mb-5" style="max-height:500px">
            <p><img class="img-fluid imgs"  id="op" 
                src="@if(substr($user->path,0,4) == "http"){{ $user->path }} @else {{  Storage::url($user->path) }}@endif"
            </p>
            <p><input type="file"  accept="image/*" name="image"  id="file" onchange="loadFile(event,'op')" style="display: none;" /></p>
            <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
        </div>

        <div class="col-md-6">
            <div class="mb-3" >
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$user->name) }}">
            </div>
                       <!--  Details -->
            @if ($user->details !=null)         
           
            <div class="row  mb-3 text-center justify-content-center details" >
                <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address',$user->details->address) }}">
                </div>
                <div class="col-12 col-md-12 row form-group mb-3" style="direction: rtl" >
                    <div class="col-6 col-sm-3" >
                        <label for="country" class="form-label">المدينة</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ old('country',$user->details->country) }}">
                    </div>
                    <div class="col-6 col-sm-3" >
                        <label for="tower" class="form-label"> رقم-اسم العمارة</label>
                        <input type="text" class="form-control" id="tower" name="tower" value="{{ old('tower',$user->details->tower) }}">
                    </div>
                    <div class="col-6 col-sm-3" >
                        <label for="department" class="form-label">رقم الشقة </label>
                        <input type="text" class="form-control" id="department" name="department" value="{{ old('department',$user->details->department) }}">
                    </div>
                    <div class="col-6 col-sm-3" >
                        <label for="floor" class="form-label">رقم الدور</label>
                        <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor',$user->details->floor) }}">
                    </div>
                </div>        
            </div>

            @endif

            <div class="mb-3" >
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="If you kept it empty , you will save same password ">
            </div>
            <div class="mb-3" >
                <button type="submit" class="btn btn-primary">Update</button>
                @if(session()->has('status'))
                <div class="alert alert-success animate__animated animate__pulse font-weight-bold mt-3">{{ session()->get('status') }}</div>
                @endif
            </div>
        </div>
       
    </form>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif
</div>
  @endsection
