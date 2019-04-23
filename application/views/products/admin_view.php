  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">

* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;

  font-family: Arial;
}

/* Center website */
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
  color: #ffffff;
}

.h3{
  font-size: 15px;
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
  background-color: #000000;
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

<div class="container">

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">
    Add Product
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
    <div class="modal-body">
        <?php echo validation_errors(); ?>
          <?php echo form_open_multipart('products/create'); ?>
          <div class="container"> 
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="product_name" placeholder="Product Name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea id="editor1" type="text" class="form-control" name="description" placeholder="Add Description"></textarea>
            </div>
            <label>Price</label>
              <input type="text" class="form-control" name="price" placeholder="Price">
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control" name="quantity" placeholder="Quantity">
            <div class="form-group">
              <label>Category</label>
              <select name="category_id" class="form-control">
              <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name'] ?></option>
              <?php endforeach; ?>  
              </select>
            </div>
            <div class="form-group">
              <label>Upload Images</label>
                <br>
              <input type="file" name="userfile" size="20">
            </div>
          </div>
                  </div>
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      </div>
    </div>
  </div>
  </form>
</div>

    <h2><?= $title; ?></h2>
    <p class="second-header"><strong>VIEW ALL PRODUCTS</strong></p><br>
    
<?php foreach ($products as $product) : ?>
  <div class="container">
        <div class="column">
          <div class="content">
              <img class="pic-thumb" src="<?php echo site_url(); ?>assets/images/products/<?php echo $product['product_image']; ?>" style="width:100%">
              <h2 class="h2" name="product_name"><?php echo $product['product_name']; ?></h1>
              <h2 class="h2">₱ <?php echo $product['price']; ?> <br>
          </div>
            <br>
            <?php if($this->session->userdata('logged_in')) : ?>
            <a  href="<?php echo base_url('products/admin_product_view/'.$product['id']); ?>"><button class="btn btn-block btn-primary" type="submit">View Product</button></a>
              <?php endif; ?>
            <br>
        </div>
    </div>
<?php endforeach; ?>

<!-- value="<?php //echo $product['product_id'] ?>" -->

<!-- .$product['product_id'] -->