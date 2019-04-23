<?php

class Product_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function get_product(){
		$rs = [];
		$query = $this->db->query('SELECT * FROM products');
		foreach($query->result_array() as $row){
			if($row['quantity'] > 0){
				$rs[] = $row;
			}
		}
		
		return $rs;
		// return $query->result_array();
		
		// $id = $this->db->select('id')
		// 	->from('products');
		// 	return $id->result_array();
				
		// $qtyview = $this->db->select('quantity')
		// 		->from('products')
		// 		->where('id', $id);
		// 		return $qtyview->row_array();
		
		// 	if($qtyview < 1){
		// 		return false;
		// 	}
		}
		
		public function admin_product(){
			$query = $this->db->get('products');
			return $query->result_array();
		}

	public function get_category(){
			$this->db->order_by('categories.id', 'DESC');

			$query = $this->db->get('categories');
			return $query->result_array();
		}

	public function create_product($product_image){
			$slug = url_title($this->input->post('product_name'));
			$data = array(

			'product_name' => $this->input->post('product_name'),
			'price' => $this->input->post('price'),
			'quantity' => $this->input->post('quantity'),
			'category_id' => $this->input->post('category_id'),
			'slug' => $slug,
			'user_id' => $this->session->userdata('admin_id'),
			'description' => $this->input->post('description'),
			'product_image' => $product_image



		);

		return $this->db->insert('products', $data);

	}

		public function fetch_products($id = FALSE){
			if($id === FALSE){
				$this->db->order_by('products.id','ASC');
				$query = $this->db->get('products');
				return $query->result_array();
			}
			$query = $this->db->get_where('products', array('id' => $id));
			return $query->row_array();
			

	}

		public function fetch_product($id = FALSE){
			if($id === FALSE){
				$this->db->order_by('products.id','ASC');
				$query = $this->db->get('products');
				return $query->result_array();
			}
			$query = $this->db->get_where('products', array('id' => $id));
			return $query->row_array();
		}


		public function fetch_cart($id = FALSE){
		/*	$data = array(
			'product_id' => $this->session->userdata('product_id'),
			'product_name' => $this->session->userdata('product_name'),
			'user_id' => $this->session->userdata('user_id')
			);
			return $this->db->insert('cart', $data); */

			$products_id = $this->db->order_by('products.id');
			$query = $this->db->get_where('products', array('id' => $id));
			$product_id = $query->row_array();

			$price = $this->input->post('price');
			$quantity = $this->input->post('quantity');

			$subtotal = $price * $quantity;


			$data = array(
				'product_id' => $this->input->post('product_id'),
				'product_image' => $this->input->post('product_image'),
				'price' => $subtotal,
				'product_name'=> $this->input->post('product_name'),
				'quantity' => $this->input->post('quantity'),
				'user_id' => $this->session->userdata('user_id'),
				'total_quantity'=>$this->input->post('total_quantity'),
				'status' => '1'
			);
			return $this->db->insert('cart', $data);

			
		}

	/*	public function place_product(){
			$cart_id = $this->db->order_by('cart.id');
			$query = $this->db->get_where('cart', array('id' => $id));
			$cart_id = $query->row_array();

			return $this->db->update('cart', $data);
		} */
		public function update(){
			
			$slug = url_title($this->input->post('product_name'));
			$data = array(
				'product_name' => $this->input->post('product_name'),
				'description' => $this->input->post('description'),
				'slug' => $slug,
				'price' => $this->input->post('price'),
				'quantity' => $this->input->post('quantity')
			);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('products', $data);
		}

		public function delete_product($id){
			$this->db->where('id', $id);
			$this->db->delete('products');
			return true;
		}

		

		public function delete_cart($id){
			$this->db->where('id', $id);
			$this->db->delete('cart');
			return true;
		}

		public function get_total(){

			$user_id = $this->session->userdata('user_id');

			 $query = $this->db->select('SUM(price) as cart_total')->from('cart')->where('user_id', $user_id)->get();

			return $query->row()->cart_total;

		}

		public function get_cart($id = false){
			$this->db->order_by('cart.cart_date');
			$user_id = $this->session->userdata('user_id');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get('cart');

			return $query->result_array();
		}

			#public function check_out(){
			
			#$user_id = $this->session->userdata('user_id');

			#$get_cart = $this->db->query('SELECT quantity FROM cart WHERE user_id = $user_id');
			#return $get_cart->result_array();

			#foreach ($get_cart as $cart) {
			#	if($cart === NULL){
			#		show_404();
			#	} else {
			#		echo '$cart';
			#	}

			#}
		
			#$this->db->update('products', $newquan);

			#$this->db->select('cart.quantity sum(product.quantity) as product_quantity');
			#$this->db->from('products');
			#$this->db->join('cart', 'cart.quantity = products.quantity', 'right');
			#$this->db->group_by('clients.client_ref');
			#$this->db->order_by('product_quantity', 'desc');
			#$products = $this->db->get()->result_object();

			#$productq = $this->input->post('productq');
			#$cartq = $this->input->post('cartq');

		#get item qt (ordered)
		#forloop
		#get product qt
		#product qt - item qt
		#update product qt
		
	



		public function checkout_product(){

		$id = $this->session->userdata('user_id');
		$arrqty = [];
		//item qty
		$query = $this->db->query("SELECT quantity, total_quantity, product_name FROM cart WHERE user_id = '$id'");

		foreach($query->result_array() as $row){
			if($row['quantity'] > 0){
				$arrqty[] = $row;
			}
		}

		$updateqty = $arrqty[0]['total_quantity'] - $arrqty[0]['quantity'];
		print_r($updateqty);

		$arrqty2 = [];
		$query2 = $this->db->query("SELECT quantity, product_name FROM products");

		foreach($query2->result_array() as $row2){
			if($row2['quantity'] > 0){
				$arrqty2[] = $row2;
			}
		}
		//return $arrqty2;

		
		//product qty
		#$total_qty = $this->input->post('total_qty');
		
		#$total_quantity = $total_qty - $rs;
			
		#$data = array(
		#	'quantity' => $total_quantity
		#);
		#$name = $this->input->post('name');
		#$id = $this->session->userdata('user_id');

		#$this->db->where('product_name', $name);
		#$this->db->update('products', $data);

		#$this->db->where('user_id', $id);
		#$this->db->delete('cart');
		#return true;
		}
	}	