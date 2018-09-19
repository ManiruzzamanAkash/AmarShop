@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="hero-body">
    <div class="container">
      <h2 class="title">Advance Search</h2>
      <search></search>
  </div>
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

    }
  });
</script>
@endsection
