@extends('layouts.user_dashboard')

@section('content')
<div class="card">
	<header>
		<div class="card-header card-header-title">
			Update Your Profile
		</div>
	</header><!-- /header -->
	<div class="card-content">
		<form action="{{ route('user.update_profile.store') }}" method="POST" class="p-b-20" enctype="multipart/form-data">

			{{ csrf_field() }}
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Account Type</label>
				</div>

				<div class="field-body">
					<b-field>
						<div class="select">
							<select class="is-fullwidth" name="is_company" required>
								<option value="0" {{ $user->is_company == 0 ? 'selected': '' }}>As a user</option>
								<option value="1" {{ $user->is_company == 1 ? 'selected': '' }}>As a Company</option>
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
						<b-input placeholder="Name" name="name" icon="user" required maxlength=30 value="{{ $user->name }}"></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->




			<div class="field is-horizontal">

				<div class="field-label is-normal">
					<label class="label">Email</label>
				</div>
				<div class="field-body">
					<b-field>
						<b-input placeholder="Primary Email" type="email" name="email" icon="envelope" is-expanded="true" required  value="{{ $user->email }}"></b-input>
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
							<b-input placeholder="01951233084" type="text" name="phone" icon="phone" is-expanded="true" required  value="{{ $user->phone }}"></b-input>
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
						<select class="is-fullwidth input" name="division_id" required>
							@foreach ($divisions as $division)
							@if ($division->id == $user->division_id)
							<option value="{{ $division->id }}" selected>{{ $division->name }}</option>
							@else
							<option value="{{ $division->id }}">{{ $division->name }}</option>
							@endif

							@endforeach
						</select>
					</b-field>
					<b-field>
						<select class="is-fullwidth input" name="district_id" required>
							@foreach ($districts as $district)
							@if ($district->id == $user->district_id)
							<option value="{{ $district->id }}" selected>{{ $district->name }}</option>
							@else
							<option value="{{ $district->id }}">{{ $district->name }}</option>
							@endif

							@endforeach
						</select>
					</b-field>

				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->


			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Street</label>
				</div>

				<div class="field-body">
					<b-field>
						<b-input placeholder="Street Address" type="text" name="street_address" icon="address-book" maxLength=100 value="{{ $user->street_address }}"></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->


			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">About</label>
				</div>

				<div class="field-body">
					<b-field>
						<b-input placeholder="About" type="textarea" name="description" maxLength=200 value="{{ $user->description }}"></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->






			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Website (Optional)</label>
				</div>
				<div class="field-body">
					<b-field>
						<b-input placeholder="Primary Email" type="url" name="website" icon="rss_square" is-expanded="true" required  value="{{ $user->website }}"></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->

			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Profile (Previous)</label>
				</div>
				<div class="field-body">
					<img src='{{ ($user->image != null) ? "images/users/$user->image" : "" }}' style="width: 100px; border: 1px solid blueviolet;">
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->

			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Profile(New) (Optional)</label>
				</div>
				<div class="field-body">
					<b-field>
						<b-input type="file" name="image" icon="rss_square" is-expanded="true"></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->

			{{-- <div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Location (Search)</label>
				</div>
				<div class="field-body">
					<b-field>
						<b-input type="text" id="searchmap" name="searchmap" icon="search"  is-expanded="true"></b-input>
					</b-field>
					
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal--> --}}

			{{-- <div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Location (Optional)</label>
				</div>
				<div class="field-body">
					<div id="map-canvas"></div>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal--> --}}

			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Password (Optional)</label>
				</div>

				<div class="field-body">
					<b-field>
						<b-input placeholder="Password" type="password" name="password" icon="lock" password-reveal></b-input>
					</b-field>
					<b-field>
						<b-input placeholder="Confirm Password" type="password" name="password_confirmation" icon="lock" password-reveal></b-input>
					</b-field>
				</div> <!--End Field Body -->
			</div> <!--End Field Horizontal-->

			<div class="field-body is-centered">
				<p class="control is-centered">
					<button class="button is-success" type="submit">Update</button>
				</p>
			</div> <!--End Field Body -->

		</form> <!--End User Registration Form -->
		
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