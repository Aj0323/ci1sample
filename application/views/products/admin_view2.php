<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<style type="text/css">
	img{
		size: 25%;
		width: 10%;
	}
</style>

<div class="container">
	<h3>Products List</h3>
	<div class="alert alert-success" style="display: none;">
		
	</div>
	<?php if($this->session->userdata('logged_in')) : ?>
	<button id="btnAdd" class="btn btn-success">Add New</button>
<?php endif;?>
	<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<td>ID</td>
				<td>Product Image</td>
				<td>Product Name</td>
				<td>Price</td>
				<td>Quantity</td>
				<?php if($this->session->userdata('logged_in')) :?>
				<td>Action</td>
			<?php endif;?>
			</tr>
		</thead>
		<tbody id="showdata">
			
		</tbody>
	</table>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="closeForm" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        	<form id="myForm" action="" method="post" class="form-horizontal">
        		<div class="form-group">
        			<input type="hidden" name="id" value="0" id="prod_id">
        			<label for="name" class="label-control col-md-4">Product Name</label>
        			<div class="col-md-8">
        				<input type="text" name="product_name" class="form-control" id="product_name">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Price</label>
        			<div class="col-md-8">
        				<input type="text" name="price" class="form-control" id="price">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Quantity</label>
        			<div class="col-md-8">
        				<input type="text" name="quantity" class="form-control" id="quantity">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="name" class="label-control col-md-4">Category</label>
        			<div class="col-md-8">
        				<select name="category_id" class="form-control" id="categories">
			              <?php foreach($categories as $category): ?>
			                <option value="<?php echo $category['id']; ?>"><?php echo $category['name'] ?></option>
			              <?php endforeach; ?>  
			              </select>
        			</div>
        		</div>
        		<div class="form-group" id="product_image">
        			<label for="upload_photo" class="label-control col-md-4">Upload Photo</label>
        			<div class="col-md-8">
        				<input type="file" name="image_file" size="20"
        				id="image_file">
        			</div>
        		</div>
        		<div class="form-group">
        			<label for="description" class="label-control col-md-4">Description</label>
        			<div class="col-md-8">
        				<textarea class="form-control" name="description" id="description"></textarea>
        			</div>
        		</div>
        	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <br /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
        	Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$(function(){
		showAllProducts();

		var socket = io.connect('http://localhost:3000');
		var $prod_id = $('#prod_id');
		var $form = $('#myForm');
		var $prodname = $('#product_name');
		var $price = $('#price');
		var $qty = $('#quantity');
		var $cat = $('#categories');
		var $photo = $('#image_file');
		var $desc = $('#description');
		

		//Add New
		$('#btnAdd').click(function(){
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Add New Product');
		});

		$('#closeForm').click(function(){
			$('#myForm')[0].reset();
		});

		$(document).ready(function(){
		$('#myForm').on('submit', function(e){
			e.preventDefault();


			$.ajax({
				url:'<?php echo base_url();?>Products/addProduct',
				method:'post',
				data:new FormData(this),
				processData:false,
				contentType:false,
				cache:false,
				async:false,
				dataType:'json',
			success:function(response){
				console.log(response);
				console.log(response.type);

				if(response.data != null){
				var data = {
					'id' : response.data.id,
					'product_name' : $prodname.val(), 
					'price' : $price.val(), 
					'quantity' : $qty.val(),
					'category' : $cat.val(),
					'photo' : response.data.img,
					'description' : $desc.val()
				}
				socket.emit('add_product', data);
				} else {
					var data = {
					'id' : $prod_id.val(),
					'product_name' : $prodname.val(), 
					'price' : $price.val(), 
					'quantity' : $qty.val(),
					'category' : $cat.val(),
					'description' : $desc.val()
					}
				socket.emit('update_product', data);
				}

				if(response.success){
					$('#myModal').modal('hide');
					$('#myForm')[0].reset();
					if(response.type == 'add'){
						var type = 'added'
					} 
					else if (response.type == 'update')
					{
						var type = 'updated'
					}
					showAllProducts();
					$('.alert-success').html('Product added successfully').fadeIn().delay(4000).fadeOut('slow');


				} else {
					$('#myModal').modal('hide');
					$('#myForm')[0].reset();
					$('.alert-success').html('Product updated successfully').fadeIn().delay(4000).fadeOut('slow');
					showAllProducts();
				}
			},
			error:function(){
					alert('Could not add data');
					}
				});



			// socket.emit('add productname', $prodname.val());
			// $prodname.val('');

			// socket.emit('add price', $price.val());
			// $price.val('');

			// socket.emit('add quantity', $qty.val());
			// $qty.val('');

			// socket.emit('add category', $cat.val());
			// $cat.val('');

			// socket.emit('add photo', $photo.val());
			// $photo.val('');

			// socket.emit('add description', $desc.val());
			// $desc.val('');

			});
		});
//delete- 
		$('#showdata').on('click', '.item-delete', function(){
			var id = $(this).attr('data');
			$('#deleteModal').modal('show');
			//prevent previous handler - unbind()
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url();?>Products/deleteProduct',
					data:{id:id},
					dataType: 'json',
					success: function(response){
						console.log('return');
						if(response.success){
							socket.emit('delete_product', response.data);
							$('#deleteModal').modal('hide');
							$('.alert-success').html('Product Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
							showAllProducts();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Error deleting');
					}
				});
			});
		});


		// $('#btnSave').click(function(){
			
		// 		$.ajax({
		// 			method: 'post',
		// 			url: '<?php #echo base_url();?>Products/addProduct',
		// 			data: new FormData(this),
		// 			async: false,
		// 			dataType: 'json',
		// 			success: function(response){
		// 				if(response.success){
		// 					$('#myModal').modal('hide');
		// 					$('#myForm')[0].reset();
		// 					if(response.type=='add'){
		// 						var type = 'added'
		// 					}else if(response.type=='update'){
		// 						var type ="updated"
		// 					}
		// 					$('.alert-success').html('Product '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
		// 					showAllProducts();
		// 				}else{
		// 					alert('Error');
		// 				}
		// 			},
		// 			error: function(){
		// 				alert('Could not add data');
		// 			}
		// 		});
		// });


		//edit


		$('#showdata').on('click', '.item-edit', function(){
			var id = $(this).attr('data');
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Edit Product');
			$('#myForm').attr('action', '<?php echo base_url();?>Products/updateProduct');
			// $('#')
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url();?>Products/editProduct',
				data: {id: id},
				contentType:false,
				cache:false,
				async:false,
				dataType:'json',
				success: function(data){
					$('input[name=product_name]').val(data.product_name);
					$('input[name=price]').val(data.price);
					$('input[name=quantity]').val(data.quantity);
					$('select[name=category_id]').val(data.category_id);
					$('input[name=image_file]').val(data.image_file);
					$('textarea[name=description]').val(data.description);
					$('input[name=id]').val(data.id);
				},
				error: function(){
					alert('Could not Edit Data');
				}
			});
		});



		//function
		function showAllProducts(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url();?>Products/showAllProducts',
				async: false,
				dataType: 'json',
				success: function(data){

					var html = '';
					var i;
					for(i=0; i<data.length; i++){
					
						html +='<tr>'+
									'<td>'+data[i].id+'</td>'+
									'<td>'+'<img size="20%" src="<?php echo base_url(); ?>assets/images/products/'+data[i].product_image+'">'+'</td>'+
									'<td>'+data[i].product_name+'</td>'+
									'<td>'+data[i].price+'</td>'+
									'<td>'+data[i].quantity+'</td>'+	
									'<td> <?php if($this->session->userdata('logged_in')) : ?>'+
										'<button type="submit" href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</button>'+
										'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a><br>'+
									'</td><?php endif;?>'+
							    '</tr>';
					}
					$('#showdata').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}
	});
</script>
<script>
	$(document).ready(function(){
		 // var socket = io.connect();
	  //    var server = socket.listen();
	  //    var io = require('socket.io').listen(server);
	});
</script>