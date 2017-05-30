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


        <main>


            <div class="section"></div>
                <div class="container">
                    @if (!$posts->isEmpty())
                    @foreach($posts as $audio)
                    <div class="col s12 m7">


                        <div class="card horizontal activator">
                            <div class="card-image waves-effect waves-block waves-light">
                                <span style="top:0; height: 0;" class="card-title grey-text text-darken-4 dropdown-button" data-activates='dropdown-{{ $audio->id }}'><i class="material-icons">more_vert</i></span>


                                    <!-- Dropdown Structure -->
                                    <ul id='dropdown-{{ $audio->id }}' class='dropdown-content'>
                                        <li><a class="addToPlaylist" href="#addToPlaylist" data-id="{{ $audio->id }}">Add to playlist..</a></li>

                                        @if ($audio->user_id == Auth::user()->id)
                                            <li><a href="#editAudio" class="edit-audio" data-id="{{ $audio->id }}" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-tracknumber="{{ $audio->tracknumber }}" data-album="{{ $audio->album->name }}" data-explicit="{{ $audio->explicit }}" data-published="{{ $audio->published }}" data-year="{{ $audio->year }}" data-genre="{{ $audio->genre->name }} ">Edit track</a></li>
                                            <li><a href="#modal{{ $audio->id }}">Delete track</a></li>

                                        @endif


                                    </ul>
                                    <img src="{{ Storage::url($audio->coverart) }}" class="activator" style="height: auto;width: 180px"></a>
                                <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-url="{{ route('log.index') }}" data-id='{{ $audio->id }}' data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                            </div>

                            <div class="card-stacked">


                                    <div class="card-content">
                                    <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($audio->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $audio->user->slug) }}">{{$audio->user->username }}</a>
                                    </h6>
                                        <a class="black-text" href="{{ route('audio.show', [$audio->user->slug,$audio->id]) }}">
                                    <p class="card-title grey-text text-darken-4">{{ $audio->title }} @if ($audio->explicit)<i title="This song contains strong language." class="tiny material-icons">explicit</i> @endif </p>
                                    <p>Artist: {{ $audio->artist }}</p>  <p class="blue-text right">{{  count($audio->likes).' Like(s), '.count($audio->comments).' Comment(s)' }}</p>
                                    <p>Album: {{ $audio->album->name }}</p>

                                    </a>
                                </div>

                                <div class="card-action" style="padding-top: 0px;margin-top: 10px;">

                                    <div class="input-field right">

                                        {!! Form::open(['route'=> ['like.create',$audio->id],'method' => 'POST', 'id' => 'likeForm']) !!}

                                        @if (\App\Like::where('user_id', Auth::user()->id)->where('audio_id', $audio->id)->exists())
                                            <button type="submit" role="button" id="likeButton" class="col s2 hoverable btn-floating btn-medium waves-effect waves-light blue right"><i class="material-icons">favorite</i></button>
                                        @else
                                            <button type="submit" role="button" id="likeButton" class="col s2 hoverable btn-floating btn-medium waves-effect waves-light white blue-text right"> <i class="material-icons" style="color: #2196F3;">favorite_border</i></button>
                                        @endif

                                        {{ Form::close() }}

                                    </div>
                                </div>




                            </div>
                            </div>

                    </div>
                    @endforeach
                    @else
                        <ul class="collection">
                            <li class="collection-item">You don't have any timeline feed yet, follow some people to fill your timeline</li>
                        </ul>
                    @endif


                </div>

        </main>





@endsection

