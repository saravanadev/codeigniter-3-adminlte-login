<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->isLoggedIn)
		{
			redirect('Dashboard','refresh');
		}
	}

	public function login()
	{
		$data['error'] = "";
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$isLoggedIn = $this->User_Model->auth($email,$password);
			if($isLoggedIn) {
				redirect('Dashboard','refresh');
			}
			$data['error'] = "Invalid credentials";
			$this->load->view('login', $data);
		} else 
		{
			$this->load->view('login', $data);
		}
	}

	public function register()
	{
		$data["error"] = "";
		$data["success"] = "";
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'trim|required|is_unique[users.mobileNumber]|exact_length[10]');

			if ($this->form_validation->run() == TRUE) {
				$user = array(
					"username" => $this->input->post('username'),
					"email" => $this->input->post('email'),
					"password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					"mobileNumber" =>$this->input->post('mobilenumber')
				);
				$this->User_Model->create($user);
				$data["success"] = "Account created successfully";
				$this->load->view('register', $data);
			} else {
				$data['error'] = validation_errors();
				$this->load->view('register', $data);
			}
		} else
		{
			$this->load->view('register', $data);
		}
	}
}