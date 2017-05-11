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


    {{--<script type="text/javascript" src="../../script/soundmanager2.js"></script>--}}
    {{--<script src="script/bar-ui.js"></script>--}}
    {{--<link rel="stylesheet" href="css/bar-ui.css" />--}}


    {{--<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>--}}
    <script type="text/javascript" src="https://rawgit.com/scottschiller/SoundManager2/master/script/soundmanager2-jsmin.js"></script>
    {{--<script type="text/javascript" src="{{ asset('js/soundmanager2.js') }}"></script>--}}
    <script type="text/javascript" src="https://rawgit.com/scottschiller/SoundManager2/master/demo/bar-ui/script/bar-ui.js"></script>
    {{--<script src="{{ asset('js/bar-ui.js') }}"></script>--}}




    {{--<script src="{{ asset('js/initialize.js') }}"></script>--}}

    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/custom.css') }}" type="text/css" rel="stylesheet"/>

    <link href="{{ asset('css/player.css') }}" type="text/css" rel="stylesheet"/>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    @yield('stylesheet')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="{{ asset('js/materialize.js') }}"></script>
    <script src="{{ asset('js/materialize_conf.js') }}"></script>

    {{--<script>--}}
      {{--soundManager.setup({--}}
        {{--url: '{{ asset('swf/') }}',--}}
        {{--flashVersion: 9, // optional: shiny features (default = 8)--}}
        {{--// optional: ignore Flash where possible, use 100% HTML5 mode--}}
        {{--// preferFlash: false,--}}
        {{--onready: function() {--}}
          {{--// Ready to use; soundManager.createSound() etc. can now be called.--}}
        {{--}--}}
      {{--});--}}
    {{--</script>--}}

    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>


<body>

@if(session('message'))
    <script>
      $( document ).ready(function() {
        var $toastContent = $('<span>{{ session('message') }}</span>');
        Materialize.toast($toastContent, 5000);
      });
    </script>
@endif

<main>
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
        @if (Auth::check())
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        @endif
    </div>

    @if (Auth::check())
        <a style="position:absolute; right: 10%; top:15%;" class="btn-floating btn-large waves-effect waves-light blue" href="#addModal"><i class="material-icons">add</i></a>
    @endif

    @yield('expanded-navbar')
</nav>

<!-- Side Nav-->
@if (Auth::check())

<ul id="slide-out" class="side-nav">
    <li><div class="userView">
            <div class="background">
                <img src="#">
            </div>
            <a href="#!user"><img class="circle" src="#"></a>
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


<!-- Modal Trigger -->


@yield('content')

<!-- Add-Modal Structure -->
    @if(session()->has('validation-error'))

        <script>
          $(document).ready(function(){
            $('#addModal').modal().modal('open');
          });</script>
    @endif


    <div id="addModal" class="modal modal-fixed-footer" style="width: 30%;">
        <div class="modal-content" style="padding-top: 15px;padding-bottom: 15px;">
            {!!  Form::open(['route' => ['myaudio.store'],'class' => 'form-horizontal col s12', 'files' => true])  !!}



            <div class="row">

                <div class="input-field col s2 form-group{{ $errors->has('tracknumber') ? ' has-error' : '' }}">
                    <input id="tracknumber" type="text" class="form-control" name="tracknumber" value="{{ old('tracknumber') }}" >

                    <label for="tracknumber">Nr.</label>

                    @if ($errors->has('tracknumber'))
                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('tracknumber') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="input-field col s10 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
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
                <div class="input-field col s10 form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                    <input id="genre" type="text" class="form-control" name="genre" value="{{ old('genre') }}" >
                    <label for="genre">Genre</label>

                    @if ($errors->has('genre'))
                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('genre') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="input-field col s2 form-group{{ $errors->has('year') ? ' has-error' : '' }}">
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



                <div class="file-field input-field col s6">
                    <div class="btn waves-effect blue">
                        <span>Audio</span>
                        <input id="filename" name="filename" type="file">
                    </div>

                    @if ($errors->has('filename'))
                        <span class="left help-block red-text">
                                    <strong>{{ $errors->first('filename') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="file-field input-field col 6">
                    <div class="btn waves-effect blue">
                        <span>Coverart</span>
                        <input id="coverart" name="coverart" type="file" >
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
                            <input title="published" type="checkbox" id="published" class="filled-in" name="published">
                        <label for="published">Delen met anderen</label>
                    </p>


                    <p class="right">

                            <input title="explicit" type="checkbox" class="filled-in" id="explicit" name="explicit">

                        <label for="explicit">Explicit</label>
                    </p>
                </div>
            </div>

            <br/>

        </div>

        <button type="submit" class="modal-footer col s12 btn btn-large waves-effect blue">Upload</button>





        {{ Form::close() }}
    </div>


@if (Auth::check())
<div class="sm2-bar-ui full-width fixed flat">

    <div class="bd sm2-main-controls">

        <div class="sm2-inline-texture"></div>
        <div class="sm2-inline-gradient"></div>

        <div class="sm2-inline-element sm2-button-element">
            <div class="sm2-button-bd">
                <a href="#play" class="sm2-inline-button sm2-icon-play-pause">Play / pause</a>
            </div>
        </div>

        <div class="sm2-inline-element sm2-inline-status">

            <div class="sm2-playlist">
                <div class="sm2-playlist-target">
                    <!-- playlist <ul> + <li> markup will be injected here -->
                    <!-- if you want default / non-JS content, you can put that here. -->
                    <noscript><p>JavaScript is required.</p></noscript>
                </div>
            </div>

            <div class="sm2-progress">
                <div class="sm2-row">
                    <div class="sm2-inline-time">0:00</div>
                    <div class="sm2-progress-bd">
                        <div class="sm2-progress-track">
                            <div class="sm2-progress-bar"></div>
                            <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
                        </div>
                    </div>
                    <div class="sm2-inline-duration">0:00</div>
                </div>
            </div>

        </div>

        <div class="sm2-inline-element sm2-button-element sm2-volume">
            <div class="sm2-button-bd">
                <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
            </div>
        </div>

        <div class="sm2-inline-element sm2-button-element">
            <div class="sm2-button-bd">
                <a href="#prev" title="Previous" class="sm2-inline-button sm2-icon-previous">&lt; previous</a>
            </div>
        </div>

        <div class="sm2-inline-element sm2-button-element">
            <div class="sm2-button-bd">
                <a href="#next" title="Next" class="sm2-inline-button sm2-icon-next">&gt; next</a>
            </div>
        </div>

        <div class="sm2-inline-element sm2-button-element">
            <div class="sm2-button-bd">
                <a href="#repeat" title="Repeat playlist" class="sm2-inline-button sm2-icon-repeat">&infin; repeat</a>
            </div>
        </div>

        <!-- not implemented -->
        <!--
        <div class="sm2-inline-element sm2-button-element disabled">
         <div class="sm2-button-bd">
          <a href="#shuffle" title="Shuffle" class="sm2-inline-button sm2-icon-shuffle">shuffle</a>
         </div>
        </div>
        -->

        <div class="sm2-inline-element sm2-button-element sm2-menu">
            <div class="sm2-button-bd">
                <a href="#menu" class="sm2-inline-button sm2-icon-menu">menu</a>
            </div>
        </div>

    </div>

    <div class="bd sm2-playlist-drawer sm2-element">

        <div class="sm2-inline-texture">
            <div class="sm2-box-shadow"></div>
        </div>

        <!-- playlist content is mirrored here -->

        <div class="sm2-playlist-wrapper">

            <ul class="sm2-playlist-bd">

                <!-- standard one-line items -->


            </ul>

        </div>

    </div>

</div>
    @endif
</main>

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

</body>
<script>

  $(function () {

    $(".playable-link").click(function(){

      if ($(this).data('explicit')){
        var explicit = '<span class="label">E</span>';
      }
      else {
        var explicit = ''
      }
      var music_item = '<li><a href="'+ $(this).data('filename')+'"><b>'+ $(this).data('artist')+'</b> - '+$(this).data('title')+explicit+'</a></li>';

        $(".sm2-playlist-bd").html(music_item);

      window.sm2BarPlayers[0].playlistController.playItemByOffset();
    });

  });
</script>
</html>
