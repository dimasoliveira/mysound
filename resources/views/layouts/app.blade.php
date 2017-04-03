<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
    {{--<!-- Compiled and minified JavaScript -->--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>--}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/bar-ui.css') }}" type="text/css" rel="stylesheet"/>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/soundmanager2.js') }}"></script>
    <script src="{{ asset('js/bar-ui.js') }}"></script>



    {{--<script src="{{ asset('js/initialize.js') }}"></script>--}}

    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/custom.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/player.css') }}" type="text/css" rel="stylesheet"/>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script>
      soundManager.setup({
        url: '{{ asset('swf/') }}',
        flashVersion: 9, // optional: shiny features (default = 8)
        // optional: ignore Flash where possible, use 100% HTML5 mode
        // preferFlash: false,
        onready: function() {
          // Ready to use; soundManager.createSound() etc. can now be called.
        }
      });
    </script>

    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>


<body>
<nav class="light-blue lighten-1 nav-extended" role="navigation">
    <div class="nav-wrapper container">

        <!-- Branding Image -->
        <a id="logo-container" class="brand-logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

        <ul class="right hide-on-med-and-down">

            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else

                <li>
                    <a class="" href="{{ route('myaudio.index') }}">Mijn Audio
                    </a>
                </li>


                <li>
                    <a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->username }}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>


                <ul id="dropdown1" class="dropdown-content">
                    <li><a class="" href="{{route('profile.show',Auth::user()->slug)}}">Profiel</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            @endif
        </ul>
        @if (Auth::guest())
        @else
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
@endif

    </div>

    @yield('expanded-navbar')
</nav>

<!-- Side Nav-->
@if (Auth::guest())
@else

<ul id="slide-out" class="side-nav">
    <li><div class="userView">
            <div class="background">
                <img src="images/office.jpg">
            </div>
            <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
            <a href="#!name"><span class="white-text name">{{ Auth::user()->username }}</span></a>
            <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
        </div></li>
    <li><a class="waves-effect" href="{{route('profile.show',Auth::user()->slug)}}">Profiel</a></li>
    <li><a class="waves-effect" href="{{route('myaudio.index')}}">Mijn Audio</a></li>
    <li><div class="divider"></div></li>
    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>

</ul>
@endif


<main>
            @yield('content')
</main>

<!-- Modal Trigger -->
<a class="waves-effect waves-light btn" href="#modal1">Modal</a>

<!-- Modal Structure -->

<div id="modal1" class="modal bottom-sheet modal-content z-depth-1 lighten-4 grey row col s12" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

    <div class="col s10">
<center>
    {!! Form::open(['route'=>'myaudio.add', 'files' => true , 'class' => 'form-horizontal col s12']) !!}

    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" >

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
            <input id="artist" type="text" class="form-control" name="artist" value="{{ old('artist') }}" >
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
            <input id="album" type="text" class="form-control" name="album" value="{{ old('album') }}" >
            <label for="album">Album</label>

            @if ($errors->has('album'))
                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('album') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
            <div class="autocomplete" id="multiple">
                <div class="ac-users ac-appender"></div>
                <div class="ac-input">
                    <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}" placeholder="Please input some letters" data-activates="genre_dropdown" data-beloworigin="true" autocomplete="off"><ul id="genre_dropdown" class="dropdown-content ac-dropdown" style="width: 1280px; position: absolute; top: 45px; left: 11.25px; opacity: 1; display: none;"></ul>
                    <input type="hidden" class="validate" value=""></div>

                <input type="hidden" name="multipleHidden">
            </div>
            <label class="active" for="genre">Genre: </label>
        </div>
        @if ($errors->has('genre'))
            <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
        @endif
    </div>

    <div class="row">
        <div class="input-field col s6 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
            <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}">
            <label for="genre">Genre </label>

            @if ($errors->has('genre'))
                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="input-field col s6 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
            <input id="year" type="text" class="form-control" name="year" value="{{ old('year') }}">
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
                <span>Audio</span>
                <input id="filename" name="filename" type="file" >
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="We only support MP3 files at the moment" value="{{ old('filename') }}">
            </div>
            @if ($errors->has('filename'))
                <span class="left help-block red-text">
                                    <strong>{{ $errors->first('filename') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="file-field input-field">

            <p class="left">
                <input title="published" type="checkbox" class="filled-in" id="published" name="published">
                <label for="published">Delen met anderen</label>
            </p>

            <p class="right">
                <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">
                <label for="explicit">Explicit</label>
            </p>

        </div>


    </div>
    <div class="row">
        <div class="file-field input-field">

            <p class="left">
                <input title="private" type="checkbox" class="filled-in" id="private" name="private">
                <label for="private">Toevoegen aan Mijn Audio</label>
            </p>



        </div>
    </div>
</center>
    </div>


    {{ Form::close() }}



<div class="modal-footer">

    <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect blue modal-action modal-close">Upload</button>
</div>
</div>



<footer class="page-footer #0d47a1 blue darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Company Bio</h5>
                <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">

        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/materialize_conf.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>--}}
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/init.js') }}"></script>--}}
{{--<script src="{{ asset('js/materialize.js') }}"></script>--}}
{{--<script src="{{ asset('js/materialize_conf.js') }}"></script>--}}
{{--<script src="{{ asset('js/postinit.js') }}"></script>--}}

</body>
</html>
