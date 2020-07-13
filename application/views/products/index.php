<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<style type="text/css">

* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;

  font-family: Arial;
}

/*Center website*/
.main {
  max-width: 1000px;
  margin: auto;
}

h1 {
  font-size: 30px;
  word-break: break-all;
}

.h2{
  font-size: 20px;
}

.h3{
  font-size: 20px;
}

.row {
  margin: 10px -16px;
}

/* Add padding BETWEEN each column (if you want) */
.row,
.row > .column {
  padding: 10px;
}

/* Create four equal columns that floats next to each other */
.column {
  float: left;
  width: 25%;
  padding-right: 10px;
}

/* Clear floats after rows */ 
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Content */
.content {
  background-color: #009fff;
  padding: 10px;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 900px) {
  .column {
    width: 100%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}

.pic-thumb{
  width: 100%;
  height: 300px;
}
</style>

<?php if(!$this->session->userdata('logged_in')) : ?>
  <p class="alert alert-success">Please Log In to View Products</p>
<?php endif; ?>
		<h1><?= $title; ?></h1>
		<p class="second-header"><strong>Find the product you desire</strong></p>

    			<div class="container-content" id="showdata"> 

          </div>
<script>
  $(function(){
    showAllProducts();

    var socket = io.connect('http://localhost:3000');
    var $showdata = $('#showdata');

    socket.on('new_product', function(data){
      console.log(data);
      $showdata.append('<div class = "container">'+
                         '<div class = "column">'+
                         '<div class ="content" id="content-'+data.data.id+'">'+
                         '<input type="hidden" id="product_id" value="'+data.data.id+'">'+
                         '<img class="pic-thumb" id="product_photo" src="<?php echo site_url(); ?>assets/images/products/'+data.data.photo+'" style="width:100%">'+
                         '<div id="info">'+
                         '<h2 class="h2 prod_name" name="product_name" id="product_name">'+data.data.product_name+'</h2>'+
                         '<h2 class="h3 prod_price" id="product_price">₱ '+data.data.price+'<br>'+
                         '</div>'+
                         '</div>'+
                         '<br>'+
                         '<?php if($this->session->userdata('logged_in')) : ?>'+
                         '<a  href="<?php echo site_url();?>products/product_view/'+data.data.id+'"><button class="btn btn-block btn-primary" type="submit" id="viewProduct">View Product</button></a>'+
                         '<?php endif; ?>'+
                         '<br>'+
                         '</div>'+
                         '</div>')
    });


    socket.on('new_update', function(update){
      console.log(update);
      //$(`#content-${update.update.id}`).find('img').text(update.update.photo)
      $(`#content-${update.update.id}`).find('.prod_name').text(update.update.product_name)
      $(`#content-${update.update.id}`).find('.prod_price').text("₱" +" "+ update.update.price)
      // $(`#content-${update.update.id}`).find('.prod_name').delay(4000).fadeOut('normal');
      // $(`#content-${update.update.id}`).find('.prod_price').delay(4000).fadeOut('normal');
      // $('.content').append(
      //   '<h2 class="h2" name="product_name">'+update.update.product_name+'</h2>'+
      //   '<h2 class="h2">₱ '+update.update.price+'<br>').find("#product_id");
    });

    socket.on('new_delete', function(del){
      // console.log('del');
      $(`#content-${del.del.id}`).find('.prod_name').fadeIn().delay(5000).fadeOut('normal');
      $(`#content-${del.del.id}`).find('.prod_price').fadeIn().delay(5000).fadeOut('normal');
      showAllProducts();
    });

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
                  html+= '<div class = "container">'+
                         '<div class = "column">'+
                         '<div class ="content" id="content-'+data[i].id+'">'+
                         '<input type="hidden" id="product_id" value="'+data[i].id+'">'+
                         '<img class="pic-thumb" id="product_photo" src="<?php echo site_url(); ?>assets/images/products/'+data[i].product_image+'" style="width:100%">'+
                         '<div id="info">'+
                         '<h2 class="h2 prod_name" name="product_name">'+data[i].product_name+'</h2>'+
                         '<h2 class="h3 prod_price">₱ '+data[i].price+'<br>'+
                         '</div>'+
                         '</div>'+
                         '<br>'+
                         '<?php if($this->session->userdata('logged_in')) : ?>'+
                         '<a  href="<?php echo site_url();?>products/product_view/'+data[i].id+'"><button class="btn btn-block btn-primary" type="submit" id="viewProduct">View Product</button></a>'+
                         '<?php endif; ?>'+
                         '<br>'+
                         '</div>'+
                         '</div>';
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



<!-- value="<?php //echo $product['product_id'] ?>" -->

<!-- .$product['product_id'] -->