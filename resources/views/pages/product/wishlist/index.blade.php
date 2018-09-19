@extends('layouts.app')
@section('content')

  <section class="products">
    <div class="container">
      <div class="columns">
        <div class="column is-3">
          @include('partials.product-left-sidebar')
        </div>
        <div class="column is-9">
          {{-- @include('partials.products_list') --}}
          @if ($wishlists != null)
            <b-notification type="is-success">
              Total <mark>{{ $wishlists->count() }}</mark> products have added to your wishlist
            </b-notification>
          @endif
          @foreach ($wishlists as $wishlist)

            <div class="card product-single" onclick="location.href='{{ route('product.show', $wishlist->product->slug) }}'">
              <div class="card-content">
                <div class="columns">
                  <div class="column is-5">
                    <figure class="image">
                      <?php $image = DB::table('product_images')->where('product_id', $wishlist->product->id)->first(); ?>
                      <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest" style="width: 200px;">
                    </figure>
                  </div>
                  <div class="column is-7">
                    <p class="title is-4"><a href="#">{{ $wishlist->product->title }}</a></p>
                    <p class="subtitle is-5 is-bold has-text-primary">
                      {{ $wishlist->product->price }} ৳
                    </p>
                    <p class="subtitle is-5">
                      {{-- {!! $wishlist->product->description !!} --}}

                      {{ \Carbon\Carbon::parse($wishlist->product->created_at)->diffForHumans() }}
                    </p>
                    <p class="has-text-right">
                      <a href="{{ route('product.show', $wishlist->product->slug) }}" class="button is-large is-warning">
                        <i class="fa fa-cart-plus"></i> &nbsp; Buy this Product
                      </a>
                    </p>
                  </div>
                </div>

              </div>
            </div>
          @endforeach

          <div class="pagination" aria-label="pagination">
            {{ $wishlists->links() }}
          </div>

          @if ($wishlists->count() == 0)
            <b-message title="No Products" type="is-primary" has-icon>
              <h2>Sorry !!!</h2>
              <p>
                There is no product has added yet !! You can add a product here
              </p>
              <p>
                <a href="{{ route('product.create') }}" class="button is-primary">Add a product Now</a>
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
