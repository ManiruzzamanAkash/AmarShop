@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li class="is-active"><a href="#" aria-current="page">Manage Categories</a></li>
    </ul>
    <ul class="is-right">
      <li  class="is-right"><a href="{{ route('admin.category.create') }}" class="button button is-primary">Create New Category</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Manage Categories
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
                  <th>Parent Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @php $i=1; @endphp
                @forelse ($categories as $category)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    <a href="{{ asset("images/categories/$category->image") }}" target="blank">
                      <img src='{{ asset("images/categories/$category->image") }}' alt="" style="width: 50px">
                    </a>

                  </td>
                  <td>
                    @php
                    if($category->parent_id != NULL || $category->parent_id != 0){
                      $parent_category = App\Category::where('id', $category->parent_id)->first();
                      if($parent_category){
                        $parent_category = $parent_category->name;
                      }else{
                       $parent_category = "Parent Removed";
                     }
                   }else{
                    $parent_category = "Own";
                  }
                  @endphp
                  {{ $parent_category }}
                </td>
                <td>
                  <a href="{{ route('admin.category.edit', $category->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>
{{-- 
                  <form onsubmit="return confirm('Are you sure ? Do you want to delete the category ?')" action="{{ route('admin.category.delete', $category->id) }}" class="form-inline" method="POST" >
                    {{ csrf_field() }}
                    <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                  </form>  --}}

                  <form @submit.prevent="confirmCustomDelete({{ $category->id }})" action="{{ route('admin.category.delete', $category->id) }}" class="form-inline" method="POST" >
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
            {{ $categories->links() }}
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
  methods:{



    confirmCustomDelete(id) {
      this.$dialog.confirm({
        title: 'Deleting Category '+id,
        message: 'Are you sure you want to <b>delete</b> the category? This action cannot be undone.',
        confirmText: 'Delete Category',
        type: 'is-danger',
        hasIcon: true,
        onConfirm: () => {
          //Delete the category and toast a message
          axios.delete('/admin/category/'+id)
          .then(response=>{
            //Refresh
            document.location.reload(true)
            //this.fetchCategories()
            //
            
            app.$toast.open({
              duration: 2000,
              message: 'Category Deleted Successfully',
              type: 'is-success'
            })

          })
        }
      })
    },

    // fetchCategories(){
    //   axios.get('/admin/category/'+id)
    // }




  }
});
</script>
@endsection