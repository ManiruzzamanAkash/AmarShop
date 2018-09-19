<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Admin Panel | Amar Shop</title>
  <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">

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
   /* margin-top: -70px;
    padding-bottom: 20px;*/
  }
  .avatar img {
    padding: 5px;
    background: #fff;
    border-radius: 50%;
    -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
    box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
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
</head>
<body>
  <section class="hero is-success is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
          <h3 class="title has-text-grey">Login</h3>
          <p class="subtitle has-text-grey">Please login to proceed.</p>
          <div class="box">
            {{-- <figure class="avatar">
              <img src="https://placehold.it/128x128">
            </figure> --}}
            <form action="{{ route('admin.login.submit') }}" method="POST">
              {{ csrf_field() }}
              <div class="field">
                <div class="control">
                  <input class="input is-large" type="email" value="{{ old('email') }}" placeholder="Your Email" name="email" autofocus="">
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <input class="input is-large" type="password" name="password" placeholder="Your Password">
                </div>
              </div>
              <div class="field">
                <label class="checkbox">
                  <input type="checkbox" name="remember" value="{{ old('remember') }}">
                  Remember me
                </label>
              </div>
              <button type="submit"  class="button is-block is-info is-large is-fullwidth">Login</button>
            </form>
          </div>
          <p class="has-text-grey">
            <a href="../">Forgot Password</a> &nbsp;·&nbsp;
          </p>
        </div>
      </div>
    </div>
  </section>

  @section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
   const app = new Vue({
    el: '#app',
  });
</script>
@endsection
</body>
</html>

