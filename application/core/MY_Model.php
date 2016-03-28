<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* MY custom base model class, contains all common db related functions
*/
class MY_Model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function single_insert($table='', $dataArr=''){
		$this->db->insert($table, $dataArr);
	}

	public function check_exist($table='', $condition=''){
	    if ($this->db->where($table,$condition,1)->result()->num_rows() > 0){
	        return true;
	    }
	    else return false;
	}
}