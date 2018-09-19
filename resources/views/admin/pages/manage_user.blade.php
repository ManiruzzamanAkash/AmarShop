@extends('admin.layouts.admin')

@section('content')

<div id="categoryIndex">
  <nav class="breadcrumb" aria-label="breadcrumbs">
    <ul class="is-left">
      <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      <li class="is-active"><a href="#" aria-current="page">Manage User</a></li>
    </ul>
    <ul class="is-right">
      <li  class="is-right"><a href="{{ route('admin.user.create') }}" class="button button is-primary">Create User</a></li>
    </ul>
  </nav>


  <div class="columns">
    <div class="column is-12">
      <div class="card events-card">
        <header class="card-header">
          <p class="card-header-title">
            Manage Users
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
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Trust Point</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($users as $user)
                @php $i=1; @endphp
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $user->name }}</td>
                  <td><a href="tel:{{ $user->phone }}" title="{{ $user->phone }}">{{ $user->phone }}</a></td>
                  <td><a href="mailto:{{ $user->email }}" title="{{ $user->email }}">{{ $user->email }}</a></td>
                  <td>

                    <form action="{{ route('admin.user.update_trust_point', $user->id) }}" class="form-inline" method="POST" class="form-inline">
                      {{ csrf_field() }}
                      <input type="number" name="trust_point" value="{{ $user->trust_point }}" class="input is-width-60">
                      <button type="submit" class="button is-success" title="Update Trust Point"><i class="fa fa-save"></i></button>
                    </form>



                  </td>


                  <td>

                    <form onsubmit="return confirm('Do you really make the user as an admin ?')" action="{{ route('admin.user.make_admin', $user->id) }}" class="form-inline" method="POST" >
                      {{ csrf_field() }}
                      <button type="submit" class="button is-danger" title="Make Admin"><i class="fa fa-user"></i></button>
                    </form>

                    @php
                    $banned = \App\BannedUser::where('user_id', $user->id)->orWhere('email', $user->email)->first();
                    @endphp
                    @if (count($banned) < 1)
                    <button class="button is-primary" @click="isBanModal({{ $user->id }}, '{{ $user->name }}')"><i class="fa fa-ban"></i>Ban Now</button>

                    @else
                    <form action="{{ route('admin.user.ban', $user->id) }}" method="POST" class="form-inline">
                      {{ csrf_field() }}
                      <button type="submit" class="button is-success" title="Remove Ban"><i class="fa fa-ban"></i> &nbsp;Remove Ban</button>
                    </form>
                    @endif
                  </button>


                  <b-modal :active.sync="isBanModalActive" :width="640" scroll="keep">
                    <div class="card">

                      <div class="card-content">
                       <form onsubmit="return confirm('Do you really ban this user ?')" action="{{ route('admin.user.ban', $user->id) }}" method="POST" >
                        {{ csrf_field() }}

                        <label for="reason">Ban Reason for - {{ $user->name }}</label>
                        <b-input type="textarea" name="reason" placeholder="Enter reason why want to ban (Optional)"></b-input>

                        <button type="submit" class="button is-danger m-t-30" title="Ban User"><i class="fa fa-ban"></i> &nbsp;Ban User Now</button>
                      </form>
                    </div>
                  </div>
                </b-modal>




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

  <center>
    <nav class="pagination" role="navigation" aria-label="pagination">
      {{ $users->links() }}
    </nav>
  </center>


</div>
</div>
</div> <!-- End User Manage Index -->


@endsection

@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
  data: {
    isBanModalActive: false
  },
  methods: {
    isBanModal: function(user_id, name){

      this.$modal.open(
        `
        <div class="card">

        <div class="card-content">
        <form action="/admin/user/ban/`+user_id+`" method="POST" >
        {{ csrf_field() }}

        <label for="reason">Ban Reason for - `+name+`</label>
        <textarea name="reason" placeholder="Enter reason why want to ban (Optional)" class="textarea"></textarea>

        <button type="submit" class="button is-danger m-t-30" title="Ban User"><i class="fa fa-ban"></i> &nbsp;Ban User Now</button>
        </form>
        </div>
        </div>        
        `
        )
    }

  }
});
</script>
@endsection