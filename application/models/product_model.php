<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to product management
 * @author Teamtweaks
 *
 */
class Product_model extends My_Model
{
	/*** To add product
	Param 1.Array $dataArr to add
	***/
	public function add_product($dataArr=''){
			//$this->db->insert(PRODUCT,$dataArr);
		$this->db->insert(PRODUCT_EN,$dataArr);
	}
	/*** To add product attribute
		Param 1..Array $dataArr to add
	***/
	public function add_subproduct_insert($dataArr=''){
			$this->db->insert(SUBPRODUCT,$dataArr);
	}
	/*** To add contact seller 
		Param 1..Array $dataArr to add
	***/
	public function contact_seller_add($dataArr=''){
			$this->db->insert(CONTACTSELLER,$dataArr);
	}
	/*** To add contact User
		Param 1..Array $dataArr to add
	***/
	public function contact_user_add($dataArr=''){
			$this->db->insert(CONTACTUSER,$dataArr);
	}
	/*** To edit product
		Param 	1.Array $dataArr to add
					2.Array $Condition to check
	***/
	public function edit_product($dataArr='',$condition='',$table=''){ 
			$this->db->where($condition);
			//$this->db->update(PRODUCT,$dataArr);
			if($table == ''){
				$this->db->update(PRODUCT_EN,$dataArr);
			}else{
				$this->db->update($table,$dataArr);
			}
	}
	/*** To edit dispute 
		Param 	1.Array $dataArr to add
					2.Array $Condition to check
	***/
	public function edit_dispute_attachment($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(ORDER_COMMENTS,$dataArr);
			//echo $this->db->last_query(); die;
	}
	/*** To edit product attribute
		Param 	1.Array $dataArr to add
					2.Array $Condition to check
	***/
	public function edit_subproduct_update($dataArr='',$condition=''){
			$this->db->where($condition);
			$this->db->update(SUBPRODUCT,$dataArr);
	}
	/*** To delete product attribute
		Param 1.Array $Condition to check
	***/
	public function delete_subproduct_all($condition=''){
		    $this->db->where($condition);
			$this->db->delete(SUBPRODUCT);
			
	}
	/*** To view product
		Param 	1.Array $Condition to check
	***/
	public function view_product($condition=''){
			return $this->db->get_where(PRODUCT,$condition);
			
	}
	/*** To view published product
		Param 	1. String $Product_Url to check
	***/
	public function view_published_product_detail($p_url=''){ 
		$this->db->select('p.*');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');		
		#$this->db->where('p.status','Publish');
		#$this->db->where('p.pay_status','Paid');
		$this->db->where('p.seourl',$p_url);
		$this->db->where('s.status','active');
		return $this->db->get();
	}
	
	/*********** select attribute values Group By
		Param 	1.Constant $tableName
					2.Array $Condition to check
					3.String $groupBy 
	****************/
	public function get_subproductdetail_GroupEditpage($tableName,$condtion,$group_by){
		
		$select_qry = "select s.*,a.* from ".SUBPRODUCT." s LEFT JOIN ".PRODUCT_ATTRIBUTE." a on s.attr_name=a.attr_seourl where s.product_id=".$condtion." group by s.".$group_by." order by s.pricing desc";
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
   }
   /*** To view product attribute by group
		Param 	1.Constant $tableName
					2.Array $Condition to check
					3.String $groupBy 
   ***/
   public function get_subproductdetail_Group($tableName,$condtion,$group_by){
		
   		$this->db->select('*');
		$this->db->group_by($group_by);
		$this->db->order_by('pricing','desc');
		$result=$this->db->get_where($tableName,$condtion);
		return $result->result_array();
		
   }
   /*** To get product order
		Param 	1.String $Condition to check
					2.String $order by Column
					3.String $Order 
					3.Integer $limit 
   ***/
   public function get_order_by_details($condtion,$orderbycol,$order,$limit){
		
   		$this->db->select(SELLER.'.*,'.USERS.'.*');
		//$this->db->select(USERS.'.*');
		$this->db->from(SELLER,SELLER);
		$this->db->join(USERS,USERS.'.id='.SELLER.'.seller_id','left');
		$this->db->group_by($group_by);
		$this->db->order_by($orderbycol,$order);
		$this->db->limit($limit);
		$this->db->where($condtion);
		$result=$this->db->get(); 
		#echo $this->db->last_query(); die;
		return $result;
   }
   
   /*** To get product order by blog post***/
   public function get_order_by_details_Blog_post(){
		
   		$this->db->select('seller.seller_businessname,seller.seourl as shopurl,user.thumbnail,user.id as user_id,posts.post_title,posts.post_content,posts.guid');
		//$this->db->select(USERS.'.*');
		$this->db->from(SELLER.' as seller');
		$this->db->join(USERS.' as user','user.id=seller.seller_id','left');
		$this->db->join(BLOG_USERS.' as Buser','Buser.user_login=user.user_name','left');
		$this->db->join(POSTS.' as posts','posts.post_author=Buser.ID','left');
		$this->db->where('seller.featured_shop ="Yes" and seller.status="active"');
		$this->db->where('posts.post_status ="publish"');
		$this->db->order_by('posts.post_author','RANDOM');
		$this->db->limit(1);
		$result=$this->db->get(); 
		#echo $this->db->last_query(); die;
		return $result;
		
   }
   /**************feature product *****************/
   public function get_feature_poducts($starting_date,$expire){
		$this->db->select('fp.*,p.status');
		$this->db->from(FEATURE_PRODUCT.' as fp');
		$this->db->join(PRODUCT.' as p','fp.product_seo=p.seourl');
		$this->db->where('(fp.start_date between "'.$starting_date.'" and "'.$expire.'" and fp.page ="home" and p.status = "Publish" ) OR ( fp.expire_date between "'.$starting_date.'" and "'.$expire.' " and fp.page ="home" and p.status = "Publish")');
		$this->db->where('page','home');		
		return $this->db->get();
		 
   }
   
	/*** To view product details
		Param 	1.String $Condition to check
					2.String $option 
	***/
	public function view_product_details($condition = '',$opt=''){
		if($opt==''){
			$select_qry = "select p.user_id,p.id,p.category_id,p.seourl,p.quantity,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.deal_date_to,p.deal_time_to,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname,fp.id as fp_id,fp.pack_id,fp.start_date,fp.page from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN shopsy_subproducts sub on p.id= sub.product_id LEFT JOIN ".FEATURE_PRODUCT." fp on fp.product_seo = p.seourl".$condition;
		 }else{
			$select_qry = "select p.user_id,p.id,p.category_id,p.quantity,p.seourl,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.deal_date_to,p.deal_time_to,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname,fp.id as fp_id,fp.pack_id,fp.start_date,fp.page from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id   LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN shopsy_subproducts sub on p.id= sub.product_id LEFT JOIN ".FEATURE_PRODUCT." fp on fp.product_seo = p.seourl ".$condition;
		}

		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query();
		//echo "<pre>";print_r($productList->result());die;
		return $productList;
			
	}
	public function view_product_details_feature($condition = '',$opt=''){
		if($opt==''){
			$select_qry = "select p.user_id,p.id,p.category_id,p.seourl,p.quantity,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.deal_date_to,p.deal_time_to,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname,fp.id as fp_id,fp.pack_id,fp.start_date,fp.page from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN shopsy_subproducts sub on p.id= sub.product_id JOIN ".FEATURE_PRODUCT." fp on fp.product_seo = p.seourl".$condition;
		 }else{
			$select_qry = "select p.user_id,p.id,p.category_id,p.quantity,p.seourl,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.deal_date_to,p.deal_time_to,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname,fp.id as fp_id,fp.pack_id,fp.start_date,fp.page from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id   LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN shopsy_subproducts sub on p.id= sub.product_id JOIN ".FEATURE_PRODUCT." fp on fp.product_seo = p.seourl ".$condition;
		}

		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query();
		//echo "<pre>";print_r($productList->result());die;
		return $productList;
			
	}
 	
	
	
/****	
	public function view_product_details($condition = '',$opt=''){
		if($opt==''){
			$select_qry = "select p.user_id,p.id,p.category_id,p.seourl,p.quantity,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id ".$condition;
		 }else{
		 
			$select_qry = "select p.user_id,p.id,p.category_id,p.quantity,p.seourl,p.product_name,p.price,p.image,p.base_price,p.status,p.created,p.product_promoted,p.deal_date,p.deal_time_from,p.action,p.discount,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,p.product_featured,p.pay_status,p.feature_expire,s.seller_businessname from ".PRODUCT." p LEFT JOIN ".USERS." u on p.user_id=u.id   LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  LEFT JOIN ".SELLER." s on p.user_id=s.seller_id".$condition;
		}
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
****/	
	/*** To view product details Count
		Param 	1.String $Condition to check
	***/
	public function view_product_details_count($condition = ''){
		/* $select_qry = "select ROWNUM from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id".$condition;
		
		LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id
		LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  */
		/*  $select_qry = "select COUNT(p.id) as totalItem from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id 
				JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id
						".$condition;  
						
		 $productList =  $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query();die;
		return $productList; */
		$select_qry = "select * from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id LEFT JOIN shopsy_subproducts sub on p.id= sub.product_id LEFT JOIN  ".FEATURE_PRODUCT." fp on fp.product_seo = p.seourl ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		#echo $this->db->last_query();die;
		return $productList;
		
	}
	
	public function view_product_details1($condition = ''){
		
			$select_qry = "select p.*,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,u.feature_product,s.seller_businessname as shop_name,s.seourl as shop_seourl,a.pricing from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id".$condition;
		
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	public function view_product_details_count_admin($condition = ''){
		
		/* $select_qry = "select ROWNUM from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id".$condition;
		LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id
		LEFT JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id  */
		
		$select_qry = "select COUNT(p.id) as totalItem from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id
		 JOIN ".SUB_SHIPPING." ss on p.id=ss.product_id
		 ".$condition;
		
		 $productList =  $this->ExecuteQuery($select_qry);
		 //echo $this->db->last_query();die;
		 return $productList;
		
	}
	
	
	/*** To view product details
		Param 	1.String $Condition to check
	***/
	
	/*** To get shop shop name
		Param 	1.Integer $UserId to check
	***/
	public function get_business_name($userId){
			
		$this->db->select('seller_businessname as shop_name,seourl as shop_seourl');
		$this->db->from(SELLER);
		$this->db->where('seller_id',$userId);
		$this->db->where('status','active');
		$result=$this->db->get();
		//echo $this->db->last_query(); die;		
		return $result;	
	
	}
	
	
	
	/*** To view product details registry
		Param 	1.String $Condition to check
	***/
	public function view_registry_product_details($condition = ''){
		$select_qry = "select p.*,s.seller_businessname as shop_name,s.seourl as shop_seourl,a.pricing from ".PRODUCT." p LEFT JOIN ".REGISTRY_LISTINGS." reg on reg.listing_id=p.id LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
	}
	
	/*** To view spam product reports
		Param 	1.String $Condition to check
	***/
	public function view_spam_product_reports($condition = ''){
		$select_qry = "select p.*,u.id as sellerid,u.email as seller_email,u.full_name,u.user_name,u.thumbnail,u.feature_product,s.seller_businessname as shop_name,s.seourl as shop_seourl,spam.spam_title,spam.complaint,spam.complaint_date,spam.id as spam_id,count(spam.product_id) as spam_count from ".PRODUCT." p LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN ".SPAM_REPORT." spam on p.id=spam.product_id LEFT JOIN ".USERS." u on u.id=spam.user_id".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	/*** To view product spam
		Param 	1.String $Condition to check
	***/
	public function view_spam_product_details($condition = ''){
		$select_qry = "select p.*,u.id as sellerid,u.email as seller_email,u.full_name as seller_name,u.thumbnail as seller_thumbnail,s.seller_businessname as shop_name,s.seourl as shop_seourl,spam.spam_title,spam.complaint,spam.complaint_date,spam.id as spam_id,us.feature_product,us.id as reporterid,us.email as reporter_email,us.full_name as reporter_name,us.thumbnail as reporter_thumbnail from ".PRODUCT." p LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN ".SPAM_REPORT." spam on p.id=spam.product_id LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".USERS." us on us.id=spam.user_id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
	
	}
	/*** To view spam shop reports
		Param 	1.String $Condition to check
	***/
	public function view_spam_shop_reports($condition = ''){
		$select_qry = "select u.id as sellerid,u.email as seller_email,u.full_name as seller_name,u.user_name,u.thumbnail,u.feature_product,s.seller_businessname as shop_name,s.seourl as shop_seourl,spam.spam_title,spam.complaint,spam.complaint_date,spam.id as spam_id,count(spam.seller_id) as spam_count from ".USERS." u LEFT JOIN ".SELLER." s on u.id=s.seller_id LEFT JOIN ".SPAM_REPORT." spam on u.id=spam.seller_id".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query(); die;
		return $productList;
			
	}
	//.SELLER." s on spam.seller_id=s.seller_id LEFT JOIN "
	/*** To view spam shop
		Param 	1.String $Condition to check
	***/
	public function view_spam_shop_details($condition = ''){
		$select_qry = "select u.id as sellerid,u.email as seller_email,u.full_name as seller_name,u.thumbnail as seller_thumbnail,s.seller_businessname as shop_name,s.seourl as shop_seourl,spam.spam_title,spam.complaint,spam.complaint_date,spam.id as spam_id,us.feature_product,us.id as reporterid,us.email as reporter_email,us.full_name as reporter_name,us.thumbnail as reporter_thumbnail from ".SPAM_REPORT." spam LEFT JOIN ".SELLER." s on spam.seller_id=s.seller_id  LEFT JOIN " .USERS." u on u.id=spam.seller_id LEFT JOIN ".USERS." us on us.id=spam.user_id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
		
			
	}
	/*** To get spam who posted
		Param 	1.String $Condition to check
	***/
	public function view_spam_reports_get_reportersData($condition = ''){
		$select_qry = "select u.id as reporterid,u.email as reporter_email,u.full_name,u.full_name as reporter_name,u.thumbnail as reporter_thumbnail from ".USERS." u LEFT JOIN ".SPAM_REPORT." spam on u.id=spam.user_id".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
	
	/*** To get product by section 
		Param 	1.String $Condition to check
	***/
	public function view_product_details_from_section($condition = ''){
		$select_qry = "select p.*,u.id as sellerid,u.email as selleremail,u.full_name,u.user_name,u.thumbnail,u.feature_product,a.pricing from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id LEFT JOIN ".SHOP_SECTION_LIST." s on s.seller_id=p.user_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id".$condition;
		
		
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query(); die;
		return $productList;
			
	}
	/*** To view product by section 
		Param 	1.Integer $userId to check
	***/
	public function view_product_details_from_section_all($userId){
		
		$select_qry = "select count(id) as totalCount from ".PRODUCT." where pay_status='Paid' and user_id='".$userId."'";
		$productList = $this->ExecuteQuery($select_qry);
		//echo $this->db->last_query(); die;
		return $productList;
			
	}
	/*** To get product***/	
	public function get_product_details($status='')
	{
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.USERS.'.email as userEmail,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT_FEEDBACK.'.*,'.PRODUCT.'.seourl as product_url');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.seller_product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		if($status != "")
			$this->db->where(PRODUCT_FEEDBACK.'.status',$status);
	 	$feedback_query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $feedback_query;
	}
		/*** To get product feed back
			Param 	1.String $condition to check
		***/	
	public function get_productfeed_details($condition='')
	{
	
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.USERS.'.email as userEmail,'.USERS.'.thumbnail as thumbnail,'.USERS.'.full_name as fullname,'.USERS.'.last_name as last_name,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT.'.seourl as seo_url,'.PRODUCT_FEEDBACK.'.*');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.seller_product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		$this->db->where(PRODUCT_FEEDBACK.'.status','Active');
		$this->db->where(PRODUCT_FEEDBACK.'.shop_id',$condition);
		$feedback_query = $this->db->get();
		#echo $this->db->last_query(); die;
		return $feedback_query;
	
	}
	
		/*** To get product feedback by admin
			Param 	1.String $condition to check
		***/	
	public function get_productfeed_details_admin($condition='')
	{
	
		$this->db->select(USERS.'.id as userId,'.USERS.'.user_name as userName,'.USERS.'.email as userEmail,'.USERS.'.thumbnail as thumbnail,'.USERS.'.full_name as fullname,'.USERS.'.last_name as last_name,'.PRODUCT.'.id as productId,'.PRODUCT.'.product_name,image as image,'.PRODUCT.'.seourl as seo_url,'.PRODUCT_FEEDBACK.'.*');
		$this->db->from(PRODUCT);
		$this->db->join(PRODUCT_FEEDBACK,PRODUCT_FEEDBACK.'.seller_product_id='.PRODUCT.'.id','inner');
		$this->db->join(USERS,USERS.'.id='.PRODUCT_FEEDBACK.'.voter_id','inner');
		$this->db->order_by(PRODUCT_FEEDBACK.'.id','desc');
		#$this->db->where(PRODUCT_FEEDBACK.'.status','Active');
		$this->db->where(PRODUCT_FEEDBACK.'.id',$condition);
		$feedback_query = $this->db->get();
		#echo $this->db->last_query(); die;
		return $feedback_query;
	
	}
		/*** To get featured product
			Param 	1.integer $product_id to check
		***/	
	public function get_featured_details($pid='0'){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".PRODUCT." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
		$productList = $this->ExecuteQuery($Query);
		$productList->mode = 'sell_product';
		if ($productList->num_rows() != 1){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id=".$pid." and p.status='Publish'";
			$productList = $this->ExecuteQuery($Query);
			$productList->mode = 'user_product';
		} 
		return $productList;
	}
		/*** To get product
			Param 	1.integer $product_id to check
		***/	
	public function get_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			$this->db->where_in('p.seller_product_id',$productIds);
			$this->db->where('p.status','Publish');
			$this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(USERS.' as u','u.id=p.user_id');
			$productList = $this->db->get();
		} 
		return $productList;
	}
		/*** To get unsold  product
			Param 	1.integer $product_id to check
		***/	
	public function get_notsell_wants_product($wantList){
		$productList = '';
		if ($wantList->num_rows() == 1){
			$productIds = array_filter(explode(',', $wantList->row()->product_id));
			$this->db->where_in('p.seller_product_id',$productIds);
			$this->db->where('p.status','Publish');
			$this->db->select('p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product');
			$this->db->from(USER_PRODUCTS.' as p');
			$this->db->join(USERS.' as u','u.id=p.user_id');
			$productList = $this->db->get();
		} 
		return $productList;
	}
		/*** To get unsold product details
			Param 	1.String $condition to check
		***/	
	public function view_notsell_product_details($condition = ''){
 		$select_qry = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product from ".USER_PRODUCTS." p LEFT JOIN ".USERS." u on u.id=p.user_id ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		return $productList;
			
	}
	
		/*** To get attribute details***/	
	public function view_atrribute_details(){
		$select_qry = "select * from ".ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
		/*** To get category details
			Param 	1.integer $id to check
		***/	
	public function view_cat_details($id){
		$this->db->select('*');
		$this->db->from(CATEGORY);
		 if($id != '') { 
		$this->db->where('id',$id);	
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); 
		return $countall = $query->result_array(); 
		
		//$query->result_array($attList);
	
	}
	
		/*** To get sub- product
			Param 	1.integer $product_id to check
		***/	
	public function view_subproduct_details($prdId=''){
		$select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
		/*** To get sub product by join
			Param 	1.integer $product_id to check
		***/	
	public function view_subproduct_details_join($prdId=''){
		//$select_qry = "select * from ".SUBPRODUCT." where product_id = '".$prdId."'";
		$select_qry = "select a.*,b.* from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_name = b.attr_seourl where a.product_id = '".$prdId."' order by a.pricing asc";
		//echo "<pre>"; print_r($select_qry->result_array()); die;
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
		/*** To get sub product by group
			Param 	1.integer $product_id to check
		***/	
	public function view_subproduct_details_group($prdId=''){
		$select_qry = "select a.attr_name,b.attr_name from ".SUBPRODUCT." a join ".PRODUCT_ATTRIBUTE." b on a.attr_name = b.id where a.product_id = '".$prdId."' GROUP BY a.attr_id ";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
		/*** To get shopping cart product
			Param 	1.integer $product_id to check
						2.integer $userid to check
		***/	
	public function view_shopping_cart_subproduct_val($userid='',$prdId=''){
		$select_qry = "select quantity,attribute_values from ".SHOPPING_CART." where product_id = '".$prdId."' and user_id='".$userid."'";
		return $shopAttrList = $this->ExecuteQuery($select_qry);
	
	}
		/*** To get product attribute***/	
	public function view_product_atrribute_details(){
		$select_qry = "select * from ".PRODUCT_ATTRIBUTE." where status='Active'";
		return $attList = $this->ExecuteQuery($select_qry);
	
	}
	/*** To get product shipping details***/	
	public function view_product_shipping_details(){
		$select_qry = "select * from ".COUNTRY_LIST." where status='Active'";
		return $CntyList = $this->ExecuteQuery($select_qry);
	
	}
	/*** To get product category details***/	
	public function view_category_details(){
	
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->view_category_list($CatRow,'1');		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->view_category_list($SubCatRow,'2');	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->view_category_list($SubCatRow1,'3');	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->view_category_list($SubCatRow2,'4');	

					}			
				}
			}
		}
					
		return $catView;
	}
	/*** To get category list
			Param 	1.integer $category_id to check
						2.String $value	
	***/	
	public function view_category_list($CatRow,$val){
	$SubcatView ='';
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}
	/*** To get category details
			Param 	1.Array $categoryList to check
	***/	
	public function get_category_details($catList=''){
		$catListArr = explode(',', $catList);
		$select_qry = "select * from ".CATEGORY." where rootID=0";
		$categoryList = $this->ExecuteQuery($select_qry);
		$catView='';$Admpriv = 0;$SubPrivi = '';

		foreach ($categoryList->result() as $CatRow){
			
			$catView .= $this->get_category_list($CatRow,'1',$catListArr);		
			
			$sel_qry = "select * from ".CATEGORY." where rootID='".$CatRow->id."'  ";	
			$SubList = $this->ExecuteQuery($sel_qry);	
				
			foreach ($SubList->result() as $SubCatRow){
					
				$catView .= $this->get_category_list($SubCatRow,'2',$catListArr);	
					
				$sel_qry1 = "select * from ".CATEGORY." where rootID='".$SubCatRow->id."'  ";	
				$SubList1 = $this->ExecuteQuery($sel_qry1);	
					
				foreach ($SubList1->result() as $SubCatRow1){
					$catView .= $this->get_category_list($SubCatRow1,'3',$catListArr);	
					
					$sel_qry2 = "select * from ".CATEGORY." where rootID='".$SubCatRow1->id."'  ";	
					$SubList2 = $this->ExecuteQuery($sel_qry2);	
		
					foreach ($SubList2->result() as $SubCatRow2){
						$catView .= $this->get_category_list($SubCatRow2,'4',$catListArr);	

					}			
				}
			}
		}
		return $catView;
	}
	/*** To get category list
			Param 	1.integer $category_id to check
						2.String $value	
						3.Array $CategoryList	
	***/	
	public function get_category_list($CatRow,$val,$catListArr=''){
	$SubcatView ='';
	if (in_array($CatRow->id, $catListArr)){ 
		$checkStr = 'checked="checked"';
	}else {
		$checkStr = '';
	}
	$SubcatView .= '<span class="cat'.$val.'"><input name="category_id[]" '.$checkStr.' class="checkbox" type="checkbox" value="'.$CatRow->id.'" tabindex="7"><strong>'.$CatRow->cat_name.' &nbsp;</strong></span>';
	return $SubcatView;					
	}
	/*** To get category list
			Param 	1.integer $category_id to check
	***/	
	public function get_cat_list($ids=''){
		$this->db->where_in('id',explode(',', $ids));
		return $this->db->get(CATEGORY);
	}
	/*** To get top user in category 
			Param 	1.integer $category_id to check
	***/	
	public function get_top_users_in_category($cat=''){
		$productArr = array();
		$userArr = array();
		$userCountArr = array();
		$condition = " where p.category_id like '".$cat.",%' AND p.status = 'Publish' OR p.category_id like '%,".$cat."' AND p.status = 'Publish' OR p.category_id like '%,".$cat.",%' AND p.status = 'Publish' OR p.category_id='".$cat."' AND p.status = 'Publish'";
		$productDetails = $this->view_product_details($condition);
		if ($productDetails->num_rows()>0){
			foreach ($productDetails->result() as $productRow){
				if (!in_array($productRow->id, $productArr)){
					array_push($productArr, $productRow->id);
					if ($productRow->user_id != ''){
						if (!in_array($productRow->user_id, $userArr)){
							array_push($userArr, $productRow->user_id);
							$userCountArr[$productRow->user_id] = 1;
						}else {
							$userCountArr[$productRow->user_id]++;
						}
					}
				}
			}
		}
		arsort($userCountArr);
		return $userCountArr;
	}
	/*** To get recent like
			Param 	1.integer $product_id to check
						2.integer $limit	
						3.String $sort	
	***/	
	public function get_recent_like_users($pid='',$limit='10',$sort='desc'){
		$Query = 'select pl.*, p.product_name, p.likes, u.full_name, u.user_name,u.thumbnail from '.PRODUCT_LIKES.' pl 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id 
					JOIN '.USERS.' u on u.id=pl.user_id and u.status="Active"
					where pl.product_id="'.$pid.'" order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	/*** To get recent like 
			Param 	1.integer $user_id to check
						2.integer $product_id to check
						3.integer $limit	
						4.String $sort	
	***/	
	public function get_recent_user_likes($uid='',$pid='',$limit='3',$sort='desc'){
		$condition = '';
		if ($pid!=''){
			$condition = ' and pl.product_id != "'.$pid.'" ';
		}
		$Query = 'select pl.*,u.user_name,u.full_name,u.thumbnail,p.product_name,p.id as PID,p.created,p.sale_price,p.image from '.PRODUCT_LIKES.' pl
					JOIN '.USERS.' u on u.id=pl.user_id 
					JOIN '.PRODUCT.' p on p.seller_product_id=pl.product_id
					JOIN '.USERS.' u1 on u1.id=p.user_id and u1.group="Seller" and u1.status="Active"
					where pl.user_id = "'.$uid.'" '.$condition.' order by pl.id '.$sort.' limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	/*** To get user like 
			Param 	1.integer $product_id to check
	***/	
	public function get_like_user_full_details($pid='0'){
		$Query = "select u.* from ".PRODUCT_LIKES.' p
					JOIN '.USERS.' u on u.id=p.user_id
					where p.product_id='.$pid;
		return $this->ExecuteQuery($Query);
	}
	/*** To get category value 
			Param 	1.String $selVal to select
						2.String $whereCond to check
	***/	
	public function getCategoryValues($selVal,$whereCond) {	
		$sel = 'select '.$selVal.' from '.CATEGORY.' c LEFT JOIN '.CATEGORY.' sbc ON c.id = sbc.rootID '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*** To get category Result 
			Param 	1.String $selVal to select
						2.String $whereCond to check
	***/	
	public function getCategoryResults($selVal,$whereCond) {	
		$sel = 'select '.$selVal.' from '.CATEGORY.' '.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*** To search shop by category 
			Param 	1.String $whereCond to check
	***/	
	public function searchShopyByCategory($whereCond) {	
 		$sel = 'select p.* from '.PRODUCT.' p 
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*
	echo $sel = 'select p.*,s.* from '.PRODUCT.' p,'.SELLER.' a
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
				LEFT JOIN '.SELLER.' s on s.id=p.user_id 
		 		'.$whereCond.' ';die;
	*/
	/*** To search shop by category on user 
			Param 	1.String $whereCond to check
	***/	
	public function searchShopyByCategoryUSERS($whereCond) {	
 		$sel = 'select p.*,u.user_name from '.USER_PRODUCTS.' p 
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*** To search size by
			Param 	1.String $whereCond to check
	***/	
	public function searchSizeBy($whereCond) {	
 		$sel = 'select p.* from '.PRODUCT.' p LEFT JOIN '.SUBPRODUCT.' S on p.id=S.product_id JOIN '.PRODUCT_ATTRIBUTE.' PA on S.attr_id=PA.id
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*** To search size by user
			Param 	1.String $whereCond to check
	***/	
	public function searchSizeByUser($whereCond) {	
 		$sel = 'select p.*,u.user_name from '.USER_PRODUCTS.' p 
		 		LEFT JOIN '.USERS.' u on u.id=p.user_id 
		 		'.$whereCond.' ';
		return $this->ExecuteQuery($sel);
	}
	/*** To add user product
			Param 	1.Integer $userId to check
	***/	
	public function add_user_product($uid=''){
		$seller_product_id = mktime();
		$checkId = $this->check_product_id($seller_product_id);
		while ($checkId->num_rows()>0){
			$seller_product_id = mktime();
			$checkId = $this->check_product_id($seller_product_id);
		}
		$dataArr = array(
			'product_name'		=>	$this->input->post('name'),
			'seourl'			=>	url_title($this->input->post('name'),'-'),
			'sale_price'		=>	$this->input->post('price') + $this->input->post('shipprice'),
			'price'				=>	$this->input->post('price'),
			'product_shipping'	=>	$this->input->post('shipprice'),
			'product_attribute'	=>	$this->input->post('size'),
			'quantity'			=>	$this->input->post('userqty'),			
			'category_id'		=>	$this->input->post('category'),
			'excerpt'			=>	$this->input->post('note'),
			'image'				=>	$this->input->post('image'),
			'user_id'			=>	$uid,
			'seller_product_id' => $seller_product_id
		);
		$this->simple_insert(USER_PRODUCTS,$dataArr);
		return $seller_product_id;
	}
	/*** To get product likes
			Param 	1.String $search_productname to check
	***/	
	public function product_like_list($search_productname='')
	{
		$Query = "select * from ".PRODUCT." where product_name like '%".$search_productname."%'"; 

		return $this->ExecuteQuery($Query);
	}
	/*** To get product id
			Param 	1.integer $product_id to check
	***/	
	public function check_product_id($pid=''){
		$checkId = $this->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}
	/*** To get product by category
			Param 	1.integer $categoryid to check
						2.String $sort 
	***/	
	public function get_products_by_category($categoryid='',$sort='desc'){
		$Query = "select p.*,u.user_name,u.full_name,u.thumbnail from ".PRODUCT." p
			LEFT JOIN ".USERS." u on u.id=p.user_id
			where p.status='Publish' and FIND_IN_SET('".$categoryid."',p.category_id) order by p.`created` ".$sort;
		return $this->ExecuteQuery($Query);
	}
	/*** To get product comment details
			Param 	1.string $condition to check
	***/	
	public function view_product_comments_details($condition = ''){
		$select_qry = "select p.product_name,c.product_id,u.full_name,u.user_name,u.thumbnail,c.comments ,u.email,c.id,c.status,c.user_id as CUID
		from ".PRODUCT_COMMENTS." c 
		LEFT JOIN ".USERS." u on u.id=c.user_id 
		LEFT JOIN ".PRODUCT." p on p.seller_product_id=c.product_id ".$condition;
		$productComment = $this->ExecuteQuery($select_qry);
		return $productComment;
			
	}
	/*** To update product comment count
			Param 	1.integer $product_id to check
	***/
	public function Update_Product_Comment_Count($product_id){
	
		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count + 1) WHERE seller_product_id='".$product_id."'";
		$this->ExecuteQuery($Query);
	}
	/*** To update product comment count reduce
			Param 	1.integer $product_id to check
	***/
	public function Update_Product_Comment_Count_Reduce($product_id){
	
		$Query = "UPDATE ".PRODUCT." SET comment_count=(comment_count - 1) WHERE seller_product_id='".$product_id."'";
		return $this->ExecuteQuery($Query);
	}
	/*** To get product by search
			Param 	1.string $search_key to check
						2.integer $limit
	***/
	public function get_products_search_results($search_key='',$limit='5'){
		$Query = 'select p.* from '.PRODUCT.' p 
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" and u.group="Seller"
				or p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and p.user_id=0
				limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	/*** To get product by search for user
			Param 	1.string $search_key to check
						2.integer $limit
	***/
	public function get_products_search_results_user($search_key='',$limit='5'){
		$Query = 'select p.*,u.user_name from '.USER_PRODUCTS.' p 
				LEFT JOIN '.USERS.' u on u.id=p.user_id
				where p.product_name like "%'.$search_key.'%" and p.status="Publish" and p.quantity>0 and u.status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	
	/*** To get search for user
			Param 	1.string $search_key to check
						2.integer $limit
	***/
	public function get_user_search_results($search_key='',$limit='5'){
		$Query = 'select * from '.USERS.' where full_name like "%'.$search_key.'%" and status="Active" OR user_name like "%'.$search_key.'%" and status="Active" limit '.$limit;
		return $this->ExecuteQuery($Query);
	}
	/*** To get product details
			Param 	1.integer $product_id to check
	***/
	public function get_product_full_details($pid=''){
		$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".PRODUCT." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
		$productDetails = $this->ExecuteQuery($Query);
		if ($productDetails->num_rows() == 0){
			$Query = "select p.*,u.full_name,u.user_name,u.thumbnail,u.feature_product,u.email,u.email_notifications,u.notifications from ".USER_PRODUCTS." p JOIN ".USERS." u on u.id=p.user_id where p.seller_product_id='".$pid."'";
			$productDetails = $this->ExecuteQuery($Query);
			$productDetails->prodmode = 'user';
		}else {
			$productDetails->prodmode = 'seller';
		}
		return $productDetails;
	}
	/*** To get user created list on product
			Param 	1.integer $product_id to check
	***/
	public function get_user_created_lists($pid='0'){
		$Query = "select * from ".LISTS_DETAILS." where FIND_IN_SET('".$pid."',product_id)";
		return $this->ExecuteQuery($Query);
	}
	
	
	 /**
    * 
    * Merge two arrays and sort the result array using array_multisort
    * @param Array $ar1	
    * @param Array $ar2
    * @param String $field	=> Field name for sort
    * @param String $type	=> Sort type asc or desc
    */
	/*******************************Should return the Object values**************************/
   /*public function get_sorted_array_object($ar1=array(),$ar2=array(),$field='id',$type='asc'){
   		$products_list_arr = array();
		if (count($ar1)>0 && $ar1->num_rows()>0){
			foreach ($ar1->result() as $ar1_row){
				$products_list_arr['product'][] = $ar1_row;
    			$products_list_arr[$field][] = $ar1_row->$field;
			}
		}

		if (count($ar2)>0 && $ar2->num_rows()>0){
			foreach ($ar2->result() as $ar2_row){
				$products_list_arr['product'][] = $ar2_row;
    			$products_list_arr[$field][] = $ar2_row->$field;
			}
		}
		
		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}
		
		array_multisort($products_list_arr[$field],$sort,
    		$products_list_arr['product']
    	);
		
		return $products_list_arr['product'];
   }
	*/
	
	/*** To get sorted array by type
			Param 	1.Array $arg1 
						2.Array $arg2 
						3.string $field
						4.string $Type
	***/
	
	public function get_sorted_array_object($ar1=array(),$ar2=array(),$field='id',$type='asc'){

   		$products_list_arr = array();
		if (count($ar1)>0 && $ar1->num_rows()>0){
			foreach ($ar1->result() as $ar1_row){
				$products_list_arr['product'][] = $ar1_row;
    			$products_list_arr[$field][] = $ar1_row->$field;
			}
		}

		if (count($ar2)>0 && $ar2->num_rows()>0){
			foreach ($ar2->result() as $ar2_row){
				$products_list_arr['product'][] = $ar2_row;
    			$products_list_arr[$field][] = $ar2_row->$field;
			}
		}
		
		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}
		
		array_multisort($products_list_arr[$field],$sort,
    		$products_list_arr['product']
    	);
		
		return $products_list_arr['product'];
   }
   
   
   
   
   
   
   
	
	
	//S Codes
	
	
	//Search for the shop name
	/*** To search shop by shop Name
			Param 	1.string $productseourl 
	***/
	
	 public function searchShopyByShopname($productseourl){
	 
   		$this->db->select('seller_id');
		$this->db->from(SELLER);
		$this->db->like('seourl',$productseourl);
		$referQuery = $this->db->get();
		
		
		//echo $this->db->last_query(); die;
		$referResult = $referQuery->result_array();
		
		//echo $referResult[0]['id']; die;
		$referidarray = array();
		foreach($referResult as $referKey)
		{
			$referidarray[] = $referKey['seller_id'];
		}
		//print_r($referidarray); die;
		if(!empty($referidarray)){
		
		$this->db->select(PRODUCT.'.id as product_id,'.PRODUCT.'.product_name,'.PRODUCT.'.seourl,'.PRODUCT.'.image,'.PRODUCT.'.sale_price,'.SELLER.'.seller_id,
										'.SELLER.'.seller_businessname,'.SELLER.'.seourl as seller_seourl,'.SELLER.'.seller_store_image');
		$this->db->from(PRODUCT);
		//$this->db->from('shopsy_seller');
		//$this->db->join(SELLER,SELLER.id,PRODUCT.id);
		$this->db->join(SELLER, SELLER.'.seller_id = '.PRODUCT.'.user_id');
		$this->db->where_in(PRODUCT.'.user_id',$referidarray);
		$this->db->where(PRODUCT.'.product_featured','Yes');
		//$this->db->group_by(array(PRODUCT.'.user_id',$referidarray)); 
		//$this->db->where_in(PRODUCT.'.user_id',$referidarray);
		$referQuery = $this->db->get();
		//echo $this->db->last_query(); die;
		//echo $referResult['id']
		//echo '<pre>'; print_r($referQuery); die;
		return $referResult = $referQuery->result_array();
		}
		
   }
	// Select product data for product table
	//param 1.string $productseourl 
   public function get_productdetail_data($productseourl){
   		$this->db->select('*');
		$this->db->from(PRODUCT);
		$this->db->where('seourl',$productseourl);
		$referQuery = $this->db->get();
	//	echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
	//Store view
	// Param	1. String $columns to select 
	//				2. Integer $category_id
	//				3. Integer $searchPerPage
	//				4. Integer $paginationNo
   
      public function get_storedetail_data($columns,$cat_id,$searchPerPage,$paginationNo){
   		$this->db->select($columns);
		$this->db->from(PRODUCT);
		$this->db->where('user_id','42');
		if($cat_id != ''){
		$where = "FIND_IN_SET('".$cat_id."', category_id)";  
         $this->db->where($where);
		}
		$referQuery = $this->db->get();
		//echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
	
	//seller shop view
	// Param	1. String $columns to select 
	//				2. Integer $category_id
	//				3. Integer $searchPerPage
	//				4. Integer $paginationNo
	//				5. Integer $seller_id
	
	    public function get_storedetail_data_store($columns,$cat_id,$searchPerPage,$paginationNo,$seller_id){
  
   		$this->db->select($columns);
		$this->db->from(PRODUCT);
		$this->db->where('user_id',$seller_id);
		if($cat_id != '0'){
		$where = "FIND_IN_SET('".$cat_id."', category_id)";  
         $this->db->where($where);
		}
		$referQuery = $this->db->get();
		//echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   
   	//seller shop view featured
	// Param	1. String $columns to select 
	//				2. Integer $category_id
	//				3. Integer $searchPerPage
	//				4. Integer $paginationNo
	//				5. Integer $seller_id
	//				6. Integer $limit
	    public function get_storedetail_data_storefeature($columns,$cat_id,$searchPerPage,$paginationNo,$seller_id,$limit){
  
   		$this->db->select($columns);
		$this->db->from(PRODUCT);
		$this->db->where('user_id',$seller_id);
		$this->db->where('product_featured','Yes');
		if($cat_id != '0'){
		$where = "FIND_IN_SET('".$cat_id."', category_id)";  
         $this->db->where($where);
		}
		$this->db->limit($limit);
		$referQuery = $this->db->get();
		//echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   
   
   
   	//Category Detail view
	// Param	1. String $columns to select 
	//				2. Integer $category_id
	//				3. Integer $searchPerPage
	//				4. Integer $paginationNo
	    public function get_categorydetail_view($columns,$cat_id,$searchPerPage,$paginationNo){
 
   		$this->db->select($columns);
		$this->db->from(PRODUCT);
		
		if($cat_id != '0'){
		$where = "FIND_IN_SET('".$cat_id."', category_id)";  
         $this->db->where($where);
		}
		$referQuery = $this->db->get();
		//echo $this->db->last_query(); die;
		return $referResult = $referQuery->result_array();
		
   }
   
   
	
	
	//s Codes ends
	
	
	/*******************************Should return the array values**************************/
	// Param	1. Array $arg1  (product Array)
	//				2. Array $arg2	(product Array)
	//				3. string $field
	//				4. string $type
	 public function get_sorted_array($ar1=array(),$ar2=array(),$field='id',$type='asc'){
   		$products_list_arr = array();
   		$products_list_arr['product'] = array();
		if (count($ar1)>0 && $ar1->num_rows>0){
			foreach ($ar1->result_array() as $ar1_row){
				$products_list_arr['product'][] = $ar1_row;
    			$products_list_arr[$field][] = $ar1_row[$field];
			}
		}

		if (count($ar2)>0 && $ar2->num_rows()>0){
			foreach ($ar2->result_array() as $ar2_row){
				$products_list_arr['product'][] = $ar2_row;
    			$products_list_arr[$field][] = $ar2_row[$field];
			}
		}
		
		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}
		
		if (count($products_list_arr['product'])>0){
			array_multisort($products_list_arr[$field],$sort,
    			$products_list_arr['product']
    		);
		}
		
		return $products_list_arr['product'];
   }
		///////// Get Feature Shop Products for Home Page //////////////
		
/*		public function getFeatureProduct($userId=''){
			$this->db->select(SELLER.'.*,'.PRODUCT.'.*');
			$this->db->from(SELLER);
			$this->db->join(PRODUCT, PRODUCT.'.user_id ='.SELLER.'.seller_id');
			$this->db->where(PRODUCT.'.user_id !=','0');
			$this->db->where(SELLER.'.status','active');
			$this->db->order_by(PRODUCT.'.id', 'RANDOM');
			$this->db->limit(5);
			$query = $this->db->get();
			$resultContent = $query->result_array();
			//echo $this->db->last_query(); die;
			return $resultContent;
		}
		*/
		// to view seller details
		public function getSellerDetails(){
			   $this->db->select(SELLER.'.*');
               $this->db->from(SELLER);
			   $this->db->where(SELLER.'.status','active');
		       $this->db->order_by(SELLER.'.id', 'RANDOM');
			   $this->db->limit(5);
			  $query = $this->db->get();
		       $resultContent = $query->result_array();
			//echo $this->db->last_query(); die;
			   return $resultContent;

		}
		// to find featured product
		// Param	1. integer $userId 
		public function getFeatureProduct($userId=''){
			   $this->db->select(PRODUCT.'.*');
               $this->db->from(PRODUCT);
			   $this->db->where(PRODUCT.'.status','Publish');
			   $this->db->where(PRODUCT.'.user_id ',$userId);
			   $this->db->where(PRODUCT.'.product_featured ','Yes');
		       $this->db->order_by(PRODUCT.'.id', 'RANDOM');
			   $this->db->limit(4);
			   $query = $this->db->get();
		       $resultContent = $query->result_array();
			echo $this->db->last_query(); die;
			   return $resultContent;

		}
	// To get the blog details 
	// Param	1. String $type
    function getBlogDetails($type = '')
    {	
		$this->db->select('a.*,b.*');
		$this->db->from(POSTS.' as a');
		$this->db->join(POSTMETA.' as b','b.post_id =a.ID');
	   	$this->db->where('a.post_status','publish');
		$this->db->where('a.post_type','post');
		//$this->db->where('b.meta_key','_wp_attached_file');		
		$this->db->group_by('a.ID');
		$this->db->order_by('post_date', 'desc');
		$this->db->limit(2);
		$query = $this->db->get();
		$resultContent = $query->result();
		return $resultContent;
    }
	
	// To Fetch the Blog image
	// Param	1. String $condition
	function GetBlogimage($condition){  
	
		$this->db->select('b.meta_value');
		$this->db->from(POSTS.' as a');
		$this->db->join(POSTMETA.' as b','b.post_id =a.ID');
		$this->db->where($condition);
		$query = $this->db->get();
		//$resultContent = $query->result();
		//echo $this->db->last_query(); die;
		return $query;
	
	}
	
	// To Fetch the favourite details
	// Param	1. integer $shopid
	function getFavoriteDetails($shopid)
    {
   		$this->db->select(FAVORITE.'.id');
		$this->db->from(FAVORITE);
		$this->db->where('shop_id', $shopid);
		$this->db->where('user_id', $this->session->userdata('shopsy_session_user_id'));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query();
		//print_r($resultContent);
		// die;
		return $query;
			
	}  
	// To Fetch the user favourite details
	// Param	1. integer $shopid
	function getUserFavoriteDetails($shopid)
    {
   		$this->db->select(FAVORITE.'.*');
		$this->db->from(FAVORITE);
		$this->db->where('user_id', $this->session->userdata('shopsy_session_user_id'));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}  
	// To Fetch the user favourite product details
	// Param	1. integer $shopid
	function getUserFavoriteProduct($shopid)
    {
   		$this->db->select(PRODUCT.'.*');
		$this->db->from(PRODUCT);
		$this->db->join(SELLER, SELLER.'.id ='.POSTS.'.posted_user_id');
		$this->db->where('user_id', $shopid);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		#echo $this->db->last_query();
		return $resultContent;
	}  
	// To Fetch the seller favourite product details
	// Param	1. integer $shopid
	function getSellerProductDetails($shopid)
    {
   		$this->db->select(SELLER.'.*');
		$this->db->from(SELLER);
		$this->db->where('id',$shopid);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}  
	// To Fetch the shop favourite details
	// Param	1. integer $seller_id
	function getShopFavDetails($seller_id)
    {
   		$this->db->select(FAVORITE.'.user_id,'.USER.'.*');
		$this->db->from(FAVORITE);
		$this->db->join(USER, USER.'.id ='.FAVORITE.'.user_id');
		$this->db->where(array('shop_id'=>$seller_id));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}  
	// To Fetch the product favourite details
	// Param	1. integer $product_id
	function getProductFavDetails($pid)
    {
   		$this->db->select(FAVORITE.'.user_id,'.USER.'.*');
		$this->db->from(FAVORITE);
		$this->db->join(USER, USER.'.id ='.FAVORITE.'.user_id');
		$this->db->where(array('p_id'=>$pid));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}  
	/*Favorite Controls*/
	// Param	1. integer $shopid
	function getUserFavoriteShopDetails($shopid)
    {
   		$this->db->select(FAVORITE.'.*');
		$this->db->from(FAVORITE);
		$this->db->where(array('user_id'=>$this->session->userdata('shopsy_session_user_id'),'shop_id'=>$shopid));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}  
	// To Fetch the user product favourite details
	// Param	1. integer $product_id
	function getUserFavoriteProductDetails($pid)
    {
   		$this->db->select(FAVORITE.'.*');
		$this->db->from(FAVORITE);
		$this->db->where(array('user_id'=>$this->session->userdata('shopsy_session_user_id'),'p_id'=>$pid));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		#echo $this->db->last_query(); die;
		return $resultContent;
	}  
	// To Fetch the user product favourite count
	// Param	1. integer $product_id
	function getUserFavoriteProductCount($pid)
    {
   		$this->db->select(FAVORITE.'.*');
		$this->db->from(FAVORITE);
		$this->db->where(array('p_id'=>$pid));
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}
	//seller shop list view
	// Param	1. integer $seller_id
	// 			2. integer $product_ID												
	    public function shop_section_list_exist($seller_id,$prodID){
			$this->db->select('*');
			$this->db->from(SHOP_SECTION_LIST);
			$this->db->where('seller_id',$seller_id);
			$where = "FIND_IN_SET('".$prodID."', product_id)";  
			$this->db->where($where);
			$referQuery = $this->db->get();
			//echo $this->db->last_query(); die;
			return $referResult = $referQuery->result_array();	
		
   }
   ///////// Get Favorite Products //////////////		
   // Param	1. integer $userId
	// 			2. String $condition
	// 			3. integer $postnumbers
	// 			4. integer $offset
	public function getFavoriteProduct($userId='',$condition='',$postnumbers=1000,$offset=0){
			#echo $condition;
			$Query = "select p.*,s.seller_businessname,s.seourl as seller_seourl,a.* from ".PRODUCT." p JOIN ".FAVORITE." f on f.p_id=p.id  JOIN ".SELLER." s on s.seller_id=p.user_id  LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id where ".$condition." f.user_id='".$userId."' and p.status = 'Publish' group by p.id LIMIT ".$offset.','.$postnumbers;
			$productDetails = $this->ExecuteQuery($Query);
			#echo $this->db->last_query(); die;
			return $productDetails;
	}
	///////// Get Favorite Shops //////////////
	// Param	1. integer $userId
	public function getFavoriteShops($userId=''){
			$Query = "select s.*,u.thumbnail,u.user_name as user_url from ".SELLER." s JOIN ".FAVORITE." f on f.shop_id=s.seller_id JOIN ".USER." u on u.id=s.seller_id where f.user_id='".$userId."'";
			$productDetails = $this->ExecuteQuery($Query);
			#echo $this->db->last_query(); die;
			return $productDetails;
	}
	///////// Get Favorite Shop Products //////////////
	// Param	1. string $condition
	public function get_product_from_favorite_shop($condition = ''){
		$select_qry = "select p.*,a.pricing from ".PRODUCT." p LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id where p.status='Publish' and ".$condition;
		$productList = $this->ExecuteQuery($select_qry);
		#echo $this->db->last_query(); die;
		return $productList;
			
	}
	///////// Get list Shop Products //////////////
	 // Param	1. integer $product_Id
	// 			2. String $condition
	public function get_list_product_details($prodId = '',$condition=''){
		$select_qry = "select p.*,s.seller_businessname as shop_name,s.seourl as shop_seourl,a.pricing from ".PRODUCT." p LEFT JOIN ".SELLER." s on p.user_id=s.seller_id LEFT JOIN ".SUBPRODUCT." a on p.id=a.product_id where ".$condition." p.id='".$prodId."' GROUP BY a.product_id ";
		$productList = $this->ExecuteQuery($select_qry);
		#echo $this->db->last_query(); die;
		return $productList;	
			
	}
	///////// Get list sub Products price value //////////////
	// Param	1. integer $product_Id	
	public function get_subproduct_minPrice_value($produc_id){
		$this->db->select('pricing');
		$this->db->from(SUBPRODUCT);
		$this->db->where('product_id',$produc_id); 
		$this->db->where('pricing IS NOT NULL'); 
		$this->db->order_by('pricing','asc');
		$this->db->limit(1);
		return $this->db->get();
	}
	///////// Get list Shop Products //////////////
	 // Param	1. array $arg1 to sort
	 // 			2. String $field
	 // 			3. String $type
	public function get_sorted_array_values($ar1=array(),$field='id',$type='asc'){
   		$products_list_arr = array();
		if (count($ar1)>0){
			foreach ($ar1 as $ar1_row){
				$products_list_arr['product'][] = $ar1_row;
    			$products_list_arr[$field][] = $ar1_row[$field];
			}
		}

		
		if ($type == 'asc'){
			$sort = SORT_ASC;
		}else {
			$sort = SORT_DESC;
		}
		
		array_multisort($products_list_arr[$field],$sort,
    		$products_list_arr['product']
    	);
		
		return $products_list_arr['product'];
   }
		
	///////// Recently Favorite Item //////////////
	public function recentlyFavoritItems(){
		$this->db->select('seourl,image,product_name,category_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(FAVORITE.' as f','p.id=f.p_id');
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->group_by('p.id');
		$this->db->order_by('f.time','desc');
		$this->db->limit(6);
		return $this->db->get();
		
	
	}	
	
	public function get_recent_product_details(){
	
		$this->db->select('p.*,p.seourl as product_seourl,u.thumbnail,u.user_name,u.full_name,s.seourl,s.review_count,s.shop_ratting');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('s.status','Active');
		$this->db->order_by('p.id','desc');
		$this->db->limit(9);
		return $this->db->get();
	
			
	}
	
	public function get_featured_product_details(){
	
		$this->db->select('p.*,u.thumbnail,u.user_name,u.full_name,s.seourl as shop_seourls,s.review_count,s.shop_ratting');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');
		$this->db->join(FEATURE_PRODUCT.' as fp ','fp.product_seo = p.seourl');
		$this->db->where('p.status','Publish');
		$this->db->where('fp.page','home');
		$this->db->where('fp.expire_date >="'.date('Y-m-d').'" and fp.start_date <="'.date('Y-m-d').'"');
		//$this->db->where('p.product_featured','Yes');
		$this->db->where('s.status','active');
		$this->db->order_by('p.id','desc');
		$this->db->limit(3);
		return $this->db->get();
		//echo $this->db->last_query();die;
			
	}
	public function get_featured_detail_details(){
	
		$this->db->select('p.*,u.thumbnail,u.user_name,u.full_name,s.seourl as shop_seourls,s.review_count,s.shop_ratting');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');
		$this->db->join(FEATURE_PRODUCT.' as fp ','fp.product_seo = p.seourl');
		$this->db->where('p.status','Publish');
		$this->db->where('fp.page','product detail');
		$this->db->where('fp.expire_date >="'.date('Y-m-d').'" and fp.start_date <="'.date('Y-m-d').'"');
		//$this->db->where('p.product_featured','Yes');
		$this->db->where('s.status','active');
		$this->db->order_by('p.id','desc');
		//$this->db->limit(3);
		return $this->db->get();
		//echo $this->db->last_query();die;
			
	}	
	public function get_deal_today(){
	
		$this->db->select('p.*,u.thumbnail,u.user_name,u.full_name,s.seourl as shop_seourls,s.review_count,s.shop_ratting');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','p.user_id=s.seller_id');		
		$this->db->where('p.status = "Publish" and p.pay_status = "Paid" and p.action = "DOD" and concat_ws(" ",p.deal_date,p.deal_time_from) <= now() and concat_ws(" ",p.deal_date_to,p.deal_time_to) >= now()');
		$this->db->where('s.status','active');
		$this->db->order_by('p.id','desc');
		//$this->db->limit(3);
		return $this->db->get();
		//echo $this->db->last_query();die;
			
	}
	
	public function get_featured_shop_details(){
	
		$this->db->select('s.*,u.id as user_newid,u.thumbnail,u.user_name');
		$this->db->from(SELLER.' as s');
		$this->db->join(USERS.' as u','s.seller_id=u.id');
			
		$this->db->where('s.status','active');
		$this->db->where('s.featured_shop','Yes');
		$this->db->order_by('s.id','desc');
		$this->db->limit(7);
		return $this->db->get();
	
			
	}
	
	public function getrecentpromote(){
	$query="select s.*,u.* from ".SELLER." as s join ".USERS." u on s.seller_id=u.id where seller_promote = 'Promote'";
	return $this->ExecuteQuery($query);
	#echo $this->db->last_query();die;
	}
	
	public function getmaxfav()
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
	
	public function  get_fav_product_details($user_id = '')
	{
	
	$this->db->select('*');
	
	$this->db->from(PRODUCT.' as p');
	
			$this->db->where('p.user_id',$user_id);
			
		$this->db->order_by('p.id','desc');
		//$this->db->limit(4);
		 return $this->db->get();
		// print_r($this->db->last_query());die;
	}
	
	/*public function  get_fav_product_details($user_id = '')
	{
	
	$this->db->select('f.*,p.*,u.id as user_newid,u.thumbnail,u.user_name,u.full_name,u.city,u.country,s.seller_id,s.seller_banner,s.seller_businessname,s.seourl,count(f.p_id) as new_id');
	
	$this->db->from(FAVORITE.' as f');
	//$this->db->join(PRODUCT." as p","p.user_id= '".$user_id."'");
	$this->db->join(PRODUCT.' as p','p.id= f.p_id');
		$this->db->join(USERS.' as u','u.id='.$user_id.'');
			$this->db->join(SELLER.' as s','s.seller_id= '.$user_id.'');
		$this->db->where('f.favorite','Yes');
			$this->db->where('f.p_id',$user_id);
			$this->db->group_by('f.p_id,');
		$this->db->order_by('new_id','desc');
		$this->db->limit(4);
		 $this->db->get();
		 print_r($this->db->last_query());die;
	}*/
	
	public function get_product_count_details(){
		$this->db->select('count(*) as prod_count,p.status');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(USERS.' as u','p.user_id=u.id');
		$this->db->join(SELLER.' as s','s.seller_id= p.user_id','left');
		$where=array('u.status'=>'Active','s.status'=>'active');
		$this->db->where($where);
		$this->db->group_by('p.status');
		return $this->db->get();
	}
	
	public function get_featured_product(){
		$this->db->select('count(*) as featured_count');
		$this->db->from(PRODUCT);
		$this->db->where('product_featured','Yes');
		return $this->db->get();
	}
	public function get_product_soldDetails(){
		
		$this->db->select('SUM(purchasedCount) as pcount');
		$this->db->from(PRODUCT);
		return $this->db->get();
	}
	public function get_purchased_amount(){
		$this->db->select('SUM(sumtotal) as amtpurchased');
		$this->db->from(USER_PAYMENT);
		return $this->db->get();
	}
	public function get_promoted_details(){
			$this->db->select('count(*) as promo_products');
			$this->db->from(PRODUCT);
			$this->db->where('product_promoted','Unpromote');
			return $this->db->get();
	}
	
	
}

?>