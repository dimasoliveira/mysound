@extends('admin.index')

@section('content')



    @if(session('toast'))

        <div class="alert alert-success alert-dismissable">
            <strong>Success! </strong>{{ session('toast') }}
        </div>


    @endif

    <div class="container-fluid">

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <div class="block-header">
                            <h2>You're editing user: <b>{{ $user->username }}</b></h2>
                        </div>

                        <ul class="header-dropdown m-r--5">

                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="large material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a data-toggle="modal" data-target="#myModal">Delete user <b>{{ $user->username }}</b></a></li>
                                </ul>
                            </li>


                        </ul>

                    </div>


                {{--<!-- Trigger the modal with a button -->--}}
                {{--<button type="button" class="btn btn-info btn-lg" ">Open Modal</button>--}}

                <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">


                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">User Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete <b>{{ $user->username }}</b>?</p>
                                </div>
                                <div class="modal-footer">

                                    {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->slug]]) !!}
                                    {{  Form::submit('Yes', ['class' => 'btn btn-danger waves-effect'])}}

                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                    {!! Form::close() !!}

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="body">

                        {{ Form::submit('Save', ['class' => 'btn btn-primary waves-effect right', 'form' => 'userForm']) }}
                        <h2 class="card-inside-title"></h2>
                        <div class="row clearfix">

                            {!!  Form::open(['route' => ['admin.users.store', $user->slug], 'id' => 'userForm'])  !!}

                            <div class="col-sm-12">

                                <div class="form-group">
                                    <div><b>Username:</b></div>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $user->username }}"/>
                                    </div>

                                    @if ($errors->has('username'))
                                        <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div><b>Firstname:</b></div>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="{{ $user->firstname }}"/>
                                    </div>
                                    @if ($errors->has('firstname'))
                                        <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div><b>Lastname:</b></div>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ $user->lastname }}"/>
                                    </div>
                                    @if ($errors->has('lastname'))
                                        <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div><b>Emailaddress:</b></div>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $user->email}}"/>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                    @endif
                                </div>



                                <div class="form-group">
                                    <div><b>Birthdate:</b></div>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="birthdate" placeholder="Birthdate" value="{{ $user->birthdate}}"/>
                                    </div>
                                    @if ($errors->has('birthdate'))
                                        <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('birthdate') }}</strong>
                                                </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <b>Role:</b>
                                        <select class="selectpicker" id="selectpicker" name="role" data-live-search="true">
                                            <option value="{{$user->roles->first()->id}}">{{$user->roles->first()->name}} (Current)</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('role'))
                                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <!--#END# DateTime Picker -->
        </div>


@endsection