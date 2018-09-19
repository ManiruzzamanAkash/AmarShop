@extends('layouts.app')

@section('content')

<section class="top">
  <div class="container">
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Welcome {{ Auth::check() ? Auth::user()->name : 'Guest' }}
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <a href="{{ route('company.welcome') }}" class="link-bigger top-link1 is-offset-2">
              So, you have a company/organization <br /> And wanna sell your products<br /> 
            <img src="{{ asset('images/main/company.jpg') }}" alt="">
          </a>
          <hr>
          <div class="start">
            <h2>How to start ?</h2>
            <p>
              By our site, you can easily create a profile for your company. By Clicking <a href="{{ route('register') }}" class="button is-primary is-small">Sign Up</a>
            </p>

            <hr>
            <h2>How to Manage your company Profiles ?</h2>
            <p>
              After creating an account you can manage your profiles, set your company location by updating your information using Google Map thus people can find you easily. In our <a href="{{ route('product.create') }}" class="button is-primary is-small">Publish Product Page</a>can create a new/old product as much as you want. Give their a customer care number in your company. 
            </p>
            
            <hr>
            <h2>How will your product be sold ?</h2>
            <p>
             Their are a lots of user in our site visits daily. They can see your products in <a href="{{ route('product.index') }}">Product Page</a>. Their is a number for your product. People can call in your number and go directly to your company and sell to them.
            </p>

            <hr>
            <h2>How to be a successfull product seller here ? </h2>
            <p>
             Try to post some good resolution products image. You may be use a good camera for capturing your product image. Post daily your products. We can assure that, your company sell rate will obviously increase. <strong>So why: </strong> When you have an account then you've a nice profile with all of your product list, your company google map location. People can easily find your products. They can know their price and must buy if they like. So, keep in mind that and grow your business.
            </p>

          </div>
          
        </div>
      </div>
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

