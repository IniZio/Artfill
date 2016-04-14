<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to admin export management
 * @author Teamtweaks
 *
 */
class Adminexport_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	/*
	* To get result from table
	* Param Constant Table name
	* Param Array Condition
	* Param Array Fields to select
	*/
	public function getResult($table="",$condition=array(),$fields=array())
	{  $select=implode(",",$fields); 
	    if(count($fields)>0)
		{
	     $this->db->select($select); 
		}
		if(count($condition)>0)
	    $this->db->where($condition);
	    
	    $result = $this->db->get($table);
	    return $result->result_array();
	}
}