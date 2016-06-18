<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('dashboard_model');
		$this->load->model('order_model');
		$this->load->model('giftcards_model');
    }
    /**
	 * 
	 * This function loads the admin Dashboard 
	 */
   	public function index(){	
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/dashboard/admin_dashboard');
		}
	}
	 /**
	 * 
	 * This function loads the admin Dashboard 
	 */
	public function admin_dashboard()
	{	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		
		
			/* get dashboard values start*/
			$recentUserWhereCondition = array('status'=>'Active','group'=>'User');
			/* Get user count start*/
			$userTableName = USERS;
			$userFieldName = 'id';
			
			$getTotalUsersCount = $this->dashboard_model->getCountDetails($userTableName,$userFieldName,$recentUserWhereCondition);
			/* Get user count end*/
			
			/* last 24 hours record start */
			$userWhereCondition = array('status'=>'Active');
			$userWhereCondition1 = array('status'=>'Active');
			$getTodayUsersCount = $this->dashboard_model->getTodayUsersCount($userTableName,$userFieldName,$userWhereCondition1);
			//echo $this->db->last_query();die;
			
			/* last 24 hours record start */
			
			/* last 30 days record start */
			$userWhereCondition1 = array('status'=>'Active');
			$getThisMonthCount = $this->dashboard_model->getThisMonthCount($userTableName,$userFieldName,$userWhereCondition1);
			//echo $getThisMonthCount;die;
			/* last 30 days  record start */
			
			
			/* last year record start */
			$userWhereCondition1 = array('status'=>'Active');
			$getLastYearCount = $this->dashboard_model->getLastYearCount($userTableName,$userFieldName,$userWhereCondition1);
			  
			//echo $this->db->last_query();die;
			//echo $getLastYearCount;die;
			//echo $getThisMonthCount;die;
			/* last last year  record start */
			
			/* get recent users list start*/
			$recentUserWhereCondition = array('status'=>'Active','group'=>'User');
			$userOrderBy = 'desc';
			$userLimit = "3";
			$getRecentUsersList = $this->dashboard_model->getRecentDetails($userTableName,$userFieldName,$userOrderBy,$userLimit,$recentUserWhereCondition);
			//echo "<pre>";print_r($getRecentUsersList);die;
			
			
			/* get recent users list end*/
			
			/* get recent sellers list start*/
			$sellerWhereCondition = array('status'=>'Active','group'=>'Seller');
			$userOrderBy = 'desc';
			$userLimit = "3";
			$getRecentSellerList = $this->dashboard_model->getRecentDetails($userTableName,$userFieldName,$userOrderBy,$userLimit,$sellerWhereCondition);
			//echo "<pre>";print_r($getRecentUsersList);die;
			
			
			/* get recent Shops list start*/
			$shopTableName = SELLER;
			$shopWhereCondition = array('status'=>'active');
			$getRecentShopList = $this->dashboard_model->getRecentDetails($shopTableName,$userFieldName,$userOrderBy,$userLimit,$shopWhereCondition);
			
			/* shop today */
			$shopFieldName = 'id';
			$TodayshopCount = $this->dashboard_model->getTodayUsersCount($shopTableName,$shopFieldName,$shopWhereCondition);
			
			$getThisMonthShopCount = $this->dashboard_model->getThisMonthCount($shopTableName,$shopFieldName,$shopWhereCondition);
			
			$getLastYearShopCount = $this->dashboard_model->getLastYearCount($shopTableName,$shopFieldName,$shopWhereCondition);
			//echo $this->db->last_query();die;
					
			
			//echo "<pre>";print_r($getRecentUsersList);die;
			
			/* get recent sellers list end*/
			
			/* get total product count start*/
			$productTableName = PRODUCT;
			$productFieldName = 'id';
			$productWhereCondition = array();
			$getTotalProductCount = $this->dashboard_model->getCountDetails($productTableName,$productFieldName,$productWhereCondition);
			//echo $getTotalProductCount;die;
			/* get total product count end*/
			
			/* get total seller count start */
			$sellerWhereCondition = array('group'=>'Seller');
			$getTotalSellerCount = $this->dashboard_model->getCountDetails($userTableName,$userFieldName,$sellerWhereCondition);
			/* get total seller count end*/
			
			/* get total Shops count start */
			
			$shopFieldName = 'id';
			$shopWhereCondition = array('status'=>'active');
			$getTotalShopCount = $this->dashboard_model->getCountDetails($shopTableName,$shopFieldName,$shopWhereCondition);
			$shopWhereCondition1 = array('status'=>'waiting');
			$getTotalShopWaiting = $this->dashboard_model->getCountDetails($shopTableName,$shopFieldName,$shopWhereCondition1);
			/* get total Shops count end*/
			
			/* get total Orders count start */
			$orderTableName = USER_PAYMENT;
			$orderFieldName = 'id';
			$orderWhereCondition = array('status'=>'paid');
			$getTotalorderCount = $this->dashboard_model->getCountDetails($orderTableName,$orderFieldName,$orderWhereCondition);
			

			$this->data['monthly_orders'] = $this->dashboard_model->getMonthlyOrders(date(Y),date(m))->result_array();
			
				$month=date('m');
				$year=date('Y');
				$this->data['month']=$month;
				$this->data['year']=$year;
				$days=$this->dashboard_model->getDays($month,$year);
				
				$days_count_loop = ceil($days/5); 
				
				$this->data['loop_count']=$days_count_loop;
				$this->data['days']=$days;
				$startDate='01-'.$month.'-'.$year.'00:00:00';
				$startDate = date("Y-m-d H:i:s",strtotime($startDate));
				$endDate=$days.'-'.$month.'-'.$year;
				
				$endDate=date("Y-m-d H:i:s",strtotime("tomorrow -1 second ",strtotime($endDate)));
				$start_date=01;
					$end_date= $start_date+04;
					for($i=0;$i<=$days_count_loop;$i++)
					{
						if($i>=1)
						{
							$temp=$end_date+01;
							$start_date= $temp;
							$end_date= $start_date+04;
							if($start_date==29 || $start_date==31)
							{
								$end_date=$days;
							}
						$from_date_time = $year.'-'.$month.'-'.$start_date;
						$from_date = date('Y-m-d H:i:s', strtotime($from_date_time)); 
						$to_date_time= $year.'-'.$month.'-'.$end_date;
						$to_date = date('Y-m-d H:i:s', strtotime("tomorrow - 1 second", strtotime($to_date_time)));  
					
			}
					$this->data['days_orders'][$i] = $this->dashboard_model->getDaysOrders($from_date,$to_date)->result_array();
					$this->data['month_disputes'][$i] = $this->dashboard_model->getMonthDisputes($from_date,$to_date)->result_array();
			}
			
		
			
			$this->data['monthly_disputes'] = $this->dashboard_model->getMonthlyDisputes(date(Y),date(m))->result_array();
			//$this->data['month_disputes'] = $this->dashboard_model->getMonthDisputes($startDate,$endDate)->result_array();
			
			//echo "<pre>"; echo $this->db->last_query();  die;
			//echo "<pre>"; print_r($monthly_dispute); die;
			
			/* get total Orders count end*/
			
			/* get total Dispute Orders count start */
			$orderdispTableName = ORDER_CLAIM;
			$orderdispFieldName = 'id';
			$orderdispWhereCondition = array('status'=>'Opened');
			$getTotalorderdispCount = $this->dashboard_model->getCountDetails($orderdispTableName,$orderdispFieldName,$orderdispWhereCondition);
			
			
			/* get total Dispute Orders count end*/
			
			
// 			$conditioncancel =array('shipping_status'=>'Processed');
// 			$conditioncancel['received_status'] = 'Requested Cancel';
			
// 			$this->data['orderList'] = $this->order_model->view_order_details('Paid',$conditioncancel);
			
			
			$conditioncancel = array();
				
			$condit = "(`shipping_status` = 'Processed' OR `shipping_status` = 'Approved for Refund')";
				
			$conditioncancel['received_status'] = 'Requested Cancel';
				
			$this->data['orderList'] = $this->order_model->view_order_details('Paid',$conditioncancel,$condit);
			
			
			//print_r($this->data['orderList']); die;
			
			$getTotalordercancelCount  = $this->data['orderList']->num_rows();
			
			/* get total Categories count start */
			$categoryTableName = CATEGORY;
			$categoryFieldName = 'id';
			$categoryWhereCondition = array('status'=>'Active');
			$getTotalcategoryCount = $this->dashboard_model->getCountDetails($categoryTableName,$categoryFieldName,$categoryWhereCondition);
			/* get total Categories count end*/
			
			/* get total giftcard count start */
			
			$giftCardTableName = GIFTCARDS;
			$giftCardFieldName = 'id';
			$giftCardWhereCondition = array();			
			
			$getTotalGiftCardCount = $this->dashboard_model->getCountDetails($giftCardTableName,$giftCardFieldName,$giftCardWhereCondition);
			/* get total giftcard count end*/
			
			
			/* get total Subscriber count start */
			
			$subscriberTableName = FANCYYBOX_USES;
			$subscriberFieldName = 'id';
			$subscriberWhereCondition = array();			
			
			$getTotalSubscriberCount = $this->dashboard_model->getCountDetails($subscriberTableName,$subscriberFieldName,$subscriberWhereCondition);
			/* get total Subscriber count end*/
			
			/* get gift card values start */
			
			//$this->data['heading'] = 'Gift Cards Dashboard';
			$condition = 'order by `created` desc';
			$this->data['giftCardsList'] = $this->giftcards_model->get_giftcard_details($condition);
			//$this->load->view('admin/giftcards/display_giftcards_dashboard',$this->data);
		/* get gift card values end */
			/////// Paid, Pending & Dispute Orders////////
			$totorderTableName = USER_PAYMENT;
			$totorderFieldName = 'id';
			$totorderWhereCondition = array();
			$getTotorderCount = $this->dashboard_model->getCountDetails($totorderTableName,$totorderFieldName,$totorderWhereCondition);
		
			$PaidorderWhereCondition = array('status'=>'paid','claim_amount'=>'');
			$getPaidorderCount = $this->dashboard_model->getCountDetails($totorderTableName,$totorderFieldName,$PaidorderWhereCondition);
			
			$PendorderWhereCondition = array('status'=>'Pending','claim_amount'=>'');
			$getPendorderCount = $this->dashboard_model->getCountDetails($totorderTableName,$totorderFieldName,$PendorderWhereCondition);
			
			$OrderData = array('getTotorderCount'=>$getTotorderCount,'getPaidorderCount'=>$getPaidorderCount,'getPendorderCount'=>$getPendorderCount,'getRecentShopList'=>$getRecentShopList);
			
			$this->data = array_merge($OrderData,$this->data);
			/////////End///////////////
			/* get dashboard values end*/
			
			
			/* get recent orders details start*/
			
			$getOrderDetails = $this->dashboard_model->getDashboardOrderDetails();
			
			//echo "<pre>";print_r($getOrderDetails);die;
			/* get recent orders details end*/
			
			/*Assign dashboard values to view start */
			//echo $getTotalUsersCount;
			//echo "<pre>";print_r($this->data);die;
			$data = array(
					'totalUserCounts'=>$getTotalUsersCount,
					'todayUserCounts'=>$getTodayUsersCount,
					'getRecentUsersList'=>$getRecentUsersList,
					'getThisMonthCount'=>$getThisMonthCount,
					'getLastYearCount'=>$getLastYearCount,
					'getTotalProductCount'=>$getTotalProductCount,
					'getTotalSellerCount'=>$getTotalSellerCount,
					'getTotalShopCount'=>$getTotalShopCount,
					'getTotalShopWaiting'=>$getTotalShopWaiting,
					'getTotalGiftCardCount'=>$getTotalGiftCardCount,
					'getTotalSubscriberCount'=>$getTotalSubscriberCount,
					'heading'=>'Dashboard',
					'getOrderDetails'=>$getOrderDetails,
					'getRecentSellerList'=>$getRecentSellerList,
					'getTotalorderCount'=>$getTotalorderCount,
					'getTotalcategoryCount'=>$getTotalcategoryCount,
					'getTotalorderdispCount'=>$getTotalorderdispCount,
					'getTotalordercancelCount'=>$getTotalordercancelCount,
					'TodayshopCount'=>$TodayshopCount,
					'getThisMonthShopCount'=>$getThisMonthShopCount,
					'getLastYearShopCount' =>$getLastYearShopCount
					
			);
			$this->data = array_merge($data,$this->data);
			$heading = array('heading'=>'Dashboard');
			$this->data = array_merge($this->data,$heading);
			
			
			
			$this->load->view('admin/adminsettings/dashboard',$this->data);
			/*Assign dashboard values to view end */
		}
	}
}