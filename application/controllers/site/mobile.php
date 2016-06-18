<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

//class Mobile extends MY_Controller { 
class Mobile extends MY_Controller { 
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
		
		$GlobalUserName='';
		/*Currency Settings*/
		if($commonId>0){
			$checkUserPreference=$this->mobile_model->get_all_details(USER,array('id' => $commonId));
			if($checkUserPreference->num_rows()>=1){
				$condition = array('currency_code'=> $checkUserPreference->row()->currency);
				$GlobalUserName=$checkUserPreference->row()->user_name;
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
	 * Loading Category Json Page
	*/
	
	public function index(){
		$this->db->select('id,cat_name,image,rootID');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		$CategoryVal = $this->db->get();
		
		#echo '<pre>'; print_r($CategoryVal); 
	} 
	
	/** 
	 * 
	 * Loading Category Json Page
	 */
	
	public function category($perpage=10){
		$catId=intval($_GET['catId']);
		$page=intval($_GET['pageId']);
		
		
		$this->db->select('count(`id`) as TotCats');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		if($catId>0){
			$this->db->where('rootID',$catId);
		}else{
			$this->db->where('rootID',0);
		}
		$CategoryCount = $this->db->get(); 

		
		$this->db->select('id,cat_name,image,rootID');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		if($catId>0){
			$this->db->where('rootID',$catId);
		}else{
			$this->db->where('rootID',0);
		}
		
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
	
		$CategoryVal = $this->db->get(); 
		$CatArr = array();
		foreach($CategoryVal->result() as $catVal){
			if($catVal->image!=''){
				$catImage = $catVal->image;
			}else{
				$catImage = 'no_image.jpg';
			}
			$CatArr[] = array("id" => $catVal->id, "categoryName" => $catVal->cat_name,"image" =>base_url().'images/category/mb/'.$catImage,"catId"=>$catVal->rootID);
		}
		if($catId>0){
			$this->db->select('id,cat_name,image,rootID');
			$this->db->from(CATEGORY);
			$this->db->where('status','Active');
			$this->db->where('id',$catId);
			$mainCat = $this->db->get();
			if($mainCat->row()->image!=''){
				$mcatImage = $mainCat->row()->image;
			}else{
				$mcatImage = 'no_image.jpg';
			}
			$json_encode = json_encode(array("bannerId"=>$mainCat->row()->id,"bannerImage" => base_url().'images/category/mb/'.$mcatImage,"bannerName"=>$mainCat->row()->cat_name,"categoryDetails" => $CatArr,"cartCount"=>(string)$this->data["cartCount"],"pagePos" => (string)$page+1,"totalCategories" => $CategoryCount->row()->TotCats));
		}else{
			$json_encode = json_encode(array("categoryDetails" => $CatArr,"cartCount"=>(string)$this->data["cartCount"],"pagePos" => (string)$page+1,"totalCategories" => $CategoryCount->row()->TotCats));
		}
		echo $json_encode;
	} 
	

	
	
	
	public function product() { 
		$catid=intval($_GET['catid']);
		
		$shopname=$_GET['shopname'];
		$shopId=0;
		if($shopname!="")		{
			$shopId=intval($this->mobile_model->get_sellerId($shopname));
		}
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id,a.pricing');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		$this->db->join(SUBPRODUCT.' as a','p.id=a.product_id','left');
		if($catid>0){
			$run = "FIND_IN_SET('".$catid."', p.category_id)";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		if($shopId>0){
			$this->db->where('p.user_id',$shopId);
		}
		$this->db->group_by('p.id');
		$productList = $this->db->get();
		$ProdArr = array();
			//$ProdArr[] = array('itemCount'=>$productList->num_rows());
			$i=1;
		$itemCount=$productList->num_rows();
		foreach($productList->result() as $ProdList) {
			if($i<=20){
			$img=explode(',',$ProdList->image);
			#$price= $ProdList->base_price;
			$price= number_format($this->data["currencyValue"]*$ProdList->base_price,2);
			
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$ProdArr[] = array("productId" => $ProdList->id,
										"productName" => character_limiter($ProdList->product_name,15),
										"Image" => base_url().'images/product/mb/thumb/'.$img[0],
										"Price" => $price,
										"favStatus" =>(string)$favStatus,
										"storeName" => $ProdList->seller_businessname);
			$i++;
			}else{
				break;
			}
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"itemCount"=>(string)$itemCount,"pagePos"=>(string)2,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Loading Product Json Pagination
	 */
	public function product_pagination($perpage=10) {		
		$catid=intval($_GET['catid']);
		$page=intval($_GET['pageId']);
		
		$shopname=$_GET['shopname'];
		$shopId=0;
		if($shopname!="")		{
			$shopId=intval($this->mobile_model->get_sellerId($shopname));
			if($this->data["commonId"]>0){
			$shopfavStatus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shopId,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($shopfavStatus>0){$shopfavStatus=1;}else{$shopfavStatus=0;}
			}else{
				$shopfavStatus=0;
			}
		}
		
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');		
		if($catid>0){
			$run = "FIND_IN_SET('".$catid."', p.category_id)";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		if($shopId>0){
			$this->db->where('p.user_id',$shopId);
		}
		$totalproductList = $this->db->get();
		
		$itemCount=$totalproductList->num_rows();
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		if($catid>0){
			$run = "FIND_IN_SET('".$catid."', p.category_id)";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		if($shopId>0){
			$this->db->where('p.user_id',$shopId);
		}
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
		$productList = $this->db->get();
		
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);			
			$price= number_format($this->data["currencyValue"]*$ProdList->base_price,2);
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"]))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			if($shopId==0){
				$ProdArr[] = array("productId" => $ProdList->id,
												"productName" => character_limiter($ProdList->product_name,15),
												"Image" => base_url().'images/product/mb/thumb/'.$img[0],
												"Price" =>$price,
												"favStatus" =>(string)$favStatus,
												"storeName" => $ProdList->seller_businessname);
			}else{
				$ProdArr[] = array("productId" => $ProdList->id,
												"productName" => character_limiter($ProdList->product_name,15),
												"Image" => base_url().'images/product/mb/thumb/'.$img[0],
												"Price" =>$price,
												"favStatus" =>(string)$favStatus,
												"storeName" => $ProdList->seller_businessname
												);
			}	
		}
		
		
		if($this->data["commonId"] != '' && $shopId > 0 ){
			if($this->data["commonId"] != $shopId){
				$conversation_Arr = $this->mobile_model->get_conversation_List($this->data["commonId"],$shopId);
				if($conversation_Arr->num_rows() > 0){
					$convId = $conversation_Arr->row()->tid;
					$messager_id = '';
					if($conversation_Arr->row()->sender_id == $shopId ){
						$messager_id = $conversation_Arr->row()->sender_id;
					}else{
						$messager_id = $conversation_Arr->row()->receiver_id;
					}
					$conversation_details['messager_id'] = $messager_id;
					$conversation_details['convId'] = $convId;
					
				}else{
					$conversation_details['messager_id'] = $shopId;
				}
			}else{
				$conversation_details['Error_msg'] = 'you are product owner';
			}
		}else{
		$conversation_details['Error_msg'] = 'login Id & ShopId needed';
		}
		
		
		
		if($shopId!=0){		
			$this->db->select('s.seller_businessname,s.seller_id,s.shop_ratting,s.review_count,s.created,u.city as shop_location,u.country as shop_country,u.thumbnail,u.user_name');
			$this->db->from(SELLER.' as s');
			$this->db->join(USER.' as u' , 'u.id = s.seller_id');
			$this->db->where('s.seller_id',$shopId);
			$sellerInfo = $this->db->get();
			if($sellerInfo->row()->shop_location!=''){
				$shop_location=$sellerInfo->row()->shop_location;
			}
			if($sellerInfo->row()->shop_country!=''){
				if($sellerInfo->row()->shop_location!=''){
					$shop_location=$shop_location.','.$sellerInfo->row()->shop_location;
				}else{
					$shop_location=$sellerInfo->row()->shop_country;
				}
			}	
		
			if($sellerInfo->row()->thumbnail!=""){
				$sellerImage=base_url().'images/users/thumb/'.$sellerInfo->row()->thumbnail;
			}else{
				$sellerImage=base_url().'images/users/thumb/profile_pic.png';
			}
				
			$json_encode = json_encode(array('shop_name'=>(string)$sellerInfo->row()->seller_businessname,'shop_id'=>(string)$sellerInfo->row()->seller_id,'sellerImage'=>$sellerImage,'sellerName'=>(string)$sellerInfo->row()->user_name,'shop_ratting'=>(string)$sellerInfo->row()->shop_ratting,'review_count'=>(string)$sellerInfo->row()->review_count,'shop_location'=>(string)$shop_location,'shop_since'=>(string)date("F d Y",strtotime($sellerInfo->row()->created)),"productDetails" => $ProdArr,"itemCount" => (string)$itemCount,"pagePos" => (string)$page+1,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"],"favStatus" =>(string)$shopfavStatus,'privacy-policy'=>$this->mobilePagesjson('privacy-policy'),'about-us'=>$this->mobilePagesjson('about-us'),'contact-us'=>$this->mobilePagesjson('contact-us'),'conversation_details'=>$conversation_details));
		}else{
			$json_encode = json_encode(array("productDetails" => $ProdArr,"itemCount" => (string)$itemCount,"pagePos" => (string)$page+1,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"],'privacy-policy'=>$this->mobilePagesjson('privacy-policy'),'about-us'=>$this->mobilePagesjson('about-us'),'contact-us'=>$this->mobilePagesjson('contact-us'),'conversation_details'=>$conversation_details));
		}
		echo $json_encode;
	}
	
	
	public function product_pagination_ios($perpage=10) {		
		$catid=intval($_GET['catid']);
		$page=intval($_GET['pageId']);
		
		$shopname=$_GET['shopname'];
		$shopId=0;
		if($shopname!="")		{
			$shopId=intval($this->mobile_model->get_sellerId($shopname));
			if($this->data["commonId"]>0){
			$shopfavStatus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shopId,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($shopfavStatus>0){$shopfavStatus=1;}else{$shopfavStatus=0;}
			}else{
				$shopfavStatus=0;
			}
		}
		
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');		
		if($catid>0){
			$run = "FIND_IN_SET('".$catid."', p.category_id)";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		if($shopId>0){
			$this->db->where('p.user_id',$shopId);
		}
		$totalproductList = $this->db->get();
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		if($catid>0){
			$run = "FIND_IN_SET('".$catid."', p.category_id)";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		if($shopId>0){
			$this->db->where('p.user_id',$shopId);
		}
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
		$productList = $this->db->get();
		
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);			
			$price= number_format($this->data["currencyValue"]*$ProdList->base_price,2);
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"]))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$imgsize=$this->mobile_model->get_image_size(base_url().'images/product/org-image/'.$img[0]); 
			$imgsizeArr=@explode('--',$imgsize);
			
			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => $this->cleanString($ProdList->product_name),
											"Image" => 'org-image/'.$img[0],
											"width" => $imgsizeArr[0],
											"height" => $imgsizeArr[1],
											"Price" =>$price,
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname,
											"itemCount"=> (string)$totalproductList->num_rows(),
											"pagePos"=> (string)$page);
		}
		if($shopname!="")		{
			$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"],"favStatus" =>(string)$shopfavStatus,));
		}else{
			$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"]));
		}
		echo $json_encode;
	}
	
	
	/** 
	 * 
	 * Display Product Details Json
	 */
	public function product_detailspage() {
		$productid=intval($_GET['productid']); ### Product Id
		
		$this->db->select('p.id,p.description,p.product_name,p.image,p.price,p.base_price,p.created as listed_on,p.quantity as listing_no,p.user_id,p.status,p.view_count as views,s.seller_businessname as companyname,s.seourl as visitshop,s.seller_id as shopId,p.ship_duration,s.payment_policy,s.shipping_policy,s.refund_policy,s.welcome_message,s.additional_information,s.seller_information,p.seourl,p.made_by,p.materials,p.ship_from,p.likes');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->where('p.id',$productid);
		$productDetail = $this->db->get();
		
		
		$shopId=$productDetail->row()->user_id;
		
		$selCol="`thumbnail`";
		$userDetails=$this->mobile_model->get_column_details(USERS,array('id' => $productDetail->row()->user_id),$selCol); 
		
		$selCol="`id`,`product_name`,`image`,`base_price`";
		$conditionP=array('status'=>'Publish','pay_status'=>'Paid','user_id'=>$productDetail->row()->user_id,'id !='=>$productid);
		$shopProduct=$this->mobile_model->get_column_details(PRODUCT,$conditionP,$selCol); 
		
		$this->db->select('u.thumbnail as thumbnail,u.full_name as fullname,u.last_name as last_name,f.dateAdded,f.description,f.rating,p.image,p.product_name');
		$this->db->from(PRODUCT_FEEDBACK.' as f');
		$this->db->join(PRODUCT.' as p' , 'p.id = f.seller_product_id','inner');
		$this->db->join(USERS.' as u' , 'u.id = f.voter_id','inner');
		$this->db->order_by('f.id','desc');
		$this->db->where('f.status','Active');
		#$this->db->where('f.seller_product_id',$productid);
		$this->db->where('f.shop_id',$shopId);
		$reviwes = $this->db->get();
		
		$this->db->select('AVG(f.rating) as avgrating');
		$this->db->from(PRODUCT_FEEDBACK.' as f');
		$this->db->join(PRODUCT.' as p' , 'p.id = f.seller_product_id','inner');
		$this->db->join(USERS.' as u' , 'u.id = f.voter_id','inner');
		$this->db->order_by('f.id','desc');
		$this->db->where('f.status','Active');
		#$this->db->where('f.seller_product_id',$productid);
		$this->db->where('f.shop_id',$shopId);
		$avgreviwes = $this->db->get();
		
		
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
		$imageArr=array();
		foreach($imgArr as $img){
			$imageArr[]=array('image'=>base_url().'images/product/mb/'.$img);
		}
		
		switch($productDetail->row()->made_by){
			case '1':
				$made_by='Handmade Item';
			break;
			case '2':
				$made_by='Vintage Item';
			break;
			case '3':
				$made_by='Craft Supply Item';
			break;
			default:
				$made_by='';
			break;
		}
		
		if($productDetail->row()->materials!=''){
			$materials=$productDetail->row()->materials;
		}else{
			$materials='';
		}
		
		if($productDetail->row()->ship_from!=''){
			$ship_from='Ships from '.$productDetail->row()->ship_from;
		}else{
			$ship_from='';
		}
		
		$choiceArr[] = array("choicename1" =>$variations_one,
											"choicelist1" => $variations_one_list,
											"choiceprice1" => $variations_one_pricing,
											"choicename2" =>$variations_two,
											"choicelist2" => $variations_two_list,
											"choiceprice2" => $variations_two_pricing,);
		$reviewArr=array();
		if($reviwes->num_rows() == 0){
			$totalreviewCount='0';
			$reviewCount='0';
			$reviewStar='0.00';
			$reviewArr= array();
		} else {
			if($avgreviwes->row()->avgrating!=NULL && $avgreviwes->row()->avgrating!=''){
				$rc=0;
				$reviewStar=$avgreviwes->row()->avgrating;
				foreach($reviwes->result() as $review) {
					$totalreviewCount=$reviwes->num_rows();
					$rc++;
					if($rc>3){
						break;
					}else{
						$img=@explode(',',$review->image);
						$reviewCount=$rc;
						$reviewername=$review->fullname.' '.$review->last_name;
						if($review->thumbnail!=''){
							$reviewerphoto=base_url().'images/users/thumb/'.$review->thumbnail;
						}else{
							$reviewerphoto=base_url().'images/users/thumb/profile_pic.png';
						}
						$reviewArr[] = array("reviewerphoto" => $reviewerphoto,
														"reviewername" => $reviewername,
														"reviewerdate" =>date("Y-m-d",strtotime($review->dateAdded)),
														"reviewProduct" => base_url().'images/product/mb/thumb/'.$img[0],
														"reviewerating" =>(string)$review->rating,
														"revieweproductName" =>(string)$review->product_name,
														"reviewercomment" => $review->description);
					}
				}
			}else{
				$totalreviewCount='0';
				$reviewCount='0';
				$reviewStar='0.00';
				$reviewArr= array();
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
		$shopItems=array();
		if($shopProduct->num_rows()>0){
			$pc=0;
			foreach($shopProduct->result() as $prd) {
				$pc++;
				if($pc>4) break;
				$img=explode(',',$prd->image);
				$shopItems[] = array("id" =>$prd->id,
														"name" =>(string)$prd->product_name,
														"image" =>(string)base_url().'images/product/mb/crop/'.$img[0],
														"price" =>(string)$prd->base_price
														);
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
		
		if($userDetails->row()->thumbnail!=""){
			$profile_image=base_url().'images/users/thumb/'.$userDetails->row()->thumbnail;
		}else{
			$profile_image=base_url().'images/users/thumb/profile_pic.png';
		}
		
		$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$productid,'user_id'=>$this->data["commonId"]))->num_rows();
		
		$conversation_details = array();
		$conversation_details['Error_msg'] = '';
		$conversation_details['messager_id'] = '';
		$conversation_details['convId'] = '';
		
		if($this->data["commonId"] != '' && $shopId != ''){
			if($this->data["commonId"] != $shopId){
				$conversation_Arr = $this->mobile_model->get_conversation_List($this->data["commonId"],$shopId);
				if($conversation_Arr->num_rows() > 0){
					$convId = $conversation_Arr->row()->tid;
					$messager_id = '';
					if($conversation_Arr->row()->sender_id == $shopId ){
						$messager_id = $conversation_Arr->row()->sender_id;
					}else{
						$messager_id = $conversation_Arr->row()->receiver_id;
					}
					$conversation_details['messager_id'] = $messager_id;
					$conversation_details['convId'] = $convId;
					
				}else{
					$conversation_details['messager_id'] = $shopId;
				}
			}else{
				$conversation_details['Error_msg'] = 'you are product owner';
			}
		}else{
		$conversation_details['Error_msg'] = 'login Id & ShopId needed';
		}
		//print_r($conversation_details);die;
		if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
				
		$detailspage[] = array("productid"=>(string)$productid,
											"productName"=>(string)$this->cleanString($productDetail->row()->product_name),
											"productshareUrl"=>(string)base_url()."products/".$productDetail->row()->seourl,
											"productshareTitle"=>(string)$this->cleanString($productDetail->row()->product_name)." by ".$this->cleanString($productDetail->row()->companyname)." on ".$this->config->item('email_title'),
											"price"=>$price,
											"displayPrice"=>(string)number_format($this->data["currencyValue"]*$price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"description"=>strip_tags(stripslashes($this->cleanString($productDetail->row()->description))),
											"companyname"=>$productDetail->row()->companyname,
											'profile_image'=> $profile_image,
											"visitshop"=>$productDetail->row()->visitshop,
											"shopId"=>$productDetail->row()->shopId,
											"totalreviewCount"=>(string)$totalreviewCount,
											"reviewCount"=>(string)$reviewCount,
											"reviewAvg"=>(string)floatval($reviewStar),
											"reviwes"=>$reviewArr,
											"readytoShip"=>(string)$productDetail->row()->ship_duration,
											"shipping"=>$shippingArr,
											"policyStatus"=>$policyStatus,
											"policy"=>$policyArr,
											"shortdescription"=>character_limiter(strip_tags(stripslashes($productDetail->row()->description)),25),
											"image"=>$imageArr,
											"choice"=>$choiceArr,
											"listed_on"=>date("d M,Y",strtotime($productDetail->row()->listed_on)),
											"listing_no"=>$productDetail->row()->listing_no,
											"views"=>$productDetail->row()->views,
											"favorites"=>(string)$favorites->num_rows(),
											"favStatus"=>(string)$favStatus,
											"made_by"=>$made_by,
											"materials"=>$materials,
											"favorited_by"=>'Favorited: '.$productDetail->row()->likes,
											"ship_from"=>(string)$ship_from,
											"made_to_order"=>(string)$productDetail->row()->ship_duration,
											"shop_id"=>(string)$productDetail->row()->user_id,
											"shopItems"=>$shopItems,
											'conversation_details'=>$conversation_details);
		#echo '<pre>'; print_r($detailspage); die;
		
		$json_encode = json_encode(array("detailspage" => $detailspage,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Display SearchPage Json
	 */
	public function searchpage($perpage=6,$page=1){
		$value=(string)$_GET['value']; ### Search Key
		
		$this->db->select('p.id,p.product_name');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		if($value!=""){
			$run = "p.product_name LIKE '%".$value."%'";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->limit($perpage,($page*$perpage)-$perpage);
		$productList = $this->db->get();
		//echo $this->db->last_query();
		$SearchVal = "";
		//echo '<pre>'; print_r($productList);die;
		foreach($productList->result() as $ProdList) {
			//$SearchVal.=$ProdList->product_name.'|'.$ProdList->id.'@';
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"]))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$SearArr[] = array("id" => $ProdList->id,"name" => $ProdList->product_name,"favStatus" =>(string)$favStatus);
		}
		
		$json_encode = json_encode(array("searchresults" => $SearArr,"cartCount"=>(string)$this->data["cartCount"]));
		//echo rtrim($SearchVal,'@');
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Loading Search Json Pagination
	 */
	public function search_pagination($perpage=20) {
		$value=(string)$_GET['value'];	
		$page=intval($_GET['pageId']);
		$page = $page + 1;
		
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');		
		if($value!=''){
			$run = "p.product_name LIKE '%".$value."%'";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$totalproductList = $this->db->get();
		#echo $this->db->last_query();
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		if($value!=''){
			$run = "p.product_name LIKE '%".$value."%'";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('s.status','active');
		$this->db->limit($perpage,($page*$perpage)-$perpage);
		$productList = $this->db->get();
		$ProdArr = array();
		$itemCount= $totalproductList->num_rows();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"]))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" => base_url().'images/product/mb/thumb/'.$img[0],
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname
											);
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"itemCount"=> (string)$itemCount,"pagePos"=> (string)$page,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	
	
	public function search_pagination_ios($perpage=20){
		$value=(string)$_GET['value'];	
		$page=intval($_GET['pageId']);
		$page = $page + 1;
		
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');		
		if($value!=''){
			$run = "p.product_name LIKE '%".$value."%'";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$totalproductList = $this->db->get();
		
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		if($value!=''){
			$run = "p.product_name LIKE '%".$value."%'";
			$this->db->where($run);
		}
		$this->db->where('p.status','Publish');
		$this->db->where('s.status','active');
		$this->db->limit($perpage,($page*$perpage)-$perpage);
		$productList = $this->db->get();
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"]))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$imgsize=$this->mobile_model->get_image_size(base_url().'images/product/org-image/'.$img[0]); 
			$imgsizeArr=@explode('--',$imgsize);
			
			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => $this->cleanString($ProdList->product_name),
											"Image" => 'org-image/'.$img[0],
											"width" => $imgsizeArr[0],
											"height" => $imgsizeArr[1],
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname,
											"itemCount"=> (string)$totalproductList->num_rows(),
											"pagePos"=> (string)$page);
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	
	public function user_login(){
		$returnArr['status'] = '0';
		$returnArr['message']='';
		
		$UserNamestr = $_POST['username'];
		$PassWordstr = $_POST['password']; 
		
		$condition = '(email = \''.$UserNamestr.'\' OR user_name = \''.$UserNamestr.'\') AND password=\''.md5($PassWordstr).'\'';
		$userInfoDetails = $this->user_model->get_all_details(USERS,$condition);
		
		if($userInfoDetails->num_rows()==1){
				$userInfo = 'Success';
				if($userInfoDetails->row()->thumbnail!=""){
					$userImage=base_url().'images/users/thumb/'.$userInfoDetails->row()->thumbnail;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				/*push update*/
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
						$this->mobile_model->insertupdatePushKey($userInfoDetails->row()->id,$UDID,'user',$device_type);
					}
				/*End*/
				$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$userInfoDetails->row()->id),array("user_id"=>$this->data["commonId"]));
				$returnArr['status'] = '1';
				$returnArr['message'] = 'Success';
				if($userInfoDetails->row()->thumbnail!=""){
					$user_image=base_url().'images/users/thumb/'.$userInfoDetails->row()->thumbnail;
				}else{
					$user_image=base_url().'images/users/thumb/profile_pic.png';
				}
				
				$condition = array('seller_id'=>$userInfoDetails->row()->id);
				$sellerInfoDetails = $this->user_model->get_all_details(SELLER,$condition);
				$seller_flag= 'No';
				if($sellerInfoDetails->num_rows() > 0){
				$seller_flag= 'Yes';
				}
				$returnArr['user_image'] = $user_image;
				
				$returnArr['seller'] = $seller_flag;
				$returnArr['user_id'] = (string)$userInfoDetails->row()->id;
				$returnArr['user_name'] = $userInfoDetails->row()->user_name;
				$returnArr['email'] = $userInfoDetails->row()->email;
				$returnArr['user_fullname'] = $userInfoDetails->row()->full_name;
		}else{
				$returnArr['message'] = 'Failure';
		}
		$json_encode = json_encode($returnArr);
		echo $json_encode;
	}	
	
	
	public function user_register(){
		$returnArr['status'] = '0';
		$returnArr['message'] = 'failure';
		$firstnamestr = $_POST['firstname'];
		$lastnamestr = $_POST['lastname']; 
		$emailstr = $_POST['email']; 
		$passwordstr = $_POST['password']; 
		$usernamestr1 = $_POST['username']; 
		$usernamestr = stripslashes($usernamestr1.trim());

		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('user_name',$usernamestr);
		$userNameDetails = $this->db->get();
		
		$this->db->select('*');
		$this->db->from(USERS);
		$this->db->where('email',$emailstr);
		$userEmailDetails = $this->db->get();
		
		if($firstnamestr=='' || $lastnamestr=='' || $emailstr=='' || $passwordstr=='' || $usernamestr==''){		
			$returnArr['message'] = 'Failure';
		}else if($userNameDetails->num_rows()==1){		
			$returnArr['message'] = 'Username Already Exist';
		}else if($userEmailDetails->num_rows()==1){		
			$returnArr['message'] = 'Email Address Already Exist';
		}else{		
			$dataArr = array('loginUserType'=>'mobile','full_name'=>$firstnamestr.''.$lastnamestr,'user_name'=>$usernamestr,'last_name'=>$lastnamestr,'email'=>$emailstr,'password'=>md5($passwordstr),'status'=>'Active','is_verified'=>'No','commision'=>$this->config->item('product_commission'));
					
			$this->db->insert(USERS,$dataArr); 
			
			$this->db->select('*');
			$this->db->from(USERS);
			$this->db->where('email',$emailstr);
			$checkUser = $this->db->get();								
			
			
			/*push update*/
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
				$this->mobile_model->insertupdatePushKey($checkUser->row()->id,$UDID,'user',$device_type);
			}
			/*End*/
				
			$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$checkUser->row()->id),array("user_id"=>$this->data["commonId"]));
			$userDetails=$checkUser;
			$this->send_confirm_mail($userDetails);
						
			if($checkUser->row()->thumbnail!=""){
				$user_image=base_url().'images/users/thumb/'.$checkUser->row()->thumbnail;
			}else{
				$user_image=base_url().'images/users/thumb/profile_pic.png';
			}
			/*Blog registration Starts*/
			$this->load->library('curl');
			$url = base_url().'wp_change_user_role.php'; 
			$post_data = array ( 
					"un" => $checkUser->row()->user_name, 
					"pd" => $passwordstr,
					"em" => $emailstr
			);
			$output = $this->curl->simple_get($url, $post_data);
			/*Blog registration Ends*/
			
			$returnArr['status'] = '1';
			$returnArr['message'] = 'Success';
			$returnArr['user_image'] = $user_image;
			$returnArr['user_id'] = (string)$checkUser->row()->id;
			$returnArr['user_name'] = $checkUser->row()->user_name;
			$returnArr['email'] = $checkUser->row()->email;
			$returnArr['user_fullname'] = $checkUser->row()->full_name;
		}
		$json_encode = json_encode($returnArr);
		echo $json_encode;
	}	
	
	
	
	
	public function send_confirm_mail($userDetails=''){
	
		$uid = $userDetails->row()->id;
		$email = $userDetails->row()->email;
		$name = $userDetails->row()->full_name;
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		
		$this->db->where('id', $uid);
		$this->db->update(USERS, $dataArr); 
		
		$newsid='3';
	
				$this->db->select('*');
				$this->db->from(NEWSLETTER);
				$this->db->where('id',$newsid);
				$this->db->where('status','Active');
				$template_values = $this->db->get()->result_array();
			
		$cfmurl = base_url().'site/user/confirm_register/'.$uid."/".$randStr."/confirmation";
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values[0]['news_subject'];
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		if($template_values[0]['sender_name']=='' && $template_values[0]['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values[0]['sender_name'];
			$sender_email=$template_values[0]['sender_email'];
		}

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$sender_email,
							'mail_name'=>$sender_name,
							'to_mail_id'=>$email,
							'subject_message'=>$template_values[0]['news_subject'],
							'body_messages'=>$message
							);
		$email_send_to_common = $this->mobile_model->common_email_send($email_values);
	}
	
	public function favorite_add_remove(){
		$userid = intval($_GET['userId']);
		$type=$this->input->get('type');
		$mode=$this->input->get('mode');
		
		if($type == 'product'){
			$pid=$this->input->get('id');
			if($mode=='add' && $pid != ''){
				$checkFavStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkFavStatus->num_rows() < 1){				
					$dataArr = array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes');
					$this->mobile_model->simple_insert(FAVORITE,$dataArr);	
					# addding favorites count and add to activity table
					$checkProductLike = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$pid));
					if ($checkProductLike->num_rows() > 0){
						$productDetails = $this->mobile_model->get_all_details(PRODUCT,array('id'=>$pid));
						if ($productDetails->num_rows()>0){
							$likes = $productDetails->row()->likes;
							$actArr = array(
								'activity_name'	=>	'favorite item',
								'activity_id'	=>	$pid,
								'user_id'		=>	$userid,
								'activity_ip'	=>	$this->input->ip_address()
							);
							$checkProductStatus = $this->mobile_model->get_all_details(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$userid));
							if ($checkProductStatus->num_rows() < 1){
							$this->mobile_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							else
							{
								$this->mobile_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$pid,'user_id'=>$userid));
								$this->mobile_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite item','activity_id'=>$pid,'user_id'=>$userid));
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite item','activity_id'=>$pid,'user_id'=>$userid));
							$actArr = array('activity'=>'favorite item',
													'activity_id'=>$pid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
							$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
							
							$likes++;
							$dataArr = array('likes'=>$likes);
							$condition = array('id'=>$pid);
							$this->mobile_model->update_details(PRODUCT,$dataArr,$condition);	
							$sellerId = $productDetails->row()->user_id;
							/*Push Message Starts*/
							$message=$GlobalUserName.' favorited your item on '.$this->config->item('email_title');
							$type='favorite item';
							$this->sendPushNotification($sellerId,$message,$type,array($pid));
							/*Push Message Ends*/							
						}
						echo 'success'; die;
					}
				} else{
					echo 'error';die;
				}
			} else if($mode=='remove' && $pid != ''){
				$checkFavStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$pid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkFavStatus->num_rows() > 0){
					# Updating favorites count and update to activity table
					$checkProductLike = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$pid));
					if ($checkProductLike->num_rows() > 0){
						$productDetails = $this->mobile_model->get_all_details(PRODUCT,array('id'=>$pid));
						if ($productDetails->num_rows()>0){
							$likes = $productDetails->row()->likes;
							$actArr = array(
								'activity_name'	=>	'Unfavorite item',
								'activity_id'	=>	$pid,
								'user_id'		=>	$userid,
								'activity_ip'	=>	$this->input->ip_address()
							);
							$condition = array('activity_id'=>$pid,'user_id'=>$userid);
							$this->mobile_model->update_details(USER_ACTIVITY,$actArr,$condition);		
							
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite item','activity_id'=>$pid,'user_id'=>$userid));
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite item','activity_id'=>$pid,'user_id'=>$userid));
							$actArr = array('activity'=>'unfavorite item',
														'activity_id'=>$pid,
														'user_id'	=>$userid,
														'activity_ip'=>$this->input->ip_address(),
														'created'=>date("Y-m-d H:i:s"));
							$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
							
							$likes--;
							$dataArr = array('likes'=>$likes);
							$condition = array('id'=>$pid);
							$this->mobile_model->update_details(PRODUCT,$dataArr,$condition);					
							#$returnStr['status_code'] = 1;
						}
						$this->mobile_model->product_fav_delete($userid,$pid);
						echo 'success'; die;
					}
				} else {
					echo 'error';die;
				}
			} else {
				echo 'error';die;
			}
		} if($type == 'shop'){
			$shopid=$this->input->get('id');
			if($mode == 'add' && $shopid !=''){
				$checkShopStaus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shopid,'user_id'=>$userid,'favorite'=>'Yes'));
				if ($checkShopStaus->num_rows() < 1){
					$dataArr = array('shop_id'=>$shopid,'user_id'=>$userid,'favorite'=>'Yes');
					$this->mobile_model->simple_insert(FAVORITE,$dataArr);
					# addding favorites shop count and add to activity table
					$checkShopLike = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shopid));
					if ($checkShopLike->num_rows() > 0){
						$userDetails = $this->mobile_model->get_all_details(USERS,array('id'=>$shopid));
						if ($userDetails->num_rows()>0){
							$likes = $userDetails->row()->likes;
							$actArr = array(
								'activity_name'	=>	'favorite shop',
								'activity_id'	=>	$shopid,
								'user_id'		=>	$userid,
								'activity_ip'	=>	$this->input->ip_address()
							);
							$checkShopStatus = $this->mobile_model->get_all_details(USER_ACTIVITY,array('activity_id'=>$shopid,'user_id'=>$userid));
							if ($checkShopStatus->num_rows() < 1){
							$this->mobile_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							else
							{
								$this->mobile_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$shopid,'user_id'=>$userid));
								$this->mobile_model->simple_insert(USER_ACTIVITY,$actArr);
							}
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite shop','activity_id'=>$pid,'user_id'=>$userid));
							$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite shop','activity_id'=>$pid,'user_id'=>$userid));
							$actArr = array('activity'=>'favorite shop',
													'activity_id'=>$shopid,
													'user_id'	=>$userid,
													'activity_ip'=>$this->input->ip_address(),
													'created'=>date("Y-m-d H:i:s"));
							$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
							
							$likes++;
							$dataArr = array('likes'=>$likes);
							$condition = array('id'=>$shopid);
							$this->mobile_model->update_details(USERS,$dataArr,$condition);	
							
							/*Push Message Starts*/
							$message=$GlobalUserName.' favorited your shop on '.$this->config->item('email_title');
							$type='favorite shop';
							$this->sendPushNotification($shopid,$message,$type,array($userid));
							/*Push Message Ends*/	
							
							echo 'success'; die;
						} else {echo 'error';die;}
					} else {echo 'error';die;}
				} else {echo 'error';die;}
			} else if($mode == 'remove' && $shopid !=''){
				# Updating favorites shop count and update to activity table
				$checkShopLike = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shopid));
				if ($checkShopLike->num_rows() > 0){
					$userDetails = $this->mobile_model->get_all_details(USERS,array('id'=>$shopid));
					if ($userDetails->num_rows()>0){
						$likes = $userDetails->row()->likes;
						$actArr = array(
							'activity_name'	=>	'Unfavorite shop',
							'activity_id'	=>	$shopid,
							'user_id'		=>	$userid,
							'activity_ip'	=>	$this->input->ip_address()
						);
						$condition = array('activity_id'=>$shopid,'user_id'=>$userid);
						$this->mobile_model->update_details(USER_ACTIVITY,$actArr,$condition);					
						
						$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'favorite shop','activity_id'=>$shopid,'user_id'=>$userid));
						$this->mobile_model->commonDelete(NOTIFICATIONS,array('activity'=>'unfavorite shop','activity_id'=>$shopid,'user_id'=>$userid));
						$actArr = array('activity'=>'unfavorite shop',
														'activity_id'=>$shopid,
														'user_id'	=>$userid,
														'activity_ip'=>$this->input->ip_address(),
														'created'=>date("Y-m-d H:i:s"));
						$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
						
						$likes--;
						$dataArr = array('likes'=>$likes);
						$condition = array('id'=>$shopid);
						$this->mobile_model->update_details(USERS,$dataArr,$condition);								
					}
					$this->mobile_model->fav_delete($userid,$shopid);
					echo 'success'; die;
				} else {echo 'error'; die;}
			} else {echo 'error';die;}
		}else {echo 'error';die;}
	}
	
	
	public function favorite_list_add_remove(){
		$listId=$this->input->get('list_id');
		$prodId=$this->input->get('prod_id');
		$action=$this->input->get('action');
		if($action=='newlist'){
			$name=urldecode($this->input->get('list_name'));						
			$listConditionArr = array('name'=>$name,'user_id'=>$this->checkLogin('U'));
			if($prodId != ''){
				$listArr = array('name'=>$name,'product_id'=>$prodId.',','user_id'=>$this->checkLogin('U'),'product_count'=>1);
			}else{
				$listArr = array('name'=>$name,'user_id'=>$this->checkLogin('U'));
			}
			$listCheck = $this->mobile_model->get_all_details(LISTS_DETAILS,$listConditionArr);
			if ($listCheck->num_rows()==0){
				$this->mobile_model->simple_insert(LISTS_DETAILS,$listArr);
				echo 'success';
			}else {
				echo 'error'; // already list name exist for this user..
			}
		} else if($action == '' && $listId != ''){
			$this->data['listProduct']=$listProduct = $this->mobile_model->get_all_details(LISTS_DETAILS,array('id'=>$listId))->result_array();
			$productArr=explode(',',$listProduct[0]['product_id']);
			if(in_array($prodId,$productArr)){ 
				$newproductlist=str_replace($prodId.',','',$listProduct[0]['product_id']);
				$productCount=$listProduct[0]['product_count']-1; 
			}
			else{ 
				$newproductlist=$listProduct[0]['product_id'].$prodId.','; $productCount=$listProduct[0]['product_count']+1; 
			}
			$this->mobile_model->update_details(LISTS_DETAILS,array('product_id'=>$newproductlist,'product_count'=>$productCount),array('id'=>$listId));
			if($this->db->affected_rows() == 0){
				echo 'error';
			} else {
				echo 'success';
			}
		} else { echo 'error';}
	}
	
	
	public function view_favorites($perpage=5){ 
		$username =  urldecode($this->uri->segment(2,0));
		$type=$this->input->get('type');
		$userDetails= $this->mobile_model->get_all_details(USERS,array('user_name'=>$username));
		if($userDetails->num_rows() ==1){
			$uid=$userDetails->row()->id; 
			#$userProfileDetails = $this->mobile_model->get_all_details(USERS,array('id'=>$uid,'status'=>'Active'))->result_array();
			if($type == 'product'){
				$page=intval($_GET['pageId']);
				$offset=($page*$perpage)-$perpage;
				
				$userFavoriteItems = $this->mobile_model->getFavoriteProduct($uid)->result_array();
			
				#echo "<pre>"; print_r($userFavoriteItems); die;
				$favCol="`id` as `list_id`,`name` as `list_name`,`product_id`,`product_count`,`privacy`";
				$userProfileDetails = $this->mobile_model->get_column_details(LISTS_DETAILS,array('user_id'=>$uid),$favCol)->result_array();
				$favList=array(); #echo '<pre>'; print_r($userProfileDetails); die;
				$j=0;
				foreach($userProfileDetails as $list){  
					if($list['product_id'] !=''){
						$productList=$this->mobile_model->get_in_results(PRODUCT,$list['product_id']," `image` ");  
						
						$productArr=array(); 
						$i=0;  $img[0]='';
						#echo '<pre>'; print_r($productList->result()); 
						foreach($productList->result() as $product){
							$img=@explode(',',$product->image);
							$productArr['product_'.$i.'']=base_url().'images/product/mb/thumb/'.$img[0];
							$i++; 
						}
					
						$userProfileDetails[$j]['products']=$productArr;
						$j++;  
						#echo "<pre>"; print_r($userProfileDetails);
					} else {
						$userProfileDetails[$j]['products']=array();
					}
				}

				if($this->input->get('a')){
					$search_key=$this->input->get('a');	
					$this->db->like('p.product_name',$search_key);
					$searchtProducts= $this->mobile_model->getFavoriteProduct($uid,array('p.status' => 'Publish','p.pay_status' => 'Paid'))->result_array();
				
				}
				$resultArr=array(
											'favListItems'=>$userProfileDetails,
											'userFavoriteItems'=>$userFavoriteItems,
											'searchtProducts'=>$searchtProducts
											);
				
			}else if($type == 'shop'){
			
			
			} else {echo 'error';}
			$json_encode = json_encode($resultArr);
			echo $json_encode;						
		} else {
			echo 'error';
		}
	}
	
	public function product_filter(){
		$page=intval($_GET['pageId']);
		$catid=intval($_GET['catid']);
		
		$filter=$this->input->get('order');
		$filterVals=@explode('_',$filter);
		$sort_val=$filterVals[0];
		$sort_by=$filterVals[1];
		
		if($sort_val=="price"){
			$order_by_name="base_price";
		}else if($sort_val=="date"){
			$order_by_name="created";
		}else{
			$order_by_name="created";
		}
		
		if($sort_by=="asc"){
			$order_by_val="ASC";
		}else if($sort_by=="des"){
			$order_by_val="DESC";
		}else{
			$order_by_val="DESC";
		}
		
		
		$perpage=20;
		if($page>= 1){
			$paginationVal = ($page * $perpage)-$perpage;
			$limitPaging = $paginationVal.','.$perpage;
		} else {
			$limitPaging = $perpage;
		}
		
		$minprice='';  $maxprice='';
		$price_max=$this->input->get('max_price'); 
		$price_min=$this->input->get('min_price');
		if($price_max != '' || $price_min != ''){
			$minVal = $price_min/$this->data['currencyValue']; 
			$maxVal = $price_max/$this->data['currencyValue'];  
			/**/
			if($maxVal == ''){
				$price="and (p.base_price >='".$minVal."')"; 
			}else { 
				$price="and (p.base_price >='".$minVal."' and p.base_price <='".$maxVal."')";
			}
			/**/
		}
			$priceCond=" p.status='Publish' and p.pay_status='Paid' ".$price." group by p.id order by p.".$order_by_name." ".$order_by_val." limit ".$limitPaging;
		if($catid>0){
			$priceCond=" p.status='Publish' and p.pay_status='Paid' ".$price." and FIND_IN_SET('".$catid."', p.category_id) group by p.id order by p.".$order_by_name." ".$order_by_val." limit ".$limitPaging;
		}		
		$selctColumns='p.id,p.image,p.price,p.base_price,p.product_name,p.seourl as product_url,s.seller_businessname as shop_name,s.seourl as shop_url,a.pricing';
		$productList=$this->mobile_model->get_product_detail($priceCond,$selctColumns);
		
		$priceCondAll=" p.status='Publish' and p.pay_status='Paid' ".$price." group by p.id order by p.".$order_by_name." ".$order_by_val."";	
		if($catid>0){
			$priceCondAll=" p.status='Publish' and p.pay_status='Paid' ".$price." and FIND_IN_SET('".$catid."', p.category_id) group by p.id order by p.".$order_by_name." ".$order_by_val." ";
		}	
		$selctColumns='p.id';
		$totalproductList=$this->mobile_model->get_product_detail($priceCondAll,$selctColumns);
		$itemCount= $totalproductList->num_rows();
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			if($ProdList->price != 0){
				$price=$ProdList->price;
			} else{
				$price=$ProdList->base_price;
			}
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}

			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" => base_url().'images/product/mb/thumb/'.$img[0],
											"Price"=>(string)number_format($this->data["currencyValue"]*$price,2),
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->shop_name
										);
		} 
		#echo '<pre>'; print_r($ProdArr);		
		$json_encode = json_encode(array("productDetails" => $ProdArr,"itemCount"=> (string)$itemCount,"pagePos"=> (string)$page+1,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;		
		
	}	
	
	
	public function product_filter_ios(){ 
		$page=intval($_GET['pageId']);
		$catid=intval($_GET['catid']);
		
		$filter=$this->input->get('order');
		$filterVals=@explode('_',$filter);
		$sort_val=$filterVals[0];
		$sort_by=$filterVals[1];
		
		if($sort_val=="price"){
			$order_by_name="base_price";
		}else if($sort_val=="date"){
			$order_by_name="created";
		}else{
			$order_by_name="created";
		}
		
		if($sort_by=="asc"){
			$order_by_val="ASC";
		}else if($sort_by=="des"){
			$order_by_val="DESC";
		}else{
			$order_by_val="DESC";
		}
		
		
		$perpage=20;
		if($page>= 1){
			$paginationVal = ($page * $perpage)-$perpage;
			$limitPaging = $paginationVal.','.$perpage;
		} else {
			$limitPaging = $perpage;
		}
		
		$minprice='';  $maxprice='';
		$price_max=$this->input->get('max_price'); 
		$price_min=$this->input->get('min_price');
		if($price_max != '' || $price_min != ''){
			$minVal = $price_min/$this->data['currencyValue']; 
			$maxVal = $price_max/$this->data['currencyValue'];  
			/**/
			if($maxVal == ''){
				$price="and (p.base_price >='".$minVal."')"; 
			}else { 
				$price="and (p.base_price >='".$minVal."' and p.base_price <='".$maxVal."')";
			}
			/**/
		}
			$priceCond=" p.status='Publish' and p.pay_status='Paid' ".$price." group by p.id order by p.".$order_by_name." ".$order_by_val." limit ".$limitPaging;
		if($catid>0){
			$priceCond=" p.status='Publish' and p.pay_status='Paid' ".$price." and FIND_IN_SET('".$catid."', p.category_id) group by p.id order by p.".$order_by_name." ".$order_by_val." limit ".$limitPaging;
		}		
		$selctColumns='p.id,p.image,p.price,p.base_price,p.product_name,p.seourl as product_url,s.seller_businessname as shop_name,s.seourl as shop_url,a.pricing';
		$productList=$this->mobile_model->get_product_detail($priceCond,$selctColumns);
		
		$priceCondAll=" p.status='Publish' and p.pay_status='Paid' ".$price." group by p.id order by p.".$order_by_name." ".$order_by_val."";	
		if($catid>0){
			$priceCondAll=" p.status='Publish' and p.pay_status='Paid' ".$price." and FIND_IN_SET('".$catid."', p.category_id) group by p.id order by p.".$order_by_name." ".$order_by_val." ";
		}	
		$selctColumns='p.id';
		$totalproductList=$this->mobile_model->get_product_detail($priceCondAll,$selctColumns);
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			if($ProdList->price != 0){
				$price=$ProdList->price;
			} else{
				$price=$ProdList->base_price;
			}
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
			$imgsize=$this->mobile_model->get_image_size(base_url().'images/product/org-image/'.$img[0]); 
			$imgsizeArr=@explode('--',$imgsize);

			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" => 'org-image/'.$img[0],
											"width" => $imgsizeArr[0],
											"height" => $imgsizeArr[1],
											"Price"=>(string)number_format($this->data["currencyValue"]*$price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->shop_name,
											"itemCount"=> (string)$totalproductList->num_rows(),
											"pagePos"=> (string)$page);
		} 
		#echo '<pre>'; print_r($ProdArr);		
		$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;		
	}
	
	public function display_all_shops($perpage=21) {
		$page=intval($_GET['pageId']);
		$orderby=$_GET['orderby'];
		$order=$this->input->get('order');
		
		if($page>= 1){
			$paginationVal = ($page * $perpage)-$perpage;			
		} else {
			$paginationVal = 0;
			$page=1;
		}
		
		if($orderby!=""){
			$shopsList=$this->mobile_model->get_shops_details('','`s.seller_id`,`s.seller_businessname` as shop_name',$perpage,$paginationVal);
		}else{
			$shopsList=$this->mobile_model->get_allshop_details('','`s.seller_id`,`s.seller_businessname` as shop_name',"",$perpage,$paginationVal);
		}
		#echo $this->db->last_query();
		$shopArr=array(); 
		foreach($shopsList->result() as $shops){
			if($orderby=='shop'){
				$getCount=$this->mobile_model->get_shops_productCount($shops->seller_id)->result();
				if($getCount[0]->pCount>0){
					$prdCount=$getCount[0]->pCount;
				}else{
					$prdCount=0;
				}
				$shopArr[$shops->seller_id]=$prdCount;
				if($order=='asc'){
					asort($shopArr);
				} else if($order=='desc'){
					arsort($shopArr);
				}
			} else if($orderby=='name'){
				$shopArr[$shops->seller_id]=$shops->shop_name;
				if($order=='asc'){
					asort($shopArr);
				} else if($order=='desc'){
					arsort($shopArr);
				}
			}else{
				$shopArr[$shops->seller_id]=$shops->shop_name;
				if($order=='asc'){
					asort($shopArr);
				} else if($order=='desc'){
					arsort($shopArr);
				}
			}
		}
		
		$shopall=array();
		foreach($shopArr as $key=>$val){ 
			$shop_result=$this->mobile_model->get_shops_details($key,'`s.seller_id`,`s.seller_businessname` as shop_name,`s.seourl` as shop_url,`u.thumbnail` as seller_img,`u.full_name` as seller_name')->result();
			$pcond=array('user_id' => $key,'status' => 'Publish','pay_status' => 'Paid');
			$product_result=$this->mobile_model->get_column_details(PRODUCT,$pcond,'`image`');
			
			$pCount=0;
			$pArr=array();
			foreach($product_result->result() as $prd){
				$pCount++;
				if($pCount<=3){
					$imgArr=@explode(',',$prd->image);
					$pArr[]=array('image'=>base_url().'images/product/mb/'.$imgArr[0]);
				}else{
					break;
				}
			}
			
			if($shop_result[0]->seller_img!=""){
				$seller_image=base_url().'images/users/thumb/'.$shop_result[0]->seller_img;
			}else{
				$seller_image=base_url().'images/users/thumb/profile_pic.png';
			}
			
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$shop_result[0]->seller_id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
			if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			
						
			$shopall[]=array('seller_id'=>$shop_result[0]->seller_id,
											'seller_image'=>$seller_image,
											'shop_name'=>$shop_result[0]->shop_name,
											'shop_url'=>$shop_result[0]->shop_url,
											'seller_name'=>$shop_result[0]->seller_name,
											/* 'shop_ratting'=>(string)$shop_result[0]->shop_ratting,
											'review_count'=>(string)$shop_result[0]->review_count,
											'shop_location'=>(string)$shop_location,
											'shop_since'=>(string)date("F d Y",strtotime($shop_result[0]->created)), */
											'favStatus' =>(string)$favStatus,
											'products'=>$pArr,
											'productsCount'=>(string)$product_result->num_rows()
											);
			 
		}
		#echo '<pre>'; print_r($shopall); die;
		
		$gettotalshopcount = $this->mobile_model->get_all_details(SELLER,array());
		$gettotalshopcount = $this->mobile_model->get_total_shop();
		#$json_encode = json_encode(array("shopsList" => $shopall,"shopCount"=>(string)'',"cartCount"=>(string)$this->data["cartCount"]));
		$json_encode = json_encode(array("shopsList" => $shopall,'pagePos'=> (string)$page+1,"shopCount"=>(string)$gettotalshopcount->num_rows(),"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;		
	} 
	/** 
	 * 
	 * Loading All Shops
	 */
	public function display_trending($perpage=20) {
		$page=intval($_GET['pageId']);
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		$totalproductList = $this->db->get();
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
		$productList = $this->db->get();
		$itemCount=$totalproductList->num_rows();
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			$imgurl=base_url().'images/product/mb/thumb/'.$img[0];

			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" =>$imgurl,
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"base_price"=>$ProdList->base_price,
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname);
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"itemCount"=> (string)$itemCount,"pagePos"=> (string)$page+1,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	
	public function display_trending_ios($perpage=20) {
		$page=intval($_GET['pageId']);
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		$totalproductList = $this->db->get();
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$this->db->limit($perpage,0);
		}
		$productList = $this->db->get();
		
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			
			$imgsize=$this->mobile_model->get_image_size(base_url().'images/product/org-image/'.$img[0]); 
			$imgsizeArr=@explode('--',$imgsize);
			
			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => $this->cleanString($ProdList->product_name),
											"Image" => base_url().'images/product/mb/thumb/'.$img[0],
											"width" => $imgsizeArr[0],
											"height" => $imgsizeArr[1],
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"favStatus" =>(string)$favStatus,
											"storeName" => $this->cleanString($ProdList->seller_businessname),
											"itemCount"=> (string)$totalproductList->num_rows(),
											"pagePos"=> (string)$page);
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	
	/** 
	 * 
	 * Loading All Trending
	 */
	public function display_all_trending() {		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id');
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->order_by('p.created','DESC');
		$productList = $this->db->get();
		
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			
			
			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" =>  $this->cleanString($ProdList->product_name),
											"Image" => base_url().'images/product/mb/thumb/'.$img[0],
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"currencySymbol" =>$this->data["currencySymbol"],
											"currencyCode" =>$this->data["currencyCode"],
											"favStatus" =>(string)$favStatus,
											"storeName" => $this->cleanString($ProdList->seller_businessname),
											"itemCount"=> (string)$productList->num_rows(),
											"pagePos"=> (string)1);
		}
		$json_encode = json_encode(array("productDetails" => $ProdArr,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Loading Your Feed Informations
	 */
	public function display_feed($user_id="",$perpage=20) {
		$page=intval($_GET['pageId']);
		
		$userProfileDetails= $this->mobile_model->get_all_details(USERS,array('id'=>$user_id))->result_array();
		$userList=explode(',',$userProfileDetails[0]['following']);
			
		$userList[0]=$user_id;
		$condition='';
		foreach($userList as $userIds){
			$condition.="ua.user_id = ".$userIds." OR ";
		}
		$len=strlen($condition);
		$condition=substr($condition,0,$len-4);
		#$condition="(".$condition.") AND (ua.activity_name='favorite item' OR ua.activity_name='favorite shop')";
		$condition="(".$condition.") AND (ua.activity_name='favorite item')";
		
		if($page>0){
			$postnumbers=$perpage;
			$offset=($page*$perpage)-$perpage;
		}else{
			$postnumbers=$perpage;
			$offset=0;
			$page=1;
		}
		$page=$page+1;
		/* echo $condition."<br>";
		echo $postnumbers."<br>";
		echo $offset; exit; */
		
		$userActivity= $this->mobile_model->get_activity($condition,$postnumbers,$offset)->result_array();
		#print_r($userActivity); exit;
		
		$feedArr=array();
					$feedfavProduct=array();
		foreach($userActivity as $feed){
			#$feedfavProduct=array();
			$feedfavShop=array();
			$feedProductStatus=0;
			$feedShopStatus=0;
			
			if($feed['activity_name']=='favorite item') {
				$feedProductStatus=1;
				$feedproductDetails = $this->mobile_model->get_feed_product($feed['activity_id'])->result();
				$feeduserDetails = $this->mobile_model->get_feed_user($feed['user_id'])->result();
				$feedfavStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$feed['activity_id'],'user_id'=>$user_id,'favorite'=>'Yes'))->num_rows();
				$img=explode(',',$feedproductDetails[0]->productImage);
				if($feeduserDetails[0]->userImage!=""){
					$userImage=base_url().'images/users/thumb/'.$feeduserDetails[0]->userImage;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				if($user_id!=$feeduserDetails[0]->userId){
					$feeduser=$feeduserDetails[0]->userFirstName.' '.$feeduserDetails[0]->userLastName;
				}else{
					$feeduser='You';
				}
				$feedfavProduct[]=array('feedProductStatus'=>(string)$feedProductStatus,
							'productId'=>$feedproductDetails[0]->productId,
							'productName'=>$feedproductDetails[0]->productName,
							'productUrl'=>$feedproductDetails[0]->productUrl,
							"productPrice"=>(string)number_format($this->data["currencyValue"]*$feedproductDetails[0]->productPrice,2),
							'productImage'=>base_url().'images/product/'.$img[0],
							'storeName'=>$feedproductDetails[0]->storeName,
							'feeduser'=>$feeduser,
							'userImage'=>$userImage,
							'feeduserLink'=>$feeduserDetails[0]->userName,
							'feedType'=>'favorited',
							'feedItem'=>'this item',
							'favStatus'=>(string)$feedfavStatus);
			}else if($feed['activity_name']=='favorite shop') {
				$feedShopStatus=1;
				$feedShopDetails = $this->mobile_model->get_feed_shop($feed['activity_id'])->result();
				$feeduserDetails = $this->mobile_model->get_feed_user($feed['user_id'])->result();
				$feedfavStatus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$feed['activity_id'],'user_id'=>$user_id,'favorite'=>'Yes'))->num_rows();
				$feedShopProducts = $this->mobile_model->get_all_details(PRODUCT,array('user_id'=>$feedShopDetails[0]->sellerId,'status'=>'Publish','pay_status'=>'Paid'),array(array('field'=>'created','type'=>'desc')))->result_array();
				
				if($feedShopDetails[0]->sellerImage!=""){
					$sellerImage=base_url().'images/users/thumb/'.$feedShopDetails[0]->sellerImage;
				}else{
					$sellerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$shopOwnerName=$feedShopDetails[0]->sellerFirstName.' '.$feedShopDetails[0]->sellerLastName;
				$shopProduct=array('image1'=>'','image2'=>'','image3'=>'');
				if(count($feedShopProducts)>0){
					$shopProduct=array();
					$prdcount=3;
					for($i=0;$i<$prdcount;$i++){
						$val=$i+1;
						if($i<count($feedShopProducts)){
							$img=explode(',',$feedShopProducts[$i]['image']);
							$shopProduct['image'.$val]=base_url().'images/product/'.$img[0];
						}else{
							$shopProduct['image'.$val]="";
						}
					}
				}
				
				if($feeduserDetails[0]->userImage!=""){
					$userImage=base_url().'images/users/thumb/'.$feeduserDetails[0]->userImage;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				if($user_id!=$feeduserDetails[0]->userId){
					$feeduser=$feeduserDetails[0]->userFirstName.' '.$feeduserDetails[0]->userLastName;
				}else{
					$feeduser='You';
				}
				
				$feedfavShop=array('shopId'=>$feedShopDetails[0]->sellerId,
							'shopName'=>$feedShopDetails[0]->shopName,
							'shopUrl'=>$feedShopDetails[0]->shopUrl,
							'shopOwnerName'=>$shopOwnerName,
							'shopOwnerLocation'=>(string)$feedShopDetails[0]->Location,
							'shopOwnerImage'=>$sellerImage,
							'shopOwnerLink'=>$feedShopDetails[0]->sellerLink,
							'shopProduct'=>$shopProduct,
							'feeduser'=>$feeduser,
							'userImage'=>$userImage,
							'feeduserLink'=>$feeduserDetails[0]->userName,
							'feedType'=>'favorited',
							'feedItem'=>'this shop',
							'favStatus'=>(string)$feedfavStatus);
			}
			/*$feedArr[]=array('feedProductStatus'=>(string)$feedProductStatus,
											'feedProductDetails'=>$feedfavProduct,
											'feedShopStatus'=>(string)$feedShopStatus,
											'feedShopDetails'=>$feedfavShop);
											*/
			#$feedArr[]=array('feedProductStatus'=>(string)$feedProductStatus,'feedProductDetails'=>$feedfavProduct);
		}
		#echo "<pre>"; print_r($feedArr); 	die;
		$json_encode = json_encode(array("yourFeed" => $feedfavProduct,"pagePos"=> (string)$page,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));		
		echo $json_encode;
	}
	/** 
	 * 
	 * Adding Product into CART
	 */
	public function cart_add(){ 
	
		$product_id = intval($_POST['id']);
		$quantity = intval($_POST['qty']);
		$user_id = intval($_POST['user']);
		$price = intval($_POST['price']);
		$attribute_values = (string)$_POST['attrVal'];
		
		$prdDetail=$this->mobile_model->get_all_details(PRODUCT,array( 'id' => $product_id));	
		if($prdDetail->num_rows()>0){
			$mqty=$prdDetail->row()->quantity;
			$dataArrVal=array('product_id'=>$product_id,
												'quantity'=>$quantity,
												'price'=>$price,
												'user_id'=>$user_id,
												'sell_id'=>$prdDetail->row()->user_id,
												'attribute_values'=>$attribute_values);
			$datestring = date('Y-m-d H:i:s',now());
			$indTotal =$price * $quantity;
			$dataArry_data = array('created' => $datestring,
													'indtotal' => $indTotal, 
													'total' => $indTotal);
			$dataArr = array_merge($dataArrVal,$dataArry_data);
			
			$condition ='';
			
			$productVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $user_id,'product_id' => $product_id,'attribute_values' => $attribute_values));	
			
			if($productVal->num_rows > 0){
				$newQty = $productVal->row()->quantity + $quantity;			
				if ($newQty <= $mqty){
					$indTotal = $price * $newQty ; 
					$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'total' => $indTotal);
					$condition =array('id' => $productVal->row()->id);
					$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
				}else{
					#echo 'Error|'.$productVal->row()->quantity; die;
      $returnArr['status'] ='0';
      $returnArr['message'] =(string)$productVal->row()->quantity;
				} 				
			}else{
				$this->mobile_model->simple_insert(USER_SHOPPING_CART,$dataArr);
			}
			#echo 'Success|'.$this->mobile_model->mini_cart_view($user_id); 
   $returnArr['status'] ='1';
   $returnArr['message'] =(string)$this->mobile_model->mini_cart_view($user_id);
		}else{
			#echo 'Error|invalidProduct';
   $returnArr['status'] ='0';
   $returnArr['message'] ='invalidProduct';
		}
  
 
  $json_encode = json_encode($returnArr);
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Display User CART
	 */
	public function display_cart($user_id=""){
	
       	define("PaypalIDDetails",$this->config->item('payment_0'));
		define("API_LOGINIDDetails",$this->config->item('payment_1'));
		define("API_PayuDetails",$this->config->item('payment_2'));
		define("StripeDetails",$this->config->item('payment_3'));
		define("TwoCheckoutDetails",$this->config->item('payment_4'));
		define("BrainTree",$this->config->item('payment_5'));
		define("PesapalDetails",$this->config->item('payment_6'));
		define("Pay_On",$this->config->item('payment_7'));
        //$payonDetail = unserialize(Pay_On);
		
		
		$paypalDetailsVal = unserialize(PaypalIDDetails);
		$authorizeDetailsVal = unserialize(API_LOGINIDDetails);
		$payAdptDetailsVal = unserialize(PaypalAdaptDetails);
		$StripeDetailsVAl = unserialize(StripeDetails);
        $twocheckoutDetailsVal = unserialize(TwoCheckoutDetails);
		$braintreeDetailsVal = unserialize(BrainTree);
		$pesapalDetail = unserialize(PesapalDetails);
                //$payonDetail = unserialize(Pay_On);
		
		
		$PaypalVal = unserialize($paypalDetailsVal['settings']);
		$AuthorizesVal = unserialize($authorizeDetailsVal['settings']);
		$paypalAdptVal = unserialize($payAdptDetailsVal['settings']);
		$StripeVal = unserialize($StripeDetailsVAl['settings']);
		$twocheckoutvalue = unserialize($twocheckoutDetailsVal['settings']);
		$braintreevalue = unserialize($braintreeDetailsVal['settings']);
		$pesapalValue = unserialize($pesapalDetail['settings']);
		//$payonValue = unserialize($payonDetail['settings']);
		
		$payment_type = array();
		$i = 0;
		if($paypalDetailsVal['status']=='Enable'){
				if($PaypalVal['merchant_email']!=''){
				$payment_type [] =  array('type'=>'Paypal');
				}
			} 
		if($authorizeDetailsVal['status']=='Enable'){
			if($AuthorizesVal['Login_ID']!='' && $AuthorizesVal['Transaction_Key']!=''){
					$payment_type []= array('type'=>'Credit Card');
			}
		}

		if($twocheckoutDetailsVal['status']=='Enable'){
			$payment_type []= array('type'=>'Twocheckout');
		}
		
		
		if($StripeDetailsVAl['status']=='Enable'){
			if($StripeVal['secret_key']!='' && $StripeVal['publishable_key']!=''){
					$payment_type [] = array('type'=>'Stripe');
				}
		}
		if($pesapalDetail['status']=='Enable'){
				if($pesapalValue['consumer_key']!='' && $pesapalValue['consumer_secret']!=''){
					$payment_type [] = array('type'=>'Pesapal');		
				}
		}
		if($braintreeDetailsVal['status']=='Enable'){
			if($braintreevalue['PrivateKey']!='' && $braintreevalue['CSE_Key']!=''){
					$payment_type [] =array('type'=>'BrainTree');
					}
		} 
/*		if($payonDetail['status']=='Enable'){
			if($payonValue['user_ID']!='' && $payonValue['password']!='' && $payonValue['entity_ID']!=''){
					$payment_type [] =array('type'=>'Payon');	
			}
		} */                 
		
		
	
		$this->db->select('sell_id');
		$this->db->from(USER_SHOPPING_CART);
		$this->db->where('user_id = '.$user_id);
		$this->db->group_by("sell_id");
		$UsercartSellVal = $this->db->get();
		$this->db->select('id,full_name');
		$this->db->from(SHIPPING_ADDRESS);
		$this->db->where('user_id = '.$user_id);
		$shipAddress = $this->db->get()->result_array();
		$shopCart = array();
		//$shopCart[] =array("products"=>array());
		$userCart=array();
		$couponDetails = array();
		if($UsercartSellVal -> num_rows() > 0 ){
			$shopCart=array();
			
			foreach ($UsercartSellVal->result() as $UserSellRow){
				$this->db->select('us.*,p.product_name,p.seourl,p.image,p.id as prdid,p.sale_price as orgprice,p.quantity as mqty,u.user_name,u.thumbnail as sellerImage,s.seller_businessname,s.seourl as shopurl,s.payment_mode,s.PayPal_mode,s.PayPal_email,s.authorize_mode');
				$this->db->from(USER_SHOPPING_CART.' as us');
				$this->db->join(PRODUCT.' as p' , 'p.id = us.product_id');
				$this->db->join(USERS.' as u' , 'u.id = us.sell_id');
				$this->db->join(SELLER.' as s' , 's.seller_id = u.id');
				$this->db->where('us.user_id = '.$user_id.' and u.id='.$UserSellRow->sell_id);		
				$UsercartVal = $this->db->get();
				//print_r($this->db->last_query());die;
				$selId = $UserSellRow->sell_id;	
				
				
				$this->db->select('id');
				$this->db->from(FAVORITE);
				$this->db->where('shop_id = '.$selId);
				$this->db->where('user_id = '.$user_id);
				$this->db->where('favorite = "Yes"');
				$shopfavStatus = $this->db->get()->num_rows();
				
				
				$UsercartAmt = 0; $UsercartShippingAmt = 0; $UsercartTaxAmt = 0; 
				$shopPrducts=array();
				$couponDetails =array('couponCode'=>$UsercartVal->row()->couponCode,'discountAmount'=>$UsercartVal->row()->discountAmount,'couponID'=>$UsercartVal->row()->couponID,'coupontype'=>$UsercartVal->row()->coupontype);
			
				foreach ($UsercartVal->result() as $UserCartRow){				
					$img=explode(',',$UserCartRow->image);
					$shopPrducts[]=array('cartId'=>(string)$UserCartRow->id,
														'productId'=>(string)$UserCartRow->prdid,
														'productName'=>$UserCartRow->product_name,
														'productChoice'=>$UserCartRow->attribute_values,
														'productUrl'=>$UserCartRow->seourl,
														'productImage'=>base_url().'images/product/mb/thumb/'.$img[0],
														'productQty'=>(string)$UserCartRow->quantity,
														'productMaxQty'=>(string)$UserCartRow->mqty,
														"productUnitPrice"=>(string)number_format($this->data["currencyValue"]*$UserCartRow->price,2),
														"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"],
														'shippingCost'=>(string)number_format($this->data["currencyValue"]*$UserCartRow->product_shipping_cost,2),
														'productTotal'=>(string)number_format($this->data["currencyValue"]*($UserCartRow->price * $UserCartRow->quantity+($UserCartRow->shipping_cost)),2));
														
					$UsercartAmt = $UsercartAmt + ($UserCartRow->price * $UserCartRow->quantity);
					$UsercartShippingAmt = $UsercartShippingAmt + $UserCartRow->shipping_cost;
					$UsercartTaxAmt = $UsercartTaxAmt + ($UserCartRow->product_tax_cost * $UserCartRow->quantity);
				}
				if($UserCartRow->sellerImage!=""){
					$sellerImage=base_url().'images/users/thumb/'.$UserCartRow->sellerImage;
				}else{
					$sellerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				
				
				
				
				$payment_mode=explode(',',$UserCartRow->payment_mode);
				
				$UsercartTotalAmt=$UsercartAmt+$UsercartShippingAmt+$UsercartTaxAmt;
				$discountAmount = $UserCartRow->discountAmount;
				$UsercartTotalAmt=$UsercartTotalAmt-$discountAmount;
				//print_r($UsercartTotalAmt);die;
				$shopCart[]=array('shopName'=>$UserCartRow->seller_businessname,
												'shopId'=>(string)$UserSellRow->sell_id,
												'shopUrl'=>$UserCartRow->shopurl,
												'shopOwnerImage'=>$sellerImage,
												'favStatus'=>(string)$shopfavStatus,
												'products'=>$shopPrducts,
												'shopPaymentMode'=>$payment_mode,
												'currencySymbol' =>$this->data["currencySymbol"],
												'currencyCode' =>$this->data["currencyCode"],
												'shopSubTotal'=>(string)number_format($this->data["currencyValue"]*$UsercartAmt,2),
												'shopShipping'=>(string)number_format($this->data["currencyValue"]*$UsercartShippingAmt,2),
												'shopTax'=>(string)number_format($this->data["currencyValue"]*$UsercartTaxAmt,2),
												'discountAmount'=>(string)number_format($this->data["currencyValue"]*$discountAmount,2),
												'shopTotal'=>(string)number_format($this->data["currencyValue"]*$UsercartTotalAmt,2),
												'couponCode'=>(string)$UserCartRow->couponCode,
												'shopCartSubTotal'=>(string)$UsercartAmt,
												'shopCartShipping'=>(string)$UsercartShippingAmt,
												'shopCartTax'=>(string)$UsercartTaxAmt,
												'shopCartTotal'=>(string)$UsercartTotalAmt);
			}
		}
		
		$userCart[]=array('shippingAddress'=>$shipAddress,'cartItems'=>$shopCart);
		#echo "<pre>"; print_r($userCart); 	die;
		$json_encode = json_encode(array("yourCart" => $userCart,"cartCount"=>(string)$this->data["cartCount"],'payment_type'=>$payment_type,'couponDetails'=>$couponDetails));		
		echo $json_encode;
		
		
	}
	/** 
	 * 
	 * Remove cart by Product
	 */
	public function remove_cartProduct(){
		$cart_id = intval($_GET['cartId']);
		if($cart_id>0){
			$this->db->delete(USER_SHOPPING_CART, array('id' => $cart_id)); 
			$returnStr['status_code'] = "Success";
			echo json_encode($returnStr);
		}else{
			$returnStr['status_code'] = "Error";
			echo json_encode($returnStr);
		}
	}
	
	/** 
	 * 
	 * Remove cart by Shop
	 */
	public function remove_cartShop(){
		$shop_id = intval($_GET['shop']);
		$user_id = intval($_GET['user']);
		if($shop_id>0 && $user_id>0){
			$this->db->delete(USER_SHOPPING_CART, array('sell_id' => $shop_id,'user_id'=>$user_id)); 
			$returnStr['status_code'] = "Success";
			echo json_encode($returnStr);
		}else{
			$returnStr['status_code'] = "Error";
			echo json_encode($returnStr);
		}
	}
	
	/** 
	 * 
	 * Update cart by Quantity
	 */
	public function updateCart(){
		$cartId = intval($_GET['cartId']);
		$qty = intval($_GET['qty']);
		
		if($shop_id>0 && $user_id>0){
			$this->db->delete(USER_SHOPPING_CART, array('sell_id' => $sellerId,'user_id'=>$user_id)); 
		}
		
		$productVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array('id' => $cartId));	
		
		$newQty = $qty;
		$indTotal = $productVal->row()->price * $newQty ;
		$shipcost = $productVal->row()->product_shipping_cost * $newQty ;
			
		$dataArr = array('quantity' => $newQty, 'indtotal' => $indTotal, 'shipping_cost' => $shipcost, 'total' => $indTotal);
		$condition =array('id' => $productVal->row()->id);
		$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition);
		
		$userCartVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array('user_id' => $productVal->row()->user_id,'sell_id'=>$productVal->row()->sell_id));	
		
		$UsercartAmt = 0; $UsercartShippingAmt = 0; $UsercartTaxAmt = 0; 
		foreach ($userCartVal->result() as $UserCartRow){				
			$UsercartAmt = $UsercartAmt + ($UserCartRow->price * $UserCartRow->quantity);
			$UsercartShippingAmt = $UsercartShippingAmt + $UserCartRow->shipping_cost;
			$UsercartTaxAmt = $UsercartTaxAmt + ($UserCartRow->product_tax_cost * $UserCartRow->quantity);
		}
		$UsercartTotalAmt=$UsercartAmt+$UsercartShippingAmt+$UsercartTaxAmt;
		
		echo $UsercartAmt."|".$UsercartShippingAmt."|".$UsercartTaxAmt."|".$UsercartTotalAmt;
		
	}
	/** 
	 * 
	 * Update Shipping Address
	 */
	public function updateCartAddress(){
		$addrId = intval($_GET['addrId']);
		$shopId = intval($_GET['shopId']);
		$userId = intval($_GET['userId']);
		
		if($addrId>0){		
			$ChangeAdds=$this->mobile_model->get_all_details(SHIPPING_ADDRESS,array( 'user_id' => $userId,'id' => $addrId));			
			$this->db->select("*");
			$this->db->where(array("seller_id"=>$shopId,"state_name"=>$ChangeAdds->row()->state));
			$this->db->from(SELLER_TAX);
			$TaxList=$this->db->get();
				
			if($TaxList->row()->tax_amount > 0){
				$taxAmt = $TaxList->row()->tax_amount;
			}else{
				$taxAmt = 0;
			}
				
			$ProductVal = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'sell_id' => $shopId, 'user_id' => $userId),array(array('field'=>'id','type'=>'Asc')));	
			
			$s=0;
		
		foreach($ProductVal->result_array() as $prodtVal){	
			$shipCost = $shipCost1 = 0;
						
			$this->db->select("ship_cost,ship_other_cost");
			$this->db->where(array( 'product_id' => $prodtVal['product_id'],'ship_name' => $ChangeAdds->row()->country));	
			$this->db->from(SUB_SHIPPING);
			$this->db->order_by('ship_id','DESC');
			$SubShipVal=$this->db->get();
		
		
			if($SubShipVal->num_rows() > 0){
				if($s==0){
					$shipCost = $SubShipVal->row()->ship_cost;
				}else{
					$shipCost = $SubShipVal->row()->ship_other_cost;
				}

				$newshipCost = number_format( ($prodtVal['quantity'] * $shipCost),2,'.','');
				$conditionShip = array('id' => $prodtVal['id']);
				$dataArrShip = array('product_shipping_cost' => $shipCost,'shipping_cost' => $newshipCost,'shipping'=>'Yes','tax'=>$taxAmt);
				
				$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip,$conditionShip); 
				$s++;	
			}else{				
				$this->db->select("ship_cost,ship_other_cost");
				$this->db->where(array( 'product_id' => $prodtVal['product_id'],'ship_name' => 'Everywhere Else'));	
				$this->db->from(SUB_SHIPPING);
				$this->db->order_by('ship_id','DESC');
				$SubShipValNew=$this->db->get();
				
				if($SubShipValNew->num_rows() > 0){
					if($s==0){
						$shipCost1 = $SubShipValNew->row()->ship_cost;
					}else{
						$shipCost1 = $SubShipValNew->row()->ship_other_cost;
					}
					$newshipCost1 = number_format( ($prodtVal['quantity'] * $shipCost1),2,'.','');
					$conditionShip1 = array('id' => $prodtVal['id']);
					$dataArrShip1 = array('product_shipping_cost' => $shipCost1,'shipping_cost' => $newshipCost1,'shipping'=>'Yes','tax'=>$taxAmt);	
					
					$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 			
					$s++;	
				}else{
					$conditionShip1 = array('id' => $prodtVal['id']);
					$dataArrShip1 = array('product_shipping_cost' => '0.00','shipping_cost' => '0.00','shipping'=>'No','tax'=>'0.00');	
					$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArrShip1,$conditionShip1); 
				}				
			}					
		}
			echo "Success";
		}else{
			echo "Error";
		}
		
	}
	
	public function pickspage($perpage=10){
		
		$this->db->select('count(`id`) as TotCats');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		$this->db->where('rootID',0);
		$CategoryCount = $this->db->get(); 

		
		$this->db->select('id,cat_name,image,rootID');
		$this->db->from(CATEGORY);
		$this->db->where('status','Active');
		$this->db->where('rootID',0);
	
		$CategoryVal = $this->db->get(); 
		$CatArr = array();
		foreach($CategoryVal->result() as $catVal){
			if($catVal->image!=''){
				$catImage = $catVal->image;
			}else{
				$catImage = 'no_image.jpg';
			}
			$CatArr[] = array("id" => $catVal->id, "categoryName" => $catVal->cat_name,"image" =>base_url().'images/category/'.$catImage,"catId"=>$catVal->rootID);
		}
	
			$json_encode = json_encode(array("categoryDetails" => $CatArr,"cartCount"=>(string)$this->data["cartCount"],"totalCategories" => $CategoryCount->row()->TotCats));
			
			
		$this->db->select('p.id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		$totalproductList = $this->db->get();
		
		
		$this->db->select('p.id,p.product_name,p.image,p.price,p.base_price,p.user_id,p.status,s.seller_businessname,s.seller_id');
		$this->db->from(PRODUCT.' as p');
		$this->db->join(SELLER.' as s' , 'p.user_id = s.seller_id','inner');	
		$this->db->where('p.status','Publish');
		$this->db->where('p.pay_status','Paid');
		$this->db->where('s.status','active');
		$this->db->order_by('p.created','DESC');
		$this->db->limit(4);
		$productList = $this->db->get();
		$itemCount=$totalproductList->num_rows();
		$ProdArr = array();
		foreach($productList->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			$imgurl=base_url().'images/product/mb/crop/'.$img[0];

			$ProdArr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" =>$imgurl,
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname);
		}
		
			$returnStr['categoryDetails'] = $CatArr;
			$returnStr['cartCount'] = (string)$this->data["cartCount"];
			$returnStr['totalCategories'] = $CategoryCount->row()->TotCats;
			$returnStr['productDetails'] = $ProdArr;
			$returnStr['itemCount'] =(string)$itemCount;
			$returnStr['currencySymbol'] = $this->data["currencySymbol"];
			$returnStr['currencyCode'] = $this->data["currencyCode"];
		
		echo json_encode($returnStr);die;
		
	} 
	
	public function homepage(){
	
	$recent_product_details =  $this->mobile_model->get_recent_product_details_mobile();
	$featured_product_details = $this->mobile_model->get_featured_product_details_mobile();
	$featured_shop_details = $this->mobile_model->get_featured_shop_details_mobile();
    //$this->data['recentpromote'] =$recentpromote = $this->product_model->getrecentpromote();
	$maxfavourite = $this->mobile_model->getmaxfav_mobile();
	
		$recent_product_details_arr = array();
		foreach($recent_product_details->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			if($ProdList->thumbnail!=''){ 
			$profile_pic=base_url().'images/users/thumb/'.$ProdList->thumbnail; } else { 
			
			$profile_pic=base_url().'images/default_avat.png';
			}
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			$imgurl=base_url().'images/product/mb/crop/'.$img[0];

			$recent_product_details_arr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" =>$imgurl,
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname,
											"profile_pic"=>$profile_pic,
											"user_name"=>$ProdList->user_name,
											"full_name"=>$ProdList->full_name,
											"shop_ratting"=>number_format($ProdList->shop_ratting,2),
											"shop_seourls"=>base_url().'shop-section/'.$ProdList->shop_seourls,
											"product_seourl"=>base_url().'products/'.$ProdList->product_seourl);
		}
	
	
	$featured_product_details_arr = array();
		foreach($featured_product_details->result() as $ProdList) {
			$img=explode(',',$ProdList->image);
			
			if($this->data["commonId"]>0){
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$ProdList->id,'user_id'=>$this->data["commonId"],'favorite'=>'Yes'))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
			}else{
				$favStatus=0;
			}
			if($ProdList->thumbnail!=''){ 
			$profile_pic=base_url().'images/users/thumb/'.$ProdList->thumbnail; } else { 
			
			$profile_pic=base_url().'images/default_avat.png';
			}
			
			
			$imgurl=base_url().'images/product/mb/crop/'.$img[0];

			$featured_product_details_arr[] = array("productId" => $ProdList->id,
											"productName" => character_limiter($ProdList->product_name,15),
											"Image" =>$imgurl,
											"Price"=>(string)number_format($this->data["currencyValue"]*$ProdList->base_price,2),
											"favStatus" =>(string)$favStatus,
											"storeName" => $ProdList->seller_businessname,
											"profile_pic"=>$profile_pic,
											"user_name"=>$ProdList->user_name,
											"full_name"=>$ProdList->full_name,
											"shop_ratting"=>number_format($ProdList->shop_ratting,2),
											"shop_seourls"=>base_url().'shop-section/'.$ProdList->shop_seourls,
											"product_seourl"=>base_url().'products/'.$ProdList->product_seourl);
		}
	
	
			$featured_shop_details_arr = array();
	
		foreach($featured_shop_details->result() as $ProdList) {
			
			if($ProdList->thumbnail!=''){ 
			$profile_pic=base_url().'images/users/thumb/'.$ProdList->thumbnail; } 
			else { 
			
			$profile_pic=base_url().'images/users/user-thumb1.png';
			}
			
			if($ProdList->seller_banner!=''){ 
			$seller_banner=base_url().'images/banner/'.$ProdList->seller_banner; } 
			else { 
			$seller_banner=base_url().'images/dummyProductImage.jpg';
			}
			
			

			$featured_shop_details_arr[] = array("seourl" => base_url().'shop-section/'.$ProdList->seourl,
											"seller_banner" =>$seller_banner,
											"profile_pic"=>$profile_pic,
											"user_name"=>$ProdList->user_name,
											"full_name"=>$ProdList->full_name,
							);
		}
	
         $maxfavourite_arr = array();
	
		foreach($maxfavourite->result() as $FavourPick) {
			
			if($FavourPick->thumbnail!=''){ 
			$profile_pic=base_url().'images/users/thumb/'.$FavourPick->thumbnail; } 
			else { 
			$profile_pic=base_url().'images/users/user-thumb1.png';
			}
			$seller_firstname =$FavourPick->seller_firstname;
			$product_details =$this->mobile_model->get_fav_product_details_mobile($FavourPick->seller_id);
			$productDetails = array();
			foreach($product_details->result() as $proDetail){
			 $img= explode(',', $proDetail->image); 
			 $productDetails[] = array('image'=>base_url().'images/product/mb/crop/'.$img[0],'product_name'=>$proDetail->product_name);
			}
			
			
			
			$maxfavourite_arr[] = array("seourl" => base_url().'shop-section/'.$FavourPick->seourl,
											"seller_firstname" =>$seller_firstname,
											"profile_pic"=>$profile_pic,
											"productDetails"=>$productDetails,
											"favourites"=>$FavourPick->new_id
							);
		}
   
		$bancondition = array('status' =>'Publish');
		 $bannerSlide =  $this->mobile_model->get_all_details(LANDING_BANNER,$bancondition);
		 $bannerSlide_image= $this->mobile_model->get_all_details(LANDING_BANNER,$bancondition)->result_array();
		 $banner_settings = $this->mobile_model->get_all_details(BANNER_SETTINGS,array());
		
		$recentFavorites= $this->mobile_model->get_resent_favorite_list()->result_array(); 
		//echo  $this->db->last_query();exit();
		$newFavArr[]=$recentFavorites[0]['shop_id'];
		$recentnewFavorites[0]=$recentFavorites[0];
		$j=0;$l=1;
		for($k=1;$k<count($recentFavorites);$k++){
			if(!in_array($recentFavorites[$k]['shop_id'],$newFavArr)){
				$j++;$l++;
				$newFavArr[]=$recentFavorites[$k]['shop_id'];
				$recentnewFavorites[$l-1]=$recentFavorites[$k];
				if($l==4){break;}
			}
		}
		
		
			$image_name=base_url()."images/landingbanner/banner-admin.jpg";  
			if($banner_settings->row()->status == 'Active'){
				if($bannerSlide_image[0]['image'] != ''){
					$image_name=base_url().'images/landingbanner/'.$bannerSlide_image[0]['image'];
				}		
			} else {
				if($recentFavorites[0]['seller_banner'] != ''){
					$image_name = base_url().'images/banner/'.$recentFavorites[0]['seller_banner'];
				} 
			}
			
			$banner_description='';
			if($banner_settings->row()->banner_description != '' && $banner_settings->row()->show_banner_text == 'Yes'){
				$banner_description=$banner_settings->row()->banner_description;
			}else{
				$banner_description=$this->config->item('banner_description');
			}
			
		$condition = array('status'=>'active');
		$sliderslist = $this->mobile_model->get_all_details(HOME_SLIDERS,array());
		//print_r($sliderslist->result());
		$slider_details = array();
		foreach($sliderslist->result() as $sliderslistArr){
		$slider_details[] = array('id'=>$sliderslistArr->id,'title'=>$sliderslistArr->title,'description'=>$sliderslistArr->description,'image'=>base_url().'images/sliders/'.$sliderslistArr->image,'link'=>$sliderslistArr->link);
		}
 
     $banner_details = array();
    $banner_details[]= array('banner_description'=>$banner_description,'seller_banner'=>$image_name);
	$returnStr['TopSellers'] = $maxfavourite_arr;
	$returnStr['featured_shop_details'] = $featured_shop_details_arr;
	$returnStr['featured_product_details'] = $featured_product_details_arr;
	$returnStr['recent_product_details'] = $recent_product_details_arr;
	$returnStr['TopSellerscount'] = $maxfavourite->num_rows();;
	$returnStr['banner_details'] = $banner_details;
	$returnStr['slider_details'] = $slider_details;
	$returnStr['featured_shop_details_count'] = $featured_shop_details->num_rows();
	$returnStr['featured_product_details_count'] = $featured_product_details->num_rows();
	$returnStr['recent_product_details_count'] = $recent_product_details->num_rows();
	$returnStr['cartCount'] = (string)$this->data["cartCount"];
	$returnStr['currencySymbol'] = $this->data["currencySymbol"];
	$returnStr['currencyCode'] = $this->data["currencyCode"];
	
	echo json_encode($returnStr);die;
	
	
	
	
	
	
	/*
	
	$recentFavorites= $this->mobile_model->get_resent_favorite_list()->result_array(); 
		//echo  $this->db->last_query();exit();
		$newFavArr[]=$recentFavorites[0]['shop_id'];
		$recentnewFavorites[0]=$recentFavorites[0];
		$j=0;$l=1;
		for($k=1;$k<count($recentFavorites);$k++){
			if(!in_array($recentFavorites[$k]['shop_id'],$newFavArr)){
				$j++;$l++;
				$newFavArr[]=$recentFavorites[$k]['shop_id'];
				$recentnewFavorites[$l-1]=$recentFavorites[$k];
				if($l==4){break;}
			}
		}
		$this->data['recentFavorites']=$recentnewFavorites;
		
		
		
		$FavoriteShopsProducts=array();
		$FavoriteShops='';
		foreach($recentnewFavorites as $listFav){	
			if($listFav['shop_id'] !=''){		
				$products=$this->product_model->get_product_from_favorite_shop('p.user_id='.$listFav['shop_id'].' GROUP BY p.id')->result_array();
				$FavoriteShopsProducts[$listFav['shop_id']]=$products; 
				$FavoriteShops.=$listFav['shop_id'].',';	
			}
		}
		$pickedUsers=$this->user_model->get_pickedItems();
		#echo $this->db->last_query();  #die;
		
		foreach($pickedUsers->result_array() as $UsersPick){
			$pickedUsersFavorites[$UsersPick['user_id']]=$this->user_model->get_userfav_products($UsersPick['user_id'])->result();
		}
		
		
		
		$this->data['pickedUsers']=$pickedUsers->result_array();
		$this->data['pickedUsersFavorites']=$pickedUsersFavorites;
		$this->data['FavoriteShops']=$FavoriteShops ;
		$this->data['FavoriteShopsProducts']=$FavoriteShopsProducts ;

		###$this->data['testimonials'] = $testimonials= $this->user_model->get_testimonials()->result();
		$this->data['testimonials'] =$recentBlogPosts = $this->user_model->getrecentSellerBlog();
		
		#echo "<pre>"; print_r($recentBlogPosts); die;
		###echo "<pre>"; print_r($recentBlogPosts); die;
		
		
		$bancondition = array('status' =>'Publish');
		$this->data['bannerSlide'] = $this->user_model->get_all_details(LANDING_BANNER,$bancondition);
		$this->data['bannerSlide_image'] = $this->user_model->get_all_details(LANDING_BANNER,$bancondition)->result_array();
		
		$this->data['banner_settings'] = $this->user_model->get_all_details(BANNER_SETTINGS,array());

		#echo "<pre>"; print_r($this->data['bannerSlide']); die;
		
		
		
		$this->data['maxfavourite'] =$maxfavourite = $this->product_model->getmaxfav();
		#echo "<pre>"; print_r($this->data['recentpromote']->result()); die;
		
		$testiMoni= array_rand($recentpromote->result());
		
		$this->data['new_promote'] = $recentpromote->row($testiMoni);
		
		$this->load->view('site/landing/landing',$this->data);*/
	
	
	}
	
	
	/** 
	 * 
	 * Displaying User Profile
	 */
	public function user_profile_image($user_name=""){
		$userProfile=array();
		$userDetails=$this->mobile_model->get_all_details(USERS,array( 'user_name' => $user_name,'status' =>'Active'));
		if($userDetails->num_rows()>0){
			$user_id=$userDetails->row()->id;
			if($userDetails->row()->thumbnail!=""){
				$userImage=base_url().'images/users/thumb/'.$userDetails->row()->thumbnail;
			}else{
				$userImage=base_url().'images/users/thumb/profile_pic.png';
			}
			$userInfo[]=array('user_name'=>$userDetails->row()->user_name,
										'userFullName'=>$userDetails->row()->full_name.' '.$userDetails->row()->last_name,
										'userImage'=>$userImage,
										'userLocation'=>$userDetails->row()->city,
										'userGender'=>(string)$userDetails->row()->gender,
										'userJoined'=>date("F d Y",strtotime($userDetails->row()->created)),
										'followersTotal'=>$userDetails->row()->followers_count,
										'followingTotal'=>$userDetails->row()->following_count
										);
			
			#User Favorite Item List 			
			$userfavDetails=$this->mobile_model->getFavoriteListProduct($user_id,4,0)->result_array();
			//print_r($this->db->last_query());die;
				$favItems=array();
				$params = array();
				if(count($userfavDetails)>0){
					$favItems=array();
					$favProductList=array();
					$prdcount=4;
					for($i=0;$i<$prdcount;$i++){
						$val=$i+1;
						if($i<count($userfavDetails)){
							$img=explode(',',$userfavDetails[$i]['product_image']);
							$image=base_url().'images/product/mb/thumb/'.$img[0];
							$params[] = $img[0];
						}else{
							$image="";
						}
						
						
						
						$favProductList[]=array('image'=>$image,
														'productUrl'=>$userfavDetails[$i]['product_url'],
														'productId'=>$userfavDetails[$i]['product_id']);
					}
					
				//	print_r($params);die;
						if(count($params) > 0){
					$image = $this->newimagemerger($params);
					if($image ==''){
						$image = base_url().'images/site/logo1.png';
					}	
					print_r($image);die;
					}
					
					
					
					
					
						$favItems[]=array('listName'=>'Items I Love',
													'Link'=>'json/'.$userDetails->row()->user_name.'/favorite',
													'products'=>$favProductList,
													'favCount'=>(string)count($userfavDetails));
				}
			#User Favorite Shop List
			
			$userfavShops=$this->mobile_model->getFavoriteListShop($user_id);
			$favShops=array();
			if($userfavShops->num_rows()>0){			
				$shopCount=0;
				foreach($userfavShops->result() as $favShop){
					$shopCount++;
					if($shopCount<=3){
						$favShopsPrds=array();
						$shopPrds=$this->mobile_model->get_shopProducts($favShop->shopId)->result_array();
						if(count($shopPrds)>0){
							$prdcount=3;
							for($i=0;$i<$prdcount;$i++){
								if($i<count($shopPrds)){
									$img=explode(',',$shopPrds[$i]['productImage']);
									$image=base_url().'images/product/mb/thumb/'.$img[0];
								}else{
									$image="";
								}
								$favShopsPrds[]=array('image'=>$image);
							}
						}
						if($favShop->sellerImage!=""){
							$sellerImage=base_url().'images/users/thumb/'.$favShop->sellerImage;
						}else{
							$sellerImage=base_url().'images/users/thumb/profile_pic.png';
						}
												
						$favShops[]=array('shopName'=>$favShop->shop_name,
										  'products'=>$favShopsPrds,
										  'prdCount'=>(string)count($shopPrds));						
					}
				}
			}
			
		}
		$shopArr[]=array('favShopCount'=>(string)$userfavShops->num_rows(),'favShop'=>$favShops);
		$userProfile[]=array('userInfo'=>$userInfo,'favProduct'=>$favItems,'favShop'=>$shopArr);
		$json_encode = json_encode(array("userProfile" => $userProfile,"cartCount"=>(string)$this->data["cartCount"]));		
		echo $json_encode;
	}
	
	
	
		public function user_profile($user_name=""){
		error_reporting(0);
		$userProfile=array();
		$userDetails=$this->mobile_model->get_all_details(USERS,array( 'user_name' => $user_name,'status' =>'Active'));
		if($userDetails->num_rows()>0){
			$user_id=$userDetails->row()->id;
			if($userDetails->row()->thumbnail!=""){
				$userImage=base_url().'images/users/thumb/'.$userDetails->row()->thumbnail;
			}else{
				$userImage=base_url().'images/users/thumb/profile_pic.png';
			}
			$userInfo[]=array('user_name'=>$userDetails->row()->user_name,
										'userFullName'=>$userDetails->row()->full_name.' '.$userDetails->row()->last_name,
										'userImage'=>$userImage,
										'userLocation'=>$userDetails->row()->city,
										'userGender'=>(string)$userDetails->row()->gender,
										'userJoined'=>date("F d Y",strtotime($userDetails->row()->created)),
										'followersTotal'=>$userDetails->row()->followers_count,
										'followingTotal'=>$userDetails->row()->following_count
										);
			
			#User Favorite Item List 			
			$userfavDetails=$this->mobile_model->getFavoriteListProduct($user_id,5,0)->result_array();
			
			//print_r($this->mobile_model->db->last_query());die;
			$userfavDetailsTotal=$this->mobile_model->getFavoriteListProduct_count($user_id);
				$favItems=array();
				$params = array();
				if(count($userfavDetails)>0){
					$favItems=array();
					$favProductList=array();
					$prdcount=4;
					for($i=0;$i<$prdcount;$i++){
						$val=$i+1;
						if($i<count($userfavDetails)){
							$img=explode(',',$userfavDetails[$i]['product_image']);
							$image=base_url().'images/product/mb/thumb/'.$img[0];
							$params[] = $img[0];
						}else{
							$image="";
						}
					}
					
					$image = "";
						$image1="";
						$image2 = "";
						$image3="";
						$image4="";
						if(count($params) > 0){
					//$image = $this->newimagemerger($params,'favProduct');
					for($i=0;$i<count($params);$i++){
							if($i==0){
							$image1=base_url().'images/product/mb/thumb/'.$params[$i];
							}
							if($i==1){
							$image2=base_url().'images/product/mb/thumb/'.$params[$i];
							
							}
							if($i==2){
							$image3=base_url().'images/product/mb/thumb/'.$params[$i];
							
							}
							if($i==3){
							$image4=base_url().'images/product/mb/thumb/'.$params[$i];
							}
							}
					}
						$favItems[]=array('listName'=>'Items I Love',
													'Link'=>'json/'.$userDetails->row()->user_name.'/favorite',
													'image1'=>$image1,
													'image2'=>$image2,
													'image3'=>$image3,
													'image4'=>$image4,
													'favCount'=>(string)$userfavDetailsTotal->num_rows());
				}
			#User Favorite Shop List
			
			$userfavShops=$this->mobile_model->getFavoriteListShop($user_id);
			$favShops=array();
			if($userfavShops->num_rows()>0){			
				$shopCount=0;
				foreach($userfavShops->result() as $favShop){
					$shopCount++;
					if($shopCount<=3){
						$favShopsPrds=array();
						$shopPrds=$this->mobile_model->get_shopProducts($favShop->shopId,5,0)->result_array();
						$shopPrdsCount=$this->mobile_model->get_shopProducts_count($favShop->shopId);
						$params = array();
						$url ="http://192.168.1.251:8081//shopsy-v2////images//product//list-image//1439204441-81iovdzwofl._UL1500_";
						//print_r(basename($url));die;
						$path_parts = pathinfo($url);
						//print_r($path_parts['extension']);die;
						if(count($shopPrds)>0){
							$prdcount=4;
							for($i=0;$i<$prdcount;$i++){
								if($i<count($shopPrds)){
									$img=explode(',',$shopPrds[$i]['productImage']);
									$image=base_url().'images/product/mb/thumb/'.$img[0];
									$params[] = $img[0];
								}else{
									$image="";
								}
								$favShopsPrds[]=array('image'=>$image);
							}
						}
						
						$image = "";
						$image1="";
						$image2 = "";
						$image3="";
						$image4="";
						if(count($params) > 0){
						
							//$image = $this->newimagemerger($params,'favshop');
							
							for($i=0;$i<count($params);$i++){
							if($i==0){
							$image1=base_url().'images/product/mb/thumb/'.$params[$i];
							}
							if($i==1){
							$image2=base_url().'images/product/mb/thumb/'.$params[$i];
							
							}
							if($i==2){
							$image3=base_url().'images/product/mb/thumb/'.$params[$i];
							
							}
							if($i==3){
							$image4=base_url().'images/product/mb/thumb/'.$params[$i];
							}
							}
						}
						
						
						
						if($favShop->sellerImage!=""){
							$sellerImage=base_url().'images/users/thumb/'.$favShop->sellerImage;
						}else{
							$sellerImage=base_url().'images/users/thumb/profile_pic.png';
						}	
						if($favShop->seller_banner!=''){ 
							$seller_banner=base_url().'images/banner/'.$favShop->seller_banner; } 
						else { 
							$seller_banner=base_url().'images/dummyProductImage.jpg';
						}
						
						$favShops[]=array('shopName'=>$favShop->shop_name,
										  'image1'=>$image1,
										  'image2'=>$image2,
										  'image3'=>$image3,
										  'image4'=>$image4,
										  'sellerImage'=>$sellerImage,
										  "seller_banner"=>$seller_banner,
										  'prdCount'=>(string)$shopPrdsCount->row()->total);						
					}
				}
			}
			$userProfile[]=array('userInfo'=>$userInfo,'favProduct'=>$favItems,'favShop'=>$favShops,'favShopCount'=>(string)$userfavShops->num_rows());
		}
		//$shopArr[]=array('favShopCount'=>(string)$userfavShops->num_rows(),'favShop'=>$favShops);
		$json_encode = json_encode(array("userProfile" => $userProfile,"cartCount"=>(string)$this->data["cartCount"]));		
		echo $json_encode;
	}
	
	
	
public function newimagemerger($imageArr,$type ='')
{
        
		require_once './application/libraries/imageGrid.php';
		$imagepath = ".images/product/mb/thumb/";
		$_img_urls = array("C:\Users\Public\Pictures\Sample Pictures\Desert.jpg","C:\Users\Public\Pictures\Sample Pictures\Hydrangeas.jpg","C:\Users\Public\Pictures\Sample Pictures\Jellyfish.jpg");
		$srcX=5;
		$srcY=5;
		$posX=0;
		$posY=0;
		$final_images ='';
	 if(count($imageArr) >0){
	 $imgarr = array();
	 $i=0;
	$finalimg=base_url().'images/product/mb/thumb/'.$imageArr[0];
	
	$imageGrid = new imageGrid(500,500,10,10,$finalimg);
	$imageGrid->demoGrid();	
		 foreach($imageArr as $images){
		 $imagepath = base_url().'images/product/mb/thumb/';
		//print_r($imagepath.$images);
			$img = imagecreatefromjpeg($imagepath.$images);
			if($i==0){
			if(count($imageArr) == 1){
			$imageGrid->putImage($img, 10, 10, 0, 0);
			}else if(count($imageArr) == 2){
			$imageGrid->putImage($img, 10, 5, 0, 0);
			}else{
			$imageGrid->putImage($img, 5, 5, 0, 0);
			}
			}else if($i==1){
			if(count($imageArr) == 2){
				$imageGrid->putImage($img, 10, 5, 0, 5);		
			}else{
			$imageGrid->putImage($img, 5, 5, 0, 5);		
			}
			
			}else if($i==2){
			
			$imageGrid->putImage($img, 5, 10, 5, 0,count($imageArr),count($imageArr));
			
			
			}else if($i==3){
			$imageGrid->putImage($img, 5, 10, 5, 5,3,count($imageArr));
			
			}
			$i++;
			}	
			$dist_img =  $imageGrid->save_image();
			$dest  = imagecreatefromjpeg($dist_img);
			$imgname=md5(time().rand(10,99999999).time()).".jpg";
			if($type == 'favProduct'){
			imagejpeg($dest, './favProduct/'.$imgname, 99);
	        $final_images = base_url().'favProduct/'.$imgname;
			}else{
			imagejpeg($dest, './favshop/'.$imgname, 99);
	        $final_images = base_url().'favshop/'.$imgname;
			}
		}
	
		return $final_images;
}


public function convert_image($image_name,$finalimage){
		require_once './application/libraries/imageGrid.php';
		$finalimg=$finalimage;
		//print_r('finalimage = '.$finalimage);die;
		$imageGrid = new imageGrid(487, 487, 10, 10,$finalimg);
		$imageGrid->demoGrid();	
		$_img_urls = array("C:\Users\Public\Pictures\Sample Pictures\Desert.jpg","C:\Users\Public\Pictures\Sample Pictures\Hydrangeas.jpg","C:\Users\Public\Pictures\Sample Pictures\Jellyfish.jpg");
		$srcX=5;
		$srcY=5;
		$posX=0;
		$posY=0;
		
			$img = imagecreatefromjpeg($image_name);
			$imageGrid->putImage($img, 10, 7, 0, 0);
			$image_name = $imageGrid->save_image();
			return $image_name;

}
	
	/** 
	 * 
	 * Displaying User Profile
	 */
	public function user_profile_old($user_name=""){
		$userProfile=array();
		$userDetails=$this->mobile_model->get_all_details(USERS,array( 'user_name' => $user_name,'status' =>'Active'));
		if($userDetails->num_rows()>0){
			$user_id=$userDetails->row()->id;
			if($userDetails->row()->thumbnail!=""){
				$userImage=base_url().'images/users/thumb/'.$userDetails->row()->thumbnail;
			}else{
				$userImage=base_url().'images/users/thumb/profile_pic.png';
			}
			$userInfo[]=array('user_name'=>$userDetails->row()->user_name,
										'userFullName'=>$userDetails->row()->full_name.' '.$userDetails->row()->last_name,
										'userImage'=>$userImage,
										'userLocation'=>$userDetails->row()->city,
										'userGender'=>(string)$userDetails->row()->gender,
										'userJoined'=>date("F d Y",strtotime($userDetails->row()->created)),
										'followersTotal'=>$userDetails->row()->followers_count,
										'followingTotal'=>$userDetails->row()->following_count
										);
			
			#User Favorite Item List 			
			$userfavDetails=$this->mobile_model->getFavoriteListProduct($user_id)->result_array();
				$favItems=array();
				if(count($userfavDetails)>0){
					$favItems=array();
					$favProductList=array();
					$prdcount=3;
					for($i=0;$i<$prdcount;$i++){
						$val=$i+1;
						if($i<count($userfavDetails)){
							$img=explode(',',$userfavDetails[$i]['product_image']);
							$image=base_url().'images/product/mb/thumb/'.$img[0];
						}else{
							$image="";
						}
						$favProductList[]=array('image'=>$image,
														'productUrl'=>$userfavDetails[$i]['product_url'],
														'productId'=>$userfavDetails[$i]['product_id']);
					}
						$favItems[]=array('listName'=>'Items I Love',
													'Link'=>'json/'.$userDetails->row()->user_name.'/favorite',
													'products'=>$favProductList,
													'favCount'=>(string)count($userfavDetails));
				}
			#User Favorite Shop List
			
			$userfavShops=$this->mobile_model->getFavoriteListShop($user_id);
			$favShops=array();
			if($userfavShops->num_rows()>0){			
				$shopCount=0;
				foreach($userfavShops->result() as $favShop){
					$shopCount++;
					if($shopCount<=3){
						$favShopsPrds=array();
						$shopPrds=$this->mobile_model->get_shopProducts($favShop->shopId)->result_array();
						if(count($shopPrds)>0){
							$prdcount=3;
							for($i=0;$i<$prdcount;$i++){
								if($i<count($shopPrds)){
									$img=explode(',',$shopPrds[$i]['productImage']);
									$image=base_url().'images/product/mb/thumb/'.$img[0];
								}else{
									$image="";
								}
								$favShopsPrds[]=array('image'=>$image,
																'productUrl'=>$shopPrds[$i]['productUrl'],
																'productId'=>$shopPrds[$i]['productId']);
							}
						}
						if($favShop->sellerImage!=""){
							$sellerImage=base_url().'images/users/thumb/'.$favShop->sellerImage;
						}else{
							$sellerImage=base_url().'images/users/thumb/profile_pic.png';
						}
						
						$favShops[]=array('shopId'=>$favShop->shopId,
													'shopName'=>$favShop->shop_name,
													'shopUrl'=>$favShop->shop_url,
													'shopOwnerImage'=>$sellerImage,
													'shopOwnerLink'=>$favShop->sellerLink,
													'shopOwnerName'=>$favShop->sellerFirstName." ".$favShop->sellerLastName,
													'products'=>$favShopsPrds,
													'prdCount'=>(string)count($shopPrds));
					}
				}
			}
			
		}
		$userProfile[]=array('userInfo'=>$userInfo,'favProduct'=>$favItems,'favShop'=>$favShops);
		$json_encode = json_encode(array("userProfile" => $userProfile,"cartCount"=>(string)$this->data["cartCount"]));		
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Loading Favorite Details
	 */
	public function view_favorite_details($user_name="",$perpage=20) {		
		$page=intval($_GET['pageId']);
		$type=$_GET['type'];		
		$user_name=$this->uri->segment(4,0);
		
		if($page>= 1){
			$paginationVal = ($page * $perpage)-$perpage;			
		} else {
			$paginationVal = 0;
			$page=1;
		}
		$userDetails=$this->mobile_model->get_all_details(USERS,array( 'user_name' => $user_name,'status' =>'Active'));
		if($userDetails->num_rows()>0){
			$user_id=$userDetails->row()->id;			
			if($type=="product" || $type==""){
				$userfavTotal=$this->mobile_model->getFavoriteListProduct($user_id);
			$userfavDetails=$this->mobile_model->getFavoriteListProduct($user_id,$perpage,$paginationVal)->result_array();
			
				$favProductList=array();
				if(count($userfavDetails)>0){	
					for($i=0;$i<count($userfavDetails);$i++){
						$val=$i+1;
						if($i<count($userfavDetails)){
							$img=explode(',',$userfavDetails[$i]['product_image']);
							$image=base_url().'images/product/mb/thumb/'.$img[0];
						}else{
							$image="";
						}
						$favProductList[]=array('image'=>$image,
														'productUrl'=>$userfavDetails[$i]['product_url'],
														'productName'=>$userfavDetails[$i]['product_name'],
														'productId'=>$userfavDetails[$i]['product_id'],
														'price'=>(string)number_format($this->data["currencyValue"]*$userfavDetails[$i]['base_price'],2),
														"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"],
														'shopName'=>$userfavDetails[$i]['shop_name'],
														'ShopUrl'=>$userfavDetails[$i]['shop_url'],
														'sellerId'=>$userfavDetails[$i]['sellerId'],
														'itemCount'=> (string)$userfavTotal->num_rows(),
														'pagePos'=> (string)$page);
					}
				}
				$json_encode = json_encode(array("favoriteItems" => $favProductList,"cartCount"=>(string)$this->data["cartCount"]));		
			}elseif($type=="shop"){
				$userfavTotal=$this->mobile_model->getFavoriteListShop($user_id);
				$userfavDetails=$this->mobile_model->getFavoriteListShop($user_id,$perpage,$paginationVal)->result_array();
				$favShopList=array();
				if(count($userfavDetails)>0){						
					for($i=0;$i<count($userfavDetails);$i++){					
						$shopPrductsArr=array();
						$shopPrducts=$this->mobile_model->get_shopProducts($userfavDetails[$i]['shopId'])->result_array();		$prdCount=3;
						for($p=0;$p<$prdCount;$p++){						
							if($i<count($shopPrducts)){
								$img=explode(',',$shopPrducts[$p]['productImage']);
								$image=base_url().'images/product/mb/thumb/'.$img[0];
							}else{	
								$image="";
							}
							$shopPrductsArr[]=array('image'=>$image,
														'productUrl'=>$shopPrducts[$p]['productUrl'],
														'productId'=>(string)$shopPrducts[$p]['productId']);
						}
						if($userfavDetails[$i]['sellerImage']!=""){
							$sellerImage=base_url().'images/users/thumb/'.$userfavDetails[$i]['sellerImage'];
						}else{
							$sellerImage=base_url().'images/users/thumb/profile_pic.png';
						}
						$favShopList[]=array('shopName'=>$userfavDetails[$i]['shop_name'],
														'ShopUrl'=>$userfavDetails[$i]['shop_url'],
														'sellerImage'=>$sellerImage,
														'sellerId'=>$userfavDetails[$i]['shopId'],
														'sellerUrl'=>$userfavDetails[$i]['sellerLink'],
														'sellerName'=>$userfavDetails[$i]['sellerFirstName']." ".$userfavDetails[$i]['sellerLastName'],
														'product'=>$shopPrductsArr,
														'productCount'=>(string)count($shopPrducts),
														'shopCount'=> (string)$userfavTotal->num_rows(),
														'pagePos'=> (string)$page);
					}
				}
				$json_encode = json_encode(array("favoriteShops" => $favShopList,"cartCount"=>(string)$this->data["cartCount"]));
			}
			echo $json_encode;
		}else{
			echo "Invalid User ";
		}
		
	}
	
	/** 
	 * 
	 * Check Favorite Status
	 */
	public function check_favorite() {		
		$id=intval($_GET['id']);
		$user_id=intval($_GET['user_id']);
		$type=$_GET['type'];		
		$favStatus=0;
		if($type=="product"){
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$id,'user_id'=>$user_id,'favorite'=>'Yes'))->num_rows();
		}else if($type=="shop"){
			$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('shop_id'=>$id,'user_id'=>$user_id,'favorite'=>'Yes'))->num_rows();
		}
		if($favStatus>0){
			$favStatus=1;
		}
		$json_encode = json_encode(array("favStatus" =>(string)$favStatus));
		echo $json_encode;		
	}
	
	/** 
	 * 
	 * Currency List
	 */
	public function currency_list() {		
		$currencyList=$this->mobile_model->get_all_details(CURRENCY,array('status' => 'Active'));
		$currencyArr=array();
		foreach($currencyList->result() as $currency){
			$currencyArr[]=array('id'=>$currency->id,
												'code'=>$currency->currency_code,
												'symbol'=>$currency->currency_symbol,
												'name'=>$currency->currency_name);
		}
		$json_encode = json_encode(array("currencyList" =>$currencyArr));
		echo $json_encode;		
	}
	
	
	/** 
	 * 
	 * Currency Setting
	 */
	public function currency_setting($user_id='') {		
		#$user_id=intval($_GET['userid']);
		$currencyId=intval($_GET['currencyId']);
		if($user_id!=''){
			$condition = array('id'=>$currencyId);	
			$result=$this->mobile_model->get_all_details(CURRENCY,$condition);
			$dataArr = array('currency'=>$result->row()->currency_code);
			$condition = array('id'=>$user_id);
			$this->mobile_model->update_details(USER,$dataArr,$condition);		
			$msg="Success";
		} else {
			$msg="Error";
		}  
		echo $msg;	
	}
	/** 
	 * 
	 * Coupon Code Check & Add
	 */
	public function couponCodeAdd(){
	
		$code =$_GET['code'];
		$amount = intval($_GET['amount']);
		$sellerId = intval($_GET['sellerId']);
		$userid = $this->data["commonId"];
		
		$amountOrg = $amount;
		

		$CoupRes = $this->mobile_model->get_all_details(COUPONCARDS,array( 'code' => $code, 'card_status' => 'not used', 'sell_id' => $sellerId,'status'=>'Active'));
		$ShopArr = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userid, 'sell_id' => $sellerId));
		
		if($CoupRes->num_rows() > 0){
				if($ShopArr->row()->couponID == 0){
					if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){
						$today = getdate();
						$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
						$currDate = date("Y-d-m", $tomorrow);
						$couponExpDate = $CoupRes->row()->dateto.' 23:59:59'; 

						$curVal = (strtotime($couponExpDate) < time());
						if($curVal != '') {
							echo 'Entered Coupon code is expired';
							exit();
						} 
						if($CoupRes->row()->price_type == 2){
							$percentage = $CoupRes->row()->price_value;
							$discount = ($percentage * 0.01) * $amount; 
							$totalAmt = number_format($amount-$discount,2,'.',''); 
									
							$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $totalAmt);
									$condition =array('user_id' => $userid, 'sell_id' => $sellerId);

									$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
									echo 'Success|'.$CoupRes->row()->id;
									exit();
								
						}elseif($CoupRes->row()->price_type == 1){
								
									$discount = $CoupRes->row()->price_value;
									if($amount > $discount){									
										$amountOrg = number_format($amount-$discount,2,'.','');
										$dataArr = array('discountAmount' => $discount, 
											'couponID' => $CoupRes->row()->id,
											'couponCode' => $code,
											'coupontype' => 'Cart',
											'is_coupon_used' => 'Yes',
											'total' => $amountOrg);
										$condition =array('user_id' => $userid);
										$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
										echo 'Success|'.$CoupRes->row()->id;
										exit();

									}else{
										echo 'Please add more items, for using this coupon code';
										exit();
									}								
						}
								
					
					
					} else {
						echo 'Entered code is Not Valid';
						exit();
					}
				}else{
					echo 'Code is already used';
					exit();
				}
		}else{
			echo 'Entered code is invalid';
			exit();
		}
	}
	
	/** 
	 * 
	 * Coupon Code Remove
	 */
	public function couponCodeRemove(){
		$sellerId = intval($_GET['sellerId']);
		
		$dataArr = array('discountAmount' => 0, 
											'couponID' => 0,
											'couponCode' => '',
											'coupontype' => '',
											'is_coupon_used' => 'No');
		$condition =array('user_id' => $this->data["commonId"],'sell_id'=>$sellerId);
		$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
		echo "Success";
	
	}
	/** 
	 * 
	 * Setting Session for payment
	 */
	public function proceedPayment(){
		if ($_POST['userId']!='' && $_POST['sellerId']!='' && $_POST['payment_value']!=''){ 
			$userId=$_POST['userId'];
			$sellerId=$_POST['sellerId'];
			$payment=$_POST['payment_value'];
			$note = $_POST['note'];	
			$payArr = array('userId'	=>	$userId,
								'sellerId'		=>	$sellerId,
								'payment'	=>	$payment,	
								'note'=> $note,
								'dateAdded'	=>	date('Y-m-d H:i:s')
							);
			$this->mobile_model->simple_insert(MOBILE_PAYMENT,$payArr);
			$mobileId = $this->db->insert_id();
			echo "Success|".$mobileId;
		}else{
			echo "Failure";
		}
	}
	/** 
	 * 
	 * Display Review List
	 */
	public function viewAllreview() {
		$productid=intval($_GET['productid']); 
		$shopId=intval($_GET['shopid']); 		
		$page=intval($_GET['pageId']);
		$perpage=10;
		
		$shopCol="`thumbnail`,`user_name`";
		$shopCheck = $this->mobile_model->get_column_details(USER,array('id'=>$shopId),$shopCol);
		
		$totalreview=0;
		$reviewArr=array();
		$reviewDetail=array();
		$sellerImage='';
		$shopName='';
		$shop_ratting='0.00';
		
		if($shopCheck->num_rows()>0){
			$sellCol="`shop_ratting`,`seller_businessname`";
			$sellerVal = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$shopId),$sellCol);
			
			$shop_ratting= $sellerVal->row()->shop_ratting; 
			$shopName= $sellerVal->row()->seller_businessname; 
		
			$this->db->select('f.rating');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(PRODUCT_FEEDBACK.' as f' , 'f.seller_product_id = p.id','inner');
			$this->db->join(USERS.' as u' , 'u.id = f.voter_id','inner');
			$this->db->join(USERS.' as s' , 's.id = f.shop_id','inner');
			$this->db->where('f.status','Active');
			#$this->db->where('f.seller_product_id',$productid);
			$this->db->where('f.shop_id',$shopId);
			$reviwestotal = $this->db->get();
			//print_r($this->db->last_query());die;
			$totalreview=$reviwestotal->num_rows();
			
			$this->db->select('u.thumbnail as thumbnail,u.full_name as fullname,u.last_name as last_name,f.dateAdded,f.description,f.rating,p.image,,p.product_name');
			$this->db->from(PRODUCT.' as p');
			$this->db->join(PRODUCT_FEEDBACK.' as f' , 'f.seller_product_id = p.id','inner');
			$this->db->join(USERS.' as u' , 'u.id = f.voter_id','inner');
			$this->db->order_by('f.id','desc');
			$this->db->where('f.status','Active');
			#$this->db->where('f.seller_product_id',$productid);
			$this->db->where('f.shop_id',$shopId);
			if($page>0){
				$this->db->limit($perpage,($page*$perpage)-$perpage);	
			}else{
				$page=1;
				$this->db->limit($perpage,0);
			}
			$reviwes = $this->db->get();
			
			
			if($reviwes->num_rows() == 0){
				$reviewCount=0;
			} else {
				$rc=0;
				if($reviwes->num_rows()>0){
					foreach($reviwes->result() as $review) {
							$img=explode(',',$review->image);
							$reviewCount=$rc+1;
							$reviewername=$review->fullname.' '.$review->last_name;
							if($review->thumbnail!=""){
								$thumbnail=base_url().'images/users/thumb/'.$review->thumbnail;
							}else{
								$thumbnail=base_url().'images/users/thumb/profile_pic.png';
							}
							$reviewArr[] = array("reviewerphoto" => (string)$thumbnail,
															"reviewername" => (string)$reviewername,
															"reviewerdate" =>date("Y-m-d",strtotime($review->dateAdded)),
															"reviewProduct" => base_url().'images/product/mb/thumb/'.$img[0],
															"reviewProductName" =>(string)$review->product_name,
															"reviewerating" =>(string)$review->rating,
															"reviewercomment" => (string)$review->description);
						
					}
				}
			}
			if($shopCheck->row()->thumbnail!=""){
				$sellerImage=base_url().'images/users/thumb/'.$shopCheck->row()->thumbnail;
			}else{
				$sellerImage=base_url().'images/users/thumb/profile_pic.png';
			}		
			$sellerName=$shopCheck->row()->user_name;
			
		}
						
		$reviewDetail[] = array("sellerImage"=>(string)$sellerImage,
													"sellerName"=>(string)$sellerName,
													"shopName"=>(string)$shopName,
													"totalreviewCount"=>(string)$totalreview,
													"shop_ratting"=>(string)floatval($shop_ratting),
													"reviwes"=>$reviewArr
													);
		
		$json_encode = json_encode(array("shopReview" => $reviewDetail,"pagePos" => (string)$page+1,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;
	}
	/** 
	 * 
	 * Display Purchases
	 */	
	public function purchases($perpage = 20) {
		$Orders = array();
		$userId=intval($_GET['userId']);
		$page=intval($_GET['pageId']);     		
		$userCol="`id`";
		$userCheck = $this->mobile_model->get_column_details(USER,array('id'=>$userId),$userCol);
		if($userCheck->num_rows()>0){

			if($page>0){
				$postnumbers=$perpage;
				$offset=($page*$perpage)-$perpage;
			}else{
				$postnumbers=$perpage;
				$offset=0;
				$page=1;
			}
			
			$type=$_GET['type'];	
			switch ($type) {
				case "canceled":
					$status="Pending";
					break;
				default:
					$status="Paid";
			}
			$orderList = $this->mobile_model->view_user_order_details($userId,$status,$postnumbers,$offset);		
	
			foreach($orderList->result() as $row) {
				if($row->sellerImage!=""){
					$sellerImage=base_url().'images/users/thumb/'.$row->sellerImage;
				}else{
					$sellerImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$img=explode(',',$row->image);
				$Orders[]=array("orderDate"=>date("M d,Y",strtotime($row->created)),
											"Name"=>$row->totalItems." items Purchased from ".$row->shopName,							
											"orderId"=>(string)$row->dealCodeNumber,
											"orderTotal" =>(string)number_format($this->data["currencyValue"]*$row->total,2),
											"orderStatus"=>$row->shipping_status,
											"sellerId"=>$row->sellerId,
											"sellerImage"=>$sellerImage,"product_name"=>$row->product_name,
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
			

			$json_encode = json_encode(array("status"=>(string)1,"Orders"=>$Orders,"totalOrders"=>(string)$orderList->num_rows(),"cartCount"=>(string)$this->data["cartCount"],"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"pagePos" => (string)$page+1));		
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"Orders"=>$Orders,"totalOrders"=>(string)0,"cartCount"=>(string)$this->data["cartCount"],"cartCount"=>(string)$this->data["cartCount"],"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"pagePos" => (string)$page+1));	
		}
		echo $json_encode;
	}
	/** 
	 * 
	 * Change User Profile Picture
	 */	
	public function thumbnailChange(){
		$userId=intval($_GET['userId']);	
		$userCol="`id`";
		$userCheck = $this->mobile_model->get_column_details(USER,array('id'=>$userId),$userCol);    
		if($userCheck->num_rows()>0){	
			$imgsav="images/users/";
			$imgArr=array();
			if($_FILES['photo']['size']>0){
				$data = file_get_contents($_FILES['photo']['tmp_name']);
				$image = imagecreatefromstring( $data );
				$imgname=md5(time().rand(10,99999999).time()).".jpg";
				$savePath=$imgsav.$imgname;
				imagejpeg($image, $savePath, 99);
				$this->ImageResizeWithCrop(600, 600, $imgname, './images/users/');
				@copy('./images/users/'.$imgname, './images/users/thumb/'.$imgname);
		    	$this->ImageResizeWithCrop(210, 210, $imgname, './images/users/thumb/');
					
				$this->mobile_model->update_details(USERS,array('thumbnail'=>$imgname),array('id'=>$userId));
				if($this->db->affected_rows()>0){
					$json_encode = json_encode(array("status"=>(string)1,
																	"message"=>"Profile Picture Updated.",
																	"image"=>base_url().'/images/users/thumb/'.$imgname,
																	"cartCount"=>(string)$this->data["cartCount"])
																	);	
				}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>"Profile Picture Not Updated.","image"=>"","cartCount"=>(string)$this->data["cartCount"]));	
				}
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid Image","image"=>"","cartCount"=>(string)$this->data["cartCount"]));		
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>"Invalid User Details","image"=>"","cartCount"=>(string)$this->data["cartCount"]));	
		}
		echo $json_encode;
	}
	public function cartCount(){
		echo $this->data["cartCount"];
	}
	public function facebook_login(){
		$email =$_POST['email'];
		$username =$_POST['username'];
		$first_name =$_POST['username'];
		$profile_image =$_POST['profile_image'];
		
		$condition = '(email = \''.addslashes($email).'\' OR user_name = \''.addslashes($email).'\') AND status=\'Active\'';
		$userInfoDetails = $this->user_model->get_all_details(USERS,$condition);		
		if($userInfoDetails->num_rows()==1){
				$userInfo = 'Success';
				if($userInfoDetails->row()->thumbnail!=""){
					$userImage=base_url().'images/users/thumb/'.$userInfoDetails->row()->thumbnail;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$userInfoDetails->row()->id),array("user_id"=>$this->data["commonId"]));
				$newdata = array(
	               'last_login_date' => date("Y-m-d h:i:s"),
	               'last_login_ip' => $this->input->ip_address()
	    	        );
				$condition = array('id' => $userInfoDetails->row()->id);
				$this->user_model->update_details(USERS,$newdata,$condition);
				/*push update*/
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
						$this->mobile_model->insertupdatePushKey($userInfoDetails->row()->id,$UDID,'user',$device_type);
					}
				/*End*/
		}else{
			if($email!='' && $username!="" && $first_name!=""){
				$passwordstr=$this->get_rand_str(8);
				
				$this->db->select('id');
				$this->db->from(USERS);
				$this->db->or_where('user_name',$username);
				$this->db->or_where('email',$email);
				$userNameDetails = $this->db->get();
				
				
				if($userNameDetails->num_rows()>0){		
					$userInfo = 'User Already Exist';
				}else{
				
					if($profile_image!=""){
						$img_data = file_get_contents($profile_image);
						$ext='jpg';
						$new_name = $this->get_rand_str(8).'-'.time().'.'.$ext;
						$new_img = 'images/users/'.$new_name;
						file_put_contents($new_img, $img_data);
						@copy('./images/users/'.$new_name, './images/users/thumb/'.$new_name);
						$this->ImageResizeWithCrop(210, 210, $new_name, './images/users/thumb/');						
						$thumbnail=$new_name;
					}else{
						$thumbnail='';
					}					
				
					$dataArr = array('loginUserType'=>'facebook',
												'full_name'=>$first_name,
												'user_name'=>$username,
												'thumbnail'=>$thumbnail,
												'last_name'=>'',
												'email'=>$email,
												'password'=>md5($passwordstr),
												'status'=>'Active',
												'is_verified'=>'No',
												'commision'=>$this->config->item('product_commission'));							
					$this->db->insert(USERS,$dataArr); 
					
					$this->db->select('*');
					$this->db->from(USERS);
					$this->db->where('email',$email);
					$checkUser = $this->db->get();								
					
					
					/*push update*/
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
						$this->mobile_model->insertupdatePushKey($checkUser->row()->id,$UDID,'user',$device_type);
					}
					/*End*/
						
					$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$checkUser->row()->id),array("user_id"=>$this->data["commonId"]));
					$userDetails=$checkUser;
					$this->send_confirm_mail($userDetails);
								
					if($checkUser->row()->thumbnail!=""){
						$userImage=base_url().'images/users/thumb/'.$checkUser->row()->thumbnail;
					}else{
						$userImage=base_url().'images/users/thumb/profile_pic.png';
					}
					/*Blog registration Starts*/
					$this->load->library('curl');
					$url = base_url().'wp_change_user_role.php'; 
					$post_data = array ( 
							"un" => $checkUser->row()->user_name, 
							"pd" => $passwordstr,
							"em" => $email
					);
					$output = $this->curl->simple_get($url, $post_data);
					/*Blog registration Ends*/
					$userInfo = 'Success';
					$userInfoDetails = $this->user_model->get_all_details(USERS,array('email'=>$email));		
				}
			}else{
				$userInfo = 'Fail';
				$userImage="";
			}
		}
		
		$json_encode = $userInfo.'|'.$userInfoDetails->row()->id.'|'.$userInfoDetails->row()->user_name.'|'.$userImage;
		echo $json_encode;
	}
	public function google_login(){
		$email =$_POST['email'];
		$username =$_POST['username'];
		$first_name =$_POST['username'];
		$profile_image =$_POST['profile_image'];
				
		$condition = '(email = \''.addslashes($email).'\' OR user_name = \''.addslashes($email).'\') AND status=\'Active\'';
		$userInfoDetails = $this->user_model->get_all_details(USERS,$condition);		
		if($userInfoDetails->num_rows()==1){
				$userInfo = 'Success';
				if($userInfoDetails->row()->thumbnail!=""){
					$userImage=base_url().'images/users/thumb/'.$userInfoDetails->row()->thumbnail;
				}else{
					$userImage=base_url().'images/users/thumb/profile_pic.png';
				}
				$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$userInfoDetails->row()->id),array("user_id"=>$this->data["commonId"]));
				$newdata = array(
	               'last_login_date' => date("Y-m-d h:i:s"),
	               'last_login_ip' => $this->input->ip_address()
	    	        );
				$condition = array('id' => $userInfoDetails->row()->id);
				$this->user_model->update_details(USERS,$newdata,$condition);
				/*push update*/
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
						$this->mobile_model->insertupdatePushKey($userInfoDetails->row()->id,$UDID,'user',$device_type);
					}
				/*End*/
		}else{
			if($email!='' && $username!="" && $first_name!=""){
				$passwordstr=$this->get_rand_str(8);
				
				$this->db->select('id');
				$this->db->from(USERS);
				$this->db->or_where('user_name',$username);
				$this->db->or_where('email',$email);
				$userNameDetails = $this->db->get();
				
				
				if($userNameDetails->num_rows()>0){		
					$userInfo = 'User Already Exist';
				}else{
				
					if($profile_image!=""){
						$img_data = file_get_contents($profile_image);
						$ext='jpg';
						$new_name = $this->get_rand_str(8).'-'.time().'.'.$ext;
						$new_img = 'images/users/'.$new_name;
						file_put_contents($new_img, $img_data);
						@copy('./images/users/'.$new_name, './images/users/thumb/'.$new_name);
						$this->ImageResizeWithCrop(210, 210, $new_name, './images/users/thumb/');						
						$thumbnail=$new_name;
					}else{
						$thumbnail='';
					}					
				
					$dataArr = array('loginUserType'=>'google',
												'full_name'=>$first_name,
												'user_name'=>$username,
												'thumbnail'=>$thumbnail,
												'last_name'=>'',
												'email'=>$email,
												'password'=>md5($passwordstr),
												'status'=>'Active',
												'is_verified'=>'No',
												'commision'=>$this->config->item('product_commission'));							
					$this->db->insert(USERS,$dataArr); 
					
					$this->db->select('*');
					$this->db->from(USERS);
					$this->db->where('email',$email);
					$checkUser = $this->db->get();								
					
					
					/*push update*/
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
						$this->mobile_model->insertupdatePushKey($checkUser->row()->id,$UDID,'user',$device_type);
					}
					/*End*/
						
					$this->user_model->update_details(USER_SHOPPING_CART,array("user_id"=>$checkUser->row()->id),array("user_id"=>$this->data["commonId"]));
					$userDetails=$checkUser;
					$this->send_confirm_mail($userDetails);
								
					if($checkUser->row()->thumbnail!=""){
						$userImage=base_url().'images/users/thumb/'.$checkUser->row()->thumbnail;
					}else{
						$userImage=base_url().'images/users/thumb/profile_pic.png';
					}
					/*Blog registration Starts*/
					$this->load->library('curl');
					$url = base_url().'wp_change_user_role.php'; 
					$post_data = array ( 
							"un" => $checkUser->row()->user_name, 
							"pd" => $passwordstr,
							"em" => $email
					);
					$output = $this->curl->simple_get($url, $post_data);
					/*Blog registration Ends*/
					$userInfo = 'Success';
					$userInfoDetails = $this->user_model->get_all_details(USERS,array('email'=>$email));		
				}
			}else{
				$userInfo = 'Fail';
				$userImage="";
			}
		}
		
		$json_encode = $userInfo.'|'.$userInfoDetails->row()->id.'|'.$userInfoDetails->row()->user_name.'|'.$userImage;
		echo $json_encode;
	}
	/** 
	 * 
	 * View Order
	 */	
	public function viewOrder() {
		$sellerId=intval($_GET['sellerId']);	
		$userId=intval($_GET['userId']);	
		$dealCodeNumber=intval($_GET['orderId']);	
		
		$userCol="`id`";
		$userCheck = $this->mobile_model->get_column_details(USERS,array('id'=>$userId),$userCol);
		$orderInfo=array();
		$itemsInfo=array();
		$paySummary=array();
		if($userCheck->num_rows()>0){
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
												"currencySymbol" =>$this->data["currencySymbol"],
												"currencyCode" =>$this->data["currencyCode"],
												"orderTotal" =>(string)number_format($this->data["currencyValue"]*$order->row()->total,2),
												"payStatus"=>$order->row()->status,
												"orderStatus"=>$order->row()->shipping_status,
												"userId"=>$order->row()->userId,
												"shopId"=>$order->row()->shopId,
												"userName"=>(string)$order->row()->user_name,		"sellerName"=>(string)$order->row()->sellerUserName,	"userImage"=>$userImage,
												"sellerImage"=>$sellerImage);
									
				$grandTotal=0;$ShipTotal=0;$SubTotal=0;
				foreach($order->result() as $orderList){				
					$prdInfo = $this->mobile_model->view_order_product($orderList->id);
					if($prdInfo->num_rows>0){				
						$img=explode(',',$prdInfo->row()->productImage);	
						$itemsInfo[]=array("Id"=>$prdInfo->row()->product_id,
														"Name"=>$prdInfo->row()->productName,
														"Attribute"=>$prdInfo->row()->attribute_values,
														"Image"=>'images/product/mb/'.$img[0],
														"Quantity"=>$prdInfo->row()->quantity,
														"currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"],
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
				
				$paySummary[]=array("currencySymbol" =>$this->data["currencySymbol"],
														"currencyCode" =>$this->data["currencyCode"],
														"subTotal"=>(string)number_format($this->data["currencyValue"]*$SubTotal,2),
														"couponDiscount"=>(string)number_format($this->data["currencyValue"]*$couponcodeDiscount,2),
														"giftDiscount"=>(string)number_format($this->data["currencyValue"]*$giftcartDiscount,2),
														"shippingCost"=>(string)number_format($this->data["currencyValue"]*$shippingCost,2),
														"tax"=>(string)number_format($this->data["currencyValue"]*$taxCost,2),
														"grandTotal"=>(string)number_format($this->data["currencyValue"]*$grandTotal,2));
				
				$json_encode = json_encode(array("status"=>(string)1,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$this->data["cartCount"]));		
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$this->data["cartCount"]));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"orderInfo"=>$orderInfo,"itemsInfo"=>$itemsInfo,"paySummary"=>$paySummary,"cartCount"=>(string)$this->data["cartCount"]));	
		}
		echo $json_encode;
	}
/* decode the generated JSON from the first 2 
$obj = json_decode($json_encode); // this is the function used to decode the generated JSON
foreach($obj->userdetails as $udetails){
    echo $udetails->name;
    echo "<br/>";
    echo $udetails->age;
    echo "<br/>";
}
foreach($obj->workdetails as $wdetails){
    echo $wdetails->company_name;
    echo "<br/>";
    echo $wdetails->age;
    echo "<br/>";
}*/

	/** 
	 * 
	 * Country List
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
		echo $json_encode;		
	}
	/** 
	 * 
	 * CMS pages for mobile
	 */
	public function cmsPages() {	
		$seourl = $_GET['page'];
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$seourl));		
		$status=0;
		$title='';
		$content='';
		if($pageDetails->num_rows()>0){
			$status=1;
			$title=$pageDetails->row()->page_title;
			$content=$pageDetails->row()->description;
		}
		$json_encode = json_encode(array("status"=>(string)$status,
																				"title"=>(string)$title,
																				"content"=>(string)$content,
																				"cartCount"=>(string)$this->data["cartCount"])
																	);	
		echo $this->cleanString($json_encode);
	}
	/** 
	 * 
	 * Load CMS pages for mobile view
	 */
	public function mobilePages() {	
		$seourl = $this->uri->segment(2);
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$seourl,'status'=>'Publish'));
		if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		$this->mobdata['pageDetails'] = $pageDetails;			
			$this->load->view('mobile/cms.php',$this->mobdata);
		}
	}
	
		public function mobilePagesjson($seourl){	
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$seourl,'status'=>'Publish'));
		if ($pageDetails->num_rows() == 0){
			
    		$returnStr['pages'] = '';

    	}else {
			$description = '';
			if ($pageDetails->num_rows()>0){
				$description = $pageDetails->row()->description;
			}
    		$this->mobdata['pageDetails'] = $pageDetails;		
			//$this->load->view('mobile/mobile_cms.php',$this->mobdata);
			$returnStr['content'] .= urlencode('<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>'.$this->config->item('email_title').'-'.$pageDetails->row()->meta_title.'</title><link rel="stylesheet" href='.base_url().'"css/default/mobile/app-style.css"'. 'type="text/css" media="all" /></head><body><section><div class="shipping_address"><div class="main"><div class="app-content-box"><h1>'.$pageDetails->row()->page_title.'</h1><div class="payment-success">'.$description.'</div></div></div></div></section></body></html>');
			
		}
		//$returnst['str'] = ht$returnStr['pages'];
		
	return json_encode($returnStr['content']); 
	}
/*	public function push_notification(){
		$deviceId = "6b1763dfa8393319c851800288f1cd1251793ecd8053012a0818d44c802a1961";
		$message = "test message for shopsy succeeded";
		$this->load->library('apns');
		$this->apns->send_push_message($deviceId,$message);
	}*/
	
	/***
	*
	*  Conversation  
	*
	**/
	
	public function display_converstion(){
		$perpage=25;
		$page=intval($_GET['pageId']);     
		$user_id=intval($_GET['userId']);
		$type=$_GET['type'];
		$userCol="`id`";
		$userCheck = $this->mobile_model->get_column_details(USERS,array('id'=>$user_id),$userCol);
		$msgArr=array();
		if($userCheck->num_rows()>0){		
			if($page>= 1){
				$paginationVal = ($page * $perpage)-$perpage;			
			} else {
				$paginationVal = 0;
				$page=1;
			} 
			$conversation_type = '';
			if($type != '0' && $type  == 'U'){
			$conversation_type = 'U';
			}else if($type != '0' && $type  == 'S'){
			$conversation_type = 'S';
			}
			
			
			$conversation_total = $this->mobile_model->get_total_conversation_List($user_id,$conversation_type);  	
			$totalConversation=$conversation_total->num_rows();
			$conversations = $this->mobile_model->get_conversation_details_List($user_id,$perpage,$paginationVal,$conversation_type);  
			
			if($conversations->num_rows()>0){
				foreach($conversations->result() as $message){				
					
					if($message->sender_id == $user_id){
						$status=$message->sender_status;
						$starred=$message->sender_starred;
						if($message->thumbnail!=""){
							$senderImage=base_url().'images/users/thumb/'.$message->thumbnail;
						}else{
							$senderImage=base_url().'images/users/thumb/profile_pic.png';
						}
						$sender_name=$message->user_name;
					} else {
						$status=$message->receiver_status;
						$starred=$message->receiver_starred;
						if($message->senderthumbnail!=""){
							$senderImage=base_url().'images/users/thumb/'.$message->senderthumbnail;
						}else{
							$senderImage=base_url().'images/users/thumb/profile_pic.png';
						}
						$sender_name=$message->sender_name;
					}
						
		$newMsg = $this->mobile_model->get_conversation_unread_count($user_id,$message->tid)->result();
						
					$msgArr[]=array('conv_id'=>$message->tid,
												'sender_name'=>$sender_name,
												'sender_image'=>$senderImage,
												'status'=>$status,
												'starred'=>$starred,
												'message'=>trim(strip_tags($message->message)),
												'time'=>$this->get_relative_date(strtotime($message->dataAdded)),
												'newMsg'=>$newMsg[0]->unreadcount,
												);
				}
			}
		}
		$json_encode = json_encode(array("conversation" =>$msgArr,"totalConversation"=>(string)$totalConversation,"pagePos"=> (string)$page+1,"cartCount"=>(string)$this->data["cartCount"]));
		echo $json_encode;	
	}
	
	public function view_converstion(){
		$user_id=intval($this->input->get('userId'));
		$tid=intval($this->input->get('cID'));
		
		$MessageDetail = $this->mobile_model->get_message_details($tid,$user_id); 
		$msgCount=$MessageDetail->num_rows();
		$usersDetails = array();  $conv_info = array(); $messages = array(); $i=0;
		if($msgCount>0){
			foreach($MessageDetail->result() as $message){
				if(($message->sender_id== $user_id && ($message->sender_status == 'Read' || $message->sender_status == 'Unread')) || ($message->receiver_id== $user_id && ($message->receiver_status == 'Read' || $message->receiver_status == 'Unread'))){
				
					if($message->sender_id == $user_id){
						$own_name=$message->sender_name;
						$own_id=$message->sender_id;
						$own_email=$message->sender_email;
						$own_starred=$message->sender_starred;
						if($message->senderthumbnail!=""){
							$own_thumb=base_url().'images/users/thumb/'.$message->senderthumbnail;
						}else{
							$own_thumb=base_url().'images/users/thumb/profile_pic.png';
						}
						
						$messager_id=$message->receiver_id;
						$messager_name=$message->receiver_name;
						$messager_email=$message->receiver_email;
						$messager_starred=$message->receiver_starred;
						if($message->thumbnail!=""){
							$messager_thumb=base_url().'images/users/thumb/'.$message->thumbnail;
						}else{
							$messager_thumb=base_url().'images/users/thumb/profile_pic.png';
						}
						
					} else {
					
						$own_name=$message->receiver_name;
						$own_id=$message->receiver_id;
						$own_email=$message->receiver_email;
						$own_starred=$message->receiver_starred;
						if($message->thumbnail!=""){
							$own_thumb=base_url().'images/users/thumb/'.$message->thumbnail;
						}else{
							$own_thumb=base_url().'images/users/thumb/profile_pic.png';
						}
						
						$messager_id=$message->sender_id;
						$messager_name=$message->sender_name;
						$messager_email=$message->sender_email;
						$messager_starred=$message->sender_starred;
						if($message->senderthumbnail!=""){
							$messager_thumb=base_url().'images/users/thumb/'.$message->senderthumbnail;
						}else{
							$messager_thumb=base_url().'images/users/thumb/profile_pic.png';
						}
						
					}
					
					if($i == 0){
						$conv_info[]=array('conv_id'=>$message->tid,
															'msgCount' => $msgCount,
															'user_id' => $own_id,
															'messager_id' => $messager_id,
															'starred' => $own_starred,													
															'time' => $this->get_relative_by_date($message->dataAdded),
						);
						
						$user_info=array('name' => $own_name,
															'email' => $own_email,
															'image' => $own_thumb);
															
						$messager_info=array('messager_name' => $messager_name,
																		'messager_email' => $messager_email,
																		'messager_image' => $messager_thumb);
																		
																		
						$convDetails=array('conv_info' => $conv_info);
					}

					 $msgType='';
					 if($message->sender_id == $user_id){
							$msgType='1';
					 } else {
						$msgType='0';
					 }
					 
					 $messages[]=array('msg_id' => $message->id,
															'msg_type' => $msgType,
															'subject' => $message->subject,
															'message' => trim(strip_tags($message->message)),	
															'sender_name' => $message->sender_name,
															//'sender_email' => $message->sender_email,
															'time' =>$this->get_relative_by_date($message->dataAdded)		 
					 );
					
					if($message->sender_id==$user_id){
						$newdata=array('sender_status'=>'Read');
						$condition = array('id' => $message->id,'sender_status !='=>'Trash');
					}else if($message->receiver_id==$user_id){
						$newdata=array('receiver_status'=>'Read');
						$condition = array('id' => $message->id,'receiver_status !='=>'Trash');
					}
					
					$this->mobile_model->update_details(CONTACTPEOPLE,$newdata,$condition);
					$i++;
				}
			}
		}
		$messageArr[]=array('conv_info' => $conv_info,'messages' => $messages,"cartCount"=>(string)$this->data["cartCount"]);	
		$json_encode = json_encode(array("view_conversation" =>$messageArr));
		echo $json_encode;
	}
	
	public function delete_message(){
		$user_id=intval($this->input->get('userId'));
		$msgIds=$this->input->get('msgId');
		$msgId=@explode(',',$msgIds);
		
		foreach($msgId as $row){
			if($row!="" && $row>0){
				$id=$row;
				$condition=array('id' =>$id);
				$vals=$this->mobile_model->get_all_details(CONTACTPEOPLE,$condition);
				if($vals->row()->receiver_id==$user_id){
					$newdata=array(receiver_status=>'Trash');			
				}else if($vals->row()->sender_id==$user_id){
					$newdata=array(sender_status=>'Trash');
				}
				$condition = array('id' => $vals->row()->id);
				$this->mobile_model->update_details(CONTACTPEOPLE,$newdata,$condition);
			}
		}
		$message='Success';
		$status=1;
		$json_encode = json_encode(array("status" =>(string)$status,"message" =>$message));
		echo $json_encode;
	}
	public function delete_conversation(){
		$MsgId=$this->input->get('convId'); // with (,) separator
		$UsrId=$this->input->get('userId');		
		
		$actionTake='Trash';	#$this->input->get('action'); //Trash
		$chkMsgArr=@explode(',',$MsgId);   
		$chgId='';
		
		foreach($chkMsgArr as $MsgId){
			if($MsgId!="" && $MsgId>0){
				$msgDetail = $this->mobile_model->get_all_details(CONTACTPEOPLE,array('tid'=>$MsgId));
				foreach($msgDetail->result() as $msg){
					$chk=0;				
					if($msg->sender_id==$UsrId && $msg->receiver_id==$UsrId){
						$newdata=array("sender_status"=>$actionTake,"receiver_status"=>$actionTake);
					}else if($msg->sender_id==$UsrId){
						$colstatus='sender_status';
						$newdata=array($colstatus=>$actionTake);
					}else if($msg->receiver_id==$UsrId){
						$colstatus='receiver_status';
						$newdata=array($colstatus=>$actionTake);
					}				
					$condition = array('id' => $msg->id);		
					if($this->mobile_model->update_details(CONTACTPEOPLE,$newdata,$condition)){
						 $chk=1;
					}
				}
			}
			$chgId=$chgId.$MsgId.','; 
		}	
		$message='Success';
		$status=1;
		$json_encode = json_encode(array("status" =>(string)$status,"message" =>$message));
		echo $json_encode;
	}
	public function send_message(){
		$subject='';$msg='';$msgId='';
		
		$sender_id=$this->input->post('userId');	
		$receiver_id=$this->input->post('receiverId');	
		$tid=intval($this->input->post('convId')); 
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');		
		
		$selectCol="`id`,`email`,`user_name`";
		$senderVal = $this->mobile_model->get_column_details(USERS,array('id'=>$sender_id),$selectCol);
		$receiverVal = $this->mobile_model->get_column_details(USERS,array('id'=>$receiver_id),$selectCol);
		if($senderVal->num_rows()>0 && $receiverVal->num_rows()>0){		
			$sender_id=$senderVal->row()->id;
			$sender_email=$senderVal->row()->email;
			$sender_name=$senderVal->row()->user_name;
			$receiver_id=$receiverVal->row()->id;
			$receiver_email=$receiverVal->row()->email;
			$receiver_name=$receiverVal->row()->user_name;
			
			if($senderVal->row()->thumbnail!=""){
				$senderImage=base_url().'images/users/thumb/'.$senderVal->row()->thumbnail;
			}else{
				$senderImage=base_url().'images/users/thumb/profile_pic.png';
			}
			
			if($subject!="" && $message!=""){
			

			if($tid == '' || $tid =='0'){
				$tid = time();
			}
			
			$datestring = "%Y-%m-%d %H:%i:%s";
			$time = time(); 
			$createdTime = mdate($datestring,$time);
				$msgTime=date('Y-m-d H:i:s');
				$dataArr = array('sender_email'=>$sender_email,
											'sender_id'=>$sender_id,
											'receiver_email'=>$receiver_email,
											'receiver_id'=>$receiver_id,
											'subject'=>$subject,
											'message'=>$message,
											'dataAdded'=>$createdTime,
											'tid'=>$tid);
				$this->mobile_model->simple_insert(CONTACTPEOPLE,$dataArr);
				$subject=trim(strip_tags($subject));
				$msg=trim(strip_tags($message));
				$mTime=$this->get_relative_by_date($createdTime);
				$msgId=$this->db->insert_id();
				
				$actArr = array('activity'=>"message",
										'activity_id'=>$receiver_id,
										'user_id'	=>$sender_id,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>$createdTime,
										'comment_id'=>$tid);
				$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
				$pmessage=$message;
				/*Push Message Starts*/
				$message='You received a message from '.$sender_name.' on '.$this->config->item('email_title');
				$type='message';
				$this->sendPushNotification($receiver_id,$message,$type,array($tid,$sender_id,$senderImage,$sender_name,$pmessage,$subject,$msgId));
				/*Push Message Ends*/
			
				$status=1;
				$message="Sent Successfully";
			}else{			
				$status=0;
				$message="Values are missing";
			}
		}else{
			$status=0;
			$message="Sending Failed";
		}
		$json_encode = json_encode(array("status" =>(string)$status,"message" =>$message,"subject" =>(string)$subject,"msg" =>(string)$msg,"msgId" =>(string)$msgId,"msgTime" =>(string)$mTime));
		echo $json_encode;
	}
	public function make_contact(){
		$sender_id=intval($this->input->post('userId'));	
		$receiver_id=intval($this->input->post('receiverId'));	
		$subject=$this->input->post('subject');
		$message=$this->input->post('message');
		$type=$this->input->post('type');
		
		$selectCol="`id`,`user_name`,`email`,`thumbnail`";
		$senderVal = $this->mobile_model->get_column_details(USERS,array('id'=>$sender_id),$selectCol);
		$receiverVal = $this->mobile_model->get_column_details(USERS,array('id'=>$receiver_id),$selectCol);
		if($senderVal->num_rows()>0 && $receiverVal->num_rows()>0){		
			$sender_id=$senderVal->row()->id;
			$sender_email=$senderVal->row()->email;
			$sender_name=$senderVal->row()->user_name;
			$receiver_id=$receiverVal->row()->id;
			$receiver_email=$receiverVal->row()->email;
			$receiver_name=$receiverVal->row()->user_name;
			$tid=time().rand(0,99999);
			
			if($senderVal->row()->thumbnail!=""){
				$senderImage=base_url().'images/users/thumb/'.$senderVal->row()->thumbnail;
			}else{
				$senderImage=base_url().'images/users/thumb/profile_pic.png';
			}
			
			if($subject!="" && $message!=""){
				$activity="";
				if($type=='question' || $type=='cartcontact'){
					$activity='question';
					$dataArr = array('username'=>$sender_name,
												'useremail'=>$sender_email,
												'user_id'=>$sender_id,
												'selleremail'=>$receiver_email,
												'sellerid'=>$receiver_id,
												'product_id'=>$this->input->post('productid'),
												'product_name'=>$this->input->post('productname'),
												'description'=>$message);
					$this->mobile_model->simple_insert(CONTACTSELLER,$dataArr);
				}
				
				if($type=='ordercontact' || $type=='shopcontact'){
					$activity='message';
					$dealcode_number=intval($this->input->post('orderId'));
					$dataArr = array('username'=>$sender_name,
												'useremail'=>$sender_email,
												'user_id'=>$sender_id,
												'selleremail'=>$receiver_email,
												'sellerid'=>$receiver_id,
												'dealcode_number'=>$dealcode_number,
												'description'=>$message);
					$this->mobile_model->simple_insert(CONTACTSHOPSELLER,$dataArr);
					
					/*Mail Function Starts Here*/
						$userid = $sender_id;
						$dealcode_number = $this->input->post('orderId');
						$userrname = $sender_name;
						$description = $message;
						$email = $this->input->post('selleremail');						
						$newsid='17';
						$template_values=$this->user_model->get_newsletter_template_details($newsid);						
						if($dealcode_number!=0){
							$dealcode_number = '<p><strong>Order Id :</strong>'.$dealcode_number.'</p>';
							$ClickDetails = 'Click <a href="'.base_url().'view-order/'.$userid.'/'.$dealcode_number.'">here</a>&nbsp;to see order details';
						}						
						$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
						$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
						extract($adminnewstemplateArr);
						$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
						$messageMail = '';
						$messageMail .= '<!DOCTYPE HTML>
												<html>
													<head>
														<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
														<meta name="viewport" content="width=device-width"/>
													</head>
													<body>';
						include('./newsletter/registeration'.$newsid.'.php');							
						$messageMail .= '</body>
												</html>';						
						if($template_values['sender_name']=='' && $template_values['sender_email']==''){
							$sender_email=$this->data['siteContactMail'];
							$sender_name=$this->data['siteTitle'];
						}else{
							$sender_name=$template_values['sender_name'];
							$sender_email=$template_values['sender_email'];
						}
						$email_values = array('mail_type'=>'html',
											'from_mail_id'=>$sender_email,
											'mail_name'=>$sender_name,
											'to_mail_id'=>$receiver_email,
											'subject_message'=>$template_values['news_subject'],
											'body_messages'=>$messageMail
											);
						$email_send_to_common = $this->user_model->common_email_send($email_values);
					/*Mail Function Ends Here*/
				}
				
				$dataArr = array('sender_email'=>$sender_email,
											'sender_id'=>$sender_id,
											'receiver_email'=>$receiver_email,
											'receiver_id'=>$receiver_id,
											'subject'=>$subject,
											'message'=>$message,
											'dataAdded'=>date('Y-m-d H:i:s'),
											'tid'=>$tid);
				$this->mobile_model->simple_insert(CONTACTPEOPLE,$dataArr);
				$msgId=$this->db->insert_id();
				
				$pmessage=$message;
				/*Push Message Starts*/
				$message='You received a message from '.$sender_name.' on '.$this->config->item('email_title');
				$type='contact';
				$this->sendPushNotification($receiver_id,$message,$type,array($tid,$sender_id,$senderImage,$sender_name,$pmessage,$subject,$msgId));
				/*Push Message Ends*/
								
				$actArr = array('activity'=>$activity,
										'activity_id'=>$receiver_id,
										'user_id'	=>$sender_id,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>date("Y-m-d H:i:s"),
										'comment_id'=>$tid);
				if($activity!=""){
					$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);
				}
			
				$status=1;
				$message="Sent Successfully";
			}else{			
				$status=0;
				$message="Subject and Message should be required";
			}
		}else{
			$status=0;
			$message="Sending Failed";
		}
		$json_encode = json_encode(array("status" =>(string)$status,"message" =>$message));
		echo $json_encode;
	}
	
	public function view_feedback(){
		$userId=intval($_GET['userId']);	
		$orderId=intval($_GET['orderId']);	
		$productId=intval($_GET['productId']);	
		$feedbackVal = $this->mobile_model->get_all_details(PRODUCT_FEEDBACK,array('voter_id' => $userId,'seller_product_id'=>$productId,'deal_code'=>$orderId));
		if($feedbackVal->num_rows()>0){
			$feedbackArr=array('description'=>$feedbackVal->row()->description,'rating'=>$feedbackVal->row()->rating);
			$status=1;
		}else{
			$feedbackArr=array();
			$status=0;
		}
		$json_encode = json_encode(array("status" =>(string)$status,'feedback'=>$feedbackArr));
		echo $json_encode;
	}
	
	
	public function left_feedback(){
		$voter_id = $this->input->post('userId');
		$shop_id = $this->input->post('shopId');
		$seller_product_id = $this->input->post('productId');
		$deal_code = $this->input->post('orderId');
		$description = $this->input->post('description');
		$rating = $this->input->post('rating');
		
		$selectCol="`id`,`user_name`,`email`";		
		$voterVal = $this->mobile_model->get_column_details(USERS,array('id'=>$voter_id),$selectCol);
		$sellerVal = $this->mobile_model->get_column_details(USERS,array('id'=>$shop_id),$selectCol);
		
		$selectCols="`id`";	
		$feedbackVal = $this->mobile_model->get_column_details(PRODUCT_FEEDBACK,array('voter_id' => $voter_id,'shop_id' => $shop_id,'seller_product_id'=>$seller_product_id,'deal_code'=>$deal_code),$selectCols);
		if($voterVal->num_rows()>0 && $sellerVal->num_rows()>0){
		
			$dataArray=array('voter_id' => $voter_id,
							'shop_id' => $shop_id,
							'seller_product_id'=>$seller_product_id,
							'deal_code'=>$deal_code, 
							'description' => $description, 
							'rating' => $rating);
							
			if($description!="" && $rating!=""){
				if($feedbackVal->num_rows()==0){
					$this->mobile_model->simple_insert(PRODUCT_FEEDBACK,$dataArray);
					$lastIid=$this->db->insert_id(); 
					$activity="review";
					
					$voterName=$voterVal->row()->user_name;
					/*Push Message Starts*/
					$message=$voterName.' has rated you item on '.$this->config->item('email_title');
					$type='review';
					$this->sendPushNotification($shop_id,$message,$type,array($lastIid,$voter_id));
					/*Push Message Ends*/	
					
				}else if($feedbackVal->num_rows()>0){
					$dataArr = array('description'=>$description,'rating' => $rating);
					$condition = array('id'=>$this->input->post("mode"));
					$this->mobile_model->update_details(PRODUCT_FEEDBACK,$dataArr,$condition);
					$lastIid=$this->input->post("mode");
					$activity="review-update";
				}
				
				$actArr = array('activity'=>$activity,
										'activity_id'=>$shop_id,
										'user_id'	=>$voter_id,
										'activity_ip'=>$this->input->ip_address(),
										'created'=>date("Y-m-d H:i:s"),
										'comment_id'=>$lastIid);
				$this->mobile_model->simple_insert(NOTIFICATIONS,$actArr);		
		
				$query="SELECT AVG(rating) as shop_ratting,COUNT(*) as review_count  FROM ".PRODUCT_FEEDBACK." WHERE status='Active' and shop_id=".$shop_id; 
				$shop_ratting=$this->mobile_model->ExecuteQuery($query)->row();
				$ratting=round($shop_ratting->shop_ratting,2);
				$review_count=$shop_ratting->review_count;
				$condition = array('seller_id'=>$shop_id);
				$dataArr = array('shop_ratting'=>$ratting,'review_count'=>$review_count);
				$this->mobile_model->update_details(SELLER,$dataArr,$condition);	
				$status=1;
				$message="Posted Successfully";
			}else{
				$status=0;
				$message="Rattings and Description should be required";
			}
		}else{
			$status=0;
			$message="Authentication Failed";
		}
		$json_encode = json_encode(array("status" =>(string)$status,"message" =>$message));
		echo $json_encode;
	}
	
	
	public function banner_details(){
		$condition = array('id !=' => '','status' => 'Publish');
		$bannerDetails = $this->mobile_model->get_all_details(LANDING_BANNER,$condition);
		if($bannerDetails->num_rows()>0){
			$bannerArr[] = array( 'id' => $bannerDetails->row()->id,
												'name' => $bannerDetails->row()->name,
												'banner_option' => $bannerDetails->row()->banner_option,
												'banner_text' => (string)$bannerDetails->row()->banner_text,
												'image' => BANNERPATH.$bannerDetails->row()->image,
											
									);
				$json_encode=json_encode(array('bannerArr' => $bannerArr));
				echo stripslashes($json_encode);
		
		}
	}
	
	public function shop_sales(){
		$sellerId=intval($_GET['sellerId']);	
		$page=intval($_GET['pageId']);
		$perpage=20;
		$this->db->select('id');
		$this->db->from(PRODUCT);
		$this->db->where("user_id",$sellerId);
		$this->db->where("purchasedCount >",0);
		$totalValues = $this->db->get(); 
		
		$this->db->select('id,product_name,seourl,price,image,user_id,base_price');
		$this->db->from(PRODUCT);
		$this->db->where("user_id",$sellerId);
		$this->db->where("purchasedCount >",0);
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
		$salesDetail = $this->db->get(); 
		
		
		$itemCount=$totalValues->num_rows();
		if($salesDetail->num_rows()>0){
			foreach($salesDetail->result() as $row){
				$img=explode(',',$row->image);			
				$price= number_format($this->data["currencyValue"]*$row->base_price,2);
				
				$favStatus = $this->mobile_model->get_all_details(FAVORITE,array('p_id'=>$row->id,'user_id'=>$this->data["commonId"]))->num_rows();
				if($favStatus>0){$favStatus=1;}else{$favStatus=0;}
				
				
				$ProdArr[] = array("productId" => $row->id,
												"productName" => character_limiter($row->product_name,15),
												"Image" => base_url().'images/product/mb/thumb/'.$img[0],
												"Price" =>$price,
												"favStatus" =>(string)$favStatus
											);
										
			}
			$status=1;
		}else{
			$status=0;
			$ProdArr=array();
		}
		$json_encode=json_encode(array("status" => $status,'productArr' => $ProdArr,"itemCount" => (string)$itemCount,"pagePos" => (string)$page+1,"currencySymbol" =>$this->data["currencySymbol"],"currencyCode" =>$this->data["currencyCode"],"cartCount"=>(string)$this->data["cartCount"]));		
		echo $json_encode;
	}
	
	public function favouritedMyshop(){
		$sellerId=intval($_GET['sellerId']);	
		$page=intval($_GET['pageId']);
		$perpage=20;
		
		$this->db->select('id');
		$this->db->from(FAVORITE);
		$this->db->where("shop_id",$sellerId);
		$totalValues = $this->db->get(); 
		
		$this->db->select('user_id');
		$this->db->from(FAVORITE);
		$this->db->where("shop_id",$sellerId);
		if($page>0){
			$this->db->limit($perpage,($page*$perpage)-$perpage);	
		}else{
			$page=1;
			$this->db->limit($perpage,0);
		}
		$favUserDetails = $this->db->get(); 
		
		
		$admirerCount=$totalValues->num_rows();
		
		
		if($favUserDetails->num_rows()>0){
			foreach($favUserDetails->result() as $row){
				if($row->user_id !=0){
					$this->db->select('id,user_name,followers_count,followers,thumbnail');
					$this->db->from(USER);
					$this->db->where('id',$row->user_id);
					$this->db->where('status','Active');
					$admired=$this->db->get(); 
				
				$followersChk=explode(',',$admired->row()->followers);
				if(in_array($sellerId, $followersChk)==TRUE){
					$follow='Yes';
				}else{
					$follow='No';
				}
				if($admired->row()->thumbnail!=""){
					$userImage='images/users/thumb/'.$admired->row()->thumbnail;
				}else{
					$userImage='images/users/thumb/profile_pic.png';
				}
				$admiredArr[]=array(	"user_id"=>$admired->row()->id,
													"full_name"=>$admired->row()->user_name,
													"followers_count"=>$admired->row()->followers_count,
													"image"=>$userImage,
													"follows"=>$follow
												);
				}
			}
			$status=1;
		}else{
			$status=0;
			$admiredArr=array();
		}
		$json_encode = json_encode(array("status" => (string)$status,"admiredArr" =>$admiredArr,"admirerCount" => (string)$admirerCount,"pagePos" => (string)$page+1));
		echo $json_encode;
	}
	
	public function reviewofShop(){
		$sellerId=intval($_GET['sellerId']);	
		$page=intval($_GET['pageId']);
		$perpage=20;
		if($page>0){
			$pageVal=($page*$perpage)-$perpage;	
		}else{
			$page=1;
			$pageVal=0;
		}
		
		$sellerCol="`id`,`seller_id`,`shop_ratting`,`review_count`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$Reviews=array();
		$totalreviewList = $this->mobile_model->get_shop_review_details($sellerId);	
		$totalReview=$totalreviewList->num_rows();
		if($sellerCheck->num_rows()>0){
			$reviewList = $this->mobile_model->get_shop_review_details($sellerId,$perpage,$pageVal);	
			foreach($reviewList->result() as $row) {
				if($row->thumbnail!=""){
					$userImage='images/users/thumb/'.$row->thumbnail;
				}else{
					$userImage='images/users/thumb/profile_pic.png';
				}
				$imgArr=@explode(',',$row->image);				
				$productImage = ($imgArr[0]=='') ? '' : base_url().'images/product/mb/thumb/'.$imgArr[0];
				
				$Reviews[]=array("reviewDate"=>date("M d,Y",strtotime($row->dateAdded)),
											"voteId"=>(string)$row->id,
											"voterId"=>(string)$row->userId,
											"voterName"=>(string)$row->userName,
											"voterImage"=>$userImage,
											"productId"=>(string)$row->productId,
											"productImage"=>(string)$productImage,
											"productName"=>(string)$row->product_name,
											"starRating"=>(string)$row->rating,
											"description"=>(string)$row->description
											);
			}		
			$status=1;
			$overallRating=$sellerCheck->row()->review_count;
			$overallStar=$sellerCheck->row()->shop_ratting;	
		}else{
			$status=0;
			$overallRating=0;
			$overallStar=0;
		}
		$json_encode = json_encode(array("status"=>(string)$status,
																		"overallRating"=>(string)$overallRating,
																		"overallStar"=>(string)$overallStar,
																		"ReviewsList"=>$Reviews,
																		"totalReview"=>(string)$totalReview,
																		"pagePos" => (string)$page+1,));		
		echo $json_encode;
	}
	
	 //function to get shop policies
	public function shop_policies(){
		$sellerId=intval($_GET['sellerId']);
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId,'status'=>'active'),$sellerCol);
		if($sellerCheck->num_rows()>0){	
			$sellCol="`seller_id`,`seller_businessname`,`welcome_message`,payment_policy`,`shipping_policy`,`refund_policy`";
			
			$shopPolicies=$this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellCol);
			if($shopPolicies->num_rows() > 0){
					$dataArr=array(		'seller_id'							=>	$shopPolicies->row()->seller_id,
													'shop_name'						=>	strip_tags(stripslashes(trim($shopPolicies->row()->seller_businessname))),
													'welcome_message'			=>	strip_tags(stripslashes(trim($shopPolicies->row()->welcome_message))),
													'payment_policy'				=>	strip_tags(stripslashes(trim($shopPolicies->row()->payment_policy))),
													'shipping_policy'					=>	strip_tags(stripslashes(trim($shopPolicies->row()->shipping_policy))),
													'refund_policy'					=>	strip_tags(stripslashes(trim($shopPolicies->row()->refund_policy)))
												);
					$json_encode=json_encode(array("status"=>(string)1,"Policies"=>$dataArr));							
		}else{
					$json_encode = json_encode(array("status"=>(string)0,"message"=>'No Policies'));
		}
	}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));	
		}
		echo $json_encode;	
	}
	
	//function to get about shop
	public function about_shop(){
		$sellerId=intval($_GET['sellerId']);
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId,'status'=>'active'),$sellerCol);
		if($sellerCheck->num_rows()>0){
			$sellCol="`seller_id`,`seller_businessname`,`gift_card`,`seller_information`";
			$aboutShop=$this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellCol);
			if($aboutShop->num_rows() > 0){
				$dataArr=array('seller_id'						=>	$aboutShop->row()->seller_id,
											'shop_name'				=>	strip_tags(stripslashes(trim($aboutShop->row()->seller_businessname))),
											'gift_card_status'	=>	strip_tags(stripslashes($aboutShop->row()->gift_card)),
											'seller_information'		=>	strip_tags(stripslashes(trim($aboutShop->row()->seller_information)))
										);	
				$json_encode=json_encode(array("status"=>(string)1,"About"=>$dataArr));							
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>'shop don\'t have update'));
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));
		}
		echo $json_encode;	
	}
	
	//function to get shop announcement
	
public function shop_announcement(){
		$sellerId=intval($_GET['sellerId']);
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId,'status'=>'active'),$sellerCol);
		if($sellerCheck->num_rows()>0){
			$sellCol="`seller_id`,`seller_businessname`,`shop_announcement`";
			$shopAnnc=$this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellCol);
			if($shopAnnc->num_rows() > 0){
				$dataArr=array('seller_id'						=>	$shopAnnc->row()->seller_id,
											'shop_name'				=>	strip_tags(stripslashes(trim($shopAnnc->row()->seller_businessname))),
											'shop_announcement'	=>	strip_tags(stripslashes(trim($shopAnnc->row()->shop_announcement)))
										);	
				$json_encode=json_encode(array("status"=>(string)1,"Announcement"=>$dataArr));							
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"message"=>'shop don\'t have update'));
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"message"=>'Invalid Request'));
		}
		echo $json_encode;	
	}
	
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
	
	public function mbimg(){
		$orgPath ='images/product/org-image/';
		if ($handle = opendir($orgPath)) {
			while (false !== ($fileName = readdir($handle))) {
				echo '<br>'.$fileName; 
				if(strlen($fileName) > 3 && $fileName!='Thumbs.db' && $fileName!='thumb') {
					$newFiles = explode('.',$fileName);					
					
					$target_file=$orgPath.$fileName;
					$option=$this->getImageShape(550,350,$target_file);
					$this->load->library('resizeimage');
					$resizeObj = new Resizeimage($target_file);
					$resizeObj -> resizeImage(550, 350, $option);
					$resizeObj -> saveImage('images/product/mb/'.$fileName, 100);
					$resizeObj -> resizeImage(350, 350, $option);
					$resizeObj -> saveImage('images/product/mb/thumb/'.$fileName, 100);
					$this->ImageCompress('images/product/mb/'.$fileName,'',70);
					$this->ImageCompress('images/product/mb/thumb/'.$fileName,'',70);
					
					/* @copy($orgPath.$fileName, './images/product/mb/'.$fileName);
					$this->imageResizeWithSpace(500, 311, $fileName, './images/product/mb/');
					@copy($orgPath.$fileName, './images/product/mb/thumb/'.$fileName);
					$this->imageResizeWithSpace(450, 450, $fileName, './images/product/mb/thumb/'); */
					
				}
			}
			closedir($handle);
		}
	}
	/** 
	 * 
	 * Get Time ago
	 */	
	 
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
	
	 public function get_relative_date($forward_date_time=''){
	//$time = strtotime($forward_date);
	$dispaly_date = date("M d",$forward_date_time);
	$dispaly_date_year = date("M d,Y",$forward_date_time);
	$dispaly_date_time = date("g:i a", $forward_date_time);
	$dispaly_date_only = date("d",$forward_date_time);
	$current_date_only = date("d");
	$datestring = "%Y-%m-%d %H:%i:%s";
	$forward_date = mdate($datestring,$forward_date_time);
	$d1 =  new DateTime($forward_date, new DateTimeZone('Asia/Kolkata'));
	$datestring = "%Y-%m-%d %H:%i:%s";
	$time = time(); 
	$createdTime = mdate($datestring,$time);
	$d2=  new DateTime($createdTime, new DateTimeZone('Asia/Kolkata'));
	$diff=$d2->diff($d1);
	$returndate = '';
	if($diff->y == 0 ){
		if($diff->d ==0 && $dispaly_date_only == $current_date_only){
			$returndate =  $dispaly_date_time;
		}else{
			$returndate = $dispaly_date;
		}
	}else{
		$returndate =  $dispaly_date_year;
	}
	return $returndate;
	}
	
	

	
	function relative_time($datetime){
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
	
	
	public function checkCode($Code = '',$amount = '',$shipamount = '', $sellerId = '', $userid = ''){
		
	$Code = $this->input->post('code');
	$amount = $this->input->post('amount'); 
	$amountOrg = $amount;
	$ship_amount = $this->input->post('shipamount'); 
	$userId=$this->input->post('userId');
	$sellerId=$this->input->post('sellerId');
	
	$CoupRes = $this->mobile_model->get_all_details(COUPONCARDS,array( 'code' => $Code, 'card_status' => 'not used', 'sell_id' => $sellerId,'status'=>'Active'));
	$ShopArr = $this->mobile_model->get_all_details(USER_SHOPPING_CART,array( 'user_id' => $userId, 'sell_id' => $sellerId));
	$excludeArr = array('code','amount','shipamount');
	$returnStr['status_code'] = '0';
	$returnStr['coupon_id'] = '';
	if($CoupRes->num_rows() > 0){
		//$PayVal = $this->cart_model->get_all_details(PAYMENT,array( 'user_id' => $userid, 'coupon_id' => $CoupRes->row()->id));
		//if($PayVal->num_rows() == 0){
		if($ShopArr->row()->couponID == 0){
			if($CoupRes->row()->quantity > $CoupRes->row()->purchase_count){

				$today = getdate();
				$tomorrow = mktime(0,0,0,date("m"),date("d"),date("Y"));
				$currDate = date("Y-d-m", $tomorrow);
				$couponExpDate = $CoupRes->row()->dateto.' 23:59:59'; 
				$curVal = (strtotime($couponExpDate) < time());
				if($curVal != '') {
					$returnStr['msg'] = 'Entered Coupon code is expired';
					echo json_encode($returnStr);die;
				} 
				if($CoupRes->row()->price_type == 2){
					$percentage = $CoupRes->row()->price_value;
					$discount = ($percentage * 0.01) * $amount; 
					$totalAmt = number_format($amount-$discount,2,'.',''); 
					$dataArr = array('discountAmount' => $discount, 
									'couponID' => $CoupRes->row()->id,
									'couponCode' => $Code,
									'coupontype' => 'Cart',
									'is_coupon_used' => 'Yes',
									'total' => $totalAmt);
					$condition =array('user_id' => $userId, 'sell_id' => $sellerId);
					$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition);
					//print_r($this->db->last_query());die;
				//print_r($this->db->last_query());die;					
					/*foreach($ShopArr->result() as $shopRow){
						$amountOrg = $shopRow->indtotal;									
						$discount = ($percentage * 0.01) * $amountOrg; 
						$IndAmt = number_format($amountOrg - $discount,2,'.',''); 
						$dataArr = array('indtotal' => $IndAmt);
						$condition =array('id' => $shopRow->id);
						$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
					}*/
					$returnStr['status_code'] = '1';
					$returnStr['msg'] = '';
					$returnStr['coupon_id'] = $CoupRes->row()->id;
					echo json_encode($returnStr);die;
					
				}elseif($CoupRes->row()->price_type == 1){
					$discount = $CoupRes->row()->price_value;
					if($amount > $discount){									
						$amountOrg = number_format($amount-$discount,2,'.','');
						$dataArr = array('discountAmount' => $discount, 
									'couponID' => $CoupRes->row()->id,
									'couponCode' => $Code,
									'coupontype' => 'Cart',
									'is_coupon_used' => 'Yes',
									'total' => $amountOrg);
						$condition =array('user_id' => $userId);
						$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
						/*$newDisAmt = ($discount / $ShopArr->num_rows());
						foreach($ShopArr->result() as $shopRow){
							$amountOrg = $shopRow->indtotal;									
							$IndAmt = number_format($amountOrg - $newDisAmt,2,'.',''); 
							$dataArr = array('indtotal' => $IndAmt);
							$condition =array('id' => $shopRow->id);
							$this->cart_model->commonInsertUpdate(SHOPPING_CART,'update',$excludeArr,$dataArr,$condition); 
						}*/
										
						$returnStr['status_code'] = '1';
						$returnStr['msg'] = '';
						$returnStr['coupon_id'] = $CoupRes->row()->id;
						echo json_encode($returnStr);die;

					}else{
						$returnStr['msg'] = 'Please add more items quantity in the particular category or product, for using this coupon code';
						echo json_encode($returnStr);die;
					}								
				}
								
					
					
			} else {
				$returnStr['msg'] = 'Entered code is Not Valid';
				echo json_encode($returnStr);die;
			}
		}else{
			$returnStr['msg'] = 'Code is already used';
			echo json_encode($returnStr);die;
		}
	
			/*}else{
				echo '2';
				exit();
			}*/
		
	}else{
		$returnStr['msg'] = 'Entered code is Not Valid2';
		echo json_encode($returnStr);die;
	}

}

	public function checkCodeRemove(){
	
	    $returnStr['status_code'] = '1';
		$returnStr['msg'] = 'Coupon Code Removed Successfully';
		
		$userId=$this->input->post('userId');
		$sellerId=$this->input->post('sellerId');
		$excludeArr = array('code');
		$dataArr = array('discountAmount' => 0, 
						'couponID' => 0,
						'couponCode' => '',
						'coupontype' => '',
						'is_coupon_used' => 'No');
		$condition =array('user_id' => $userId,'sell_id'=>$sellerId);
		$this->mobile_model->update_details(USER_SHOPPING_CART,$dataArr,$condition); 
		
		echo json_encode($returnStr);die;
		
		
		
		
		/*
		
		$cartVal = $this->mobile_model->get_all_details(SHOPPING_CART,array( 'user_id' => $userid));
		$cartAmt = 0; $cartShippingAmt = 0; $cartTaxAmt = 0;
		if($cartVal -> num_rows() > 0 ){ 
			$k=0;
			foreach ($cartVal->result() as $CartRow){
				$cartAmt = $cartAmt + (($CartRow->product_shipping_cost +  ($CartRow->product_tax_cost * 0.01 * $CartRow->price ) + $CartRow->price)  * $CartRow->quantity);
				$newCartInd[] = $CartRow->indtotal;
				$k = $k + 1;
			}
			$cartSAmt = $cartVal->row()->shipping_cost;
			$cartTAmt = $cartAmt * 0.01 * $cartVal->row()->tax;
			$grantAmt = $cartAmt + $cartSAmt + $cartTAmt ;
			
		}
		
		$this->db->select('discountAmount');
		$this->db->from(SHOPPING_CART);
		$this->db->where('user_id = '.$userid);
		$query = $this->db->get();
		$newAmtsValues = @implode('|',$newCartInd);
		
		if($query->row()->discountAmount !=''){
			$grantAmt = $grantAmt - $query->row()->discountAmount;
		}
		
	echo number_format($cartAmt,2,'.','').'|'.number_format($cartSAmt,2,'.','').'|'.number_format($cartTAmt,2,'.','').'|'.number_format($grantAmt,2,'.','').'|'.number_format($query->row()->discountAmount,2,'.','').'|'.$k.'|'.$newAmtsValues; */
		
	
	}
	
	
}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */