@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0  text-gray-800">Categories</h1>
            @if(session()->has('status'))
                <span class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ session()->get('status') }}</span>
            @elseif(session()->has('add'))
                <span class="alert alert-primary animate__animated animate__pulse font-weight-bold">{{ session()->get('add') }}</span>
            @elseif(session()->has('upload'))
            <span class="alert alert-success animate__animated animate__pulse font-weight-bold">{{ session()->get('upload') }}</span>
            @endif
            <div class="text-right">
             <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus "></i>  Add Category</a>
            </div>
        </div>

          <div class="row">
            @foreach($cats as $cat)
              <div class="col-sm-4 mb-2">
                <div class="card">
                    <h5 class="card-header text-center font-weight-bold">{{ $cat->type }}</h5>
                    <div class="card-body">
                      <h5 class="card-title">
                          <ul class="list-group">
                              <li class="list-group-item "><a href="{{ route('admin.categories.show',$cat->id) }}" style="width:100%;font-size: 25px"
                                                            class="btn btn-light  ">
                                                            <i class="fab fa-product-hunt"></i></i> Products
                                                         </a>
                              </li>
                              <li class="list-group-item"><span>Quantity : </span><span class="text-danger">{{ count($cat->products) }}</span></li>
                          </ul>
                      </h5>
                      <div>
                        <a href="{{ route('admin.categories.edit',$cat->id) }}" class="btn btn-success float-left" >Edit</a>
                        <form method="POST" class="float-right" action="{{ route('admin.categories.destroy',$cat->id) }}">
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
            {{  $cats->links()  }}
          </div>
    </div><!-- End of Page Wrapper -->
@endsection

