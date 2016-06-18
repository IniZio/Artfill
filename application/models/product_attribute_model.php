<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to attribute management
 * @author Teamtweaks
 *
 */
class Product_attribute_model extends My_Model
{
	/*** To add attribute***/
	public function add_attribute($dataArr=''){
			$this->db->insert(PRODUCT_ATTRIBUTE,$dataArr);
	}

	/*** To edit attribute***/
	public function edit_attribute($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(PRODUCT_ATTRIBUTE,$dataArr);
	}
	
	/*** To view attribute***/
	public function view_attribute($condition=''){
			return $this->db->get_where(PRODUCT_ATTRIBUTE,$condition);
			
	}
	
	/*** To view attribute details***/
	public function view_attribute_details(){
	
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE."";
		$attributeList = $this->ExecuteQuery($select_qry);
		return $attributeList;
			
	}
	
}

?>