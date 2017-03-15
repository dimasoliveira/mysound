@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Search</a></li>
            <li class="flex-item valign tab"><a target="_self" href="{{ route('timeline.show') }}">Timeline</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('profile.show') }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')


    <div id="profile" class="col s12">
        <div class="container">
            <div class="section">


                <!--   Icon Section   -->
                <div class="row">

                    <div id="profile-page-header" class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="http://demo.geekslabs.com/materialize/v2.1/layout03/images/user-profile-bg.jpg" alt="user background">
                        </div>
                        <figure class="card-profile-image">
                            <img src="https://thumb9.shutterstock.com/display_pic_with_logo/1375510/221431012/stock-vector-male-avatar-profile-picture-vector-illustration-eps-221431012.jpg" alt="profile image" class="circle z-depth-2 responsive-img activator">
                        </figure>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s3 offset-s2">
                                    <h4 class="card-title grey-text text-darken-4">{{ Auth::user()->profile->firstname }} {{ Auth::user()->profile->lastname }}</h4>
                                    <p class="medium-small grey-text">{{ Auth::user()->username }}</p>
                                </div>
                                <div class="col s2 center-align">
                                    <h4 class="card-title grey-text text-darken-4">543</h4>
                                    <p class="medium-small grey-text">Followers</p>
                                </div>
                                <div class="col s2 center-align">
                                    <h4 class="card-title grey-text text-darken-4">79</h4>
                                    <p class="medium-small grey-text">Following</p>
                                </div>
                                <div class="col s2 center-align">
                                    <h4 class="card-title grey-text text-darken-4">30</h4>
                                    <p class="medium-small grey-text">Posts</p>
                                </div>
                                <div class="col s1 right-align">
                                    <a class="btn-floating activator waves-effect waves-light darken-2 right">
                                        <i class="mdi-action-perm-identity"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal">
                            <p>
                                <span class="card-title grey-text text-darken-4">Roger Waters <i class="mdi-navigation-close right"></i></span>
                                <span><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</span>
                            </p>

                            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>

                            <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                            <p><i class="mdi-communication-email cyan-text text-darken-2"></i> mail@domain.com</p>
                            <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                            <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p>
                        </div>
                    </div>




                </div>

            </div>
            <br><br>


        </div>
    </div>

@endsection