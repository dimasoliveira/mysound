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
                        <i>{{ implode(', ',$album->year) }}</i>
                        @elseif(count($album->year) > 1)
                        <i>{{ min($album->year).' - '. max($album->year)}}</i>
                        @endif
                        <i>{{' • '.implode(', ',$album->genres )}}</i>

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
                                @foreach($album->audio as $audio)
                                    <tr>
                                        <td><i data-id="{{ $audio->id }}" style="cursor: pointer;" class="playable-link small material-icons">play_circle_outline</i></td>
                                        <td>{{ $audio->tracknumber }}</td>
                                        <td>{{ $audio->title }} @if ($audio->explicit)<i class="tiny material-icons">explicit</i>@endif</td>
                                        <td>{{ $audio->artist }}</td>
                                        <td>{{ gmdate("i:s",$audio->length) }}</td>
                                        <td>{{ $audio->year }}</td>
                                        <td><i data-activates='dropdown-{{ $audio->id }}' style="cursor: pointer;" class="dropdown-button small material-icons">more_vert</i></td>
                                    </tr>

                                    <ul style="z-index: 100000" id='dropdown-{{ $audio->id }}' class='dropdown-content'>
                                        <li><a href="#editAudio" class="edit-audio" data-id="{{ $audio->id }}" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-tracknumber="{{ $audio->tracknumber }}" data-album="{{ $audio->album->name }}" data-explicit="{{ $audio->explicit }}" data-published="{{ $audio->published }}" data-year="{{ $audio->year }}" data-genre="{{ $audio->genre->name }}">Edit</a></li>
                                         @foreach($playlists as $playlist)
                                            <li>
                                            {!! Form::open(['method' => 'POST','route' => ['playlist.request',$playlist,$audio]]) !!}

                                            {{  Form::submit('Add to '.$playlist->name, ['class' => 'btn-flat'])}}
                                            <a type="submit" href="">Add to {{ $playlist->name }}</a>

                                            {!! Form::close() !!}
                                            </li>
                                         @endforeach
                                        <li><a href="#delete-{{$audio->id}}" id="testtest">Delete</a></li>
                                    </ul>

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