@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')



    <div class="section"></div>

    <div class="container">

        <div class="card horizontal">
            <div class="card-image">
                <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png">

                <h6>Genre: <i>{{implode(', ',$album->genres )}}</i></h6>
                @if (count($album->year) === 1)
                    <h6>Year: <i>{{ implode(', ',$album->year) }}</i></h6>

                @elseif(count($album->year) > 1)
                    <h6>Year: <i>{{ min($album->year).' - '. max($album->year)}}</i></h6>
                @endif
                <div>


                </div>
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div id="albumNameBlock"><h4 id="album_name_field">{{$album->name}}<a class="right btn-floating waves-effect waves-light blue"><i id="test" onclick="albumNameEditForm()" class="small material-icons">mode_edit</i></a>
                    </h4></div><script>

                    function albumNameEditForm() {

                        $("#test").click(function(){
                          $("#albumNameBlock").attr('style', 'display:none');
                          $("#albumNameForm").removeAttr("style");
                      })}

                    </script>


                    {!!  Form::open(['route' => ['myaudio.album.update', $album->slug],'id' => 'albumNameForm','class' => 'form-horizontal col s12 hidden', 'style' => 'display:none'])  !!}
                        <div class="input-field form-group{{ $errors->has('album_name') ? ' has-error' : '' }}">

                            <input id="album_name" type="text" class="form-control col s5" name="album_name" value="{{ $album->name }}">
                            <a type="submit" class="right btn-floating waves-effect waves-light blue col s5 ">
                                <i id="test" onclick="albumNameEditForm()" class="small material-icons">save</i>
                            </a>


                        @if ($errors->has('album_name'))
                                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('album_name') }}</strong>
                                    </span>
                            @endif

                        </div>

                    {{ Form::submit() }}
                    {{ Form::close() }}

                    <h6>
                        {{implode(', ',$album->artist )}}
                        </h6>

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
                                        <td><i id="play-{{ $song->id }}" style="cursor: pointer;" class="dropdown-button small material-icons">play_circle_outline</i></td>
                                        <td>{{ $song->tracknumber }}</td>
                                        <td>{{ $song->title }} @if ($song->explicit)<i class="tiny material-icons">explicit</i>@endif</td>
                                        <td>{{ $song->artist }}</td>
                                        <td>{{ gmdate("i:s",$song->length) }}</td>
                                        <td>{{ $song->year }}</td>

                                        <td><i data-activates='dropdown-{{ $song->id }}' style="cursor: pointer;" class="dropdown-button small material-icons">more_vert</i></td>
                                    </tr>

                                    <ul style="z-index: 100000" id='dropdown-{{ $song->id }}' class='dropdown-content'>
                                        <li><a href="{{ route('myaudio.edit',$song->id) }}">Edit</a></li>
                                        <li><a href="#modal{{ $song->id }}">Delete</a></li>
                                    </ul>

                                    <div id="modal{{ $song->id }}" class="modal">
                                        <div class="modal-content">
                                            <h5>Are you sure you want to delete <b>{{ $song->title}}</b> by <b>{{$song->artist}}</b>?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>--}}
                                            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>

                                            {!! Form::open(['method' => 'DELETE','route' => ['myaudio.destroy', $song->id]]) !!}
                                            {{  Form::submit('Yes', ['class' => 'modal-action waves-effect waves-green btn-flat'])}}
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

    <script>

      $(function () {

        @foreach($album->audio as $song)

             $("#play-{{ $song->id }}").click(function(){
          $(".sm2-playlist-bd").html('<ul class="sm2-playlist-bd"><li><a href="{{ Storage::url($song->filename) }}"><b>{{ $song->artist }}</b> - {{ $song->title }}@if($song->explicit)<span class="label">Explicit</span>@endif</a></li></ul>');
          window.sm2BarPlayers[0].playlistController.playItemByOffset();
        });
          @endforeach

      });
    </script>

    @endsection