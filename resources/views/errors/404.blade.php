@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="404-error-page is-fullheight m-t-100 p-t-50 m-b-100 p-b-50">
			<h1 class="title has-text-centered">404 Error - Page Not Found</h1>
		</div>
	</div>
@endsection


@section('scripts')
  <script>
  const app = new Vue({
    el: '#app',
    data:{
    },
  });
  </script>
@endsection
