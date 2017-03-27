@extends("layouts.app")

@section("content")

        <main>
            <center>
                <div class="section"></div>

                <h5 class="blue-text">Please, login into your account</h5>
                <div class="section"></div>

                <div class="container">
                    <div class="z-depth-1 lighten-4 grey row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                        <form class="form-horizontal col s12" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col s12">
                                </div>
                            </div>


                            <div class="row">
                                <div class="input-field col s12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                                    <label for="email">Enter your email</label>

                                    @if ($errors->has('email'))
                                        <span style="float: left; color: red" class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>



                            <div class="row">
                                <div class="input-field col s12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input class="form-control" type="password" name="password" id="password" required>
                                    <label for="password">Enter your password</label>

                                    @if ($errors->has('password'))
                                        <span style="float: left; color: red" class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif


                                <p  style="float: left;">
                                    <input type="checkbox" class="filled-in" name="remember" {{ old('remember') ? 'checked' : '' }} id="filled-in-box">
                                    <label for="filled-in-box">Remember Me</label>
                                </p>
                            </div>
                                <p style="float: right;">
                                    <a class="blue-text" href="{{ route("password.request") }}" id="filled-in-remember"><b>Forgot Password?</b></a>
                                    <label for="filled-in-remember"></label>
                                </p>
                            </div>


                            <br />
                            <center>
                                <div class="row">
                                    <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect blue">Login</button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
                <a href="{{ route("register") }}">Create account</a>
            </center>

            <div class="section"></div>
            <div class="section"></div>
        </main>


@endsection
