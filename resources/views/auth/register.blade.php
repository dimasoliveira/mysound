@extends('layouts.app')

@section('content')

<main>
    <center>
        <div class="section"></div>

        <h5 class="blue-text">Please, create your account</h5>
        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="form-horizontal col s12" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col s12">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                            <label for="username">Username *</label>

                            @if ($errors->has('username'))
                                <span style="float: left; color: red" class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>
                            <label for="firstname">Firstname *</label>

                            @if ($errors->has('firstname'))
                                <span style="float: left; color: red" class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                            @endif
                        </div>




                        <div class="input-field col s6 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                            <label for="lastname">Lastname *</label>

                            @if ($errors->has('lastname'))
                                <span style="float: left; color: red" class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                            <input id="birthdate" type="date" class="form-control datepicker" name="birthdate" value="{{ old('birthdate') }}">
                            <label for="birthdate">Birthdate</label>


                            @if ($errors->has('birthdate'))
                                <span style="float: left; color: red" class="help-block">
                    <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            <label for="email">Email-address *</label>

                            @if ($errors->has('email'))
                                <span style="float: left; color: red" class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control" type="password" name="password" id="password" required>
                            <label for="password">Password *</label>


                            @if ($errors->has('password'))
                                <span style="float: left; color: red" class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s6 form-group">
                            <input class="form-control" type="password" name="password_confirmation" id="password-confirm" required>
                            <label for="password-confirm">Confirm Password *</label>
                        </div>
                    </div>



                    <br />
                    <center>
                        <div class="row">
                            <button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect blue">Register</button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
        <a href="{{ route("login") }}">Already have an account? <b>Login</b></a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
</main>

@endsection



