<?php $this->load->view('/themes/public/header') ?>

<?php if($this->user): ?>
  <p>You are currently logged in. <a href="/admin">Show detail about my user</a></p>
<?php else: ?>
  <p>You are not logged in. <a href="/login">Login</a></p>
<?php endif ?>

<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

<p>If you would like to edit this page you'll find it located at:</p>
<code>application/views/themes/public/index.php</code>

<p>The corresponding controller for this page is found at:</p>
<code>application/controllers/Welcome.php</code>

<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>

<?php $this->load->view('/themes/public/footer') ?>