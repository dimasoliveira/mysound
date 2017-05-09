@extends('admin.index')

@section('content')

    @if(session('toast'))


        <div id="snackbar"><span>{{ session('toast') }}</span</div>

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
                                <h2>Add new role: <b></b></h2>
                            </div>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="large material-icons">more_vert</i>
                                    </a>

                                </li>
                            </ul>
                        </div>


                        {{--<!-- Trigger the modal with a button -->--}}
                        {{--<button type="button" class="btn btn-info btn-lg" ">Open Modal</button>--}}

                        <!-- Modal -->


                        <div class="body">


                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">

                                {!!  Form::open(['route' => ['admin.role.store']])  !!}

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}"/>
                                        </div>

                                        @if ($errors->has('name'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="display_name" placeholder="Display name" value="{{ old('display_name') }}"/>
                                        </div>
                                        @if ($errors->has('display_name'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('display_name') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="description" placeholder="Description" value="{{ old('description') }}"/>
                                        </div>
                                        @if ($errors->has('description'))
                                            <span style="float: left; color: red" class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @foreach($permissions as $permission)
                                            <input id="{{ $permission->id }}" type="checkbox" class="form-control filled-in" name="permissions[]" value="{{ $permission->id }}">
                                            <label for="{{ $permission->id }}">{{ $permission->display_name }}</label><br>
                                        @endforeach
                                    </div>


                                    {{ Form::submit('Save') }}
                                </div>



                                {{ Form::close() }}
                            </div>


                    </div>
                </div>
            </div>
            <!--#END# DateTime Picker -->
        </div>

@endsection