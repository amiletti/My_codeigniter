<?php $this->load->view('/themes/admin/header') ?>

<p>To change tour password insert new desidered password above</p>

<form action="/change_password" method="post">
  <div>
    <p>
      <label>Password</label>
      <input type="password" value="" name="password" /><br/>
    <p>
      <label>Repeat Password</label>
      <input type="password" value="" name="repeat_password" /><br/>
    </p>
    <p>
      <label></label>
      <input type="submit" value="Change password" />
    </p>
  </div>
</form>

<?php $this->load->view('/themes/admin/footer') ?>