@extends('layouts.user_dashboard')

@section('content')
<div class="card">
	<header>
		<div class="card-header card-header-title">
			Dashboard
		</div>
	</header><!-- /header -->
	<div class="card-content">
		<h3>Welcome To your Dashboard Panel <mark>{{ Auth::user()->name }}</mark></h3>
		<hr />
		<p>Here you can manage all of your customer orders, your products, your informations and so on... !!! </p>
		<p class="has-text-centered">Cheers ...!!!!</p>
	</div>
</div>

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