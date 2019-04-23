<?php

class Products extends CI_Controller{
	
	public function index(){
		$data['title'] ='Products';
		
		$data['products'] = $this->product_model->get_product();

		$this->load->view('templates/header');
		$this->load->view('products/index', $data);
		$this->load->view('templates/footer');
	}


	public function checkoutproduct (){

		$name=$this->input->post('name');
		$quantity=$this->input->post('qty');
		$total=$this->input->post('total_qty');


     	$data['checkout'] = $this->product_model->checkout_product($name,$quantity,$total);
		
		#redirect('products');

	}

	public function create(){

		$data['title'] = 'Add Product';

		$data['products'] = $this->product_model->get_product();
		$data['categories'] = $this->product_model->get_category();

		$this->form_validation->set_rules('product_name','Product Name','required');
		$this->form_validation->set_rules('price','Price','required');

		if($this->form_validation->run() === FALSE){


		$this->load->view('templates/admin_header');
		$this->load->view('products/create', $data);
		$this->load->view('templates/admin_footer');

		} else {
			//dito ang image upload
			$config['upload_path'] = './assets/images/products';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload()){
				$errors = array('error' => $this->upload->display_errors());
				$product_image = 'noimage.jpg';
			} else {
				$data = array('upload_data' => $this->upload->data());
				$product_image = $_FILES['userfile']['name'];
			}

			$this->product_model->create_product($product_image);
				redirect('products/admin_view');
		}
	}


	public function product_view($id = null){

		$data['products'] = $this->product_model->fetch_products($id);

		if(empty($data['products'])){
				show_404();
			}

	
			$this->load->view('templates/header');
			$this->load->view('products/view', $data);
			$this->load->view('templates/footer');	
	}

	public function admin_view(){

		$data['title'] ='Products';
		
		$data['products'] = $this->product_model->admin_product();
		$data['categories'] = $this->product_model->get_category();
	
			$this->load->view('templates/admin_header');
			$this->load->view('products/admin_view', $data);
			$this->load->view('templates/admin_footer');	
	}

	public function admin_product_view($slug){

		$data['products'] = $this->product_model->fetch_products($slug);

		if(empty($data['products'])){
				show_404();
			}

			$this->load->view('templates/admin_header');
			$this->load->view('products/admin_product_view', $data);
			$this->load->view('templates/footer');	
	}


	public function insert_cart($product_id = null, $product_name = null, $product_price = null) {

		$data['carts'] = $this->product_model->fetch_cart($product_id, $product_name, $product_price);

		if(empty($data['carts'])){
			show_404();
	} else {
		$product_data = array(	
			'product_id' => $product_id,
			'price' => $product_price,
			'logged_in' => true
		);
		#$this->load->view('templates/header');
		#$this->load->view('products/insert_cart');
		#$this->load->view('templates/footer');
		
		redirect('products');
		} 
	}

/*	public function my_order(){
		$data['place_cart'] = $this->product_model->place_product();
		
		if(empty($data['place_cart'])){
			show_404();
		} else {
			$order_data = array(

			);
		}
	} */
	public function edit_product($slug){

		if(!$this->session->userdata('logged_in')){
				redirect('admin/login');
			}

			$data['products'] = $this->product_model->fetch_product($slug);
			if($this->session->userdata('user_id')){
				redirect('admin_view');
			}

			$data['title'] = 'Edit Product';

			$this->load->view('templates/admin_header');
			$this->load->view('products/edit', $data);
			$this->load->view('templates/admin_footer');
	}

	public function product_update(){

		$this->product_model->update();

		//pag set ng message

		 $this->session->set_flashdata('product_updated', 'Your product has been updated.');

		redirect('products/admin_view');
		}


		public function delete($id){

		if(!$this->session->userdata('logged_in')){
				redirect('users/admin_login');
			}

			$this->product_model->delete_product($id);

			//pag set ng message

		 	$this->session->set_flashdata('product_deleted', 'Your post has been deleted.');

			redirect('products/admin_view');
		}

		public function cart_view(){
			$data['carts'] = $this->product_model->get_cart();
			$data['sum'] = $this->product_model->get_total();
			$data['title'] = 'Your Cart';
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}
			//kuha ng cart
			$data['title'] = 'Your Cart';

			$this->load->view('templates/header');
			$this->load->view('products/cart', $data);
			$this->load->view('templates/footer');
		}

		public function delete_cart($id){
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->product_model->delete_cart($id);

			redirect('products/cart_view');
		}

		public function check_out(){

			$data = $this->product_model->check_out();

			$this->load->view('templates/header');
			$this->load->view('products/index', $data);
			$this->load->view('templates/footer');
		}
	}



?>


<!-- DIKO NAGAMIT NA MGA FUNCTIONS AND CONDITIONS

/*	public function add_cart(){

		$data['title'] = 'Your Cart';

		$data['cart'] = $this->product_model->fetch_products();

		$this->load->view('templates/header');
		$this->load->view('products/cart');
		$this->load->view('templates/footer');

		$item = array(
			'product_id' => $data['product_id'],
			'user_id' => $data['user_id'],
			'quantity' => $data['quantity'],
			'price' => $data['price']
		);

		if(!$this->session->has_userdata('cart')){
			$cart = array($item);
			$this->session->set_userdata('cart', serialize($cart));
		} else {
			$this->exists($id);
			$cart = array_values(unserialize($this->session->userdata('cart')));

			if($index == 1){
				array_push($cart, $item);
				$this->session->set_userdata('cart', serialize($cart));
			} else {
				$cart[$index]['quantity']++;
				$this->session->set_userdata('cart', serialize($cart));
			}
		}
		redirect('cart');
	} 
	public function remove($id){
		$index = $this->exists($id);
		$cart = array_values(unserialize($this->session->userdata('cart')));
		unset($cart[$index]);
		redirect('cart');
	}

	private function exists($id){
		$cart = array_values(unserialize($this->session->userdata('cart')));
		for ($i = 0; $i < count($cart); $i++){
			if($cart[$i]['id'] == $id){
			return $i;
			}
		}
		return -1;
	}
	private function total(){
		$items = array_values(unserialize($this->session->userdata('cart')));
		$s = 0;

		foreach ($items as $item){
			$s += $item['price'] * $item['quantity'];
		}
		return $s;
	}
*/
-->