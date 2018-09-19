@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li class="is-active"><a href="#" aria-current="page">Manage Districts</a></li>
  </ul>
</nav>

<b-collapse :open="false">
  <a slot="trigger" class="button is-primary is-right m-b-30">Create District</a>
  
  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Create District
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-table">
          <div class="content p-t-30 p-b-30 p-l-30 p-r-30">
            <form action="{{ route('admin.district.store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <b-field label="District Name *">
                <b-input placeholder="District Name" type="text" name="name" required></b-input>
              </b-field>

              <b-field label="District Image (Optional)">
                <b-input type="file" name="image"></b-input>
              </b-field>

              <b-field label="Division">
                <b-select placeholder="Select Division For District" name="division_id">
                  @foreach ($divisions as $division)
                  <option value="{{ $division->id }}">{{ $division->name }}</option>
                  @endforeach
                </b-select>
              </b-field>


              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-primary">Save District</button>
                </div>
                <div class="control">
                  <button type="reset" class="button is-danger">Cancel</button>
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


</b-collapse>




<div class="columns">
  <div class="column is-12">
    <div class="card events-card">
      <header class="card-header">
        <p class="card-header-title">
          Manage Districts
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
                <th>Division</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
              @php $i=1; @endphp
              @forelse ($districts as $district)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $district->name }}</td>
                <td>{{ $district->division->name }}</td>
                <td>
                  <a href="{{ asset("images/districts/$district->image") }}" target="blank">
                    <img src='{{ asset("images/districts/$district->image") }}' alt="" style="width: 50px">
                  </a>

                </td>
                <td>
                  <a href="{{ route('admin.district.edit', $district->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>
                  <form onsubmit="return confirm('Are you sure ? Do you want to delete the district ?')" action="{{ route('admin.district.delete', $district->id) }}" class="form-inline" method="POST" >
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