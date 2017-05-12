@extends('admin.index')

@section('content')

    @if(session('toast'))


        <div id="snackbar"><span>{{ session('toast') }}</span></div>

        <script>
          $( document ).ready(function() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
          });
        </script>

    @endif

        <div class="container-fluid">

            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                            <div class="block-header">
                                <h2>You're <b>editing</b> the <b>{{$role->name}}</b> role</h2>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="large material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a data-toggle="modal" data-target="#myModal">Delete <b>{{ $role->display_name }}</b> role</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>


                        {{--<!-- Trigger the modal with a button -->--}}
                        {{--<button type="button" class="btn btn-info btn-lg" ">Open Modal</button>--}}

                        <!-- Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">You're about to delete a role</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the <b>{{ $role->display_name }}</b> role?</p>
                                    </div>
                                    <div class="modal-footer">

                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.role.destroy', $role->id]]) !!}
                                        {{  Form::submit('Yes', ['class' => 'btn btn-danger waves-effect'])}}

                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                        {!! Form::close() !!}

                                    </div>
                                </div>

                            </div>
                        </div>



                        <div class="body">


                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">

                                {{ Form::model($role,  ['route' => ['admin.role.update',$role->id]]) }}



                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $role->name }}"/>
                                        </div>

                                        @if ($errors->has('name'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="display_name" placeholder="Display name" value="{{ $role->display_name }}"/>
                                        </div>
                                        @if ($errors->has('display_name'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('display_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="description" placeholder="Description" value="{{ $role->description }}"/>
                                        </div>
                                        @if ($errors->has('description'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input id="{{ $permission->id }}" type="checkbox" @if (!empty($role_permissions)) @if (in_array($permission->id, $role_permissions))checked="" @endif @endif class="form-control filled-in" name="permissions[]" value="{{ $permission->id }}">
                                                <label for="{{ $permission->id }}">{{ $permission->display_name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{ Form::submit('Save', ['class' => 'btn btn-success waves-effect right']) }}
                                </div>
                                {{ Form::close() }}
                            </div>
                    </div>
                </div>
            </div>
            <!--#END# DateTime Picker -->
        </div>

@endsection