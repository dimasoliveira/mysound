@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a class="active" href="{{ route('playlist.index') }}">Playlists</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.albums') }}">Albums</a></li>
        </ul>


    </div>
@endsection


@section('content')

    <div class="container">

        <div class="row">


            @if (!$playlists->isEmpty())
                <ul class="collection with-header">
                @foreach($playlists as $playlist)
                        <a href="{{ route('playlist.show',$playlist->id) }}">
                            <li class="collection-header">
                                <h5>{{ $playlist->name }}</h5>
                                {{ $playlist->description }}
                                <span class="right">{{ count($playlist->audio) }} song(s) in this playlist</span>
                            </li>

                        </a>
                @endforeach
            @else
                        <ul class="collection">

                            <li class="collection-item">You don't have any playlists at the moment, click <a href="#addPlaylist">here</a> to ceate one</li>
                        </ul>
             @endif

            </ul>
        </div>
    </div>

@endsection
