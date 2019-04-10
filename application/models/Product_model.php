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
		$data = array(

			'product_name' => $this->input->post('product_name'),
			'price' => $this->input->post('price'),
			'quantity' => $this->input->post('quantity'),
			'category_id' => $this->input->post('category_id'),
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

			$data = array(
				'product_id' => $product_id['id'],
				'product_image' => $product_id['product_image'],
				'product_name'=> $product_id['product_name'],
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
		public function update_product(){
			$item = $this->input->post('product_name');

			$data = array(
				'product_name' => $this->input->post('product_name'),
				'price' => $this->input->post('price'),
				'quantity' => $this->input->post('quantity'),
				'description' => $this->input->post('description')
			);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('products', $data);
		}

		public function delete_product($id){
			$this->db->where('id', $id);
			$this->db->delete('products');
			return true;
		}
	}	