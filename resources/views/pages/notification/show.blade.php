@extends('layouts.app')

@section('title')
Notification | Amar Shop
@endsection

@section('content')



<section class="products">
  <div class="container">
    <div class="columns">
      <div class="column is-3">
        @include('partials.product-left-sidebar')
      </div>
      <div class="column is-9">
        <div class="card">
          <div class="card-header">
            <div class="card-title p-t-10 p-b-10 p-l-10 title is-5">
              Product expiry warning for your wishlist product
            </div>
          </div>
          <div class="container">
            <div class="card-block">



              <div class="card-content">
                <div class="subtitle">
                  <p>
                    <strong>Notification For </strong>
                    <mark>{{ ($notification->product_id != null) ? $notification->product->title : '' }}</mark>
                  </p>
                  <br />
                  <p>
                    View that product - 
                    <a href="{{ route('product.show', $notification->product->slug) }}" target="blank" class="button is-small is-info">
                      <i class="fa fa-eye"></i> &nbsp;{{ ($notification->product_id != null) ? $notification->product->title : '' }}
                    </a>
                  </p>
                  <p>
                    <strong>Product Expiry date - </strong>{{ \Carbon\Carbon::parse($notification->product->offer_expiry_date)->diffForHumans() }}
                  </p>

                </div>
              </div>
              
            </div>
            <div class="card-footer p-t-10 p-b-10 p-l-10">

              <form class="form-inline" action="{!! route('notification.delete', $notification->id) !!}" method="post"  onsubmit="return confirm('Do you wan to delete the notification ? ')">
                {{ csrf_field() }}
                <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>

              </form>
            </div>
          </div>
          
        </div>

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
