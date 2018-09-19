@extends('admin.layouts.admin')

@section('content')
<div v-cloak>
  
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li><a href="{{ route('admin.category.index') }}">Category</a></li>
      <li class="is-active"><a href="#" aria-current="page">Create Category</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column">
      <div class="card events-card">
        <div class="">
          <header class="card-header">
            <p class="card-header-title">
              Create Category
            </p>
            <a href="#" class="card-header-icon" aria-label="more options">
              <span class="icon">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </span>
            </a>
          </header>
          <div class="card-table p-l-20 p-r-20 p-b-20 p-t-2">
            <div class="content">

              <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <b-field label="Category Name *">
                  <b-input placeholder="Category Name" type="text" name="name" required></b-input>
                </b-field>

                <b-field label="Category Description">
                  <b-input maxlength="150" minlength="5" type="textarea" name="description"></b-input>
                </b-field>

                <b-field label="Category Image (Optional)">
                  <b-input type="file" name="image"></b-input>
                </b-field>

                <b-field label="Parent Category (Left Blank if this is the Parent Category)">
                  <b-select placeholder="It is the parent Category Itself" name="parent_id">
                    @foreach ($categories as $category)
                    @if ($category->parent_id == NULL || $category->parent_id == 0 || empty($category->parent_id))
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                    
                    @endforeach
                  </b-select>
                </b-field>


                <div class="field is-grouped">
                  <div class="control">
                    <button type="submit" class="button is-primary">Save Category</button>
                  </div>

                  <div class="control">
                    <button type="reset" class="button is-danger">Cancel</button>
                  </div>
                </div>
              </form>
              



            </div>
          </div>
        </div>    


      </div>
    </div>

  </div>
</div>

@endsection
@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
});
</script>
@endsection