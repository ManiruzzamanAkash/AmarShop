<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Admin Panel | Amar Shop')
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('admin.partials.nav')

        {{-- <div class="container is-fluid"> --}}
          <div class="columns">

            <div class="column is-3 admin-left-sidebar">
                @include('admin.partials.left_sidebar')
            </div>


            <div v-cloak class="column is-9 ">
                <div class="has-text-centered loading v-cloak--inline" style="padding-top: 10%">
                    <h1 style="margin-top: 10%; margin-left: 10%">
                      <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                      <span class="sr-only">Loading...</span>
                  </h1>
              </div>
              <div class="v-cloak--hidden">
                @include('components.messages')
                @yield('content')
            </div>
        </div>
    </div>
{{-- </div> --}}



@include('admin.partials.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/admin/admin.js') }}"></script>
@yield('scripts')
</body>
</html>
