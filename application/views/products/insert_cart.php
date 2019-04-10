 <table class="table table-hover">
	<thead class="table-success">
		<th>Product</th>
		<th>Image</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Subtotal</th>
	</thead>
<?php foreach($carts as $cart): ?>
	<tbody>
		<tr>
			<td><?php echo $cart['product_name']; ?></td>
			<td><img class="pic-thumb" src="<?php echo site_url(); ?>assets/images/products/<?php echo $carts['product_image']; ?>" style="width:100%"></td>
			<td><?php echo $cart['price']; ?></td>
			<td><?php echo $cart['quantity']; ?></td>
		</tr>
	</tbody>
<?php endforeach; ?>
</table>
