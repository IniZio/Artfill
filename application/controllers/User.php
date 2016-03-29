<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User Controller
*/
class User extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('email'));
	}
	/*
	* Function for basic register information
	*/
	public function insert_user(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if (valid_email($email)){
			$condition = array('email' => $email);
			if ($this->user_model->check_exist(USERS, $condition)) {
				// require: return message 'email already exists'
			} else{
				// require: add user to database
				// require: return message 'successfully registered'
			}
		} else ; // require: return message 'invalid email id'
	}

	public function edit_user($seourl)
	{
	}

	public function send_verify_email()
	{
		
	}

	/*
	* Function for login user, also for api login e.g, google
	*/
	public function login_user()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

	}

	public function logout_user()
	{
		//require: reset everything in session including google, facebook
	}
}