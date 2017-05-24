@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/search.css') }}" type="text/css" rel="stylesheet"/>

@endsection

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a class="active" href="#test1">Search</a></li>
            <li class="flex-item valign tab"><a target="_self" href="{{ route('timeline.show') }}">Timeline</a></li>
            <li class="flex-item valign tab"><a href="{{ route('profile.show', Auth::user()->slug) }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <nav>
                    <div class="nav-wrapper">

                        {!! Form::open(['route'=>'search.request']) !!}

                        {{ csrf_field() }}

                        <div class="input-field light-blue">
                                <input name="search" id="search" type="search" required>
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                <i class="material-icons">close</i>
                            </div>
                        {{ Form::close() }}
                    </div>
                </nav>
            </div>
        </div>
    </div>
    @if(isset($audios))
    <h6>Audio Results</h6>
    <hr>
           <div class="row">
                    @foreach($audios as $audio)

                        <div class="col s2 m2">
                            <div class="card hoverable">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <p class="z-depth-2 card-title" >{{ $audio->title }}<br>{{ $audio->artist }} </p>
                                    <span data-id="{{ $audio->id }}" data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}" class="playable-link card-title btn-floating btn-large waves-effect waves-light blue right">
                                        <i class="large material-icons">play_arrow</i>
                                    </span>
                                    <img src="{{ Storage::url($audio->coverart) }}">
                                </div>

                                <div class="card-action">
                                    <h6 class="header">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($audio->created_at))->diffForHumans() .' by ' }} <a class="blue-text" href="{{ route('profile.show', $audio->user->slug) }}">{{$audio->user->username }}</a>
                                    </h6>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    @endif


    @if(isset($users))
    <h6>User Results</h6>
    <hr>
        <div class="row">
    @foreach($users as $user)

                <a href="{{ route('profile.show', $user->slug) }}">
                    <div class="col s2 m2">
                        <div class="card hoverable" style="border-radius: 100%;">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img style="border-radius: 100%" src="@if(!empty(Storage::exists($user->avatar) )) {{ Storage::url($user->avatar) }} @else {{ Storage::url('public/defaults/avatar.png') }}  @endif">
                            </div>
                        </div>
                        <p style="text-align: center"><a href="{{ route('profile.show', $user->slug) }}" class="blue-text">{{$user->username }}</a></p>
                    </div>
                </a>
    @endforeach
        @endif

    @if(!isset($audios) && !isset($users) && isset($request))

            <ul class="collection">
                <li class="collection-item">No results where found for <b>{{ $request->search }}</b></li>
            </ul>

        <h4></h4>

        @endif
        </div>
</div>



@endsection