@extends('layouts.app')

@section('content')

<section class="products">
  <div class="container">
    <div class="columns">
      <div class="column is-3">
        @include('partials.product-left-sidebar')
      </div>
      <div class="column is-9">

        <b-notification type="is-success">
          Total <mark>{{ $products->count() }}</mark> products are available in {{ $category->name }} Category
        </b-notification>
        @include('partials.products_list')
      </div>
    </div> <!-- End columns -->
  </div> <!-- End container -->



</section>

@endsection


@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
});
</script>
@endsection
