@extends('layouts.user_dashboard')

@section('content')
<div class="card">
	<header>
		<div class="card-header card-header-title">
			Update Shipping Address
		</div>
	</header><!-- /header -->
	<div class="card-content">
		<form action="{{ route('user.change_shipping_address') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="shipping_id" value="{{ ($user->shipping_address)? $user->shipping_address->id : '' }}">
			<b-field grouped>
				<b-field label="Name" expanded>
					<b-field>
						<b-input id="shipping_name" name="name" placeholder="Enter name for shipping product" value="{{ ($user->shipping_address)? $user->shipping_address->name : '' }}" required v-if=""></b-input>
					</b-field>
				</b-field>
				<b-field label="Email (Optional)" expanded>
					<b-input placeholder="some@email.com" type="email" name="email" value="{{ ($user->shipping_address)? $user->shipping_address->email : '' }}"></b-input>
				</b-field>
			</b-field>

			<b-field grouped>
				<b-field label="Division" expanded>
					<div class="control">
						<div class="select">
							<select placeholder="Select a division" name="division_id" v-on:change="onChangeDivision" required expanded>

								<option value="">Select a division please</option>
								@foreach ($divisions as $division)
								@if ($user->shipping_address)
								@if ($division->id == $user->shipping_address->division_id)
								<option value="{{ $division->id }}" selected>{{ $division->name }}</option>
								@endif
								@else
								<option value="{{ $division->id }}">{{ $division->name }}</option>
								@endif
								
								@endforeach
							</select>
						</div>
					</div>
				</b-field>
				<b-field label="District" expanded>
					<div class="control">
						<div class="select">
							<select placeholder="Select a district" v-on:change="onChangeDistricts" name="district_id" required  expanded  v-model="selectedDistrict">
								@foreach ($districts as $district)
								@if ($user->shipping_address)
								@if ($district->id == $user->shipping_address->district_id)
								<option value="{{ $district->id }}" selected>{{ $district->name }}</option>
								@endif
								@else
								
								<option value="{{ $district->id }}">{{ $district->name }}</option>
								@endif
								
								@endforeach
							</option>
						</select>
					</div>
				</div>

			</b-field>
			<b-field label="Upazilla" expanded>
				<div class="control">
					<div class="select">
						<select placeholder="Select a upazilla" name="upazilla_id" required expanded v-model="selectedUpazilla">
							@foreach ($upazillas as $upazilla)
							@if ($user->shipping_address)
							@if ($upazilla->id == $user->shipping_address->upazilla_id)
							<option value="{{ $upazilla->id }}" selected>{{ $upazilla->name }}</option>
							@endif
							@else
							
							<option value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
							@endif

							@endforeach
						</option>
					</select>
				</div>
			</div>


		</b-field>
	</b-field>
	<b-field grouped>
		<b-field label="Street Address 1" expanded>
			<b-input placeholder="Street Address" name="street_address1" maxlength="100" required value="{{ ($user->shipping_address)? $user->shipping_address->street_address1 : '' }}"></b-input>
		</b-field>
		<b-field label="Street Address 2 (Optional)" expanded>
			<b-input placeholder="Street Address" name="street_address2" maxlength="100" value="{{ ($user->shipping_address)? $user->shipping_address->street_address2 : '' }}"></b-input>
		</b-field>
	</b-field>
	<b-field grouped>

		<b-field label="Phone Number" expanded>
			<b-input placeholder="Phone Number" name="phone" maxlength="15" required value="{{ ($user->shipping_address)? $user->shipping_address->phone : '' }}"></b-input>
		</b-field>    
		<b-field label="Courier Address" expanded>
			<b-input placeholder="Courier Address" name="courier_address" maxlength="150" required value="{{ ($user->shipping_address)? $user->shipping_address->courier_address : '' }}"></b-input>
		</b-field>

	</b-field>

	<button type="submit" class="button is-success">Update</button>

</form>
</div>
</div>

@endsection

@section('scripts')
<script>
	const app = new Vue({
		el: '#app',
		data:{
			divisions : [{!! $divisions !!}],
			districts : [{!! $districts !!}],
			upazillas : [{!! $upazillas !!}],
		},
		methods:{

			onChangeDivision: function(event){
				var division_id = event.srcElement.value
        //Find the districts by this division and change the districts array
        axios.get("/api/get_districts/"+division_id)
        .then(response => {
        	this.districts = response.data
        })
    },
    onChangeDistricts: function(event){
    	var district_id = event.srcElement.value
        //Find the districts by this division and change the districts array
        axios.get("/api/get_upazillas/"+district_id)
        .then(response => {
        	this.upazillas = response.data
        })
    },

}
});
</script>
@endsection