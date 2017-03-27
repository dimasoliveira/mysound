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
    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script type="text/javascript" src="{{ asset('js/soundmanager2.js') }}"></script>
    <script src="{{ asset('js/bar-ui.js') }}"></script>
    <link href="{{ asset('css/bar-ui.css') }}" type="text/css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="{{ asset('js/initialize.js') }}"></script>

    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/custom.css') }}" type="text/css" rel="stylesheet"/>
    <link href="{{ asset('css/player.css') }}" type="text/css" rel="stylesheet"/>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}

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

</head>
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
                    <a class="dropdown-button" href="#!" data-activates="dropdown1">{{ Auth::user()->username }}
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>

                <ul id="dropdown1" class="dropdown-content">
                    <li><a href="#">Profiel</a></li>
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

        <!-- Side Nav-->
        <ul id="nav-mobile" class="side-nav">
            @if (Auth::guest())

            @else
            <li>



                <a class="dropdown-button2" href="#!" data-activates="dropdown2">{{ Auth::user()->username }}
                    <i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>

            <ul id="dropdown2" class="dropdown-content">
                <li><a href="#">Profiel</a></li>
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
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>

    @yield('expanded-navbar')
</nav>

<main>
            @yield('content')
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


<!--  Scripts-->

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
{{--<script src="{{ asset('js/init.js') }}"></script>--}}
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/materialize_conf.js') }}"></script>
<script src="{{ asset('js/postinit.js') }}"></script>

</body>
</html>
