<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{  asset('css/admin/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{  asset('css/admin/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{  asset('css/admin/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{  asset('css/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{  asset('css/admin/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{  asset('css/admin/css/themes/all-themes.css') }}" rel="stylesheet" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>

</head>

<body class="theme-light-blue">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
{{--<div class="search-bar">--}}
    {{--<div class="search-icon">--}}
        {{--<i class="material-icons">search</i>--}}
    {{--</div>--}}
    {{--<input type="text" placeholder="START TYPING...">--}}
    {{--<div class="close-search">--}}
        {{--<i class="material-icons">close</i>--}}
    {{--</div>--}}
{{--</div>--}}
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('index') }}"><b>MySound</b> - Adminpanel</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="@if(!empty(Storage::exists(Auth::user()->avatar) )) {{ Storage::url(Auth::user()->avatar) }} @else {{ Storage::url('public/defaults/avatar.png') }}  @endif" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">

                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li {{ (Request::is('admin') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.index') }}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/users/*','admin/users') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.users') }}">
                        <i class="material-icons">contacts</i>
                        <span>Users</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/role/*','admin/roles') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.roles') }}">
                        <i class="material-icons">recent_actors</i>
                        <span>Roles</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/audio','admin/audio/*') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.audio') }}">
                        <i class="material-icons">library_music</i>
                        <span>Audio</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/comments','admin/comments/*') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.comments') }}">
                        <i class="material-icons">textsms</i>
                        <span>Comments</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/settings','admin/settings/*') ? 'class=active' : '') }}>
                    <a href="{{ route('admin.settings') }}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.4
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    {{--<aside id="rightsidebar" class="right-sidebar">--}}
        {{--<ul class="nav nav-tabs tab-nav-right" role="tablist">--}}
            {{--<li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>--}}
            {{--<li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>--}}
        {{--</ul>--}}
    {{--</aside>--}}
    <!-- #END# Right Sidebar -->
</section>

<section class="content">

    @if(session('message'))

        <div class="alert alert-success alert-dismissable">
            {{ session('message') }}
        </div>


    @endif
   @yield('content')
</section>

<!-- Jquery Core Js -->
<script src="{{  asset('css/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{  asset('css/admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Select Plugin Js -->
<script src="{{  asset('css/admin/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{  asset('css/admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{  asset('css/admin/plugins/node-waves/waves.js') }}"></script>



<!-- Jquery DataTable Plugin Js -->
<script src="{{  asset('css/admin/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{  asset('css/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

<!-- Custom Js -->
<script src="{{  asset('css/admin/js/admin.js') }}"></script>
<script src="{{  asset('css/admin/js/pages/tables/jquery-datatable.js') }}"></script>

<!-- Demo Js -->
<script src="{{  asset('css/admin/js/demo.js') }}"></script>
</body>

</html>