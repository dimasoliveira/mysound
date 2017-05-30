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

                        <h4 id="album_name_field"> {{$playlist->name}}
                            <a class="right btn-floating waves-effect waves-light blue">
                                <i id="test" onclick="playlistNameEditForm()" class="small material-icons">mode_edit</i>
                            </a>


                            <h6>{{ $playlist->description }}</h6>
                        </h4>
                        <a id="playlistPlay" class="left btn-floating waves-effect waves-light blue">
                            <i class="small material-icons">play_arrow</i>
                        </a>
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
                                <th>Uploaded by</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($playlist->audio as $audio)
                                <tr class="playlistItem" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-explicit="{{ $audio->explicit }}" data-filename="{{ Storage::url($audio->filename) }}">
                                    <td><i class="playable-link dropdown-button small material-icons blue-text" style="cursor: pointer;" data-title="{{ $audio->title }}" data-artist="{{ $audio->artist }}" data-explicit="{{ $audio->explicit }}" data-filename="{{ Storage::url($audio->filename) }}">play_circle_outline</i></td>
                                    <td>{{ $audio->tracknumber }}</td>
                                    <td>{{ $audio->title }} @if ($audio->explicit)<i title="This song contains strong language." class="tiny material-icons blue-text">explicit</i>@endif</td>
                                    <td>{{ $audio->artist }}</td>
                                    <td>{{ gmdate("i:s",$audio->length) }}</td>
                                    <td>{{ $audio->year }}</td>
                                    <td><a href="{{ route('profile.show',$audio->user->slug) }}">{{ $audio->user->username }}</a></td>
                                    <td><i data-activates='dropdown-{{ $audio->id }}' style="cursor: pointer;" class="dropdown-button small material-icons">more_vert</i></td>
                                </tr>

                                <ul id='dropdown-{{ $audio->id }}' class='dropdown-content'>

                                    {!! Form::open(['route'=> ['playlist.remove',$audio->pivot->id],'method' => 'DELETE']) !!}

                                    <li><a><button title="Remove song from playlist" style="padding: 0px;border: 0px;height: 15px;background-color: transparent;">Delete from playlist</button></a></li>
                                    {{ Form::close() }}

                                </ul>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection