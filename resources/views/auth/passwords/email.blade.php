@extends('layouts.app')

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
    margin-top: 1rem;
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
            <div class="card">
                <div class="card-header card-header-title">Reset Password</div>
                <div class="card-block p-l-10 p-r-10">
                    @if (session('status'))
                    <b-notification type="is-info" has-icon>
                        {{ session('status') }}
                    </b-notification>
                    @endif
                    
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="button is-primary m-t-10 m-b-10">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
});
</script>
@endsection