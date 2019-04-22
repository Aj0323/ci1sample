<html>
<head>
  <title>ADMIN</title>
  
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/view_product.css">
      <script src="http://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
      
      <script>
        $('#btn').click(function(){
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('hello');
    });
      </script>

      <script>
        $(document).ready(function {
          var notifCart = 2;
          $("button").click(function {
            notifCart = notifCart
            $("#carts").load("load_cart.php",{

            });
          });
      });
      </script>
      <script>
        $(document).ready(function(){
          function load_unseen_notification(view = '')
          {
            $.ajax({
              url:"cart_fetch.php",
              method:"POST",
              data:{view:view},
              dataType:"json",
              success:function(data)
              {
                $('.dropdown-menu').html(data.notification);
                if(data.unseen_notification > 0 )
                {
                  $('.count').html(data.unseen_notifcation);
                }
              }
            })
          }

          load_unseen_notification();

          $('#cart_form').on('submit', function(){
            event.preventDefault();
            if($('#product_name').val() != '' && $('#quantity').val() != ''){
              var form_data = $(this).serialize();
              $.ajax({
                url:
                method:"POST",
                data:form_data,
                success:function(data)
                {
                  $('#cart_form')[0].reset();
                  load_unseen_notification();
                }
              })
            }
          });
        });
      </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">ADMIN</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>users/admin_home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>products/admin_view">Products</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php if(!$this->session->userdata('logged_in')) : ?>
                <li><a class="nav-link" href="<?php echo base_url(); ?>users/admin_login">Log In</a></li>
              <?php endif; ?>
              <?php if($this->session->userdata('logged_in')) : ?>
                 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="fa fa-bell">ASD</span></a></li>
                <li><a class="nav-link" href="<?php echo base_url(); ?>products/create">Add Product</a></li>
                <li><a class="nav-link" href="<?php echo base_url(); ?>users/admin_logout">Log Out</a></li>
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

    <!-- Flash Message ito -->
    <?php if($this->session->flashdata('admin_loggedin')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('admin_loggedin').'</p>'; ?>
    <?php endif; ?>

    <!-- Flash Message ito -->
    <?php if($this->session->flashdata('added_product')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('added_product').'</p>'; ?>
    <?php endif; ?>