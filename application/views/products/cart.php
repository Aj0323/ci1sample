
<table class="table table-success">
  <thead>
  <th>ID</th>
  <th>Product</th>
  <th>Picture</th>
  <th>Quantity</th>
  <th>Price</th>
  <th>Remove</th>
  </thead>
  <tbody>
   
  <?php foreach($carts as $cart): ?>
    <tr>
        <td><?php echo $cart['id'];  ?></td>
        <td><?php echo $cart['product_name']; ?></td>
        <td><?php echo $cart['product_image']; ?></td>
        <td><?php echo $cart['quantity'];?></td>
        <td><?php echo $cart['price']; ?></td>
        <td><a href="<?php echo base_url('products/delete_cart/'.$cart['id']); ?>"><button class="btn btn-danger">X</button></td>
    </tr>
</tbody>
<?php  endforeach; ?>
</table> <br>
<strong>Total:</strong><p><?php echo $sum; ?></p>
<?php foreach($carts as $cart): ?>


<?php echo form_open_multipart('Products/checkoutproduct'); ?>
  <?php echo validation_errors(); ?>

  <input type="hidden" name="name" value="<?php echo $cart['product_name']; ?>">
  <input type="hidden" name="qty" value="<?php echo $cart['quantity']; ?>">
  <input type="hidden" name="total_qty" value="<?php echo $cart['total_quantity']; ?>">

<?php  endforeach; ?>
  <input type="submit" name="submit" style="float:right;" class="btn btn-success">
</form>