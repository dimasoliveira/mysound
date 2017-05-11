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
                            <img src="{{ Storage::url($audio->coverart) }}" class="activator" style="height: auto;width: 180px">
                            <span style="right: 0!important; bottom:0; margin: 10px; padding: 0;" data-id='{{ $audio->id }}' data-filename="{{ Storage::url($audio->filename) }}" data-artist="{{ $audio->artist }}" data-title="{{ $audio->title }}" data-explicit="{{$audio->explicit}}"  class="playable-link card-title dropdown-button btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">play_arrow</i></span>
                        </div>
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
                    </div>

                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header active"><i class="material-icons">comment</i>Comments <b>({{ count($audio->comments) }})</b></div>
                            <div class="collapsible-body" style="display: block;padding-bottom: 0;padding-top: 0;">
                                <ul class="collection">
                                @foreach($audio->comments as $comment)

                                    <li class="collection-item avatar" style="min-height:0!important;">
                                        <img src="http://materializecss.com/images/yuna.jpg" alt="" class="circle">
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

