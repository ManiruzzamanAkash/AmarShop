<aside class="menu">
  <p class="menu-label">
    General
  </p>
  <ul class="menu-list">
    <li><a href="{{ route('admin.dashboard') }}" class="{{ (Route::current()->getName() == "admin.dashboard") ? 'is-active' : 'null' }}">Dashboard</a></li>

  </ul>
  <p class="menu-label">
    Administration
  </p>
  <ul class="menu-list">
    <li><a href="{{ route('admin.user') }}"class="{{ (Route::current()->getName() == "admin.user") ? 'is-active' : 'null' }}">Manage Users</a></li>

    <li>
      <b-collapse :open="true">
        <a slot="trigger">Manage Products</a>
        <ul>
          <li><a href="{{ route('admin.product.index') }}" class="{{ (Route::current()->getName() == "admin.product.index") ? 'is-active' : 'null' }}">Manage Products</a></li>
          <li><a>Create Products</a></li>
          <li><a href="{{ route('admin.product.featured') }}" class="{{ (Route::current()->getName() == "admin.product.featured") ? 'is-active' : 'null' }}">Featured Products</a></li>
          <li><a href="{{ route('admin.product.request_products') }}">Product Requests</a></li>
        </ul>
      </b-collapse>
    </li>

    <li>
      <b-collapse :open="true">
        <a slot="trigger">Manage Orders</a>
        <ul>
          <li>
            <a href="{{ route('admin.order') }}" class="{{ (Route::current()->getName() == "admin.order") ? 'is-active' : 'null' }}">Incomplete Orders</a>
          </li>
           <li><a href="{{ route('admin.order.complete') }}" class="{{ (Route::current()->getName() == "admin.order.complete") ? 'is-active' : 'null' }}">Complete Orders</a></li>
          
        </ul>
      </b-collapse>
    </li>

    <li>
      <b-collapse :open="{{ ((Request::is('admin/category')) || (Request::is('admin/category/*'))) ? 'true' : 'false' }}">
        <a slot="trigger">Manage Category</a>
        <ul>
          <li><a href="{{ route('admin.category.index') }}" class="{{ (Route::current()->getName() == "admin.category.index") ? 'is-active' : 'null' }}">Manage Category</a></li>
          <li><a href="{{ route('admin.category.create') }}" class="{{ (Route::current()->getName() == "admin.category.create") ? 'is-active' : 'null' }}">Create Category</a></li>
        </ul>
      </b-collapse>
    </li>

    <li>
      <b-collapse :open="{{ ((Request::is('admin/brand')) || (Request::is('admin/brand/*'))) ? 'true' : 'false' }}">
        <a slot="trigger">Manage brand</a>
        <ul>
          <li><a href="{{ route('admin.brand.index') }}" class="{{ (Route::current()->getName() == "admin.brand.index") ? 'is-active' : 'null' }}">Manage brand</a></li>
          <li><a href="{{ route('admin.brand.create') }}" class="{{ (Route::current()->getName() == "admin.brand.create") ? 'is-active' : 'null' }}">Create brand</a></li>
        </ul>
      </b-collapse>
    </li>


    <li><a>Settings</a></li>
  </ul>


  <p class="menu-label">
    Others
  </p>
  <ul class="menu-list">

    <li>
      <a href="{{ route('admin.district.index') }}"
      class="{{ ((Route::current()->getName() == "admin.district.index") || (Route::current()->getName() == "admin.district.edit")) ? 'is-active' : 'null' }}">Manage Districts</a>
    </li>
    <li>
      <a href="{{ route('admin.division.index') }}"
      class="{{ ((Route::current()->getName() == "admin.division.index") || (Route::current()->getName() == "admin.division.edit")) ? 'is-active' : 'null' }}">Manage Division</a>
    </li>

    <li><a>Transfers</a></li>
    <li><a>Balance</a></li>
  </ul>
</aside>

{{-- <script type="text/javascript">
  var app = new Vue({
    el: '#app',
    data:{
      open: true
    }
  });

</script> --}}
