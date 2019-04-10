<?php
	class Users extends CI_Controller{
		// ito ay register controller

		public function register(){
			$data['title'] = 'Sign Up';

		  	$this->form_validation->set_rules('name', 'Name', 'required');
		  	$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
		  	$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		  	if($this->form_validation->run() === FALSE){
		  		$this->load->view('templates/header');
		  		$this->load->view('users/register', $data);
		  		$this->load->view('templates/footer');
		  	} else {
		  		// hashing ito ng password
		  		$enc_password = md5($this->input->post('password'));

		  		$this->user_model->register($enc_password);
		  		
		  		//pag set ng message

		  		$this->session->set_flashdata('user_registered', 'You are now registered and can Log in.');

		  		redirect('home');
		  	}

		  }


		  // ito ay login controller

		 public function login(){
			$data['title'] = 'Sign In';

		  	$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			

		  	if($this->form_validation->run() === FALSE){
		  		$this->load->view('templates/header');
		  		$this->load->view('users/login', $data);
		  		$this->load->view('templates/footer');
		  	} else {

		  		//pagkuha ng username
		  		$username = $this->input->post('username');
		  		//pagkuha ng password
		  		$password = md5($this->input->post('password'));

		  		//pag login ng user
		  		$user_id = $this->user_model->login($username, $password);

		  		if($user_id){
		  			// pag gawa ng session
		  			$user_data = array(
		  				'user_id' => $user_id,
		  				'username' => $username,
		  				'logged_in' => true
		  			);

		  			$this->session->set_userdata($user_data);
		  			//pag set ng message
		  			$this->session->set_flashdata('user_loggedin', 'You are now Logged in.');

		  			redirect(base_url());

		  			} else {

		  			//pag set ng message
		  			$this->session->set_flashdata('login_failed', 'Invalid username or password.');

		  			redirect('users/login');

		  		}
		  	}

		 } 

		 	public function admin_login(){
			$data['title'] = 'Admin Authentication';

		  	$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			

		  	if($this->form_validation->run() === FALSE){
		  		$this->load->view('templates/admin_header');
		  		$this->load->view('admin/login', $data);
		  		$this->load->view('templates/admin_footer');
		  	} else {

		  		//pagkuha ng username
		  		$username = $this->input->post('username');
		  		//pagkuha ng password
		  		$password = md5($this->input->post('password'));

		  		//pag login ng user
		  		$admin_id = $this->user_model->admin_login($username, $password);

		  		if($admin_id){
		  			// pag gawa ng session
		  			$admin_data = array(
		  				'admin_id' => $admin_id,
		  				'username' => $username,
		  				'logged_in' => true
		  			);

		  			$this->session->set_userdata($admin_data);
		  			//pag set ng message
		  			$this->session->set_flashdata('user_loggedin', 'You are now Logged in.');

		  			redirect('users/admin_home');

		  			} else {

		  			//pag set ng message
		  			$this->session->set_flashdata('login_failed', 'Invalid username or password.');

		  			redirect('users/admin_login');

		  			}
		  		}

		  	}

		  	public function admin_home(){
		  		$data['title'] = 'Home';

		  		$this->load->view('templates/admin_header');
		  		$this->load->view('admin/home', $data);
		  		$this->load->view('templates/admin_footer');
		  	}


		  			//logout ng user

		  		public function logout(){
		  			$this->session->unset_userdata('logged_in');
		  			$this->session->unset_userdata('user_id');
		  			$this->session->unset_userdata('username');

		  			//pag set ng message

		  			$this->session->set_flashdata('user_loggedout', 'You are now Logged out.');
		  			$this->session->sess_destroy();
		  			redirect('users/login');
		  		}

		  		public function admin_logout(){
		  			$this->session->unset_userdata('logged_in');
		  			$this->session->unset_userdata('admin_id');
		  			$this->session->unset_userdata('username');

		  			//pag set ng message

		  			$this->session->set_flashdata('user_loggedout', 'You are now Logged out.');
		  			$this->session->sess_destroy();
		  			redirect('users/admin_login');
		  		}

		  	function check_username_exists($username){
		  		$this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one');
		  		if($this->user_model->check_username_exists($username)){
		  			return true;

		  		} else {
		  			return false;
		  		}

		}

			public function check_email_exists($email){
		  		$this->form_validation->set_message('check_email_exists', 'That email is already taken, Please choose a different one');
		  		if($this->user_model->check_email_exists($email)){
		  			return true;

		  		} else {
		  			return false;
		  		}

		}
}