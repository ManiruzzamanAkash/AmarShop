@extends('layouts.app')
@section('content')

<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">Get any product from your favorite division</p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($divisions as $division)
          <div class="column is-info is-3">
            <div class="category has-text-centered link-bigger-transition">
              <a href="{!! route('product.division.index', $division->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
                <img src="{{ asset("images/divisions/$division->image") }}" alt="">
                <br />
                {{ $division->name }}
              </a>
            </div>
          </div>
      @endforeach
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
