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
                                        {{ Form::submit('Unfollow',['class'=> 'waves-effect waves-light btn']) }}
                                    @else
                                        {{ Form::submit('Follow', ['class'=> 'waves-effect waves-light btn']) }}
                                    @endif
                                    {{ Form::close() }}
                                @endif
                            </div>

                                <figure class="card-profile-image">
                                    @if ($user->id == Auth::user()->id)

                                    <a id="avatarEdit" class="btn-floating btn-small waves-effect waves-light left blue" style="position: absolute">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a hidden id="saveButton" class="btn-small" style="position: absolute;">
                                        <i class="small material-icons">save</i>
                                    </a>

                                    @endif
                                    <img id="avatarUser" src="@if (!empty(Storage::exists($user->avatar) )) {{ Storage::url($user->avatar) }} @else {{ Storage::url('public/defaults/avatar.png') }}  @endif" class="circle z-depth-2 responsive-img">
                                    {{--https://thumb9.shutterstock.com/display_pic_with_logo/1375510/221431012/stock-vector-male-avatar-profile-picture-vector-illustration-eps-221431012.jpg--}}
                                </figure>

                            {!! Form::open(['route' => ['avatar.update', $user->slug],'method' => 'POST','id' => 'avatarForm','files' => 'true']) !!}

                            <input id="avatarInput" hidden name="avatar" type="file" value="test">
                            {{--{{ Form::submit('',['hidden','id' => 'coverartSubmit']) }}--}}
                            <button hidden type="submit"></button>

                            {!! Form::close() !!}
                        </div>

                        <div class="card-content">
                            <div class="row">

                                <div class="col s2">
                                    <h4 class="card-title grey-text text-darken-4">{{ $user->firstname }} {{ $user->lastname }}</h4>
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
                                    <h4 class="card-title grey-text text-darken-4">{{ count($user->audio) }}</h4>
                                    <p class="medium-small grey-text">Posts</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>


                @foreach($posts as $post)
                      <div class="col s12 m7">
                            <div class="card horizontal hoverable activator">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img src="{{ Storage::url($post->coverart) }}" class="activator" style="height: auto;width: 215px">
                                    <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $post->id }}' data-filename="{{ Storage::url($post->filename) }}" data-artist="{{ $post->artist }}" data-title="{{ $post->title }}" data-explicit="{{$post->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $post->user->slug) }}">{{$post->user->username }}</a>
                                        </h6>
                                        <a class="black-text" href="{{ route('audio.show',$post->id) }}">
                                            <p class="card-title grey-text text-darken-4">{{ $post->title }}</p>
                                            <p>Artist: {{ $post->artist }}</p>  <p class="blue-text right">{{  count($post->likes).' Like(s), '.count($post->comments).' Comment(s)' }}</p>
                                            <p>Album: {{ $post->album->name }}</p>
                                        </a>
                                    </div>

                                    <div class="card-action" style="padding-top: 0px;margin-top: 10px;">

                                        <div class="input-field right">

                                            {!! Form::open(['route'=> ['like.create',$post->id],'method' => 'POST', 'id' => 'likeForm']) !!}

                                            @if (\App\Like::where('user_id', Auth::user()->id)->where('audio_id', $post->id)->exists())
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
                </div>
            <br><br>


        </div>
    </div>
        <script src="{{ asset('js/profileShow.js') }}"></script>
@endsection
