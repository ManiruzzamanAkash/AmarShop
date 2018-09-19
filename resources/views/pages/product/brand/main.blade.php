@extends('layouts.app')

@section('content')

<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">Get products from the Brands</p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($brands as $brand)
        @if ($brand->products()->count() > 0 )
          <div class="column is-info is-3">
            <div class="brand has-text-centered link-bigger-transition">
              <a href="{!! route('product.brand.index', $brand->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
                <img src="{{ asset("images/brands/$brand->image") }}" alt="">
                <br />
                {{ $brand->name }}
              </a>
            </div>
          </div>
        @endif
      @endforeach
    </div>
    {{-- {{ $categories->links() }} --}}
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
