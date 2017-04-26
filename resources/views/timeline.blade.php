@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="{{ route('search.request') }}">Search</a></li>
            <li class="flex-item valign tab"><a class="active" href="#timeline">Timeline</a></li>
            <li class="flex-item valign tab"><a href="{{ route('profile.show', Auth::user()->slug) }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')

    @foreach($posts as $post)
        <main>
            <div class="section"></div>
                <div class="container">
                    <div class="col s12 m7">
                        <div class="card hoverable">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img src="{{ Storage::url($post->coverart) }}" class="activator" style="height: auto;width: 150px">
                            </div>
                            <div class="card-content" style="padding: 0;line-height: 0;">
                                <span class="card-title activator" style="color: black;">{{ $post->title }}<br>{{ $post->artist }}</span>
                            </div>
                            <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">{{ $post->title }}<i class="material-icons right">close</i></span>
                                    <p>Artist: {{ $post->artist }}</p>
                                    <p>Album: {{ $post->album->name }}</p>
                                    <p>Year: {{ $post->year }}</p>
                                </div>
                            <div class="card-action">
                                <h6 class="header">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() .' by '. $post->user->username }}
                                </h6>
                                 </div>
                            </div>
                        </div>
        </div>
        </main>

    @endforeach

    <script>

      $(function () {

        @foreach($posts as $post)

              $("#play-{{ $post->id }}").click(function(){
          $(".sm2-playlist-bd").html('<ul class="sm2-playlist-bd"><li><a href="{{ Storage::url($post->filename) }}"><b>{{ $post->artist }}</b> - {{ $post->title }}@if($post->explicit)<span class="label">Explicit</span>@endif</a></li></ul>');
          window.sm2BarPlayers[0].playlistController.playItemByOffset();
        });
          @endforeach

      });
    </script>


@endsection

