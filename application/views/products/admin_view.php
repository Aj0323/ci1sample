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
  background-color: #00b77a;
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
    <p class="second-header"><strong>VIEW ALL PRODUCTS</strong></p>

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