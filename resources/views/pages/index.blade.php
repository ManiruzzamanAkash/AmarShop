@extends('layouts.app')

@section('content')

  <!-- <section class="top">
  <div class="container">
  <div class="card">
  <header class="card-header">
  <p class="card-header-title">
  Welcome {{ Auth::check() ? Auth::user()->name : 'Guest' }}
</p>
</header>
<div class="card-content">
<div class="content">
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis molestias, ab voluptas hic ut, est doloremque. Nostrum quidem tenetur illum sunt saepe! Pariatur dolorum nam quia ullam aliquam sapiente enim.
</p>
</div>
</div>
</div>
</div>
</section> -->

{{-- {{ $info }} --}}
<section class="hero">
  <div class="hero-body">
    <div class="container">
      {{-- <p class="has-text-centered section-title">
      Welcome to Amar Shop
    </p> --}}

    <div class="columns">
      <div class="column">
        <div class="card">
          <a href="{{ route('product.create') }}" class="link-bigger link-bigger-transition top-link1">
            Have you a Product ? <br />Wanna sell ?
            <img src="{{ asset('images/main/sell.jpg') }}" alt="">
          </a>
        </div>
      </div>
      <div class="column">
        <div class="card">
          <a href="{{ route('product.request') }}" class="link-bigger link-bigger-transition top-link2">Need a product ? <br />Wanna Buy ?
            <img src="{{ asset('images/main/buy3.png') }}" alt="">
          </a>
        </div>
      </div>
      <div class="column">
        <div class="card">
          <a href="{{ route('company.welcome') }}" class="link-bigger link-bigger-transition top-link3">
            Have you a company ? <br />Wanna sell ?
            <img src="{{ asset('images/main/company.jpg') }}" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

{{-- <section class="is-hero">
<div class="container">
<button type="button" @click="give_permission(2)" class="button is-primary">Test</button>
</div>
</section> --}}

<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">
      Get any product from your favorite division
    </p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($divisions as $division)
      <div class="column is-info">
        <div class="division has-text-centered link-bigger-transition">
          <a href="{!! route('product.division.index', $division->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
            <img src="{{ asset("images/divisions/$division->image") }}" alt="">
            <br />
            <span>{{ $division->name }}</span>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">Get products from the categories</p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($categories as $category)
      @if ($category->products()->count() > 0 )
      <div class="column is-info is-3">
        <div class="category has-text-centered link-bigger-transition">
          <a href="{!! route('product.category.index', $category->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
            <img src="{{ asset("images/categories/$category->image") }}" alt="">
            <br />
            <span>{{ $category->name }}</span>
          </a>
        </div>
      </div>
      @endif
      @endforeach
    </div>
    <a href="{!! route('categories') !!}" class="button is-primary is-large is-pulled-right">More Categories...</a>
  </div>
</section>


<section class="hero m-b-5 p-b-30">
  <div class="container">
    <p class="section-title m-b-30">Get products from the brands</p>
    <div class="columns is-multiline is-mobile is-centered">
      @foreach ($brands as $brand)
      <div class="column is-info is-3">
        <div class="category has-text-centered link-bigger-transition">
          <a href="{!! route('product.brand.index', $brand->slug) !!}" class="link-full-display link-div-big is-in has-text-danger">
            <img src="{{ asset("images/brands/$brand->image") }}" alt="">
            <br />
            {{ $brand->name }}
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <a href="{!! route('brands') !!}" class="button is-primary is-large is-pulled-right">More Brands...</a>
  </div>
</section>



@endsection


@section('scripts')
<script>
  const app = new Vue({
    el: '#app',
    data:{
    },
    methods:{

      confirmCustomDelete() {
        this.$dialog.confirm({
          title: 'Deleting account',
          message: 'Are you sure you want to <b>delete</b> your account? This action cannot be undone.',
          confirmText: 'Delete Account',
          type: 'is-danger',
          hasIcon: true,
          onConfirm: () => {
            return true
          }
        })
      },


      //Test a vue js function
      give_permission(permission) {
        if(permission == 2){
          alert('Ok');
        }else {
          alert('Nope');
        }
      }


    }


  });
</script>
@endsection
