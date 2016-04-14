<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to cms management
 * @author Teamtweaks
 *
 */
class Cms_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
		/**
	* function to get details 
	* Param Constant Table Name
	* Param string/array Condition
	* Param String/Array to sort
	*/
	function get_all_details($table='',$condition='',$sortArr=''){
		if ($sortArr != '' && is_array($sortArr)){
			foreach ($sortArr as $sortRow){
				if (is_array($sortRow)){
					$this->db->order_by($sortRow['field'],$sortRow['type']);
				}
			}
		}
		return $this->db->get_where($table,$condition);
	}
		/**
	* function to get help page details 
	* Param string Conditions
	*/
	public function get_help_page_details($condition) {
		$select_qry = "select * from ".CMS."".$condition;
		$pageList = $this->ExecuteQuery($select_qry);
		return $pageList;
	}	
		/**
	* function to get help topic details 
	* Param string Conditions
	*/
	public function get_help_topis($condition) {
		$select_qry = "select * from ".CMS_HELP."".$condition;
		$helpTopic = $this->ExecuteQuery($select_qry);
		return $helpTopic;
	}
		/**
	* function to display help page details 
	* Param string Conditions
	*/
	public function display_help_details($condition='',$limitPage='',$order_by='') {
		$select_qry = "select * from ".CMS." where ".$condition." and help_id!=0 LIMIT ".$limitPage;
		return $searchHelpList = $this->ExecuteQuery($select_qry);
	}
		/**
	* function to get help details count  
	* Param string Conditions
	*/
	public function display_help_detailsCount($condition=''){		
		$select_qry = "select * from ".CMS." where ".$condition." and status='Publish' and help_id!=0";
		return $searchHelpList = $this->ExecuteQuery($select_qry);	
	}
}