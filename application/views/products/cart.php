
<!-- <table class="table table-success">
  <thead>
  <th>ID</th>
  <th>Product</th>
  <th>Picture</th>
  <th>Quantity</th>
  <th>Price</th>
  <th>Remove</th>
  </thead>
  <tbody>
   
  <?php #foreach($carts as $cart): ?>
    <tr>
        <td><?php #echo $cart['id'];  ?></td>
        <td><?php #echo $cart['product_name']; ?></td>
        <td><?php #echo $cart['product_image']; ?></td>
        <td><?php #echo $cart['quantity'];?></td>
        <td><?php #echo $cart['price']; ?></td>
        <td><a href="<?php #echo base_url('products/delete_cart/'.$cart['id']); ?>"><button class="btn btn-danger">X</button></td>
    </tr>
</tbody>
<?php  #endforeach; ?>
</table> <br>
<strong>Total:</strong><p><?php #echo $sum; ?></p>
<?php #foreach($carts as $cart): ?>


<?php #echo form_open_multipart('Products/checkoutproduct'); ?>
  <?php #echo validation_errors(); ?>

  <input type="hidden" name="name[]" value="<?php #echo $cart['product_name']; ?>">
  <input type="hidden" name="qty[]" value="<?php #echo $cart['quantity']; ?>">
  <input type="hidden" name="total_qty[]" value="<?php #echo $cart['total_quantity']; ?>">

<?php  #endforeach; ?>
  <input type="submit" name="submit" style="float:right;" class="btn btn-success">
</form> -->

<style type="text/css">
  img{
    size: 25%;
    width: 10%;
  }
</style>

<div class="container">
  <h3>Cart Lists</h3>
  <div class="alert alert-success" style="display: none;">
    
  </div>
  <table class="table table-bordered table-responsive">
    <thead>
      <tr>
        <td>ID</td>
        <td>Product Image</td>
        <td>Product Name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Remove</td>
      </tr>
    </thead>
    <tbody id="showdata">

    </tbody>
  </table>
 <button id="btnCheckout" class="btn btn-success" style="float: right;">Checkout</button>
 <div id="total">
 Total: <?php echo $sum;?>
</div>
</div>
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
</div>
<div id="checkoutModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <br /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Purchase</h4>
      </div>
      <div class="modal-body">
          Do you want to check out this products?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="button" id="btnChoose" class="btn btn-info">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div id="choosePayment" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <br /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Choose Payment Method</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <div class="col-md-8">
              <input type="radio" name="cd" id="cdPayment">
              <label for="cardpayment" >Credit/Debit Card Payment</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-8">
              <input type="radio" name="cd" id="codPayment">
              <label for="cardpayment">Cash on Delivery</label>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnBack" class="btn btn-info">Back</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
          

<div id="chooseModal1" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="chooseForm1" action="" method="post" class="form-horizontal">
      <div class="modal-header">
        <br /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Credit/Debit Card Payment</h4>
      </div>
      <div class="modal-body">
          <!-- hidden input for card payment -->
          <div class="form-group" id="billingName1">
              <label for="billingName" class="label-control col-md-4">Full Name</label>
                <div class="col-md-8">
                  <input type="text" name="fullname1" placeholder="Fullname" required="">
                </div>
          </div>
            <div class="form-group" id="billingEmail1">
              <label for="billingEmail" class="label-control col-md-4">Email</label>
                <div class="col-md-8">
                  <input type="text" name="email1" placeholder="Email" required="">
                </div>
          </div>
            <div class="form-group" id="billingAddress1">
             <label for="billingAddress" class="label-control col-md-4">Full Address</label>
            <div class="col-md-8">
              <input type="text" name="address1" placeholder="Address" required="">
            </div>
          </div>
            <div class="form-group" id="billingCard">
              <label for="billingCard" class="label-control col-md-4">Credit/Debit Card Number</label>
            <div class="col-md-8">
              <input type="text" name="card" placeholder="1111-2222-3333-4444" required="">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button id="btnBackCd" type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
        <button type="submit" id="btnPurchase" class="btn btn-info">Submit</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div id="chooseModal2" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="chooseForm2" action="" method="post" class="form-horizontal">
      <div class="modal-header">
        <br /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cash On Delivery</h4>
      </div>
      <div class="modal-body">
          
          <!-- hidden input for cash on delivery -->
          <div class="form-group" id="billingName2">
              <label for="billingName" class="label-control col-md-4">Full Name</label>
                <div class="col-md-8">
                  <input type="text" name="fullname" placeholder="Fullname" required="">
                </div>
          </div>
            <div class="form-group" id="billingEmail2">
              <label for="billingEmail2" class="label-control col-md-4">Email</label>
                <div class="col-md-8">
                  <input type="text" name="email" placeholder="Email" required="">
                </div>
          </div>
            <div class="form-group" id="billingAddress2">
             <label for="billingAddress" class="label-control col-md-4">Full Address</label>
            <div class="col-md-8">
              <input type="text" name="address" placeholder="Address" required="">
            </div>
          </div>
          <div class="form-group" id="billingNotice">
             <label for="billingAddress" class="label-control col-md-8"><strong>Notice: </strong>Please be aware of the delivery time of your ordered product/s and also make sure you or the recipient will pay the right amount on the time of Delivery. Thankyou :)</label>
            <div class="col-md-8">
      
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button id="btnBackCod" type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
        <button type="submit" id="btnPurchase" class="btn btn-info">Submit</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script>
  $(function(){
    showAllCart();

    $('#btnCheckout').click(function(){
      $('#checkoutModal').modal('show');
    });

    $('#btnBack').click(function(){
      $('#choosePayment').modal('hide');
      $('#checkoutModal').modal('show');

    });

    $('#btnChoose').click(function(){
      $('#choosePayment').modal('show');
      $('#checkoutModal').modal('hide');

    });



    $('#cdPayment').click(function(){
      $('#choosePayment').modal('hide');
      $('#chooseModal1').modal('show');

    });

    $('#btnBackCd').click(function(){
      $('#chooseForm1')[0].reset();
      $('#chooseModal1').modal('hide');
      $('#choosePayment').modal('show');
    });

    $('#codPayment').click(function(){
      $('#choosePayment').modal('hide');
      $('#chooseModal2').modal('show');

  });

    $('#btnBackCod').click(function(){
      $('#chooseForm2')[0].reset();
      $('#chooseModal2').modal('hide');
      $('#choosePayment').modal('show');
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
          url: '<?php echo base_url();?>Products/deleteCart',
          data:{id:id},
          dataType: 'json',
          success: function(response){  
            if(response.success){
              $('#deleteModal').modal('hide');
              $('.alert-success').html('Product Removed to your cart').fadeIn().delay(4000).fadeOut('slow');
              showAllCart();
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

    function showGrandTotal(){
      $.ajax({
        type:'ajax',
        url:'<?php base_url(); ?>Products/get_total',
        async:false,
        dataType:'json',
        success: function(data){
          var html = '';
          var i;

          for(i=0; i<data.length; i++){
            gt+= '<p>'+data[i].sum+'</p>';
          }
          $('#total').html(html);
        },
        error: function(){
          alert('Cannot get grand total!');
        }
      });
    }



    //function
    function showAllCart(){
      $.ajax({
        type: 'ajax',
        url: '<?php echo base_url();?>Products/showAllCart',
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
                  '<td>'+
                    '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a><br>'+
                  '</td>'+
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

  // function get_total(){
  //   $.ajax({
  //     type:'ajax',
  //     url:'<?php #echo base_url();?>Products/get_total',
  //     dataType:'json',
  //     async:false,
  //     dataType:'json',
  //     success:function(data){
  //       var html = '';
  //       var t;

  //       for(i=0; i>data.length; i++){
  //         html +='<p>Total: '+data[i]+'</p>';
  //       }
  //     }
  //   });

  // }

   $('#chooseForm2').on('submit', function(e){
        e.preventDefault();

        $.ajax({
          url:'<?php echo base_url();?>Products/checkoutCod',
          method:'post',
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          dataType:'json',

          success:function(response){
            if(response.success){
              $('#chooseModal2').modal('hide');
              $('#chooseForm2')[0].reset();
              if(response.type == 'add'){
                  $('.alert-success').html('Product Successfully Checkedout').fadeIn().delay(4000).fadeOut('slow');
               }
            } else {
              alert('Error');
            }
          },
          error:function(){
            alert('Somethings wrong with the backend');
            }
        });
      });

   $('#chooseForm1').on('submit', function(e){
        e.preventDefault();

        $.ajax({
          url:'<?php echo base_url();?>Products/checkoutCd',
          method:'post',
          data:new FormData(this),
          processData:false,
          contentType:false,
          cache:false,
          async:false,
          dataType:'json',

          success:function(response){
            if(response.success){
              $('#chooseModal1').modal('hide');
              $('#chooseForm1')[0].reset();
              if(response.type == 'add'){
                  $('.alert-success').html('Product Successfully Purchased. Thank You :)').fadeIn().delay(4000).fadeOut('slow');
               }
            } else {
              alert('Error');
            }
          },
          error:function(){
            alert('Somethings wrong with the backend');
            }
        });
      });
</script>