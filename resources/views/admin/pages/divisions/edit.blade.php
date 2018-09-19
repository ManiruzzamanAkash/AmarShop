@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li><a href="{{ route('admin.division.index') }}">Division</a></li>
    <li class="is-active"><a href="#" aria-current="page">Edit Division - {{ $division->name }}</a></li>
  </ul>
</nav>

<div class="columns">
  <div class="column is-12">
    <div class="card events-card">
      <header class="card-header">
        <p class="card-header-title">
          Edit Division
        </p>
        <a href="#" class="card-header-icon" aria-label="more options">
          <span class="icon">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
          </span>
        </a>
      </header>
      <div class="card-table">
        <div class="content p-t-30 p-b-30 p-l-30 p-r-30">
          <form action="{{ route('admin.division.update', $division->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <b-field label="Division Name *">
              <b-input placeholder="Division Name" type="text" name="name" value="{{ $division->name }}" required ></b-input>
            </b-field>

            <b-field label="Previous Image For {{ $division->name }}">
              <p><img src="{{ asset("images/divisions/$division->image") }}" alt="{{ $division->name }}" style="width: 50px"></p>
            </b-field>

            <b-field label="Division New Image (Optional)">
              <b-input type="file" name="image"></b-input>
            </b-field>


            <div class="field is-grouped">
              <div class="control">
                <button type="submit" class="button is-primary">Update Division</button>
              </div>
              <div class="control">
                <a href="{{ route('admin.division.index') }}" class="button is-danger">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <footer class="card-footer">
        <a href="#" class="card-footer-item">View All</a>
      </footer>
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