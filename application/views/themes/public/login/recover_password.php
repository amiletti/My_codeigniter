<?php $this->load->view('/themes/public/header') ?>

<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Email" value="<?php echo set_value('email', '') ?>" name="email">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Recover password</button>
      or <a href="/login">Login</a>
    </div>
  </div>
</form>

<?php $this->load->view('/themes/public/footer') ?>