@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Search</a></li>
            <li class="flex-item valign tab"><a class="active" href="#timeline">Timeline</a></li>
            <li class="flex-item valign tab"><a href="{{ route('profile.show', Auth::user()->slug) }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')

    @foreach($posts as $post)
        <main>

                <div class="section"></div>
                <div class="container">
        <div class="col s12 m7">

            <div class="card horizontal">
                <div class="card-image">
                    <img style="height: auto; width: 100px;" src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png">
                </div>
                <div class="card-stacked">

                    <div class="card-content">
                        <h6 class="header">{{ $post->title }}</h6>
                        <h6 class="header">by {{ $post->user->username }}</h6>
                        <p>I am a very simple card. I am good at containing small bits of information.</p>
                    </div>
                    <div class="card-action">
                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() .' by '. $post->user->username }}
                    </div>
                </div>
            </div>
        </div>
                </div>


        </main>

    @endforeach

@endsection

