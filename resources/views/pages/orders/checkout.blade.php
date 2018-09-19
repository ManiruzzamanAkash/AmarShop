@extends('layouts.app')

@section('content')

<section class="hero m-b-5 p-b-30">
  <div class="container content">
    <h2 class="section-title m-b-30">Checkout</h2>
    @if (Cart::count() > 0)
    <form action="{{ route('order.store') }}" method="post">
      {{ csrf_field() }}

      <b-collapse class="card" :open.sync="isOpenStep1" id="orderInfo">
        <div slot="trigger" class="card-header">
          <p class="card-header-title">
            Step 1 - Order Total Informations
          </p>
          <a class="card-header-icon">
            <b-icon :icon="isOpenStep1 ?
            'chevron-down' : 'chevron-up'">
          </b-icon>
        </a>
      </div>
      <div class="card-content">
        <div class="content">
          <table class="table is-bordered">
            <thead>
              <tr>
                <th colspan="2" class="is-info">Order Informations</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Total Item :</th>
                <td>{{ Cart::count() }}</td>
              </tr>
              <tr>
                <th>Total Price For Products :</th>
                <td>৳ {{ Cart::total() }}</td>
              </tr>
              <tr>
                <th>Total Companies For Products</th>
                <td>
                  @foreach (Cart::content() as $cart)
                  <a class="button is-primary is-outlined" href="{{ route('user.show', get_user_or_company($cart->id)->username) }}">{{ get_user_or_company($cart->id)->name }}</a> &nbsp;
                  @endforeach
                </td>
              </tr>
              <tr>
                <th> Full Price with cost</th>
                <td> 
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Product Price</td>
                        <td>৳ {{ Cart::total() }}</td>
                      </tr>
                      <tr>
                        <td>Shipping Cost</td>
                        <td>
                          @php $shipping_cost = 0; @endphp
                          @foreach (Cart::content() as $cart)
                          @php $shipping_cost += 100; @endphp
                          @endforeach
                          ৳ {{ $shipping_cost }}
                          (Per Company ৳100)
                        </td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td><strong>৳ {{ Cart::total() + $shipping_cost }}</strong></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
          <b-message type="is-danger" class="is-danger">
            If you any problem in this order items ..!!! Then Edit them in <a href="{{ route('cart') }}" title="Go To Cart Page" class="button is-warning">Cart Page</a>
          </b-message>

          <a class="button is-info is-pulled-right" @click="step1CompleteBtn" >Continue</a>
          <div class="is-clearfix"></div>
        </div>
      </div>
    </b-collapse>



    <b-collapse class="card" :open.sync="isOpenStep2" id="shippingAddress">
      <div slot="trigger" class="card-header">
        <p class="card-header-title">
          Step 2 - Shipping Address Set Up
        </p>
        <a class="card-header-icon">
          <b-icon :icon="isOpenStep2 ?
          'chevron-down' : 'chevron-up'">
        </b-icon>
      </a>
    </div>
    <div class="card-content">
      <div class="content">
        <input type="hidden" name="shipping_id" value="{{ ($shipping_address)? $shipping_address->id : '' }}">
        <b-field grouped>
          <b-field label="Name" expanded>
            <b-field>
              <b-input id="shipping_name" name="name" placeholder="Enter name for shipping product" value="{{ ($shipping_address)? $shipping_address->name : '' }}" required v-if=""></b-input>
            </b-field>
          </b-field>
          <b-field label="Email (Optional)" expanded>
            <b-input placeholder="some@email.com" type="email" name="email" value="{{ ($shipping_address)? $shipping_address->email : '' }}"></b-input>
          </b-field>
        </b-field>

        <b-field grouped>
          <b-field label="Division" expanded>
            <div class="control">
              <div class="select">
                <select placeholder="Select a division" name="division_id" v-on:change="onChangeDivision" required expanded>

                  <option value="">Select a division please</option>
                  @foreach ($divisions as $division)
                  <option value="{{ $division->id }}">{{ $division->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </b-field>
          <b-field label="District" expanded>

           {{--  <select placeholder="Select a district" v-on:change="onChangeDistricts" name="district" required  expanded>
              @foreach ($districts as $district)
              <option value="{{ $district->id }}">{{ $district->name }}</option>
              @endforeach
            </select> --}}
            <div class="control">
              <div class="select">
                <select placeholder="Select a district" v-on:change="onChangeDistricts" name="district_id" required  expanded>
                  <option value="">Select a district please</option>
                  <option v-for="district in districts" v-bind:value="district.id">
                    @{{ district.name }}
                  </option>
                </select>
              </div>
            </div>

          </b-field>
          <b-field label="Upazilla" expanded>
            <div class="control">
              <div class="select">
               <select placeholder="Select a upazilla" name="upazilla_id" required expanded>
              {{-- @foreach ($upazillas as $upazilla)
              <option value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
              @endforeach --}}
              <option value="">Select a upazilla please</option>
              <option v-for="upazilla in upazillas" v-bind:value="upazilla.id">
                @{{ upazilla.name }}
              </option>
            </select>
          </div>
        </div>


      </b-field>
    </b-field>
    <b-field grouped>
     <b-field label="Street Address 1" expanded>
      <b-input placeholder="Street Address" name="street_address1" maxlength="100" required value="{{ ($shipping_address)? $shipping_address->street_address1 : '' }}"></b-input>
    </b-field>
    <b-field label="Street Address 2 (Optional)" expanded>
      <b-input placeholder="Street Address" name="street_address2" maxlength="100" value="{{ ($shipping_address)? $shipping_address->street_address2 : '' }}"></b-input>
    </b-field>
  </b-field>
  <b-field grouped>

    <b-field label="Phone Number" expanded>
      <b-input placeholder="Phone Number" name="phone" maxlength="15" required value="{{ ($shipping_address)? $shipping_address->phone : '' }}"></b-input>
    </b-field>    
    <b-field label="Courier Address" expanded>
      <b-input placeholder="Courier Address" name="courier_address" maxlength="150" required value="{{ ($shipping_address)? $shipping_address->courier_address : '' }}"></b-input>
    </b-field>

  </b-field>




  <a class="button is-info is-pulled-right" @click="step2CompleteBtn" >Continue</a>
  <div class="is-clearfix"></div>
</div>
</div>
</b-collapse>



<b-collapse class="card" :open.sync="isOpenStep3" id="payment_method">
  <div slot="trigger" class="card-header">
    <p class="card-header-title">
      Step 3 - Payment Method
    </p>
    <a class="card-header-icon">
      <b-icon :icon="isOpenStep3 ?
      'chevron-down' : 'chevron-up'">
    </b-icon>
  </a>
</div>
<div class="card-content">
  <div class="content">
    <div class="columns">
      @foreach ($payment_methods as $payment)
      <div class="column">
        <b-radio native-value="{{ $payment->id }}" name="payment_method_id">
          <img src='{{ asset("images/payment_methods/$payment->image") }}' style="width: 100px">
          <br />
          {{ $payment->name }} 


        </b-radio>
      </div>
      @endforeach
    </div>
    
    

    <div class="card">
      <div class="card-content">
        <h4>Enter Transaction details</h4>
        <b-field grouped>
         <b-field label="Transaction ID" expanded>
          <b-input placeholder="Bkash Transaction ID" name="payment_transaction" maxlength="100" required></b-input>
        </b-field>
        <b-field label="Transaction Informations" expanded>
          <b-input placeholder="Provide All informations about transaction Like Send Money From, Send Money To, Total Amount etc." name="payment_informations" maxlength="500" type="textarea" required>
          </b-input>
        </b-field>
      </b-field>
    </div>
  </div>


  <a class="button is-info is-pulled-right" @click="step3CompleteBtn" >Continue</a>
  <div class="is-clearfix"></div>
</div>
</div>
</b-collapse>

<b-collapse class="card" :open.sync="isOpenStep4" id="order_message">
  <div slot="trigger" class="card-header">
    <p class="card-header-title">
      Step 4 - Order Custom Message
    </p>
    <a class="card-header-icon">
      <b-icon :icon="isOpenStep4 ?
      'chevron-down' : 'chevron-up'">
    </b-icon>
  </a>
</div>
<div class="card-content">
  <div class="content">
   <b-field label="Order Additional Message (If Any)" expanded>
    <b-input placeholder="Order Additional Message (If Any)" name="order_message" maxlength="500" type="textarea"></b-input>
  </b-field>


  <input type="submit" class="button is-info is-pulled-right" value="Confirm" />
  <div class="is-clearfix"></div>
</div>
</div>
</b-collapse>



</form>
@else
<div class="card">
  <b-message type="is-info">
    <p>
      <strong>Sorry !!! There is no item in your cart.. Please add a product in your cart and do checkout</strong> <br />
      <a href="{{ route('product.index') }}" title="" class="button is-warning">Go Product Page</a>
    </p>
  </b-message>
</div>
@endif





@if (Auth::check())
{{-- Try to find out the Users Shipping Address --}}
@if ($shipping_address != null)
{{-- expr --}}
@endif
@else

{{-- Try to find out the Shipping Address for this IP Address--}}
@endif

</div>
</section>



@endsection


@section('scripts')
<script>
  const app = new Vue({
    el: '#app',
    data:{
      isOpenStep1: true,
      isOpenStep2: false,
      isOpenStep3: false,
      isOpenStep3: false,
      isOpenStep4: false,
      divisions : [],
      districts : [],
      upazillas : [],
    },
    methods:{

      onChangeDivision: function(event){
        var division_id = event.srcElement.value
        //Find the districts by this division and change the districts array
        axios.get("/api/get_districts/"+division_id)
        .then(response => {
          this.districts = response.data
        })
      },
      onChangeDistricts: function(event){
        var district_id = event.srcElement.value
        //Find the districts by this division and change the districts array
        axios.get("/api/get_upazillas/"+district_id)
        .then(response => {
          this.upazillas = response.data
        })
      },

      step1CompleteBtn: function()
      {
        this.isOpenStep1 = false
        this.isOpenStep3 = false
        this.isOpenStep2 = true
        document.getElementById("shipping_name").focus();
      },
      step2CompleteBtn: function()
      {
        this.isOpenStep1 = false
        this.isOpenStep2 = false
        this.isOpenStep3 = true
      },
      step3CompleteBtn: function()
      {
        this.isOpenStep1 = false
        this.isOpenStep2 = false
        this.isOpenStep3 = false
        this.isOpenStep4 = true
      }

    }
  });
</script>
@endsection
