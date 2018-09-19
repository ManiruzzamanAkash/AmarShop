@extends('layouts.user_dashboard')

@section('content')
<div class="card">
	<header>
		<div class="card-header card-header-title">
			Manage Order Coming From Users
		</div>
	</header><!-- /header -->
	<div class="card-content">
		@foreach ($orders as $order)
		<div class="notification">
			<h2>Orderer Shipping Informations :</h2>
			<h3><strong>Orderer Name</strong> - {{ $order->name }}</h3>
			<h3><strong>Orderer Phone</strong> - {{ $order->phone }}</h3>
			<h3><strong>Orderer Email Address</strong> - {{ $order->email }}</h3>
		</div>
		<div class="notification">
			<h2>Orderer Items :</h2>
			@php
			$order_items = DB::table('orders')
			->join('order_items', 'orders.id', '=', 'order_items.order_id')
			->join('shipping_adresses', 'orders.shipping_id', '=', 'shipping_adresses.id')
			->where('is_completed_by_admin', 1)
			->orderBy('orders.id', 'desc')
			->get();
			@endphp
			@foreach ($order_items as $item)
			
			@endforeach
		</div>
		@endforeach
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