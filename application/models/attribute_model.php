<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to attribute management
 * @author Teamtweaks
 *
 */
class Attribute_model extends My_Model
{
	/**
	* function to add attribute
	* Param Array new data to add
	*/
	public function add_attribute($dataArr=''){
			$this->db->insert(ATTRIBUTE,$dataArr);
	}
	/**
	* function to edit attribute
	* Param Array new data to add
	* Param String condition 
	*/
	public function edit_attribute($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(ATTRIBUTE,$dataArr);
	}
	/**
	* function to view attribute
	* Param String condition 
	*/
	
	public function view_attribute($condition=''){
			return $this->db->get_where(ATTRIBUTE,$condition);
			
	}
	/**
	* function to view attribute
	*/	
	public function view_attribute_details(){
		$select_qry = "select * from ".ATTRIBUTE."";
		$attributeList = $this->ExecuteQuery($select_qry);
		return $attributeList;
			
	}
	/**
	* function to list attribute value
	* Param string list Id
	*/
	public function get_list_values($lid='all'){
		if ($lid == 'all'){
			$where = '';
		}else {
			$where = 'and lv.list_id = '.$lid;
		}
		$Query = 'select lv.*,l.attribute_name from '.LIST_VALUES.' lv
					JOIN '.ATTRIBUTE.' l on l.id=lv.list_id where l.status = "Active" '.$where;
		return $this->ExecuteQuery($Query);
	}
	
}

?>