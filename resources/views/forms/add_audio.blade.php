@extends('layouts.app')

@section('expanded-navbar')


@endsection

@section('content')



        <center>

            <div class="section"></div>

            <div class="container">
                <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    {!! Form::open(['route'=>'audio.add', 'files' => true , 'class' => 'form-horizontal col s12']) !!}
                    {{--<form class="2" role="form" method="POST" action="{{ route('audio.add') }}" files="true">--}}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col s12">
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>

                                <label for="title">Title *</label>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                                <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" required>
                                <label for="artist">Artist *</label>

                                @if ($errors->has('artist'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                                <input id="album" type="text" class="form-control" name="album" value="{{ old('album') }}" required>
                                <label for="album">Album *</label>

                                @if ($errors->has('album'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('album') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s6 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}">
                                <label for="genre">Genre </label>

                                @if ($errors->has('genre'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s6 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">
                                <label for="year">Year </label>

                                @if ($errors->has('year'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn waves-effect blue">
                                    <span>File</span>
                                    <input id="file" name="file" type="file" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="file-field input-field">

                            <div class='switch left'>
                                <label>
                                    Public
                                    <input name='private' type='hidden' value='0'>
                                    <input name='private' type='checkbox' checked value='1'>
                                    <span class='lever'></span>
                                    Private
                                </label>
                            </div>


                            <p class="right">
                                <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" name="explicit">
                                <label for="filled-in-box">Explicit</label>
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