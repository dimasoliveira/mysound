@extends('layouts.app')

@section('expanded-navbar')


@endsection

@section('content')



        <center>

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="section"></div>

            <div class="container">
                <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                    {!! Form::open(['route'=>'audio.add', 'files' => true , 'class' => 'form-horizontal col s12']) !!}

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
                                <input type="checkbox" class="filled-in" id="filled-in-box" name="explicit">
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