<?php $this->load->view('/themes/public/header') ?>

<form action="/login" method="post">
  <div>
    <p>
      <label>Username or email</label>
      <input type="text" value="admin" name="email" /><br/>
      <small>Default: admin</small>
    </p>
    <p>
      <label>Password</label>
      <input type="password" value="password" name="password" /><br/>
      <small>Default: password</small>
    </p>
    <p>
      <label></label>
      <label style="text-align:left;"><input type="checkbox" class="remember" name="remember" value="1" <?php echo set_checkbox('remember', 1, FALSE); ?> /> Ricordami</label>
    </p>
    <p>
      <label></label>
      <input type="submit" value="Login" /> or <a href="/recover_password">recover password</a> or <a href="/">back to home</a>
    </p>
  </div>
</form>

<?php $this->load->view('/themes/public/footer') ?>