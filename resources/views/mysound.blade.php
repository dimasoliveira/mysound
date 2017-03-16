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


            @foreach($audio_posts as $audio_post)

                <div class="sm2-bar-ui compact flat">

                    <div class="bd sm2-main-controls">

                        <div class="sm2-inline-texture"></div>
                        <div class="sm2-inline-gradient"></div>

                        <div class="sm2-inline-element sm2-button-element">
                            <div class="sm2-button-bd">
                                <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
                            </div>
                        </div>

                        <div class="sm2-inline-element sm2-inline-status">

                            <div class="sm2-playlist">
                                <div class="sm2-playlist-target">
                                    <!-- playlist <ul> + <li> markup will be injected here -->
                                    <!-- if you want default / non-JS content, you can put that here. -->
                                    <noscript><p>JavaScript is required.</p></noscript>
                                </div>
                            </div>

                            <div class="sm2-progress">
                                <div class="sm2-row">
                                    <div class="sm2-inline-time">0:00</div>
                                    <div class="sm2-progress-bd">
                                        <div class="sm2-progress-track">
                                            <div class="sm2-progress-bar"></div>
                                            <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
                                        </div>
                                    </div>
                                    <div class="sm2-inline-duration">0:00</div>
                                </div>
                            </div>

                        </div>

                        <div class="sm2-inline-element sm2-button-element sm2-volume">
                            <div class="sm2-button-bd">
                                <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                                <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
                            </div>
                        </div>

                    </div>

                    <div class="bd sm2-playlist-drawer sm2-element">

                        <div class="sm2-inline-texture">
                            <div class="sm2-box-shadow"></div>
                        </div>

                        <!-- playlist content is mirrored here -->

                        <div class="sm2-playlist-wrapper">
                            <ul class="sm2-playlist-bd">
                                <li><a href="{{ asset($audio_post->audio) }}">{{ $audio_post->title }}</a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            <script>
              soundManager.setup({
                url: '{{ asset('swf/soundmanager2.swf') }}',
                flashVersion: 9, // optional: shiny features (default = 8)
                // optional: ignore Flash where possible, use 100% HTML5 mode
                // preferFlash: false,
                onready: function() {
                  // Ready to use; soundManager.createSound() etc. can now be called.
                }
              });
            </script>


            {{--<div class="card blue-grey darken-1">--}}
                {{--<div class="card-content white-text">--}}
                    {{--<div class="player">--}}
                        {{--<div class="player__audio-info">--}}
                            {{--{{ $audio_post->title }}<br>--}}
                            {{--{{ $audio_post->artist }}<br>--}}
                            {{--{{ $audio_post->album }}<br>--}}
                            {{--{{ $audio_post->year }}<br>--}}
                            {{--{{ $audio_post->title }}<br>--}}

                            {{--<div>--}}
                                {{--Played--}}
                                {{--<span class="player__time-elapsed">-</span> of--}}
                                {{--<span class="player__time-total">-</span>--}}
                                {{--<button class="player__previous button button--small">Move back</button>--}}
                                {{--<button class="player__next button button--small">Move forth</button>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--Volume: <span class="player__volume-info">100</span>--}}
                                {{--<button class="player__volume-down button button--small">Volume down</button>--}}
                                {{--<button class="player__volume-up button button--small">Volume up</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<button class="player__play button button--large">Play</button>--}}
                        {{--<button class="player__stop button button--large">Stop</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card-action">--}}
                    {{--<a href="#">This is a link</a>--}}
                    {{--<a href="#">This is a link</a>--}}
                {{--</div>--}}
            {{--</div>--}}
                @endforeach
        </div>
    </div>
@endsection
