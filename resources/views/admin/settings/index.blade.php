@extends('admin.index')

@section('content')

    @if(session('toast'))
        <script>
          $( document ).ready(function() {
            var $toastContent = $('<span>{{ session('toast') }}</span>');
            Materialize.toast($toastContent, 5000);
          });
        </script>
    @endif

    <div class="container-fluid">

        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">

                        <h2>
                            SETTINGS
                        </h2>

                    </div>

                    <div class="body">


                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse1">Upload limit</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse">

                                    <div class="panel-body">
                                        {!! Form::open(['method' => 'POST','route' => ['admin.uploadlimit.update'],'class' => 'form-horizontal']) !!}
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="selectpicker">  Change upload limit for:</label>
                                            <select class="selectpicker" id="selectpicker" name="user" data-live-search="true">
                                                <option value="all">All users</option>
                                                @foreach(\App\User::all() as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('user'))
                                                <span class="left help-block red-text">
                                        <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="uploadlimit">To:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="uploadlimit" type="text" name="uploadlimit" placeholder="Limit in seconds">
                                            </div>
                                            @if ($errors->has('uploadlimit'))
                                                <span class="left help-block red-text">
                                        <strong>{{ $errors->first('uploadlimit') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            {{ Form::submit('Update', ['class' => 'btn btn-primary waves-effect right', 'role' => 'button']) }}

                                        </div>

                                        {{ Form::close()}}
                                    </div>
                                    <div class="panel-footer"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection