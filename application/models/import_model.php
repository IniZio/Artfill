<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to import products
 * @author Casperon
 *
 */
class Import_model extends My_Model{
	public function __construct() {
		parent::__construct();
	}
	public function get_column_details($table='',$condition='',$columnlist=''){
		$this->db->select($columnlist);
		$this->db->from($table);
		$this->db->where($condition);
		return $this->db->get();
	}
	/**
	* 
	* Check the product duplicate id
	* param Int $pid
	* 
	**/
	public function check_product_id($pid=''){	
		$this->db->select('id');
		$this->db->from(PRODUCT);
		$this->db->where('seller_product_id',$pid);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* get the category information
	* param array $condition
	* 
	**/
	public function get_category_details($condition=array()){	
		$this->db->select('id,cat_name');
		$this->db->from(CATEGORY);
		$this->db->where($condition);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* Check the product seo url
	* param string $seourl
	* 
	**/
	public function chk_product_seo($seourl=''){	
		$this->db->select('id');
		$this->db->from(PRODUCT);
		$this->db->where('seourl',$seourl);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* get the country information
	* param array $condition
	* 
	**/
	public function get_country_info($condition=array()){	
		$this->db->select('id,name');
		$this->db->from(COUNTRY_LIST);
		$this->db->where($condition);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* Check the Shipping Country seo url
	* param string $seourl
	* 
	**/
	public function chk_shipping_seo($seourl=''){	
		$this->db->select('sid');
		$this->db->from(SUB_SHIPPING);
		$this->db->where('ship_seourl',$seourl);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* check product variation in database
	* param array $condition
	* 
	**/
	public function chk_product_attribute($condition=array()){	
		$this->db->select('id,scaling_option');
		$this->db->from(PRODUCT_ATTRIBUTE);
		$this->db->where($condition);
		$result_query = $this->db->get();
		return $result_query;	
	}
	/**
	* 
	* check membership of the seller
	* param int $seller_id
	* 
	**/
	public function check_seller_membership($seller_id){	
		$this->db->select('id,membership_status');
		$this->db->from(SELLER);
		$this->db->where('seller_id',$seller_id);
		$result_query = $this->db->get();
		return $result_query;	
	}
	
}