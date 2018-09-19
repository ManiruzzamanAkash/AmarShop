<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="has-navbar-fixed-top">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Amar Shop | A Place to shop everything, sell everything')
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
            @yield('content') 
            @include('partials.footer')
        </div>
    </div>

    
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
