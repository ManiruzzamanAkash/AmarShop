@extends('layouts.app')

@section('content')



<section class="products">
  <div class="container">
    <div class="columns">
      <div class="column is-3">
        @include('partials.product-left-sidebar')
      </div>
      <div class="column is-9">
        <p><a href="{!! route('product.request') !!}" class="button is-primary is-pulled-right m-b-10">Request for a product now</a></p>
        <div class="is-clearfix"></div>


        @foreach ($products as $product)

        <div class="card product-single" onclick="location.href='{{ route('product.request_products.show', $product->slug) }}'">
          <div class="card-content">
            <div class="columns">
              <div class="column is-5">
                <figure class="image">
                  @if (($product->image == NULL) || ($product->image == ""))
                    <img src="{{ asset("images/product_requests/default.png") }}" alt="" style="width: 200px;">
                  @else
                    <img src="{{ asset("images/product_requests/$product->image") }}" alt="" style="width: 200px;">
                  @endif

                </figure>
              </div>
              <div class="column is-7">
                <p class="title is-4"><a href="#">{{ $product->title }}</a></p>
                <p class="subtitle is-5 is-bold has-text-primary button is-warning m-t-0">
                  {{ $product->price_range }} ৳
                </p>
                <p class="subtitle is-5">
                  {{-- {!! $product->description !!} --}}

                  {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}
                </p>
                <p class="has-text-right">
                  <a href="{{ route('product.show', $product->slug) }}" class="button is-large is-warning">
                    <i class="fa fa-cart-plus"></i> &nbsp; Buy this Product
                  </a>
                </p>
              </div>
            </div>

          </div>
        </div>
        @endforeach

        <div class="pagination" aria-label="pagination">
          {{ $products->links() }}
        </div>

        @if ($products->count() == 0)
        <b-message title="No Products" type="is-primary" has-icon>
          <h2>Sorry !!!</h2>
          <p>
            There is no product has requested yet !! You can request a product here
          </p>
          <p>
            <a href="{{ route('product.request') }}" class="button is-primary">Request a product Now</a>
          </p>
        </b-message>
        @endif


      </div>
    </div> <!-- End columns -->
  </div> <!-- End container -->



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
