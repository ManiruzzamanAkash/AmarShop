@extends('layouts.app')
@section('stylesheets') @endsection
  @section('content')


    <section>
      <div class="container">
        <div class="columns">
          <div class="column is-8">
            <p class="has-text-centered section-title is-size-2">
              Post Your Product Request
            </p>


            <div class="card">
              <form action="{{ route('product.request') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <section class="p-l-10 p-r-10 p-t-10 p-b-10">

                  <b-field label="Product Title">
                    <b-input name="title" required maxlength="150" value="{{ old('title') }}"></b-input>
                  </b-field>

                  <b-field grouped>
                    <b-field label="Price range">
                      {{-- <b-input type="number" name="price" required min=0></b-input> --}}
                      <b-field>
                        <p class="control">
                          <button class="button">
                            ৳
                          </button>
                        </p>
                        <b-input type="text" name="price_range" required min=0  value="{{ old('price_range') }}" placeholder="200-500"></b-input>
                      </b-field>
                    </b-field>


                    <b-field label="Division">
                      <b-select placeholder="Select a division" name="division" required>
                        @foreach ($divisions as $division)
                          <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                      </b-select>

                    </b-field>

                    <b-field label="District">
                      <b-select placeholder="Select a District" name="district" required>
                        @foreach ($districts as $district)
                          <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                      </b-select>
                    </b-field>

                  </b-field> <!-- End b-field grouped -->


                  <b-field grouped>

                    <b-field label="Your Phone">
                      {{-- <b-input type="number" name="price" required min=0></b-input> --}}
                      <b-field>
                        <b-input type="text" value="{{ Auth::user()->phone }}" name="phone" required></b-input>
                      </b-field>
                    </b-field>

                    <b-field label="Product Category">
                      <b-select placeholder="Select a Category" name="category" required>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </b-select>
                    </b-field>

                    <b-field label="Product Size">
                      <b-select placeholder="Select a Size" name="size" required>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                      </b-select>
                    </b-field>

                    <b-field label="Product Brand">
                      <b-select placeholder="Select a Brand" name="brand">
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      </b-select>
                    </b-field>

                  </b-field> <!-- End b-field grouped -->



                  <b-field label="Product Description">
                    <b-input type="textarea" id="description" name="description" required  value="Write more about your requestd product (if you want)"></b-input>
                  </b-field>

                  <b-field label="Have you any demo product">
                    <b-input type="file" name="image1" value="{{ old('image1') }}"></b-input>
                  </b-field>


                <div class="field is-grouped m-t-20">
                  <div class="control">
                    <button type="submit" class="button is-primary">Publish Product</button>
                  </div>
                  <div class="control">
                    <a href="{{ route('index') }}" class="button is-danger">Cancel</a>
                  </div>
                </div>

              </section>
            </form>
          </div> <!-- End form card div -->



        </div>
        <div class="column is-4">
          <p class="has-text-centered section-title is-size-3">
            Featured Product
          </p>

          @forelse ($featureds as $featured)
            <div class="card" onclick="document.location='{{ route('product.show', $featured->product->slug) }}'" style="cursor: pointer">
              <div class="card-image">
                <td>
                  <?php $image = DB::table('product_images')->where('product_id', $featured->product->id)->first(); ?>
                  <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest">
                </td>
              </div>
              <div class="card-content">
                <div class="media">
                  <div class="media-content">
                    <p class="title is-4">{{ $featured->product->title }}</p>
                    <p class="subtitle is-6">{{ $featured->product->price }}৳</p>
                  </div>
                </div>

                <div class="content">
                  Posted {{ \Carbon\Carbon::parse($featured->product->created_at)->diffForHumans() }}
                </div>
              </div>
            </div>
          @empty
            {{-- empty expr --}}
          @endforelse


        </div>
      </div>
    </div>
  </section>


@endsection


@section('scripts')

  <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
  <script>
  tinymce.init({
    selector:'#description' ,
    // plugins:'link code image imagetools',
    plugins:['autolink lists link image preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime table'],

    toolbar1: ' styleselect | bold italic underline hr link image | bullist numlist | table insert searchreplace undo redo | fontselect  preview code ',
    image_advtab: true,
    menubar:false
  });</script>

  <script>

  const app = new Vue({
    el: '#app',
    data:{
      image: 1,
    },
    methods:{

    }
  });
  </script>
@endsection
