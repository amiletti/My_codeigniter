<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <?php $this->load->view('themes/public/head'); ?>

</head>
<body role="document">

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Ci improved</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php if($this->user): ?>
          <li><a href="/change_password">change password</a></li>
          <li><a href="/logout">logout</a></li>
        <?php else: ?>
          <li><a href="/login">login</a></li>
        <?php endif ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>

<div class="container theme-showcase" role="main">

<?php $this->load->view('themes/admin/alerts'); ?>