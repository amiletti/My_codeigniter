<?php $this->load->view('/themes/admin/header') ?>

<p>You are currently logged in. <a href="/logout">Logout</a></p>

<p>Your userdata</p>
<code>
  <?php
  echo '<pre>';
  print_r($this->user);
  echo '</pre>';
  ?>
</code>

<p>Your session data</p>
<code>
  <?php
  echo '<pre>';
  print_r($this->session->userdata());
  echo '</pre>';
  ?>
</code>

<?php $this->load->view('/themes/admin/footer') ?>