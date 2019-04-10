<h1><?= $title; ?></h1>
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
  <button type="submit" class="btn btn-primary">Submit</button>
</div>