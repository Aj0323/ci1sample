<h1><?= $title; ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('products/product_update'); ?>
 <div class="container"> 
  <input type="hidden" name="id" value="<?php echo $products['id']; ?>">
  <div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="product_name" value="<?php echo $products['product_name']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" name="description" value="<?php echo $products['description']; ?>">
  </div>
  <label>Price</label>
    <input type="text" class="form-control" name="price" value="<?php echo $products['price']; ?>">
  <div class="form-group">
    <label>Quantity</label>
    <input type="text" class="form-control" name="quantity" value="<?php echo $products['quantity']; ?>">
  <div class="form-group">
  </div>
 <button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>