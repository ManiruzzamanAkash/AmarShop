@extends('layouts.app')


@section('stylesheets') @endsection

  @section('content')

    <section>
      <div class="container">
        <div class="columns">
          <div class="column is-8">
            <p class="has-text-centered section-title is-size-2">
              Post Your Product
            </p>


            <div class="card">
              <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <section class="p-l-10 p-r-10 p-t-10 p-b-10">

                  <b-field label="Product Title">
                    <b-input name="title" required maxlength="150" value="{{ old('title') }}"></b-input>
                  </b-field>

                  <b-field grouped>
                    <b-field label="Product Price">
                      {{-- <b-input type="number" name="price" required min=0></b-input> --}}
                      <b-field>
                        <p class="control">
                          <button class="button">
                            ৳
                          </button>
                        </p>
                        <b-input type="number" name="price" required min=0  value="{{ old('price') }}"></b-input>
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

                    <b-field label="Protuct Type">
                      <b-select placeholder="Product Type" name="status" is-expanded="true" required>
                        <option value="2">New</option>
                        <option value="1">Old</option>
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
                    <b-input type="textarea" id="description" name="description" required  value="Write your product features or qualities"></b-input>
                  </b-field>


                  <div>
                    <p class="control">
                      <span class="label">Product Featured Image</span>

                      <button @click="addNewImageField" type="button" class="m-l-10  button is-info is-pulled-right"><i class="fa fa-plus"></i></button>
                    </p>

                    <input type="file" class="file-cta m-t-10" name="image1" required>
                    <div id="more-images"></div>


                  </div>


                  <b-collapse :open="false">
                    <button class="button is-info is-small m-t-10 m-b-10 is-pulled-right" slot="trigger" type="button"> <i class="fa fa-plus"></i> For Ecommerce Products (Optional)</button>
                    <div class="is-clearfix"></div>
                    <div class="notification m-t-20">
                      <b-field grouped>
                      </b-field>
                      <b-field label="Shipping Cost">
                        <b-input type="number" name="shipping_cost">{{ old('shipping_cost') }}</b-input>
                      </b-field>
                    </b-field> <!-- End b-field grouped -->
                  </div>
                </b-collapse>
                <div class="is-clearfix"></div>

                <b-collapse :open="false">
                  <button class="button is-info is-small m-t-10 m-b-10 is-pulled-right" slot="trigger" type="button"> <i class="fa fa-plus"></i> Add Offer For Fast Buyers between expiry date (Optional)</button>
                  <div class="is-clearfix"></div>
                  <div class="notification">
                    <b-field grouped>
                      <b-field label="Offer Price">
                        <b-field>
                          <b-input type="text" value="{{ old('offer_price') }}" name="offer_price"></b-input>
                        </b-field>
                      </b-field>
                      <b-field label="Select an expiry date">
                        <b-datepicker
                        placeholder="Select Expiry Date"
                        :min-date="minDate"
                        :max-date="maxDate"
                        name="offer_expiry_date"
                        value="{{ old('offer_expiry_date') }}"
                        >
                      </b-datepicker>
                    </b-field>
                    <b-field label="Set Comment for buyer">
                      <b-input type="textarea" name="offer_message">{{ old('offer_message') }}</b-input>
                    </b-field>
                  </b-field> <!-- End b-field grouped -->
                </div>

              </b-collapse>
              <div class="is-clearfix"></div>


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
  var today = new Date();

  const app = new Vue({
    el: '#app',
    data:{
      open: false,
      image: 1,
      date: new Date(),
      minDate: new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate()),
      maxDate: new Date(this.today.getFullYear(), this.today.getMonth(), this.today.getDate() + 30)
    },
    methods:{

      addNewImageField(){
        //Add another input field as image1/image2/image3
        this.image++
        if(this.image <= 3){
          //Add one input field
          var more_images = document.getElementById('more-images')
          var create_img = document.createElement("div");
          // <input type="file" class="file-cta p-t-5"  name="image' + this.image + '"><br />
          create_img.innerHTML =  '<input type="file" class="file-cta m-t-5 "  name="image' + this.image + '"><br />'
          more_images.appendChild(create_img)

          // var objTo = document.getElementById('room_fileds')
          // var divtest = document.createElement("div");
          // divtest.innerHTML = '<div class="label">Room ' + room +':</div><div class="content"><span>Width: <input type="text" style="width:48px;" name="width[]" value="" /><small>(ft)</small> X</span><span>Length: <input type="text" style="width:48px;" namae="length[]" value="" /><small>(ft)</small></span></div>';

          // objTo.appendChild(divtest)

        }
      },


    }


  });
  </script>
@endsection
