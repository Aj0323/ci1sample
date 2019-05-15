<html>
<head>
	<title>ci1sample</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>

      <link rel="stylesheet" href="<?php base_url('assets/css/style.css'); ?>">
      <link rel="stylesheet" href="<?php base_url('assets/css/view_product.css');?>">
      <link rel="stylesheet" type="text/css" href="<?php base_url('assets/css/bootstrap-theme.min.css'); ?>">
      <script src="http://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
      <link rel="stylesheet" href="<?php base_url('assets/css/view_product.css');?>">

 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">E-Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>products">Products</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if(!$this->session->userdata('logged_in')) : ?>
        <li><a class="nav-link" href="<?php echo base_url(); ?>users/login">Log In</a></li>
        <li><a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a></li>
      <?php endif; ?>
      <?php if($this->session->userdata('logged_in')) : ?>
        <li><a class="nav-link" href="<?php echo base_url(); ?>products/cart_view">Cart</a></li>
        <li><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Log Out</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<div class="container">
  <br>
  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('user_registered')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('post_created')): ?>
    <?php echo '<p class="alert alert-success"'.$this->session->flashdata('post_created').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('post_updated')): ?>
    <?php echo '<p class="alert alert-success"'.$this->session->flashdata('post_updated').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('category_created')): ?>
    <?php echo '<p class="alert alert-success"'.$this->session->flashdata('category_created').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('login_failed')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_failed').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('user_loggedin')): ?>
    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
  <?php endif; ?>

  <!-- Flash Message ito -->
  <?php if($this->session->flashdata('user_loggedout')): ?>
    <?php echo '<p class="alert alert-success"'.$this->session->flashdata('user_loggedout').'</p>'; ?>
  <?php endif; ?>