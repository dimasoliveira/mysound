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
                                    <img src="{{ Storage::url($post->coverart) }}" class="activator" style="height: auto;width: 215px">
                                    <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $post->id }}' data-filename="{{ Storage::url($post->filename) }}" data-artist="{{ $post->artist }}" data-title="{{ $post->title }}" data-explicit="{{$post->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>


                                </div>
                                   <div class="card-stacked">
                                    <div class="card-content">
                                        <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $post->user->slug) }}">{{$post->user->username }}</a>
                                        </h6>
                                        <p class="card-title grey-text text-darken-4">{{ $post->title }}</p>
                                        <p>Artist: {{ $post->artist }}</p>
                                        <p>Album: {{ $post->album->name }}</p>


                                    </div>
                                       <ul data-id='{{ $post->id }}' id="playlist-item" hidden>
                                           <li><a href="{{ Storage::url($post->filename) }}"><b>{{ $post->artist }}</b> - {{ $post->title }} @if($post->explicit)<span class="label">Explicit</span>@endif</a></li>
                                       </ul>


                                    <div class="card-action"style="padding-top: 0px;padding-bottom: 0px;">

                                        <div class="row s12">
                                        <div class="input-field col s11">
                                            <input id="commentField" type="text" class="validate" placeholder="Leave a comment..." style="margin-bottom: 0;">
                                        </div>

                                            <div class="input-field col s1">
                                            <a class="btn-floating btn-medium waves-effect waves-light white blue-text right" style="box-shadow: 0px 0px 0px transparent"><i class="material-icons">thumb_up</i></a>
                                        </div>


                                        </div>
                                         </div>
                            </div>
                            </div>
                    </div>
                </div>
        </main>

    @endforeach

@endsection

