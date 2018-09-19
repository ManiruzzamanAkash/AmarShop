@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li class="is-active"><a href="#" aria-current="page">Featured Products</a></li>
    </ul>
    <ul class="is-right">
      <li  class="is-right"><a href="{{ route('admin.product.index') }}" class="button button is-primary">Create Featured Products</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Manage Featured Products
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
                  <th>Name</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($featureds as $featured)
                @php $i=1; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $featured->product->title }}</td>

                  <td>
                    <?php $image = DB::table('product_images')->where('product_id', $featured->product->id)->first(); ?>
                    <img src="{{ asset("images/products/$image->image") }}" alt="R1 5 Latest" style="width: 100px;">
                  </td>


                  <td>
                    <a href="{{ route('admin.product.removeFeatured', $featured->product->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>

                    <form onsubmit="return confirm('Do you really remove this product from the featured list ?')" action="{{ route('admin.product.removeFeatured', $featured->product->id) }}" class="form-inline" method="POST" >
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
            {{ $featureds->links() }}
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