<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Amar Shop User Dashboard | A Place to shop everything, sell everything')
    </title>
    
    {{-- <base href="http://localhost/amarshop/" target="_blank, _self, _parent, _top"> --}}

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
    <div id="app">
        @include('partials.nav')
        <div v-cloak class="m-t-25">
            <div class="has-text-centered loading v-cloak--inline">
                <h1 style="margin-top: 10%; margin-bottom: 10%; background: #fff;">
                  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                  <span class="sr-only">Loading...</span>
              </h1>
          </div>
          <div class="v-cloak--hidden">
            @include('components.messages')
            <div class="container">


                <div class="columns m-t-10">
                    <div class="column is-4">
                        <div class="navigationbar">
                            <nav class="panel">
                              <p class="panel-heading">
                                Dashboard Actions
                            </p>
                            <a class="panel-block {{ (Route::current()->getName() == "user.dashboard") ? 'is-active' : 'null' }}" href="{{ route('user.dashboard')}}">
                                <span class="panel-icon"> <i class="fa fa-dashboard"></i> </span>
                                Dashboard
                            </a>
                            <a class="panel-block  {{ (Route::current()->getName() == "user.update_profile") ? 'is-active' : 'null' }}" href="{{ route('user.update_profile')}}">
                                <span class="panel-icon"> <i class="fa fa-user"></i> </span>
                                Update Profile
                            </a>
                            <a class="panel-block  {{ (Route::current()->getName() == "user.change_shipping_address") ? 'is-active' : 'null' }}" href="{{ route('user.change_shipping_address')}}">
                                <span class="panel-icon"> <i class="fa fa-cart-plus"></i> </span>
                                Update Shipping Address
                            </a>
                            <a class="panel-block {{ (Route::current()->getName() == "user.manage_orders") ? 'is-active' : 'null' }}" href="{{ route('user.manage_orders')}}">
                                <span class="panel-icon"> <i class="fa fa-bell"></i> </span>
                                Manage Orders
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="column is-8">
                    @yield('content') 
                </div>
            </div><!-- End Columns -->
        </div> <!-- End Container -->
        @include('partials.footer')
    </div>
</div>


</div>
<script src="{{ url('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
