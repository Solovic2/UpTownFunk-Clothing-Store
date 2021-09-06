@extends('layouts.main')
@section('content')
<div class="container mt-5" >
    <div class="info">
        <p class="alert alert-info ">سعر الشحن داخل الأسكندرية  30 جنيهاً  </p>
        <p class="alert alert-info"> سعر الشحن في أي محافظة آخرى  70 جنيهاً  </p>
    </div>
    <div class="border mb-3">
        <p class="alert alert-danger">  في حالة الحجز يتم الدفع يدوياً و يستمر الحجز لمدة 5 ايام فقط ثم ينتهي</p>
    </div>
    <div class="row">
        <div class="col-6"> <a href="{{ route('category.book',$id) }}" class="btn btn-success form-control">Book</a></div>
        <div class="col-6"> <a href="#" class="btn btn-primary form-control">Buy</a></div>

    </div>
   

</div>
@endsection