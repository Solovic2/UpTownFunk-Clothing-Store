
<div class="container mt-5" >

    <form method="POST" action="{{ route($route,$parameters) }}" >
        @csrf
        <div class="row  mb-3 text-center justify-content-center details" >
            <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
            <div class="col-12 col-md-6 row form-group mb-5" style="direction: rtl" >
                <div class="col-6 col-sm-3" >
                    <label for="country" class="form-label">المدينة</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                </div>
                <div class="col-6 col-sm-3" >
                    <label for="tower" class="form-label"> رقم-اسم العمارة</label>
                    <input type="text" class="form-control" id="tower" name="tower" value="{{ old('tower') }}">
                </div>
                <div class="col-6 col-sm-3" >
                    <label for="department" class="form-label">رقم الشقة </label>
                    <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
                </div>
                <div class="col-6 col-sm-3" >
                    <label for="floor" class="form-label">رقم الدور</label>
                    <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor') }}">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <button type="submit" class="arrow-btn" ><i class="fas fa-arrow-circle-right fa-4x"></i></button>
            </div>  
            @if(session()->has('status'))
            <div class="alert alert-success animate__animated animate__pulse font-weight-bold mt-3">{{ session()->get('status') }}</div>
            @endif             
        </div>
    </form>
   
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ $error }}</div>
        @endforeach
    @endif


</div>

