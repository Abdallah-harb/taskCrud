@extends('layouts.master')
@section('css')

    @section('title')
        All Users
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> All Users</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        Add User <i class="fa fa-plus"></i>
                    </button>

                    <br><br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Process</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>

                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $user->id }}"
                                                title="Edit"><i
                                                class="fa fa-edit"></i>Edit </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $user->id }}"
                                                title="Delete"><i
                                                class="fa fa-trash"></i>Delete</button>
                                    </td>
                                </tr>

                              <!-- edit -->
                              <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                   aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                  id="exampleModalLabel">
                                                  Edit user
                                              </h5>
                                              <button type="button" class="close" data-dismiss="modal"
                                                      aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <!-- add_form -->
                                              <form action="{{route('user-update',$user->id)}}" method="post">
                                                  @csrf
                                                  <input id="id" type="hidden" name="id" class="form-control"
                                                         value="{{ $user->id }}">
                                                  <div class="row">
                                                      <div class="col">
                                                          <label for="Name"
                                                                 class="mr-sm-2">name
                                                          </label>
                                                          <input id="name" type="text" name="name" class="form-control" value="{{$user->name}}">
                                                      </div>
                                                      <div class="col">
                                                          <label for="name_en"
                                                                 class="mr-sm-2">Email
                                                          </label>
                                                          <input type="email" class="form-control" name="email" required value="{{$user->email}}">
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="row">
                                                      <div class="col">
                                                          <label for="Name"
                                                                 class="mr-sm-2">Password
                                                          </label>
                                                          <input id="password" type="password" name="password" class="form-control" value="{{$user->password}}">
                                                      </div>
                                                      <div class="col">
                                                          <label for="name_en"
                                                                 class="mr-sm-2">password confirmation
                                                          </label>
                                                          <input type="password" class="form-control" name="password_confirmation" value="{{$user->password}}" required >
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="row">
                                                      <div class="col">
                                                          <label for="Name"
                                                                 class="mr-sm-2">mobile
                                                          </label>
                                                          <input id="mobile" type="text" name="mobile" class="form-control"  value="{{$user->mobile}}" required>
                                                      </div>

                                                  </div>

                                                  <br><br>

                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary"
                                                              data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>close</button>
                                                      <button type="submit"
                                                              class="btn btn-success">Submit</button>
                                                  </div>
                                              </form>

                                          </div>
                                      </div>
                                  </div>
                              </div>


                             <!--delete model -->
                             <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                 id="exampleModalLabel">
                                                 Delete User : {{$user->name}}
                                             </h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <form action="{{route('user.delete',$user->id)}}" method="post">
                                                 @csrf
                                                 Are You Sure To Delete User .!
                                                 <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $user->id }}">
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary"
                                                             data-dismiss="modal">Close</button>
                                                     <button type="submit"
                                                             class="btn btn-danger">Submit</button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            Add users
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{route('user-store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">name
                                    </label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                <div class="col">
                                    <label for="name_en"
                                           class="mr-sm-2">Email
                                    </label>
                                    <input type="email" class="form-control" name="email" required value="{{old('email')}}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">Password
                                    </label>
                                    <input id="password" type="password" name="password" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="name_en"
                                           class="mr-sm-2">password confirmation
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation" required >
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">mobile
                                    </label>
                                    <input id="mobile" type="text" name="mobile" class="form-control" required>
                                </div>

                            </div>

                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal"> <i class="fa-solid fa-xmark"></i>close</button>
                                <button type="submit"
                                        class="btn btn-success">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- row closed -->
@endsection
@section('js')

@endsection
