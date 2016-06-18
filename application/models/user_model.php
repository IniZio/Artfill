<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class User_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/*
    * 
    * Getting Users details
    * @param String $condition
    */
	
	
public function increaseUserCredits($register_id,$username,$email){
		
		$refererId = '';
		$affi = get_cookie('affiliateId');
		$refererId = base64_decode($affi);
		//$refererId = get_cookie('affiliateId');
		//print_r($refererId);
		 
		$result = $this->user_model->get_all_details(AFFILIATE,array());
		
		//echo "<pre>"; print_r($result->result());
		
		if(isset($affi) && $refererId !=''){
			//echo "asa"; 
		//if($refererId !=''){
			$referer = $this->user_model->get_all_details(USERS,array('affiliateId'=>$refererId));
			//print_r($referer->result()); 
			//echo "<br>".$register_id;
			
			$this->user_model->update_details(USERS,array('referId'=>$referer->row()->id),array('id'=>$register_id));
		
			//echo $this->db->last_query()."<br>";
			if($result->num_rows > 0){
				if($result->row()->aff_status == 'Active'){
					$referArr = array();
					$referArr['dateAdded'] = date("Y-m-d H:i:s");
					$referArr['register_id'] = $register_id;
					$referArr['registered'] = $username;
					$referArr['registeredemail'] = $email;
					$referArr['referer_id'] = $referer->row()->id;
					$referArr['referer'] = $referer->row()->user_name;
					$referArr['referer_email'] = $referer->row()->email;
					//$referArr['status'] = 'Pending';
					$referArr['status'] = 'Approved';
					$referArr['credit'] =  $result->row()->aff_amount * $result->row()->aff_point;
					$this->user_model->simple_insert(AFFCOOKIE,$referArr);
					//echo $this->db->last_query()."<br>";
					
					$insert_id = $this->db->insert_id();
					
					// updating referer credits//
					//echo $insert_id;
					
					$this->data['affiliate'] = $affiliaterow= $this->user_model->get_all_details(AFFCOOKIE,array('id'=>$insert_id ));
					//print_r($affiliaterow->result());
					//print_r( $refe_id = $affiliaterow->row()->referer_id);
				
					
					$this->data['user']=$usersrow = $this->user_model->get_all_details(USERS,array('id'=> $refe_id));				
					
					$current_credits = $affiliaterow->row()->credit + $usersrow->row()->credits;
					$this->user_model->update_details(USERS,array('credits'=>$current_credits),array('id'=>$affiliaterow->row()->referer_id));
					
				}
			}
		}
		
		if($result->num_rows > 0){
			//echo "bbbb";
			$fbArray =array();
			if($result->row()->fb_discount == 'Active'){
				$fbArray['fb_purchase_count'] = $result->row()->purchase_count;
				$fbArray['fb_discounttype'] = $result->row()->fb_discounttype;
				$fbArray['fb_discountvalue'] = $result->row()->fb_discountvalue;
				$this->user_model->update_details(USERS,$fbArray,array('id'=>$register_id));
				//echo $this->db->last_query()."<br>";
			}
		}
		
		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ""){
			//echo "cccc";
			$this->user_model->update_details(USERS,array('HttpReferer'=>$_SERVER['HTTP_REFERER']),array('id'=>$register_id));
			//echo $this->db->last_query()."<br>";
		}
		//die;
	}
	
	public function get_my_product_review($id='',$src_date)
	{
		$query="select pf.*,u.full_name,u.user_name from ".PRODUCT_FEEDBACK." pf JOIN ".USERS." u on u.id=pf.voter_id  LEFT JOIN ".PRODUCT." p on p.id = pf.seller_product_id JOIN ".SELLER." s on pf.shop_id = s.id where pf.shop_id='".$id."' and pf.status='Active' and s.status='Active' and pf.dateAdded <='".$src_date."' and p.status='Publish'";
		//echo $query;die;
		return $this->ExecuteQuery($query);
		
	}
	public function get_all_reviews($id='',$src_date,$shop_id)
	{
		if($shop_id != "")
		{
			$query="select pf.*,u.full_name,u.user_name,p.product_name,p.seourl from ".PRODUCT_FEEDBACK." pf LEFT JOIN ".USERS." u on u.id=pf.voter_id LEFT JOIN ".PRODUCT." p on p.id = pf.seller_product_id LEFT JOIN  ".SELLER." s on pf.shop_id = s.id   where (pf.shop_id='".$shop_id."' and pf.status='Active' and pf.dateAdded <='".$src_date."' and s.status='Active' and p.status='Publish') or  (pf.voter_id='".$id."' and pf.dateAdded <='".$src_date."' and p.status='Publish')";
		}else{
			$query="select pf.*,p.product_name,p.seourl from ".PRODUCT_FEEDBACK." pf JOIN ".PRODUCT." p on p.id=pf.seller_product_id  where pf.voter_id=".$id." and pf.dateAdded <='".$src_date."' and p.status='Publish'";
		}
		return $this->ExecuteQuery($query);
		
	}
	public function get_my_reviews($id='',$src_date)
	{
		$query="select pf.*,p.product_name,p.seourl from ".PRODUCT_FEEDBACK." pf JOIN ".PRODUCT." p on p.id=pf.seller_product_id  where pf.voter_id=".$id." and pf.dateAdded <='".$src_date."'";
		return $this->ExecuteQuery($query);
		//echo $this->db->last_query();die;
		//print_r($res->result());die;
	}
	
	public function get_users_details($condition=''){
   		$Query = " select * from ".USERS." ".$condition;
   		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * update Users details
    * @param String $fullname, $username, $lastname, $email, $password, $brand
    */
   public function insertUserQuick($fullname='',$username='',$lastname='',$email='',$pwd='',$brand='no'){

    $api_id = $this->input->post('api_id');
	$thumbnail = $this->input->post('thumbnail');
	
	if($thumbnail != '')
		$thumbnail = $thumbnail;
	else
		$thumbnail = '';
	
	/* get Referal user id start */
	
	$getReferalUserId =$this->getReferalUserId();
	
	
	/* get Referal user id end */
   		$dataArr = array(
			'full_name'	=>	$fullname,
			'user_name'	=>	$username,
			'last_name'=>	$lastname,
			'group'		=>	'User',
			'email'		=>	$email,
			'password'	=>	md5($pwd),
			'status'	=>	'Active',
			'is_verified'=>	'No',
   			'is_brand'	=> $brand,
			'api_id'	=> $api_id,
			'thumbnail'	=> $thumbnail,
			'referId' => $getReferalUserId,
			'created'	=>	mdate($this->data['datestring'],time()),
   			'email_notifications'	=>	implode(',', $this->data['emailArr']),
	    	'notifications'			=>	implode(',', $this->data['notyArr'])
		);

			
		$this->simple_insert(USERS,$dataArr);
		if($this->session->userdata('referenceName') != '')
		{
			$this->session->unset_userdata('referenceName');
		}
		
   }
	/*
    * 
    * update Users details
    * @param String $fullname, $username, $email, $password
    */	
   
   
   public function updateUserQuick($fullname='',$username='',$email='',$pwd=''){
   		$dataArr = array(
			'full_name'	=>	$fullname,
			'user_name'	=>	$username,
			'password'	=>	md5($pwd)
		);
		$conditionArr = array('email'=>$email);
		$this->update_details(USERS,$dataArr,$conditionArr);
   }
   
   
   //Sriram Code
   //update user template
   public function updateUserQuickTemp(){
	  extract($_POST);
   		$dataArr = array(
			'shop_template'	=>	$shop_template,
			'product_template'	=>	$product_template
			
		);
		$conditionArr = array('id'=>$seller_id);
		$this->update_details(USERS,$dataArr,$conditionArr);
		//echo $this->db->last_query(); 
		
		$conditionArr1 = array('seller_id'=>$seller_id);
		$this->update_details(SELLER,$dataArr,$conditionArr1);
		//echo $this->db->last_query(); die;
		
   }
   
   	/*
    * 
    * update Users giftcard details
    * @param constant $table name
    * @param integer $temp id 
    * @param integer $user id
    */	
	public function updategiftcard($table='',$temp_id='',$user_id=''){
   		$dataArr = array('user_id'	=>	$user_id,);
		$conditionArr = array('user_id'=>$temp_id);
		$this->update_details($table,$dataArr,$conditionArr);
   }
   	/*
    * 
    * update Users shopping details
    * @param constant $table name
    * @param integer $temp id 
    * @param integer $user id
    */		
    public function updateShopingCart($table='',$temp_id='',$user_id=''){
   		$dataArr = array('user_id'	=>	$user_id,);
		$conditionArr = array('user_id'=>$temp_id);
		$this->update_details($table,$dataArr,$conditionArr);
   }
   	/*
    * 
    * update Users shopping details
    * @param constant $table name
    * @param integer $temp id 
    * @param integer $user id
    */	
    public function updateUserShopingCart($table='',$temp_id='',$user_id=''){
   		$dataArr = array('user_id'	=>	$user_id,);
		$conditionArr = array('user_id'=>$temp_id);
		$this->update_details($table,$dataArr,$conditionArr);
   }
	/*
    * 
    * get Users purchase details
    * @param integer $user id
    */		
   public function get_purchase_details($uid='0'){
   	 	$Query = "select p.*,u.full_name from ".PAYMENT." p JOIN ".USERS." u on u.id=p.user_id where p.user_id='".$uid."' group by p.dealCodeNumber order by created desc";
   	 	return $this->ExecuteQuery($Query);
   }
   /*
    * 
    * get seller purchase details
    * @param integer $user id
    */		
    public function get_seller_purchase_details($uid='0'){
   	 	$Query = "select p.*,u.full_name from ".USER_PAYMENT." p JOIN ".USERS." u on u.id=p.user_id where p.user_id='".$uid."' group by p.dealCodeNumber order by created desc";
   	 	return $this->ExecuteQuery($Query);
   }
   /*
    * get Users user likes details
    * @param integer $user id
    */		
   public function get_like_details_fully($uid='0'){
   		$Query = 'select p.*,u.full_name,u.user_name from '.PRODUCT_LIKES.' pl
   					JOIN '.PRODUCT.' p on pl.product_id=p.seller_product_id
   					LEFT JOIN '.USERS.' u on p.user_id=u.id
   					where pl.user_id='.$uid.' and p.status="Publish" order by pl.time desc';
   		return $this->ExecuteQuery($Query);
   }
   /*
    * 
    * get user likes for product
    * @param integer $user id
    */		
   public function get_like_details_fully_user_products($uid='0'){
   		$Query = 'select p.*,u.full_name,u.user_name from '.PRODUCT_LIKES.' pl
   					JOIN '.USER_PRODUCTS.' p on pl.product_id=p.seller_product_id
   					LEFT JOIN '.USERS.' u on p.user_id=u.id
   					where pl.user_id='.$uid.' and p.status="Publish" order by pl.time desc';
   		return $this->ExecuteQuery($Query);
   }
   /*
    * 
    * get Users activity details
    * @param integer $user id
    * @param integer $limit
    * @param String $type
    */		
   public function get_activity_details($uid='0',$limit='5',$sort='desc'){
   		$Query = 'select a.*,p.product_name,p.id as productID,up.product_name as user_product_name,u.full_name,u.user_name from '.USER_ACTIVITY.' a
   					LEFT JOIN '.PRODUCT.' p on a.activity_id=p.seller_product_id
   					LEFT JOIN '.USER_PRODUCTS.' up on a.activity_id=up.seller_product_id
   					LEFT JOIN '.USERS.' u on a.activity_id=u.id
   					where a.user_id='.$uid.' order by a.activity_time '.$sort.' limit '.$limit;
   		return $this->ExecuteQuery($Query);
   }
     /*
    * 
    * get Users list details
    * @param integer $tid
    * @param integer $uid
    */		
   public function get_list_details($tid='0',$uid='0'){
   		$Query = 'select l.*,c.cat_name from '.LISTS_DETAILS.' l
   					LEFT JOIN '.CATEGORY.' c on l.category_id=c.id
   					where l.user_id='.$uid.' and l.product_id='.$tid.' or l.user_id='.$uid.' and l.product_id like "'.$tid.',%" or l.user_id='.$uid.' and l.product_id like "%,'.$tid.'" or l.user_id='.$uid.' and l.product_id like "%,'.$tid.',%"';
   		return $this->ExecuteQuery($Query);
   }
    /*
    * 
    * get Users list details
    * @param String $search_key
    * @param integer $uid
    */								
   
   public function get_search_user_list($search_key='',$uid='1'){
   		$Query = 'select * from '.USERS.' where `full_name` like "%'.$search_key.'%"  or  `user_name` like "%'.$search_key.'%"  or  `last_name` like "%'.$search_key.'%" and `id` != "'.$uid.'" and `status` = "Active"';
   		return $this->ExecuteQuery($Query);
   }
    /*
    * 
    * get Users list details
    * @param String $search_key
    * @param integer $uid
    * @param String $order
    * @param String $group
    * @param integer $limit
    */		
    public function get_search_user_list_search($search_key='',$uid='1',$order='',$group='`group`="user"',$limitPaging){
   		$Query = 'select * from '.USERS.' where (`user_name` like "%'.$search_key.'%" OR `full_name` like "%'.$search_key.'%" OR `last_name` like "%'.$search_key.'%")  and (`id` > "'.$uid.'" and `status` = "Active" and ('.$group.'))  '.$order.' limit '.$limitPaging;
   		$result=$this->ExecuteQuery($Query);		
		return $result;
   }
     /*
    * 
    * get Users list details
    * @param String $search_key
    * @param integer $uid
    * @param String $order
    * @param integer $limit
    */	
   public function get_search_shop_list_search($search_key='',$uid='0',$order='',$limitPaging){
		$Query = "select u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,s.seller_businessname as shop_name,s.seourl as shop_seourl from ".SELLER." s 
					JOIN ".USER." u on u.id=s.seller_id where s.status='Active' and u.status='Active' and s.seller_businessname like '%".$search_key."%'  and u.id > ".$uid." ".$order." limit ".$limitPaging;
		if($search_key==''){
			$Query = "select u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,s.seller_businessname as shop_name,s.seourl as shop_seourl from ".SELLER." s JOIN ".USER." u on u.id=s.seller_id where s.status='Active' and u.status='Active' and u.id > ".$uid." ".$order." limit ".$limitPaging;
		}
		$resultVal=$this->ExecuteQuery($Query);
		#echo $this->db->last_query(); die;
		return $resultVal;
	}
	/*
    * 
    * get product count
    * @param integer $sellerId
    */				
	public function get_count_all_product($sellerId){
		$this->db->select('id');
		$this->db->from(PRODUCT);
		if($sellerId != ''){
			$this->db->where('user_id',$sellerId);	
		}
		$this->db->where('status','Publish');
		$this->db->where('pay_status','Paid');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query);die;
		return $query->num_rows(); 
	
	}
	/*
    * 
    * get shop product 
    * @param integer $sellerId
    */				

	public function get_shop_product_limit($sellerId){
		
		$this->db->select('image,seourl');
		$this->db->from(PRODUCT);
		if($sellerId != ''){
			$this->db->where('user_id',$sellerId);	
		}
		$this->db->where('status','Publish');
		$this->db->where('pay_status','Paid');
		$this->db->order_by('created','desc');
		$this->db->limit(7);
		$query = $this->db->get();
		#echo $this->db->last_query();
		#echo '<pre>safasd'; print_r($query->result_array());die;
		return $query->result_array(); 
	
	}
   /*
    * 
    * To check login through social network
    * @param integer $api_id
    */				

   public function social_network_login_check($apiId='')
   {
   		 $twitterQuery = "select api_id from ".USERS." where api_id=".$apiId. " AND status='Active'";

		$twitterQueryDetails  = mysql_query($twitterQuery);
		$twitterFetchDetails = mysql_fetch_row($twitterQueryDetails);
		
		return $twitterCountById = mysql_num_rows($twitterQueryDetails);
   }
   /*
    * 
    * get social login details
    * @param integer $api_id
    */				

   public function get_social_login_details($apiId='')
   {
   		 $twitterQuery = "select * from ".USERS." where api_id=".$apiId. " AND status='Active'";

		$twitterQueryDetails  = mysql_query($twitterQuery);
		return $twitterFetchDetails = mysql_fetch_assoc($twitterQueryDetails);
		
		//return $twitterCountById = mysql_num_rows($twitterQueryDetails);
   }
    /*
    * 
    * To check google login
    * @param String $email
    */	
   public function googleLoginCheck($email='')
   {
  // echo $email;die;
   		$this->db->select('id');
		$this->db->from(USERS);
		$this->db->where('email',$email);
		$this->db->where('status','Active');
		$googleQuery = $this->db->get();
		return $googleResult = $googleQuery->num_rows(); 
   }
    /*
    * 
    * To check google & twitter login
    * @param integer $twitterId
    */	
   public function googleTwitterCheck($twitterID){
		
		$duplicateName = $this->user_model->get_all_details(USERS,array('twitter_id'=>$twitterID));
		return $duplicateName->num_rows();
	}
    /*
    * 
    * To get google user login details
    * @param String $email
    */	
   public function google_user_login_details($email='')
   {
   		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email',$email);
		$this->db->where('status','Active');
		$googleQuery1 = $this->db->get();
		return $googleResult1 = $googleQuery1->row_array(); 
   }
    /*
    * 
    * To get twitter user login
    * @param String $twitterId
    */	
   public function twitter_user_login_details($twitterId='')
   {
   		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('twitter_id',$twitterId);
		$this->db->where('status','Active');
		$googleQuery1 = $this->db->get();
		return $googleResult1 = $googleQuery1->row_array(); 
   }
    /*
    * 
    * To check referral id
    */	
	public function getReferalUserId()
	{
		$referenceName = $this->session->userdata('referenceName');
		$referenceId = '';
		if($referenceName != '')
		{
			$this->db->select('id');
			$this->db->from(USERS);
			$this->db->where('user_name',$referenceName);
			$referQuery = $this->db->get();
			$referResult = $referQuery->row_array();
			
			if(!empty($referResult))
			{
				return $referenceId = $referResult['id'];
			}
			else
			{
				return $referenceId = '';
			}
		}
		else
		{
			return $referenceId = '';
		}
	}
	 /*
    * 
    * To get referral list
    * @param integer $perpage
    * @param integer $start
    */	
	public function getReferalList($perpage='',$start='')
	{
		//echo $this->session->userdata('shopsy_session_user_id');die;
		$this->db->select('full_name,user_name,email,thumbnail');
		$this->db->from(USERS);
		$this->db->where('referId',$this->session->userdata('shopsy_session_user_id'));
		
		if($perpage !='')
		{
			$this->db->limit($perpage,$start);
		}			
		
		
		$this->db->order_by('id','desc');
		$referQuery = $this->db->get();
		return $referResult = $referQuery->result_array();
	}
	 /*
    * 
    * To get user lik products
    * @param integer $user_Id
    * @param integer $limit
    */	
	public function get_userlike_products($uid='0',$limit='5'){
		$Query = "select pl.*,p.id as pid,p.product_name,p.image from ".PRODUCT_LIKES.' pl 
					JOIN '.PRODUCT.' p on pl.product_id=p.seller_product_id 
					where pl.user_id='.$uid.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get user order list 
    * @param integer $user_Id
    */		
	public function get_user_orders_list($uid='0'){
		$Query = "select *, sum(sumtotal) as TotalPrice from ".PAYMENT.' where sell_id='.$uid.' and status="Paid" group by dealCodeNumber order by created desc';
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get seller order list 
    * @param integer $user_Id
    */		
	public function get_seller_orders_list($uid='0'){
		$Query = "select *, sum(sumtotal) as TotalPrice from ".USER_PAYMENT.' where sell_id='.$uid.' and status="Paid" group by dealCodeNumber order by created desc';
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get subscription list 
    * @param integer $user_Id
    */		
	public function get_subscriptions_list($uid='0'){
		$Query = "select * from ".FANCYYBOX_USES.' where user_id='.$uid.' group by invoice_no order by created desc';
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get gift card list 
    * @param string $email
    */			
	public function get_gift_cards_list($email=''){
		$Query = "select * from ".GIFTCARDS.' where recipient_mail=\''.$email.'\' order by created desc';
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get send gift card list 
    * @param string $email
    */	
	public function get_send_gift_cards_list($email=''){
		$Query = "select * from ".GIFTCARDS.' where sender_mail=\''.$email.'\' order by created desc';
		return $this->ExecuteQuery($Query);
	}
	/*
    * 
    * To get purchase list 
    * @param integer $userId
    * @param integer $dealCode
    */	
	public function get_purchase_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');	
		$this->db->where('p.user_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
		/*
    * 
    * To get seller purchase list 
    * @param integer $userId
    * @param integer $dealCode
    */	
	public function get_seller_purchase_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(USER_PRODUCTS.' as pd' , 'pd.id = p.product_id');	
		$this->db->where('p.user_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
	/*
    * 
    * To get order list 
    * @param integer $uid
    * @param integer $dealCode
    */	
	public function get_order_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image');
		$this->db->from(PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.sell_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
	/*
    * 
    * To get seller order list 
    * @param integer $uid
    * @param integer $dealCode
    */	
	public function get_seller_order_list($uid='0',$dealCode='0'){
		$this->db->select('p.*,u.email,u.full_name,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(USER_PRODUCTS.' as pd' , 'pd.id = p.product_id');		
		$this->db->where('p.sell_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'"');
		return $this->db->get();
	}
	/*
    * 
    * To delete favorite
    * @param integer $userid
    * @param integer $shopid
    */	
	public function fav_delete($userid='',$shopid=''){
		    $this->db->where('shop_id', $shopid);
			$this->db->where('user_id', $userid);
			$this->db->delete(FAVORITE);
			//$this->db->where('shop_id', $shopid);
			//$this->db->where('user_id', $userid);
		    $this->db->last_query();
//		$referQuery = $this->db->get();
	//	$referResult = $referQuery->result_array();
		//echo $this->db->last_query(); die;
		return;	
	}
	/*
    * 
    * To delete favorite product
    * @param integer $userid
    * @param integer $productid
    */	
	public function product_fav_delete($userid='',$pid=''){
		    $this->db->where('p_id', $pid);
			$this->db->where('user_id', $userid);
			$this->db->delete(FAVORITE);
		    $this->db->last_query();
		return;	
	}
	
/*	function delete_prod_image($position='',$imgId='')
	{
		$this->db->select(PRODUCT.'.image');
		$this->db->from(PRODUCT);
		$this->db->where(PRODUCT.'.id',$imgId);
		$imageQuery = $this->db->get();
		$imageResult =$imageQuery->row_array();
		echo "<pre>";print_r($imageResult);die;
		$imageVals = $imageResult['$imageResult'];
		 echo str_replace($imageVals,"","Hello world!");
	}*/
	/*
    * 
    * To check list of products
    * @param integer $productId
    * @param integer $listId
    */	
	public function check_list_products($productId,$listId){
		$Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$productId."',product_id) and `id`=".$listId;
		$resultVal=$this->ExecuteQuery($Query);
		#echo $this->db->last_query();
		return $resultVal;
		
	}
	/*
    * 
    * To get registry of products
    * @param integer $productId
    * @param integer $usrId
    */	
	public function check_registry_products($productId,$usrId){		
		$this->db->select('*');
		$this->db->from(REGISTRY_LISTINGS);
		$this->db->where(REGISTRY_LISTINGS.'.collection_id',$usrId);
		$this->db->where(REGISTRY_LISTINGS.'.listing_id',$productId);
		$resultVal= $this->db->get();
		#echo $this->db->last_query(); die;
		return $resultVal;
		
	}
	/*
    * 
    * To get list of products
    * @param integer $productId
    * @param integer $listId
    */	
	public function get_list_products($productId,$listId){
		$Query = "select p.* from ".PRODUCT." p LEFT JOIN ".LISTS_DETAILS." l on l.id=".$listId." where FIND_IN_SET(".$productId.",l.product_id) and p.id=".$productId;
		$resultVal=$this->ExecuteQuery($Query);
		#echo $this->db->last_query(); die;
		return $resultVal;
		
	}
	/*
    * 
    * To get total user count
    */	
	public function get_total_user_count($status=''){
		$condition = '';
		if($status !=''){
			$condition = "and `status`= '".$status."'";
		}
		$Query = "select count(id) as totalUser from ".USERS." where `group`='User' ".$condition." ";
		
		$resultVal=$this->ExecuteQuery($Query);
// 		echo $this->db->last_query();
// 		echo '<pre>'; print_r($resultVal->result());
		//die;
		return $resultVal->row()->totalUser;
		
	}
	/*
    * 
    * To get user favorite products
    * @param integer $userId
    * @param integer $limit
    */	
	public function get_userfav_products($uid='0',$limit=''){
		$Query = 'select f.*,p.seourl as pseourl,p.product_name,p.image,u.visibility,u.followers_count from '.FAVORITE.' f 
					JOIN '.PRODUCT.' p on f.p_id=p.id
					JOIN '.USER.' u on u.id=p.user_id 
					where  p.status="Publish" and p.pay_status="Paid" and f.user_id='.$uid;
		$resultVal=$this->ExecuteQuery($Query);
		//echo $this->db->last_query(); die;
		return $resultVal;
	}
	/*
    * 
    * To get user favorite products
    * @param integer $userId
    * @param integer $limit
    */	
	public function get_userfav_products_with_cond($uid='',$limit=''){
		$status="'Public'";
		$Query = "select f.*,p.seourl as pseourl,p.product_name,p.image,u.visibility,u.followers_count from ".FAVORITE.' f 
					JOIN '.PRODUCT.' p on f.p_id=p.id
					JOIN '.USER.' u on u.id=p.user_id and  
					where u.favorites_visibility='.$status.' and f.user_id='.$uid;
		$resultVal=$this->ExecuteQuery($Query);
		#echo $this->db->last_query(); die;
		return $resultVal;
	}
	/*Search Favorite Products List
		Param 1. String $search key
					2. integer $userId
	*/
	public function get_search_favorite_list($search_key='',$uid='0'){
		
		$Query = "select p.*,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,u.feature_product,s.seller_businessname as shop_name,s.seourl as shop_seourl,a.pricing from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id LEFT JOIN ".FAVORITE." f on p.id=f.p_id where  p.product_name like '%".$search_key."%'  and p.status='Publish' and p.pay_status='Paid' and f.user_id=".$uid." GROUP BY a.product_id";
   		$resultVal= $this->ExecuteQuery($Query);
		#echo $this->db->last_query(); die;
		return $resultVal;
   }
   
   /*Get Recent Favorites */
	public function get_resent_favorite_list(){
		$this->db->select('f.*,u.city,u.id as sellerid,u.email as selleremail,u.full_name,u.last_name,u.country,u.user_name,u.thumbnail,u.feature_product,s.seller_businessname as shop_name,s.seller_banner as seller_banner,s.seourl as shop_seourl,s.shop_ratting,s.review_count');
		$this->db->from(FAVORITE.' as f');
		$this->db->join(USERS.' as u' , 'u.id = f.shop_id');
		$this->db->join(SELLER.' as s' , 'f.shop_id = s.seller_id');	
		#$this->db->where('f.shop_id IS NOT NULL '.$this->session->userdata("geo_country_filter"));
		#$this->db->group_by('f.shop_id');	
		$this->db->where('s.status','active');
		$this->db->order_by('f.time','DESC');
		#$this->db->limit(4,0);
		$resultVal= $this->db->get();
		
		#echo '<pre>'; print_r($resultVal->result_array()); die;
		#echo $this->db->last_query(); die;
		return $resultVal;
   }
   /*
    * 
    * To get user purchase list of products
	* @param integer $userId
    * @param integer $dealCode .' and p.payment_type != "'."COD".'"'
    * @param string $condition
    */	
   public function get_user_purchase_list($uid='0',$dealCode='', $condition){
		$this->db->select('p.*,u.email,u.full_name,u.thumbnail,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image,pd.ship_from,s.seller_businessname as shopname,s.seller_email,s.seourl as shop_seo');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(SELLER.' as s' , 's.seller_id = p.sell_id');
		if($condition!=''){
			$this->db->where('p.status = "'.$condition.'"');
		}	
		if($dealCode==''){
			$this->db->where('p.user_id = "'.$uid.'" GROUP BY p.dealCodeNumber ORDER BY p.inserttime  desc');
		}
		else{
			$this->db->where('p.user_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'" GROUP BY p.dealCodeNumber ORDER BY p.inserttime  desc');
		}
		return $this->db->get(); 
	}

	
	
	public function get_user_purchase_Clist($uid='0',$dealCode='',$condition='Paid'){
		$this->db->select('p.*,u.email,u.full_name,u.thumbnail,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image,pd.ship_from,s.seller_businessname as shopname,s.seller_email,s.seourl as shop_seo');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(SELLER.' as s' , 's.seller_id = p.sell_id');
		$this->db->where('(p.status= "Pending" and p.payment_type != "COD" and p.user_id = "'.$uid.'")');
		$this->db->or_where('(p.status= "Paid" and p.shipping_status= "Cancelled" and p.payment_type != "COD" and p.user_id = "'.$uid.'")' );
		//$this->db->where();
		//$this->db->where('p.payment_type != "COD"');
			
		if($dealCode==''){
			$this->db->group_by('p.dealCodeNumber');
			$this->db->order_by('p.inserttime  desc');
		}
		else{
			$this->db->where(' p.dealCodeNumber="'.$dealCode.'" GROUP BY p.dealCodeNumber ORDER BY p.inserttime  desc');
		}
		return $this->db->get(); 
	}
	
	
	
	//********* Purchase list on Delivery Checking ****************
	//Param 1. integer $userId
	//Param 2. integer $dealCode
	//Param 3. string $Condition
		
	   public function get_user_purchase_list1($uid='0',$dealCode='',$condition='COD'){
		$this->db->select('p.*,u.email,u.full_name,u.thumbnail,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.product_name,pd.id as PrdID,pd.image,pd.ship_from,s.seller_businessname as shopname,s.seller_email,s.seourl as shop_seo');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.sell_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(SELLER.' as s' , 's.seller_id = p.sell_id');
		if($condition!=''){
			$this->db->where('p.payment_type = "'.$condition.'" ');
		}	
		if($dealCode==''){
			$this->db->where('p.user_id = "'.$uid.'" GROUP BY p.dealCodeNumber ORDER BY p.inserttime  desc');
		}
		else{
			$this->db->where('p.user_id = "'.$uid.'" and p.dealCodeNumber="'.$dealCode.'" GROUP BY p.dealCodeNumber ORDER BY p.inserttime  desc');
		}
		return $this->db->get(); 
	}
	
	
	
		//********* Purchase list cash on Delivery Checking ends ****************
		
	public function get_pickedItems(){
		$this->db->select('p.user_id,u.user_name,u.email,u.full_name,u.thumbnail,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');	
		$this->db->where('p.user_id > 1 GROUP BY p.user_id');
		$this->db->order_by('p.id','ASC');
		$this->db->limit(5);
		return $this->db->get();
	}
	/*
    * 
    * To get Recent seller blog
    * @param string $type
    */	
	 function getrecentSellerBlog($type = '')
    {	
	
		
		$this->db->select('bu.user_email,s.seller_id,s.seller_banner,u.user_name,u.thumbnail,,u.full_name,u.city,u.country,s.seourl as shopurl,s.seller_businessname as shopname');
		//a.*,b.*
		//$this->db->from(POSTS.' as a');
		//$this->db->join(POSTMETA.' as b','b.post_id =a.ID');
		//$this->db->join(BLOG_USERS.' as bu','a.post_author =bu.ID');
		$this->db->from(BLOG_USERS.' as bu');
		$this->db->join(SELLER.' as s','s.seller_email=bu.user_email');
		$this->db->join(USERS.' as u','s.seller_id=u.id');
	   	//$this->db->where('a.post_status','publish');
		//$this->db->where('a.post_type','post');
		//$this->db->where('b.meta_key','_wp_attached_file');		
		//$this->db->where('s.seller_banner!=','""');		
		
		//$this->db->group_by('a.ID');
		#$this->db->order_by('post_date', 'desc');
		//$this->db->order_by('s.seller_id','RANDOM');
		$this->db->limit(1);
		$query = $this->db->get();
		#echo $this->db->last_query();
		#echo '<pre>'; print_r($query->result());
		#die;
		$resultContent = $query->result();
		return $resultContent; 
		
		
		/* $this->db->select('a.*,b.*,bu.user_email,s.seller_id,s.seller_banner,u.user_name,u.thumbnail,,u.full_name,s.seourl as shopurl,s.seller_businessname as shopname');
		$this->db->from(POSTS.' as a');
		$this->db->join(POSTMETA.' as b','b.post_id =a.ID');
		$this->db->join(BLOG_USERS.' as bu','a.post_author =bu.ID');
		$this->db->join(SELLER.' as s','s.seller_email=bu.user_email');
		$this->db->join(USERS.' as u','s.seller_id=u.id');
	   	$this->db->where('a.post_status','publish');
		$this->db->where('a.post_type','post');
		//$this->db->where('b.meta_key','_wp_attached_file');		
		
		$this->db->group_by('a.ID');
		#$this->db->order_by('post_date', 'desc');
		$this->db->order_by('s.seller_id','RANDOM');
		$this->db->limit(6);
		$query = $this->db->get();
		$resultContent = $query->result();
		return $resultContent; */
		
    }
	/*
    * 
    * To get testimonials 
    */	
	public function get_testimonials(){
		$this->db->select('t.*,u.user_name,u.email,u.full_name,u.thumbnail,u.city,s.seller_businessname as shopname,s.seourl as shopurl,s.seller_banner as seller_banner');
		$this->db->from(TESTIMONIALS.' as t');
		$this->db->join(USERS.' as u' , 't.seller_id = u.id');	
		$this->db->join(SELLER.' as s' , 's.seller_id = t.seller_id');
		$this->db->order_by('t.seller_id','RANDOM');
		return $this->db->get();
	}
	/*
    * 
    * To get message
    * @param integer $tid
    */	
	public function get_message($tid=''){
	$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,u.user_name as receiver_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->where('c.tid ='.$tid);
		$messageDetails= $this->db->get();
		#echo $this->db->last_query(); die;
		#print_r ($messageDetails->result()); die;
		return $messageDetails;
	}
	
	
	
	///////// Get  activity List//////////////
	// Param 1. String $condition
	// Param 2. Integer $post numbers
	// Param 3. Integer $offset
	public function get_activity($condition='',$postnumbers=9,$offset=0){
		$this->db->select('ua.*');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->where($condition);	
		#$this->db->group_by('ua.activity_id');
		$this->db->order_by('ua.activity_time','desc');
		$this->db->limit($postnumbers,$offset);
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	
	///////// Get  overall activity List//////////////
	// Param 1. String $condition
	public function get_activity_all($condition=''){
		$this->db->select('ua.id');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->where($condition);	
		#$this->db->group_by('ua.activity_id');
		$this->db->order_by('ua.activity_time','desc');
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	///////// Get  overall activity List//////////////
	public function get_activity_shop($shopId='',$timeseen){
		$this->db->select('ua.id');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->where('ua.activity_id',$shopId);	
		$this->db->where('ua.activity_time >=',$timeseen);	
		$this->db->where('(`ua`.`activity_name` LIKE "%favorite shop%" OR `ua`.`activity_name` LIKE "%Unfavorite shop%")');
		#$this->db->or_like('ua.activity_name', 'Unfavorite shop'); 
		$this->db->order_by('ua.activity_time','desc');
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	
	///////// Get  overall activity List//////////////
	public function get_activity_shopPrd($shopId='',$timeseen){
		$this->db->select('ua.id');
		$this->db->from(SELLER.' as s');
		$this->db->join(PRODUCT.' as p','p.user_id =s.seller_id','left');
		$this->db->join(USER_ACTIVITY.' as ua','ua.activity_id =p.id','left');
		$this->db->where('s.seller_id',$shopId);	
		$this->db->where('ua.activity_time >=',$timeseen);	
		$this->db->where('(`ua`.`activity_name` LIKE "%favorite item%" OR `ua`.`activity_name` LIKE "%Unfavorite item%")');
		#$this->db->like('ua.activity_name', 'favorite item');
		#$this->db->or_like('ua.activity_name', 'Unfavorite item'); 
		$this->db->order_by('ua.activity_time','desc');
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	
	////   Get activity count  ////
	public function get_activity_count($user_id=''){
		$this->db->select('COUNT(id) as activity_count');
		$this->db->from(USER_ACTIVITY);
		$this->db->where('view_action','Not Yet');	
		$this->db->where('user_id',$user_id);			
		$activityCnt= $this->db->get();
		
		return $activityCnt->row()->activity_count;
	
	}
	
	
	///////// Get Shop activity List//////////////
	public function get_myshopactivity($condition='',$postnumbers=10,$offset=0){
		$this->db->select('ua.*,u.*');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->join(USERS.' as u' , 'ua.user_id = u.id');
		$this->db->where($condition);	
		#$this->db->group_by('ua.activity_id');
		$this->db->order_by('ua.activity_time','desc');
		$this->db->limit($postnumbers,$offset);
		$shopactivityDetails= $this->db->get();
		#echo $this->db->last_query(); die;
		return $shopactivityDetails;
	}
	///////// Get Favorite Shops with products for activity //////////////
	public function getfavshops_activity($userId=''){
		$this->db->select('p.*,u.user_name,u.email,u.full_name,u.thumbnail,u.city,s.seller_businessname as shopname,s.seourl as shopurl,s.seller_banner as seller_banner');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');	
		$this->db->join(SELLER.' as s' , 's.seller_id = p.user_id');
		$this->db->where('s.seller_id ='.$userId);	
		$shopproductDetails= $this->db->get();
		#echo $this->db->last_query(); die;
		return $shopproductDetails;
	}
	public function get_conversation_details($userId='',$type='inbox'){
	$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,s1.seller_businessname as sendershopname,s1.seourl as sendershopurl,u.user_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		if($type=='inbox'){
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left');
			
			#$condition='c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread")';
			$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
			$this->db->where($condition);	
			/*$this->db->where('c.receiver_id ='.$userId);	
			$this->db->or_where('c.receiver_status ="Read"');
			$this->db->or_where('c.receiver_status ="Unread"'); 	*/
		}else if($type=='sent'){
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")';
			$this->db->where($condition);	
			/*$this->db->where('c.sender_id ='.$userId);
			$this->db->where('c.sender_status ="Read"');
			$this->db->or_where('c.sender_status ="Unread"'); 	*/
		}else if($type=='all'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left');
			$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
			#$condition='((c.receiver_id ='.$userId.' OR c.sender_id ='.$userId.') AND ((c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))))';
			$this->db->where($condition); 	
			/*$this->db->where('c.sender_id ='.$userId);	
			$this->db->or_where('c.receiver_id ='.$userId);*/ 
		}else if($type=='trash'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='(c.sender_id ='.$userId.' AND c.sender_status ="Trash") OR (c.receiver_id ='.$userId.' AND c.receiver_status ="Trash")';
			$this->db->where($condition); 	
		}
		
		#$this->db->group_by('c.tid');
		$this->db->order_by('c.dataAdded','desc');
		$conversationlist= $this->db->get();
		#echo $this->db->last_query(); die;
		return $conversationlist;
	}
	public function get_conversation_list($userId='',$type='inbox'){
	$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,s1.seller_businessname as sendershopname,s1.seourl as sendershopurl,u.user_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');	
		$this->db->join(USERS.' as u' , 'c.sender_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left');
		$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
		$this->db->where($condition); 	
		#$this->db->group_by('c.tid');
		$this->db->order_by('c.dataAdded','desc');
		$conversationlist= $this->db->get();
		return $conversationlist;
	}
	public function get_message_details($msgId=''){
	$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,u.user_name as receiver_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->where('c.tid ='.$msgId);
		$this->db->where('(c.sender_id ='.$this->checkLogin('U').' OR c.receiver_id ='.$this->checkLogin('U').')');
		$this->db->group_by("c.tid");
		$messageDetails= $this->db->get();
		#echo $this->db->last_query(); die;
		#print_r ($messageDetails->result()); die;
		return $messageDetails;
	}
	public function get_full_message_details($msgId=''){
	$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,u.user_name as receiver_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->where('c.tid ='.$msgId);
		$this->db->where('(c.sender_id ='.$this->checkLogin('U').' OR c.receiver_id ='.$this->checkLogin('U').')');
		$this->db->order_by("c.dataAdded","DESC");
		$messageDetails= $this->db->get();
		return $messageDetails;
	}
	public function chk_conersation($userId='',$tid='',$another=''){
		$Query = "SELECT c.id FROM ".CONTACTPEOPLE." c
						WHERE 
						((c.sender_id =".$userId." OR c.receiver_id =".$another.") OR (c.sender_id =".$another." OR c.receiver_id =".$userId."))
						AND (
						(c.sender_id =".$userId." AND (c.sender_status ='Read' OR c.sender_status ='Unread')) 
						OR (c.receiver_id =".$userId." AND (c.receiver_status ='Read' OR c.receiver_status ='Unread'))
						)
						AND tid=".$tid."			
						";									
		return $this->ExecuteQuery($Query);
	}
	
	public function getFollowersFollowingList($values=''){
		$run='FIND_IN_SET(u.id, "'.$values.'")';
		$this->db->select('u.id,u.user_name,u.thumbnail');
		$this->db->from(USERS.' as u');
		$this->db->where($run);		
		$listVal = $this->db->get();
		return $listVal;
	}
	
	public function getuserProductsList($userId=''){
		$this->db->select('id,seller_product_id');
		$this->db->from(PRODUCT);
		$this->db->where('user_id',$userId);		
		$resultVal = $this->db->get();
		return $resultVal;
	}
	
	
	
	public function get_notification_list($userId='',$ownProductList="",$ownOrderList="",$participatedOrdersList="",$indexval="",$numRows=""){
		$Query = "SELECT n.* FROM ".NOTIFICATIONS." n
						WHERE 
						(n.user_id !=".$userId.") 
						AND (
						(n.activity='follow' AND n.activity_id=".$userId.")
						OR (n.activity='favorite shop' AND n.activity_id=".$userId.")
						OR (n.activity='favorite item' AND FIND_IN_SET(n.activity_id , '".$ownProductList."'))
						OR (n.activity='review' AND n.activity_id=".$userId.")
						OR (n.activity='Make offer')
						OR (n.activity='Edit offer')
						OR (n.activity='Accept offer ' AND n.comment_id ='".$userId."')
						OR (n.activity='Reject offer' AND n.comment_id ='".$userId."')
						OR (n.activity='Decline offer' AND n.comment_id ='".$userId."')
						OR (n.activity='review-update' AND n.activity_id=".$userId.")
						OR (n.activity='message' AND n.activity_id=".$userId.")
						OR (n.activity='question' AND n.activity_id=".$userId.")
						OR (n.activity='order' AND FIND_IN_SET(n.activity_id , '".$ownOrderList."'))
						OR (n.activity='discussion' AND FIND_IN_SET(n.activity_id , '".$ownOrderList."'))
						OR (n.user_id !=".$userId." AND FIND_IN_SET(n.activity_id , '".$participatedOrdersList."'))
						)
						AND view_mode='Yes'  AND n.activity!='report-item' 
						ORDER BY n.created DESC
						LIMIT ".$indexval." , ".$numRows."						
						";		
							#echo $this->db->last_query();die; 
						/* OR (n.activity='report-shop' AND n.activity_id=".$userId.")
						OR (n.activity='report-item' AND FIND_IN_SET(n.activity_id , '".$ownProductList."')) */
		return $this->ExecuteQuery($Query);
	}

	public function get_all_notification_list($userId='',$ownProductList="",$ownOrderList="",$participatedOrdersList=""){
		$Query = "SELECT COUNT(n.id) as notificationCount FROM ".NOTIFICATIONS." n
						WHERE 
						(n.user_id !=".$userId.") 
						AND (
						(n.activity='follow' AND n.activity_id=".$userId.")
						OR (n.activity='favorite shop' AND n.activity_id=".$userId.")
						OR (n.activity='favorite item' AND FIND_IN_SET(n.activity_id , '".$ownProductList."'))
						OR (n.activity='review' AND n.activity_id=".$userId.")
						OR (n.activity='Make offer')
						OR (n.activity='Reject offer'  AND n.comment_id ='".$userId."')
						OR (n.activity='Accept offer' AND n.comment_id ='".$userId."' )
						OR (n.activity='Edit offer')
						OR (n.activity='Decline offer' AND n.comment_id ='".$userId."')
						OR (n.activity='review-update' AND n.activity_id=".$userId.")
						OR (n.activity='message' AND n.activity_id=".$userId.")
						OR (n.activity='question' AND n.activity_id=".$userId.")
						OR (n.activity='order' AND FIND_IN_SET(n.activity_id , '".$ownOrderList."'))
						OR (n.activity='discussion' AND FIND_IN_SET(n.activity_id , '".$ownOrderList."'))
						OR (n.user_id !=".$userId." AND FIND_IN_SET(n.activity_id , '".$participatedOrdersList."'))
						)
						AND view_mode='Yes' AND n.activity!='report-item' 
						ORDER BY n.created DESC
						";									
						/* OR (n.activity='report-shop' AND n.activity_id=".$userId.")
						OR (n.activity='report-item' AND FIND_IN_SET(n.activity_id , '".$ownProductList."')) */
		return $this->ExecuteQuery($Query);
	}
	
	public function get_activity_follow($user_id=''){
		$this->db->select('u.id,u.user_name,u.thumbnail');
		$this->db->from(USERS.' as u');
		$this->db->where('u.id',$user_id);		
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	public function get_activity_favorite_item($note_id=''){
		$this->db->select('u.id,u.user_name,u.thumbnail,p.seourl as productUrl,p.id as product_id,p.product_name,p.image');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(PRODUCT.' as p' , 'p.id = note.activity_id','left');
		$this->db->where('note.id',$note_id);
		$resultVal = $this->db->get();
		#echo $this->db->last_query();
		#echo "<pre>";print_r($resultVal->row());die;
		return $resultVal->row();
	}
	public function get_activity_offer_item($note_id='',$cmd_id=''){
		$this->db->select('u.id,u.user_name,u.thumbnail,p.seourl as productUrl,p.id as product_id,p.product_name,p.image');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(PRODUCT.' as p' , 'p.id = note.activity_id','left');
		$this->db->where('note.id',$note_id);
		$this->db->where('note.comment_id',$cmd_id);
		$resultVal = $this->db->get();
		#echo $this->db->last_query();
		#echo "<pre>";print_r($resultVal->row());die;
		return $resultVal->row();
	}		
	public function get_activity_favorite_shop($note_id=''){
		$this->db->select('u.id,u.user_name,u.thumbnail,s.seller_businessname,so.thumbnail as seller_image,s.seourl as shopUrl');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = note.activity_id','left');
		$this->db->join(USERS.' as so' , 'so.id = s.seller_id','left');
		$this->db->where('note.id',$note_id);
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	public function get_activity_message($note_id=''){
		$this->db->select('u.id,u.user_name,note.id,u.thumbnail,ques.message as message');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(CONTACTPEOPLE.' as ques' , 'ques.tid = note.comment_id','left');
		$this->db->where('note.id',$note_id);
		$this->db->order_by('ques.dataAdded','ASC');
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	public function get_activity_discussion($note_id=''){
		$this->db->select('u.id,u.user_name,note.id,u.thumbnail,dis.post_message as message');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(ORDER_COMMENTS.' as dis' , 'dis.id = note.comment_id','left');
		$this->db->where('note.id',$note_id);
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	public function get_activity_order($note_id=''){
		$this->db->select('u.id,u.user_name,u.thumbnail');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->where('note.id',$note_id);
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	public function get_activity_review($note_id=''){		
		$this->db->select('u.id,u.user_name,u.thumbnail,p.seourl as productUrl,p.id as product_id,p.product_name,p.image,feed.rating');
		$this->db->from(NOTIFICATIONS.' as note');
		$this->db->join(USERS.' as u' , 'u.id = note.user_id','left');
		$this->db->join(PRODUCT_FEEDBACK.' as feed' , 'feed.id = note.comment_id','left');
		$this->db->join(PRODUCT.' as p' , 'p.id = feed.seller_product_id','left');
		$this->db->where('note.id',$note_id);
		$resultVal = $this->db->get();
		return $resultVal->row();
	}
	
	

}