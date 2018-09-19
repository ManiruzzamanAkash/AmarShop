@extends('layouts.app')

@section('title')
{{ $user->name }} | User Of Amar Shop
@endsection

@section('content')

<section class="hero">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
        <div class="column is-4">
          <div class="card">
            <div class="card-image">
              <figure class="image is-4by3">
                @if (Auth::check())
                @if ((Auth::user()->id == $user->id))
                <button @click="isCardModalActive = true" href="#" class="button is-primary is-small change-button">Change Your Profile Picture</button>
                @endif
                @endif

                <?php $image = md5($user->email); ?>
                @if ($user->is_company == 1)

                @if ($user->image == NULL || $user->image == "")
                {{-- <img src="https://www.gravatar.com/avatar/{{ $image }}?s=200&r=pg&d=404" alt="{{ $user->name }}" /> --}}
                <img src="{{ asset('images/companies/default.jpg') }}" alt="{{ $user->name }}" />
                @else
                <img src='{{ asset("images/users/$user->image") }}' alt="{{ $user->name }}" />
                @endif
                @else

                @if ($user->image == NULL || $user->image == "")
                <img src="https://www.gravatar.com/avatar/{{ $image }}?s=200&r=pg&d=404" alt="{{ $user->name }}" />
                @else
                <img src='{{ asset("images/users/$user->image") }}' alt="{{ $user->name }}" />
                @endif
                @endif


              </figure>
            </div>
            <div class="card-content">
              <div class="media">
                <div class="media-content">
                  <p class="title is-4">{{ $user->name }}</p>
                  <p class="subtitle is-6">@<a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                  <p class="button is-success">Trust Point &nbsp; <i class="fa fa-star"></i> &nbsp;{{ $user->trust_point }}</p>
                  <p>
                    <address>
                      District - {{ $user->district->name }} <br />
                      Division - {{ $user->division->name }} <br />
                      Street - {{ $user->street_address }} <br />
                    </address>
                  </p>
                  <p class="m-t-10"><strong>Contact : </strong> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>
                  <p><strong>Site : </strong> <a href="{{ $user->website }}">{{ $user->website }}</a></p>
                </div>
              </div>

              <div class="content">
                <time>{{ ($user->is_company) ? 'Company' : 'User' }} Since - {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }} </time>
              </br>
              @if (Auth::check())
                @if (Auth::id() == $user->id)
                  <h3 class="is-pulled-left">Shipping Informations</h3>
                  <a href="{{ route('user.change_shipping_address') }}" title="Edit Shipping Informations" class="is-pulled-right button is-info is-outlined">Edit Shipping Informations</a>
                  <div class="is-clearfix">
                    
                  </div>

                @endif
              @endif
              </div>
            </div>
          </div>
        </div>
        @if (Auth::check())
        <b-modal :active.sync="isCardModalActive" :width="640" scroll="keep">

          <div class="card">
            <div class="card-content">
              <div class="content">
                <div class="columns">
                  <div class="column">
                    <h3>Old Profile Picture</h3>
                    <div class="card-image">
                      <figure class="image is-128x128">
                        <?php $image = md5($user->email); ?>
                        @if ($user->is_company == 1)

                        @if ($user->image == NULL || $user->image == "")
                        {{-- <img src="https://www.gravatar.com/avatar/{{ $image }}?s=200&r=pg&d=404" alt="{{ $user->name }}" /> --}}
                        <img src="{{ asset('images/companies/default.jpg') }}" alt="{{ $user->name }}" />
                        @else
                        <img src='{{ asset("images/users/$user->image") }}' alt="{{ $user->name }}" />
                        @endif
                        @else

                        @if ($user->image == NULL || $user->image == "")
                        <img src="https://www.gravatar.com/avatar/{{ $image }}?s=200&r=pg&d=404" alt="{{ $user->name }}" />
                        @else
                        <img src='{{ asset("images/users/$user->image") }}' alt="{{ $user->name }}" />
                        @endif
                        @endif

                      </figure>
                    </div>
                  </div>
                  <div class="column">
                    <h3>Upload a New Profile Picture</h3>
                    {{-- <file-upload></file-upload> --}}
                    <form action="{{ route('user.change_profile_picture', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <label for="image">New Image</label>
                      <input type="file" class="input" id="image" name="image">
                      <button type="submit" class="button is-success">Update</button>
                    </form>
                    <button class="button is-danger is-pulled-right" @click="hideModal">Cancel</button>
                  </div>
                </div>
                </div>
              </div>
            </div>
            
          </b-modal>
          @endif



          <div class="column is-8">
            <p class="has-text-right">
              @if (Auth::check())
              @if ((Auth::user()->id == $user->id))
              <a href="{{ route('user.update_profile') }}" class="button is-primary is-outlined m-b-5"><i class="fa fa-edit"></i> &nbsp; Edit Your Informations</a>
              @endif
              @endif

            </p>
            <p>{!! $user->description !!}</p>
            <hr />

            <div class="product-list content">

              <h3>
                <span class="has-text-left is-pulled-left">{{ ($user->is_company == 1) ? 'Our' : 'My'}} Latest Products</span>
                <p class="button is-success is-pulled-right">Trust Point &nbsp;<i class="fa fa-star"></i>&nbsp;{{ $user->trust_point }}</p>
                @if (Auth::check())
                @if (Auth::user()->id != $user->id)
                <span class="has-text-right is-pulled-right">
                  <form action="{{ route('user.trust.change') }}" class="form-inline" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="trustee_id" value="{{ $user->id }}">
                    @if ($trust)
                    <b-tooltip label="Already Trusted this {{ ($user->is_company == 1) ? 'Company' : 'User'}} ! Click To remove trustness">
                      <button type="submit" class="button is-blueviolet">
                        <i class="fa fa-check"></i> &nbsp; Already Trusted this {{ ($user->is_company == 1) ? 'Company' : 'User'}}
                      </button>
                    </b-tooltip>
                    
                    @else
                    <b-tooltip label="Trust this {{ ($user->is_company == 1) ? 'Company' : 'User'}} now !!">
                      <button type="submit" class="button is-warning">
                        <i class="fa fa-check"></i> &nbsp; Trust this {{ ($user->is_company == 1) ? 'Company' : 'User'}}
                      </button>
                    </b-tooltip>
                    @endif
                  </form>
                  
                  
                </span>
                @endif
                @endif

                <span class="is-clearfix"></span>
                
              </h3>
              @php
              // $products = App\Product::where('user_id', $user->id)->where('publish_status', 1)->orderBy('id', 'desc')->paginate(20);
              // $products = App\Product::where('user_id', $user->id)->where('publish_status', 1)->orderBy('id', 'desc')->paginate(20);
              $products = $user->products()->paginate(10);
              @endphp
              @if (Auth::check())
              @if (Auth::user()->id == $user->id)
              <div class="card events-card">
                <header class="card-header">
                  <p class="card-header-title">
                    Manage Products
                    <span class="is-small has-text-grey is-size-7"> &nbsp; (Only you can see this. Other's will see a product list only)</span>
                  </p>
                </header>
                <div class="card-table">
                  <div class="content">
                    <table class="table is-fullwidth is-striped">
                      <thead>
                        <tr>
                          <th width="5%">#</th>
                          <th width="30%">Name</th>
                          <th width="15%">Image</th>
                          <th width="10%">Status</th>
                          <th width="30%">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        @forelse ($products as $product)
                        @php $i=1; @endphp
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $product->title }}</td>
                          <td>
                            <?php $image = DB::table('product_images')->where('product_id', $product->id)->first(); ?>
                            <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest" style="width: 100px;">
                          </td>
                          <td>
                            <form action='{!! route('admin.product.change', ["$product->id", 'true']) !!}' method="post" onsubmit="return confirm('Are you sure ? You want to change the status of product .. Once Unpublished, it will be invisible to all..!!')">
                              {{ csrf_field() }}
                              @if ($product->publish_status == 1)
                              <button type="submit" class="button is-danger">Unpublish</button>
                              @else
                              <button type="submit" class="button is-success">Publish</button>
                              @endif

                            </form>
                          </td>
                          <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('product.show', $product->slug) }}" class="button is-info"><i class="fa fa-eye"></i></a>

                            <form onsubmit="return confirm('Are you sure ? Do you want to delete the product ?')" action="{{ route('admin.product.delete', $product->id) }}" class="form-inline" method="POST" >
                              {{ csrf_field() }}
                              <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                            </form>

                          </td>
                          @php $i++; @endphp
                        </tr>
                        @empty
                        <tr>
                          <td colspan="4">No Data Here</td>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
                </div>
                <footer class="card-footer">
                  <div>
                    {{ $products->links() }}
                  </div>
                </footer>
              </div>
              @else
              @include('partials.products_list')
              @endif


              @else
              @include('partials.products_list')
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  @endsection


  @section('scripts')
  <script>

    const app = new Vue({
      el: '#app',
      data:{
        isCardModalActive: false
      },
      methods:{
        hideModal(){
          this.isCardModalActive = false
        }
      }
    });
  </script>
  @endsection
