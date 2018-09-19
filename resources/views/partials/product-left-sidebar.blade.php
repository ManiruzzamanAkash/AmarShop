<aside>
	<div class="sidebar">

		<div class="widget">
			<nav class="panel">
				<p class="panel-heading">
					Search Any Products
				</p>
				<div class="panel-block">
					@include('components/searchProduct')
				</div>


			</nav>
		</div>

		<div class="widget">
			<nav class="panel">
				<p class="panel-heading">
					Product By Divisions
				</p>

				@php $divisions = DB::table('divisions')->get(); @endphp
				@foreach ($divisions as $division)
					<a class="{{ (Request::is("division/$division->slug/products")) ? 'active' : '' }} panel-block" href="{!! route('product.division.index', $division->slug) !!}">
						<span class="panel-icon">
							{{-- <i class="fa fa-flag"></i> --}}
							<img src='{!! asset("images/divisions/$division->image") !!}'>
						</span>
						{{ $division->name }}
					</a>
				@endforeach

			</nav>
		</div>


		<div class="widget">
			<nav class="panel">
				<p class="panel-heading is-primary">
					Product By Categories
				</p>

				@php $categories = DB::table('categories')->get(); @endphp
				@foreach ($categories as $category)
					<a class="{{ (Request::is("category/$category->slug/products")) ? 'active' : '' }} panel-block" href="{!! route('product.category.index', $category->slug) !!}">
						<span class="panel-icon">
							<img src='{!! asset("images/categories/$category->image") !!}'>
						</span>
						{{ $category->name }}
					</a>
				@endforeach

			</nav>
		</div>

		<div class="widget">
			<nav class="panel">
				<p class="panel-heading">
					Product By Top Brand
				</p>

				@php $brands = DB::table('brands')->get(); @endphp
				@foreach ($brands as $brand)
					<a class="{{ (Request::is("brand/$brand->slug/products")) ? 'active' : '' }} panel-block" href="{!! route('product.brand.index', $brand->slug) !!}">
						<span class="panel-icon">
							<img src='{!! asset("images/brands/$brand->image") !!}'>
						</span>
						{{ $brand->name }}
					</a>
				@endforeach

			</nav>
		</div>

	</div>
</aside>
