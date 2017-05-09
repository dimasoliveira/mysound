@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')

    <script src="https://rawgit.com/icefox0801/materialize-autocomplete/master/jquery.materialize-autocomplete.js"></script>

    <script src="https://rawgit.com/opoloo/jquery_upload_preview/master/assets/js/jquery.uploadPreview.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $.uploadPreview({
          input_field: "#filename",
          preview_box: "#audio-preview",
          no_label: true
        });
      });
    </script>


    <center>

        @if(session('message'))
            <script>
              $( document ).ready(function() {
                var $toastContent = $('<span>{{ session('message') }}</span>');
                Materialize.toast($toastContent, 5000);
              });
            </script>
        @endif

        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE; min-width: 75%!important;max-width: 75%!important;">

                {!! Form::open(['route'=>'myaudio.store', 'files' => true , 'class' => 'form-horizontal col s12']) !!}

                {{ csrf_field() }}

                <div class="row">
                        <div class="card col s5">
                            <div class="card-image">
                                <img style="width: 300px; height: auto" id="img-preview" src="#" >
                            </div>
                            <div id="audio-preview">
                                <div >No file selected</div>
                            </div>
                        </div>
                </div>

                <div class="row">

                    <div class="input-field col s2 form-group{{ $errors->has('tracknumber') ? ' has-error' : '' }}">
                        <input id="tracknumber" type="text" class="form-control" name="tracknumber" value="{{ old('tracknumber') }}" >

                        <label for="tracknumber">Nr.</label>

                        @if ($errors->has('tracknumber'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="input-field col s10 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
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
                    <div class="input-field col s6 form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                        <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" >
                        <label for="artist">Artist *</label>

                        @if ($errors->has('artist'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="input-field col s6 form-group{{ $errors->has('album') ? ' has-error' : '' }}">
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
                    <div class="input-field col s10 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                        <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}" >
                        <label for="genre">Genre</label>

                        @if ($errors->has('genre'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                        @endif

                    </div>
                    <div class="input-field col s2 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
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

                    <div class="file-field input-field col s6">
                        <div class="btn waves-effect blue">
                            <span>Audio</span>
                            <input id="filename" name="filename" type="file">
                        </div>

                        @if ($errors->has('filename'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('filename') }}</strong>
                                    </span>
                        @endif
                    </div>



                    <div class="file-field input-field col s6">
                        <div class="btn waves-effect blue">
                            <span>Coverart</span>
                            <input id="coverart" name="coverart" type="file">

                        </div>

                        @if ($errors->has('coverart'))
                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('coverart') }}</strong>
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
                        <button type="submit" class="col s12 btn btn-large waves-effect blue">Upload</button>
                    </div>
                </center>
                {{ Form::close() }}
            </div>
        </div>

    </center>
    <script src="{{ asset('js/img-preview.js') }}"></script>
    <div class="section"></div>
    <div class="section"></div>


@endsection



