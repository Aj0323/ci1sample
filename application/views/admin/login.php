  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php echo form_open('users/admin_login'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h1 class="text-center"><?php echo $title; ?></h1>
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username" >
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" >
				</div>
				<button type="submit" class="btn btn-primary btn-block">Log In</button>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>