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
                            <li><a href="#edit-{{$audio->id}}">Edit</a></li>
                            @foreach(Auth::user()->playlists as $playlist)

                                {!! Form::open(['method' => 'POST','route' => ['playlist.request',$playlist,$song]]) !!}

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

                        <div id="edit-{{$audio->id}}" class="modal modal-fixed-footer" style="width: 30%;">
                            <div class="modal-content" style="padding-top: 15px;padding-bottom: 15px;">
                                {!!  Form::open(['route' => ['myaudio.update', $audio->id],'class' => 'form-horizontal col s12', 'files' => true])  !!}



                                <div class="row">

                                    <div class="input-field col s2 form-group{{ $errors->has('tracknumber') ? ' has-error' : '' }}">
                                        <input id="tracknumber" type="text" class="form-control" name="tracknumber" value="{{ $audio->tracknumber }}" >

                                        <label for="tracknumber">Nr.</label>

                                        @if ($errors->has('tracknumber'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="input-field col s10 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <input id="title" type="text" class="form-control" name="title" value="{{ $audio->title }}" >

                                        <label for="title">Title *</label>

                                        @if ($errors->has('title'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12 form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                                        <input id="artist" type="text" class="form-control" name="artist" value="{{ $audio->artist }}" >
                                        <label for="artist">Artist *</label>

                                        @if ($errors->has('artist'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="input-field col s12 form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                                        <input id="album" type="text" class="form-control" name="album" value="{{ $audio->album->name }}" >
                                        <label for="album">Album</label>

                                        @if ($errors->has('album'))
                                            <span class="left help-block red-text">
                                                            <strong>{{ $errors->first('album') }}</strong>
                                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s10 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                        <input id="genre" type="text" class="form-control" name="genre" value="{{ $audio->genre }}" >
                                        <label for="genre">Genre</label>

                                        @if ($errors->has('genre'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                        @endif

                                    </div>

                                    <div class="input-field col s2 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                        <input id="year" type="text" class="form-control" name="year" value="{{ $audio->year }}">
                                        <label for="year">Year </label>

                                        @if ($errors->has('year'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="file-field input-field">
                                        <div class="btn waves-effect blue">
                                            <span>Coverart</span>
                                            <input id="coverart" name="coverart" type="file" >
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" value="{{ old('coverart') }}">
                                        </div>
                                        @if ($errors->has('coverart'))
                                            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('coverart') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="file-field input-field">


                                        <p class="left">
                                            @if ($audio->published == 1)
                                                <input title="published" type="checkbox" class="filled-in" checked="checked" id="published" name="published">
                                            @else
                                                <input title="published" type="checkbox" id="published" class="filled-in" name="published">
                                            @endif
                                            <label for="published">Delen met anderen</label>
                                        </p>


                                        <p class="right">
                                            @if ($audio->explicit == 1)
                                                <input title="explicit" type="checkbox" class="filled-in" id="explicit" checked="checked" name="explicit">
                                            @else
                                                <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">
                                            @endif
                                            <label for="explicit">Explicit</label>
                                        </p>
                                    </div>
                                </div>

                                <br/>

                            </div>

                            <button type="submit" class="modal-footer col s12 btn btn-large waves-effect blue">Save</button>

                            {{ Form::close() }}
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
                                {!! Form::open(['route'=> ['comment.create',$audio->id],'method' => 'POST','style' => 'padding-left: 30px;padding-top: 0px;padding-right: 30px;']) !!}
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

