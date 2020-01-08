<?php
/**
 * 
 */
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->session->isLoggedIn)
		{
			redirect('user/login','refresh');
		}
	}
	function index()
	{
		$data['title'] = "Dashboard";
		$data["view"] = "dashboard";
		$this->load->view('template',$data);
	}
}