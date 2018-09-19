
<nav class="navbar m-b-5 is-primary is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="container">

    <div class="navbar-brand">
      <a class="navbar-item" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Amar Shop" width="112" height="50">
      </a>

      <div class="navbar-burger burger" data-target="navMenu">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

    <div class="navbar-menu"  id="navMenu">
      <div class="navbar-start">
        <a href="{{ route('index') }}" class="navbar-item"> Home </a>
        {{-- <a href="{{ route('product.index') }}" class="navbar-item {{ ( (Route::currentRouteName() == 'product.index') || (Route::currentRouteName() == 'product.show') ) ? 'is-active' : '' }}"> Products </a> --}}

        <div class="navbar-item has-dropdown is-hoverable is-mega">
          <div class="navbar-link">
            Products
          </div>
          <div id="blogDropdown" class="navbar-dropdown">
            <div class="container is-fluid">
              <div class="columns">
                <div class="column">
                  <h1 class="title is-6 is-mega-menu-title"> Product Ads</h1>
                  @php
                  $postproducts = App\Product::orderBy('id', 'desc')->where('publish_status', 1)->limit(4)->get();
                  $requestproducts = App\Productrequest::orderBy('id', 'desc')->where('publish_status', 1)->limit(5)->get();
                  @endphp
                  @foreach ($postproducts as $product)
                  <a class="navbar-item" href="{!! route('product.show', $product->slug) !!}">
                    <div class="navbar-content">
                      <div class="columns">
                        <div class="column is-3">
                          @php $image = DB::table('product_images')->where('product_id', $product->id)->first(); @endphp
                          <img src="{{ asset("images/products/$image->image") }}" alt="{{ $product->title }}" style="width: 150px;">
                        </div>
                        <div class="column is-9">
                          <p>{{ $product->title }}</p>
                          <p>
                            <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                          </p>
                        </div>
                      </div>

                    </div>
                  </a>
                  @endforeach


                  <a href="{{ route('product.index') }}" class="navbar-item button is-full is-success"> More products to buy</a>
                </div>
                <div class="column">
                  <h1 class="title is-6 is-mega-menu-title">Product Requested</h1>

                  @foreach ($requestproducts as $product)
                  <a class="navbar-item" href="{!! route('product.request_products.show', $product->slug) !!}">
                    <div class="navbar-content">
                      <div class="columns">
                        <div class="column is-3">
                          @if (($product->image == NULL) || ($product->image == ""))
                          <img src="{{ asset("images/product_requests/default.png") }}" alt="{{ $product->title }}" style="width:100px" >
                          @else
                          <img src="{{ asset("images/product_requests/$product->image") }}" alt="{{ $product->title }}" style="width:100px">
                          @endif
                        </div>
                        <div class="column is-9">
                          <p>{{ $product->title }}</p>
                          <p>
                            <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                          </p>
                        </div>
                      </div>

                    </div>
                  </a>
                  @endforeach

                  <a href="{{ route('product.request_products') }}" class="navbar-item button is-full is-success"> More products to sell</a>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- End Mega Menu For Products-->

        <div class="navbar-item has-dropdown is-hoverable is-mega">
          <div class="navbar-link">
            Categories
          </div>
          <div id="blogDropdown" class="navbar-dropdown">
            <div class="container is-fluid">
              <b-tabs>
                @php
                $categories = App\Category::orderBy('id', 'desc')->get();
                @endphp

                @php $i = 1; @endphp
                @foreach ($categories as $category)
                @if (($category->products()->count() > 0) && ($i <= 5))
                @php $i++; @endphp
                <b-tab-item label="{{ $category->name }}">

                  <div class="columns">
                    <div class="column">
                      <h1 class="title is-6 is-mega-menu-title"> Product Ads</h1>
                      @php
                      $postproducts = App\Product::orderBy('id', 'desc')->where('publish_status', 1)->where('category_id', $category->id)->limit(5)->get();
                      $requestproducts = App\Productrequest::orderBy('id', 'desc')->where('publish_status', 1)->where('category_id', $category->id)->limit(5)->get();
                      @endphp
                      @foreach ($postproducts as $product)
                      <a class="navbar-item" href="{!! route('product.show', $product->slug) !!}">
                        <div class="navbar-content">
                          <div class="columns">
                            <div class="column is-3">
                              @php $image = DB::table('product_images')->where('product_id', $product->id)->first(); @endphp
                              <img src="{{ asset("images/products/$image->image") }}" alt="{{ $product->title }}" style="width: 150px;">
                            </div>
                            <div class="column is-9">
                              <p>{{ $product->title }}</p>
                              <p>
                                <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                              </p>
                            </div>
                          </div>

                        </div>
                      </a>
                      @endforeach

                    </div>
                    <div class="column">
                      <h1 class="title is-6 is-mega-menu-title">Product Requested</h1>

                      @foreach ($requestproducts as $product)
                      <a class="navbar-item" href="{!! route('product.request_products.show', $product->slug) !!}">
                        <div class="navbar-content">
                          <div class="columns">
                            <div class="column is-3">
                              @if (($product->image == NULL) || ($product->image == ""))
                              <img src="{{ asset("images/product_requests/default.png") }}" alt="{{ $product->title }}" style="width:100px" >
                              @else
                              <img src="{{ asset("images/product_requests/$product->image") }}" alt="{{ $product->title }}" style="width:100px">
                              @endif
                            </div>
                            <div class="column is-9">
                              <p>{{ $product->title }}</p>
                              <p>
                                <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                              </p>
                            </div>
                          </div>

                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  <a href="{!! route('product.category.index', $category->slug) !!}" class="button is-full is-success">More in {{ $category->name }} category</a>

                </b-tab-item>
                @endif
                @endforeach
                <b-tab-item label="More">
                  <a href="{!! route('categories') !!}" class="button is-full is-success"> See All Categories</a>
                </b-tab-item>
              </b-tabs>
            </div>
          </div>
        </div> <!-- End Mega Menu For Products Categories-->

        <div class="navbar-item has-dropdown is-hoverable is-mega">
          <div class="navbar-link">
            Brands
          </div>
          <div id="blogDropdown" class="navbar-dropdown">
            <div class="container is-fluid">
              <b-tabs>
                @php
                $brands = App\Brand::orderBy('id', 'desc')->get();
                @endphp

                @php $i = 1; @endphp
                @foreach ($brands as $brand)
                @if (($brand->products()->count() > 0) && ($i <= 4))
                @php $i++; @endphp
                <b-tab-item label="{{ $brand->name }}">

                  <div class="columns">
                    <div class="column">
                      <h1 class="title is-6 is-mega-menu-title"> Product Ads</h1>
                      @php
                      $postproducts = App\Product::orderBy('id', 'desc')->where('publish_status', 1)->where('brand_id', $brand->id)->limit(3)->get();
                      $requestproducts = App\Productrequest::orderBy('id', 'desc')->where('publish_status', 1)->where('brand_id', $brand->id)->limit(3)->get();
                      @endphp
                      @foreach ($postproducts as $product)
                      <a class="navbar-item" href="{!! route('product.show', $product->slug) !!}">
                        <div class="navbar-content">
                          <div class="columns">
                            <div class="column is-3">
                              @php $image = DB::table('product_images')->where('product_id', $product->id)->first(); @endphp
                              <img src="{{ asset("images/products/$image->image") }}" alt="{{ $product->title }}" style="width: 150px;">
                            </div>
                            <div class="column is-9">
                              <p>{{ $product->title }}</p>
                              <p>
                                <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                              </p>
                            </div>
                          </div>

                        </div>
                      </a>
                      @endforeach

                    </div>
                    <div class="column">
                      <h1 class="title is-6 is-mega-menu-title">Product Requested</h1>

                      @foreach ($requestproducts as $product)
                      <a class="navbar-item" href="{!! route('product.request_products.show', $product->slug) !!}">
                        <div class="navbar-content">
                          <div class="columns">
                            <div class="column is-3">
                              @if (($product->image == NULL) || ($product->image == ""))
                              <img src="{{ asset("images/product_requests/default.png") }}" alt="{{ $product->title }}" style="width:100px" >
                              @else
                              <img src="{{ asset("images/product_requests/$product->image") }}" alt="{{ $product->title }}" style="width:100px">
                              @endif
                            </div>
                            <div class="column is-9">
                              <p>{{ $product->title }}</p>
                              <p>
                                <small class="has-text-info">Posted {{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</small>
                              </p>
                            </div>
                          </div>

                        </div>
                      </a>
                      @endforeach
                    </div>
                  </div>
                  <a href="{!! route('product.brand.index', $brand->slug) !!}" class="button is-full is-success">More in {{ $brand->name }} brand</a>

                </b-tab-item>
                @endif
                @endforeach
                <b-tab-item label="More">
                  <a href="{!! route('brands') !!}" class="button is-full is-success"> See All Brands</a>
                </b-tab-item>
              </b-tabs>
            </div>
          </div>
        </div> <!-- End Mega Menu For Products Categories-->

        <div class="navbar-end">

          <div class="navbar-item">
            @include('components/searchProduct')
          </div>
          <a class="navbar-item" href="{{ route('search') }}" title="">Advance Search</a>

          {{-- <div href="navbar-item"> --}}
            {{-- <p class="control m-t-20"> --}}
              {{-- @include('components/buttons/give_ads') --}}
              <a href="{{ route('cart') }}" class="navbar-item">
                <i class="fa fa-cart-size fa-cart-plus"></i>
                <span class="tag is-warning">{{ Cart::count() }}</span>
              </a>
            {{-- </p> --}}
          {{-- </div> --}}




          @if (Auth::check())
          @php
          $wishlist = App\Wishlist::where('user_id', Auth::user()->id);
          $notification = App\Notification::where('user_id', Auth::user()->id)->where('status', 0);
          @endphp
          
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              {{ (Auth::check()) ? Auth::user()->name : '' }}
              @if ( $notification->count() != 0)
              <span class="tag is-warning"> {{ $notification->count() }}</span>
              @endif
              
            </a>

            <div class="navbar-dropdown">
                {{-- @if (Auth::user()->is_company == 0)
                <!--This is a User-->
                <a href="{{ route('user.show', Auth::user()->username) }}" class="navbar-item"><i class="fa fa-user"></i> &nbsp; Account </a>

              @elseif(Auth::user()->is_company == 1)
              <!--This is a Company-->

              <a href="{{ route('company.show', Auth::user()->username) }}" class="navbar-item"><i class="fa fa-user"></i> &nbsp; Account </a>

              @endif --}}
              
              <a href="{{ route('user.show', Auth::user()->username) }}" class="navbar-item"><i class="fa fa-user"></i> &nbsp; Profile </a>

              <a href="{{ route('user.dashboard') }}" class="navbar-item"><i class="fa fa-user"></i> &nbsp; Dashboard </a>

              <a href="{{ route('product.create') }}" class="navbar-item"><i class="fa fa-cart-plus"></i> &nbsp; Post Sell Product </a>

              <a href="{{ route('product.request') }}" class="navbar-item"><i class="fa fa-cart-plus"></i> &nbsp; Request Sell Product </a>

              <a href="{{ route('notification') }}" class="navbar-item"><i class="fa fa-bell"></i> &nbsp; Notifications  <span class="tag is-warning"> {{ $notification->count() }} </span> </a>


              <a href="{{ route('wishlist') }}" class="navbar-item"><i class="fa fa-bell"></i> &nbsp; Wishlists  <span class="tag is-warning"> {{ $wishlist->count()}} </span> </a>

              <a  class="navbar-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i>
              &nbsp; Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>



          </div>
        </div>
        @else
        {{-- <a href="{{ route('login') }}" class="navbar-item">Login</a> --}}

{{--       <b-dropdown position="is-bottom-left">
        <a class="navbar-item" slot="trigger">
          <span>Login</span>
          <b-icon icon="arrow_drop_down"></b-icon>
        </a>

        <b-dropdown-item custom paddingless>

          @include('components.login')

        </b-dropdown-item>
      </b-dropdown> --}}
      <div class="navbar-item has-dropdown is-hoverable">
        <div class="navbar-link">
          Login
        </div>
        <div id="" class="navbar-dropdown">
          @include('components.login')
        </div>

      </div>

      <a href="{{ route('register') }}" class="navbar-item">Sign Up</a>

      @endif

    </div>

  </div>  <!-- Nav menu -->


</div> <!-- Nav Container -->
</nav>
