<?php $this->load->view('/themes/admin/header') ?>
<h4 class="page-header">Chnange password</h4>
<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="Password" value="" name="password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Repeat password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="Repeat password" value="" name="repeat_password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Change password</button>
    </div>
  </div>
</form>

<?php $this->load->view('/themes/admin/footer') ?>