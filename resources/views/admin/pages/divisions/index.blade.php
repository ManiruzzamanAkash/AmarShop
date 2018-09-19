@extends('admin.layouts.admin')
@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li class="is-active"><a href="#" aria-current="page">Manage Divisions</a></li>
  </ul>
</nav>

<b-collapse :open="false">
  <a slot="trigger" class="button is-primary is-right m-b-30">Create Division</a>
  
  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Create Division
          </p>
          <a href="#" class="card-header-icon" aria-label="more options">
            <span class="icon">
              <i class="fa fa-angle-down" aria-hidden="true"></i>
            </span>
          </a>
        </header>
        <div class="card-table">
          <div class="content p-t-30 p-b-30 p-l-30 p-r-30">
            <form action="{{ route('admin.division.store') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <b-field label="Division Name *">
                <b-input placeholder="Division Name" type="text" name="name" required></b-input>
              </b-field>

              <b-field label="Division Image (Optional)">
                <b-input type="file" name="image"></b-input>
              </b-field>

              <b-field label="Division">
                <b-select placeholder="Select Division For Division" name="division_id">
                  @foreach ($divisions as $division)
                  <option value="{{ $division->id }}">{{ $division->name }}</option>
                  @endforeach
                </b-select>
              </b-field>


              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-primary">Save Division</button>
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


</b-collapse>




<div class="columns">
  <div class="column is-12">
    <div class="card events-card">
      <header class="card-header">
        <p class="card-header-title">
          Manage Division
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
                <th width="5%">#</th>
                <th width="10%">Name</th>
                <th width="30%">Total Districts</th>
                <th width="20%">Image</th>
                <th width="20%">Action</th>
              </tr>
            </thead>
            <tbody>
              
              @php $i=1; @endphp
              @forelse ($divisions as $division)
              <tr>
                <td>{{ $i }}</td>
                <td>{{ $division->name }}</td>
                <td>
                  {{ $division->districts->count() }} <br />
                  @foreach ($division->districts as $district)
                    {{ $district->name. ' ' }} 
                  @endforeach

                </td>
                <td>
                  <a href="{{ asset("images/divisions/$division->image") }}" target="blank">
                    <img src='{{ asset("images/divisions/$division->image") }}' alt="" style="width: 50px">
                  </a>

                </td>
                <td>
                  <a href="{{ route('admin.division.edit', $division->id) }}" class="button is-success"><i class="fa fa-pencil"></i></a>
                  <form onsubmit="return confirm('Are you sure ? Do you want to delete the division ?')" action="{{ route('admin.division.delete', $division->id) }}" class="form-inline" method="POST" >
                    {{ csrf_field() }}
                    <button type="submit" class="button is-danger"><i class="fa fa-trash"></i></button>
                  </form>

                </td>
                @php $i++; @endphp
              </tr>

              @empty
              <tr>
                <td colspan="4">No Division Here</td>
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