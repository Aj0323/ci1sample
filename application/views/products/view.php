<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/view_product.css">
<article class="product">
  <header>
    <?php echo form_open_multipart('products/insert_cart'); ?>
    <h1><?php echo $products['product_name']; ?></h1>
  </header>

  <input type="hidden" name="product_id" value="<?php echo $products['id']; ?>">
  <input type="hidden" name="product_name" value="<?php echo $products['product_name']; ?>">
  <input type="hidden" name="product_image" value="<?php echo $products['product_image']; ?>">
  <input type="hidden" name="price" value="<?php echo $products['price']; ?>">
  

  <section class="product-images">
    <figure class="product-thumb thumb-active" data-pos="0">
      <img src="<?php echo base_url(); ?>assets/images/products/<?php echo $products['product_image']; ?>" alt="" height="600" width="600">
  </section>  
  
  <section class="product-content">
    <b class="product-price">₱ <?php echo $products['price']; ?></b>
    <br>
    
    <div class="product-description">
      <p><?php echo $products['description'] ?></p>
      <input type="number" min="1" name="quantity" required="">
      <br>
      <br>
       <div><button class="btn btn-success btn-block" type="submit">Add to cart</button></div>
    </div>
  </section>
  
  
</article>

</form>