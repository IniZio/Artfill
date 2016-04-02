<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* This model contains all db functions related to user management
*/
class User_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
	*	only insert user
	*	@param String $firstname, $lastname, $username, $email, $password, $roles
	*/
	public function insert_user(username='', $email='', $password='',$verify_code='', $roles='U'){
		if ($username='') {
			$username = substr($email, 0,strpos($email, '@'));
			while ($this->user_model->check_exist(USER, array('username' => $username))){
				$username= substr($email, 0,strpos($email, '@')).rand(1111, 9999999);
			}
		}
		$dataInit = array(
		      'status' => 'active',
		);
		array_push($dataArr, $dataInit, array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'username' => $username,
			'email' => $email,
			'password' => md5($password),
			'verify_code' => $verify_code,
		));
		$this->db->insert(USER, $dataArr);
	}
}