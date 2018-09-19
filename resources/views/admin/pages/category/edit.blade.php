@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li><a href="{{ route('admin.category.index') }}">Category</a></li>
    <li class="is-active"><a href="#" aria-current="page">Edit Category</a></li>
  </ul>
</nav>


<div class="columns">
  <div class="column">
    <div class="card events-card">
      <div class="">
        <header class="card-header">
          <p class="card-header-title">
            Edit Category
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-table p-l-20 p-r-20 p-b-20 p-t-2">
          <div class="content">

            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <b-field label="Category Name *">
                <b-input placeholder="Category Name" type="text" name="name" value="{{ $category->name }}" required></b-input>
              </b-field>

              <b-field label="Category Description">
                <b-input maxlength="150" minlength="5" type="textarea" value="{{ $category->description }}"  name="description"></b-input>
              </b-field>

              <b-field label="Category Old Image">
                <a @click="isImageModalActive = true">
                  <img src='{{ asset("images/categories/$category->image") }}' alt="" style="width: 50px">
                </a>

                <b-modal :active.sync="isImageModalActive">
                  <p class="image is-4by3">
                    @if (File::exists("images/categories/$category->image"))
                      <img src='{{ asset("images/categories/$category->image") }}'>
                    @endif
                    
                  </p>
                </b-modal>
              </b-field>

              <b-field label="Category Image (New)">
                <b-input type="file" name="image"></b-input>
              </b-field>
              
              <b-field label="Category Level">
                @if ($category->parent_id == NULL || $category->parent_id == 0)
                <strong>This is a parent ID and Can't be changed to another category</strong>
                @else
                <b-field label="Parent Category (Left Blank if this is the Parent Category)">
                  <b-select placeholder="It is the parent Category Itself" name="parent_id">
                    @foreach ($allcategories as $singleCategory)
                    @if ($singleCategory->parent_id == NULL || $singleCategory->parent_id == 0 || empty($singleCategory->parent_id))

                    @if ($category->parent_id == $singleCategory->parent_id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif


                    @endif

                    @endforeach
                  </b-select>
                </b-field>
                @endif
              </b-field>


              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-primary">Save Category</button>
                </div>

                <div class="control">
                  <a href="{{ route('admin.category.index') }}" class="button is-danger">Cancel</a>
                </div>
              </div>
            </form>
            
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
  data:{
    isImageModalActive: false
  }
});
</script>
@endsection