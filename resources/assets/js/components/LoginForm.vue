<template>
  <section>
    <b-tabs>
      <b-tab-item label="User">
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
            </footer>
          </div>
        </form>
      </b-tab-item>

      <b-tab-item label="Company">
        <form action="{{ route('company.login.submit') }}" method="POST">
          {{ csrf_field() }}
          <div class="modal-card" style="width:300px;">
            <section class="modal-card-body">
              <b-field label="Company Email">
                <b-input type="email" placeholder="Your email" name="email" required> </b-input>
              </b-field>

              <b-field label="Company Password">
                <b-input type="password" name="password" password-reveal placeholder="Your password" required>
                </b-input>
              </b-field>

              <b-checkbox name="remember">Remember me</b-checkbox>
            </section>
            <footer class="modal-card-foot">
              <button class="button is-primary">Login</button>
            </footer>
          </div>
        </form>
      </b-tab-item>

    </b-tabs>
  </section>
</template>