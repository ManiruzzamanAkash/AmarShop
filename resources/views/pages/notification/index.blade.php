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
        <b-tabs>
          <b-tab-item label="UnSeen" class="is-primary">
            <table class="table is-hoverable is-striped is-fullwidth is-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Product</th>
                  <th>Expiry Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              @php $i = 1; @endphp
              @forelse ($unseen as $notification)
              <tbody>
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ ($notification->product_id != null) ? $notification->product->title : '' }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($notification->product->offer_expiry_date)->diffForHumans() }}
                  </td>
                  <td>
                    <a href="{{ route('notification.show', $notification->id) }}" class="button is-info"><i class="fa fa-eye"></i></a>

                    <form class="form-inline" action="{!! route('notification.delete', $notification->id) !!}" method="post"  onsubmit="return confirm('Do you wan to delete the notification ? ')">
                      {{ csrf_field() }}
                      <button type="submit" class="button is-danger" onsubmit="return confirm('Do you wan to delete the notification ? ')"><i class="fa fa-trash"></i></button>

                    </form>
                  </td>
                </tr>
              </tbody>
              @php $i++; @endphp
              @empty
              <tr>
                <td>No notifications</td>
              </tr>
              @endforelse

            </table>
          </b-tab-item>

          <b-tab-item label="Seen">
            <table class="table is-hoverable is-striped is-fullwidth is-bordered">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Product</th>
                  <th>Expiry Time</th>
                  <th>Action</th>
                </tr>
              </thead>
              @php $i = 1; @endphp
              @forelse ($seen as $notification)
              <tbody>
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ ($notification->product_id != null) ? $notification->product->title : '' }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($notification->product->offer_expiry_date)->diffForHumans() }}
                  </td>
                  <td>
                    <a href="{{ route('notification.show', $notification->id) }}" class="button is-info"><i class="fa fa-eye"></i></a>

                    <form class="form-inline" action="{!! route('notification.delete', $notification->id) !!}" method="post"  onsubmit="return confirm('Do you wan to delete the notification ? ')">
                      {{ csrf_field() }}
                      <button type="submit" class="button is-danger" onsubmit="return confirm('Do you wan to delete the notification ? ')"><i class="fa fa-trash"></i></button>

                    </form>
                  </td>
                </tr>
              </tbody>
              @php $i++; @endphp
              @empty
              <tr>
                <td>No notifications</td>
              </tr>
              @endforelse

            </table>
          </b-tab-item>
        </b-tabs>


        
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
