@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')


    <div class="section"></div>

    <div class="container">

        <div class="card horizontal">
            <div class="card-image">
                <div>
                </div>
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div id="playlistNameBlock">
                        <h4 id="album_name_field">{{$playlist->name}}
                            <a class="right btn-floating waves-effect waves-light blue">
                                <i id="test" onclick="playlistNameEditForm()" class="small material-icons">mode_edit</i>
                            </a>
                            <h6>{{ $playlist->description }}</h6>
                        </h4>
                    </div>

                    <script>

                    function playlistNameEditForm() {

                      $("#test").click(function(){
                        $("#playlistNameBlock").attr('style', 'display:none');
                        $("#playlistDescriptionBlock").attr('style', 'display:none');
                        $("#playlistForm").removeAttr("style");
                      })}

                    </script>

                    {!!  Form::open(['route' => ['playlist.update', $playlist->id],'id' => 'playlistForm','class' => 'form-horizontal col s12 hidden', 'style' => 'display:none'])  !!}
                    <div class="row" style="margin-bottom: 0;">
                        <div class="input-field col s12 {{ $errors->has('playlist_name') ? ' has-error' : '' }}">
                            <input id="playlist_name" type="text" class="form-control col s5"  placeholder="Name" name="playlist_name" value="{{ $playlist->name }}" style="font-size: 2.28rem;padding-left: 0;">



                            @if ($errors->has('playlist_name'))
                                <span class="left help-block red-text">
                                        <strong>{{ $errors->first('playlist_name') }}</strong>
                                        </span>
                            @endif

                            <button id="test" type="submit" class="right btn-floating waves-effect waves-light blue">
                                <i class="small material-icons">save</i>
                            </button>

                        </div>

                        <div class="input-field col s12 {{ $errors->has('playlist_description') ? ' has-error' : '' }}">
                            <input id="playlist_description" placeholder="Description" type="text" class="form-control col s5" name="playlist_description" value="{{ $playlist->description }}" style="font-size: 1rem;padding-left: 0;">



                            @if ($errors->has('playlist_description'))
                                <span class="left help-block red-text">
                                        <strong>{{ $errors->first('playlist_description') }}</strong>
                                        </span>
                            @endif


                        </div>


                    </div>
                    {{ Form::close() }}




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
                            @foreach($playlist->audio as $song)
                                <tr>
                                    <td><i id="play-{{ $song->id }}" style="cursor: pointer;" class="dropdown-button small material-icons">play_circle_outline</i></td>
                                    <td>{{ $song->tracknumber }}</td>
                                    <td>{{ $song->title }} @if ($song->explicit)<i class="tiny material-icons">explicit</i>@endif</td>
                                    <td>{{ $song->artist }}</td>
                                    <td>{{ gmdate("i:s",$song->length) }}</td>
                                    <td>{{ $song->year }}</td>
                                    <td><i data-activates='dropdown-{{ $song->id }}' style="cursor: pointer;" class="dropdown-button small material-icons">more_vert</i></td>
                                    <td> {!! Form::open(['route'=> ['playlist.remove',$song->pivot->id],'method' => 'DELETE']) !!}
                                    <button class="red-text right"><i class="tiny material-icons">clear</i></button>

                                    {{ Form::close() }}</td>

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
                                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                                        <a class="modal-action modal-close btn-flat">No</a>

                                        {!! Form::open(['method' => 'DELETE','route' => ['myaudio.destroy', $song->id]]) !!}
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

@endsection