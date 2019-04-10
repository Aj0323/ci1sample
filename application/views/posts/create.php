<h1><?= $title; ?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Body</label>
    <textarea id="editor1" type="password" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
  	<label>Category</label>
  	<select name="category_id" class="form-control">
  	<?php foreach($categories as $category): ?>
  		<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
  	<?php endforeach; ?>	
  	</select>
  </div>
  <div class="form-group">
  	<label>Upload Images</label>
  		<br>
  	<input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>