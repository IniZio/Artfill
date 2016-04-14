<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Currency_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function UpdateActiveStatus($table='',$data=''){
		$query =  $this->db->get_where($table,$data);
		return $result = $query->result_array();
	}
	
	   /* to get all currency*/

	function get_currency_db($id)
	{
	$this->db->select('*');
	$this->db->from(CURRENCY);
	$this->db->where('id',$id);
	//$this->db->where('status','Active');
	$done=$this->db->get()->row_array();
	return $done;
	
		
	}
	
	   /* to get Currency  details */
	function get_currency_details($id)
	{
	$this->db->select('*');
	$this->db->from(CURRENCY);
	$this->db->where('currency_code',$id);
	//$this->db->where('status','Active');
	$done=$this->db->get()->row_array();
	return $done;
	
	}
	
	

	/***************************change currency default value as 0***********************************/

	function make_me_zero()
	{
	$this->db->update(CURRENCY,array('default_currency'=>'0'));	
	
	}



}