<html>
<head>
	<title>ci1sample</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/view_product.css">
  <script src="http://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <li><a class="nav-link" href="products/cart_view">Cart</a></li>
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