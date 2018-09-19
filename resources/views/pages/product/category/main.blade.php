@extends('layouts.app')

@section('content')

<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">Get products from the categories</p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($categories as $category)
        @if ($category->products()->count() > 0 )
          <div class="column is-info is-3">
            <div class="category has-text-centered link-bigger-transition">
              <a href="{!! route('product.category.index', $category->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
                <img src="{{ asset("images/categories/$category->image") }}" alt="">
                <br />
                {{ $category->name }}
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
