@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="{{ route('search.request') }}">Search</a></li>
            <li class="flex-item valign tab"><a target="_self" href="{{ route('timeline.show') }}">Timeline</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('profile.show', Auth::user()->slug) }}">Profile</a></li>
        </ul>

    </div>
@endsection

@section('content')

    <div id="profile" class="col s12">
        <div class="container">
            <div class="section">
                <div class="row">
                    <div id="profile-page-header" class="card">
                        <div class="card-image waves-effect waves-block waves-light light-blue">


                            <img class="activator banner-image" style="position: absolute!important;@if(!empty(Storage::exists($user->avatar) ))background: url('{{ Storage::url($user->avatar) }}'); background-size: cover; @endif">

                            <div class="col s2 right-align right follow-button">
                                @if ($user->id !== Auth::user()->id)
                                    {!! Form::open(['route'=> ['follow.request',$user->slug],'method' => 'POST']) !!}
                                    @if (Auth::user()->isFollowing($user->id))
                                        {{ Form::submit('Unfollow',['class'=> 'waves-effect waves-light btn blue white-text']) }}
                                    @else
                                        {{ Form::submit('Follow', ['class'=> 'waves-effect waves-light btn white blue-text']) }}
                                    @endif
                                    {{ Form::close() }}
                                @endif
                            </div>

                                <figure class="card-profile-image">
                                    @if ($user->id == Auth::user()->id || Auth::user()->hasRole('superadmin'))

                                    <a id="avatarEdit" class="btn-floating btn-small waves-effect waves-light left blue" style="position: absolute">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a hidden id="saveButton" class="btn-small" style="position: absolute;">
                                        <i class="small material-icons">save</i>
                                    </a>

                                    @endif
                                    <img id="avatarUser" src="@if (!empty(Storage::exists($user->avatar) )) {{ Storage::url($user->avatar) }} @else {{ Storage::url('public/defaults/avatar.png') }}  @endif" class="circle z-depth-2 responsive-img">
                                </figure>

                            {!! Form::open(['route' => ['avatar.update', $user->slug],'method' => 'POST','id' => 'avatarForm','files' => 'true']) !!}

                            <input id="avatarInput" hidden name="avatar" type="file" value="test">
                            {{--{{ Form::submit('',['hidden','id' => 'coverartSubmit']) }}--}}
                            <button hidden type="submit"></button>

                            {!! Form::close() !!}
                        </div>

                        <div class="card-content">
                            <div class="row">


                                <div class="col s6">
                                    {!!  Form::open(['route' => ['name.update', $user->slug],'id' => 'nameForm','class' => 'form-horizontal col s12 hidden', 'style' => 'display:none'])  !!}


                                    <div class="row">
                                        <div class="input-field {{ $errors->has('firstname') ? ' has-error' : '' }}">

                                        <input id="firstname" type="text" class="form-control col s4" name="firstname" placeholder="Firstname" value="{{ $user->firstname }}" style="font-size: 1.2rem;padding-left: 0;">

                                        @if ($errors->has('firstname'))
                                            <span class="left help-block red-text">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                        @endif

                                        </div>
                                    </div>
                                    <div class="row">

                                    <div class="input-field {{ $errors->has('lastname') ? ' has-error' : '' }}">

                                        <input id="lastname" type="text" class="form-control col s4" name="lastname" placeholder="Lastname" value="{{ $user->lastname }}" style="font-size: 1.2rem;padding-left: 0;">

                                        @if ($errors->has('lastname'))
                                            <span class="left help-block red-text">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                        <button id="test" type="submit" class="left btn-floating waves-effect waves-light blue">
                                            <i class="small material-icons">save</i>
                                        </button>
                                    </div>
                                    {{ Form::close() }}
                                    <h4 class="card-title grey-text text-darken-4" id="nameBlock">{{ $user->firstname }} {{ $user->lastname }}
                                        @if ($user->id == Auth::user()->id || Auth::user()->hasRole('superadmin'))

                                            <a id="nameEdit" class="btn-floating btn-small waves-effect waves-light left blue">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a hidden id="saveButton" class="btn-small" style="position: absolute;">
                                                <i class="small material-icons">save</i>
                                            </a>

                                        @endif
                                    </h4>
                                    <p class="medium-small grey-text">{{ $user->username }}</p>
                                </div>

                                <div class="col s2 center-align right">
                                    <h4 class="card-title grey-text text-darken-4">{{ count($user->followers) }}</h4>
                                    <p class="medium-small grey-text">Followers</p>
                                </div>
                                <div class="col s2 center-align right">
                                    <h4 class="card-title grey-text text-darken-4">{{ count($user->followings) }}</h4>
                                    <p class="medium-small grey-text">Following</p>
                                </div>
                                <div class="col s2 center-align right">
                                    <h4 class="card-title grey-text text-darken-4">{{ count($user->audio_published) }}</h4>
                                    <p class="medium-small grey-text">Tracks</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


               @if (!$audios->isEmpty())
                      <div class="col s12 m7">
                          @foreach($audios as $audio)
                            <div class="card horizontal hoverable activator">

                                <div class="card-image waves-effect waves-block waves-light">
                                    <span style="top:0; height: 0;" class="card-title grey-text text-darken-4 dropdown-button" data-activates='dropdown-{{ $audio->id }}'><i class="material-icons">more_vert</i></span>

                                    <!-- Dropdown Structure -->
                                    <ul id='dropdown-{{ $audio->id }}' class='dropdown-content'>
                                        <li><a class="addToPlaylist" href="#addToPlaylist" data-id="{{ $audio->id }}">Add to playlist..</a></li>

                                        @if ($audio->user_id == Auth::user()->id)
                                        <li><a href="#editAudio" class="edit-audio" data-id="{{ $audio->id }}" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-tracknumber="{{ $audio->tracknumber }}" data-album="{{ $audio->album->name }}" data-explicit="{{ $audio->explicit }}" data-published="{{ $audio->published }}" data-year="{{ $audio->year }}" data-genre="{{ $audio->genre->name }} ">Edit</a></li>
                                        <li><a href="#modal{{ $audio->id }}">Delete</a></li>

                                        @endif


                                    </ul>

                                    <img src="@if (!empty(Storage::exists($audio->coverart) )) {{ Storage::url($audio->coverart) }} @else {{ Storage::url('public/defaults/coverart.png') }}  @endif" class="circle z-depth-2 responsive-img" style="height: auto;width: 180px">
                                    <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio->id }}' data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}" data-url="{{ route('log.index') }}" class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($audio->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $audio->user->slug) }}">{{$audio->user->username }}</a>
                                        </h6>
                                        <a class="black-text" href="{{ route('audio.show',[$audio->user->slug,$audio->id]) }}">
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
                    @endforeach
                              @elseif ($user->id == Auth::user()->id)
                                  <ul class="collection">
                                      <li class="collection-item">You don't have shared any music yet, click <a href="#addAudio">here</a> to upload some music and select <i>share with others</i> to get your music published</li>
                                  </ul>
                                  @else

                                  <ul class="collection">
                                      <li class="collection-item"><b>{{$user->username}}</b> didn't share any music yet. You can <b>follow</b> him to stay updated for upcoming uploads.</li>
                                  </ul>

                              @endif

                      </div>
            <br><br>


        </div>
    </div>
        <script src="{{ asset('js/profileShow.js') }}"></script>
@endsection
