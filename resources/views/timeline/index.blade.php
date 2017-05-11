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

    @foreach($posts as $audio)
        <main>
            <div class="section"></div>
                <div class="container">

                    <div class="col s12 m7">


                        <div class="card horizontal activator">
                            <div class="card-image waves-effect waves-block waves-light"><a class="black-text" href="{{ route('audio.show',$audio->id) }}">
                                    <img src="{{ Storage::url($audio->coverart) }}" class="activator" style="height: auto;width: 180px"></a>
                                <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio->id }}' data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                            </div>
                            <div class="card-stacked">


                                    <div class="card-content">
                                    <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($audio->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $audio->user->slug) }}">{{$audio->user->username }}</a>
                                    </h6>
                                        <a class="black-text" href="{{ route('audio.show',$audio->id) }}">
                                    <p class="card-title grey-text text-darken-4">{{ $audio->title }}</p>
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

                </div>
        </main>

    @endforeach




@endsection

