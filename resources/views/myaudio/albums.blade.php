@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="{{ route('myaudio.playlist.index') }}">Playlists</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('myaudio.albums') }}">Albums</a></li>
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

                @foreach($albums as $album)

            <div class="col s3 m3">

              <div class="card hoverable">

                  <div class="card-image waves-effect waves-block waves-light">
                      <span style="right: 0!important; top:0; height: 0;" class="card-title activator grey-text text-darken-4"><i class="material-icons">more_vert</i></span>
                      <a href="{{route('myaudio.album.show', $album->slug)}}">
                          <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png" id="img-preview" style="height: auto;width: 100%">

                      </a>
                  </div>

                      <div class="card-content" style="padding: 6px">
                          <p class="card-title" style="color: black;">{{ $album->name }}<br>{{ $album->artist }}</p>
                          <p class="card-title" style="color: black;">{{ $album->artist }}</p>
                      </div>

                  <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">{{ $album->title }}<i class="material-icons right">close</i></span>
                      <p>Artist: {{ $album->artist }}</p>
                      <p>Tracks: {{ count($album->audio) }}</p>
                      <p>Year: {{ $album->year }}</p>
                  </div>
              </div>
        </div>

        @endforeach

    </div>
</div>

@endsection
