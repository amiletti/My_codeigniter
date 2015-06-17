<?php $this->load->view('/themes/admin/header') ?>

<h4 class="page-header">Admin area</h4>

<div class="row">
  <div class="col-md-6">
    <p>Your userdata</p>
    <pre><?php print_r($this->user); ?></pre>
  </div>
  <div class="col-md-6">
    <p>Your session data</p>
    <pre><?php print_r($this->session->userdata()); ?></pre>
  </div>
</div>

<?php $this->load->view('/themes/admin/footer') ?>