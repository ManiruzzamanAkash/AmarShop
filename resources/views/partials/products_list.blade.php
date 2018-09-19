@foreach ($products as $product)

{{-- <div class="card product-single" onclick="location.href='{{ route('product.show', $product->slug) }}'"> --}}
  <div class="card product-single">
    <div class="card-content">
      <div class="columns">
        <div class="column is-5">
          <figure class="image products-image">
            <?php $image = DB::table('product_images')->where('product_id', $product->id)->first(); ?>
            <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest" style="width: 200px;">
          </figure>
        </div>
        <div class="column is-7">
          <p class="title is-4"><a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a></p>
          <p class="subtitle is-5 is-bold has-text-primary">
            {{ $product->price }} ৳
          </p>
          <p class="subtitle is-5">
            {{-- {!! $product->description !!} --}}

            {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}
          </p>
          <div class="columns">
            <div class="column">
              <a href="{{ route('product.show', $product->slug) }}" class="button is-warning">
                <i class="fa fa-cart-plus"></i> &nbsp; Buy this Product
              </a>
            </div>
            <div class="column">
              <form action="{{ route('cart.create', $product->id) }}" method="post" class="form-inline add-to-cart-form">
                {{ csrf_field() }}
                <div class="field has-addons inline">
                  <div class="control">
                    <input class="input" type="number" value="1" min="1" name="qty">
                  </div>
                  <div class="control">
                    <button type="submit" class="button is-warning">
                      Add to cart
                    </button>
                  </div>
                </div>

              </form>
            </div>
          </div>

          {{-- <change-cart :product_id="{{ $product->id }}"></change-cart> --}}

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
      There is no product has added yet !! You can add a product here
    </p>
    <p>
      <a href="{{ route('product.create') }}" class="button is-primary">Add a product Now</a>
    </p>
  </b-message>
  @endif
