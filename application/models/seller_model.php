<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to seller requests
 * @author Teamtweaks
 *
 */
class Seller_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Sellers details
    * @param String $condition	
    */

    public function get_sellers_data($tbl,$condition=''){
   		$this->db->select('*');
		$this->db->from(SELLER);
		$this->db->where('seller_id',$this->session->userdata('shopsy_session_user_id'));
		$referQuery = $this->db->get();
		#echo $this->db->last_query();#die;
		#echo "<pre>";print_r( $referResult = $referQuery->result_array());die;
		return $referResult = $referQuery->result_array();
		
   }
   
   /**
    * 
    * Getting Sellers shop name
    * @param String $condition	
    */
   public function get_shop_name($condition=''){
   		$this->db->select('seller_businessname');
		$this->db->from(SELLER);
		$this->db->where('seller_businessname',$condition);
		$this->db->where('seller_id !=',$this->session->userdata('shopsy_session_user_id'));
		$referQuery = $this->db->get();
		return $referQuery;
		
   }
	
	/**
    * 
    * Getting Sellers data for product description
    * @param String $columns
    * @param String $sellerid	
	*
    */
 
   public function get_userselldetail_data($columns,$sellerid){
  // echo $sellerid; die;
   		$this->db->select($columns);
		$this->db->from(SELLER);
		
		$this->db->where('seller_id',$sellerid);
		
		$referQuery = $this->db->get();
	//echo $this->db->last_query(); die;
		
		return $referResult = $referQuery->result_array();
		
   }
   
   /**
    * 
    * Getting Shop details
    *
    */
   public function get_shop_details()
	{
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.SELLER.'.id as sellerId,'.SELLER.'.seller_businessname,'.FEEDBACK.'.*');
		$this->db->from(SELLER);
		$this->db->join(FEEDBACK,FEEDBACK.'.shop_id='.SELLER.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.FEEDBACK.'.voter_id','inner');
		$this->db->order_by(FEEDBACK.'.id','desc');
	return $feedback_query = $this->db->get();
	}
	
   /**
    * 
    * Getting Shop feed details
	* @param String $condition	
    *
    */
   public function get_shopfeed_details($condition='')
		{
	
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.SELLER.'.id as sellerId,'.SELLER.'.seller_businessname,'.FEEDBACK.'.*');
		$this->db->from(SELLER);
		$this->db->join(FEEDBACK,FEEDBACK.'.shop_id='.SELLER.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.FEEDBACK.'.voter_id','inner');
		$this->db->order_by(FEEDBACK.'.id','desc');
		$this->db->where(FEEDBACK.'.id',$condition);
	return $feedback_query = $this->db->get();
	
	}
   
   	/**
    * 
    * Getting Shop product feed details
	* @param String $condition	
	* @param String $status	
    *
    */
	public function get_shopproductfeed_details($condition='',$status='user')
	{
	
		$this->db->select(USERS.'.privacy,'.USERS.'.id as userId,'.USERS.'.user_name as userName,'.USERS.'.email as userEmail,'.USERS.'.thumbnail as thumbnail,'.USERS.'.full_name as fullname,'.USERS.'.last_name as last_name,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT.'.seourl as seo_url,'.PRODUCT_FEEDBACK.'.*,');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.seller_product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->join(SELLER,USERS.'.id='.SELLER.'.seller_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		if($status != 'owner'){
			$this->db->where(PRODUCT_FEEDBACK.'.status','Active');
		}
		$this->db->where(PRODUCT_FEEDBACK.'.shop_id',$condition);
		$feedback_query = $this->db->get();
		#echo $this->db->last_query(); die;
		return $feedback_query;
	
	}
   
	/**
    * 
    * Getting review report page
	* @param String $condition	
	*
    */
	public function get_reviewreport_details($condition=''){	
		$this->db->select(REPORT_REVIEW.'.reporter_id,'.REPORT_REVIEW.'.reviewer_id,'.REPORT_REVIEW.'.description as report_message,'.REPORT_REVIEW.'.reporter_id,'.REPORT_REVIEW.'.reporter_id,'.REPORT_REVIEW.'.report_time,'.PRODUCT_FEEDBACK.'.description as review_content,'.PRODUCT_FEEDBACK.'.rating as rating,'.PRODUCT_FEEDBACK.'.status as review_status,'.PRODUCT_FEEDBACK.'.id as review_id,'.PRODUCT.'.*,reporter.seller_businessname as shop_name,reporter.seourl as shop_url,reviewer.user_name as reviewer_name,reportuser.user_name as shopownerName');
		$this->db->from(REPORT_REVIEW);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.id='.REPORT_REVIEW.'.review_id','inner');
		$this->db->join(PRODUCT,PRODUCT.'.id='.PRODUCT_FEEDBACK.'.seller_product_id','inner');
		$this->db->join(SELLER.' as reporter','reporter.seller_id='.REPORT_REVIEW.'.reporter_id','inner');
		$this->db->join(USER.' as reportuser','reportuser.id=reporter.seller_id','inner');
		$this->db->join(USER.' as reviewer','reviewer.id='.REPORT_REVIEW.'.reviewer_id','inner');
		//$this->db->where(PRODUCT_FEEDBACK.'.status','Active');
		if($condition!=''){
		$this->db->where(PRODUCT_FEEDBACK.'.id',$condition);
		}
		$feedback_query = $this->db->get();
		#echo $this->db->last_query(); die;
		return $feedback_query;
	
	
	}
	
   
   /**
    * 
    * Getting user details data
	* @param String $columns	
	*
    */
    public function get_userdetail_data($columns){
   
   		$this->db->select($columns);
		$this->db->from(USERS);
		$this->db->where('id',$this->session->userdata('shopsy_session_user_id'));
		$referQuery = $this->db->get();
	//	echo $this->db->last_query(); die;
		
		return $referResult = $referQuery->result_array();
		
   }
   
	/**
    * 
    * Getting user details shop data
	* @param String $columns	
	* @param String $user_id	
	*
    */
    public function get_userdetail_datastore($columns,$user_id){
   
   		$this->db->select($columns);
		$this->db->from(USERS);
		$this->db->where('id',$user_id);
		$referQuery = $this->db->get();
	//	echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
   }
   
   
    /**
    * 
    * Seller register check
	* @param String $condition123	
	*
    */
 
   public function get_sellers_details($condition123=''){
		$Query = " select * from ".SELLER." ".$condition123;
   		return $this->ExecuteQuery($Query);
   }
   
    /**
    * 
    * Seller Store Details
	*
    */
    public function get_sellers_store_details(){
   		$Query = " select seller_id,seller_businessname from ".SELLER." ";
   		return $this->ExecuteQuery($Query);
   }
   
   /**
    * 
    * To insert the seller details
	* param String $seller_nda1
	* param String $seller_agreement1
	* param String $fileDetails1
	*
    */
    public function insertUserQuick($seller_nda1='',$seller_agreement1='',$fileDetails1='')
	{
	
	echo $seller_nda1; 
	
	if($seller_nda1 == ''){
	
	 $seller_nda1 = 'no';
	
	}
	if($seller_agreement1 == ''){
	
	 $seller_agreement1 = 'no';
	
	}
	
	
     extract($_POST);
	/* get Referal user id end */
   		$dataArr = array(
			'seller_businessname'	=>	$seller_businessname,
			'seourl'			=>	url_title($seller_businessname,'-'),
			'seller_email'	=>	$seller_email,
			'seller_id'	=>	$seller_id,
			'seller_crafting'		=>	$seller_crafting,
			'seller_product'		=>	$seller_product,
			'seller_firstname'	=>	$seller_firstname,
			'seller_lastname'	=>	$seller_lastname,
			'seller_medium'=>	$seller_medium,
   			'seller_make'	=> $seller_make,
			'seller_site'	=> $seller_site,
			'seller_nda'	=> $seller_nda1,
			'seller_agreement' => $seller_agreement1,
			'seller_store_image' => $fileDetails1,
			'status' => 'inactive',
			'created'	=>	mdate($this->data['datestring'],time())
   			
		);
					$dataArr2 = array('group' => 'user');


		$this->simple_insert(SELLER,$dataArr);
			$conditionArr2 = array('id'=>$this->session->userdata('shopsy_session_user_id'));
		$this->update_details(USER,$dataArr2,$conditionArr2);

   }
   
   
   /**
    * 
    * To sell-register account without images
	* param String $seller_nda1
	* param String $seller_agreement1
	*
    */
     public function insertUserQuicks($seller_nda1='',$seller_agreement1='')
	{
	
	echo $seller_nda1; 
	
	if($seller_nda1 == ''){
	
	 $seller_nda1 = 'no';
	
	}
	if($seller_agreement1 == ''){
	
	 $seller_agreement1 = 'no';
	
	}
	
	
     extract($_POST);
	/* get Referal user id end */
   		$dataArr = array(
			'seller_businessname'	=>	$seller_businessname,
			'seourl'			=>	url_title($seller_businessname,'-'),
			'seller_email'	=>	$seller_email,
			'seller_id'	=>	$seller_id,
			'seller_crafting'		=>	$seller_crafting,
			'seller_product'		=>	$seller_product,
			'seller_firstname'	=>	$seller_firstname,
			'seller_lastname'	=>	$seller_lastname,
			'seller_medium'=>	$seller_medium,
   			'seller_make'	=> $seller_make,
			'seller_site'	=> $seller_site,
			'seller_nda'	=> $seller_nda1,
			'seller_agreement' => $seller_agreement1,
			'status' => 'inactive',
			'created'	=>	mdate($this->data['datestring'],time())
   			
		);
					$dataArr2 = array('group' => 'user');


		$this->simple_insert(SELLER,$dataArr);
			$conditionArr2 = array('id'=>$this->session->userdata('shopsy_session_user_id'));
		$this->update_details(USER,$dataArr2,$conditionArr2);

   }
   
   /**
    * 
    * To update the seller details 
	* param String $seller_nda1
	* param String $seller_agreement1
	* param String $fileDetails1
	*
    */
    public function updateUserQuick($seller_nda1='',$seller_agreement1='',$fileDetails1=''){

   	     extract($_POST);

	/* get Referal user id end */
   		$dataArr = array(
			'seller_businessname'	=>	$seller_businessname,
			'seourl'			=>	url_title($seller_businessname,'-'),
			'seller_crafting'		=>	$seller_crafting,
			'seller_product'		=>	$seller_product,
			'seller_firstname'	=>	$seller_firstname,
			'seller_lastname'	=>	$seller_lastname,
			'seller_medium'=>	$seller_medium,
   			'seller_make'	=> $seller_make,
			'seller_site'	=> $seller_site,
			'seller_nda'	=> $seller_nda1,
			'seller_agreement' => $seller_agreement1,
			'seller_store_image' => $fileDetails1,

			'lastupdated'	=>	mdate($this->data['datestring'],time())
   			
		);

		$conditionArr = array('seller_id'=>$seller_id);
		$this->update_details(SELLER,$dataArr,$conditionArr);

   }
   
     
	/**
    * 
    * To update sell-register account without images
	* param String $seller_nda1
	* param String $seller_agreement1
	*
    */
	public function updateUserQuicks($seller_nda1='',$seller_agreement1=''){

   	     extract($_POST);

	/* get Referal user id end */
   		$dataArr = array(
			'seller_businessname'	=>	$seller_businessname,
			'seourl'			=>	url_title($seller_businessname,'-'),
			'seller_crafting'		=>	$seller_crafting,
			'seller_product'		=>	$seller_product,
			'seller_firstname'	=>	$seller_firstname,
			'seller_lastname'	=>	$seller_lastname,
			'seller_medium'=>	$seller_medium,
   			'seller_make'	=> $seller_make,
			'seller_site'	=> $seller_site,
			'seller_nda'	=> $seller_nda1,
			'seller_agreement' => $seller_agreement1,
			'lastupdated'	=>	mdate($this->data['datestring'],time())
   			
		);

		$conditionArr = array('seller_id'=>$seller_id);
		$this->update_details(SELLER,$dataArr,$conditionArr);

   }
   
	/**
    * 
    * To get the shop details 
	* param String $id
	*
    */
	public function getShopDetails($id='',$status='',$sortArr=''){
		if($id !=''){
	        	$this->db->where('id',$id);	
		}
		
		if ($sortArr != '' && is_array ( $sortArr )) {
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		
		$this->db->select(SELLER.'.*');
		$this->db->from(SELLER);
		if($status != ''){
			$this->db->where('status = "'.$status.'" ' );
		}
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
		
	}
	
	/**
    * 
    * To get the shop details view
	* param String $paginationNo
	* param String $searchPerPage
	*
    */
	public function getShopDetailsView($paginationNo,$searchPerPage,$status='',$sortArr=''){
		
		$this->db->select(SELLER.'.*');
		$this->db->from(SELLER);
		if($status != ''){
			$this->db->where('status = "'.$status.'" ' );
		}
		
		if ($sortArr != '' && is_array ( $sortArr )) {
			foreach ( $sortArr as $sortRow ) {
				if (is_array ( $sortRow )) {
					$this->db->order_by ( $sortRow ['field'], $sortRow ['type'] );
				}
			}
		}
		
		if($searchPerPage > 0){
	        $this->db->limit($searchPerPage,$paginationNo);	
		}
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
		
	}
	
	/**
    * 
    * To getting the shop details totalcount
	*
    */
	public function getShopDetailsCount($status=''){
		$this->db->select('count(id) as totalCount');
		$this->db->from(SELLER);
		if($status != ''){
			$this->db->where('status = "'.$status.'" ' );
		}
		$query = $this->db->get();
		$resultContent = $query->row()->totalCount;
		return $resultContent;
	}
	
	/**
    * 
    * To Display seller list in front end
	* param String $paginationNo
	* param String $searchPerPage
	*
    */
	function display_seller_list_view($paginationNo=0,$searchPerPage=0){
		
		$this->db->select('a.id,a.full_name,a.group,a.email,a.status,a.thumbnail,a.user_name,b.seller_businessname,b.seller_site as web_url,b.status as request_status,b.seller_promote');
		$this->db->from(USERS.' as a');
		$this->db->join(SELLER.' as b' , 'a.id = b.seller_id');
		$this->db->where('a.group = "Seller" and a.id!=0' );
		$this->db->order_by("a.created", "desc");
		if($searchPerPage > 0){
		$this->db->limit($searchPerPage,$paginationNo);
		}
		$dispSell = $this->db->get();
		//echo '<pre>'; print_r($dispSell->result()); die;
		return $dispSell;
	}
	
	/**
    * 
    * To Display seller list in front end
	*
    */
	function get_total_seller_count(){
		
		$this->db->select('count(a.id) as totalSeller');
		$this->db->from(USERS.' as a');
		$this->db->join(SELLER.' as b' , 'a.id = b.seller_id');
		$this->db->where('a.group = "Seller" and a.id!=0');
		$dispSell = $this->db->get();
		#echo $this->db->last_query();die;
		//echo '<pre>'; print_r($dispSell->result()); die;
		return $dispSell->row()->totalSeller;
	}
	
	/**
    * 
    * To Display seller request in admin
	*
    */
	function display_seller_list_request_view(){
		
		$this->db->select('a.id,a.full_name,a.group,a.email,a.status,a.thumbnail,b.id as sellerTblid,b.seller_businessname,b.seller_site as web_url,b.status as request_status');
		$this->db->from(USERS.' as a');
		$this->db->join(SELLER.' as b' , 'a.id = b.seller_id');
		$this->db->where('b.status = "inactive" ');
		$dispSell = $this->db->get();
		//echo '<pre>'; print_r($dispSell->result()); die;
		return $dispSell;
	}
	
	/**
    * 
    * To Display the seller detail in admin
	* 
	*
    */
	function display_seller_view_admin($sellid=''){
		
		$this->db->select('a.*,b.*');
		$this->db->from(USERS.' as a');
		$this->db->join(SELLER.' as b' , 'a.id = b.seller_id');
		$this->db->where('b.id !="0" and a.id='.$sellid);
		$dispSell = $this->db->get();
		//echo '<pre>'; print_r($dispSell->result()); die;
		return $dispSell = $dispSell->result_array();
	}

	/**
    * 
    * To Get the product feedback data
	* 
	*
    */
    public function get_product_feedback($prodid='',$type='',$searchPerPage='',$paginationNo=''){
   		$this->db->select('a.*,b.full_name');
		$this->db->from(PRODUCT_FEEDBACK.' as a');
		$this->db->join(USERS.' as b' , 'a.voter_id = b.id');
		$this->db->where('seller_product_id',$prodid);
		$this->db->where('a.status','Active');
		$this->db->order_by("a.dateAdded", "desc"); 
		if($searchPerPage !='')
		{
				$this->db->limit($searchPerPage,$paginationNo);
		}else if($type != 'all'){
			$this->db->limit(2);
		}
		$referQuery = $this->db->get();
		
	//	echo '<pre>'; print_r($referQuery->result()); die;
	//	echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   
   /**
    * 
    * To Get the single feedback data
	* 
	*
    */
   public function get_single_feedback($prodid=''){
   		$this->db->select('a.*,b.full_name');
		$this->db->from(PRODUCT_FEEDBACK.' as a');
		$this->db->join(USERS.' as b' , 'a.voter_id = b.id');
		$this->db->where('a.status','Active');
		$this->db->where('a.id',$prodid);
		//$this->db->order_by("a.dateAdded", "desc"); 
		$this->db->limit(2);
		$referQuery = $this->db->get();
		
	//	echo '<pre>'; print_r($referQuery->result()); die;
		//echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
 // Shop  Feedback Data
	
	/**
    * 
    * To Get the shop product feedback data
	* 
	*
    */	
    public function get_shop_feedback($shopid=''){
   		$this->db->select('a.*,b.full_name');
		$this->db->from(FEEDBACK.' as a');
		$this->db->join(USERS.' as b' , 'a.voter_id = b.id');
		$this->db->where('a.shop_id',$shopid);
		$this->db->where('a.status','Active');
		$this->db->order_by("a.dateAdded", "desc"); 
		$referQuery = $this->db->get();
		
	//	echo '<pre>'; print_r($referQuery->result()); die;
	//	echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   /**
    * 
    * To Get the product feedback  count data
	* 
	*
    */
     public function getFeedbackCount(){
   
   		$this->db->select('id');
		$this->db->from(FEEDBACK);
		$this->db->where('shop_id',$this->session->userdata('shopsy_session_user_id'));
		$this->db->where('status','Active');
		$referQuery = $this->db->get();
	//	echo $this->db->last_query(); die;
		
		return $referResult = $referQuery->result_array();
		
   }
   
   /**
    * 
    * To Get the shop section details data
	* 
	*
    */
    public function getShopSectionDetails($seller_id=''){
   
   		$this->db->select('a.*');
		$this->db->from(SHOP_SECTION_LIST.' as a');
		#$this->db->join(SHOP_SECTION_DETAILS.' as b' , 'a.section_id = b.section_id');
		$this->db->where('a.seller_id',$seller_id);
		$this->db->order_by("a.created", "asc"); 
		$referQuery = $this->db->get();
		#echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   
   /**
    * 
    * To Get the shop section udpates
	* 
	*
    */
	public function shopSectionUpdate($table='',$condition='',$dataArr=''){
		$this->db->where($condition);
		$this->db->update($table,$dataArr);
	}
	
	/**
    * 
    * To Get the shop owner details data
	*
    */	
	public function get_shop_owner_detail($shop_name_seourl){		
		$this->db->select('*');
		$this->db->from(SELLER);
		$this->db->join(USERS,USERS.'.id='.SELLER.'.seller_id');
		$this->db->where(SELLER.'.seourl',$shop_name_seourl);		
		$get_seller_details_qry = $this->db->get();
		return $get_seller_details_qry_rslt = $get_seller_details_qry;
   }
   
   /**
    * 
    * To Get the shop transaction details data
	*
    */
   public function getShopTransactionDetails($seller_id=''){   
   		$this->db->select('p.*,COUNT(p.id) as totPrd');
		$this->db->from(PRODUCT.' as p');
		$this->db->where('p.user_id',$seller_id);
		$this->db->where('p.pay_type !=','');
		
		$this->db->group_by('p.pay_date');
		$this->db->order_by("p.pay_date", "desc"); 
		$transResult = $this->db->get();
		$transResult = $transResult->result_array();
		#echo $this->db->last_query(); die;
		#echo '<pre>'; print_r($transResult);die;
		return $transResult;
		
   }
   
   /**
    * 
    * To Get the total order amount
	*
    */
   public function get_total_order_amounts($sid='0'){			
		$Query = "select sum(pr.sumTotal) as TotalAmt,sum(pr.Tax) as TotalTax, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.admin_commission) as sumTotal,p.tax as Tax ,u.full_name from shopsy_users u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.payment_type!='COD'  and p.shipping_status='Delivered'	 group by p.dealCodeNumber
			) pr";
		return $this->ExecuteQuery($Query);
	} 
	public function get_total_order_amount($sid='0'){			
		$Query = "select sum(pr.sumTotal) as TotalAmt,sum(pr.Tax) as TotalTax, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumTotal) as sumTotal,p.tax as Tax ,u.full_name from shopsy_users u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.payment_type!='COD'  and p.shipping_status='Delivered'	 group by p.dealCodeNumber
			) pr";
		return $this->ExecuteQuery($Query);
	} 
	public function get_dispute_order_amount($sid='0'){	
			 $query="select sum(d.TotalAmt) as dispute  from(select sum(sumtotal) as TotalAmt from ".USER_PAYMENT." where dealCodeNumber IN (select dealCodeNumber from ".ORDER_CLAIM." where seller_id='".$sid."'and status='Opened') and payment_type!='COD' and shipping_status='Delivered' and sell_id= ".$sid." group by dealCodeNumber)d ";
		return $this->ExecuteQuery($query);
	}	
	public function get_claim_amount($sid='0'){		
		$query="select sum(c.TotalAmt) as claim from(select sum(sumtotal) as TotalAmt from ".USER_PAYMENT." where dealCodeNumber NOT IN (select dealCodeNumber from ".ORDER_CLAIM." where seller_id='".$sid."'and status='Opened') and payment_type!='COD' and shipping_status='Delivered' and sell_id= ".$sid." group by dealCodeNumber )c";
		return $this->ExecuteQuery($query);
	}
	public function get_admin_commission($sid='0'){		
		$query="select sum(c.ac) as admin_commission from(select  sum(admin_commission) as ac from ".USER_PAYMENT." where dealCodeNumber NOT IN (select dealCodeNumber from ".ORDER_CLAIM." where seller_id='".$sid."'and status='Opened') and payment_type!='COD' and shipping_status='Delivered' and sell_id= ".$sid." group by dealCodeNumber )c";
		return $this->ExecuteQuery($query);
	}
	
	/**
    * 
    * To Get the cod total amount 
	*
    */
	public function get_cod_order_amount($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal ,u.full_name from shopsy_users u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.payment_type='COD' group by p.dealCodeNumber
			) pr";
		return $this->ExecuteQuery($Query);
	}
	
	/**
    * 
    * To Get the total paid details
	*
    */
	public function get_total_paid_details($sid='0'){
		$Query = "select sum(amount) as totalPaid from ".VENDOR_PAYMENT." where `status`='success' and `vendor_id`='".$sid."' group by `vendor_id`";
		return $this->ExecuteQuery($Query);
	}
   
  }// Class ends