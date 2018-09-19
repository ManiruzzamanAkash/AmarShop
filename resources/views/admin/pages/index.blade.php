@extends('admin.layouts.admin')

@section('content')

<nav class="breadcrumb" aria-label="breadcrumbs">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
    <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
  </ul>
</nav>


<section class="hero is-info welcome is-small">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Hello, Admin.
      </h1>
      <h2 class="subtitle">
        I hope you are having a great day!
      </h2>
    </div>
  </div>
</section>

@php
$total_products = $unpublished_products->count() + $published_products->count();
@endphp

<section class="info-tiles">
  <div class="tile is-ancestor has-text-centered">
    <div class="tile is-parent">
      <article class="tile is-child box">
        <p class="title">{{ $users->count() }}</p>
        <p class="subtitle">Users</p>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child box">
        <p class="title">{{ $companies->count() }}</p>
        <p class="subtitle">Companies</p>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child box">
        <p class="title">{{ $total_products }}</p>
        <p class="subtitle">Products</p>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child box">
        <p class="title">{{ $order_complete->count() + $order_uncomplete->count() }}</p>
        <p class="subtitle">Orders</p>
      </article>
    </div>
  </div>
</section>

<section class="content m-t-30">

  <h2>All Sections</h2>
  <div class="tile is-ancestor has-text-centered">
    <div class="tile is-parent">
      <article class="tile is-child box is-danger">

        <p class="title">{{ $order_complete->count() + $order_uncomplete->count() }} Total Orders</p>
        <p class="subtitle has-text-danger">{{ $order_uncomplete->count() }} Uncomplete</p>
        <p class="subtitle has-text-success">{{ $order_complete->count() }} Completed</p>
        <p class="subtitle"><a href="{{ route('admin.order') }}" class="button is-primary is-inline">Manage</a></p>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child box is-danger">

        <p class="title">{{ $total_products }} Total Products</p>
        <p class="subtitle has-text-danger">{{ $unpublished_products->count() }} Unpublished</p>
        <p class="subtitle has-text-success">{{ $published_products->count() }} Published</p>
        <p class="subtitle"><a href="{{ route('admin.product.index') }}" class="button is-primary is-inline">Manage</a></p>
      </article>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child box is-danger">
        <p class="title">{{ $users->count() + $companies->count() }} Total Customers</p>
        <p class="subtitle has-text-info">{{ $users->count() }} Users</p>
        <p class="subtitle has-text-warning">{{ $companies->count() }} Companies</p>
        <p class="subtitle"><a href="{{ route('admin.user') }}" class="button is-primary is-inline">Manage</a></p>
      </article>
    </div>
  </div>
  
</section>


@endsection

@section('scripts')
<script>
 const app = new Vue({
  el: '#app',
});
</script>
@endsection