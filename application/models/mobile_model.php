<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to mobile Json management
 * @author Teamtweaks
 *
 */
class Mobile_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	/*******Delete product from favorite list***/
	public function product_fav_delete($userid='',$pid=''){
		$this->db->where('p_id', $pid);
		$this->db->where('user_id', $userid);
		$this->db->delete(FAVORITE);
		return;	
	}
	/*******Delete Shop from favorite list***/
	public function fav_delete($userid='',$shopid=''){
		$this->db->where('shop_id', $shopid);
		$this->db->where('user_id', $userid);
		$this->db->delete(FAVORITE);
		return;	
	}
	/*******select particular colum from DB ***/
	public function get_column_details($table='',$condition='',$columnlist=''){
		$this->db->select($columnlist);
		$this->db->from($table);
		$this->db->where($condition);
		return $this->db->get();
	}
 public function get_conversation_unread_count($userId='',$tid){
	$this->db->select('count(c.id) as unreadcount');
		$this->db->from(CONTACTPEOPLE.' as c');	
		$condition='c.receiver_id ='.$userId.' AND  c.receiver_status ="Unread" and c.tid='.$tid.'';
		$this->db->where($condition); 	
	
		$conversationlist= $this->db->get();
 # echo $this->db->last_query();die;
  #exit;
		return $conversationlist;
	}
	/*******To get results ***/
	public function get_in_results($table='',$in_ids='',$columnlist=''){
		$in_idsArr=@explode(',',$in_ids); $id='';
		for($i=0;$i<count($in_idsArr);$i++){
			if($in_idsArr[$i] != ''){
				if($i ==0){
					$id.="'".$in_idsArr[$i]."'";
				}else{
					$id.=",'".$in_idsArr[$i]."'";
				}
			}
		}
		$this->db->select($columnlist);
		$this->db->from($table);
		if($id!=''){
			$this->db->where('id IN ('.$id.')',NULL,FALSE);
		}
		$this->db->limit(4);
		return $this->db->get(); 
	}
	/*******to get product from favorite list***/
	public function getFavoriteProduct($userId='',$condition='',$limit=2000,$offset=0){
		$this->db->select('p.id as product_id,p.image as product_image,p.price,p.seourl as product_url,s.seller_businessname as shop_name,s.seourl as shop_url,a.pricing');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(FAVORITE.' as f','f.p_id=p.id');
		$this->db->join(SELLER.' as s','s.seller_id=p.user_id','left');
		$this->db->join(SUBPRODUCT.' as a','p.id=a.product_id','left');
		$this->db->where('f.user_id',$userId);
		if($condition != ''){
			$this->db->where($condition);
		}
		$this->db->group_by('p.id');
		return $this->db->get();
	}
	/*******to get product list***/
	function get_product_detail($condition='',$slectColums=''){		
		$this->db->select($slectColums);
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s','s.seller_id=p.user_id','left');
		$this->db->join(SUBPRODUCT.' as a','p.id=a.product_id','left');
		$this->db->where($condition,NULL,FALSE);
		return $this->db->get();
	}
	/*******to get shop list***/
	function get_shops_details($condition='',$colums='',$postnumbers=20,$offset=0){ 
		$this->db->select($colums);
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u','u.id=s.seller_id');
		if($condition !=''){
			$this->db->where('s.seller_id',$condition);
		}
		$this->db->where('s.status','active');
		$this->db->where('u.group','seller');
		$this->db->limit($postnumbers,$offset);
		return $this->db->get();
	}
	/*******to get all shop list***/
	public function get_allshop_details($condition='',$colums='',$type="DESC",$postnumbers=20,$offset=0){ 
		$this->db->select($colums);
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u','u.id=s.seller_id');
		if($condition !=''){
			$this->db->where('s.seller_id',$condition);
		}
		$this->db->where('s.status','active');
		$this->db->where('u.group','seller');
		$this->db->order_by('s.id',$type);
		$this->db->limit($postnumbers,$offset);
		return $this->db->get();
	}
	/*******to get all shop list***/
	public function get_total_shop($condition=''){ 
		$this->db->select('s.id');
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u','u.id=s.seller_id');
		if($condition !=''){
			$this->db->where('s.seller_id',$condition);
		}
		$this->db->where('s.status','active');
		$this->db->where('u.group','seller');
		return $this->db->get();
	}
	/*******to get shop product count ***/
	public function get_shops_productCount($sid=''){
		$this->db->select('COUNT(id) as pCount');
		$this->db->from(PRODUCT.' as p');
		$this->db->where('user_id',$sid);
		$this->db->where('status','Publish');
		$this->db->where('pay_status','Paid');
		$this->db->group_by('user_id');
		return $this->db->get();
	}
	/*******to get activity count ***/
	public function get_activity($condition='',$postnumbers=20,$offset=0){
		$this->db->select('ua.*');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->where($condition);	
		#$this->db->group_by('ua.activity_id');
		$this->db->order_by('ua.activity_time','DESC');
		$this->db->limit($postnumbers,$offset);
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	/*******to get all Activity ***/
	public function get_all_activity($condition=''){
		$this->db->select('ua.id,ua.activity_id');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->where($condition);	
		$this->db->order_by('ua.activity_time','DESC');
		$activityDetails= $this->db->get();
		return $activityDetails;
	}
	/*******to get Feed Product***/
	public function get_feed_product($product_id=""){
		$this->db->select('p.id as productId,p.product_name as productName,p.base_price as productPrice,p.seourl as productUrl,p.image as productImage,s.seller_businessname as storeName');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 's.seller_id=p.user_id','left');	
		$this->db->where('p.id',$product_id);
		$feedproductDetails= $this->db->get();
		return $feedproductDetails;
	}
	/*******to get Feed shop***/
	public function get_feed_shop($shop_id=""){
		$this->db->select('s.seller_id as sellerId,s.seller_businessname as shopName,s.seourl as shopUrl,u.user_name as sellerLink,u.full_name as sellerFirstName,u.last_name as sellerLastName,u.thumbnail as sellerImage,u.city as Location');
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u' , 'u.id=s.seller_id');	
		$this->db->where('s.seller_id',$shop_id);
		$feedShopDetails= $this->db->get();
		return $feedShopDetails;
	}
	/*******to get Feed user***/
	public function get_feed_user($user_id=""){
		$this->db->select('u.id as userId,u.user_name as userName,u.full_name as userFirstName,u.last_name as userLastName,u.thumbnail as userImage');
		$this->db->from(USER.' as u');
		$this->db->where('u.id',$user_id);
		$feeduserDetails= $this->db->get();
		return $feeduserDetails;
	}
	/*******to get favourite product list***/
	public function getFavoriteListProduct($userId='',$postnumbers=2000,$offset=0){
		$this->db->select('p.id as product_id,p.product_name,p.image as product_image,p.price,p.base_price,p.seourl as product_url,s.seller_businessname as shop_name,s.seourl as shop_url,s.seller_id as sellerId');
		$this->db->from(FAVORITE.' as f');
		$this->db->join(PRODUCT.' as p','p.id=f.p_id');
		$this->db->join(SELLER.' as s','s.seller_id=p.user_id','left');
		$this->db->where('f.user_id',$userId);
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','Active');
		$this->db->where('f.p_id IS NOT NULL');
		$this->db->group_by('p.id');
		$this->db->order_by('f.time','DESC');
	
		$this->db->limit($postnumbers,$offset);
		$favListProduct= $this->db->get();
		return $favListProduct;
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
	public function getFavoriteListProduct_count($userId=""){
		$Query = "select p.id from ".FAVORITE." f LEFT JOIN ".PRODUCT." p ON p.id=f.p_id LEFT JOIN ".SELLER." s ON s.seller_id=p.user_id  where f.user_id='".$userId."' and p.status='Publish' and p.pay_status ='Paid' and s.status ='Active' and f.p_id IS NOT NULL group by p.id";
		return $this->ExecuteQuery($Query);
	}
	/*******to get favourite shop list***/
	public function getFavoriteListShop($userId='',$postnumbers=2000,$offset=0){
		$this->db->select('s.seller_id as shopId,s.seller_banner as seller_banner,s.seller_businessname as shop_name,s.seourl as shop_url,u.user_name as sellerLink,u.full_name as sellerFirstName,u.last_name as sellerLastName,u.thumbnail as sellerImage');
		$this->db->from(FAVORITE.' as f');
		$this->db->join(SELLER.' as s','s.seller_id=f.shop_id','left');
		$this->db->join(USERS.' as u','u.id=s.seller_id','left');
		$this->db->where('f.user_id',$userId);
		$this->db->where('s.status','Active');
		$this->db->where('f.shop_id IS NOT NULL');
		$this->db->order_by('f.time','DESC');
		$this->db->limit($postnumbers,$offset);
		$favListShop= $this->db->get();
		return $favListShop;
	}
	
	
		public function get_featured_product_details_mobile(){
		$this->db->select('p.*,p.seourl as product_seourl, u.thumbnail,u.user_name,u.full_name,s.seourl as shop_seourls,s.review_count,s.shop_ratting,s.seller_businessname');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('p.product_featured','Yes');
		$this->db->where('s.status','active');
		$this->db->order_by('p.id','desc');
		$this->db->limit(4);
		return $this->db->get();
	
			
	}
	
		public function get_featured_shop_details_mobile(){
	
		$this->db->select('s.*,u.id as user_newid,u.thumbnail,u.user_name,u.full_name');
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u','s.seller_id=u.id');
			
		$this->db->where('s.status','active');
		$this->db->where('s.featured_shop','Yes');
		$this->db->order_by('s.id','desc');
		$this->db->limit(7);
		return $this->db->get();
	
			
	}
	
		public function getmaxfav_mobile()
	{
	
		$this->db->select('f.*,s.*,u.thumbnail,count(f.shop_id) as new_id');
	
	$this->db->from(FAVORITE.' as f');
		$this->db->join(USERS.' as u','f.shop_id=u.id');
		$this->db->join(SELLER.' as s','s.seller_id= f.shop_id');
		$this->db->where('f.favorite','Yes');
		$this->db->where('s.status','Active');
		$this->db->group_by('f.shop_id,');
		$this->db->order_by('new_id','desc');
		$this->db->limit(4);
		return $this->db->get();
	
	}
	
	public function  get_fav_product_details_mobile($user_id = '')
	{
	$this->db->select('*');
	$this->db->from(PRODUCT.' as p');
	$this->db->where('p.user_id',$user_id);	
	$this->db->order_by('p.id','desc');
		$this->db->limit(4);
		 return $this->db->get();
		// print_r($this->db->last_query());die;
	}
	
	public function get_recent_product_details_mobile(){
	
		$this->db->select('p.*,p.seourl as product_seourl,u.thumbnail,u.user_name,u.full_name,s.seourl as shop_seourls,s.review_count,s.shop_ratting,s.seller_businessname');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('s.status','Active');
		$this->db->order_by('p.id','desc');
		$this->db->limit(4);
		return $this->db->get();
	
			
	}
	/*******to get Shops product list***/
	public function get_shopProducts($shop_id="",$postnumbers=2000,$offset=0){
		$this->db->select('p.id as productId,p.product_name as productName,p.seourl as productUrl,p.image as productImage');
		$this->db->from(PRODUCT.' as p');
		$this->db->where('p.user_id',$shop_id);
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->order_by('p.created','DESC');
		$this->db->limit($postnumbers,$offset);
		$shopProducts= $this->db->get();
		return $shopProducts;
	}
	
	public function get_shopProducts_count($shop_id=""){
		$Query = "select count(p.id) as total from ".PRODUCT." as p where p.user_id='".$shop_id."' and p.status='Publish' and p.pay_status ='Paid'";
		return $this->ExecuteQuery($Query);
	}
	
	
	/*******to get seller id***/
	public function get_sellerId($seourl=''){		
		$this->db->select('seller_id');
		$this->db->from(SELLER);
		$this->db->where('seourl',$seourl);
		$feeduserDetails= $this->db->get();
		return $feeduserDetails->row()->seller_id;
	}
	/*******to get product list to pay***/
	public function get_paymentProduct($userId='',$sellerId=''){
		$this->db->select('p.image,p.product_name,us.quantity');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USER_SHOPPING_CART.' as us','us.product_id=p.id');
		$this->db->where('us.user_id',$userId);
		$this->db->where('us.sell_id',$sellerId);
		return $this->db->get();
	}
	/******************************* SELLER APP MODELS STARTS FROM HERE***********************************/
	public function sellerAuthentication($email="",$password=""){		
		$condition = '(u.email = \''.addslashes($email).'\' OR u.user_name = \''.addslashes($email).'\') AND u.password=\''.$password.'\' AND u.status=\'Active\'';
		$this->db->select('s.seller_id as sellerId,s.seourl as shopUrl,u.thumbnail as sellerImage,u.user_name as sellerName,s.shop_ratting starRating');
		$this->db->from(USERS.' as u');
		$this->db->join(SELLER.' as s','s.seller_id=u.id','left');
		$this->db->where($condition);
		#$this->db->where('s.status','Active');
		$sellerAuth= $this->db->get();
		return $sellerAuth;
	}
	/******************************* SELLER APP MODELS ENDS HERE***********************************/
	public function get_myshopactivity($condition='',$postnumbers=20,$offset=0){
		#$this->db->select('ua.*,u.*');
		$this->db->select('ua.*,u.id,u.user_name,u.followers_count,u.following_count,u.thumbnail');
		$this->db->from(USER_ACTIVITY.' as ua');
		$this->db->join(USERS.' as u' , 'ua.user_id = u.id');
		$this->db->where($condition);	
		#$this->db->where('ua.activity_name','favorite item');	
		#$this->db->group_by('ua.activity_id');
		$this->db->order_by('ua.activity_time','desc');
		$this->db->limit($postnumbers,$offset);
		$shopactivityDetails= $this->db->get();
		#echo $this->db->last_query(); die;
		return $shopactivityDetails;
	}		
	/*******to get shop order details***/
	public function view_shop_order_details($sell_id="",$shipstatus=""){
		$this->db->select('p.created,p.quantity,p.dealCodeNumber,p.shipping_status,p.total,u.id as userId,u.email,u.full_name,u.user_name,u.thumbnail as userImage,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.image, pd.product_name,pd.id as PrdID,c.attr_name,count(p.product_id) as totalItems');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');		
		$this->db->where('p.status','Paid');
		$this->db->where('p.payment_type != "COD"');	
		if($shipstatus=="Delivered"){
			$this->db->where('p.shipping_status ="'.$shipstatus.'"');	
		}else{
			$this->db->where('p.shipping_status !="Delivered"');	
		}
		$this->db->where('p.sell_id = "'.$sell_id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$PrdList = $this->db->get();
		
		return $PrdList;
	}
	
	public function view_shop_order_details_pagination($sell_id="",$shipstatus="",$postnumbers="",$offset=""){
		$this->db->select('p.*,u.id as userId,u.email,u.full_name,u.user_name,u.thumbnail as userImage,u.address,u.phone_no,u.postal_code,u.state,u.country,u.city,pd.image, pd.product_name,pd.id as PrdID,c.attr_name,count(p.product_id) as totalItems');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(PRODUCT_ATTRIBUTE.' as c' , 'c.id = p.attribute_values','left');		
		$this->db->where('p.status','Paid');
		$this->db->where('p.payment_type != "COD"');	
		if($shipstatus=="Delivered"){
			$this->db->where('p.shipping_status ="'.$shipstatus.'"');	
		}else{
			$this->db->where('p.shipping_status !="Delivered"');	
		}
		$this->db->where('p.sell_id = "'.$sell_id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$this->db->limit($postnumbers,$offset);	
		$PrdList = $this->db->get();
		#echo $this->db->last_query(); die();
		return $PrdList;
	}
	/*******to get total Order amount***/
	public function get_total_order_amount($sid='0'){
		$Query = "select sum(pr.sumTotal) as TotalAmt,sum(pr.Tax) as TotalTax, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal,p.tax as Tax ,u.full_name from ".USERS." u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.payment_type!='COD'  and p.shipping_status='Delivered'	 group by p.dealCodeNumber
			) pr";			
		return $this->ExecuteQuery($Query);
	}
	/*******to get total paid details***/
	public function get_total_paid_details($sid='0'){
		$Query = "select sum(amount) as totalPaid from ".VENDOR_PAYMENT." where `status`='success' and `vendor_id`='".$sid."' group by `vendor_id`";
		return $this->ExecuteQuery($Query);
	}
	/*******to get Order Information***/
	public function get_order_info($sell_id="",$user_id="",$dealCodeNumber=""){
		$this->db->select('p.*,u.id as userId,u.email,u.user_name,u.thumbnail as userImage,s.id as sellerId,s.email as sellerEmail,s.user_name as sellerUserName,s.thumbnail as sellerImage,p.sell_id as shopId');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->join(USERS.' as s' , 'p.sell_id = s.id');
		$this->db->where('p.sell_id = "'.$sell_id.'"');				
		$this->db->where('p.user_id = "'.$user_id.'"');				
		$this->db->where('p.dealCodeNumber = "'.$dealCodeNumber.'"');				
		$orderList = $this->db->get();
		return $orderList;
	}
	/*******to get product order***/
	public function view_order_product($id=""){
		$this->db->select('p.*,pd.product_name as productName,pd.image as productImage');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->where('p.id = "'.$id.'"');	
		$prdInfo = $this->db->get();
		return $prdInfo;
	}
	/*******to get product information ***/
	public function list_product_info($id=''){		
		$this->db->select("p.id,p.image,p.base_price,p.product_name,s.seller_businessname as shop_name,s.seourl as shop_url,s.seller_id");
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s','s.seller_id=p.user_id','left');
		$this->db->where('p.id = "'.$id.'"');	
		return $this->db->get();
	}
	/*******to get user order list***/
	public function view_user_order_details($user_id="",$status="Paid",$postnumbers=20,$offset=0){
		$this->db->select('p.*,u.thumbnail as sellerImage,s.seller_businessname as shopName,s.seller_id as sellerId,count(p.product_id) as totalItems,pd.image, pd.product_name,pd.id as PrdID');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->join(SELLER.' as s' , 's.seller_id = p.sell_id');
		$this->db->join(USERS.' as u' , 'u.id = s.seller_id');
		$this->db->where('p.payment_type != "COD"');	
		$this->db->where('p.status ="'.$status.'"');	
		$this->db->where('p.user_id = "'.$user_id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "DESC"); 
		$this->db->limit($postnumbers,$offset);
		$PrdList = $this->db->get();
		return $PrdList;
	}
	/*******to get order status***/
	public function get_order_stats($condition=''){
		$this->db->select('up.id');
		$this->db->from(USER_PAYMENT.' as up');
		$this->db->where($condition);	
		$this->db->group_by("up.dealCodeNumber"); 
		#$this->db->order_by('up.created','DESC');
		$orderStats= $this->db->get();
		return $orderStats;
	}
	/*******to get revenue Tax ***/
	public function get_revenue_tax_stats($sid="",$condition=""){
		$Query = "select sum(pr.sumTotal) as TotalAmt,sum(pr.Tax) as TotalTax, count(pr.sumTotal) as orders from (
			select p.dealCodeNumber, sum(p.sumtotal) as sumTotal,p.tax as Tax ,u.full_name from ".USERS." u
			JOIN ".USER_PAYMENT." p on p.sell_id=u.id
			where u.id='".$sid."' and p.status='Paid' and p.shipping_status='Delivered' AND ".$condition." group by p.dealCodeNumber
			) pr";			
		return $this->ExecuteQuery($Query);
	}
	/*******to get discussion history***/
	public function get_discussion_history($orderId=""){
		$this->db->select('id,posted_by,posted_id,claim_id,post_message,image,post_time,posted_by');
		$this->db->from(ORDER_COMMENTS);
		$this->db->where('orderid = "'.$orderId.'"');	
		$this->db->order_by("post_time", "desc"); 
		$disHistory = $this->db->get();
		return $disHistory;
	}
	public function get_discussion_history_count($orderId=""){
		$Query = "select count(id) as total from ".ORDER_COMMENTS." where orderid='".$orderId."' group by orderid ";			
		return $this->ExecuteQuery($Query);
	}
	public function get_discussion_history_pagination($orderId="",$postnumbers="",$offset=""){
		$this->db->select('id,posted_by,posted_id,claim_id,post_message,image,post_time,posted_by');
		$this->db->from(ORDER_COMMENTS);
		$this->db->where('orderid = "'.$orderId.'"');	
		$this->db->order_by("post_time", "asc"); 
		$this->db->limit($postnumbers,$offset);	
		$disHistory = $this->db->get();
		return $disHistory;
	}
	/*******to get claim list***/
	public function get_claimList($sellerId="",$claimStatus){
		$this->db->select('c.seller_id,c.dealcodenumber,c.total_amount,u.id as buyerId,u.user_name buyerName,u.thumbnail');
		$this->db->from(ORDER_CLAIM.' as c');
		$this->db->join(USERS.' as u' , 'u.id = c.buyer_id','left');
		$this->db->where('c.seller_id = "'.$sellerId.'"');	
		$this->db->where('c.status = "'.$claimStatus.'"');	
		$claimList = $this->db->get();
		return $claimList;
	}
	public function get_claimList_pagination($sellerId="",$claimStatus,$postnumbers="",$offset=""){
		$this->db->select('c.seller_id,c.dealcodenumber,c.total_amount,u.id as buyerId,u.user_name buyerName,u.thumbnail');
		$this->db->from(ORDER_CLAIM.' as c');
		$this->db->join(USERS.' as u' , 'u.id = c.buyer_id','left');
		$this->db->where('c.seller_id = "'.$sellerId.'"');	
		$this->db->where('c.status = "'.$claimStatus.'"');	
		$this->db->limit($postnumbers,$offset);	
		$claimList = $this->db->get();
		return $claimList;
	}
	/*******to get claim details***/
	public function getClaim($sellerId="",$claimStatus=''){
		$this->db->select('c.seller_id,c.dealcodenumber,c.total_amount,c.claimed_time,c.status,u.id as buyerId,u.user_name buyerName,u.thumbnail');
		$this->db->from(ORDER_CLAIM.' as c');
		$this->db->join(USERS.' as u' , 'u.id = c.buyer_id','left');
		$this->db->where('c.seller_id = "'.$sellerId.'"');	
		$this->db->where('c.status = "Opened"');	
		$this->db->order_by("c.claimed_time", "desc"); 
		$claimList = $this->db->get();
		return $claimList;
	}
	/*******to get order details***/
	public function get_order_details($dealCodeNumber){
		$this->db->select('p.dealCodeNumber,p.user_id as buyer_id,p.sell_id as seller_id,buyer.user_name as buyer_name,buyer.thumbnail as buyer_img,buyer.email as buyer_mail,seller.user_name as seller_name,seller.thumbnail as seller_img,seller.email as seller_mail');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as buyer' , 'buyer.id = p.user_id','left');
		$this->db->join(USERS.' as seller' , 'seller.id = p.sell_id','left');		
		$this->db->where('p.dealCodeNumber = "'.$dealCodeNumber.'"');
		$this->db->group_by("p.dealCodeNumber"); 
		$orderInfo = $this->db->get();
		return $orderInfo;
	}
	/*******to get order***/
	public function getOrders($sell_id=""){
		$this->db->select('p.created,p.dealCodeNumber,p.total,p.sell_id as shopId,u.id as userId,u.user_name,u.thumbnail as userImage,count(p.product_id) as totalItems');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(USERS.' as u' , 'p.user_id = u.id');
		$this->db->where('p.status','Paid');	
		$this->db->where('p.sell_id = "'.$sell_id.'"');				
		$this->db->group_by("p.dealCodeNumber"); 
		$this->db->order_by("p.created", "desc"); 
		$orderList = $this->db->get();
		return $orderList;
	}
	/*******to get image size***/
	public function get_image_size($image_path=''){ 
		list($w, $h) = getimagesize($image_path); 
		return $w.'--'.$h;
	}
	/*******to get Conversation list***/
	public function get_total_conversation_List($userId='',$type = '',$perpage='',$paginationVal=''){		
		$this->db->select('id');
		$this->db->from(CONTACTPEOPLE);	
		if($type == 'U'){
		$condition='(sender_id ='.$userId.' AND (sender_status ="Read" OR sender_status ="Unread"))';
		}else if($type == 'S'){
		$condition='(receiver_id ='.$userId.' AND (receiver_status ="Read" OR receiver_status ="Unread"))';
		}else{
		$condition='(sender_id ='.$userId.' AND (sender_status ="Read" OR sender_status ="Unread")) OR (receiver_id ='.$userId.' AND (receiver_status ="Read" OR receiver_status ="Unread"))';
		}
		
		$this->db->where($condition);	
		$this->db->group_by('tid');
		$conversation= $this->db->get();
		return $conversation;
	}
	
		public function get_conversation_List($userId='',$ownerId = ''){		
		$this->db->select('*');
		$this->db->from(CONTACTPEOPLE);				
		$condition='(sender_id ='.$userId.' AND receiver_id ='.$ownerId.' AND (sender_status ="Read" OR sender_status ="Unread")) OR (receiver_id ='.$userId.' AND sender_id ='.$ownerId.' AND (receiver_status ="Read" OR receiver_status ="Unread"))';
		$this->db->where($condition);	
		$this->db->group_by('tid');
		$this->db->limit(1);
		$conversation= $this->db->get();
		return $conversation;
	}
	/*******to get Conversation details list***/
	public function get_conversation_details_List($userId='',$perpage='',$paginationVal='',$type=''){		
		$this->db->select('max(id) as recent_id');
		$this->db->from(CONTACTPEOPLE);	
		
        if($type =='U'){
			$condition='(sender_id ='.$userId.' AND (sender_status ="Read" OR sender_status ="Unread")) ';
		}else if($type =='S'){
			$condition='(receiver_id ='.$userId.' AND (receiver_status ="Read" OR receiver_status ="Unread"))';
		}else{
			$condition='(sender_id ='.$userId.' AND (sender_status ="Read" OR sender_status ="Unread")) OR (receiver_id ='.$userId.' AND (receiver_status ="Read" OR receiver_status ="Unread"))';
		}		
		
		$this->db->where($condition);	
		$this->db->group_by('tid');
		if($perpage>=0 && $paginationVal>=0){
			$this->db->limit($perpage,$paginationVal);
		}
		$conversation= $this->db->get();
		$idList=''; $i=0;
		foreach($conversation->result() as $threads){
			if($i==0){
				$idList.="'".$threads->recent_id."'";
			} else {
				$idList.=",'".$threads->recent_id."'";
			}
			$i++;
		}
		$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,s1.seller_businessname as sendershopname,s1.seourl as sendershopurl,u.user_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left','left');
		$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left','left');
		if($idList!=""){
		$condition='c.id IN('.$idList.')';
		}else{
		$condition='c.id IN(-1)';
		}
		$this->db->where($condition);	
		$this->db->order_by('c.dataAdded','desc');
		$conversationlist= $this->db->get();
		return $conversationlist;
	}
	/*******to get Message details***/
	public function get_message_details($msgId='',$userId=''){
		$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,u.user_name as receiver_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->where('c.tid ='.$msgId);
		$this->db->where('(c.sender_id ='.$userId.' OR c.receiver_id ='.$userId.')');
		$this->db->order_by('dataAdded','asc');
		$messageDetails= $this->db->get();
		return $messageDetails;
	}
	/*******to Insert & update* push key**/
	public function insertupdatePushKey($user_id='',$UDID='',$user_type='',$device_type=''){
		$this->db->select('gcm_buyer_id,gcm_seller_id,ios_device_id');
		$this->db->from(USERS);
		$this->db->where('id',$user_id);
		$userVals= $this->db->get();
		if($userVals->num_rows()>0){
			if($UDID==""){
				$UDID=NULL;
			}
			if($device_type=='android'){
				if($user_type=='user'){
					$sqlupdate = "UPDATE ".USERS." SET gcm_buyer_id=NULL WHERE gcm_buyer_id='".$UDID."'";
					$sqlinsert = "UPDATE ".USERS." SET gcm_buyer_id='".$UDID."' WHERE id=".$user_id."";
				}
				if($user_type=='seller'){
					$sqlupdate = "UPDATE ".USERS." SET gcm_seller_id=NULL WHERE gcm_seller_id='".$UDID."'";
					$sqlinsert = "UPDATE ".USERS." SET gcm_seller_id='".$UDID."' WHERE id=".$user_id."";
				}
				
				
				// changes on 11-08-2015 
				$sqlupdate = "UPDATE ".USERS." SET gcm_buyer_id=NULL WHERE gcm_buyer_id='".$UDID."'";
				$sqlinsert = "UPDATE ".USERS." SET gcm_buyer_id='".$UDID."' WHERE id=".$user_id."";
				
				
			}else if($device_type=='ios'){
				$sqlupdate = "UPDATE ".USERS." SET ios_device_id=NULL WHERE ios_device_id='".$UDID."'";
				$sqlinsert = "UPDATE ".USERS." SET ios_device_id='".$UDID."' WHERE id=".$user_id."";
			}
			$this->ExecuteQuery($sqlupdate);
			$this->ExecuteQuery($sqlinsert);
		}
	}
	/*******to get shop feedback details***/
	public function get_shop_feed_details($shop_id='',$postnumbers='',$offset=''){
		$this->db->select('buyer.privacy,buyer.id as userId,buyer.user_name as userName,buyer.email as userEmail,buyer.thumbnail as thumbnail,buyer.full_name as fullname,buyer.last_name as last_name,p.id as productId,p.product_name,image as image,p.seourl as seo_url,feed.*');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_FEEDBACK.' as feed' , 'feed.seller_product_id=p.id','inner');
		$this->db->join(USERS.' as buyer' , 'buyer.id=feed.voter_id','inner');
		$this->db->where('feed.shop_id',$shop_id);
		$this->db->order_by('feed.id','desc');
		if($postnumbers !=''){
		$this->db->limit($postnumbers,$offset);
		}
		$feedback_query = $this->db->get();
		return $feedback_query;	
	}
	
	public function get_shop_review_details($shop_id='',$perpage=-1,$paginationVal=-1){
		$this->db->select('buyer.id as userId,buyer.user_name as userName,buyer.thumbnail as thumbnail,buyer.full_name as fullname,buyer.last_name as last_name,p.id as productId,p.product_name,image as image,p.seourl as seo_url,feed.*');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(PRODUCT_FEEDBACK.' as feed' , 'feed.seller_product_id=p.id','inner');
		$this->db->join(USERS.' as buyer' , 'buyer.id=feed.voter_id','buyer.status=Active','inner');
		$this->db->where('feed.shop_id',$shop_id);
		$this->db->where('feed.status','Active');
		$this->db->order_by('feed.id','desc');
		if($perpage>=0 && $paginationVal>=0){
			$this->db->limit($perpage,$paginationVal);
		}
		$feedback_query = $this->db->get();
		return $feedback_query;	
	}
	/*******to get report details***/
	public function get_feed_report_details($id=''){	
		$this->db->select('report.description,report.report_time');
		$this->db->from(REPORT_REVIEW.' as report' , 'report.review_id=feed.id','inner');
		$this->db->where('report.review_id',$id);
		$report_query = $this->db->get();
		return $report_query;	
	}
	
}