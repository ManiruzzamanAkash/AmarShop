@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li class="is-active"><a href="#" aria-current="page">Manage Incomplete Orders</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Manage Products
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-table">
          <div class="content">
            <table class="table is-fullwidth is-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Orderer Name</th>
                  <th>Orderer Message</th>
                  <th>View Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($orders as $order)
                @php $i=1; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $order->shipping->name }}</td>
                  <td>{{ $order->order_message }}</td>
                  <td>
                    {{ ($order->is_completed_by_admin) ? 'Confirmed by admin': 'Not Confirmed' }}
                  </td>
                  
                  <td>

                    <a href="{{ route('admin.order.show', $order->id) }}" class="button is-success"><i class="fa fa-eye"></i></a>

                    <form action="{{ route('admin.order.deliver', $order->id) }}" class="form-inline" method="POST" >
                      {{ csrf_field() }}
                      <button type="submit" class="button is-info"><i class="fa fa-trash"></i></button>
                    </form>

                    <form onsubmit="return confirm('Are you sure ? Do you want to delete the order ?')" action="{{ route('admin.order.delete', $order->id) }}" class="form-inline" method="POST" >
                      {{ csrf_field() }}
                      <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                    </form>
{{--
                    <b-modal :active.sync="isCardModalActive{{ $category->id }}">
                      <b-notification type="is-danger" has-icon>
                        <p><strong>Are you sure ?</strong></p>
                        <p>Do You want to Delete the Category <mark>{{ $category->name }}</mark></p>

                        <form action="{{ route('admin.category.delete', $category->id) }}" class="form-inline" method="POST" >
                          {{ csrf_field() }}
                          <button type="submit" class="button is-success">Confirm Delete</button>
                          <button type="button"  @click="isCardModalActive=false" class="button is-warning">Cancel</button>
                        </form>
                      </b-notification>

                    </b-modal> --}}


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
            {{ $orders->links() }}
          </div>
          <a href="#" class="card-footer-item">View All</a>
        </footer>
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
