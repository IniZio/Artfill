<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	   /* to get count details 
	   Param 1. Constant Table Name 2. String to select fields 3. Array for condition
	   */
	function getCountDetails($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		
		//$this->db->where(JOB.".dateAdded >= DATE_SUB(NOW(),INTERVAL 30 DAY)", NULL, FALSE);
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	   /* to get Recent details 
	   Param 1.Constant Table Name 2. String to select fields 3. String to make order 4.Int for Limit 5.Array for condition
	   */
	function getRecentDetails($tableName='',$fieldName='',$userOrderBy='',$userLimit='',$whereCondition=array())
	{
		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		$this->db->order_by($fieldName, $userOrderBy);
		$this->db->limit($userLimit);
		$countQuery = $this->db->get();
		return $countQuery->result_array();
	}
	
	  /* to get user count  
	   Param 1.Constant Table Name 2. String to select fields 3. Array for condition
	   */
	function getTodayUsersCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		$this->db->where("created >= DATE_SUB(NOW(),INTERVAL 24 HOUR)", NULL, FALSE);
		//$this->db->like("created",date('Y-m-d', strtotime('-24 hours')));
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	  /* to get user count for month 
	   Param 1.Constant Table Name 2. String to select fields 3. Array for condition
	   */
	function getThisMonthCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		
		$this->db->where("created >= DATE_SUB(NOW(),INTERVAL 30 DAY)", NULL, FALSE);
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
	}
	  /* to get last year user count
	   Param 1.Constant Table Name 2. String to select fields 3. Array for condition
	   */
	function getLastYearCount($tableName='',$fieldName='',$whereCondition=array())
	{
		$this->db->select($fieldName);
		$this->db->from($tableName);
		$this->db->where($whereCondition);
		//date("Y");
		$this->db->like('created', date("Y"));
		$countQuery = $this->db->get();
		return $countQuery->num_rows();
		
	}
	  /* to get order details
	  	   */
	function getDashboardOrderDetails()
	{
		$this->db->select('*,a.id as orderId,a.status as paymentStatus,a.price as paymentPrice');
		$this->db->from(USER_PAYMENT.' as a');
		$this->db->join(PRODUCT.' as b','b.id=a.product_id','inner');
		$this->db->order_by('a.created','desc');
		$this->db->limit(4);
		$orderQueryDashboard = $this->db->get();
		return $orderQueryDashboard->result_array();
		//$this->db->where($whereCondition);
	}
	
	function getMonthlyOrders($year,$month){
		
		$this->db->select('*, SUM(total) as mtot, count(*) as morder, MONTH(modified) as month, YEAR(modified) as year');
		$this->db->from(USER_PAYMENT);
		$this->db->where(array('status'=> 'paid'));
		$this->db->where(array('modified >='=> ''.($year-1).'-'.$month.'-01'));
		$this->db->where(array('modified <='=> ''.$year.'-'.$month.'-31'));
		$this->db->group_by('MONTH(modified)');
		//$this->db->group_by('MONTH(modified)');
		$this->db->order_by('modified');
		return  $this->db->get();
		
	}
	
function getDays($month,$year){

    $num_of_days = array();
    $total_month = 12;
    if($year == date('Y'))
	{
        $total_month = $month;
    } else {   
	 $total_month = $month;
    }
	$num_of_days = cal_days_in_month(CAL_GREGORIAN, $total_month, $year);
  
    return $num_of_days;
}
	
	function getDaysOrders($startDate,$endDate){
	
		
		$this->db->select('*, SUM(total) as mtot, count(*) as morder, MONTH(modified) as month, YEAR(modified) as year');
		$this->db->from(USER_PAYMENT);
		$this->db->where(array('status'=> 'paid'));
		$this->db->where(array('modified >='=> ''.$startDate.''));
		$this->db->where(array('modified <='=> ''.$endDate.''));
		//$this->db->group_by('WEEK(modified)');
		//$this->db->group_by('MONTH(modified)');
		$this->db->order_by('modified');
		return  $this->db->get();
	
	}
	
	
	function getMonthlyDisputes($year,$month){
		
		$this->db->select('*, SUM(total_amount) as distot, count(*) as disorder, MONTH(claimed_time) as dismonth, YEAR(claimed_time) as disyear');
		$this->db->from(ORDER_CLAIM);
		$this->db->where(array('status'=> 'Opened'));
		$this->db->where(array('claimed_time >='=> ''.($year-1).'-'.$month.'-01'));
		$this->db->where(array('claimed_time <='=> ''.$year.'-'.$month.'-31'));
		$this->db->group_by('MONTH(claimed_time)');
		$this->db->order_by('claimed_time');
		return  $this->db->get();
		
	}
	function getMonthDisputes($startDate,$endDate){
		
		$this->db->select('*, SUM(total_amount) as distot, count(*) as disorder, MONTH(claimed_time) as dismonth, YEAR(claimed_time) as disyear');
		$this->db->from(ORDER_CLAIM);
		$this->db->where(array('status'=> 'Opened'));
		$this->db->where(array('claimed_time >='=> ''.$startDate.''));
		$this->db->where(array('claimed_time <='=> ''.$endDate.''));
		//$this->db->group_by('MONTH(claimed_time)');
		$this->db->order_by('claimed_time');
		return  $this->db->get();
		
	}
	
}