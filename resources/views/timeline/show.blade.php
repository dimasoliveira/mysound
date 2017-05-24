@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">

            <li class="flex-item valign tab"><a href="{{ route('profile.show', Auth::user()->slug) }}"></a></li>
        </ul>

    </div>
@endsection

@section('content')


        <main>
            <div class="section"></div>
            <div class="container">

                <div class="col s12 m7">
                    <div class="card horizontal activator">
                        <div class="card-image waves-effect waves-block waves-light">
                            <span style="right: 0!important; top:0; height: 0;" class="card-title grey-text text-darken-4 dropdown-button" data-activates='dropdown-{{ $audio->id }}'><i class="material-icons">more_vert</i></span>

                            <img src="{{ Storage::url($audio->coverart) }}" class="activator" style="height: auto;width: 180px">
                            <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio->id }}' data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                        </div>
                        <!-- Dropdown Structure -->
                        <ul style="z-index: 100000" id='dropdown-{{ $audio->id }}' class='dropdown-content'>
                            <li><a href="#editAudio" class="edit-audio" data-id="{{ $audio->id }}" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-tracknumber="{{ $audio->tracknumber }}" data-album="{{ $audio->album->name }}" data-explicit="{{ $audio->explicit }}" data-published="{{ $audio->published }}" data-year="{{ $audio->year }}" data-genre="{{ $audio->genre->name }}">Edit</a></li>

                        @foreach(Auth::user()->playlists as $playlist)

                                {!! Form::open(['method' => 'POST','route' => ['playlist.request',$playlist->id,$audio->id]]) !!}

                                <li><a type="submit" href="">Add to {{ $playlist->name }}</a></li>
                                {!! Form::close() !!}

                            @endforeach
                            <li><a href="#delete-{{$audio->id}}" id="testtest">Delete</a></li>
                        </ul>
                        <div class="card-stacked">
                            <div class="card-content">
                                <h6 class="right header">uploaded {{ \Carbon\Carbon::createFromTimeStamp(strtotime($audio->created_at))->diffForHumans() .' by '}} <a class="blue-text" href="{{ route('profile.show', $audio->user->slug) }}">{{$audio->user->username }}</a>
                                </h6>

                                <p class="card-title grey-text text-darken-4">{{ $audio->title }}</p>
                                <p>Artist: {{ $audio->artist }}</p>  <p class="blue-text right">{{  count($audio->likes).' Like(s)' }}</p>
                                <p>Album: {{ $audio->album->name }}</p>

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

                        <div id="delete-{{$audio->id}}" class="modal">
                            <div class="modal-content">
                                <h5>Are you sure you want to delete <b>{{ $audio->title}}</b> by <b>{{$audio->artist}}</b>?</h5>
                            </div>
                            <div class="modal-footer">
                                {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>--}}
                                <a class="modal-action modal-close btn-flat">No</a>

                                {!! Form::open(['method' => 'DELETE','route' => ['myaudio.destroy', $audio->id]]) !!}
                                {{  Form::submit('Yes', ['class' => 'modal-action btn-flat'])}}
                                {!! Form::close() !!}

                            </div>
                        </div>



                    </div>

                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header active"><i class="material-icons">comment</i>Comments <b>({{ count($audio->comments) }})</b></div>
                            <div class="collapsible-body" style="display: block;padding-bottom: 0;padding-top: 0;">
                                <ul class="collection">
                                @foreach($audio->comments as $comment)

                                    <li class="collection-item avatar" style="min-height:0!important;">
                                        <img src="@if(!empty(Storage::exists($comment->user->avatar) )) {{ Storage::url($comment->user->avatar) }} @else {{ Storage::url('public/defaults/avatar.png') }}  @endif" alt="" class="circle">
                                        @if($comment->user->id == Auth::user()->id || $audio->user->id == Auth::user()->id)
                                            {!! Form::open(['route'=> ['comment.destroy',$comment->id],'method' => 'DELETE']) !!}
                                                <button class="red-text right"><i class="tiny material-icons">clear</i></button>

                                            {{ Form::close() }}

                                        @endif
                                        <p class="right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans()}}
                                            <i class="material-icons tiny">access_time</i></p>

                                        <p><b><a class="black-text" href="{{ route('profile.show', $comment->user->slug) }}">{{$comment->user->username }}</a></b> <br>
                                            {{$comment->text}}
                                        </p>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="input-field">
                                {!! Form::open(['route'=> ['comment.store',$audio->id],'method' => 'POST','style' => 'padding-left: 30px;padding-top: 0px;padding-right: 30px;']) !!}
                                <div class="row" style="margin:15px;">
                                    <input id="commentField" type="text" class="validate col s11" name="comment" placeholder="Leave a comment..." style="padding:0">
                                    <button type="submit" role="button" id="likeButton" class="hoverable btn-floating btn-medium waves-effect waves-light blue right"><i class="material-icons large">send</i></button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </main>






@endsection

