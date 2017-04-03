@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')

<style>
        .autocomplete {
            display: -ms-flexbox;
            display: flex;
        }
        .autocomplete .ac-users {
            padding-top: 10px;
        }
        .autocomplete .ac-users .chip {
            -ms-flex: auto;
            flex: auto;
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .autocomplete .ac-users .chip:last-child {
            margin-right: 5px;
        }
        .autocomplete .ac-dropdown .ac-hover {
            background: #eee;
        }
        .autocomplete .ac-input {
            -ms-flex: 1;
            flex: 1;
            min-width: 150px;
            padding-top: 0.6rem;
        }
        .autocomplete .ac-input input {
            height: 2.4rem;
        }
    </style>



    <script src="https://icefox0801.github.io/materialize-autocomplete/jquery.materialize-autocomplete.js"></script>

    <script>
      $(function () {

        var autocomplete = $('#genre').materialize_autocomplete({
            limit: 20,
            multiple: {
              enable: true,
              maxSize: 10,
              onExist: function (item) { /* ... */ },
              onExceed: function (maxSize, item) { /* ... */ }
            },
            appender: {
              el: '.ac-users'
            },
            dropdown: {
              el: '#genre_dropdown'
          },
            getData: function (value, callback) {
              // ...
              console.log(value);

              callback(value,  [
                {'id': 1, 'text': 'Abe'},
                {'id': 2, 'text': 'Ari'},
                {'id': 3, 'text': 'Baz'}

                ]);
            }
          });

        autocomplete.getData = getData;
      });


    </script>

    <center>

        @if(session()->has('message'))
            <div class="alert alert-success">

                <div style="width: 30%;background-color: rgba(0,238,0,0.66);color:white;" class="chip">
                    {{ session()->get('message') }}
                    <i class="close material-icons">close</i>
                </div>

                {{--<script>--}}
                {{--var $toastContent = $('<span>{{ session()->get('message') }}</span>');--}}
                {{--Materialize.toast($toastContent, 5000);--}}
                {{--</script>--}}

            </div>
        @endif
            <div class="section"></div>

            <div class="container">





                <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">



                    {!! Form::open(['route'=>'myaudio.add', 'files' => true , 'class' => 'form-horizontal col s12']) !!}

                        {{ csrf_field() }}



                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" >

                                <label for="title">Title *</label>

                                @if ($errors->has('title'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                                <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" >
                                <label for="artist">Artist *</label>

                                @if ($errors->has('artist'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                                <input id="album" type="text" class="form-control" name="album" value="{{ old('album') }}" >
                                <label for="album">Album</label>

                                @if ($errors->has('album'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('album') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="row">
                        <div class="input-field col s12 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                            <div class="autocomplete" id="multiple">
                                <div class="ac-users ac-appender"></div>
                                <div class="ac-input">
                                    <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}" placeholder="Please input some letters" data-activates="genre_dropdown" data-beloworigin="true" autocomplete="off"><ul id="genre_dropdown" class="dropdown-content ac-dropdown" style="width: 1280px; position: absolute; top: 45px; left: 11.25px; opacity: 1; display: none;"></ul>
                                    <input type="hidden" class="validate" value=""></div>

                                <input type="hidden" name="multipleHidden">
                            </div>
                            <label class="active" for="genre">Genre: </label>
                        </div>
                        @if ($errors->has('genre'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                        @endif
                    </div>

                        <div class="row">
                            <div class="input-field col s6 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}">
                                <label for="genre">Genre </label>

                                @if ($errors->has('genre'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s6 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">
                                <label for="year">Year </label>

                                @if ($errors->has('year'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn waves-effect blue">
                                    <span>Audio</span>
                                    <input id="filename" name="filename" type="file" >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="We only support MP3 files at the moment" value="{{ old('filename') }}">
                                </div>
                                @if ($errors->has('filename'))
                                    <span class="left help-block red-text">
                                    <strong>{{ $errors->first('filename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="row">
                        <div class="file-field input-field">

                            <p class="left">
                                <input title="published" type="checkbox" class="filled-in" id="published" name="published">
                                <label for="published">Delen met anderen</label>
                            </p>

                            <p class="right">
                                <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">
                                <label for="explicit">Explicit</label>
                            </p>

                        </div>


                    </div>
                    <div class="row">
                        <div class="file-field input-field">

                            <p class="left">
                                <input title="private" type="checkbox" class="filled-in" id="private" name="private">
                                <label for="private">Toevoegen aan Mijn Audio</label>
                            </p>



                        </div>


                    </div>



                    {{--<div class="row right">--}}
                        {{--<div class="file-field input-field">--}}
                            {{--<p>--}}
                                {{--<input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />--}}
                                {{--<label for="filled-in-box">Explicit</label>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                        <br/>
                        <center>
                            <div class="row">
                                <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect blue">Upload</button>
                            </div>
                        </center>
                    {{ Form::close() }}
                </div>
            </div>

        </center>

        <div class="section"></div>
        <div class="section"></div>


@endsection