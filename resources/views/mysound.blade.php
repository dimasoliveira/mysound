@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Search</a></li>
            <li class="flex-item valign tab"><a class="active" href="#timeline">Timeline</a></li>
            <li class="flex-item valign tab"><a href="{{ route('profile.show') }}">Profile</a></li>
        </ul>

    </div>
@endsection


@section('content')
    <div class="row">



                @foreach($audio_posts as $audio_post)
          <div class="col s2 m2">

              <div class="card hoverable">
                  <div class="card-image waves-effect waves-block waves-light">
                      <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png" class="activator" style="height: auto;width: 100%">
                      <span class="card-title activator" style="color: #e5e5e5;">{{ $audio_post->title }}<br>{{ $audio_post->artist }}</span>
                  </div>
                  <div class="card-content" style="padding: 0;background-color: #2288CC; line-height: 0;">
                      <div class="sm2-bar-ui compact flat full-width dark-text">

                          <div class="bd sm2-main-controls">

                              <div class="sm2-inline-texture"></div>
                              <div class="sm2-inline-gradient"></div>

                              <div class="sm2-inline-element sm2-button-element">
                                  <div class="sm2-button-bd">
                                      <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
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

                          </div>

                          <div class="bd sm2-playlist-drawer sm2-element">

                              <div class="sm2-inline-texture">
                                  <div class="sm2-box-shadow"></div>
                              </div>

                              <!-- playlist content is mirrored here -->

                              <div class="sm2-playlist-wrapper">
                                  <ul class="sm2-playlist-bd">
                                      <li><a href="{{ asset($audio_post->audio) }}">{{ $audio_post->title }}</a></li>
                                  </ul>
                              </div>

                          </div>

                      </div>

                      <script>
                        soundManager.setup({
                          url: '{{ asset('swf/soundmanager2.swf') }}',
                          flashVersion: 9, // optional: shiny features (default = 8)
                          // optional: ignore Flash where possible, use 100% HTML5 mode
                          // preferFlash: false,
                          onready: function() {
                            // Ready to use; soundManager.createSound() etc. can now be called.
                          }
                        });
                      </script>
                  </div>
                  <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4">{{ $audio_post->title }}<i class="material-icons right">close</i></span>
                      <p>Artist: {{ $audio_post->artist }}</p>
                      <p>Album: {{ $audio_post->album }}</p>
                      <p>Year: {{ $audio_post->year }}</p>
                  </div>
              </div>
        </div>


        @endforeach
    </div>
@endsection
