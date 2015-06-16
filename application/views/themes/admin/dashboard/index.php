<?php $this->load->view('/themes/admin/header') ?>
<h4 class="page-header">Admin area</h4>
<p>Your userdata</p>
<pre><?php print_r($this->user); ?></pre>

<p>Your session data</p>
<pre><?php print_r($this->session->userdata()); ?></pre>

<?php $this->load->view('/themes/admin/footer') ?>