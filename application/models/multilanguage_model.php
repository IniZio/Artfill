<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Multilanguage_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->dbforge();
	}
	
	/**
    * 
    * Getting Users details
    * @param String $condition
    */
   public function get_language_list(){
   		$Query = " select * from ".LANGUAGES."  ORDER BY name ASC";
   		return $this->ExecuteQuery($Query);
   }
   /**
    * 
    * Change language status
    * @param String $Mode
    * @param String $condition
    */
    public function change_language_status($statusMode='',$checkbox_id=array()){
	
   		if($statusMode == 'Active' || $statusMode == 'Inactive'){			
			$data = array('status' => $statusMode);
			$this->db->where('lang_code !=', 'en');
			$this->db->where_in('id', $checkbox_id);
			$this->db->update(LANGUAGES, $data); 
			}else if($statusMode == 'Delete') {
				$this->db->where_in('id', $checkbox_id);
				$this->db->where('lang_code !=', 'en');
				$this->db->delete(LANGUAGES); 
			}
			return 1;
		
   }
   /**
    * 
    * To delete LANGUAGES
    * @param Integer $ID
    */
   public function delete_language($languageId = ''){   
    		$this->db->where('id', $languageId);
			$this->db->where('lang_code !=', 'en');
			$this->db->delete(LANGUAGES);  
		return 1;   	
   }   
   /**
    * 
    * To change Language Details
    * @param String $Current status
    * @param Integer $ID
    */
    public function change_language_details($current_status = '',$languageId=''){   
		
		
    	if($current_status ==  'Active')
		{
			$new_status = 'Inactive';
		}
		else if($current_status == 'Inactive')
		{	
			$new_status = 'Active';
		}
		else
		{		 
			$new_status = 'Active';
		}
		$updateData = array('status'=>$new_status);		 
		$this->db->where('lang_code !=', 'en');
		$this->db->where('id', $languageId);
		$this->db->update(LANGUAGES, $updateData); 
		
		return 1;   	
   }
   
   
  
}