<table class="table table-success">
<thead>
<th>Product</th>
<th>Quantity</th>
<th>Price</th>
<th>Remove</th>
</thead>
<tbody>
  <?php foreach($carts as $cart): ?>
  <tr>
    <td><?php echo $cart['product_name']; ?></td>
    <td><?php echo $cart['quantity'];?></td>
    <td><?php echo $cart['price']; ?></td>
    <td><a href="<?php echo base_url('products/delete_cart/'.$cart['id']); ?>"><button class="btn btn-danger">X</button></td>
  </tr>
</tbody>
<?php  endforeach; ?>
</table> <br>
<strong>Total:</strong><p><?php echo $sum; ?></p>
<a href="<?php base_url('products/check_out'); ?>"><button style="float: right;" type="submit" class="btn btn-primary">Check Out</button></a>