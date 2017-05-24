@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="{{ route('playlist.index') }}">Playlists</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.albums') }}">Albums</a></li>
        </ul>

    </div>
@endsection


@section('content')

        <div class="container">
            <div class="row">

                @if(!$audio_posts->isEmpty())
                    @foreach($audio_posts as $audio_post)
                    <div class="col s3 m3">

                        <div class="card hoverable">

                            <div class="card-image waves-effect waves-block waves-light">

                                <span style="right: 0!important; top:0; height: 0;" class="card-title grey-text text-darken-4 dropdown-button" data-activates='dropdown-{{ $audio_post->id }}'><i class="material-icons">more_vert</i></span>

                                <span class="z-depth-2 card-title activator" style="color: white;background-color: rgba(0,0,0,0.18);width: 100%;padding-top: 0;padding-bottom: 0">{{ $audio_post->title }}<br>{{ $audio_post->artist }} </span>
                                <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio_post->id }}' data-filename="{{ Storage::url($audio_post->filename) }}" data-artist="{{ $audio_post->artist }}" data-title="{{ $audio_post->title }}" data-explicit="{{$audio_post->explicit}}" class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                                {{--<span id="play-{{ $audio_post->id }}" style="right: 0!important; bottom:0; margin: 10px; padding: 0;" class="card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>--}}
                                <img src="@if (!empty(Storage::exists($audio_post->coverart) )) {{ Storage::url($audio_post->coverart) }} @else {{ Storage::url('public/defaults/coverart.png') }}  @endif" class="activator circle z-depth-2 responsive-img" id="img-preview" style="height: auto;width: 100%">

                            </div>

                            <!-- Dropdown Structure -->
                            <ul style="z-index: 100000" id='dropdown-{{ $audio_post->id }}' class='dropdown-content'>
                                <li><a href="#editAudio" class="edit-audio" data-id="{{ $audio_post->id }}" data-title="{{ $audio_post->title }}" data-artist="{{ $audio_post->artist }}" data-tracknumber="{{ $audio_post->tracknumber }}" data-album="{{ $audio_post->album->name }}" data-explicit="{{ $audio_post->explicit }}" data-published="{{ $audio_post->published }}" data-year="{{ $audio_post->year }}" data-genre="{{ $audio_post->genre->name }}">Edit</a></li>
                                @foreach($playlists as $playlist)
                                    <li>
                                        {!! Form::open(['method' => 'POST','route' => ['playlist.request',$playlist,$audio_post]]) !!}

                                        {{  Form::submit('Add to '.$playlist->name, ['class' => 'btn-flat'])}}
                                        {!! Form::close() !!}
                                    </li>
                                @endforeach
                                <li><a href="#modal{{ $audio_post->id }}">Delete</a></li>

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

                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{ $audio_post->title }}<i class="material-icons right">close</i></span>
                                <p>Artist: {{ $audio_post->artist }}</p>
                                <p>Album: <a href="{{ route("myaudio.album.show",$audio_post->album->slug) }}">{{ $audio_post->album->name }}</a></p>
                                <p>Year: {{ $audio_post->year }}</p>
                            </div>
                        </div>



                    </div>
                    @endforeach
                @else
                    <ul class="collection">
                        <li class="collection-item">You don't have added any music at te moment, click <a href="#addAudio">here</a> to upload some music.</li>
                    </ul>
                @endif
    </div>
</div>




@endsection
