<?php

/**
 * 
 */
class Logout extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		session_destroy();
		redirect('user/login','refresh');
	}
}