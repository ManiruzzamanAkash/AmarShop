@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li><a href="{{ route('admin.brand.index') }}">brand</a></li>
    <li class="is-active"><a href="#" aria-current="page">Edit brand</a></li>
  </ul>
</nav>


<div class="columns">
  <div class="column">
    <div class="card events-card">
      <div class="">
        <header class="card-header">
          <p class="card-header-title">
            Edit brand
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-table p-l-20 p-r-20 p-b-20 p-t-2">
          <div class="content">

            <form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <b-field label="brand Name *">
                <b-input placeholder="brand Name" type="text" name="name" value="{{ $brand->name }}" required></b-input>
              </b-field>

              <b-field label="brand Description">
                <b-input maxlength="150" minlength="5" type="textarea" value="{{ $brand->description }}"  name="description"></b-input>
              </b-field>

              <b-field label="brand Old Image">
                <a @click="isImageModalActive = true">
                  <img src='{{ asset("images/brands/$brand->image") }}' alt="" style="width: 50px">
                </a>

                <b-modal :active.sync="isImageModalActive">
                  <p class="image is-4by3">
                    @if (File::exists("images/brands/$brand->image"))
                      <img src='{{ asset("images/brands/$brand->image") }}'>
                    @endif

                  </p>
                </b-modal>
              </b-field>

              <b-field label="brand Image (New)">
                <b-input type="file" name="image"></b-input>
              </b-field>

              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-primary">Save brand</button>
                </div>

                <div class="control">
                  <a href="{{ route('admin.brand.index') }}" class="button is-danger">Cancel</a>
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
