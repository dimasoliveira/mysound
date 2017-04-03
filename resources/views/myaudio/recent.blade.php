@extends('layouts.app')

@section('expanded-navbar')
    <div class="flex-container nav-content .center-align">

        <ul class="tabs tabs-transparent row">
            <li class="flex-item valign tab"><a href="#test1">Playlists</a></li>
            <li class="flex-item valign tab"><a class="active" href="{{ route('myaudio.index') }}">Recent</a></li>
            <li class="flex-item valign tab"><a href="{{ route('myaudio.albums') }}">Albums</a></li>
        </ul>

    </div>
@endsection


@section('content')
        <div class="container">
            <a style="float: right;margin-top: 10px" class="btn-floating btn-large waves-effect waves-light blue" href="{{route('myaudio.add')}}"><i class="material-icons">add</i></a>
            <div class="row">

                @foreach($audio_posts as $audio_post)
          <div class="col s3 m3">

              <div class="card hoverable">
                  <div class="card-image waves-effect waves-block waves-light">
                      <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png" class="activator" style="height: auto;width: 100%">
                      <span class="card-title activator" style="color: black;">{{ $audio_post->title }}<br>{{ $audio_post->artist }}</span>
                  </div>
                  <div class="card-content" style="padding: 0;line-height: 0;">
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

                                  <div class="sm2-playlist" style="display: none">
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
                                      <li><a href="{{ asset($audio_post->filename) }}">{{ $audio_post->title }}</a></li>
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
                      <p>Album: {{ $audio_post->album->name }}</p>
                      <p>Year: {{ $audio_post->year }}</p>
                  </div>
              </div>
        </div>

            <a class="gsm2-playable-link playing" data-source="{{ $audio_post->filename }}">klikhier</a>
            <div class="sm2-bar-ui flat dark-text full-width fixed">

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
                            {{--<div class="sm2-playlist-target"><ul class="sm2-playlist-bd"><li><b>SonReal</b> - LA<span class="label">Explicit</span></li></ul></div>--}}

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
                            <a href="#prev" title="Previous" class="sm2-inline-button previous">&lt; previous</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#next" title="Next" class="sm2-inline-button next">&gt; next</a>
                        </div>
                    </div>

                    <div class="sm2-inline-element sm2-button-element">
                        <div class="sm2-button-bd">
                            <a href="#repeat" title="Repeat playlist" class="sm2-inline-button repeat">∞ repeat</a>
                        </div>
                    </div>

                    <!-- not implemented -->
                    <!--
                    <div class="sm2-inline-element sm2-button-element disabled">
                     <div class="sm2-button-bd">
                      <a href="#shuffle" title="Shuffle" class="sm2-inline-button shuffle">shuffle</a>
                     </div>
                    </div>
                    -->

                    <div class="sm2-inline-element sm2-button-element sm2-menu">
                        <div class="sm2-button-bd">
                            <a href="#menu" class="sm2-inline-button menu">menu</a>
                        </div>
                    </div>

                </div>

                <div class="bd sm2-playlist-drawer sm2-element" style="height: 0px;">

                    <div class="sm2-inline-texture">
                        <div class="sm2-box-shadow"></div>
                    </div>

                    <!-- playlist content is mirrored here -->

                    <div class="sm2-playlist-wrapper">

                        <ul class="sm2-playlist-bd">

                            <!-- item with "download" link -->
                            <li class="selected">
                                <div class="sm2-row">
                                    <div class="sm2-col sm2-wide">
                                        <a href="http://freshly-ground.com/data/audio/sm2/SonReal%20-%20LA%20%28Prod%20Chin%20Injetti%29.mp3"><b>SonReal</b> - LA<span class="label">Explicit</span></a>
                                    </div>
                                    <div class="sm2-col">
                                        <a href="http://freshly-ground.com/data/audio/sm2/SonReal%20-%20LA%20%28Prod%20Chin%20Injetti%29.mp3" target="_blank" title="Download &quot;LA&quot;" class="sm2-icon sm2-music sm2-exclude">Download this track</a>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>
        @endforeach

    </div>
</div>

@endsection
