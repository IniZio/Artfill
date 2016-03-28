<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* This model contains all db functions related to user management
*/
class User_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/*
	*	only insert user
	*	@param String $firstname, $lastname, $username, $email, $password, $roles
	*/
	public function insert_user($firstname='', $lastname='', $username=''. $email='', $password='', $roles=array('user')){
		if ($username='') {
			$username = substr($email, 0,strpos($email, '@'));
			while ($this->user_model->check_exist(USER, array('username' => $username))){
				$username= substr($email, 0,strpos($email, '@')).rand(1111, 9999999);
			}
		}
		$dataArr = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'username' => $username,
			'email' => $email,
			'password' => md5($password),
		);
		$this->db->insert(USER, $dataArr);
	}
}