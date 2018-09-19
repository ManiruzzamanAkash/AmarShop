@extends('layouts.app')

@section('title')
Login | Amar Shop
@endsection

@section('stylesheets')
<style>
.hero.is-success {
    background: #F2F6FA;
}
.hero .nav, .hero.is-success .nav {
    -webkit-box-shadow: none;
    box-shadow: none;
}
.box {
    margin-top: 5rem;
}
.avatar {
    margin-top: -70px;
    padding-bottom: 20px;
}
.avatar img {
    padding: 5px;
    background: #fff;
    border-radius: 50%;
    -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
    box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
    width: 120px;
}
input {
    font-weight: 300;
}
p {
    font-weight: 700;
}
p.subtitle {
    padding-top: 1rem;
}
</style>
@endsection

@section('content')



<section class="hero is-success">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <h3 class="title has-text-grey">Login As User</h3>
            <div class="box">
                <figure class="avatar">
                  <img src="{{ asset('images/logo.png') }}">
              </figure>
              @include('components/login')
              {{-- <form action="{{ route('login') }}" method="POST">
                  {{ csrf_field() }}

                  <b-field>
                    <b-input placeholder="Email" type="email" name="email" required></b-input>
                </b-field>

                <b-field label="Password">
                    <b-input type="password" required password-reveal name="password"></b-input>
                </b-field>


                <div class="field">
                    <b-checkbox name="remember" value="{{ old('remember') }}">Remember Me</b-checkbox>
                </div>

                <div class="buttons">
                    <button type="submit" class="button is-large is-primary is-outlined is-fullwidth">Login</button>
                </div>
                <a class="m-t-10" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </form> --}}
        </div>

    </div>
</div>
</div>
</section>


{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection
@section('scripts')
<script>
   const app = new Vue({
      el: '#app',
  });
</script>
@endsection