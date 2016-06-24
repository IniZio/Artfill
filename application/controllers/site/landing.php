<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Landing page functions
 * @author Teamtweaks
 *
 */

class Landing extends MY_Controller {
	function __construct(){
	
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library('session');
		$this->load->library(array('encrypt','form_validation'));		

		$this->load->library('ciqrcode'); //qrcode library
		// $this->load->library('qrcode_reader/QrReader'); //qrcode reader library
		include_once(APPPATH.'libraries/qrcode_reader/QrReader.php');

		$this->load->model('product_model');
		$this->load->model('user_model');
		
			$this->load->database();
		//echo $this->checkLogin('U'); die;
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
		
		/*
		$UserCookieData = $this->input->cookie("Shopsy_NewUser");
		if($UserCookieData != ''){
			$condition = array('id'=>$UserCookieData);
			$checkUser = $this->user_model->get_all_details(USERS,$condition);
			if ($checkUser->num_rows() == 1){ 
				$userdata = array(
								'shopsy_session_user_id' => $checkUser->row()->id,
								'shopsy_session_user_name' => $checkUser->row()->user_name,
								'shopsy_session_full_name' => $checkUser->row()->full_name,
								'shopsy_session_user_email' => $checkUser->row()->email,
								'shopsy_session_user_confirm' => $checkUser->row()->is_verified,
								'userType'=>$checkUser->row()->group
							);
				
				$this->session->set_userdata($userdata);
			}
		}
		*/
		
		
		
		
		
				
    }
    
    /**
     * Site Index Page
     * 
     */
   	public function index(){	 

// 		if ($this->checkLogin('U') != ''){
// 			redirect('home');
// 		}
		$recentFavorites= $this->user_model->get_resent_favorite_list()->result_array(); 
		#echo  $this->db->last_query();exit();
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
		
		
		//$bancondition = array('status' =>'Publish');
		$this->data['bannerSlide'] = $this->user_model->get_all_details(LANDING_BANNER,$bancondition);
		$this->data['bannerSlide_image'] = $this->user_model->get_all_details(LANDING_BANNER,$bancondition)->result_array();
		
		$this->data['banner_settings'] = $this->user_model->get_all_details(BANNER_SETTINGS,array());
		$condition = array('status'=>'active');
		$this->data['sliderslist']= $this->user_model->get_all_details(HOME_SLIDERS,array());
    

		#echo "<pre>"; print_r($this->data['bannerSlide']); die;
		
		$this->data['recent_product_details'] = $this->product_model->get_recent_product_details();
		// echo $this->data['recent_product_details']; die;
		$this->data['featured_product_details'] = $this->product_model->get_featured_product_details();
		//$this->data['deal_of_day'] = $this->product_model->get_deal_today();
		//echo "<pre>";print_r($this->data['deal_of_day']);die;
		
		$this->data['featured_shop_details'] = $this->product_model->get_featured_shop_details();
		$this->data['recentpromote'] =$recentpromote = $this->product_model->getrecentpromote();
		
		$this->data['maxfavourite'] =$maxfavourite = $this->product_model->getmaxfav();
		#echo "<pre>"; print_r($this->data['recentpromote']->result()); die;
		
		$testiMoni= array_rand($recentpromote->result());
		
		$this->data['new_promote'] = $recentpromote->row($testiMoni);
		

		$params['data'] = 'This is a text to encode become QR Code';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		$this->ciqrcode->generate($params);

		echo '<img src="'.base_url().'tes.png" />';

		$qrcode = new QrReader('tes.png');
		$text = $qrcode->text(); //return decoded text from QR Code

		echo '<img src="'.base_url().'tes.png" />';
		// echo $text;die;

		$this->load->view('site/landing/landing',$this->data);
	}
	
	/** 
	 * 
	 * This function displaying the ajax load more for fancy
	 *
	 */
	public function ajax_load_more(){
		$pageloaded = $this->input->post('group_no');
		$limit = 39;
		$start = $limit*$pageloaded;
		$productDetails = $this->product_model->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 order by p.created desc limit ".$start.','.$limit);
		$resultVal = '';
		if ($productDetails->num_rows()>0){
			$productArr = $productDetails->result_array();
			for ($i=0;$i<count($productArr);$i=$i+3){
	          	if (isset($productArr[$i]['id'])){
	          		$imgArr = explode(',', $productArr[$i]['image']);
	          		$img = 'dummyProductImage.jpg';
	          		foreach ($imgArr as $imgVal){
	          			if ($imgVal != ''){
							$img = $imgVal;
							break;
	          			}
	          		}
	          		$fancyClass = 'fancy';
	          		$fancyText = LIKE_BUTTON;
	          		if (count($this->data['likedProducts'])>0 && $this->data['likedProducts']->num_rows()>0){
	          			foreach ($this->data['likedProducts']->result() as $likeProRow){
	          				if ($likeProRow->product_id == $productArr[$i]['seller_product_id']){
	          					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
	          				}
	          			}
	          		}
	          		$resultVal .= '<li class="big clear" tid="'.$productArr[$i]['seller_product_id'].'" tuserid="'.$productArr[$i]['user_id'].'">
              <div class="figure-item">
                <!-- span class="pre"></span -->
                <a href="';
	          		if ($productArr[$i]['user_id'] != '0'){
	          			$resultVal .= base_url().'user/'.$productArr[$i]['user_name'];
	          		}else {
	          			$resultVal .= base_url().'user/administrator';
	          		}
	          		$resultVal.='" class="vcard">';
                	if ($productArr[$i]['thumbnail'] == ''){
                	$resultVal .= '<img src="images/users/user-thumb1.png">';
                	}else {
                	$resultVal .= '<img src="images/users/'.$productArr[$i]['thumbnail'].'">';
                	}
                $resultVal .= '</a>
                <a href="things/'.$productArr[$i]['id'].'/'.url_title($productArr[$i]['product_name'],'-').'" class="figure-img"> 
                	<span class="figure grid" style="background-size:cover;" data-ori-url="images/product/thumb/'.$img.'" data-310-url="images/product/thumb/'.$img.'"><em class="back"></em></span>
                	<span class="figure classic"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="640" data-height="640"> 
                	</span> 
                	<span class="figure vertical"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="310" data-height="310"> 
                	</span> 
                	<span class="figcaption">'.$productArr[$i]['product_name'].'</span> 
                </a> 
                <em class="figure-detail"> 
                	<span class="price">'.$this->data['currencySymbol'].' '.$productArr[$i]['sale_price'].' <small>'.$this->data['currencyType'].'</small></span> 
                	<span class="username"><em><i> by </i><a href="';
                	if ($productArr[$i]['user_id'] != '0'){
                		$resultVal .= base_url().'user/'.$productArr[$i]['user_name'];
                	}else {
                		$resultVal .= base_url().'user/administrator';
                	}
	          	$resultVal .= '">';
	          	if ($productArr[$i]['user_id'] != '0'){
	          		$resultVal .= $productArr[$i]['full_name'];
	          	}else {
	          		$resultVal .= 'administrator';
	          	}
	          	$resultVal .= '</a> + '.$productArr[$i]['likes'].'</em></span> 
                </em>
                <ul class="function">
                  <li class="list"><a href="#">Add to List</a></li>
                  <li class="cmt"><a href="#">Comment</a></li>
                  <li class="share">
                    <button type="button" ';
	          	if ($this->data['loginCheck']==''){
	          		$resultVal .= 'require_login="true"';
	          	}
	          	$resultVal .= ' data-timage="images/product/thumb/'.$img.'" class="btn-share" tname="'.$productArr[$i]['product_name'].'"  username="';
	          	 if ($productArr[$i]['user_id'] != '0'){
	          	 	$resultVal .= $productArr[$i]['full_name'];
	          	 }else {
	          	 	$resultVal .= 'administrator';
	          	 }
	          	$resultVal .= '"><i class="ic-share"></i></button>
                  </li>
                  <li class="view-cmt"><a href="#">5 comments</a></li>
                </ul>
                <a href="#" item_img_url="images/product/'.$img.'" tid="'.$productArr[$i]['seller_product_id'].'" class="button '.$fancyClass.'" ';
	          	if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"'; }
	          	$resultVal .= '><span><i></i></span> '.$fancyText.'</a> </div>
            </li>';
	          	}
          	if (isset($productArr[$i+1]['id'])){
          		$imgArr = explode(',', $productArr[$i+1]['image']);
          		$img = 'dummyProductImage.jpg';
          		foreach ($imgArr as $imgVal){
          			if ($imgVal != ''){
						$img = $imgVal;
						break;
          			}
          		}
          		$fancyClass = 'fancy';
          		$fancyText = LIKE_BUTTON;
          		if (count($this->data['likedProducts'])>0 && $this->data['likedProducts']->num_rows()>0){
          			foreach ($this->data['likedProducts']->result() as $likeProRow){
          				if ($likeProRow->product_id == $productArr[$i+1]['seller_product_id']){
          					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
          				}
          			}
          		}
          		$resultVal .= '<li  class="mid clear" tid="'.$productArr[$i+1]['seller_product_id'].'" tuserid="'.$productArr[$i+1]['user_id'].'">
              <div class="figure-item">
                <!-- span class="pre"></span -->
                <a href="';
          		if ($productArr[$i+1]['user_id'] != '0'){$resultVal .= 'user/'.$productArr[$i+1]['user_name'];}else {$resultVal .= base_url().'user/administrator';}
          		$resultVal .= '" class="vcard">';
                	if ($productArr[$i+1]['thumbnail'] == ''){
                	$resultVal .= '<img src="images/users/user-thumb1.png">';
	                }else {
	                $resultVal .= '<img src="images/users/'.$productArr[$i+1]['thumbnail'].'">';
	                }
                $resultVal .= '</a> 
                <a href="things/'.$productArr[$i+1]['id'].'/'.url_title($productArr[$i+1]['product_name'],'-').'" class="figure-img"> 
                	<span class="figure grid" style="background-size:cover;" data-ori-url="images/product/thumb/'.$img.'" data-310-url="images/product/thumb/'.$img.'"><em class="back"></em></span> 
                	<span class="figure classic"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="310" data-height="310"> 
                	</span> 
                	<span class="figure vertical"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="310" data-height="310"> 
                	</span> 
                	<span class="figcaption">'.$productArr[$i+1]['product_name'].'</span> 
                </a> 
                <em class="figure-detail"> 
                	<span class="price">'.$this->data['currencySymbol'].' '.$productArr[$i+1]['sale_price'].' <small>'.$this->data['currencyType'].'</small></span> 
                	<span class="username"><em><i> by </i><a href="';
                if ($productArr[$i+1]['user_id'] != '0'){$resultVal .= base_url().'user/'.$productArr[$i+1]['user_name'];}else {$resultVal .= base_url().'user/administrator';}
                $resultVal .= '">';
                if ($productArr[$i+1]['user_id'] != '0'){$resultVal .= $productArr[$i+1]['full_name'];}else {$resultVal .= 'administrator';}
                $resultVal .= '</a> + '.$productArr[$i+1]['likes'].'</em></span> 
                </em>
                <ul class="function">
                  <li class="list"><a href="#">Add to List</a></li>
                  <li class="cmt"><a href="#">Comment</a></li>
                  <li class="share">
                    <button type="button" ';
                if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"';}
                $resultVal .= ' data-timage="images/product/'.$img.'" class="btn-share"  tname="'.$productArr[$i+1]['product_name'].'"  username="';
                if ($productArr[$i+1]['user_id'] != '0'){$resultVal .= $productArr[$i+1]['full_name'];}else {$resultVal .= 'administrator';}
                $resultVal .= '"><i class="ic-share"></i></button>
                  </li>
                  <li class="view-cmt"><a href="#">5 comments</a></li>
                </ul>
                <a href="#" item_img_url="images/product/'.$img.'" tid="'.$productArr[$i+1]['seller_product_id'].'" class="button '.$fancyClass.'" ';
                if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"';}
                $resultVal .= '><span><i></i></span> '.$fancyText.'</a> </div>
            </li>';
          	}
          	if (isset($productArr[$i+2]['id'])){
          		$imgArr = explode(',', $productArr[$i+2]['image']);
          		$img = 'dummyProductImage.jpg';
          		foreach ($imgArr as $imgVal){
          			if ($imgVal != ''){
						$img = $imgVal;
						break;
          			}
          		}
          		$fancyClass = 'fancy';
          		$fancyText = LIKE_BUTTON;
          		if (count($this->data['likedProducts'])>0 && $this->data['likedProducts']->num_rows()>0){
          			foreach ($this->data['likedProducts']->result() as $likeProRow){
          				if ($likeProRow->product_id == $productArr[$i+2]['seller_product_id']){
          					$fancyClass = 'fancyd';$fancyText = LIKED_BUTTON;break;
          				}
          			}
          		}
          		$resultVal .= '<li  class="mid "  tid="'.$productArr[$i+2]['seller_product_id'].'" tuserid="'.$productArr[$i+2]['user_id'].'">
              <div class="figure-item">
                <!-- span class="pre"></span -->
                <a href="things/'.$productArr[$i+2]['id'].'/'.url_title($productArr[$i+2]['product_name'],'-').'" class="figure-img"> 
                	<span class="figure grid" style="background-size:cover;" data-ori-url="images/product/thumb/'.$img.'" data-310-url="images/product/thumb/'.$img.'"><em class="back"></em></span> 
                	<span class="figure classic"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="310" data-height="310"> 
                	</span> 
                	<span class="figure vertical"> <em class="back"></em> 
                		<img src="images/product/'.$img.'" data-width="310" data-height="310"> 
                	</span> 
                	<span class="figcaption">'.$productArr[$i+2]['product_name'].'</span> 
                </a> 
                <em class="figure-detail"> 
                	<span class="price">'.$this->data['currencySymbol'].' '.$productArr[$i+2]['sale_price'].' <small>'.$this->data['currencyType'].'</small></span> 
                	<span class="username"><em><i> by </i><a href="';
          		if ($productArr[$i+2]['user_id'] != '0'){$resultVal .= base_url().'user/'.$productArr[$i+2]['user_name'];}else {$resultVal .= base_url().'user/administrator';}
  	    		$resultVal .= '">';
          		if ($productArr[$i+2]['user_id'] != '0'){$resultVal .= $productArr[$i+2]['full_name'];}else {$resultVal .= 'administrator';}
          		$resultVal .= '</a> + '.$productArr[$i+2]['likes'].'</em></span> 
                </em>
                <ul class="function">
                  <li class="list"><a href="#">Add to List</a></li>
                  <li class="cmt"><a href="#">Comment</a></li>
                  <li class="share">
                    <button type="button" ';
          		if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"';}
          		$resultVal .= ' data-timage="images/product/'.$img.'" class="btn-share" tname="'.$productArr[$i+2]['product_name'].'"  username="';
          		if ($productArr[$i+2]['user_id'] != '0'){$resultVal .= $productArr[$i+2]['full_name'];}else {$resultVal .= 'administrator';}
          		$resultVal .= '"><i class="ic-share"></i></button>
                  </li>
                  <li class="view-cmt"><a href="#">5 comments</a></li>
                </ul>
                <a href="#" item_img_url="images/product/'.$img.'" tid="'.$productArr[$i+2]['seller_product_id'].'" class="button '.$fancyClass.'" ';
          		if ($this->data['loginCheck']==''){$resultVal .= 'require_login="true"'; }
          		$resultVal .= '><span><i></i></span> '.$fancyText.'</a> </div>
            </li>';
				}
			}
		}
		
		echo $resultVal;
	}
	
	
	/** 
	 * 
	 * This function change the session value to language and currency popup on footer 
	 *
	 */
	public function changetoall()
	{
		
	  $this->session->set_userdata('country_filter_enable',$this->input->get("d"));
	
	 	if ( ! function_exists('get_geolocation')){
			$this->ip = $this->input->ip_address();
		 	$this->geo_data = get_geolocation($ip);						
		}
		if($this->session->userdata('country_filter_enable')&&$this->session->userdata('country_filter_enable')==2)
		{
			if(count($this->geo_data)>0){ 
				$this->session->set_userdata('geo_country_name',$this->geo_data[1]);
				 $this->data['currencyList']=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active'));
			$this->data['geo_country_name']=$this->geo_data["country_name"]; 
			$this->session->set_userdata('geo_country_filter','and lower(u.country)="'.strtolower(trim($this->session->userdata("geo_country_name"))).'"');
			$this->session->set_userdata('geo_country_filter1',"and lower(u.country)='".strtolower(trim($this->session->userdata("geo_country_name")))."'");
			$this->db->select("currency_type");
			$this->db->from("shopsy_country");
			
			$this->db->where(array("country_code"=>$this->geo_data[0]));
			$currenydetails = $this->db->get();
			$condition = array('currency_code' => trim($currenydetails->row()->currency_type));
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
			$nCVal=array();
			foreach($result->row() as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode ($cVal);
			}
			#$this->session->set_userdata('currency_data',$result->row_array());
			$this->session->set_userdata('currency_data',$nCVal);
			$this->data['currencySymbol'] = base64_decode($this->session->userdata['currency_data']['currency_symbol']);
			$this->data['currencyValue'] = base64_decode($this->session->userdata['currency_data']['currency_value']);
echo $this->data['currencyValue']; die;
			$this->data['currencyType'] = base64_decode($this->session->userdata['currency_data']['currency_code']);
			$this->data['currencyName'] = base64_decode($this->session->userdata['currency_data']['currency_name']);
				
		}else{ 
	        $this->session->unset_userdata('geo_country_front');
		    $this->session->unset_userdata("geo_currency_front");
			$this->session->unset_userdata('geo_currency_enabled');
			$this->session->unset_userdata('geo_country_filter');
			$this->session->unset_userdata('geo_country_filter1');
						 
		}
			$this->session->unset_userdata('gcurrency_data');
	    }
		else if($this->session->userdata('country_filter_enable')&&$this->session->userdata('country_filter_enable')==1)
		{
		
			$this->session->unset_userdata('geo_currency');
			$this->data['geo_country_name']=""; 
			$this->session->unset_userdata('geo_country_filter');
			$this->session->unset_userdata('geo_country_filter1');	
			$this->session->unset_userdata('gcurrency_data');	
			$this->session->set_userdata('geo_currency_front',"USD");
            $condition = array('currency_code' => $this->session->userdata("geo_currency_front"));	
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
			$this->session->set_userdata('gcurrency_data',$result->row_array());
			$this->data['gcurrencySymbol'] = $this->session->userdata['gcurrency_data']['currency_symbol'];//$this->config->item('currency_currency_symbol');
			$this->data['gcurrencyValue'] = $this->session->userdata['gcurrency_data']['currency_value'];
			$this->data['gcurrencyType'] = $this->session->userdata['gcurrency_data']['currency_code']; //$this->config->item('currency_currency_type');
			$this->data['gcurrencyName'] = $this->session->userdata['gcurrency_data']['currency_name'];
			  
		}
		else
		{
		 
		  if(count($geo_data)>0)
		  {
		   $this->session->set_userdata('geo_country_front',$this->geo_data[1]);
		   	$this->db->select("currency_type");
			$this->db->from("shopsy_country");
			$this->db->where(array("country_code"=>$this->geo_data[0]));
			$currenydetails = $this->db->get();
		   $condition = array('currency_code' => trim($currenydetails->row()->currency_type));
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
		     $this->session->set_userdata('gcurrency_data',$result->row_array());
		   }
		  else
		  {
		     $this->session->set_userdata('geo_country_front',"United States");
				$this->session->set_userdata('geo_currency_front',"USD");
			   $condition = array('currency_code' => $this->session->userdata('geo_currency_front'));
			$result=$this->product_model->get_all_details(CURRENCY,$condition);
		     $this->session->set_userdata('gcurrency_data',$result->row_array());
			
		  }
		  	
				
				
				
			$this->data['gcurrencySymbol'] = $this->session->userdata['gcurrency_data']['currency_symbol'];//$this->config->item('currency_currency_symbol');
			$this->data['gcurrencyValue'] = $this->session->userdata['gcurrency_data']['currency_value'];
			$this->data['gcurrencyType'] = $this->session->userdata['gcurrency_data']['currency_code']; //$this->config->item('currency_currency_type');
			$this->data['gcurrencyName'] = $this->session->userdata['gcurrency_data']['currency_name'];
			
		
	
	
		}
		echo "success";  
	 
	 
	}
	
	/** 
	 * 
	 * This function change the session value for language and currency depend upon the geo location 
	 *
	 */
	public function change_geo_lang()
	{
	
		$langOpt = $this->input->post('lang_opt');
		
		if($langOpt==1){
			$DefCurrencyList=$this->product_model->get_all_details(CURRENCY,array('status' => 'Active','default_currency'=>'Yes'));
			
			$GeoArr = serialize(array('GeoCountry'=>'US','GoeCurrency'=>$DefCurrencyList->row()->currency_code));
			$GeoCookie = array('name'=>'shopsy_geo_locate','value'=>$GeoArr,'expire'=>86500,'secure'=>FALSE);
			$this->input->set_cookie($GeoCookie);
			$this->session->unset_userdata('currency_data');
			$result=$this->product_model->get_all_details(CURRENCY,array('currency_code'=>'HKD'));
			$nCVal=array();
			foreach($result->row() as $cKey=>$cVal){
				$nCVal[$cKey]=base64_encode ($cVal);
			}
			#$this->session->set_userdata('currency_data',$result->row_array());
			$this->session->set_userdata('currency_data',$nCVal);
			
			
		}else{
			
			$GeoArr = serialize(array('GeoCountry'=>GeoCountryCode,'GoeCurrency'=>GeoCurrencyCode));
			$GeoCookie = array('name'=>'shopsy_geo_locate','value'=>$GeoArr,'expire'=>365 * 86500,'secure'=>FALSE);
			$this->input->set_cookie($GeoCookie);
		}		
		echo "success";  
	 
	 
	}
	
}

/* End of file landing.php */
/* Location: ./application/controllers/site/landing.php */