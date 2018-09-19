<section>
  <form action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="modal-card" style="width:300px;">
      <section class="modal-card-body">
        <b-field label="User Email">
          <b-input type="email" placeholder="Your email" name="email" required> </b-input>
        </b-field>

        <b-field label="User Password">
          <b-input type="password" name="password" password-reveal placeholder="Your password" required>
          </b-input>
        </b-field>

        <b-checkbox name="remember">Remember me</b-checkbox>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-primary">Login</button>
        <br />
        <a class="m-t-10 has-text-centered" href="{{ route('password.request') }}">
          Forgot Your Password?
        </a>
      </footer>
    </div>
  </form>
</section>