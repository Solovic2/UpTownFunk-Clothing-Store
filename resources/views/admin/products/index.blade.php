@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0  text-gray-800">Products</h1>
            @if(session()->has('status'))
                <span class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ session()->get('status') }}</span>
            @elseif(session()->has('add'))
                <span class="alert alert-primary animate__animated animate__pulse font-weight-bold">{{ session()->get('add') }}</span>
            @elseif(session()->has('upload'))
            <span class="alert alert-success animate__animated animate__pulse font-weight-bold">{{ session()->get('upload') }}</span>
            @endif
            <div class="text-right">
             <a href="{{ route('admin.products.create',$catID) }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus "></i>  Add New Product</a>
            </div>
        </div>

          <div class="row">
            @foreach($products as $product)
              <div class="col-sm-4 mb-2">
                <div class="card">
                    <h5 class="card-header"><span class="float-left">{{ $product->name }}</span> <span class="float-right">{{ $product->type }}</span></h5>
                    <div class="card-body">
                      <h5 class="card-title">
                          <ul class="list-group">
                              <li class="list-group-item "><a href="{{ route('admin.products.showPictures',$product->id) }}" style="width:100%"
                                                            class="btn btn-info">
                                                            <i class="fas fa-images"></i> Pictures
                                                         </a>
                              </li>
                              <li class="list-group-item"><span>Price : </span><span class="text-danger">{{ $product->price }}</span></li>

                              <li class="list-group-item"><span>Avaliable Sizes : </span>
                                <a class="btn btn-info" href="{{ route('admin.products.showSizes',$product->id) }}">
                                    @foreach($product->sizes as $size)
                                    <span>({{ $size->pivot->quantity }}) {{ $size->size }}</span>
                                    @endforeach
                                </a>
                             </li>
                          </ul>
                      </h5>
                      <div>
                        <a href="{{ route('admin.products.edit',[$catID ,$product->id]) }}" class="btn btn-success float-left" >Edit</a>
                        <form method="POST" class="float-right" action="{{ route('admin.products.destroy',[$catID ,$product->id]) }}">
                              @csrf
                              @method('delete')
                              <button type="submit" name="Delete" class="btn btn-danger" >Delete</button>
                          </form>
                      </div>

                    </div>
                  </div>
              </div>
              @endforeach

          </div>

          <div class="d-flex justify-content-center">
            {{  $products->links()  }}
          </div>
    </div><!-- End of Page Wrapper -->
@endsection

