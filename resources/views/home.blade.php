@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Search</a></li>
            <li class="flex-item valign tab"><a class="active" href="#timeline">Timeline</a></li>
            <li class="flex-item valign tab"><a href="{{ route('profile.show') }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')




    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <div class="player">
                        <div class="player__audio-info">
                            <div>
                                Played
                                <span class="player__time-elapsed">-</span> of
                                <span class="player__time-total">-</span>
                                <button class="player__previous button button--small">Move back</button>
                                <button class="player__next button button--small">Move forth</button>
                            </div>
                            <div>
                                Volume: <span class="player__volume-info">100</span>
                                <button class="player__volume-down button button--small">Volume down</button>
                                <button class="player__volume-up button button--small">Volume up</button>
                            </div>
                        </div>
                        <button class="player__play button button--large">Play</button>
                        <button class="player__stop button button--large">Stop</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#">This is a link</a>
                    <a href="#">This is a link</a>
                </div>
            </div>
        </div>
    </div>









@endsection
