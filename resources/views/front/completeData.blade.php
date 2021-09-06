@extends('layouts.main')
@section('content')

    @include('layouts.details',['route'=>'category.storeDetails','parameters'=>$id])

@endsection
