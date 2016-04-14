<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* This model contains all db functions related to user management
*/
class User_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Insert user
	* @param string $username
	* @param string $email
	* @param string $password
	* @param string $verify_code Verify account
	* @param string $roles Roles of the user
	* @return void
	*/
	public function insert_user($username='', $email='', $password='',$verify_code='', $roles='U'){
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

	/**
	* Get user roles and permissions
	* @param string $user_id
	* @param string $role role to be verified
	* @return bool if the user has given role
	*/
	public function check_userrole($user_id='', $role='')
	{
		if ($this->db->check_exist(USER, array('id'=>$user_id))) {
			$this->db->select('role');
			$condition = array('id' => $user_id);
			return (!(strpos($this->db->get_where(USER, $condition)->row()['role'], $role)===FALSE));
		}
	}

	/**
	* Insert user role
	* @param string $user_id
	* @param string $new_role user role to be inserted
	* @return void
	*/
	public function add_userrole($user_id='', $new_role='')
	{
		if ($this->db->check_exist(USER, array('id'=>$user_id))) {
			// if the role doesnt exist for the selected user
			if (check_userrole($user_id, $new_role)===FALSE){
				$this->db->where('id', $user_id);
				$dataArr=array('role'=>$curr_role.$new_role);
				$this->db->update(USER, $dataArr);
			}
		}
	}
}