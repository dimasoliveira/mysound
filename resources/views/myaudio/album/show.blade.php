@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')


@if ($errors->has('album_name'))
<script>
          $( document ).ready(function() {
            var $toastContent = $('<span>{{ $errors->first('album_name') }}</span>');
                Materialize.toast($toastContent, 5000);
});
</script>
    @endif

    @if ($errors->has('coverart'))
        <script>
          $( document ).ready(function() {
            var $toastContent = $('<span>{{ $errors->first('coverart') }}</span>');
            Materialize.toast($toastContent, 5000);
          });
        </script>
    @endif


    @if(session()->has('validation-error'))

        <script>
          $(document).ready(function(){
            $('#edit-{{ session()->get('validation-error') }}').modal().modal('open');
          });</script>
    @endif


    <div class="section"></div>

    <div class="container">

        <div class="card horizontal">
            <div class="card-image">
                <img id="img-preview" src="{{ Storage::url($album->coverart) }}" style="width: 300px;height: 300px; background-image: url(https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png)">
                <span id="albumcoverOptions" style="right: 0!important; top:0; height: 0;" class="card-title activator grey-text text-darken-4">
                    <a id="albumcoverEdit" class="right btn-floating waves-effect waves-light blue"><i class="small material-icons">mode_edit</i></a>
                    <a hidden id="saveButton" class=""><i class="small material-icons">save</i></a>

                </span>

                {!! Form::open(['route' => ['myaudio.album.update', $album->slug],'method' => 'POST','id' => 'coverartForm','files' => 'true']) !!}

                <input id="coverart" hidden name="coverart" type="file" value="test">
                {{--{{ Form::submit('',['hidden','id' => 'coverartSubmit']) }}--}}
                <button hidden id="coverartSubmit" type="submit">
                </button>

                {!! Form::close() !!}

            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div id="albumNameBlock">
                        <h4 id="album_name_field">{{$album->name}}
                            <a class="right btn-floating waves-effect waves-light blue">
                                <i id="test" class="small material-icons">mode_edit</i>
                            </a>
                        </h4>
                    </div>

                    {!!  Form::open(['route' => ['myaudio.album.update', $album->slug],'id' => 'albumNameForm','class' => 'form-horizontal col s12 hidden', 'style' => 'display:none'])  !!}
                    <div class="row" style="margin-bottom: 0;">
                        <div class="input-field col s12 {{ $errors->has('album_name') ? ' has-error' : '' }}">
                                <input id="album_name" type="text" class="form-control col s5" name="album_name" value="{{ $album->name }}" style="font-size: 2.28rem;padding-left: 0;">



                            @if ($errors->has('album_name'))
                                    <span class="left help-block red-text">
                                        <strong>{{ $errors->first('album_name') }}</strong>
                                        </span>
                                @endif

                            <button id="test" type="submit" class="right btn-floating waves-effect waves-light blue">
                                <i class="small material-icons">save</i>
                            </button>
                            </div>
                    </div>

                    {{ Form::close() }}

                    <h6>
                        {{implode(', ',$album->artist )}}
                    </h6>

                        @if (count($album->year) === 1)
                        <i>{{ implode(', ',$album->year).' •' }}</i>
                        @elseif(count($album->year) > 1)
                        <i>{{ min($album->year).' - '. max($album->year . ' •')}}</i>
                        @endif
                        <i>{{implode(', ',$album->genres )}}</i>

                    <div class="row">

                        <table class="highlight">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nr.</th>
                                <th>Name</th>
                                <th>Artist</th>
                                <th>Length</th>
                                <th>Year</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($album->audio as $song)
                                    <tr>
                                        <td><i data-id="{{ $song->id }}" style="cursor: pointer;" class="playable-link small material-icons">play_circle_outline</i></td>
                                        <td>{{ $song->tracknumber }}</td>
                                        <td>{{ $song->title }} @if ($song->explicit)<i class="tiny material-icons">explicit</i>@endif</td>
                                        <td>{{ $song->artist }}</td>
                                        <td>{{ gmdate("i:s",$song->length) }}</td>
                                        <td>{{ $song->year }}</td>
                                        <td><i data-activates='dropdown-{{ $song->id }}' style="cursor: pointer;" class="dropdown-button small material-icons">more_vert</i></td>
                                    </tr>

                                    <ul style="z-index: 100000" id='dropdown-{{ $song->id }}' class='dropdown-content'>
                                        <li><a href="#edit-{{$song->id}}">Edit</a></li>
                                        @foreach($playlists as $playlist)

                                            {!! Form::open(['method' => 'POST','route' => ['playlist.request',$playlist,$song]]) !!}

                                            <li><a type="submit" href="">Add to {{ $playlist->name }}</a></li>
                                            {!! Form::close() !!}

                                         @endforeach
                                        <li><a href="#delete-{{$song->id}}" id="testtest">Delete</a></li>
                                    </ul>

                                    <div id="delete-{{$song->id}}" class="modal">
                                        <div class="modal-content">
                                            <h5>Are you sure you want to delete <b>{{ $song->title}}</b> by <b>{{$song->artist}}</b>?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>--}}
                                            <a class="modal-action modal-close btn-flat">No</a>

                                            {!! Form::open(['method' => 'DELETE','route' => ['myaudio.destroy', $song->id]]) !!}
                                            {{  Form::submit('Yes', ['class' => 'modal-action btn-flat'])}}
                                            {!! Form::close() !!}

                                        </div>
                                    </div>

                                    <div id="edit-{{$song->id}}" class="modal modal-fixed-footer" style="width: 30%;">
                                        <div class="modal-content" style="padding-top: 15px;padding-bottom: 15px;">
                                            {!!  Form::open(['route' => ['myaudio.update', $song->id],'class' => 'form-horizontal col s12', 'files' => true])  !!}



                                            <div class="row">

                                                <div class="input-field col s2 form-group{{ $errors->has('tracknumber') ? ' has-error' : '' }}">
                                                    <input id="tracknumber" type="text" class="form-control" name="tracknumber" value="{{ $song->tracknumber }}" >

                                                    <label for="tracknumber">Nr.</label>

                                                    @if ($errors->has('tracknumber'))
                                                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                                                    @endif
                                                </div>

                                                <div class="input-field col s10 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                    <input id="title" type="text" class="form-control" name="title" value="{{ $song->title }}" >

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
                                                    <input id="artist" type="text" class="form-control" name="artist" value="{{ $song->artist }}" >
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
                                                    <input id="album" type="text" class="form-control" name="album" value="{{ $song->album->name }}" >
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
                                                    <input id="genre" type="text" class="form-control" name="genre" value="{{ $song->genre }}" >
                                                    <label for="genre">Genre</label>

                                                    @if ($errors->has('genre'))
                                                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                                                    @endif

                                                </div>

                                                <div class="input-field col s2 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                                    <input id="year" type="text" class="form-control" name="year" value="{{ $song->year }}">
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
                                                        @if ($song->published == 1)
                                                            <input title="published" type="checkbox" class="filled-in" checked="checked" id="published" name="published">
                                                        @else
                                                            <input title="published" type="checkbox" id="published" class="filled-in" name="published">
                                                        @endif
                                                        <label for="published">Delen met anderen</label>
                                                    </p>


                                                    <p class="right">
                                                        @if ($song->explicit == 1)
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

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{--<script>--}}

      {{--$(function () {--}}

        {{--@foreach($album->audio as $song)--}}

             {{--$("#play-{{ $song->id }}").click(function(){--}}
          {{--$(".sm2-playlist-bd").html('<ul class="sm2-playlist-bd"><li><a href="{{ Storage::url($song->filename) }}"><b>{{ $song->artist }}</b> - {{ $song->title }}@if($song->explicit)<span class="label">Explicit</span>@endif</a></li></ul>');--}}
          {{--window.sm2BarPlayers[0].playlistController.playItemByOffset();--}}
        {{--});--}}
          {{--@endforeach--}}

      {{--});--}}
    {{--</script>--}}



    <script src="{{ asset('js/albumShow.js') }}"></script>



    @endsection