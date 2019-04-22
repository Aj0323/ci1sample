<?php 
	$query = $this->db->get('cart');
	$result = return $query->result_array();
	$output = '';

	if($this->$result->row_array() > 0 ){
		while($row = result_array($result)){
			$output = '
			<li>
				<a href="#">
				<strong>'.$row['product_name'].'</strong><br>
				<small><em>'.$row['quantity'].'</em></small>
				</a>
				</li>
			';
		}
	} else {
		$output = '<li><a href="#">No Notification found </a></li>';
	}

	$query = "SELECT * FROM cart WHERE status = 0";
	$result = $this->db->query($query);
	return $result->row_array();

	$data = array(
		'notification' => $output,
		'unseen_notification' => $count
	);

	echo json_encode($data);

?>