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
    <b class="product-price">₱ <?php echo $products['price']; ?></b>
    <a href="<?php echo base_url('products/insert_cart/'.$products['id']); ?>"><div><button class="btn btn-success">Add to cart</button></div></a> <br>
    
    <div class="product-description">
      <p><?php echo $products['description'] ?></p>
    </div>
  </section>
  
  
</article>