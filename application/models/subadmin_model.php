<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to sub-admin management
 * @author Teamtweaks
 *
 */
class Subadmin_model extends My_Model
{
	// To add/edit sub admin
	// Param 	1. Array $dataArr
	//				2. String $condition
	public function add_edit_subadmin($dataArr='',$condition=''){
		if ($condition['id'] != ''){
			$this->db->where($condition);
			$this->db->update(SUBADMIN,$dataArr);
		}else {
			$this->db->insert(SUBADMIN,$dataArr);
		}
	}
}