<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to commission management
 * @author Teamtweaks
 *
 */
class Commission_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
		/**
	* function to get Total order amount
	* Param Int sellerId
	*/
	public function get_total_order_amount($sid='0'){
		/* $Query = "select sum(pr.sumTotal) as TotalAmt, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal ,u.full_name from shopsy_users u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' group by p.dealCodeNumber
		) pr"; */
			
		$Query = "select sum(pr.sumTotal) as TotalAmt, sum(pr.claimTotal) as ClaimAmt, count(pr.sumTotal) as orders from (select p.dealCodeNumber, sum(p.sumtotal) as sumTotal , sum(p.claim_amount) as claimTotal ,u.full_name from shopsy_users u JOIN ".USER_PAYMENT." p on p.sell_id=u.id where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' and p.payment_type!='COD' group by p.dealCodeNumber) pr";
		return $this->ExecuteQuery($Query);
	}
	public function get_total_order_amounts($sid='0'){
		/* $Query = "select sum(pr.sumTotal) as TotalAmt, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal ,u.full_name from shopsy_users u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' group by p.dealCodeNumber
		) pr"; */
			
		$Query = "select sum(pr.sumTotal) as TotalAmt, sum(pr.claimTotal) as ClaimAmt, count(pr.sumTotal) as orders from (select p.dealCodeNumber, sum(p.admin_commission) as sumTotal , sum(p.claim_amount) as claimTotal ,u.full_name from shopsy_users u JOIN ".USER_PAYMENT." p on p.sell_id=u.id where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' and p.payment_type!='COD' group by p.dealCodeNumber) pr";
		return $this->ExecuteQuery($Query);
	}
	public function get_dispute_order_amount($sid='0'){		
			$query="select sum(d.total) as TotalAmt from (select sum(p.admin_commission) as total from ".USER_PAYMENT." p JOIN ".ORDER_CLAIM." oc on p.dealCodeNumber=oc.dealCodeNumber
			where oc.seller_id='".$sid."'and p.status='Paid' and oc.status='Opened' and p.payment_type!='COD'  group by p.dealCodeNumber)d";
		return $this->ExecuteQuery($query);
	}
	/**
	* function to get Total order amount for adaptive
	* Param Int sellerId
	*/
	public function get_total_order_amount_adaptive($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt, sum(pr.claimTotal) as ClaimAmt, count(pr.sumTotal) as orders from (select p.dealCodeNumber, p.sumtotal as sumTotal , sum(p.claim_amount) as claimTotal ,u.full_name from shopsy_users u JOIN ".USER_PAYMENT." p on p.sell_id=u.id where u.id='".$sid."' and p.status='Paid' and p.payment_type='Paypal Adaptive' group by p.dealCodeNumber) pr";
		//echo $this->db->last_query();
		
		return $this->ExecuteQuery($Query);
	}
	/**
	* function to get Total order amount for code
	* Param Int sellerId
	*/
	public function get_total_cod_amount($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt, sum(pr.claimTotal) as ClaimAmt, count(pr.sumTotal) as orders from (select p.dealCodeNumber, sum(p.sumtotal) as sumTotal , sum(p.claim_amount) as claimTotal ,u.full_name from shopsy_users u JOIN ".USER_PAYMENT." p on p.sell_id=u.id where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' and p.payment_type='COD' group by p.dealCodeNumber) pr";
		return $this->ExecuteQuery($Query);
	}
	/**
	* function to get Total paid amount
	* Param Int sellerId
	*/
	public function get_total_paid_details($sid='0'){
		$Query = "select sum(amount) as totalPaid from ".VENDOR_PAYMENT." where `status`='success' and `vendor_id`='".$sid."' group by `vendor_id`";
		return $this->ExecuteQuery($Query);
	}
	/**
	* function to get Total cod paid details
	* Param Int sellerId
	*/
	public function get_cod_paid_details($sid='0'){
		$Query = "select sum(amount) as codPaid from ".COD_PAYMENT." where `seller_id`='".$sid."' ";
		return $this->ExecuteQuery($Query);
	}
	/**
	* function to get seller paypal email 
	* Param Int sellerId
	*/
	public function get_seller_paypal_email($sid='0'){
		$Query = "select PayPal_email as payemail from ".SELLER." where `seller_id`='".$sid."'";
		return $this->ExecuteQuery($Query);
	}
	/**
	* function to get Total order amount by csv
	* Param Int sellerId
	*/
	public function get_total_order_amount_csv($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt, sum(pr.claimTotal) as ClaimAmt, count(pr.sumTotal) as orders from (select p.dealCodeNumber, sum(p.sumtotal) as sumTotal , sum(p.claim_amount) as claimTotal ,u.full_name from shopsy_users u JOIN ".USER_PAYMENT." p on p.sell_id=u.id where u.id='".$sid."' and u.claim_status='Yes' and p.status='Paid' and p.shipping_status='Delivered' group by p.dealCodeNumber) pr";		
		return $this->ExecuteQuery($Query);
	}
}