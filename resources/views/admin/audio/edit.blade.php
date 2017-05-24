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
                                <h2>You're editing song: <b>{{ $audio->title }}</b> uploaded by <b>{{ $audio->user->username }}</b></h2>
                            </div>

                            <ul class="header-dropdown m-r--5">

                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="large material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a data-toggle="modal" data-target="#myModal">Delete song <b>{{ $audio->title }}</b></a></li>
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
                                        <h4 class="modal-title">Song Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the song <b>{{ $audio->title }}</b> uploaded by <b>{{ $audio->user->username }}</b>?</p>
                                    </div>
                                    <div class="modal-footer">




    {!! Form::open(['method' => 'DELETE','route' => ['admin.audio.destroy', $audio->id]]) !!}
                                        {{  Form::submit('Yes', ['class' => 'btn btn-danger waves-effect'])}}

                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                        {!! Form::close() !!}

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="body">

                            {{ Form::submit('Save', ['class' => 'btn btn-primary waves-effect right', 'form' => 'audioForm']) }}
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">

                                {!!  Form::open(['route' => ['admin.audio.update', $audio->id], 'id' => 'audioForm'])  !!}

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <div class="col-sm-1">
                                        <b>Nr:</b>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tracknumber" placeholder="Tracknumber" value="{{ $audio->tracknumber }}"/>
                                        </div>

                                            @if ($errors->has('tracknumber'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                                            @endif
                                    </div>
                                        <div class="col-sm-11">
                                        <b>Title:</b>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $audio->title }}"/>
                                        </div>

                                            @if ($errors->has('title'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                            @endif
                                        </div></div>


                                    <div class="form-group">
                                        <div class="col-sm-4">
                                        <b>Artist:</b>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="artist" placeholder="Artist" value="{{ $audio->artist }}"/>
                                        </div>
                                            @if ($errors->has('artist'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                            @endif
                                    </div>

                                        <div class="col-sm-5">
                                        <b>Album:</b>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="album" placeholder="Album" value="{{ $audio->album->name }}"/>
                                        </div>

                                            @if ($errors->has('album'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('album') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                </div>


                                    <div class="form-group">
                                    <div class="col-sm-2">


                                            <div class="form-line">
                                                <b>Genre:</b>
                                                <select class="selectpicker" id="selectpicker" name="genre" data-live-search="true">
                                                    <option value="{{$audio->genre->id}}">{{ $audio->genre->name }} (Current)</option>
                                                    @foreach($genres as $genre)
                                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                    @if ($errors->has('genre'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                            @endif
                                    </div>
                                        <div class="col-sm-1">

                                        <b>Year:</b>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="year" placeholder="Year" value="{{ $audio->year }}"/>
                                        </div>
                                            @if ($errors->has('year'))
                                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                        <b>Coverart:</b>
                                        <input id="coverart" name="coverart" type="file" value="{{ old('coverart') }}">


                                        @if ($errors->has('coverart'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('coverart') }}</strong>
                                    </span>
                                        @endif
                                        @if ($errors->has('coverart'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('coverart') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                        <div class="file-field input-field">
                                            <div class="col-sm-">
                                            <p class="left">
                                                @if ($audio->published == 1)
                                                    <input title="published" type="checkbox" class="filled-in" checked="checked" id="published" name="published">
                                                @else
                                                    <input title="published" type="checkbox" id="published" class="filled-in" name="published">
                                                @endif
                                                <label for="published">Published</label>
                                            </p>


                                            <p class="left">
                                                @if ($audio->explicit == 1)
                                                    <input title="explicit" type="checkbox" class="filled-in" id="explicit" checked="checked" name="explicit">
                                                @else
                                                    <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">
                                                @endif
                                                <label for="explicit">Explicit</label>
                                            </p>
                                        </div>
                                        </div>
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