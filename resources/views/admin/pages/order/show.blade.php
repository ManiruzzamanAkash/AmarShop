@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li><a href="{{ route('admin.order') }}">Order</a></li>
      <li class="is-active"><a href="#" aria-current="page">{{ $order->shipping->name }}'s Order</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Order Informations
          </p>
        </header>

        <div class="card-content">
          {{-- {{ $order->order_items }} --}}
          
          <div class="notification m-t-30">          
            <h3 class="has-text-weight-bold has-text-success">Product Item and Price Informations</h3>
            <table class="table is-fullwidth">
              <thead>
                <tr>
                  <th>Item No</th>
                  <th>Product Name</th>
                  <th>Price * Quantity</th>
                  <th>Company</th>
                  <th>Shipping Cost</th>
                </tr>
              </thead>
              <tbody>
                @php $i = 1; @endphp
                @foreach ($order->order_items as $item)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $item->product->title }}</td>
                  <td>
                    <p>{{ $item->product->price }} * {{ $item->item_quantity }} </p>
                    <p class="has-text-weight-bold has-text-info">= {{ $item->product->price * $item->item_quantity }} </p>
                  </td>
                  <td>
                   <a href="{{ route('user.show', $item->product->user->username) }}" title=""> {{ $item->product->user->name }}</a>
                 </td><td>
                  {{ $item->product->shipping_cost }}
                </td>
              </tr>
              @php $i++; @endphp
              @endforeach
              <tr>
                <td colspan="4" rowspan="" headers="">


                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <div class="notification m-t-30">          
          <h3 class="has-text-weight-bold has-text-success"> Transaction Related Informations</h3>
          <table class="table is-fullwidth">
            <thead>
              <tr>

                <th>Payment Method</th>
                <th>Payment Transaction</th>
                <th>Payment Informations</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

             {{--  @foreach ($order->payment as $payment) --}}
             <tr>
              <td>{{ $order->payment->payment_method->name }}</td>
              <td>{{ $order->payment->payment_transaction }}</td>
              <td>{{ $order->payment->payment_informations }}</td>
              <td>

                <form action="{{ route('admin.order.is_paid', $order->id) }}" method="post">
                  {{ csrf_field() }}
                  @if ($order->payment->is_paid)
                  <button type="submit" class="button is-danger"> <i class="fa fa-check"></i> Cancel Payment Transaction</button>
                  @else
                  <button type="submit" class="button is-success"> <i class="fa fa-check"></i> Confirm Payment Transaction</button>
                  @endif
                </form>

              </td>
            </tr>
            {{-- @endforeach --}}
          </tbody>
        </table>
      </div>

      <div class="notification m-t-30">          
        <h3 class="has-text-weight-bold has-text-success">Send Money To Company/Customers</h3>
        <div class="notification">

         @php $i = 1; @endphp
         @foreach ($order->order_items as $item)
         
         <p>{{ $item->product->price }} * {{ $item->item_quantity }} </p>
         <p class="has-text-weight-bold has-text-info">= {{ $item->product->price * $item->item_quantity }} </p>
         

         {{ $item->product->user->name }}
         {{ $item->product->shipping_cost }}
         
         @php $i++; @endphp
         @endforeach

       </div>
       @if ($order->is_completed_by_admin)
       <form action="{{ route('admin.order.deliver', $order->id) }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="button is-danger"> <i class="fa fa-check"></i>Order has deliverd !!! Cancel Delivery Now ?</button>
      </form>
      @else
      <form action="{{ route('admin.order.deliver', $order->id) }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="button is-info"> <i class="fa fa-check"></i> Distribute Money,Orders To Companies</button>
      </form>
      @endif
    </div>




  </div>

</div>
</div>
</div>
</div> <!-- End Category Index -->


@endsection

@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
});
</script>
@endsection
