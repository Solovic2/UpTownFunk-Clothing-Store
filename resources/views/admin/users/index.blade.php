@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0  text-gray-800">Users</h1>
            @if(session()->has('status'))
                <span class="alert alert-danger animate__animated animate__pulse font-weight-bold">{{ session()->get('status') }}</span>
            @elseif(session()->has('add'))
                <span class="alert alert-success animate__animated animate__pulse font-weight-bold">{{ session()->get('add') }}</span>
            @endif
            <div class="text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus "></i>  Add New User</a>

            </div>
        </div>
        <!-- Content Row -->
          <div class="row">
            @foreach($users as $user)
              <div class="col-sm-4 mb-2">
                <div class="card">
                    <h5 class="card-header">
                         <span class=""><img class="img-fluid imgs avatar" src="@if(substr($user->path,0,4) == "http"){{ $user->path }} @else {{  Storage::url($user->path) }} @endif" alt="profile_picture"></span>
                         <span class="ml-2">{{ $user->name }}</span>
                    </h5>
                    <div class="card-body">
                      <h5 class="card-title">
                          <ul class="list-group">
                            <li class="list-group-item"><span>Email : </span><span class="text-danger">{{ $user->email ?? 'FB e-mails only' }}</span></li>
                            <li class="list-group-item"><span>Phone : </span><span class="text-success">{{ $user->phone }}</span></li>
                            <li class="list-group-item ">
                                    <a href="{{ route('admin.users.showProducts',$user->id) }}" class="btn btn-info" style="width: 100%" > ( {{ $user->relations_count }} )  Products</a>
                            </li>
                          </ul>
                      </h5>
                      <div>
                        <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-success float-left" >Edit</a>
                        <form method="POST" class="float-right"  action="{{ route('admin.users.destroy',$user->id) }}">
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
            {{  $users->links()  }}
          </div>

    </div><!-- End of Page Wrapper -->
@endsection

