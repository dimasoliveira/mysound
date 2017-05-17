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

    @if(session('message'))
        <script>
          $( document ).ready(function() {
            var $toastContent = $('<span>{{ session('message') }}</span>');
            Materialize.toast($toastContent, 5000);
          });
        </script>
    @endif


    <div class="container">

        <div class="row">

            @foreach($playlists as $playlist)

                <div class="col s3 m3">

                    <div class="card hoverable">

                        <div class="card-image waves-effect waves-block waves-light">
                            <span style="right: 0!important; top:0; height: 0;" class="card-title activator grey-text text-darken-4"><i class="material-icons">more_vert</i></span>
                            <a href="{{ route('playlist.show',$playlist->id) }}">
                                <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png" style="height: auto;width: 100%">
                                <span class="card-title" style="color: black;">{{ $playlist->name }}</span>
                            </a>
                        </div>

                        <div class="card-content" style="padding: 0;line-height: 0;">
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
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>

@endsection
