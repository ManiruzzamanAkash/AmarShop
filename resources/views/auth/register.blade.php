@extends('layouts.app')

@section('content')

<div class="container">
    <div class="columns">
        <div class="column is-8">

            <div class="card">
              <header class="card-header">
                <p class="card-header-title">Create A New Account</p>
            </header>
            <div class="card-content">

                <form action="{{ route('register') }}" method="POST" class="p-b-20" enctype="multipart/form-data">

                    {{ csrf_field() }}


                    <div class="field is-horizontal">
                      <div class="field-label is-normal">
                        <label class="label">Choose Account Type</label>
                    </div>

                    <div class="field-body">
                        <b-field>
                            <div class="select">
                                <select class="is-fullwidth" name="is_company" required>
                                    <option value="0" selected>As a user</option>
                                    <option value="1">As a Company</option>
                                </select>
                            </div>
                        </b-field>
                    </div> <!--End Field Body -->
                </div> <!--End Field Horizontal-->


                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Name</label>
                </div>

                <div class="field-body">
                    <b-field>
                        <b-input placeholder="Name" name="name" icon="user" required maxlength=30></b-input>
                    </b-field>
                </div> <!--End Field Body -->
            </div> <!--End Field Horizontal-->




            <div class="field is-horizontal">

              <div class="field-label is-normal">
                <label class="label">Email</label>
            </div>
            <div class="field-body">
                <b-field>
                    <b-input placeholder="Primary Email" type="email" name="email" icon="envelope" is-expanded="true" required ></b-input>
                </b-field>
            </div> <!--End Field Body -->
        </div> <!--End Field Horizontal-->


        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Phone No</label>
        </div>

        <div class="field-body">
            <div class="field-body">
                <b-field>
                    <b-input placeholder="01951233084" type="text" name="phone" icon="phone" is-expanded="true" required ></b-input>
                </b-field>
            </div> <!--End Field Body -->
        </div> <!--End Field Body -->
    </div> <!--End Field Horizontal-->


    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Division / District</label>
    </div>

    <div class="field-body">
        <b-field>
            <b-select placeholder="Select a Division" class="is-fullwidth" name="division_id" required>
                @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </b-select>
        </b-field>
        <b-field>
            <b-select placeholder="Select a District" class="is-fullwidth" name="district_id" required>
                @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </b-select>
        </b-field>

    </div> <!--End Field Body -->
</div> <!--End Field Horizontal-->


<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Street</label>
</div>

<div class="field-body">
    <b-field>
        <b-input placeholder="Street Address" type="text" name="street_address" icon="address-book" maxLength=100></b-input>
    </b-field>
</div> <!--End Field Body -->
</div> <!--End Field Horizontal-->

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Password</label>
</div>

<div class="field-body">
    <b-field>
        <b-input placeholder="Password" type="password" name="password" icon="lock" required password-reveal></b-input>
    </b-field>
    <b-field>
        <b-input placeholder="Confirm Password" type="password" name="password_confirmation" icon="lock" required password-reveal></b-input>
    </b-field>
</div> <!--End Field Body -->
</div> <!--End Field Horizontal-->



<div class="field-body is-centered">
    <p class="control is-centered">
        <button class="button is-primary" type="submit">Register</button>
    </p>
</div> <!--End Field Body -->
</form> <!--End User Registration Form -->



</div> <!-- Card content -->

</div> <!--End card -->


</div> <!-- End col-is-8 -->





<div class="column is-4">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">Login</p>
    </header>
    <div class="card-content">
        <form action="{{ route('login') }}" method="POST" class="">
            {{ csrf_field() }}
            <div class="field">
                <b-field>
                    <b-input placeholder="Primary Email" type="email" name="email" icon="envelope" required></b-input>
                </b-field>
            </div>
            <div class="field">
                <b-field>
                    <b-input type="password" name="password" icon="lock"  required password-reveal> </b-input>
                </b-field>
            </div>

            <div class="field">
                <b-checkbox name="remember" value="{{ old('remember') }}">Remember Me</b-checkbox>
            </div>


            <div class="field-body is-centered">
                <p class="control is-centered">
                    <button class="button is-primary" type="submit">Login</button>
                </p>
            </div> <!--End Field Body -->
        </form>
    </div>

</div> <!--End card -->
</div>



</div>

</div>









{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection


@section('scripts')
<script>
   const app = new Vue({
      el: '#app',
      data:{

      },
      methods:{

      }


  });
</script>
@endsection