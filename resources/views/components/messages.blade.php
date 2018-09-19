@if ((Session::has('success')) || ( Session::has('error') ))
<div class="has-text-centered">
  <div class="column is-4 is-offset-4">

    @if ( Session::has('success') )
    <b-notification type="is-success">
      {{ Session::get('success') }}
    </b-notification>
    @endif

    @if ( Session::has('error') )
    <b-notification type="is-danger">
      {{ Session::get('error') }}
    </b-notification>
    @endif

  </div>
</div>
@endif



@if (isset($errors))
@if ($errors->any())
<div class="column is-4 is-offset-4">
  <b-notification type="is-danger" class="has-text-centered">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
  </b-notification>
</div>
@endif

@endif

