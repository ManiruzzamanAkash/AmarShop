@extends('admin.layouts.admin')

@section('content')

  <div id="brandIndex">
    <nav class="breadcrumb" aria-label="breadcrumbs">
      <ul class="is-left">
        <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
        <li class="is-active"><a href="#" aria-current="page">Manage brands</a></li>
      </ul>
      <ul class="is-right">
        <li  class="is-right"><a href="{{ route('admin.brand.create') }}" class="button button is-primary">Create New brand</a></li>
      </ul>
    </nav>


    <div class="columns">
      <div class="column is-12">
        <div class="card events-card">
          <header class="card-header">
            <p class="card-header-title">
              Manage brands
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

                  @php $i=1; @endphp
                  @forelse ($brands as $brand)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $brand->name }}</td>
                      <td>
                        <a href="{{ asset("images/brands/$brand->image") }}" target="blank">
                          <img src='{{ asset("images/brands/$brand->image") }}' alt="" style="width: 50px">
                        </a>

                      </td>
                      <td>
                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>
                        {{--
                        <form onsubmit="return confirm('Are you sure ? Do you want to delete the brand ?')" action="{{ route('admin.brand.delete', $brand->id) }}" class="form-inline" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                      </form>  --}}

                      <form @submit.prevent="confirmCustomDelete({{ $brand->id }})" action="{{ route('admin.brand.delete', $brand->id) }}" class="form-inline" method="POST" >
                        {{ csrf_field() }}
                        <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                      </form>



                      {{--
                      <b-modal :active.sync="isCardModalActive{{ $brand->id }}">
                      <b-notification type="is-danger" has-icon>
                      <p><strong>Are you sure ?</strong></p>
                      <p>Do You want to Delete the brand <mark>{{ $brand->name }}</mark></p>

                      <form action="{{ route('admin.brand.delete', $brand->id) }}" class="form-inline" method="POST" >
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
      {{ $brands->links() }}
    </div>
    <a href="#" class="card-footer-item">View All</a>
  </footer>
</div>
</div>
</div>
</div> <!-- End brand Index -->


@endsection

@section('scripts')
  <script>
  const app = new Vue({
    el: '#app',
    methods:{



      confirmCustomDelete(id) {
        this.$dialog.confirm({
          title: 'Deleting brand '+id,
          message: 'Are you sure you want to <b>delete</b> the brand? This action cannot be undone.',
          confirmText: 'Delete brand',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: () => {
            //Delete the brand and toast a message
            axios.delete('/admin/brand/'+id)
            .then(response=>{
              //Refresh
              document.location.reload(true)
              //this.fetchbrands()
              //

              app.$toast.open({
                duration: 2000,
                message: 'Brand has Deleted Successfully',
                type: 'is-success'
              })

            })
          }
        })
      },

      // fetchbrands(){
      //   axios.get('/admin/brand/'+id)
      // }




    }
  });
</script>
@endsection
