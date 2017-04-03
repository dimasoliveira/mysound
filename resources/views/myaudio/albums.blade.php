@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Playlists</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('myaudio.albums') }}">Albums</a></li>
        </ul>


    </div>
@endsection


@section('content')
    <a style="float: right;margin: 20px" class="btn-floating btn-large waves-effect waves-light blue" href="{{route('myaudio.add')}}"><i class="material-icons">add</i></a>
        <div class="container">

    <div class="row">

                @foreach($albums as $album)

            <div class="col s3 m3">

              <div class="card hoverable">

                  <div class="card-image waves-effect waves-block waves-light">
                      <span style="right: 0!important; top:0; height: 0;" class="card-title activator grey-text text-darken-4"><i class="material-icons">more_vert</i></span>
                      <a href="{{route('myaudio.album.show', $album->slug)}}">
                          <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png" style="height: auto;width: 100%">
                            <span class="card-title" style="color: black;">{{ $album->name }}<br>{{ $album->artist }}</span>
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

                  <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">{{ $album->title }}<i class="material-icons right">close</i></span>
                      <p>Artist: {{ $album->artist }}</p>
                      <p>Tracks: {{ count($album->audio) }}</p>
                      <p>Year: {{ $album->year }}</p>
                  </div>
              </div>
        </div>

            {{--<a class="gsm2-playable-link playing" data-source="{{ $audio_post->filename }}">klikhier</a>--}}

        @endforeach

    </div>
</div>

@endsection
