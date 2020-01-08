<?php

/**
 * 
 */
class User_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function create($user)
	{
		$this->db->insert('users',$user);
		return $this->db->insert_id();
	}
	public function auth($email, $password)
	{
		$user = $this->db->get_where('users',array('email'=>$email))->row();
		if($user){
			if(password_verify($password, $user->password))
			{
				$userData = array(
					'userId' => $user->userId,
					'username' => $user->username,
					'email' => $user->email,
					'mobileNumber' => $user->mobileNumber,
					'isLoggedIn' => TRUE,
				);

				$this->session->set_userdata( $userData );
				return true;
			}
			return false;
		}
		return false;
	}
}