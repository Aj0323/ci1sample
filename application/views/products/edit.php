<h1><?= $title; ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('products/product_update'); ?>
 <div class="container"> 
  <div class="form-group">
    <label>Name</label>
    <textarea type="text" class="form-control" name="product_name"><?php echo $products['product_name']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea id="editor1" type="text" class="form-control" name="description"><?php echo $products['description']; ?></textarea>
  </div>
  <label>Price</label>
    <textarea type="text" class="form-control" name="price"><?php echo $products['price']; ?></textarea>
  <div class="form-group">
    <label>Quantity</label>
    <textarea type="text" class="form-control" name="quantity"><?php echo $products['quantity']; ?></textarea>
  <div class="form-group">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>