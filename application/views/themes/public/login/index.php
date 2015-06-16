<?php $this->load->view('/themes/public/header') ?>

<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Username or email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Username or email" value="<?php echo set_value('email', '') ?>" name="email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="Password" value="">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" class="remember" name="remember" value="1" <?php echo set_checkbox('remember', 1, FALSE); ?> /> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
      or <a href="/recover_password">Recover password</a>
    </div>
  </div>
</form>

<?php $this->load->view('/themes/public/footer') ?>