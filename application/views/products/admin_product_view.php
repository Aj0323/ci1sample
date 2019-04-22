<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/view_product.css">
<article class="product">
  <header>
    <h1><?php echo $products['product_name']; ?></h1>
  </header>
  
  <section class="product-images">
    <figure class="product-thumb thumb-active" data-pos="0">
      <img src="<?php echo base_url(); ?>assets/images/products/<?php echo $products['product_image']; ?>" alt="" height="600" width="600">
  </section>  
  
  <section class="product-content">
    <b class="product-price">₱ <?php echo $products['price']; ?></b> <br>
    <b class="product-price">QTY: <?php echo $products['quantity']; ?></b> <br>
    <br>
    
    <div class="product-description">
      <p><?php echo $products['description'] ?></p> <br>
       <a href="<?php echo base_url('products/edit_product/'.$products['id']); ?>"><div><button class="btn btn-primary btn-block">EDIT</button></div></a>
       <br>
       <a href="<?php echo base_url('products/delete/'.$products['id']); ?>"><div><button class="btn btn-danger btn-block">DELETE</button></div></a>
    </div>
  </section>
  
  
</article>