<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliders_model extends My_Model
{

   public function get_slider_details($condition=''){
   		$Query = " select * from ".HOME_SLIDERS." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   public function get_ipwhite_list($condition=''){
   		$Query = " select * from ".IPWHITELIST." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
 
	public function edit_slider($dataArr='',$condition=''){
		$this->db->where($condition);
		$this->db->update(HOME_SLIDERS,$dataArr);
	}
	public function add_edit_slider($dataArr='',$condition=''){
         // echo '<pre>';print_r($condition);die;
         // echo '<pre>';print_r($dataArr);die;

		if ($condition['id'] != ''){
		
		    $this->db->where($condition);
			
			$this->db->update(HOME_SLIDERS,$dataArr);
			
		}else {
			$this->db->insert(HOME_SLIDERS,$dataArr);
		}
	}
	public function add_ipaddress($dataArr=''){
			//$this->db->insert(CATEGORY,$dataArr);
			$this->db->insert(IPWHITELIST,$dataArr);
	}
	
}