<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Zendesk_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_sorted_array_object_values($ar1=array(),$field='id',$type='asc'){
   		$products_list_arr = array(); 
		if (count($ar1)>0){
			foreach ($ar1 as $ar1_row){ 
				#$products_list_arr['product'][] = $ar1_row;
    			#$products_list_arr[$field][] = $ar1_row[$field];
			}
			for($i=0; $i < count($ar1); $i++){ 
				$products_list_arr['product'][] = $ar1[$i];
    			$products_list_arr[$field][] = $ar1[$i]->$field;
			}
		}

		
		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}
		
		array_multisort($products_list_arr[$field],$sort,$products_list_arr['product']);
		
		return $products_list_arr['product'];
   }
   
	public function get_all_zendesk_users(){
		$this->db->select('id,seller_id,zendesk_id');
		$this->db->from(SELLER);
		$this->db->where('zendesk_id !=','');
		return $this->db->get();
    }
	
}