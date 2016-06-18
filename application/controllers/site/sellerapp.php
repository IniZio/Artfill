<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Sellerapp extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('mobile_model');
		
		/* $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'shopsymobileapp') === false) {
			show_404();
		} */
		
		$commonId=intval($_GET['commonId']);
		$cartCount=0;
		if($commonId>0){
			$cartCount=$this->mobile_model->mini_cart_view($commonId);
		}		
		$this->data["cartCount"]=$cartCount;
		$this->data["commonId"]=$commonId;
		$temp_id = substr(number_format(time() * rand(),0,'',''),0,8);
		
		/*Currency Settings*/
		if($commonId>0){
			$checkUserPreference=$this->mobile_model->get_all_details(USER,array('id' => $commonId));
			if($checkUserPreference->num_rows()>=1){
				$condition = array('currency_code'=> $checkUserPreference->row()->currency);
			}else{
				$condition = array('currency_code'=>'HKD');
			}
		} else {
			$condition = array('currency_code'=>'HKD');	
		}  		
		$CurrencyVal=$this->product_model->get_all_details(CURRENCY,$condition);
		$this->data["currencySymbol"]=$CurrencyVal->row()->currency_symbol;
		$this->data["currencyCode"]=$CurrencyVal->row()->currency_code;
		$this->data["currencyValue"]=$CurrencyVal->row()->currency_value;		
		#echo $this->data["currencySymbol"].'|'.$this->data["currencyCode"].'|'.$this->data["currencyValue"];
		
    }
    
  
	/** 
	 * 
	 * Loading Index Page
	 */
	
	public function index(){
		echo 'Seller App';
	} 
	
	/** 
	 * 
	 * Seller Login
	 */
	public function seller_login(){
		$u_name =$_POST['u_name'];
		$u_psd = $_POST['u_psd'];
		if($u_name!="" && $u_psd!=""){
			$sellerDetails=$this->mobile_model->sellerAuthentication($u_name,md5($u_psd));
			if($sellerDetails->num_rows()==1){
					if($sellerDetails->row()->sellerImage!=""){
						$sellerImage='images/users/thumb/'.$sellerDetails->row()->sellerImage;
					}else{
						$sellerImage='images/users/thumb/profile_pic.png';
					}
					$UDID='';					
					if($_POST['uu_id']!=""){
						$device_type='android';
						$UDID = $_POST['uu_id'];
					}else if($_POST['deviceToken']!=""){
						$device_type='ios';
						$UDID = $_POST['deviceToken'];
						$deviceID = $_POST['deviceID'];
					}
					if($UDID!=""){
						$this->mobile_model->insertupdatePushKey($sellerDetails->row()->sellerId,$UDID,'seller',$device_type);
					}
					$json_encode = json_encode(array("status" =>'Success','sellerId'=>$sellerDetails->row()->sellerId,'shopUrl'=>$sellerDetails->row()->shopUrl,'sellerImage'=>$sellerImage,'sellerName'=>$sellerDetails->row()->sellerName,'starRating'=>(string)$sellerDetails->row()->starRating));
			}else{
					$json_encode = json_encode(array("status" =>'Failure'));
			}
		}else{
			$json_encode = json_encode(array("status" =>'Failure'));
		}
		echo $this->cleanString($json_encode);
	}	
	
	/** 
	 * 
	 * Seller Forgot Password
	*/
	public function forgot_password_seller(){
		$email = $_POST['email'];
		if ($email!=""){
			$condition = array('email'=>$email);
			$checkUser = $this->mobile_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == '1'){
				$pwd = $this->get_rand_str('6');
				$newdata = array('password' => md5($pwd));
				$condition = array('email' => $email);
				if($checkUser->row()->id==1){
					$message='Hi,'.$checkUser->row()->user_name.' You could not retrieve your password from here.';
				}
				$this->mobile_model->update_details(USERS,$newdata,$condition);
				$this->send_user_password($pwd,$checkUser);
				$message='New password sent to your mail';
				#Blog password reset
				$this->load->library('curl');
				$url = base_url().'wp_change_user_role.php'; 
				$post_data = array ( 
					"un" => $checkUser->row()->user_name, 
					"pwd" => $pwd
				);
				$output = $this->curl->simple_get($url, $post_data);
			}else {
				$message='Your email id not matched in our records';
			}
		}else {
			$message='Email id not valid';
		}
		$json_encode = json_encode(array("status" =>$message));
		echo $this->cleanString($json_encode);
	}
		
	/** 
	 * 
	 * Sending Password
	 */
	 public function send_user_password($pwd='',$query){
		$newsid='5';
		$message="";
		$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
  		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/>
			<title>'.$template_values['news_subject'].'</title>
			<body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
			

		if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->config->item('site_contact_mail');
			
			$sender_name=$this->config->item('email_title');
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		}
		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$query->row()->email,
							'subject_message'=>'Password Reset',
							'body_messages'=>$message
							);
		$email_send_to_common = $this->product_model->common_email_send($email_values);
	}
	
		
	/** 
	 * 
	 * Loading Category Json Page
	 */
	
	public function category(){
		$catId=intval($_GET['catId']);
		
		$this->db->select('id,cat_name');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		if($catId>0){
		$this->db->where('rootID',$catId);
		}else{
		$this->db->where('rootID','0');
		}
		$this->db->order_by('cat_name','ASC');
		$CategoryVal = $this->db->get();
		
		$CatArr = array();
			
		foreach($CategoryVal->result() as $catVal){
			$CatArr[] = array("id" => $catVal->id, "categoryName" => $catVal->cat_name);
		}
		
		$json_encode = json_encode(array("categoryDetails" => $CatArr));
		echo $this->cleanString($json_encode);
	} 
	
	/** 
	 * 
	 * Shop Activity
	 */	
	public function seller_activity() {
		$page=intval($_GET['pageId']);		
		$perpage=20;
		$countvalue = 20;
		if($this->input->get('pageId') != '' && ($this->input->get('pageId'))!=0){
			$paginationVal = $this->input->get('pageId')  * $countvalue;
			$limitPaging = $paginationVal.','.$countvalue;
		} else {
		    $paginationVal = 20;
			$limitPaging = ' 0,'.$countvalue;
		}
		
		$limit = explode(',', $limitPaging);
		    $start = $limit[0];
            $end = $limit[1] ;  	
		$loggeduserID = $this->uri->segment(3,0);		
		$sql = "select u.id,u.user_name,u.followers_count,u.following_count,u.thumbnail,s.seller_businessname,s.seller_id from ".USERS." u LEFT JOIN ".SELLER." s on s.seller_id = u.id where u.id=".$loggeduserID."";
		$query = $this->db->query($sql);
		$userListDetail = $query->row_array();
		$userArr[] = array(
			"id" => $loggeduserID,
			"userName" => $userListDetail['user_name'],
			"followersCount" => $userListDetail['followers_count'],
			"followingCount" => $userListDetail['following_count'],
			"SellerImage" => base_url().'images/users/thumb/'.$userListDetail['thumbnail'],
			"ShopName" => $userListDetail['seller_businessname']
		);
		$user_id = $loggeduserID;
				
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
		}
		
		
		
		$myshopproductArr= $this->mobile_model->get_all_details(PRODUCT,array('user_id'=>$loggeduserID))->result_array();
		$prd='';
		foreach($myshopproductArr as $prdId){
			$prd.=$prdId['id'].',';
		}
		$condition="(ua.activity_id =".$loggeduserID." OR FIND_IN_SET(ua.activity_id,'".rtrim($prd,',')."')) and (ua.activity_name='favorite item' OR ua.activity_name='favorite shop')";
		#$myshopactivity = $this->mobile_model->get_activity($condition,$postnumbers,$offset)->result_array();	
		$myshopactivity = $this->mobile_model->get_activity($condition,5000,0)->result_array();	
		$shopallactivity = $this->mobile_model->get_all_activity($condition);
		$allActivity=array();
		foreach($myshopactivity as $activity){
			if($activity['activity_name']=='favorite item') {
				$feedProductStatus=1;
				$feedproductDetails = $this->mobile_model->get_feed_product($activity['activity_id'])->result();
				$feeduserDetails = $this->mobile_model->get_feed_user($activity['user_id'])->result();
				
				$img=explode(',',$feedproductDetails[0]->productImage);
				if($user_id!=$feeduserDetails[0]->userId){
					$feeduser=$feeduserDetails[0]->userFirstName.' '.$feeduserDetails[0]->userLastName;
				}else{
					$feeduser='You';
				}
				
				 $current_year = date("Y");
				 $activity_year = date("Y",strtotime($activity['activity_time']));
				 if($current_year == $activity_year){
				 $activitydate = date("M d",strtotime($activity['activity_time']));
				 }else{
				  $activitydate = date("M d,Y",strtotime($activity['activity_time']));
				 }
				 
				
				$allActivity[]=array('activitytext'=>(string)$feeduser." favorited this item",
														'activitydate'=>$activitydate,
														'sortkey'=>strtotime($activity['activity_time']),
														'Name'=>$feedproductDetails[0]->productName,
														'userId'=>$feeduserDetails[0]->userId,														
														"Price"=>(string)number_format($this->data["currencyValue"]*$feedproductDetails[0]->productPrice,2),
														"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"],
														"type" =>"Like",
														'Image'=>base_url().'images/product/mb/'.$img[0]);
			}else if($activity['activity_name']=='favorite shop') {
				$feedShopDetails = $this->mobile_model->get_feed_shop($activity['activity_id'])->result();
				$feeduserDetails = $this->mobile_model->get_feed_user($activity['user_id'])->result();
				
				if($feedShopDetails[0]->sellerImage!=""){
					$sellerImage=base_url().'images/users/thumb/'.$feedShopDetails[0]->sellerImage;
				}else{
					$sellerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				if($user_id!=$feeduserDetails[0]->userId){
					$feeduser=$feeduserDetails[0]->userFirstName.' '.$feeduserDetails[0]->userLastName;
				}else{
					$feeduser='You';
				}
				
				$current_year = date("Y");
				 $activity_year = date("Y",strtotime($activity['activity_time']));
				 if($current_year == $activity_year){
				 $activitydate = date("M d",strtotime($activity['activity_time']));
				 }else{
				  $activitydate = date("M d,Y",strtotime($activity['activity_time']));
				 }
				 
				$allActivity[]=array('activitytext'=>(string)$feeduser." favorited your shop",
														'activitydate'=>$activitydate,
														'sortkey'=>strtotime($activity['activity_time']),
														'Name'=>"They will now see your items and updates in their activity feed.",				
														'userId'=>$feeduserDetails[0]->userId,
														"Price"=>"",
														"currencySymbol" =>'',
														"currencyCode" =>'',
														"type" =>"Favorite",
														'Image'=>$sellerImage);
			}			
		}
		
		$claimList = $this->mobile_model->getClaim($user_id);
		
		if($claimList->num_rows()>0){
			foreach($claimList->result() as $claim){
				 $current_year = date("Y");
				 $claimed_year = date("Y",strtotime($claim->claimed_time));
				 if($current_year == $claimed_year){
				 $claimed_time = date("M d",strtotime($claim->claimed_time));
				 }else{
				  $claimed_time = date("M d,Y",strtotime($claim->claimed_time));
				 }
				 
				 
				if($claim->thumbnail!=''){
					$buyerImage=base_url().'images/users/thumb/'.$claim->thumbnail;
				}else{
					$buyerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$allActivity[]=array('activitytext'=>(string)$claim->buyerName." ".$claim->status." a Claim",
												'activitydate'=>$claimed_time,
												'sortkey'=>strtotime($claim->claimed_time),
												'Name'=>"Order Id #".$claim->dealcodenumber,				
												'userId'=>$claim->buyerId,
												"Price"=>"",
												"currencySymbol" =>'',
												"currencyCode" =>'',
												"type" =>"Dispute",
												'Image'=>$buyerImage);
			}
		}
		
		$ordersList = $this->mobile_model->getOrders($user_id);
		if($ordersList->num_rows()>0){
			foreach($ordersList->result() as $order){
				$current_year = date("Y");
				 $order_year = date("Y",strtotime($order->created));
				 if($current_year == $order_year){
				 $order_time = date("M d",strtotime($order->created));
				 }else{
				  $order_time = date("M d,Y",strtotime($order->created));
				 }
				if($order->userImage!=''){
					$buyerImage=base_url().'images/users/thumb/'.$order->userImage;
				}else{
					$buyerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$allActivity[]=array('activitytext'=>(string)$order->user_name." Made an Order",
												'activitydate'=>$order_time,
												'sortkey'=>strtotime($order->created),
												'Name'=>"Order Id #".$order->dealCodeNumber." contains ".$order->totalItems." items",				
												'userId'=>$order->userId,											
												"Price"=>(string)number_format($this->data["currencyValue"]*$order->total,2),
												"currencySymbol" =>$this->data["currencySymbol"],
												"currencyCode" =>$this->data["currencyCode"],
												"type" =>"Order",
												'Image'=>$buyerImage);
			}
		}
		
		
		//print_r($paginationVal);
		//print_r($allActivity);die;
		
			$pagePos = $page+1;
		#$allActivity = array_merge($shopActivity, $disputeList,$orderList);
	//	$overallActivity = $this->array_sort($allActivity, 'sortkey', SORT_DESC);
		$overallActivity = $this->array_sort_with_pagination($allActivity, 'sortkey', SORT_DESC,$start,$end);
		
		$commonId=intval($user_id);
		$cartCount=0;
		if($commonId>0){
			$cartCount=$this->mobile_model->mini_cart_view($commonId);
		}		
		
		$json_encode = json_encode(array("userDetails"=>$userArr,"shopActivity"=>array_values($overallActivity),"shopActivityCount"=>(string)count($allActivity),"pagePos"=> (string)$pagePos,"cartCount"=>(string)$cartCount));		
		echo $this->cleanString($json_encode);
	}
	
	
	
	function array_sort($array, $on, $order=SORT_ASC){
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
			
				$new_array[$k] = $array[$k];
			}
		}

		return $new_array;
	}
	
	function array_sort_with_pagination($array, $on, $order=SORT_ASC,$start,$end){
		$new_array = array();
		$sortable_array = array();
        $i = $start;
		$j= $end;
		$index = 0;
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}

			foreach ($sortable_array as $k => $v) {
			if($j > 0 && $index >= $start){
				        $j--;
				        $i++;
				$new_array[$k] = $array[$k];	
						
			}
		 $index++;
			
			}
		}

		return $new_array;
	}
	
	/** 
	 * 
	 * Shop Activity
	 */	
	public function itemsListing() {			
		$page=intval($_GET['pageId']);		
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
			
		$sellerId=intval($_GET['sellerId']);	
		$Listings=array();
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){	
			$list=$_GET['list'];	
				switch ($list) {
					case "all":
						$dispopt="p.status !=";
						$dispval="Deleted";
						break;
					case "active":
						$dispopt="p.status";
						$dispval="Publish";
						break;
					case "soldout":
						$dispopt="p.quantity <=";
						$dispval="0";
						break;
					case "inactive":
						$dispopt="p.status";
						$dispval="UnPublish";
						break;
					default:
						$dispopt="p.status !=";
						$dispval="Deleted";
				}

				
			$filter=$_GET['sort'];	
			
			$filterVals=@explode('_',$filter);
			$sort_val=$filterVals[0];
			$sort_by=$filterVals[1];
				switch ($sort_val) {
					case "title":
						$order_by_name="p.product_name";
						break;
					case "stock":
						$order_by_name="p.quantity";
						break;
					case "price":
						$order_by_name="p.base_price";
						break;
					default:
						$order_by_name="p.created";
				}
				switch ($sort_by) {
					case "asc":
						$order_by_val="ASC";
						break;
					case "des":
						$order_by_val="DESC";
						break;
					default:
						$order_by_val="DESC";
				}
			
			
			$this->db->select('p.id,p.product_name,p.image,p.base_price,p.status,p.pay_status,p.quantity');
			$this->db->from(PRODUCT.' as p');
			$this->db->where('p.user_id',$sellerId);
			$this->db->where($dispopt,$dispval);
			$this->db->order_by($order_by_name,$order_by_val);
			$this->db->limit($postnumbers,$offset);	
			$productList = $this->db->get();
			
			foreach($productList->result() as $ProdList) {
				$img=explode(',',$ProdList->image);			
				$price= number_format($this->data["currencyValue"]*$ProdList->base_price,2);
				if($ProdList->quantity>0){
					$stock="In Stock";
					$quantity=$ProdList->quantity;
				}else{
					$stock="Out Stock";
					$quantity=0;
				}
														
				$Listings[] = array("productId" => $ProdList->id,
											"productName" => $ProdList->product_name,
											"Image" => base_url().'images/product/mb/'.$img[0],
											"Price" =>$price,
											"Status"=> (string)$ProdList->status,
											"Stock"=> (string)$stock,
											"quantity"=> (string)$quantity
											);
			}
			
		
			$json_encode = json_encode(array("status"=>(string)1,"Listings"=>$Listings,"totalListings"=>(string)$productList->num_rows(),"pagePos"=> (string)$page,"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"]));		
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"Listings"=>$Listings,"totalListings"=>(string)0,"pagePos"=> (string)$page,"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"]));	
		}
		
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Shop Orders
	 */	
	public function shopOrders() {
		$sellerId=intval($_GET['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$Orders=array();
		
		$page=intval($_GET['pageId']);		
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
			
			$cartCount=0;
			if($sellerId>0){
			$cartCount=$this->mobile_model->mini_cart_view($sellerId);
			}		
			
		if($sellerCheck->num_rows()>0){	
			$type=$_GET['type'];	
			switch ($type) {
				case "completed":
					$shipstatus="Delivered";
					break;
				default:
					$shipstatus="";
			}
			$orderList = $this->mobile_model->view_shop_order_details_pagination($sellerId,$shipstatus,$postnumbers,$offset);	
			foreach($orderList->result() as $row) {
				if($row->userImage!=""){
					$userImage=base_url().'images/users/thumb/'.$row->userImage;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$img=explode(',',$row->image);
				
				$Orders[]=array("orderDate"=>date("M d,Y",strtotime($row->created)),
											"Name"=>(string)$row->user_name." purchased ".$row->totalItems." items.",							
											"orderId"=>(string)$row->dealCodeNumber,
											"orderTotal" =>(string)number_format($this->data["currencyValue"]*$row->total,2),
											"orderStatus"=>$row->shipping_status,
											"userId"=>$row->userId,
											"userImage"=>$userImage,
											"product_name"=>$row->product_name,
											"product_id"=>$row->PrdID,
											"Image"=>base_url().'images/product/mb/'.$img[0],
											"quantity"=>$row->quantity,
											"shipping_date"=>$row->shipping_date,
											"estDate"=>$row->estDate,
											"reshipmentDate"=>$row->reshipmentDate,
											"reshipId"=>$row->reshipId,
											"tracking_id"=>$row->tracking_id,
											"shipping_status"=>$row->shipping_status,
											"received_status"=>$row->received_status,
											"review_status"=>$row->review_status,
											"claim_amount" =>$row->claim_amount,
											"cancelReason"=>$row->cancelReason,
											"cancelMessage"=>$row->cancelMessage,
											"cancelledMessage"=>$row->cancelledMessage,
											"statusMessage"=>$row->statusMessage,
											"trackingId"=>$row->trackingId);
			}

			
			$json_encode = json_encode(array("status"=>(string)1,"Orders"=>$Orders,"totalOrders"=>(string)$orderList->num_rows(),"cartCount"=>(string)$cartCount,"pagePos"=> (string)($page+1),	"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"]));		
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"Orders"=>$Orders,"totalOrders"=>(string)0,"cartCount"=>(string)$cartCount,"pagePos"=> (string)($page+1),"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"]));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * View Order
	 */	
	public function viewOrder() {
		$sellerId=intval($_GET['sellerId']);	
		$userId=intval($_GET['userId']);	
		$dealCodeNumber=intval($_GET['orderId']);	
			$cartCount=0;
			if($sellerId>0){
			$cartCount=$this->mobile_model->mini_cart_view($sellerId);
			}		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$orderInfo=array();
		$itemsInfo=array();
		$paySummary=array();
		
		if($sellerCheck->num_rows()>0){	
			$order = $this->mobile_model->get_order_info($sellerId,$userId,$dealCodeNumber);
			if($order->num_rows>0){
				if($order->row()->userImage!=""){
					$userImage=base_url().'images/users/thumb/'.$order->row()->userImage;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				if($order->row()->sellerImage!=""){
					$sellerImage=base_url().'images/users/thumb/'.$order->row()->sellerImage;
				}else{
					$sellerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$orderInfo[]=array("orderDate"=>date("M d,Y",strtotime($order->row()->created)),		
												"orderId"=>(string)$order->row()->dealCodeNumber,
												"orderTotal" =>(string)number_format($this->data["currencyValue"]*$order->row()->total,2),
												"payStatus"=>$order->row()->status,
												"orderStatus"=>$order->row()->shipping_status,
												"userId"=>$order->row()->userId,
												"shopId"=>$order->row()->shopId,
												"userName"=>(string)$order->row()->user_name,
												"sellerName"=>(string)$order->row()->sellerUserName,	"userImage"=>$userImage,
												"sellerImage"=>$sellerImage,
												"shipping_date"=>$order->row()->shipping_date,
												"estDate"=>$order->row()->estDate,
												"reshipmentDate"=>$order->row()->reshipmentDate,
												"reshipId"=>$order->row()->reshipId,
												"tracking_id"=>$order->row()->tracking_id,
												"shipping_status"=>$order->row()->shipping_status,
												"received_status"=>$order->row()->received_status,
												"review_status"=>$order->row()->review_status,
												"claim_amount" =>$order->row()->claim_amount,
												"cancelReason"=>$order->row()->cancelReason,
												"cancelMessage"=>$order->row()->cancelMessage,
												"cancelledMessage"=>$order->row()->cancelledMessage,
												"statusMessage"=>$order->row()->statusMessage,
												"trackingId"=>$order->row()->trackingId);
									
				$grandTotal=0;$ShipTotal=0;$SubTotal=0;
				foreach($order->result() as $orderList){				
					$prdInfo = $this->mobile_model->view_order_product($orderList->id);
					if($prdInfo->num_rows>0){				
						$img=explode(',',$prdInfo->row()->productImage);	
						$itemsInfo[]=array("Id"=>$prdInfo->row()->product_id,
														"Name"=>$prdInfo->row()->productName,
														"Attribute"=>$prdInfo->row()->attribute_values,
														"Image"=>base_url().'images/product/mb/'.$img[0],
														"Quantity"=>$prdInfo->row()->quantity,
														"UnitPrice"=>(string)number_format($this->data["currencyValue"]*$prdInfo->row()->price,2),
														"ItemTotal"=>(string)number_format($this->data["currencyValue"]*($prdInfo->row()->quantity*$prdInfo->row()->price),2)
												);
					}
					$ShipTotal=$ShipTotal+$prdInfo->row()->shippingcost;
					$SubTotal=$SubTotal+$prdInfo->row()->quantity*$prdInfo->row()->price;
				}
				$shippingCost=$ShipTotal;
				$taxCost=$prdInfo->row()->tax;
				$couponcodeDiscount=$prdInfo->row()->discountAmount;
				$giftcartDiscount=$prdInfo->row()->giftdiscountAmount;					
				$grandTotal=(($SubTotal+$shippingCost)-($couponcodeDiscount+$giftcartDiscount))+$taxCost;
				
				$paySummary[]=array("subTotal"=>(string)number_format($this->data["currencyValue"]*$SubTotal,2),"couponDiscount"=>(string)number_format($this->data["currencyValue"]*$couponcodeDiscount,2),
														"giftDiscount"=>(string)number_format($this->data["currencyValue"]*$giftcartDiscount,2),
														"shippingCost"=>(string)number_format($this->data["currencyValue"]*$shippingCost,2),
														"tax"=>(string)number_format($this->data["currencyValue"]*$taxCost,2),
														"grandTotal"=>(string)number_format($this->data["currencyValue"]*$grandTotal,2));
				
				$json_encode = json_encode(array("status"=>(string)1,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$cartCount,"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"]));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$cartCount,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"]));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$cartCount,"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"]));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * Change Order Status
	 */	
	 /*
	public function orderUpdate() {
		$sellerId=intval($_GET['sellerId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$statsDetail=array();
		if($sellerCheck->num_rows()>0){
			$orderId=$_GET['orderId'];	
			$status=intval($_GET['status']);	
			if($orderId!="" && $status!=""){
				switch ($status) {
					case "1":
						$shipping_status="Shipped";
					break;
					case "2":
						$shipping_status="Delivered";
					break;
					case "3":
						$shipping_status="Cancelled";
					break;
					default:
						$shipping_status="Processed";
				}
			
				$dataArr=array('shipping_status'=>$shipping_status);			
				$condition=array('dealCodeNumber'=>$orderId);
				
				$order_details = $this->mobile_model->update_details(USER_PAYMENT,$dataArr,$condition);
				if($order_details){
					$json_encode = json_encode(array("status"=>(string)1,"message"=>"Order ".$shipping_status));	
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>"Error In Updating"));	
				}
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>"Order Information Mismatched"));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Authentication Failed"));	
		}
		echo $this->cleanString($json_encode);
	}  */
	
	
	public function orderUpdate() {
		$sellerId=intval($_GET['sellerId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$statsDetail=array();
		if($sellerCheck->num_rows()>0){
			$orderId=$_GET['orderId'];	
			$status=intval($_GET['status']);	
			if($orderId!="" && $status!=""){
				switch ($status) {
					case "1":
						$shipping_status="Shipped";
					break;
					case "2":
						$shipping_status="Delivered";
						$check = "select * from ".USER_PAYMENT." where sell_id=".$sellerId." and dealCodeNumber ='".$orderId."' GROUP BY dealCodeNumber";
						$checkstatus = $this->mobile_model->ExecuteQuery($check)->first_row();
						if($checkstatus->payment_type == 'COD' || $checkstatus->payment_type == 'wire_transfer'|| $checkstatus->payment_type == 'western_union'){
							$dataArr['status'] = 'Paid';
						}
						$dataArr['received_status'] = 'Product received';
					break;
					case "3":
						$shipping_status="Cancelled";
					break;
					default:
						$shipping_status="Processed";
				}
			    $shippingMessage = $this->input->post('shippingMessage');
				if(isset($shippingMessage) && $shippingMessage != ''){
					$dataArr['statusMessage'] = $shippingMessage;
				}
				
				$shippingId = $this->input->post('trackingId');
				if(isset($shippingId) && $shippingId != ''){
					$dataArr['trackingId'] = $shippingId;
				}
				
				$refund = $this->input->post('refund_msg');
				if(isset($refund) && $refund != ''){
					$dataArr['statusMessage'] = $refund;
				}
				
				$estdate = $this->input->post('eventDate');
				if(isset($estdate) && $estdate != ''){
					$dataArr['estDate'] = $estdate;
				}
				$dataArr=array('shipping_status'=>$shipping_status);			
				$condition=array('dealCodeNumber'=>$orderId);
				$order_details = $this->mobile_model->update_details(USER_PAYMENT,$dataArr,$condition);
				
				
				$orderDetails = $this->mobile_model->get_all_details(USER_PAYMENT,$condition);
				$buyerDetails = $this->mobile_model->get_all_details(USERS,array('id'=>$orderDetails->row()->user_id));
				$sellerDetails = $this->mobile_model->get_all_details(USERS,array('id'=>$orderDetails->row()->sell_id));
				$newsid='35';
				$orderid = $orderId;
				$orderstatus = $shipping_status;
				$content .="";
				
				$content .= "comment : ".$orderDetails->row()->statusMessage."<br>";
				
				if($shipping_status == "Shipped"){
					$content = 	"Estimated Delivery Date : ".$orderDetails->row()->estDate."<br>".
						"Shiping Id : ".$orderDetails->row()->trackingId."<br>";
				}
				
				$sender_email = $sellerDetails->row()->email;
				$receive_email =  $buyerDetails->row()->email;
				$cc_mail_id = $this->data['siteContactMail'];
				
				$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
			
			//$discussionurl = base_url().'discussion/'.$orderid;
				$viewurl = base_url().'view-order-pre/'.$orderDetails->row()->user_id.'/'.$orderid;
			
				$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'orderid'=>$orderid,'orderstatus'=>$orderstatus,'content' => $content,'viewurl'=>$viewurl);
			
				extract($adminnewstemplateArr);
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
			
				$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');
			$message .= '</body>
			</html>';
			$email_values = array('mail_type'=>'html',
					'from_mail_id'=>$sender_email,
					'to_mail_id'=>$receive_email,
					'cc_mail_id'=>$cc_mail_id,
					'bcc_mail_id'=>$sender_email,
					'subject_message'=>$subject,
					'body_messages'=>$message
			);
			$email_send_to_common = $this->mobile_model->common_email_send($email_values);
				
				if($order_details){
					$json_encode = json_encode(array("status"=>(string)1,"message"=>"Order ".$shipping_status));	
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>"Error In Updating"));	
				}
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>"Order Information Mismatched"));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Authentication Failed"));	
		}
		echo $this->cleanString($json_encode);
	}
	
	
	
	
	public function dispute_attachment_common() {
		$dispute = '';
		$orderid=$this->input->post('orderid');
		$post_message=$this->input->post('postcmt');
		$buyerid=$this->input->post('buyerid');
		$sellerid=$this->input->post('sellerid');
		$post_time=date('Y-m-d H:i:s');
		$grand_total=$this->input->post('grand_total');
		$postDispute = $this->input->post('post_dispute');
		$commonId = $this->input->post('commonId');
		$reshipDate = $this->input->post('reshipDate');
		$reshipId = $this->input->post('reshipId');
		$ref = $this->input->post('post_refund');
       if($this->input->post('buyerid') !='' && $this->input->post('sellerid') !=''){
			if($postDispute != 'CancleOrder'){
				$conditionupdat=array('dealCodeNumber'=>$orderid);
				$reshiparray = array();
		
		if(isset($reshipDate) && $reshipDate != ''){
			$reshiparray['reshipmentDate'] = $reshipDate;
		}
			
		if(isset($reshipId) && $reshipId != ''){
			$reshiparray['reshipId'] = $reshipId;
		}
		
		if(count($reshiparray) > 0){
			$this->mobile_model->update_details(USER_PAYMENT,$reshiparray,$conditionupdat);
		}
		
		if($ref != ''){
			if($ref == 'ReShipment' || $ref == 'Refund'){
				$dataupdat=array('shipping_status'=>$ref);
			}
			$conditionupdat=array('dealCodeNumber'=>$orderid);
			$this->mobile_model->update_details(USER_PAYMENT,$dataupdat,$conditionupdat);
		}
		
		if($postDispute == 'Open a Dispute'){
			
			$dataupdat=array('claim_amount'=>$grand_total);
			$conditionupdat=array('dealCodeNumber'=>$orderid);
			$this->mobile_model->update_details(USER_PAYMENT,$dataupdat,$conditionupdat);
			
			$claimArr = array('seller_id'=>$sellerid,
								'buyer_id'=>$buyerid,
								'dealcodenumber'=>$orderid,
								'total_amount'=>$grand_total,
								'status'=>'Opened'
							);
						
			$exists_dealcode=$this->mobile_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderid));
			
			if($exists_dealcode->num_rows()== 0) {
				$this->mobile_model->simple_insert(ORDER_CLAIM,$claimArr);	
				$last_id = $this->db->insert_id(); 
			}
			
			
		//	$orderinformation=$this->mobile_model->get_order_details($orderid);
		
			
			/************       Zendesk Create Ticket For Dispute   Open :       ***************
			* Place - Controller/site/order/dispute_attachment_common()
			** /
			if($this->config->item('zendesk_status')==="Active"){
				$ticket_data['ticket'] = array(
						"subject" => 'Dispute for the order #'.$orderid,
						"description" => $post_message,
						"requester" =>$orderinformation->row->buyer_mail,
						"email" => $orderinformation->row->buyer_mail,
						"priority" => 'urgent',
						"collaborator_ids" => array($orderinformation->row->zendesk_id),
						'type' => 'problem'
				); 
				$ticket_data['dispute_id'] = $last_id;
				$ticket_data['url'] = '/tickets';
				$ticket_data['type'] = 'POST';
				$this->load->library('curl'); 
				$url = base_url().'site/zendesk/create_zendesk_ticket';
				$response = $this->curl->simple_post($url, $ticket_data);
			}

			/**************** Zendesk  Create Ticket For Dispute Open End  **************/
			
		}
		
		
		$orderid=$this->input->post('orderid');
		$orderinformation=$this->mobile_model->get_order_details($orderid);
		
		$activity="discussion";
		if($commonId == $buyerid){
			$posted_by='buyer';
			$sender_name=$orderinformation->row()->buyer_name;
			$sender_email=$orderinformation->row()->buyer_mail;
			$receive_email=$orderinformation->row()->seller_mail;
			$ccmail=$this->data['siteContactMail'];
			
		}elseif($commonId ==$sellerid){
			$posted_by='seller';
			$activity="own-order-discussion";
			$sender_name=$orderinformation->row()->seller_name;
			$sender_email=$orderinformation->row()->seller_mail;
			$receive_email=$orderinformation->row()->buyer_mail;
			$ccmail=$this->data['siteContactMail'];
		}else{
			$posted_by='admin';
			$sender_name=$this->data['siteTitle'].' Admin';
			$sender_email=$this->data['siteContactMail'];
			$receive_email=$orderinformation->row()->buyer_mail.','.$orderinformation->row()->seller_mail;
			$ccmail='';
		}		
		
		
		
		
		$sellernamee = $orderinformation->row()->seller_name;
		$this->data['selleremaill'] = $this->mobile_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		
		$postArr = array(
					'orderid'		=>	$orderid,
					'posted_by'		=>	$posted_by,
					'posted_id'		=>	$commonId,
					'post_message'	=>	$post_message,
					'post_time'		=>	$post_time,
					'status'		=>  'Publish'
				);
				
		$this->mobile_model->simple_insert(ORDER_COMMENTS,$postArr);
		$lastIid=$this->db->insert_id(); 
		
		$actArr = array('activity'=>$activity,
								'activity_id'=>$orderid,
								'user_id'	=>$commonId,
								'activity_ip'=>$this->input->ip_address(),
								'created'=>date("Y-m-d H:i:s"),
								'comment_id'=>$lastIid);
		$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
		
		
		if($posted_by!='seller'){
			/* Push Message Starts*/
			$message=$sender_name.' also posted message in your discussion board on '.$this->config->item('email_title');
			$type='discussion';
			$this->sendPushNotification($sellerid,$message,$type,array($lastIid));
			/* Push Message Ends*/	
		}
		
		
		
		
		
		/*mailing process starts here*/
		
		
		
		
		
		if($postDispute == 'Solved Dispute'){
			$newsid='22';
			$this->mobile_model->update_details(ORDER_CLAIM,array('status'=>'Closed'),array('dealcodenumber'=>$orderid));
		}else{
			//$newsid='10';
			$newsid='36';
		}
		
		
		if($postDispute == 'Open a Dispute'){
			$dispute = 'New Dispute (ID:'.$last_id.') has been opened';
		}
		if($postDispute == 'Reship a new product'){
			$dispute = 'The Order has been Processed';
		}
		
		$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$discussionurl=base_url().'discussion/'.$orderid;
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'dispute'=>$dispute);
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
			
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
		</html>';
		$email_values = array('mail_type'=>'html',
					'from_mail_id'=>$sender_email,
					'mail_name'=>$sender_name,
					'to_mail_id'=>$receive_email,
					'cc_mail_id'=>$ccmail,
					'bcc_mail_id'=>$sender_email,
					'subject_message'=>$template_values['news_subject'],
					'body_messages'=>$message
					);
		/*echo $header;
		echo $message; exit;*/	
		//echo '<pre>'; print_r($email_values);	die;
		$email_send_to_common = $this->mobile_model->common_email_send($email_values);
		
		if($postDispute == 'Reship a new product'){
				
			$oldOrder = $this->mobile_model->get_all_details(USER_PAYMENT,array('user_id' => $buyerid, 'dealCodeNumber' => $orderid, 'sell_id' => $sellerid))->result_Array();
				
			$oldOrder[0]['shipping_date'] = '';
			$oldOrder[0]['estDate'] = '';
			$oldOrder[0]['reshipmentDate'] = '';
			$oldOrder[0]['reshipId'] = '';
			$oldOrder[0]['tracking_id'] = '';
			$oldOrder[0]['shipping_status'] = 'Processed';
				
			$oldOrder[0]['received_status'] = 'Not received yet';
			$oldOrder[0]['review_status'] = 'Not open';
			$oldOrder[0]['claim_amount'] = '';
				
				
			$oldOrder[0]['cancelReason'] = '';
			$oldOrder[0]['cancelMessage'] = '';
			$oldOrder[0]['cancelledMessage'] = '';
			$oldOrder[0]['statusMessage'] = '';
			$oldOrder[0]['trackingId'] = '';
				
			$id = $oldOrder[0]['id'];
			unset($oldOrder[0]['id']);
			$this->mobile_model->update_details(USER_PAYMENT,$oldOrder[0],array('id'=>$id));
				
		}
		
		if($postDispute == 'Open a Dispute'){
			$this->open_dispute_cancel_order();
		}
		$returnStr['status'] = 'Success';
		} else{
		
			$orderid=$this->input->post('orderid');
			$orderinformation=$this->mobile_model->get_order_details($orderid);
			if($commonId == $buyerid && $orderinformation->row()->$buyer_id == $commonId ){
				$this->open_dispute_cancel_order();
			}else{
				$returnStr['satatus'] = 'Failure';
				$returnStr['msg'] = 'Invalid Buyer Id';
			}
			
		}
		}else{
				$returnStr['satatus'] = 'Failure';
				$returnStr['msg'] = 'Input required';
		}
		
		echo json_encode($returnStr);die;
	}
	
		public function open_dispute_cancel_order() {
		
		$dataupdat['received_status'] = 'Requested Cancel';
		$dataupdat['cancelReason'] = $_POST['reason'];
		$dataupdat['cancelMessage'] = $_POST['postcmt'];
		$orderid = $this->input->post('orderid');
		$conditionupdat = array('dealCodeNumber'=>$orderid);
		$this->mobile_model->update_details(USER_PAYMENT,$dataupdat,$conditionupdat);
		
		$orderid=$this->input->post('orderid');
		$orderinformation=$this->mobile_model->get_order_details($orderid);
		$sender_name=$orderinformation->row()->buyer_name;
		$sender_email=$orderinformation->row()->buyer_mail;
		$receive_email=$orderinformation->row()->seller_mail;
		$seller = $orderinformation->row()->seller_name;
		$buyer = $orderinformation->row()->buyer_name;
		$ccmail=$this->data['siteContactMail'];
		$reason = $_POST['reason'];
		$post_message = $_POST['postcmt'];;
		$newsid='34';
		
		$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$discussionurl=base_url().'discussion/'.$orderid;
		
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'reason'=>$reason,'post_message'=>$post_message,'buyer'=>$buyer,'seller'=>$seller);
		
		extract($adminnewstemplateArr);
		
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
			
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');
		$message .= '</body>
		</html>';
		$email_values = array('mail_type'=>'html',
				'from_mail_id'=>$sender_email,
				'mail_name'=>$sender_name,
				'to_mail_id'=>$receive_email,
				'cc_mail_id'=>$ccmail,
				'bcc_mail_id'=>$sender_email,
				'subject_message'=>$template_values['news_subject'],
				'body_messages'=>$message
		);
		
		$email_send_to_common = $this->mobile_model->common_email_send($email_values);
	}
	
		public function cancelOrder() {
		
		$dataupdat['received_status'] = 'Requested Cancel';
		$dataupdat['cancelReason'] = $_POST['reason'];
		$dataupdat['cancelMessage'] = $_POST['message_text'];
		$orderid = $this->input->post('orderid');
		$conditionupdat = array('dealCodeNumber'=>$orderid);
		$this->mobile_model->update_details(USER_PAYMENT,$dataupdat,$conditionupdat);
		
		$orderid=$this->input->post('orderid');
		$orderinformation=$this->mobile_model->get_order_details($orderid);
		$sender_name=$orderinformation->row()->buyer_name;
		$sender_email=$orderinformation->row()->buyer_mail;
		$receive_email=$orderinformation->row()->seller_mail;
		$seller = $orderinformation->row()->seller_name;
		$buyer = $orderinformation->row()->buyer_name;
		$ccmail=$this->data['siteContactMail'];
			
	
		
		$reason = $_POST['reason'];
		$post_message = $_POST['message_text'];;
		$newsid='34';
		
		$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$discussionurl=base_url().'discussion/'.$orderid;
		
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'reason'=>$reason,'post_message'=>$post_message,'buyer'=>$buyer,'seller'=>$seller);
		
		extract($adminnewstemplateArr);
		
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
			
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');
		$message .= '</body>
		</html>';
		$email_values = array('mail_type'=>'html',
				'from_mail_id'=>$sender_email,
				'mail_name'=>$sender_name,
				'to_mail_id'=>$receive_email,
				'cc_mail_id'=>$ccmail,
				'bcc_mail_id'=>$sender_email,
				'subject_message'=>$template_values['news_subject'],
				'body_messages'=>$message
		);
		
		$email_send_to_common = $this->mobile_model->common_email_send($email_values);
	}
	
	/** 
	 * 
	 * View User Profile
	 */	
	public function viewuserProfile() {
		$sellerId=intval($_GET['sellerId']);	
		$userId=intval($_GET['userId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$userInfo=array();$userFavList=array();
		if($sellerCheck->num_rows()>0){	
			$userCol="`id`,`user_name`,`full_name`,`last_name`,`thumbnail`,`followers_count`,`following_count`,`followers`,`city`,`country`,`created`";
			$userCheck = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userCol);
			if($userCheck->num_rows>0){
				if($userCheck->row()->thumbnail!=""){
					$userImage='images/users/thumb/'.$userCheck->row()->thumbnail;
				}else{
					$userImage='images/users/thumb/profile_pic.png';
				}
				$followArr=@explode(',',$userCheck->row()->followers);
				if(in_array($sellerId,$followArr)){
					$followStatus=1;
				}else{
					$followStatus=0;
				}
				$condition="(ua.user_id =".$userId.") and (ua.activity_name='favorite item')";
				$userFavArr = $this->mobile_model->get_all_activity($condition);
				
				$userInfo[]=array("profilePic"=>$userImage,
												"userFullName"=>(string)$userCheck->row()->full_name." ".$userCheck->row()->last_name,
												"userName"=>(string)$userCheck->row()->user_name,
												"userId"=>(string)$userCheck->row()->id,
												"userFrom"=>(string)$userCheck->row()->city.",".$userCheck->row()->country,
												"userSince"=>(string)date("F Y",strtotime($userCheck->row()->created)),
												"followersCount"=>(string)$userCheck->row()->followers_count,
												"followingCount"=>(string)$userCheck->row()->following_count,
												"followStatus"=>(string)$followStatus,
												"favoritesCount"=>(string)$userFavArr->num_rows());
				
				if($userFavArr->num_rows()>0){		
					foreach($userFavArr->result() as $favList){				
						$prdInfo = $this->mobile_model->list_product_info($favList->activity_id);
						if($prdInfo->num_rows>0){				
							$img=explode(',',$prdInfo->row()->image);	
							$userFavList[]=array("Id"=>$prdInfo->row()->id,
															"Name"=>$prdInfo->row()->product_name,
															"Image"=>'images/product/mb/'.$img[0],
															"currencySymbol" =>$this->data["currencySymbol"],
															"currencyCode" =>$this->data["currencyCode"],
															"price" =>$prdInfo->row()->base_price,
															"shopId" =>$prdInfo->row()->seller_id,
															"shopurl" =>$prdInfo->row()->shop_url,
															"shopName" =>$prdInfo->row()->shop_name);
						}
					} 
				}
				$json_encode = json_encode(array("status"=>(string)1,"userInfo"=>$userInfo,"userFavList"=>$userFavList));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"userInfo"=>$userInfo,"userFavList"=>$userFavList));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"userInfo"=>$userInfo,"userFavList"=>$userFavList));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * Follow User
	 */	
	public function followUser() {
		$sellerId=intval($_GET['sellerId']);	
		$userId=intval($_GET['userId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$userInfo=array();$userFavList=array();
		if($sellerCheck->num_rows()>0){	
			$userCol="`id`,`followers_count`,`followers`";
			$userCheck = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userCol);	### User Values
			if($userCheck->num_rows>0){
				$takeCol="`id`,`user_name`,`following`,`following_count`";
				$userAct = $this->mobile_model->get_column_details(USERS,array('id'=>$sellerId),$takeCol);	### Seller Values
				$followingListArr = @explode(',', $userAct->row()->following);				
				if (!in_array($userId, $followingListArr)){
					$followingListArr[] = $userId;
					$newFollowingList = @implode(',', $followingListArr);
					$followingCount =$userAct->row()->following_count;					
					$sellerName =$userAct->row()->user_name;					
					$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount+1);
					$condition = array('id'=>$sellerId);
					$this->mobile_model->update_details(USERS,$dataArr,$condition);
					$followersListArr = @explode(',', $userCheck->row()->followers);
					if (!in_array($sellerId, $followersListArr)){
						$followersListArr[] = $sellerId;
						$newFollowersList = @implode(',', $followersListArr);
						$followersCount = $userCheck->row()->followers_count;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount+1);
						$condition = array('id'=>$userId);
						$this->mobile_model->update_details(USERS,$dataArr,$condition);
					}
					$actArr = array('activity'=>'follow',
												'activity_id'=>$userId,
												'user_id'	=>$sellerId,
												'activity_ip'=>$this->input->ip_address(),
												'created'=>date("Y-m-d H:i:s"));
					$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
					/*Push Message Starts*/
					$message=$sellerName.' started following you on '.$this->config->item('email_title');
					$type='follow';
					$this->sendPushNotification($userId,$message,$type,array($userId));
					/*Push Message Ends*/
				
				}
				$json_encode = json_encode(array("status"=>(string)1,"message"=>"Following","following_count"=>$followingCount+1,"followers_count"=>$followersCount+1,"followStatus"=>(string)1));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid User Id"));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid Seller Id"));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Unfollow User
	 */	
	public function unfollowUser() {
		$sellerId=intval($_GET['sellerId']);	
		$userId=intval($_GET['userId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$userInfo=array();$userFavList=array();
		if($sellerCheck->num_rows()>0){	
			$userCol="`id`,`followers_count`,`followers`";
			$userCheck = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userCol);	### User Values
			if($userCheck->num_rows>0){
				$takeCol="`id`,`following`,`following_count`";
				$userAct = $this->mobile_model->get_column_details(USERS,array('id'=>$sellerId),$takeCol);	### Seller Values
				$followingListArr = @explode(',', $userAct->row()->following);				
				if (in_array($userId, $followingListArr)){
					if(($key = array_search($userId, $followingListArr)) !== false) {
						unset($followingListArr[$key]);
					}
					$newFollowingList = @implode(',', $followingListArr);				
					$followingCount =$userAct->row()->following_count;					
					$dataArr = array('following'=>$newFollowingList,'following_count'=>$followingCount-1);
					$condition = array('id'=>$sellerId);
					$this->mobile_model->update_details(USERS,$dataArr,$condition);
					$followersListArr = @explode(',', $userCheck->row()->followers);
					if (in_array($sellerId, $followersListArr)){
						if(($key = array_search($sellerId, $followersListArr)) !== false) {
						    unset($followersListArr[$key]);
						}
						$newFollowersList = @implode(',', $followersListArr);
						$followersCount = $userCheck->row()->followers_count;
						$dataArr = array('followers'=>$newFollowersList,'followers_count'=>$followersCount-1);
						$condition = array('id'=>$userId);
						$this->mobile_model->update_details(USERS,$dataArr,$condition);
					}					
					$actArr = array('activity'=>'unfollow',
												'activity_id'=>$userId,
												'user_id'	=>$sellerId,
												'activity_ip'=>$this->input->ip_address(),
												'created'=>date("Y-m-d H:i:s"));
					$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
				}
				$json_encode = json_encode(array("status"=>(string)1,"message"=>"Unfollowing","following_count"=>$followingCount-1,"followers_count"=>$followersCount-1,"followStatus"=>(string)0));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid User Id"));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid Seller Id"));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Shop statistics
	 */	
	public function statistics() {
		$sellerId=intval($_GET['sellerId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$statsDetail=array();
		if($sellerCheck->num_rows()>0){
			$viewby=$_GET['viewby'];	
			##Get product list 
			$prdCol="`id`";
			$prdArr= $this->mobile_model->get_column_details(PRODUCT,array('user_id'=>$sellerId),$prdCol)->result_array();
			$prd='';
			foreach($prdArr as $prdId){
				$prd.=$prdId['id'].',';
			}
			switch ($viewby) {
				case "today":					
					$fromtime=date("Y-m-d")." 00:00:00";
					$totime=date("Y-m-d")." 23:59:59";
				break;
				case "last7":
					$fromtime=date('Y-m-d', strtotime('today - 07 days'))." 00:00:00";
					$totime=date("Y-m-d")." 23:59:59";
				break;
				case "week":
					$weekDates=$this->get_week_range(date("d"),date("m"),date("Y"));
					$fromtime=$weekDates['first']." 00:00:00";
					$totime=$weekDates['last']." 23:59:59";
				break;
				case "last30":
					$fromtime=date('Y-m-d', strtotime('today - 30 days'))." 00:00:00";
					$totime=date("Y-m-d")." 23:59:59";
				break;
				case "month":
					$fromtime=date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'))." 00:00:00";
					$totime=date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))))." 23:59:59";
				break;
				case "all":
					$fromtime="1970-01-01 00:00:00";
					$totime=date("Y-m-d")." 23:59:59";
				break;
				default:
					$fromtime="1970-01-01 00:00:00";
					$totime=date("Y-m-d")." 23:59:59";
			}
			
			$condition="(ua.activity_id =".$sellerId." OR FIND_IN_SET(ua.activity_id,'".rtrim($prd,',')."')) and (ua.activity_name='favorite item' OR ua.activity_name='favorite shop') AND (ua.activity_time BETWEEN '".$fromtime."' AND '".$totime."')";
			$favorite = $this->mobile_model->get_all_activity($condition);
			
			#$condition="(up.sell_id=".$sellerId." AND up.status='Paid') AND (up.created BETWEEN '".$fromtime."' AND '".$totime."')";
			#$order = $this->mobile_model->get_order_stats($condition);
			#$orderCount=$order->num_rows(); 
			
			$condition="(p.created BETWEEN '".$fromtime."' AND '".$totime."')";
			$revenue_tax = $this->mobile_model->get_revenue_tax_stats($sellerId,$condition);
			
			$favCount=$favorite->num_rows();
			$orderCount=$revenue_tax->row()->orders; 
			$revenueAmt=$revenue_tax->row()->TotalAmt; 
			$taxAmt=$revenue_tax->row()->TotalTax; 
			
			$statsDetail[]=array("Favorite"=>(string)$favCount,
												"Orders"=>(string)$orderCount,
												"Revenue"=>number_format($revenueAmt,2),
												"Tax"=>number_format($taxAmt,2),
												"currencySymbol" =>$this->data["currencySymbol"],
												"currencyCode" =>$this->data["currencyCode"]
												);
			$json_encode = json_encode(array("status"=>(string)1,"stats"=>$statsDetail));	
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"stats"=>$statsDetail));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
     * get_week_range accepts numeric $month, $day, and $year values.  
     * It will find the first sunday and the last saturday of the week for the
     * given day, and return them as YYYY-MM-DD timestamps
     *
     * @param month: numeric value of the month (01 - 12)
     * @param day  : numeric value of the day (01 - 31)
     * @param year : four-digit value of the year (2014)
     * @return     : array('first' => sunday of week, 'last' => saturday of week);
     */
    function get_week_range($day='', $month='', $year='') {	
        if (empty($day)) $day = date('d');
        if (empty($month)) $month = date('m');
        if (empty($year)) $year = date('Y');		
        $weekday = date('w', mktime(0,0,0,$month, $day, $year));
        $sunday  = $day - $weekday;
        $start_week = date('Y-m-d', mktime(0,0,0,$month, $sunday, $year));
        $end_week   = date('Y-m-d', mktime(0,0,0,$month, $sunday+6, $year));
        if (!empty($start_week) && !empty($end_week)) {
            return array('first'=>$start_week, 'last'=>$end_week);
        }		
        return false;
    }  
	/** 
	 * 
	 * View Claim List
	 */	
	public function viewClaims() {
		$sellerId=intval($_GET['sellerId']);	
		$page=intval($_GET['pageId']);		
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
			
		$cartCount=0;
		if($sellerId>0){
			$cartCount=$this->mobile_model->mini_cart_view($sellerId);
			}		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$disputeList=array();
		if($sellerCheck->num_rows()>0){
			$type=$_GET['type'];	
			switch ($type) {
				case "open":
					$claimStatus="Opened";
				break;
				case "close":
					$claimStatus="Closed";
				break;
				default:
					$claimStatus="Opened";
			}
			$claimList = $this->mobile_model->get_claimList_pagination($sellerId,$claimStatus,$postnumbers,$offset);
			$totalclaimList = $this->mobile_model->get_claimList($sellerId,$claimStatus);
			if($claimList->num_rows()>0){
				foreach($claimList->result() as $claim){
					if($claim->thumbnail!=''){
						$buyerImage=base_url().'images/users/thumb/'.$claim->thumbnail;
					}else{
						$buyerImage=base_url().'images/users/thumb/profile_pic.png';
					}
					$disputeList[]=array("orderId"=>$claim->dealcodenumber,
													"claimAmt"=>$claim->total_amount,
													"buyerId"=>$claim->buyerId,
													"buyerImage"=>$buyerImage,
													"buyerName"=>$claim->buyerName
													);
				}
			}
			$json_encode = json_encode(array("status"=>(string)1,"disputeList"=>$disputeList,"totalDispute"=>(string)$totalclaimList->num_rows(),"cartCount"=>(string)$cartCount,"pagePos"=> (string)($page+1),	"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"]));	
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"disputeList"=>$disputeList,"totalDispute"=>(string)0,"cartCount"=>(string)$cartCount,"pagePos"=> (string)($page+1),	"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"]));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * View Discussion Detail
	 */	
	public function viewDiscussion() {
		$sellerId=intval($_GET['sellerId']);	
		$orderId=intval($_GET['orderId']);	
			$page=intval($_GET['pageId']);		
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$discusssionHistory=array();
		$cartCount=0;
		if($sellerId>0){
			$cartCount=$this->mobile_model->mini_cart_view($sellerId);
			}	
		if($sellerCheck->num_rows()>0){	
			$orderCol="`id`,`dealCodeNumber`,	user_id`,`sell_id`";
			$orderCheck = $this->mobile_model->get_column_details(USER_PAYMENT,array('dealCodeNumber'=>$orderId),$orderCol);	### Order Values
			if($orderCheck->num_rows>0){
				//$chatHistory = $this->mobile_model->get_discussion_history($orderId);	### Discussion History 
				$chatHistoryTotal = $this->mobile_model->get_discussion_history_count($orderId);
				$chatHistory = $this->mobile_model->get_discussion_history_pagination($orderId,$postnumbers,$offset);	### Discussion History 
				//print_r($this->mobile_model->db->last_query());die;
				if($chatHistory->num_rows()>0){
					foreach($chatHistory->result() as $msg){
						$posterCol="`id`,`thumbnail`,`user_name`";
						$posterinfo=$this->mobile_model->get_column_details(USERS,array('id'=>$msg->posted_id),$posterCol);
						if($posterinfo->row()->thumbnail!=''){
							$poster_img=base_url().'images/users/thumb/'.$posterinfo->row()->thumbnail;
						}else{
							$poster_img=base_url().'images/users/thumb/profile_pic.png';
						}
						/*time frame*/
						$datediff = strtotime($msg->post_time); 
						$cmtTime=$this->get_relative_by_date($msg->post_time);
						//$cmtTime=$this->relative_time($datediff);
						if($msg->posted_id==$sellerId){
							$post_by='You';
							$poster_name=$posterinfo->row()->user_name;
						}else{
							$post_by=$msg->posted_by;
							$poster_name=$posterinfo->row()->user_name;
						}
						if($msg->image==""){
							$img0="";$img1="";$img2="";$img3="";$img4="";
							/* $postImg[]=array("Img0"=>(string)"",
											"Img1"=>(string)"",
											"Img2"=>(string)"",
											"Img3"=>(string)"",
											"Img4"=>(string)""
											); */
						}else{
							$postImg=array();
							$Img=@explode(',',$msg->image);
							$img0="";$img1="";$img2="";$img3="";$img4="";
							if($Img[0]!="")$img0=base_url().'images/dispute_images/'.$Img[0];
							if($Img[1]!="")$img1=base_url().'images/dispute_images/'.$Img[1];
							if($Img[2]!="")$img2=base_url().'images/dispute_images/'.$Img[2];
							if($Img[3]!="")$img3=base_url().'images/dispute_images/'.$Img[3];
							if($Img[4]!="")$img4=base_url().'images/dispute_images/'.$Img[4];
							
							/* $postImg[]=array("Img0"=>$img0,
											"Img1"=>$img1,
											"Img2"=>$img2,
											"Img3"=>$img3,
											"Img4"=>$img4
											); */
						}
						
						$discusssionHistory[]=array("postedBy"=>$post_by,
															"posterId"=>$msg->posted_id,
															"posterImage"=>$poster_img,
															"posterName"=>$poster_name,
															"postTime"=>$cmtTime,
															"postMsg"=>$msg->post_message,
															"postImg_1"=>$img0,
															"postImg_2"=>$img1,
															"postImg_3"=>$img2,
															"postImg_4"=>$img3,
															"postImg_5"=>$img4
															);
						
					}
				}
				$json_encode = json_encode(array("status"=>(string)1,"discusssionHistory"=>$discusssionHistory,"pagePos"=> (string)($page+1),"cartCount"=>(string)$cartCount,"totalMessage"=>(string)$chatHistoryTotal->row()->total));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"discusssionHistory"=>$discusssionHistory,"pagePos"=> (string)($page+1),"cartCount"=>(string)$cartCount,"totalMessage"=>(string)0));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"discusssionHistory"=>$discusssionHistory,"pagePos"=> (string)($page+1),"cartCount"=>(string)$cartCount,"totalMessage"=>(string)0));	
		}
		echo $this->cleanString($json_encode);
	}
	
	 public function get_relative_by_date($forward_date=''){
	$time = strtotime($forward_date);
	$dispaly_date = date("M d",$time);
	$dispaly_date_only = date("d",$time);
	$current_date_only = date("d");
	$dispaly_date_year = date("M d,Y",$time);
	$dispaly_date_time = date("g:i a", $time);
	$d1 =  new DateTime($forward_date, new DateTimeZone('Asia/Kolkata'));
	$datestring = "%Y-%m-%d %H:%i:%s";
	$time = time(); 
	$createdTime = mdate($datestring,$time);
	$d2=  new DateTime($createdTime, new DateTimeZone('Asia/Kolkata'));
	$diff=$d2->diff($d1);
	$returndate = '';
//	print_r($diff);
	if($diff->y == 0 ){
		if($diff->d == 0 && $dispaly_date_only == $current_date_only){
			$returndate =  $dispaly_date_time;
		}else{
			$returndate = $dispaly_date;
		}
	}else{
		$returndate =  $dispaly_date_year;
	}
	return $returndate;
	}
	/** 
	 * 
	 * Get Time ago
	 */	
	
	function relative_time($datetime)
		{
			$CI =& get_instance();
			$CI->lang->load('date');

			$difference = time() - $datetime;
			$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
			$lengths = array("60","60","24","7","4.35","12","10");

			if ($difference > 0) 
			{ 
				$ending = $CI->lang->line('date_ago');
			} 
			else 
			{ 
				$difference = -$difference;
				$ending = $CI->lang->line('date_to_go');
			}
			for($j = 0; $difference >= $lengths[$j]; $j++)
			{
				$difference /= $lengths[$j];
			} 
			$difference = round($difference);

			if($difference != 1) 
			{ 
				$period = strtolower($CI->lang->line('date_'.$periods[$j].'s'));
			} else {
				$period = strtolower($CI->lang->line('date_'.$periods[$j]));
			}

			return "$difference $period $ending"." ago";
	} 
	
	/** 
	 * 
	 * Post Comment in Discussion
	 */	
	public function postComment(){		
		$sellerId=intval($_POST['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$discusssionHistory = array();
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){
			$orderid=$this->input->post('orderId');
			$post_message=$this->input->post('post_message');
			$sellerId=$this->input->post('sellerId');
			$post_time=date('Y-m-d H:i:s'); 
			$imgname="";
			
			$imgsav="images/dispute_images/";
			if($_FILES['photo']['size']>0){
					$data = file_get_contents($_FILES['photo']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
			}
			
			$orderinformation=$this->mobile_model->get_order_details($orderid);
			
			$posted_by='seller';
			$sender_name=$orderinformation->row()->seller_name;
			$sender_email=$orderinformation->row()->seller_mail;
			$receive_email=$orderinformation->row()->buyer_mail;
			$ccmail=$this->data['siteContactMail'];
			
			$sellerCol="`id`,`email`";
			$selleremaill= $this->mobile_model->get_column_details(USERS,array('id'=>$sellerId),$sellerCol);
			
			$postArr = array(
						'orderid'		=>	$orderid,
						'posted_by'		=>	$posted_by,
						'posted_id'		=>	$sellerId,
						'post_message'	=>	$post_message,
						'image'	=>	$imgname,
						'post_time'		=>	$post_time,
						'status'		=> 'Publish'
					);
			$this->mobile_model->simple_insert(ORDER_COMMENTS,$postArr);
			$lastIid=$this->db->insert_id(); 
			$cmtTime=$this->get_relative_by_date($post_time);
			$post_by='You';
			if($imgname != ""){
			$img0 = base_url().'images/dispute_images/'.$imgname;
			}else{
			$img0 = '';
			}
			$discusssionHistory[]=array("postedBy"=>$post_by,
															"posterId"=>$sellerId,
															"postTime"=>$cmtTime,
															"postMsg"=>$post_message,
															"postImg_1"=>$img0,
															);
			
			
			$actArr = array('activity'=>'own-product-comment',
									'activity_id'=>$orderid,
									'user_id'	=>$sellerId,
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"),
									'comment_id'=>$lastIid);
			$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
			
			/*mailing process starts here*/
			$newsid='10';
			$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
			$subject = 'From: '.$this->config->item('email_title');
			$discussionurl=base_url().'discussion/'.$orderid;
			$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
			extract($adminnewstemplateArr);
			$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
					
			$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');	
			$message .= '</body>
			</html>';
			$email_values = array('mail_type'=>'html',
						'from_mail_id'=>$sender_email,
						'mail_name'=>$sender_name,
						'to_mail_id'=>$receive_email,
						'cc_mail_id'=>$ccmail,
						'subject_message'=>$template_values['news_subject'],
						'body_messages'=>$message
						);
			$email_send_to_common = $this->mobile_model->common_email_send($email_values);
			
			/*mailing process starts here for buyer*/
			$newsid='21';
			$message ="";
			$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
			$subject = 'From: '.$this->config->item('email_title');
			$discussionurl=base_url().'discussion/'.$orderid;
			$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
			extract($adminnewstemplateArr);
			$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
			$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');	
			$message .= '</body>
			</html>';
			$email_values_buyer = array('mail_type'=>'html',
						'from_mail_id'=>$this->data['siteContactMail'],
						'mail_name'=>$this->data['siteTitle'].' Admin',		
						'to_mail_id'=>$selleremaill->row()->email,					
						'subject_message'=>$template_values['news_subject'],
						'body_messages'=>$message
						);
			$email_send_to_common = $this->mobile_model->common_email_send($email_values_buyer);
			
			
			
			$json_encode = json_encode(array("status"=>(string)1,"message"=>"Successfully Sent","discusssionHistory"=>$discusssionHistory));	
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Error While Sending","discusssionHistory"=>$discusssionHistory));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Solved Dispute
	 */	
	public function solvedDispute(){		
		$sellerId=intval($_POST['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){
			$orderid=$this->input->post('orderId');
			$post_message=$this->input->post('post_message');
			$sellerId=$this->input->post('sellerId');
			$post_time=date('Y-m-d H:i:s'); 
			$imgname="";
			
			$imgsav="images/dispute_images/";
			if($_FILES['photo']['size']>0){
					$data = file_get_contents($_FILES['photo']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
			}
			
			$orderinformation=$this->mobile_model->get_order_details($orderid);
			
			$posted_by='seller';
			$sender_name=$orderinformation->row()->seller_name;
			$sender_email=$orderinformation->row()->seller_mail;
			$receive_email=$orderinformation->row()->buyer_mail;
			$ccmail=$this->data['siteContactMail'];
			
			$sellerCol="`id`,`seller_id`,`email`";
			$this->data['selleremaill'] = $this->mobile_model->get_column_details(USERS,array('id'=>$sellerId),$sellerCol);
			
			$postArr = array(
						'orderid'		=>	$orderid,
						'posted_by'		=>	$posted_by,
						'posted_id'		=>	$sellerId,
						'post_message'	=>	$post_message,
						'image'	=>	$imgname,
						'post_time'		=>	$post_time,
						'status'		=> 'Publish'
					);
			$this->mobile_model->simple_insert(ORDER_COMMENTS,$postArr);
			
			/*mailing process starts here*/
			$newsid='22';
			$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
			$subject = 'From: '.$this->config->item('email_title');
			$discussionurl=base_url().'discussion/'.$orderid;
			$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
			extract($adminnewstemplateArr);
			$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
					
			$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');	
			$message .= '</body>
			</html>';
			$email_values = array('mail_type'=>'html',
						'from_mail_id'=>$sender_email,
						'mail_name'=>$sender_name,
						'to_mail_id'=>$receive_email,
						'cc_mail_id'=>$ccmail,
						'subject_message'=>'Dispute Mail',
						'body_messages'=>$message
						);
			$email_send_to_common = $this->mobile_model->common_email_send($email_values);
		
			/*mailing process starts here for buyers*/
			$newsid='23';
			$message ="";
			$template_values=$this->mobile_model->get_newsletter_template_details($newsid);
			$subject = 'From: '.$this->config->item('email_title');
			$discussionurl=base_url().'discussion/'.$orderid;
			$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
			extract($adminnewstemplateArr);
			$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";					
			$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');	
			$message .= '</body>
			</html>';
			$email_values_buyer = array('mail_type'=>'html',
						'from_mail_id'=>$this->data['siteContactMail'],
						'mail_name'=>$this->data['siteTitle'].' Admin',			
						'to_mail_id'=>$this->data['selleremaill']->row()->email,		
						'subject_message'=>'Dispute Mail',
						'body_messages'=>$message
						);
			$email_send_to_common = $this->mobile_model->common_email_send($email_values_buyer);			
			$json_encode = json_encode(array("status"=>(string)1,"message"=>"Successfully request sent to admin"));	
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Error while sending request"));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * seller Country List
	 */
	public function country_list() {		
		$countryList=$this->mobile_model->get_all_details(COUNTRY_LIST,array('status' => 'Active'));
		$countryArr=array();
		foreach($countryList->result() as $country){
			$countryArr[]=array('id'=>$country->id,
								'country_name'=>$country->name,
								'country_seourl'=>$country->seourl);
		}
		$json_encode = json_encode(array("countryList" =>$countryArr));
		echo $this->cleanString($json_encode);		
	}
	
	
	/** 
	 * 
	 * Display SearchPage Json
	 */
	public function searchpage(){
		$value=(string)$_GET['value']; ### Search Key
		$sellID = $_GET['sellerId'];
		
		$page=intval($_GET['pageId']);		
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
			
		$sellerId=intval($_GET['sellerId']);	
		$Listings=array();
		
		$this->db->from(PRODUCT.' as p');
		$this->db->where('p.user_id',$sellerId);
		$this->db->where('p.product_name like "%'.$value.'%"');
		$this->db->order_by('id','desc');
		$this->db->limit($postnumbers,$offset);	
		$productList = $this->db->get();
			
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);			
			$price= number_format($this->data["currencyValue"]*$ProdList->base_price,2);
			if($ProdList->quantity>0){
				$stock="In Stock";
				$quantity=$ProdList->quantity;
			}else{
				$stock="Out Stock";
				$quantity=0;
			}
														
			$Listings[] = array("productId" => $ProdList->id,
											"productName" => $ProdList->product_name,
											"Image" => 'images/product/mb/'.$img[0],
											"Price" =>$price,
											"Status"=> (string)$ProdList->status,
											"Stock"=> (string)$stock,
											"quantity"=> (string)$quantity
											);
		}
			
		
		$json_encode = json_encode(array("status"=>(string)1,"Listings"=>$Listings,"totalListings"=>(string)$productList->num_rows(),"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"pagePos"=> (string)$page));		
		
		
		echo $this->cleanString($json_encode);
	}
	
	
	
	/** 
	 * 
	 * Display Product Details Json
	 */
	public function productdetails() {
		$productid=intval($_GET['pid']); ### Product Id
		$sellerid=intval($_GET['sid']); ### Seller Id
		
		$this->db->select('p.id,p.description,p.product_name,p.image,p.price,p.base_price,p.created as listed_on,p.quantity as listing_no,p.user_id,p.status,p.view_count as views,s.seller_businessname as companyname,s.seourl as visitshop,s.seller_id as shopId,p.ship_duration,s.payment_policy,s.shipping_policy,s.refund_policy,s.welcome_message,s.additional_information,s.seller_information,p.seourl');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','Active');
		$this->db->where('p.id',$productid);
		if($sellerid!=''){
			$this->db->where('p.user_id',$sellerid);
		}
		$productDetail = $this->db->get();
		
		$userDetails=$this->mobile_model->get_all_details(USERS,array('id' => $productDetail->row()->user_id)); 
		
		$this->db->select('u.thumbnail as thumbnail,u.full_name as fullname,u.last_name as last_name,f.dateAdded,f.description,f.rating,p.image');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_FEEDBACK.' as f' , 'f.seller_product_id = p.id','inner');
		$this->db->join(USERS.' as u' , 'u.id = f.voter_id','inner');
		$this->db->order_by('f.id','desc');
		$this->db->where('f.status','Active');
		$this->db->where('f.seller_product_id',$productid);
		$reviwes = $this->db->get();
		
		$this->db->select('ss.ship_name,ss.ship_cost,ss.ship_other_cost');
		$this->db->from(SUB_SHIPPING.' as ss');
		$this->db->where('ss.product_id',$productid);
		$shipping = $this->db->get();
		
		
		$this->db->select('*');
		$this->db->from(SUBPRODUCT);
		$this->db->group_by('attr_name');
		$this->db->order_by('pricing','desc');
		$this->db->where('product_id',$productid);
		$variation=$this->db->get()->result();
		
		$this->db->select(FAVORITE.'.*');
		$this->db->from(FAVORITE);
		$this->db->where('p_id',$productid);
		$favorites = $this->db->get();
		
			$values='';$values2='';
			$pricing='';$pricing2='';
		
			if(count($variation)==0){
				$variations_one="";
				$variations_two="";
				$variations_one_list="";
				$variations_two_list="";
				$variations_one_pricing="";
				$variations_two_pricing="";
			}
			if(count($variation)==1){
				$variations_one=$variation[0]->attr_name;
				$variations_two="";
					$this->db->select('*');
					$this->db->from(SUBPRODUCT);
					$this->db->where('product_id',$productid);
					$this->db->where('attr_name',$variations_one);
					$this->db->where('stock_status',1);
					$variations_one_values=$this->db->get();
					foreach($variations_one_values->result() as $rowone) {
						$values.=$rowone->attr_value.',';
						$pricing.=$rowone->pricing.',';
					}
					$variations_one_list=rtrim($values,',');
					$variations_two_list="";
					$variations_one_pricing=rtrim($pricing,',');
					$variations_two_pricing="";
			}
			if(count($variation)==2){
				$variations_one=$variation[0]->attr_name;
				$variations_two=$variation[1]->attr_name;
					$this->db->select('*');
					$this->db->from(SUBPRODUCT);
					$this->db->where('product_id',$productid);
					$this->db->where('attr_name',$variations_one);
					$this->db->where('stock_status',1);
					$variations_one_values=$this->db->get();
					
					$this->db->select('*');
					$this->db->from(SUBPRODUCT);
					$this->db->where('product_id',$productid);
					$this->db->where('attr_name',$variations_two);
					$this->db->where('stock_status',1);
					$variations_two_values=$this->db->get();		
					foreach($variations_one_values->result() as $rowone) {
						$values.=$rowone->attr_value.',';
						$pricing.=$rowone->pricing.',';
					}
					foreach($variations_two_values->result() as $rowtwo) {
						$values2.=$rowtwo->attr_value.',';
						$pricing2.=$rowone->pricing.',';
					}
					$variations_one_list=rtrim($values,',');
					$variations_two_list=rtrim($values2,',');
					$variations_one_pricing=rtrim($pricing,',');
					$variations_two_pricing="";
			}
		$price=$productDetail->row()->price;
		if($productDetail->row()->price==0.00){
			$price=$variation[0]->pricing;
		}
		$imgArr=@explode(',',$productDetail->row()->image);
		
		$choiceArr[] = array("choicename1" =>$variations_one,
											"choicelist1" => $variations_one_list,
											"choiceprice1" => $variations_one_pricing,
											"choicename2" =>$variations_two,
											"choicelist2" => $variations_two_list,
											"choiceprice2" => $variations_two_pricing,);
		$reviewArr=array();
		if($reviwes->num_rows() == 0){
			$reviewCount=0;
			$reviewArr[] = array("reviewerphoto" => '',
												"reviewername" =>'',
												"reviewerdate" =>'',
												"reviewProduct"=>"",
												"reviewerating" =>'',
												"reviewercomment" => '');
		} else {
			$rc=0;
			foreach($reviwes->result() as $review) {
				$rc++;
				if($rc>3){
					break;
				}else{
					$img=explode(',',$review->image);
					$reviewCount=$rc;
					$reviewername=$review->fullname.' '.$review->last_name;
					$reviewArr[] = array("reviewerphoto" => 'images/users/thumb/'.$review->thumbnail,
													"reviewername" => $reviewername,
													"reviewerdate" =>date("Y-m-d",strtotime($review->dateAdded)),
													"reviewProduct" => 'mb/'.$img[0],
													"reviewerating" =>(string)$review->rating,
													"reviewercomment" => $review->description);
				}
			}
		}
		
		$shippingArr=array();
		if($shipping->num_rows() == 0){
			$shippingArr[] = array("country" =>'',
												"cost" =>'',
												"withother" => '');
		} else {
			foreach($shipping->result() as $ship) {
				$shippingArr[] = array("country" =>$ship->ship_name,
													"cost" =>(string)$ship->ship_cost,
													"withother" =>(string)$ship->ship_other_cost);
			}
		}
		
		
		$policyArr=array();
		$policyStatus=0;
		if($productDetail->row()->payment_policy!="" || $productDetail->row()->shipping_policy!="" || $productDetail->row()->refund_policy!="" || $productDetail->row()->welcome_message!="" || $productDetail->row()->additional_information!="" || $productDetail->row()->seller_information!=""){
			$policyStatus=1;
			$policyArr[] = array("Payment" =>(string)strip_tags(stripslashes($productDetail->row()->payment_policy)),
											"Shipping" =>(string)strip_tags(stripslashes($productDetail->row()->shipping_policy)),
											"refund" =>(string)strip_tags(stripslashes($productDetail->row()->refund_policy)),
											"additionalInformation" =>(string)strip_tags(stripslashes($productDetail->row()->additional_information)),
											"sellerInformation" =>(string)strip_tags(stripslashes($productDetail->row()->seller_information)),
											"welcome" =>(string)strip_tags(stripslashes($productDetail->row()->welcome_message)));
		}
		
		$detailspage[] = array("productid"=>(string)$productid,
											"productshareUrl"=>(string)base_url()."products/".$productDetail->row()->seourl,
											"productshareTitle"=>(string)$productDetail->row()->product_name." by ".$productDetail->row()->companyname." on ".$this->config->item('email_title'),
											"price"=>$price,
											"displayPrice"=>(string)number_format($this->data["currencyValue"]*$price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"description"=>strip_tags(stripslashes($productDetail->row()->description)),
											"companyname"=>$productDetail->row()->companyname,
											"visitshop"=>$productDetail->row()->visitshop,
											"shopId"=>$productDetail->row()->shopId,
											"totalreviewCount"=>(string)$reviwes->num_rows(),
											"reviewCount"=>(string)$reviewCount,
											"reviwes"=>$reviewArr,
											"readytoShip"=>(string)$productDetail->row()->ship_duration,
											"shipping"=>$shippingArr,
											"policyStatus"=>$policyStatus,
											"policy"=>$policyArr,
											"shortdescription"=>strip_tags(stripslashes($productDetail->row()->description)),
											"image1"=>'mb/'.$imgArr[0],
											"image2"=>'mb/'.$imgArr[1],
											"image3"=>'mb/'.$imgArr[2],
											"image4"=>'mb/'.$imgArr[3],
											"choice"=>$choiceArr,
											"listed_on"=>$productDetail->row()->listed_on,
											"listing_no"=>$productDetail->row()->listing_no,
											"views"=>$productDetail->row()->views,
											"favorites"=>(string)$favorites->num_rows(),
											'profile_image'=> 'images/users/thumb/'.$userDetails->row()->thumbnail);
		#echo '<pre>'; print_r($detailspage); die;
		
		$json_encode = json_encode(array("detailspage" => $detailspage,"cartCount"=>(string)$this->data["cartCount"]));
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Display Edit Product Details Json
	 */
	public function editproduct() {
		$productid=intval($_GET['pid']); ### Product Id
		$sellerid=intval($_GET['sid']); ### Seller Id
		$prdDetails=array();
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerid),$sellerCol);
		$prdDetails=array();
		if($sellerCheck->num_rows()>0){
		
			$this->db->select('p.id,p.description,p.product_name,p.image,p.price,p.base_price,p.materials,p.quantity,p.user_id,p.status,p.tag,s.seller_businessname as companyname,s.seller_id as shopId,p.ship_duration,p.seourl,p.made_by,p.product_condition,p.maked_on,p.category_id,p.ship_from');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
			$this->db->where('p.id',$productid);
			if($sellerid!=''){
				$this->db->where('p.user_id',$sellerid);
			}
			$productDetail=$this->db->get();
			
			
			if($productDetail->num_rows()>0){
				$userDetails=$this->mobile_model->get_all_details(USERS,array('id' =>$productDetail->row()->user_id)); 
						
				$this->db->select('ss.ship_name,ss.ship_cost,ss.ship_other_cost,ss.ship_id');
				$this->db->from(SUB_SHIPPING.' as ss');
				$this->db->where('ss.product_id',$productid);
				$shipping = $this->db->get();
				
				
				$this->db->select('pid');
				$this->db->from(SUBPRODUCT);
				/* $this->db->group_by('attr_name');
				$this->db->order_by('pricing','desc'); */
				$this->db->where('product_id',$productid);
				$variation=$this->db->get();
				
				
				$editable='Yes';
				if($variation->num_rows()>0){
					$editable='No';
				}
					
				$catArr=@explode(',',$productDetail->row()->category_id);
				
				$cat1 = ($catArr[0]=='') ? '' : $catArr[0];
				$cat2 = ($catArr[1]=='') ? '' : $catArr[1];
				$cat3 = ($catArr[2]=='') ? '' : $catArr[2];
				
				if($cat1!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat1);
					$category=$this->db->get();
					$catName1=$category->row()->cat_name;
				}else{
					$catName1="";
				}
				if($cat2!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat2);
					$category=$this->db->get();
					$catName2=$category->row()->cat_name;
				}else{
					$catName2="";
				}
				if($cat3!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat3);
					$category=$this->db->get();
					$catName3=$category->row()->cat_name;
				}else{
					$catName3="";
				}
				
				
				$imgArr=@explode(',',$productDetail->row()->image);
				
				$image1 = ($imgArr[0]=='') ? '' : 'mb/'.$imgArr[0];
				$image2 = ($imgArr[1]=='') ? '' : 'mb/'.$imgArr[1];
				$image3 = ($imgArr[2]=='') ? '' : 'mb/'.$imgArr[2];
				$image4 = ($imgArr[3]=='') ? '' : 'mb/'.$imgArr[3];
				$image5 = ($imgArr[4]=='') ? '' : 'mb/'.$imgArr[4];
				
				
				$shippingArr=array();
				if($shipping->num_rows() == 0){
					$shippingArr[] = array("country" =>'',
														"id" =>'',
														"cost" =>'',
														"withother" => '');
				} else {
					foreach($shipping->result() as $ship) {
						$shippingArr[] = array("country" =>$ship->ship_name,
															"id" =>(string)$ship->ship_id,
															"cost" =>(string)$ship->ship_cost,
															"withother" =>(string)$ship->ship_other_cost);
					}
				}
				
				
				$prdDetails[] = array("productid"=>(string)$productid,
													"productshareUrl"=>(string)base_url()."products/".$productDetail->row()->seourl,
													"productshareTitle"=>(string)$productDetail->row()->product_name." by ".$productDetail->row()->companyname." on ".$this->config->item('email_title'),
													"image1"=>$image1,
													"image2"=>$image2,
													"image3"=>$image3,
													"image4"=>$image4,
													"image5"=>$image5,
													"currencySymbol" =>"$",
													"currencyCode" =>"USD",
													"title"=>$productDetail->row()->product_name,
													"price"=>$productDetail->row()->base_price,
													"quantity"=>$productDetail->row()->quantity,
													"description"=>strip_tags(stripslashes($productDetail->row()->description)),
													"tags"=>strip_tags(stripslashes($productDetail->row()->tag)),
													"material"=>strip_tags(stripslashes($productDetail->row()->materials)),
													"readytoShip"=>(string)$productDetail->row()->ship_duration,
													"ship_from"=>(string)$productDetail->row()->ship_from,
													"shipping"=>$shippingArr,
													"about_1"=>(string)$productDetail->row()->made_by,
													"about_2"=>(string)$productDetail->row()->product_condition,
													"about_3"=>(string)$productDetail->row()->maked_on,
													"cat1"=>$cat1,
													"cat2"=>$cat2,
													"cat3"=>$cat3,
													"catName1"=>$catName1,
													"catName2"=>$catName2,
													"catName3"=>$catName3,
													"editable"=>$editable);
				#echo '<pre>'; print_r($prdDetails); die;
				$json_encode = json_encode(array("status"=>(string)1,"prdDetails"=>$prdDetails));	
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Display Copy Product Details Json
	 */
	public function copyproduct() {
		$productid=intval($_GET['pid']);
		$sellerid=intval($_GET['sid']);
		$prdDetails=array();
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerid),$sellerCol);
		$prdDetails=array();
		if($sellerCheck->num_rows()>0){
			$this->db->select('p.id,p.description,p.product_name,p.image,p.price,p.base_price,p.materials,p.quantity,p.user_id,p.status,p.tag,s.seller_businessname as companyname,s.seller_id as shopId,p.ship_duration,p.seourl,p.made_by,p.product_condition,p.maked_on,p.category_id,p.ship_from');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
			$this->db->where('p.id',$productid);
			if($sellerid!=''){
				$this->db->where('p.user_id',$sellerid);
			}
			$productDetail=$this->db->get();
			
			
			if($productDetail->num_rows()>0){
				$userDetails=$this->mobile_model->get_all_details(USERS,array('id' =>$productDetail->row()->user_id)); 
						
				$this->db->select('ss.ship_name,ss.ship_cost,ss.ship_other_cost,ss.ship_id');
				$this->db->from(SUB_SHIPPING.' as ss');
				$this->db->where('ss.product_id',$productid);
				$shipping = $this->db->get();
				
				
				$this->db->select('pid');
				$this->db->from(SUBPRODUCT);
				/* $this->db->group_by('attr_name');
				$this->db->order_by('pricing','desc'); */
				$this->db->where('product_id',$productid);
				$variation=$this->db->get();
				
				$copyable='Yes';
				if($variation->num_rows()>0){
					$copyable='No';
				}
					
				$catArr=@explode(',',$productDetail->row()->category_id);
				
				$cat1 = ($catArr[0]=='') ? '' : $catArr[0];
				$cat2 = ($catArr[1]=='') ? '' : $catArr[1];
				$cat3 = ($catArr[2]=='') ? '' : $catArr[2];
				
				if($cat1!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat1);
					$category=$this->db->get();
					$catName1=$category->row()->cat_name;
				}else{
					$catName1="";
				}
				if($cat2!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat2);
					$category=$this->db->get();
					$catName2=$category->row()->cat_name;
				}else{
					$catName2="";
				}
				if($cat3!=""){
					$this->db->select('cat_name');
					$this->db->from(CATEGORY);
					$this->db->where('id',$cat3);
					$category=$this->db->get();
					$catName3=$category->row()->cat_name;
				}else{
					$catName3="";
				}
				
				$imgArr=@explode(',',$productDetail->row()->image);
				
				$image1 = ($imgArr[0]=='') ? '' : 'mb/'.$imgArr[0];
				$image2 = ($imgArr[1]=='') ? '' : 'mb/'.$imgArr[1];
				$image3 = ($imgArr[2]=='') ? '' : 'mb/'.$imgArr[2];
				$image4 = ($imgArr[3]=='') ? '' : 'mb/'.$imgArr[3];
				$image5 = ($imgArr[4]=='') ? '' : 'mb/'.$imgArr[4];
				
				
				$shippingArr=array();
				if($shipping->num_rows() == 0){
					$shippingArr[] = array("country" =>'',
														"id" =>'',
														"cost" =>'',
														"withother" => '');
				} else {
					foreach($shipping->result() as $ship) {
						$shippingArr[] = array("country" =>$ship->ship_name,
															"id" =>(string)$ship->ship_id,
															"cost" =>(string)$ship->ship_cost,
															"withother" =>(string)$ship->ship_other_cost);
					}
				}
				
				
				$prdDetails[] = array("image1"=>$image1,
													"image2"=>$image2,
													"image3"=>$image3,
													"image4"=>$image4,
													"image5"=>$image5,
													"currencySymbol" =>"$",
													"currencyCode" =>"USD",
													"title"=>"",
													"price"=>$productDetail->row()->base_price,
													"quantity"=>$productDetail->row()->quantity,
													"description"=>strip_tags(stripslashes($productDetail->row()->description)),
													"tags"=>strip_tags(stripslashes($productDetail->row()->tag)),
													"material"=>strip_tags(stripslashes($productDetail->row()->materials)),
													"readytoShip"=>(string)$productDetail->row()->ship_duration,
													"ship_from"=>(string)$productDetail->row()->ship_from,
													"shipping"=>$shippingArr,
													"about_1"=>(string)$productDetail->row()->made_by,
													"about_2"=>(string)$productDetail->row()->product_condition,
													"about_3"=>(string)$productDetail->row()->maked_on,
													"cat1"=>$cat1,
													"cat2"=>$cat2,
													"cat3"=>$cat3,
													"catName1"=>$catName1,
													"catName2"=>$catName2,
													"catName3"=>$catName3,
													"copyable"=>$copyable);
				$json_encode = json_encode(array("status"=>(string)1,"prdDetails"=>$prdDetails));	
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
		}
		echo $this->cleanString($json_encode);
	}
	
	/** 
	 * 
	 * Shop Reviews
	 */	
	public function reviewList() {
		$sellerId=intval($_GET['sellerId']);
		$page=intval($_GET['pageId']);		
		$pagePos = $page +1;
		$perpage=20;
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
		}		
		$sellerCol="`id`,`seller_id`,`shop_ratting`,`review_count`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$Reviews=array();
		if($sellerCheck->num_rows()>0){
			$this->mobile_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE activity_id =".$sellerId." AND (activity='review' OR activity='review-update')");
			
			
			$reviewList = $this->mobile_model->get_shop_feed_details($sellerId,$postnumbers,$offset);	
			foreach($reviewList->result() as $row) {
				if($row->thumbnail!=""){
					$userImage=base_url().'images/users/thumb/'.$row->thumbnail;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$imgArr=@explode(',',$row->image);				
				$productImage = ($imgArr[0]=='') ? '' : base_url().'images/product/mb/'.$imgArr[0];
				
				$reportList = $this->mobile_model->get_feed_report_details($row->id);
				$reportArr=array();
				if($reportList->num_rows()>0){
					$reportCount=$reportList->num_rows();
					foreach($reportList->result() as $report) {
						$reportArr[]=array("reportTime"=>date("M d,Y",strtotime($report->report_time)),
														"reportMsg"=>(string)$report->description
														);
					}
				}
				
				$Reviews[]=array("reviewDate"=>date("M d,Y",strtotime($row->dateAdded)),
											"voteId"=>(string)$row->id,
											"voterId"=>(string)$row->userId,
											"voterName"=>(string)$row->userName,
											"voterImage"=>$userImage,
											"voterEmail"=>(string)$row->userEmail,
											"productId"=>(string)$row->productId,
											"productImage"=>(string)$productImage,
											"productName"=>(string)$row->product_name,
											"starRating"=>(string)$row->rating,
											"description"=>(string)$row->description,
											"reportCount"=>(string)$reportCount,
											"reportVal"=>$reportArr
											);
			}
			
			$json_encode = json_encode(array("status"=>(string)1,
																		"totalRating"=>(string)$sellerCheck->row()->review_count,
																		"totalStar"=>(string)$sellerCheck->row()->shop_ratting,
																		"Reviews"=>$Reviews,
																		"totalReview"=>(string)$reviewList->num_rows(),"pagePos"=> (string)$pagePos));		
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"totalRating"=>(string)0,"totalStar"=>(string)0,"Reviews"=>$Reviews,"totalReview"=>(string)0,"pagePos"=> (string)$pagePos));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * Report Review
	 */	
	public function reportReview() {
		$sellerId=intval($_GET['sellerId']);	
		$voteId=intval($_GET['voteId']);
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){			
			$selectCols="`id`,`voter_id`";	
			$feedbackVal = $this->mobile_model->get_column_details(PRODUCT_FEEDBACK,array('id' => $voteId),$selectCols);
			
			$voter_id=$feedbackVal->row()->voter_id;
			$selectCol="`id`,`user_name`,`email`";		
			$voterVal = $this->mobile_model->get_column_details(USERS,array('id'=>$voter_id),$selectCol);
			$sellerVal = $this->mobile_model->get_column_details(USERS,array('id'=>$sellerId),$selectCol);
			
			if($voterVal->num_rows()>0 && $sellerVal->num_rows()>0){
				$description=$_POST['description'];
				$dataArray=array('reporter_id' =>$sellerVal->row()->id ,
												'reporter_email' => $sellerVal->row()->id,
												'reviewer_id'=>$voterVal->row()->id,
												'reviewer_email'=>$voterVal->row()->email, 
												'review_id' => $voteId, 
												'description' => $description,
												'report_time' => date("Y-m-d H:i:s")
											);
				if($description!=""){
					$this->mobile_model->simple_insert(REPORT_REVIEW,$dataArray);
					$json_encode = json_encode(array("status"=>(string)1,"message"=>'Reported Successfully'));
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>'Description Required'));
				}
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>'Records Not Available'));		
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));	
		}
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * Coupon code  starts Here
	 */	
	public function viewCoupon() {
		$sellerId=intval($_GET['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){
			$id=$sellerCheck->row()->seller_id;
			$listCoupon = $this->mobile_model->get_all_details(COUPONCARDS,array('sell_id'=>$id));
			$dataArr=array();
				foreach($listCoupon->result() as $values){
					$remain= $values->quantity-$values->purchase_count;
					$dateto=$values->dateto;
					if($dateto < date('Y-m-d',strtotime("now"))){
						$cardStatus='Expired';	
					}else{
						$cardStatus='Redeemed';
					}
					
					$dataArr[]=array('id'				=>	$values->id,
												'seller_id'		=>	$values->sell_id,
												'code'				=>	$values->code,
												'value'				=>	$values->price_value,
												'remain'			=>	$remain,
												'purchased'	=>	$values->purchase_count,
												'datefrom'		=>	$values->datefrom,
												'dateto'			=>	$values->dateto,
												'cardStatus'	=>	$cardStatus
												);
				}
				
			$json_encode = json_encode(array("status"=>(string)1,"coupon List"=>$dataArr));	
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));
		}
		echo $this->cleanString($json_encode);
	}
	public function getCoupon() {
		$sellerId=intval($_GET['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){			
			$code = $this->get_rand_str('10');
			$couponCol = "`code`";
			$checkCode = $this->mobile_model->get_column_details(COUPONCARDS,array('code'=>$code),$couponCol);
				if($checkCode->num_rows() == 0) {
					$json_encode = json_encode(array("status"=>(string)1,"seller_id"=>$sellerId,"code"=>$code));
				}else{
						$this->getCoupon();
					}
		}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));	
		}
		echo $this->cleanString($json_encode);
	}

	public function saveCoupon(){
		$sellerId=intval($_GET['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){	
			$code=$this->input->post('code');
			$quantity=$this->input->post('quantity');
			$validFrom=$this->input->post('valid_from');
			$validTill=$this->input->post('valid_till');
			$priceValue=$this->input->post('price_value');
			$description=$this->input->post('description');
			$status=$this->input->post('status');
			
			$dataArr=array('code' 			=> 	$code,
										'price_type' 	=> 	'2',
										'sell_id' 			=> 	$sellerId,
										'price_value' 	=> 	$priceValue,
										'quantity' 		=> 	$quantity,
										'description' 	=> 	$description,
										'datefrom' 		=> 	$validFrom,
										'dateto' 			=> 	$validTill,
										'status' 			=> 	$status
										);
				if($code!=''){
					$this->mobile_model->simple_insert(COUPONCARDS,$dataArr);	
					$json_encode = json_encode(array("status"=>(string)1,"message"=>'Coupon Card Created Successfully'));		
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>'Coupon code Required'));
				}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));
		}
		echo $this->cleanString($json_encode);
	}
	
	public function editCoupon(){
		$sellerId=intval($_GET['sellerId']);	
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		if($sellerCheck->num_rows()>0){	
			//$code=$this->input->post('code');
			$code=$_GET['code'];
			$couponCol="`id`,`code`,`sell_id`,`price_value`,`quantity`,`description`,`datefrom`,`dateto`,`status`";
			$checkCoupon = $this->mobile_model->get_column_details(COUPONCARDS,array('sell_id'=>$sellerId,'code'=>$code),$couponCol);
				if($checkCoupon->num_rows() > 0){
					$dataArr=array('id'					=>	$checkCoupon->row()->id,
												'seller_id'		=>	$checkCoupon->row()->sell_id,
												'code'				=>	$checkCoupon->row()->code,
												'validFrom'	=>	$checkCoupon->row()->datefrom,
												'validTill'			=>	$checkCoupon->row()->dateto,
												'priceValue'	=>	$checkCoupon->row()->price_value,
												'description'	=>	$checkCoupon->row()->description,
												'status'			=>	$checkCoupon->row()->status
												);
					$json_encode=json_encode(array("status"=>(string)1,"coupon List"=>$dataArr));			
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>'Coupon code Not found'));
				}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));	
		}
		echo $this->cleanString($json_encode);	
	}
	/** 
	 * 
	 * Coupon code  Ends Here
	 */
	 public function cleanString($orig_text) {
		$text = $orig_text;
		// Single letters
		$text = preg_replace("/[∂άαáàâãªä]/u",      "a", $text);
		$text = preg_replace("/[∆лДΛдАÁÀÂÃÄ]/u",     "A", $text);
		$text = preg_replace("/[ЂЪЬБъь]/u",           "b", $text);
		$text = preg_replace("/[βвВ]/u",            "B", $text);
		$text = preg_replace("/[çς©с]/u",            "c", $text);
		$text = preg_replace("/[ÇС]/u",              "C", $text);        
		$text = preg_replace("/[δ]/u",             "d", $text);
		$text = preg_replace("/[éèêëέëèεе℮ёєэЭ]/u", "e", $text);
		$text = preg_replace("/[ÉÈÊË€ξЄ€Е∑]/u",     "E", $text);
		$text = preg_replace("/[₣]/u",               "F", $text);
		$text = preg_replace("/[НнЊњ]/u",           "H", $text);
		$text = preg_replace("/[ђћЋ]/u",            "h", $text);
		$text = preg_replace("/[ÍÌÎÏ]/u",           "I", $text);
		$text = preg_replace("/[íìîïιίϊі]/u",       "i", $text);
		$text = preg_replace("/[Јј]/u",             "j", $text);
		$text = preg_replace("/[ΚЌК]/u",            'K', $text);
		$text = preg_replace("/[ќк]/u",             'k', $text);
		$text = preg_replace("/[ℓ∟]/u",             'l', $text);
		$text = preg_replace("/[Мм]/u",             "M", $text);
		$text = preg_replace("/[ñηήηπⁿ]/u",            "n", $text);
		$text = preg_replace("/[Ñ∏пПИЙийΝЛ]/u",       "N", $text);
		$text = preg_replace("/[óòôõºöοФσόо]/u", "o", $text);
		$text = preg_replace("/[ÓÒÔÕÖθΩθОΩ]/u",     "O", $text);
		$text = preg_replace("/[ρφрРф]/u",          "p", $text);
		$text = preg_replace("/[®яЯ]/u",              "R", $text); 
		$text = preg_replace("/[ГЃгѓ]/u",              "r", $text); 
		$text = preg_replace("/[Ѕ]/u",              "S", $text);
		$text = preg_replace("/[ѕ]/u",              "s", $text);
		$text = preg_replace("/[Тт]/u",              "T", $text);
		$text = preg_replace("/[τ†‡]/u",              "t", $text);
		$text = preg_replace("/[úùûüџμΰµυϋύ]/u",     "u", $text);
		$text = preg_replace("/[√]/u",               "v", $text);
		$text = preg_replace("/[ÚÙÛÜЏЦц]/u",         "U", $text);
		$text = preg_replace("/[Ψψωώẅẃẁщш]/u",      "w", $text);
		$text = preg_replace("/[ẀẄẂШЩ]/u",          "W", $text);
		$text = preg_replace("/[ΧχЖХж]/u",          "x", $text);
		$text = preg_replace("/[ỲΫ¥]/u",           "Y", $text);
		$text = preg_replace("/[ỳγўЎУуч]/u",       "y", $text);
		$text = preg_replace("/[ζ]/u",              "Z", $text);

		// Punctuation
		$text = preg_replace("/[‚‚]/u", ",", $text);        
		$text = preg_replace("/[`‛′’‘]/u", "'", $text);
		$text = preg_replace("/[″“”«»„]/u", '"', $text);
		$text = preg_replace("/[—–―−–‾⌐─↔→←]/u", '-', $text);
		$text = preg_replace("/[  ]/u", ' ', $text);

		$text = str_replace("…", "...", $text);
		$text = str_replace("≠", "!=", $text);
		$text = str_replace("≤", "<=", $text);
		$text = str_replace("≥", ">=", $text);
		$text = preg_replace("/[‗≈≡]/u", "=", $text);


		// Exciting combinations    
		$text = str_replace("ыЫ", "bl", $text);
		$text = str_replace("℅", "c/o", $text);
		$text = str_replace("₧", "Pts", $text);
		$text = str_replace("™", "tm", $text);
		$text = str_replace("№", "No", $text);        
		$text = str_replace("Ч", "4", $text);                
		$text = str_replace("‰", "%", $text);
		$text = preg_replace("/[∙•]/u", "*", $text);
		$text = str_replace("‹", "<", $text);
		$text = str_replace("›", ">", $text);
		$text = str_replace("‼", "!!", $text);
		$text = str_replace("⁄", "/", $text);
		$text = str_replace("∕", "/", $text);
		$text = str_replace("⅞", "7/8", $text);
		$text = str_replace("⅝", "5/8", $text);
		$text = str_replace("⅜", "3/8", $text);
		$text = str_replace("⅛", "1/8", $text);        
		$text = preg_replace("/[‰]/u", "%", $text);
		$text = preg_replace("/[Љљ]/u", "Ab", $text);
		$text = preg_replace("/[Юю]/u", "IO", $text);
		$text = preg_replace("/[ﬁﬂ]/u", "fi", $text);
		$text = preg_replace("/[зЗ]/u", "3", $text); 
		$text = str_replace("£", "(pounds)", $text);
		$text = str_replace("₤", "(lira)", $text);
		$text = preg_replace("/[‰]/u", "%", $text);
		$text = preg_replace("/[↨↕↓↑│]/u", "|", $text);
		$text = preg_replace("/[∞∩∫⌂⌠⌡]/u", "", $text);


		//2) Translation CP1252.
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans['f'] = '&fnof;';    // Latin Small Letter F With Hook
		$trans['-'] = array(
			'&hellip;',     // Horizontal Ellipsis
			'&tilde;',      // Small Tilde
			'&ndash;'       // Dash
			);
		$trans["+"] = '&dagger;';    // Dagger
		$trans['#'] = '&Dagger;';    // Double Dagger         
		$trans['M'] = '&permil;';    // Per Mille Sign
		$trans['S'] = '&Scaron;';    // Latin Capital Letter S With Caron        
		$trans['OE'] = '&OElig;';    // Latin Capital Ligature OE
		$trans["'"] = array(
			'&lsquo;',  // Left Single Quotation Mark
			'&rsquo;',  // Right Single Quotation Mark
			'&rsaquo;', // Single Right-Pointing Angle Quotation Mark
			'&sbquo;',  // Single Low-9 Quotation Mark
			'&circ;',   // Modifier Letter Circumflex Accent
			'&lsaquo;'  // Single Left-Pointing Angle Quotation Mark
			);

		$trans['"'] = array(
			'&ldquo;',  // Left Double Quotation Mark
			'&rdquo;',  // Right Double Quotation Mark
			'&bdquo;',  // Double Low-9 Quotation Mark
			);

		$trans['*'] = '&bull;';    // Bullet
		$trans['n'] = '&ndash;';    // En Dash
		$trans['m'] = '&mdash;';    // Em Dash        
		$trans['tm'] = '&trade;';    // Trade Mark Sign
		$trans['s'] = '&scaron;';    // Latin Small Letter S With Caron
		$trans['oe'] = '&oelig;';    // Latin Small Ligature OE
		$trans['Y'] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
		$trans['euro'] = '&euro;';    // euro currency symbol
		ksort($trans);

		foreach ($trans as $k => $v) {
			$text = str_replace($v, $k, $text);
		}

		// 3) remove <p>, <br/> ...
		$text = strip_tags($text);

		// 4) &amp; => & &quot; => '
		$text = html_entity_decode($text);


		// transliterate
		// if (function_exists('iconv')) {
		// $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// }

		// remove non ascii characters
		// $text =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $text);      

		return $text;
	}
	
}

/* End of file sellerapp.php */
/* Location: ./application/controllers/site/sellerapp.php */