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
                            <div class="card horizontal hoverable activator">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img src="{{ Storage::url($post->coverart) }}" class="activator" style="height: auto;width: 200px">
                                    <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $post->id }}' class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>


                                </div>
                                   <div class="card-stacked">
                                    <div class="card-content">
                                        <p class="card-title grey-text text-darken-4">{{ $post->title }}</p>
                                        <p>Artist: {{ $post->artist }}</p>
                                        <p>Album: {{ $post->album->name }}</p>


                                    </div>
                                       <ul data-id='{{ $post->id }}' id="playlist-item" hidden>
                                           <li><a href="{{ Storage::url($post->filename) }}"><b>{{ $post->artist }}</b> - {{ $post->title }} @if($post->explicit)<span class="label">Explicit</span>@endif</a></li>
                                       </ul>


                                    <div class="card-action">
                                        <h6 class="header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $post->user->slug) }}">{{$post->user->username }}</a>
                                        </h6>
                                         </div>
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

