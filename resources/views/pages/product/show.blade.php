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



              @php
                // For Image Slideshow
              $product_images = '';
              $images = DB::table('product_images')->where('product_id', $product->id)->get();
              foreach ($images as $image) {
                $product_images .= "'". asset("images/products/$image->image") ."',";
              }
              @endphp

              <div class="column is-5">
                <figure class="image product-image-gallery">
                  <div
                  v-for="number in [currentNumber]"
                  transition="fade"
                  >
                  <img
                  :src="images[Math.abs(currentNumber) % images.length]"
                  v-on:mouseover="stopRotation"
                  v-on:mouseout="startRotation"
                  />
                </div>
                <p class="m-t-30 has-fixed-size">
                  <a class="button is-primary" @click="prev"><i class="fa fa-chevron-left"></i></a>
                  <a class="button is-primary" @click="next"><i class="fa fa-chevron-right"></i></a>
                </p>
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
                @if ($product->offer_price != null)

                @php
                $now = \Carbon\Carbon::now();
                $expire = $product->offer_expiry_date;
                @endphp

                @if ($now > $expire)
                <span class="has-text-grey-darker">{{ $product->price }}৳</span>
                @else
                <span class="button is-danger"><del>{{ $product->price }}৳</del></span>
                <span class="button is-success">{{ $product->offer_price }}৳</span>

                

                <b-tooltip label="Offer Expire last time - {{ \Carbon\Carbon::parse($product->offer_expiry_date)->diffForHumans() }}" type="is-warning" multilined size="is-large">
                 <span class="button is-info"><i class="fa fa-question-circle-o"></i></span>
               </b-tooltip>

               @endif

               @endif


             </p>

             <hr />

             <div class="subtitle is-6">
              <p><strong><i class="fa fa-tags"></i> Category : </strong> <a href="{{ route('product.category.index', $product->category->slug) }}">{{  $product->category->name }}</a></p>

              <p><strong><i class="fa fa-hdd-o"></i> Brand : </strong> <a href="{{ route('product.brand.index', $product->brand->slug) }}">{{  $product->brand->name }}</a></p>
              
              <p><strong><i class="fa fa-file"></i> Size : </strong> {{  $product->size }}</p>
              <hr />
            </div>
            <div>
              <p><strong>Full Features</strong></p>
              <p class="subtitle is-6">
                {!! $product->description !!}
              </p>
              <hr />
            </div>
            <div>
              <p><strong><i class="fa fa-user"></i> Published By : </strong>
                <a href="{!! route('user.show', $product->user->username) !!}">

                  @if (Auth::check())
                  @if ($product->user->id == Auth::user()->id)
                  Me - 
                  @endif
                  @endif
                  {{  $product->user->name }}
                  {{-- @endif --}}
                </a>
              </p>
              <hr />
            </div>


            <p class="has-text-right">
                  {{-- <a href="#" class="button is-large is-warning">
                  <i class="fa fa-cart-plus"></i> &nbsp; Buy this Product
                </a>
                --}}
                <form class="form-inline" action="{!! route('wishlist.store') !!}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="user_id" value="{{ (Auth::check()) ? Auth::user()->id : '' }}">

                  @if ($wishlist != null)
                  <b-tooltip label="Aleardy Added this product in the wishlist. Click to remove from wishlist.">
                    <button type="submit" class="button is-primary" style="background: blueviolet"><i class="fa fa-heart"></i></button>
                  </b-tooltip>
                  @else
                  <b-tooltip label="Click to add the product in the wishlist !!">
                    <button type="submit" class="button is-primary"><i class="fa fa-heart"></i></button>
                  </b-tooltip>
                  @endif

                </form>


                {{-- <button class="button is-warning"
                @click="isComponentModalActive = true">
                Buy This Product
              </button> --}}
            </p>

            <b-modal :active.sync="isComponentModalActive" has-modal-card>
              <modal-form>@include('components.login')</modal-form>
            </b-modal>


          </div>
        </div>

      </div>
    </div>

    <div class="similar-products m-t-30">
      <div class="card">
        <div class="card-header card-header-title">
          <h3>Similar Products</h3>
        </div>
        <div class="card-content">
          <div class="columns">
            @forelse ($similar_products as $product)

            <div class="card">
              <div class="card-image">
                <figure class="image is-4by3">
                  <?php $image = DB::table('product_images')->where('product_id', $product->id)->first(); ?>

                  <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest" style="">
                </figure>
              </div>
              <div class="card-content">
                <div class="media">
                  
                  <div class="media-content">
                    <p class="title is-4"><a href="{{ route('product.show', $product->slug) }}" title="">{{ $product->title }}</a></p>
                    <p class="subtitle is-6 is-font has-text-primary">{{ $product->price }}৳</p>
                  </div>
                </div>
              </div>
            </div>


            @empty
            <p class="has-text-danger">No Products has found in this category</p>
            @endforelse
            

           {{--  <div class="column">
              <div class="card">
                <div class="content">
                  <h2>Product 1</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex </p>
                </div>
              </div>
            </div>

            <div class="column">
              <div class="card">
                <div class="content">
                  <h2>Product 1</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex .</p>
                </div>
              </div>
            </div> --}}


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


      images: [
      {!!  $product_images !!}
      ],

      currentNumber: 0,
      timer: null
    },

    ready: function () {
      this.startRotation();
    },

    methods:{


      startRotation: function() {
        this.timer = setInterval(this.next, 3000);
      },

      stopRotation: function() {
        clearTimeout(this.timer);
        this.timer = null;
      },

      next: function() {
        this.currentNumber += 1
      },
      prev: function() {
        this.currentNumber -= 1
      },



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
