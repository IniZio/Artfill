<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
 
 class Claim_model extends My_Model
 {
	 public function __construct() {
		 parent::__construct();
	 }
	 	/**
	* function to view claim details 
	* Param String/Array  Conditions
	*/
	 public function view_claim_details($condition) {	
		//$select_qry="select oc.*,cl.seller_id,cl.buyer_id,cl.dealcodenumber,cl.total_amount,cl.status as claim_status,cl.id as claimid,u.id as user_id,u.full_name as buyer_name,u.user_name as buyername,u.email,us.full_name as seller_name,us.user_name as sellername from ".ORDER_COMMENTS." oc LEFT JOIN ".ORDER_CLAIM." cl on cl.dealcodenumber=oc.orderid LEFT JOIN ".USERS." u on cl.buyer_id=u.id LEFT JOIN ".USERS." us on cl.seller_id=us.id".$condition;
		
		$select_qry="select oc.*, MIN(oc.id) ,cl.seller_id,cl.buyer_id,cl.dealcodenumber,cl.total_amount,cl.status as claim_status,cl.id as claimid,u.id as user_id,u.full_name as 
buyer_name,u.user_name as buyername,u.email,us.full_name as seller_name,us.user_name as sellername from ".ORDER_COMMENTS." oc LEFT JOIN ".ORDER_CLAIM." cl
on cl.dealcodenumber=oc.orderid LEFT JOIN ".USERS." u on cl.buyer_id=u.id LEFT JOIN ".USERS." us on cl.seller_id=us.id".$condition;
		
		$claimList = $this->ExecuteQuery($select_qry);

		//echo $this->db->last_query(); die;
		return $claimList;
	 }
	 	/**
	* function to display claim details 
	* Param string/array Conditions
	*/
	public function display_claim_details($condition) {
		$this->db->select('p.*,pd.product_name,pd.seourl as prdurl,pd.image,pd.id as PrdID,u.full_name');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u', 'p.user_id = u.id');
		$this->db->join(PRODUCT. ' as pd', 'pd.id = p.product_id');
		//$this->db->where('p.dealCodeNumber="'.$condition.'"');
		$this->db->where('p.dealCodeNumber',$condition);
		$claimDetails=$this->db->get();
		#echo $this->db->last_query(); die;
		return $claimDetails;
	}	 
}