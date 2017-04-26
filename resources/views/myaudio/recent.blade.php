@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Playlists</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.albums') }}">Albums</a></li>
        </ul>

    </div>
@endsection


@section('content')

        <div class="container">
            <div class="row">

                @foreach($audio_posts as $audio_post)
                    <div class="col s3 m3">

                        <div class="card hoverable">

                            <div class="card-image waves-effect waves-block waves-light">

                                <span style="right: 0!important; top:0; height: 0;" class="card-title grey-text text-darken-4 dropdown-button" data-activates='dropdown-{{ $audio_post->id }}'><i class="material-icons">more_vert</i></span>

                                <span class="z-depth-2 card-title activator" style="color: white;background-color: rgba(0,0,0,0.18);width: 100%;padding-top: 0;padding-bottom: 0">{{ $audio_post->title }}<br>{{ $audio_post->artist }} </span>
                                <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio_post->id }}' class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                                {{--<span id="play-{{ $audio_post->id }}" style="right: 0!important; bottom:0; margin: 10px; padding: 0;" class="card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>--}}
                                <img class="activator" src="{{ Storage::url($audio_post->coverart) }}" style="height: auto;width: 100%">

                            </div>

                            <!-- Dropdown Structure -->
                            <ul style="z-index: 100000" id='dropdown-{{ $audio_post->id }}' class='dropdown-content'>
                                <li><a href="{{ route('myaudio.edit',$audio_post->id) }}">Edit</a></li>
                                <li><a href="#!">two</a></li>
                                <li><a href="#modal{{ $audio_post->id }}">Delete</a></li>

                            </ul>
                            <ul style="display: none" data-id='{{ $audio_post->id }}' id="playlist-item">
                                <li><a href="{{ Storage::url($audio_post->filename) }}"><b>{{ $audio_post->artist }}</b> - {{ $audio_post->title }} @if($audio_post->explicit)<span class="label">Explicit</span>@endif</a></li>
                            </ul>

                            <div id="modal{{ $audio_post->id }}" class="modal">
                                <div class="modal-content">
                                    <h5>Are you sure you want to delete <b>{{ $audio_post->title}}</b> by <b>{{$audio_post->artist}}</b>?</h5>
                                </div>
                                <div class="modal-footer">
                                    {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>--}}
                                    <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>

                                    {!! Form::open(['method' => 'DELETE','route' => ['myaudio.destroy', $audio_post->id]]) !!}
                                    {{  Form::submit('Yes', ['class' => 'modal-action waves-effect waves-green btn-flat'])}}
                                    {!! Form::close() !!}

                                </div>
                            </div>

                            <div class="card-content" style="padding: 0;line-height: 0;">


                            </div>

                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{ $audio_post->title }}<i class="material-icons right">close</i></span>
                                <p>Artist: {{ $audio_post->artist }}</p>
                                <p>Album: <a href="{{ route("myaudio.album.show",$audio_post->album->slug) }}">{{ $audio_post->album->name }}</a></p>
                                <p>Year: {{ $audio_post->year }}</p>
                            </div>
                        </div>
                    </div>
            @endforeach
    </div>
</div>


<script>

$(function () {


         $(".playable-link").click(function(){
           var music_id = $(this).data('id');
            var music_item = $('ul[data-id="'+ music_id +'"]').html();

            $(".sm2-playlist-bd").html(music_item);

           window.sm2BarPlayers[0].playlistController.playItemByOffset();
  });

});
</script>

@endsection
