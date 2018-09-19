@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li class="is-active"><a href="#" aria-current="page">Manage Products</a></li>
    </ul>
    <ul class="is-right">
      <li  class="is-right"><a href="{{ route('product.create') }}" class="button button is-primary">Create New Product</a></li>
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
                  <th>Name</th>
                  <th>Image</th>
                  <th>Publish status</th>
                  <th>Action</th>
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
                    <form action='{!! route('admin.product.change', ["$product->id", 'true']) !!}' method="post">
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

                    <form action="{{ route('admin.product.makeFeatured', $product->id) }}" class="form-inline" method="POST" >
                      {{ csrf_field() }}
                      <input type="hidden" name="product_id" value="{{ $product->id }}" />
                      <button type="submit" class="button is-warning"><i class="fa fa-heart"></i></button>
                    </form>

                    <form onsubmit="return confirm('Are you sure ? Do you want to delete the product ?')" action="{{ route('admin.product.delete', $product->id) }}" class="form-inline" method="POST" >
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
            {{ $products->links() }}
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
