<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Landing page functions
 * @author Teamtweaks
 *
 */
class Landing_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting List of item to suggest 
    * @param String $search_key
    */
	public function listitemsuggest($search_key){
		$this->db->select(PRODUCT.'.*');
		$this->db->from(PRODUCT);
		$this->db->where(PRODUCT.'.status','Publish');
		$this->db->like(PRODUCT.'.product_name',$search_key); 
		$this->db->limit(9,0);
		$result= $this->db->get();
		#echo $this->db->last_query(); die;product_name<a href="search/all?item='.$search_key.'"><span class="suggest">'.$list["product_name"].'</span></a> 
		return $result;
	}
}