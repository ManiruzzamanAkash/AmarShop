@extends('layouts.app')

@section('title')
Verification User | Amar Shop
@endsection

@section('content')

<section class="hero">
  <div class="hero-body">
    <div class="container">
      <div class="content">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title p-10">Verify Email Address</h2>

          </div>
          <div class="card-block">
            <div class="container p-10">


              @if (( Session::has('success')) || (Session::has('already_added')) )
              <b-notification type="is-success">
                {{-- That means User is verified --}}
                <p>You are verified successfully !! Please Login Now <a href="{{ route('login') }}" class="button is-primary">Login</a></p>
              </b-notification>
              @endif

              @if ( Session::has('error') )
              
                {{-- That means User is not verified --}}
                <p>You are not verified</p>
                <p>If you haven't receive any verification mail yet, then please type your email in the field and we'll resend the verification mail..</p>
                <form method="post" action="{{ route('verification.send') }}" class="form-inline">
                  {{ csrf_field() }}
                  <input type="email" name="email" class="input" placeholder="Your Email" value="{{ Auth::check() ? Auth::user()->email : '' }}"><br /><br />
                  <button type="submit" class="button is-info">Send Verification Mail</button>
                </form>
              
              @endif



              

            </div>
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
    data:{

    },
    methods:{

    }
  });
</script>
@endsection
