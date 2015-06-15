<?php $this->load->view('/themes/public/header') ?>

<form action="/recover_password" method="post">
  <div>
    <p>
      <label>Email</label>
      <input type="text" value="admin" name="email" />
    </p>
    <p>
      <label></label>
      <input type="submit" value="Recover password" /> or <a href="/login">login</a> or <a href="/">back to home</a>
    </p>
  </div>
</form>

<?php $this->load->view('/themes/public/footer') ?>