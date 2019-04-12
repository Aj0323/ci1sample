<?php

class Product_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function get_product(){

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
				'user_id' => $this->session->userdata('user_id')
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

		public function get_cart($id = false){
			$this->db->order_by('cart.cart_date');
			$user_id = $this->session->userdata('user_id');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get('cart');

			return $query->result_array();
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

		public function check_out(){
			
			$this->db->select('cart.quantity sum(product.quantity) as product_quantity');
			$this->db->from('products');
			$this->db->join('cart', 'cart.quantity = products.quantity', 'right');
			$this->db->group_by('clients.client_ref');
			$this->db->order_by('product_quantity', 'desc');
			$products = $this->db->get()->result_object();

			$productq = $this->input->post('productq');
			$cartq = $this->input->post('cartq');

			$this->db->update('products', $products);
		}
	}	