@extends('layouts.app')

@section('stylesheets')
{{-- <link rel="stylesheet" href="{{ asset('css/pure.min.css') }}"> --}}
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
          <div class="card-content">
            <div class="columns">

              <div class="column is-5">
                  <figure class="image product-image-gallery">
                    @if (($product->image == NULL) || ($product->image == ""))
                      <img src="{{ asset("images/product_requests/default.png") }}" alt="" >
                    @else
                      <img src="{{ asset("images/product_requests/$product->image") }}" alt="" >
                    @endif
                </figure>
            </div>


            <div class="column is-7">
              {{-- <div class="columns"> --}}
                <p class="title is-4 is-pulled-left"><a href="#">{{ $product->title }}</a></p>
                {{-- <p class="is-pulled-right"><a href="tel:{{ $product->phone }}">{{ $product->phone }}</a></p> --}}
                <p class="is-pulled-right">
                  <button class="button is-primary" @click="callPublisher({{ $product->phone }})"><i class="fa fa-phone"></i></button>
                </p>
                <p class="is-clearfix"></p>
              {{-- </div> --}}

              <p class="subtitle is-5 is-bold has-text-primary">
                {{ $product->price_range }}৳
              </p>
              <p class="subtitle is-6">
                {!! $product->description !!}
              </p>
              <hr />

              <div class="subtitle is-6">
                <p><strong>Category : </strong> {{  $product->category->name }}</p>
                <p><strong>Brand : </strong> {{  ($product->brand != NULL) ? $product->brand->name : 'Any Brand' }}</p>
                <p><strong>Size : </strong> {{  $product->size }}</p>
                <hr />

                <p><strong>Published By : </strong> {{  $product->user->name }}</p>
              </div>

              <p class="has-text-right">
                {{-- <a href="#" class="button is-large is-warning">
                  <i class="fa fa-cart-plus"></i> &nbsp; Buy this Product
                </a>
                --}}
                <button class="button is-large is-warning"
                @click="isComponentModalActive = true">
                Buy This Product
              </button>
            </p>

            <b-modal :active.sync="isComponentModalActive" has-modal-card>
              <modal-form>@include('components.login')</modal-form>
            </b-modal>


          </div>
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
      isComponentModalActive: false,
    },

    methods:{

      callPublisher(phone){
        this.$dialog.alert({
          title: 'Call Publisher',
          message: 'Call the Publisher Directly To Buy The Product. <br /> <strong>Phone No: </strong> '+phone +'<br /> <a class="button is-primary" href="tel:'+phone+'"><i class="fa fa-phone"></a></a>',
          type: 'is-primary',
          hasIcon: true,
          icon: 'phone',
          confirmText: 'Cancel',
          iconPack: 'fa'
        })
      }
    },

  });
</script>
@endsection
