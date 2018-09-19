@extends('layouts.app')
@php
  // require_once 'app/Functions/Info.php';
@endphp

@section('title')
Cart Page | Amar Shop
@endsection

@section('content')

<section class="carts">
  <div class="container content">
    <h2>Cart Items</h2>
    <table class="table is-fullwidth">
      <thead>
        <tr>
          <th>Product</th>
          <th>Thumbnail</th>
          <th>Company/User</th>
          <th>Size | Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
          <th width="10%">Action</th>
        </tr>
      </thead>

      <tbody>

        @forelse ($cart_items as $row)
        
        <tr>
          <td>
            <p><a href="{{ route('product.show', get_product_slug($row->id)) }}"><strong>{{ $row->name }}</strong></a></p>
          </td>
          <td>
            <img src='{{ asset("images/products/".get_product_first_image($row->id)) }}' class="image" style="width: 100px">
          </td>
          <td>
            <p><a href="{{ route('user.show', get_user_or_company($row->id)->username) }}">{{ get_user_or_company($row->id)->name }}</a></p>
          </td>
          <td>
            <form class="form-inline" action="{{ route('cart.update', $row->rowId) }}" method="POST">
              {{ csrf_field() }}

              @if ($row->options->has('size'))
              <select name="size" class="select">
                <option value="Small" {{ ($row->options->size == 'Small') ? 'selected' : '' }}>Small</option>
                <option value="Medium" {{ ($row->options->size == 'Medium') ? 'selected' : '' }}>Medium</option>
                <option value="Large" {{ ($row->options->size == 'Large') ? 'selected' : '' }}>Large</option>
                <option value="Extra Large" {{ ($row->options->size == 'Extra Large') ? 'selected' : '' }}>Extra Large</option>
                
              </select>
              @endif

              <input type="number" value="{{ $row->qty }}" class="input" name="qty" min="1" />
              <input type="submit" value="Update" class="button is-success is-small">
            </form>
          </td>



          <td>৳ {{ $row->price }}</td>
          <td>৳ {{ $row->total }}</td>
          <td>

            <a href="{{ route('product.show', get_product_slug($row->id)) }}" class="button is-info is-small"><i class="fa fa-eye"></i></a>
            <form class="form-inline" action="{{ route('cart.destroy', $row->rowId) }}" method="POST" onsubmit="return confirm('Do you want to remove product from cart ?')">
              {{ csrf_field() }}
              <input type="submit" value="Delete" class="button is-danger is-small">
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4">No Item in the cart..!! <br /> <br /> Add a Product to cart list <a href="{{ route('product.index') }}" class="button is-info">Products</a></td>
        </tr>
        @endforelse

        <tfoot>
          <tr>
            <td colspan="4"></td>
            <td><mark> {{ Cart::count() }}</mark> Item</td>
            <td>
              Total - <mark>৳ {{ Cart::total() }}</mark>
            </td>

            <td>
              <a href="{{ route('checkout') }}" class="button is-warning is-large">Checkout</td>
            </tr>
          </tfoot>


        </tbody>
      </table>
      <b-message type="is-info">
        <strong class="has-text-danger">Note : </strong>
        Same company products will take low shipping costs. Multiple company products will take more shipping cost for each company. <br />
        <strong class="has-text-warning">Also.. </strong>If you choose multiple company products then you may get product from different company at different day..!!
      </b-message>
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
