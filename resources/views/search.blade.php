@extends('layouts.app')

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
    @if(isset($audio_results))
    <h6>Audio Results</h6>
    <hr>
           <div class="row">
                    @foreach($audio_results as $result)

                        <div class="col s2 m2">
                            <div class="card hoverable">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <p class="z-depth-2 card-title activator" style="font-size: 15px!important; color: white;background-color: rgba(0,0,0,0.18);width: 100%;padding-top: 0;padding-bottom: 0">{{ $result->title }}<br>{{ $result->artist }} </p>
                                    <span data-id="{{ $result->id }}" style="right: 0!important; bottom:0; margin: 10px; padding: 0;" class="playable-link card-title btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                                    <img class="activator" src="{{ Storage::url($result->coverart) }}" style="height: auto;width: 100%">
                                </div>
                                <div class="card-content" style="padding: 0;line-height: 0;">
                                </div>
                                <ul data-id='{{ $result->id }}' id="playlist-item" hidden>
                                    <li><a href="{{ Storage::url($result->filename) }}"><b>{{ $result->artist }}</b> - {{ $result->title }} @if($result->explicit)<span class="label">Explicit</span>@endif</a></li>
                                </ul>
                                <div class="card-reveal">
                                    <p class="grey-text text-darken-4">{{ $result->title }}<i class="material-icons right">close</i></p>
                                    <p>Artist: <br>{{ $result->artist }}</p>
                                    <p>Album: <br><a href="{{ route("myaudio.album.show",$result->album->slug) }}">{{ $result->album->name }}</a></p>
                                    <p>Year: <br>{{ $result->year }}</p>
                                </div>
                                <div class="card-action">
                                    <h6 class="header">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($result->created_at))->diffForHumans() .' by '. $result->user->username }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

    @endif


    @if(isset($user_results))
    <h6>User Results</h6>
    <hr>

    @foreach($user_results as $result)
        <div class="row">
            <div class="col s12 m12">
                <div class="card blue-grey darken-1"> {{ Storage::url($result->username) }}
                </div>
            </div>
        </div>
    @endforeach
        @endif
</div>



@endsection