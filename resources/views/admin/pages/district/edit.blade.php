@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li><a href="{{ route('admin.district.index') }}">District</a></li>
    <li class="is-active"><a href="#" aria-current="page">Edit District - {{ $district->name }}</a></li>
  </ul>
</nav>

<div class="columns">
  <div class="column is-12">
    <div class="card events-card">
      <header class="card-header">
        <p class="card-header-title">
          Edit District
        </p>
        <a href="#" class="card-header-icon" aria-label="more options">
          <span class="icon">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
          </span>
        </a>
      </header>
      <div class="card-table">
        <div class="content p-t-30 p-b-30 p-l-30 p-r-30">
          <form action="{{ route('admin.district.update', $district->id) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <b-field label="District Name *">
              <b-input placeholder="District Name" type="text" name="name" value="{{ $district->name }}" required ></b-input>
            </b-field>

            <b-field label="Previous Image For {{ $district->name }}">
              <p><img src="{{ asset("images/districts/$district->image") }}" alt="{{ $district->name }}" style="width: 50px"></p>
            </b-field>

            <b-field label="District New Image (Optional)">
              <b-input type="file" name="image"></b-input>
            </b-field>

            <b-field label="Division">
              <div class="control has-icons-left">
                <div class="select is-info is-fullwidth">
                  <select placeholder="Select Division For District" name="division_id">

                    @foreach ($divisions as $division)
                    @if ($district->division->id == $division->id)
                    <option value="{{ $division->id }}" selected="true">{{ $division->name }}</option>
                    @else
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endif

                    @endforeach
                  </select>
                </div>
                <div class="icon is-small is-left">
                  <i class="fa fa-globe"></i>
                </div>
              </div>

            </b-field>

            <div class="field is-grouped">
              <div class="control">
                <button type="submit" class="button is-primary">Update District</button>
              </div>
              <div class="control">
                <a href="{{ route('admin.district.index') }}" class="button is-danger">Cancel</a>
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