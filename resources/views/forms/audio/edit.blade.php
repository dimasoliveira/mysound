@extends('layouts.app')

@section('content')

    <main>
        <script src="https://rawgit.com/icefox0801/materialize-autocomplete/master/jquery.materialize-autocomplete.js"></script>

        <center>


            <div class="section"></div>

            <div class="section"></div>

            <div class="container">

                <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    {{--{!!  Form::open(['class' => 'form-horizontal col s12', 'files' => true], ['route' => ['myaudio.update', $audio->id]])  !!}--}}

                    //FORM RETURNEN MET OUDE INPUT DATA

                    {{ Form::model($audio,  ['route' => ['myaudio.update', $audio->id],'files' => true]) }}


                    <div class="row">

                        <div class="input-field col s2 form-group{{ $errors->has('tracknumber') ? ' has-error' : '' }}">
                            <input id="tracknumber" type="text" class="form-control" name="tracknumber" value="{{ $audio->tracknumber }}" >

                            <label for="tracknumber">Nr.</label>

                            @if ($errors->has('tracknumber'))
                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="input-field col s10 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input id="title" type="text" class="form-control" name="title" value="{{ $audio->title }}" >

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
                            <input id="artist" type="text" class="form-control" name="artist" value="{{ $audio->artist }}" >
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
                            <input id="album" type="text" class="form-control" name="album" value="{{ $audio->album->name }}" >
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
                            <input id="genre" type="text" class="form-control" name="genre" value="{{ $audio->genre }}" >
                            <label for="genre">Genre</label>

                            @if ($errors->has('genre'))
                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                            @endif

                        </div>

                            <div class="input-field col s2 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            <input id="year" type="text" class="form-control" name="year" value="{{ $audio->year }}">
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
                                <span>Coverart</span>
                                <input id="coverart" name="coverart" type="file" >
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" value="{{ old('coverart') }}">
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
                                @if ($audio->published == 1)
                                <input title="published" type="checkbox" class="filled-in" checked="checked" id="published" name="published">
                                @else
                                <input title="published" type="checkbox" id="published" class="filled-in" name="published">
                                @endif
                                <label for="published">Delen met anderen</label>
                            </p>


                            <p class="right">
                                @if ($audio->explicit == 1)
                                <input title="explicit" type="checkbox" class="filled-in" id="explicit" checked="checked" name="explicit">
                                @else
                                <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">
                                @endif
                                <label for="explicit">Explicit</label>
                            </p>
                        </div>
                    </div>

                    <br/>
                    <center>
                        <div class="row">
                            <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect blue">Save</button>
                        </div>
                    </center>
                    {{ Form::close() }}
                </div>
            </div>

        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>

@endsection