<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 *
 */

class Shop extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','seller_model','user_model','order_model','commission_model','support_model'));
		//$this->load->model(array('product_model','shop','seller_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['AdminloginCheck'] = $this->checkLogin('A');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		//$this->data['likedProducts'] = $this->shop->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
		//$this->data['shopProduc'] =$this->product_model->view_product_details_from_section($condition1)->result_array();
		
		$SSeller_details=$this->seller_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));				
		$this->data['currentshopurl'] = $SSeller_details->row()->seourl;
		
    }
    
	/*
	* 
	* Loading the shop page
	* 
	*/
	public function index(){
		$this->data['heading'] = 'Shop';
		$this->data['bannerList'] = $this->shop->get_all_details(BANNER_CATEGORY,array('status'=>'Publish'));
		$this->data['recentProducts'] = $this->shop->view_product_details(" where p.status='Publish' and p.quantity > 0 and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0 order by p.created desc limit 4");
		$this->load->view('site/shop/display_shop_list',$this->data);
    }
	
	/*
	* 
	* Load the Shop template setting
	* 
	*/

	public function shop_template_setting()
	{
		if ($this->checkLogin('U')!=''){		
		$this->data['userVal'] = $this->seller_model->get_userdetail_data('product_template,shop_template,blog_template');
		//print_r($this->data['sellerVal']); die;
		
		$this->data['meta_title'] = $this->data['heading'] = 'Shop Product Setup';
		$this->load->view('site/shop/shop_template.php',$this->data);
			
		}else {
			$this->data['next'] = $this->input->get('next');
			$this->data['heading'] = 'Sign in';
			$this->load->view('site/user/signup.php',$this->data);
		}
	}	
	/*
	* 
	* load add new shop start
	* param String $optionsLoad
	* 
	*/
	public function load_shop_open($optionsLoad){  

	if ($this->checkLogin('U')!='' || $this->checkLogin('A')!=''){
		
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());
		#echo "<pre>";print_r($this->data['selectSeller_details']);die;
		$checkloginIDarr=$this->session->all_userdata(); 
		if ($this->checkLogin('A')!=''){
			$checkUser = $this->user_model->get_all_details(USERS,array('id' => 1));
			#echo '<pre>';print_r($checkUser);die;
			if ($checkUser->num_rows() == 1){ 
					
				$userdata1 = array('shopsy_session_user_id'=>'','shopsy_session_user_name'=>'','shopsy_session_full_name'=>'','shopsy_session_user_email'=>'','shopsy_session_temp_id'=>'');
				$this->session->unset_userdata($userdata1);
				$this->session->unset_userdata('currency_data');
				$this->session->unset_userdata('region');
				//delete_cookie("Shopsy_NewUser");
				$cookie = array(
					'name'   => 'Shopsy_NewUser',
					'value'  => '',
					'expire' => -86400,
					'secure' => FALSE
				);
				$this->input->set_cookie($cookie);
				sleep(2);	
				$userdata = array(
						'shopsy_session_user_id' => $checkUser->row()->id,
						'shopsy_session_user_name' => $checkUser->row()->user_name,
						'shopsy_session_full_name' => $checkUser->row()->full_name,
						'shopsy_session_user_email' => $checkUser->row()->email,
						'userType'=>$checkUser->row()->group
				);
				$this->session->set_userdata($userdata);
				$CookieVal = array(
					'name'   => 'Shopsy_NewUser',
					'value'  => $checkUser->row()->id,
					'expire' => 3600*24*7
				);
				$this->input->set_cookie($CookieVal); 
			}
			$welcome_admin=addslashes(artfill_lg('lg_welcome_admin','Welcome, Admin'));
			$loggeduserID=$checkUser->row()->id;
			$this->setErrorMessage('success',$welcome_admin);		
		}else{
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
		}
		
		$this->data['userIdVal']=$loggeduserID;
		$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'ASC')))->result();
		#echo $this->db->last_query();
		#echo "<pre>";print_r($this->data['countryList'] );die;
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
		if($optionsLoad == 'sell' || $optionsLoad == 'reviews'){
		
			if($optionsLoad == 'reviews'){
				if($this->checkLogin('U')!=""){
					$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE activity_id =".$loggeduserID." AND (activity='review' OR activity='review-update')");
				}
			}
			$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
			$this->data['shopproductfeed_details']=$shopproductfeed_details = $this->seller_model->get_shopproductfeed_details($loggeduserID,'owner')->result();			
			if($this->data['selectSeller_details'][0]['seller_businessname']!=""){
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				#$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();	
				$product_list=$shop_sec['product_id'];
				$condition1 = " where (u.group='User' or u.group='Seller') and u.status='Active' and p.status = 'Publish'  and p.user_id=".$loggeduserID."  group by p.id order by p.created desc";
		
				$this->data['shopDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();		
					//echo $this->db->last_query(); die;
				$cond=array('seller_id' => $loggeduserID); 
				$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID),array('status'=>'Publish'))->result_array();
				
				$this->data['Unpublished'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'status'=>'UnPublish'))->result_array();
				
// // 				echo "<pre>"; print_r($this->data['shopDetail']);
//  				echo "<pre>"; print_r($this->data['Unpublished']);
//  				die;
				$this->data['Paidproduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Paid'));
				$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
				$this->data['shop_section_count']=count($this->data['shop_section_details']);
					
				$this->data['meta_title'] = $this->data['heading'] = 'Shop';
				
				$this->load->view('site/shop/shop_preview',$this->data);
			}else{
			
				$this->db->select("id,name");
				$this->db->from("shopsy_country");
				$data_country=$this->db->get();
			
				$this->data["country_list"]=$data_country;
				$this->data['meta_title'] = $this->data['heading'] = 'Open new shop';
				   $this->load->view('site/shop/add_new_shop',$this->data);
			}
		} elseif($optionsLoad == 'name'){
			
			$this->db->select("id,name");
			$this->db->from("shopsy_country");
			$data_country=$this->db->get();
			$this->data["country_list"]=$data_country;
			
			$this->db->select("country");
			$this->db->from(USER);
			$this->db->where(array('id' => $loggeduserID)); 
			$country=$this->db->get()->result_array();
			$this->data["country"]=$country[0]["country"];
			$this->data['meta_title'] = $this->data['heading'] = 'Open new shop';
			$this->load->view('site/shop/add_new_shop',$this->data);
		}elseif($optionsLoad == 'listitem'){
		
			$this->data['seller_info']=$this->seller_model->get_sellers_data(SELLER,$condition);
		   	$this->data['variations_result']= $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array('status'=>'Active'))->result();	   
			$condition = " where (p.status='Publish' or p.status='unpublish') and p.user_id=".$loggeduserID." and (u.group='User' or u.group='Seller') and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
			$this->data['shopDetail']=$this->product_model->view_product_details($condition)->result();
		   //$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result();
		   //$this->data['AllmainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=> 0,'status' => 'Active'))->result();
			#$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array())->result();
			$this->data['meta_title'] = $this->data['heading'] = 'Shop List Items';
		    $this->load->view('site/shop/add_shop_listitems',$this->data);

		} elseif($optionsLoad == 'admin-listitem') { 
			if($this->checkLogin('A')!=''){
				
				redirect('site/shop/admin_add_product_form');
				
				$this->data['variations_result']= $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array('status'=>'Active'))->result();
				$condition = " where (p.status='Publish' or p.status='unpublish') and p.user_id=".	$loggeduserID." and (u.group='User' or u.group='Seller') and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
				$this->data['shopDetail']=$this->product_model->view_product_details($condition)->result();
 				//$this->db->last_query();
				//echo '<pre>';print_r($this->data['shopDetail']); die;
			   
				//$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result();
				//$this->data['AllmainCategories'] = $this->product_model->get_all_details(CATEGORY,array('rootID'=> 0,'status' => 'Active'))->result();
				#$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array())->result();
				$this->data['meta_title'] = $this->data['heading'] = 'Shop List Items';
				$this->load->view('site/shop/add_shop_listitems',$this->data);
			}else{
				redirect('admin');	
			}
			   			 
		}elseif($optionsLoad == 'payment'){
			#$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array())->result();
			$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result();
			$this->data['meta_title'] = $this->data['heading'] = 'Shop Payment';
			$this->load->view('site/shop/add_shop_getpaid',$this->data);
		}elseif($optionsLoad == 'billing'){
			#$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array())->result();
			
			if($this->config->item('membership')=='Yes'){
				
			
				//$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' =>$loggeduserID,'pay_status'=>'Pending','status'=>'Publish'))->result();
				
				$condition = " where (p.status='Publish' or p.status='Unpublish') and p.user_id=".	$loggeduserID." and (u.group='User' or u.group='Seller') and p.pay_status = 'Pending' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
				$this->data['shopDetail']= $shopDetail = $this->product_model->view_product_details($condition)->result();
				
				$this->data['userDetails']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->row();
				
				$this->db->select('status,membership_expiry,membership_status');
				$this->db->from(SELLER);
				$this->db->where('seller_id = '.$loggeduserID);
				$this->data['SellerValShop'] = $this->db->get();
				#echo $this->db->last_query();
				#echo "<pre>"; print_r($this->data['userDetails']->row()->commision); die;
				
				$this->data['products_in_pay']=count($this->data['shopDetail']);
				$this->data['meta_title'] = $this->data['heading'] = 'Shop Billing';
				
				$this->load->view('site/shop/add_shop_member',$this->data);
				
			}else{
				//$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Pending','status'=>'Publish'))->result();
				
				$condition = " where (p.status='Publish' or p.status='Unpublish') and p.user_id=".	$loggeduserID." and (u.group='User' or u.group='Seller') and p.pay_status = 'Pending' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
				$this->data['shopDetail']= $shopDetail = $this->product_model->view_product_details($condition)->result();
				
// 				echo "<pre>"; print_r($this->data['shopDetail']);
// 				echo $this->db->last_query()."<br>";
				
				$this->data['userDetails']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->row();
				$this->data['CardsDetails'] = $this->product_model->get_all_details(CREDITCARDS,array('user_id'=>$loggeduserID))->row();
				$this->data['sellingPayment'] = $this->product_model->get_all_details(ADMIN_SETTINGS,array('id' => 1));
				#echo "<pre>";print_r($this->data['sellingPayment']->row());die;
				$this->db->select('status');
				$this->db->from(SELLER);
				$this->db->where('seller_id = '.$this->data['loginCheck']);
				$this->data['SellerValShop'] = $this->db->get();
				$this->data['products_in_pay']=count($this->data['shopDetail']);
				
// 				print_r($this->data['products_in_pay']);
// 				die;
				
				//$this->data['products_in_pay']=$shopDetail->num_rows();
				$this->data['meta_title'] = $this->data['heading'] = 'Shop Billing';
				#echo "<pre>"; print_r($this->data['userDetails']); die;
				$this->load->view('site/shop/add_shop_billing',$this->data);
			}			
			
			
		}
			
	}else {
	
		redirect('shop-index');
		/* $this->data['next'] = $this->input->get('next');
		$this->data['meta_title'] = $this->data['heading'] =$this->data['title']= 'Shop index';
		$this->load->view('site/shop/add_shop_index',$this->data); */
	}
}

	/*
	* 
	* load new shop welcome page
	* 
	*/
	public function Load_shop_welcome(){
		$this->data['next'] = $this->input->get('next');
		$this->data['meta_title'] = $this->data['heading'] =$this->data['title']= 'Shop index';
		$this->load->view('site/shop/add_shop_index',$this->data); 
	}

	/*
	* 
	* load the admin add product page
	* 
	*/
	function admin_add_product_form(){
		if($this->checkLogin('A')!=''){		
					$this->data['variations_result']= $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array('status'=>'Active'))->result();
					$condition = " where (p.status='Publish' or p.status='unpublish') and p.user_id=".	$this->checkLogin('A')." and (u.group='User' or u.group='Seller') and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
					$this->data['shopDetail']=$this->product_model->view_product_details($condition)->result();				
					$this->data['meta_title'] = $this->data['heading'] = 'Shop List Items';
					$this->load->view('site/shop/add_shop_listitems',$this->data);
		}
	}
	
	/*
	* 
	* load the shop preview page
	* 
	*/
	public function load_shop_preview()
	{
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		
		$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		#$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result();					 	  
		$cond=array('seller_id' => $loggeduserID); 
		$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
		
		$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
		$section=$this->uri->segment(4);
		foreach($this->data['shop_section_details'] as $shop_sec)
		{
			if($shop_sec['section_id']==$section)
			{
				$product_list=$shop_sec['product_id'];
				$condition1 = " where u.group='Seller' and FIND_IN_SET(p.id,'".$product_list."') and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." and FIND_IN_SET(p.id,'".$product_list."') group by p.id order by p.created desc";
			}
			
		}
		
		
		$this->data['shopDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();
		#echo $this->db->last_query(); die;
		#echo "<pre>"; print_r($this->data['shopDetail']); die;		
		$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
		$this->data['Paidproduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Paid'));
		
		#$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
		$this->data['shop_section_count']=count($this->data['shop_section_details']);
		$this->data['meta_title'] = $this->data['heading'] = 'Your Shop';
		$this->load->view('site/shop/shop_preview',$this->data);
	}
	
	/*
	* 
	* Open a new shop insert and update shop for seller
	* 
	*/
	public function open_new_shop()
	{
	   if ($this->checkLogin('U')!='')
	   {
		#echo "asdfgdsf";die;
	     $checkloginIDarr=$this->session->all_userdata(); 		
		  if($this->input->post('seller_businessname') != '')
		  {
		  		  if (preg_match("/^[a-zA-Z0-9]+$/", ($this->input->post('seller_businessname')))!=1){
	   	   	   	   $this->setErrorMessage('error',$special_characters_not_allowed);
				   redirect('shop/sell');	
                                  }
			  $loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			 # echo $loggeduserID;die;
			  $checkUser_inSellerlist=$this->seller_model->get_sellers_data(SELLER,$condition);
			 # print_r($checkUser_inSellerlist);die;
		      if(count($checkUser_inSellerlist) == 1)  // if count 1 means user details exist in seller table,so we need to update the details else  need to insert details
			     {   
					   $seourl = url_title($this->input->post('seller_businessname'), '-', TRUE);
					   $checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
					   $seo_count = 1;
						  while ($checkSeo->num_rows()>0)
						  {
						  $seourl = $seourl.'-'.$seo_count;
						  $seo_count++;
						  $checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
						  }
						  $inputArrval1=array(
					'country' =>$this->input->post("country")	   
					);
					$this->db->where(array("id"=>$loggeduserID));
			        $this->db->update(USER,$inputArrval1);
					
					$data_to_update=array('seller_businessname' => addslashes($this->input->post('seller_businessname')),'seourl' => $seourl);
					 
					$this->db->where(array('seller_id' => $loggeduserID));
			        $this->db->update(SELLER,$data_to_update);
		        
				  }
				  else
				  {
					$this->data['UserVal'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')))->row();
					#echo $this->db->last_query();die;
					$seourl = url_title($this->input->post('seller_businessname'), '-', TRUE);
			        $checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
					
			        $seo_count = 1;
			          while ($checkSeo->num_rows()>0)
					  {
			 	      $seourl = $seourl.'-'.$seo_count;
				      $seo_count++;
				      $checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
			          }
					  
					 // CHECK FOR FRESH DESK STATUS
					 // artfill committed fix, removing freshdesk
					 // artfill $checkFreshdesk = $this->product_model->get_all_details(USERS,array('id'=>$loggeduserID,'freshdesk_status'=>'Yes'));

//					 echo $this->db->last_query(); //die;
// 					 $qry =  $this->product_model->ExecuteQuery('describe '.USERS); //die;
// 					 echo "<pre>";print_r($qry);
// 					 echo $this->db->last_query(); //die;
// 					 echo "<pre>";var_dump($checkFreshdesk);
// 					 echo "<pre>";print_r($checkFreshdesk);die;
					 
					 
					 // artfill if($checkFreshdesk->num_rows() > 0){
							
					 // artfill }else{
					 // artfill	$user_email=$this->data['UserVal'] ->email; 
					 // artfill	$user_name=$this->data['UserVal'] ->user_name;
						// Create FRESH DESH ACCOUNT
					 // artfill	$result=$this->support_model->freshdesk_create_user($user_email,$user_name);
					 // artfill} 
				  
					$address = str_replace(' ','+',$this->input->post('shop_location'));
					$url = "http://maps.google.com/maps/api/geocode/json?address=".$address;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$response = curl_exec($ch);
					curl_close($ch);
					$response = json_decode($response);
					$lat = $response->results[0]->geometry->location->lat;
					$long = $response->results[0]->geometry->location->lng; 
					
					$inputArrval=array(
					'seller_id' => $this->data['UserVal']->id,
				    'seller_businessname' => $this->input->post('seller_businessname'),
					'seourl' => $seourl,
					'seller_email' => $this->data['UserVal']->email,
					'seller_firstname' => $this->data['UserVal']->full_name,
					'seller_lastname' => $this->data['UserVal']->last_name,
					//'status' => 'inactive',
					'status' => 'active',
					'latitude' => $lat,
					'longitude' => $long,
					'shop_location'=> $this->input->post('shop_location'),
					'created' => date('Y-m-d H:i:s')
					);
					$condition=array();
					$inputArrval1=array(
					'country' =>$this->input->post("country"),
					//artfill changed
					'group' => 'Seller'			   
					);
					$this->db->where(array("id"=> $this->data['UserVal']->id));
			        $this->db->update(USER,$inputArrval1);
					$this->db->insert(SELLER,$inputArrval);
					
					
					////send mail to admin////
					
					$emails=$this->send_confirm_mail($checkloginIDarr);
					
					////send mail to admin////
					
					/**********       Create account with  zendesk    start : place - controller/site/shop/open_new_shop()  *************/
					 if($this->config->item('zendesk_status')==="Active"){
						$url = base_url().'site/zendesk/create_zendesk_user';
						$post_array = array (
								"user_id" => $this->data['UserVal']->id,
								"user_name" => $this->data['UserVal']->full_name,
								"email_id" => $this->data['UserVal']->email
						);
						$this->load->library('curl');
						$this->curl->simple_post($url, $post_array);
					} 
					/**********       Create account with  zendesk    end  *****************************************************/
					
				  }
		    }
		  
		        $this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				if($this->lang->line('now_shop_name')!='') { $now_shop_name= stripslashes($this->lang->line('now_shop_name')); } else $now_shop_name ="Success! Your shop name is now ";
				
				$this->setErrorMessage('success',$now_shop_name.stripslashes($this->data['selectSeller_details'][0]['seller_businessname']));
		 		//redirect('shop/listitem');
		 		//redirect('public-profile');
		 		redirect('appearance/'.$seourl.'/banner');
				# $this->load->view('site/shop/add_shop_listitems',$this->data);
			}else {
				$this->data['heading'] = 'Sign in'; 
				redirect('site/user/login_user');
			}
	}
	
	public function send_confirm_mail($userDetails=''){
	
		$uid = $userDetails['shopsy_session_user_id'];
		$email = $userDetails['shopsy_session_user_email'];
		$name = $userDetails['shopsy_session_full_name'];
		
		$randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition);
		
		$newsid='25';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'admin/shop/display_shop';
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> 'New Shop','logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
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
		
		/* if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		} */

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$email,
							'mail_name'=>$name,
							'to_mail_id'=>$this->config->item('email'),
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		#echo "<pre>"; print_r($email_values);				die;
		$email_send_to_common = $this->user_model->common_email_send($email_values);
	}
	
	/*
	* 
	* Billing page for shop, insert and update the billing page
	* 
	*/
	public function shop_getpaid_details()
	{
	//echo "<pre>";print_r($this->input->post());die;
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			
			$selectSeller_details=$this->seller_model->get_sellers_data(SELLER,$condition);
			$payment_mode=implode(',', $this->input->post('payment_mode'));	
				//echo "<pre>";print_r($payment_mode);die;
			if($this->input->post('PayPal_email')!=''){
				$PayPal_mode=$this->input->post('PayPal_mode');
				$PayPal_email=$this->input->post('PayPal_email');
				$paypal_username=$this->input->post('paypal_username');
				$paypal_password=$this->input->post('paypal_password');
				$paypal_signature=$this->input->post('paypal_signature');
			}else{
				$PayPal_mode=$selectSeller_details[0]['PayPal_mode'];
				$PayPal_email=$selectSeller_details[0]['PayPal_email'];
				$paypal_username=$selectSeller_details[0]['paypal_username'];
				$paypal_password=$selectSeller_details[0]['paypal_password'];
				$paypal_signature=$selectSeller_details[0]['paypal_signature'];
			}			
			if($this->input->post('Paypal_merchant_email')!=''){
				$Paypal_merchant_email=$this->input->post('Paypal_merchant_email');
			}else{
				$Paypal_merchant_email="";
			}
			
			
			if($this->input->post('authorize_id')!=''){
				$authorize_mode=$this->input->post('authorize_mode');
				$authorize_id=$this->input->post('authorize_id');
				$authorize_key=$this->input->post('authorize_key');
			}else{
				$authorize_mode=$selectSeller_details[0]['authorize_mode'];
				$authorize_id=$selectSeller_details[0]['authorize_id'];
				$authorize_key=$selectSeller_details[0]['authorize_key'];
			}

			if($this->input->post('stripe_secret_key')!=''){
				$stripe_mode=$this->input->post('stripe_mode');
				$stripe_secret_key=$this->input->post('stripe_secret_key');
				$stripe_publish_key=$this->input->post('stripe_publish_key');
			}else{
				$stripe_mode=$selectSeller_details[0]['stripe_mode'];
				$stripe_secret_key=$selectSeller_details[0]['stripe_secret_key'];
				$stripe_publish_key=$selectSeller_details[0]['stripe_publish_key'];
			}
			
           if($this->input->post('wiretransfer_details')!=''){
				$wiretransfer_details=$this->input->post('wiretransfer_details');
					
			}else{
				$wiretransfer_details=$selectSeller_details[0]['wiretransfer_details'];
			}
           if($this->input->post('westernunion_details')!=''){
				$westernunion_details=$this->input->post('westernunion_details');
			}else{
				$westernunion_details=$selectSeller_details[0]['westernunion_details'];
			}					
			$inputArrVal=array(
							'payment_mode' => $payment_mode,
							'PayPal_mode' =>$PayPal_mode,
							'PayPal_email' => $PayPal_email,
							'Paypal_merchant_email' => $Paypal_merchant_email,
							'paypal_username' => $paypal_username,
							'paypal_password' => $paypal_password,
							'paypal_signature' => $paypal_signature,
							'authorize_mode' => $authorize_mode,
							'authorize_id' => $authorize_id,
							'authorize_key' => $authorize_key,
							'stripe_mode' => $stripe_mode,
							'stripe_secret_key' => $stripe_secret_key,
							'stripe_publish_key' => $stripe_publish_key,
							'wiretransfer_details'=>$wiretransfer_details,
							'westernunion_details'=>$westernunion_details
							
						);
			//echo '<pre>';print_r($inputArrVal);  die;
			$condition=array('seller_id' => $loggeduserID);			
			$usrdataArr = array('paypal_email'=>$PayPal_email);
			if($selectSeller_details[0]['seller_businessname']=="")
			{
				$this->product_model->commonInsertUpdate(SELLER,'insert','',$inputArrVal,$condition);
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				$this->product_model->update_details(USERS,$usrdataArr,array('id'=>$loggeduserID));
				$payment_mode_added=addslashes(artfill_lg('lg_payment_mode_added','Success! Your Shop Payment modes are Added'));
				$this->setErrorMessage('success',$payment_mode_added);
				redirect('shop/billing');		
			}
			else
			{
				$this->product_model->commonInsertUpdate(SELLER,'update','',$inputArrVal,$condition);
				
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				$this->product_model->update_details(USERS,$usrdataArr,array('id'=>$loggeduserID));
				$this->setErrorMessage('success','Success! Your Shop Payment modes are Updated');
				redirect('shop/billing');
			}
			
				       			
		}
	}
	
	
	/*
	* 
	* Shop template setting Background
	* 
	*/
	public function shop_template_setting_background()
	{
		if ($this->checkLogin('U')!=''){
			$this->data['SellerVal'] = $this->seller_model->get_userselldetail_data('*',$this->checkLogin('U'));
			$this->data['userVal'] = $this->seller_model->get_userdetail_data('facebook,twitter,google,pinterest,thumbnail,location,full_name');
			//echo '<pre>'; print_r($this->data['SellerVal']); die;
			$this->data['meta_title'] = $this->data['heading'] = 'Shop Setup';
			$this->load->view('site/shop/shop_template_layout.php',$this->data);
			
		}else {
			$this->data['next'] = $this->input->get('next');
			$this->data['meta_title'] = $this->data['heading'] = 'Sigin'; 
			$this->load->view('site/user/signup.php',$this->data);
		}
	}
	

	/*
	* 
	* Seller Store view form
	* 
	*/ 
	public function seller_store_view(){
		 $sellerstore_id = $this->uri->segment(2, 0); 
		 
		 
		 $cat_idname = $this->uri->segment(3, 0); 
	//echo $cat_id; die;
	
	//print_r($cat_idname); die;
	
		 $seller_idexplopde = @explode('-',$sellerstore_id);
		 
		 $seller_id = $seller_idexplopde[0];
		// print_r($seller_id); die;
		$cat_idnameexplopde = @explode('-',$cat_idname);

		$cat_id = $cat_idnameexplopde[0];
		
		//echo $cat_id; die;
		 $this->data['userVal'] = $this->seller_model->get_userselldetail_data('shop_template,seller_businessname,seourl,seller_firstname,seller_id,seller_store_image,seller_email,seller_social_icons',$seller_id);
		 $this->data['userpersonalVal'] = $this->seller_model->get_userdetail_datastore('full_name,city,thumbnail,facebook,twitter,google,pinterest,web_url',$seller_id);
		//echo $this->data['userVal'][0]['shop_template']; die;
		//echo $this->db->last_query(); die;
		$this->data['meta_title'] = $this->data['heading'] = $this->data['userVal'][0]['seller_businessname'];

		    $searchPerPage = 2;
		    $paginationNo = $this->uri->segment('2');  
	     
			if($paginationNo == '')
			{
					$paginationNo = 0;
			}
			else
			{
					$paginationNo = $paginationNo;
			}
			
		$this->data['productVal'] = $this->product_model->get_storedetail_data_store('id,seourl,product_name,sale_price,image,product_featured,user_id',$cat_id,$searchPerPage,$paginationNo,$seller_id);
		
		//echo $this->db->last_query(); die;
		//echo $this->data['productVal'][0]['product_name']; die;
		
		
		
		$this->data['catVal'] = $catVal = $this->product_model->view_cat_details($cat_id);
		if($this->data['catVal'][0]['cat_name'] != ''){
		    $this->data['heading'] = $this->data['catVal'][0]['cat_name'];
			$this->data['meta_title'] = $this->data['catVal'][0]['meta_title'];
			$this->data['meta_keyword'] = $this->data['catVal'][0]['seo_keyword'];
			$this->data['meta_description'] = $this->data['catVal'][0]['seo_description'];
			}
		//echo $this->db->last_query(); die;
		//echo $this->data['catVal']; die;
		if($this->data['userVal'][0]['shop_template'] == 'four'){
		$limit = '4';
		}else {
		
		$limit = '3';
		}
		$this->data['featured'] = $this->product_model->get_storedetail_data_storefeature('id,seourl,product_name,sale_price,image,product_featured,user_id',$cat_id,$searchPerPage,$paginationNo,$seller_id,$limit);
		//echo $this->db->last_query(); die;
		
		$searchbaseUrl = base_url().$this->uri->segment('1').'/';
			$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/page_prevt_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/page_next.png" />';
			$config['base_url'] = $searchbaseUrl;
			$config['total_rows'] = count($blogTotal); 
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 2;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			 $paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
			
			//echo $this->data['catVal'][0]['cat_name']; die;
			
			/*$this->data['meta_keyword'] = $this->data['catVal'][0]['seo_keyword'];
			$this->data['meta_description'] = $this->data['catVal'][0]['seo_description'];*/
	//	echo '<pre>';
	//	print_r($this->data['userVal']); die;
		$this->load->view('site/shop/shop_display.php',$this->data);
			
	}
	
	/*
	* 
	* Shop Feedback view form
	* 
	*/
	public function feedback_store_view(){
		
		 $sellerstore_id = $this->uri->segment(2, 0); 
		 

		 $cat_idname = $this->uri->segment(3, 0); 
		 $seller_idexplopde = @explode('-',$sellerstore_id);
		 
		 $seller_id = $seller_idexplopde[0];
		$cat_idnameexplopde = @explode('-',$cat_idname);

		$cat_id = $cat_idnameexplopde[0];
		
		 $this->data['userVal'] = $this->seller_model->get_userselldetail_data('shop_template,id,seller_businessname,seourl,seller_firstname,seller_id',$seller_id);
				 $this->data['userpersonalVal'] = $this->seller_model->get_userdetail_datastore('full_name,city,thumbnail',$seller_id);

				$this->data['productVal'] = $this->product_model->get_storedetail_data_store('id,seourl,product_name,sale_price,image,product_featured,user_id',$cat_id,$searchPerPage,$paginationNo,$seller_id);

		
		$this->load->view('site/shop/shop_feedback.php',$this->data);
			
	}		
	
	/*
	* 
	* Add Feedback form for Store feedback
	* 
	*/
	public function store_all_feedback() 
	{
			$searchPerPage = 1;
			
		    $paginationNo = $this->uri->segment('3');  

			if($paginationNo == '')
			{
				$paginationNo = 0;
			}
			else
			{
				$paginationNo = $paginationNo;
			}

	
	    $shopDetails = $this->uri->segment(2);
		$a = explode("-",$shopDetails);
		$shopId = $a[0]; 

	    $this->data['FeedbackDetails'] = $a = $this->seller_model->get_shop_feedback($shopId,$searchPerPage,$paginationNo); 
	     //print_r($a); die; 
	    $this->load->view('site/user/shop_all_feedback.php',$this->data);
}

	/*
	* 
	* Ajax Image Upload Shop Banner
	* 
	*/
	public function upload_product_image_banner(){
		$returnStr['status_code'] = 0;
		$config['overwrite'] = FALSE;
    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
//	    $config['max_size'] = 2000;
	    $config['upload_path'] = './images/store-banner';
	    $this->load->library('upload', $config);
		if ( $this->upload->do_upload('thefile')){
	    	$imgDetails = $this->upload->data();
	    	$returnStr['image']['url'] = base_url().'images/store-banner/'.$imgDetails['file_name'];
	    	$returnStr['image']['width'] = $imgDetails['image_width'];
	    	$returnStr['image']['height'] = $imgDetails['image_height'];
	    	$returnStr['image']['name'] = $imgDetails['file_name'];
			
			//$this->ImageResizeWithCrop(760, 100, $imgDetails['file_name'], './images/store-banner/');
			$this->ImageResizeWithCrop(1000, 315, $imgDetails['file_name'], './images/store-banner/');
			
	    	//$this->ImageResizeWithCrop(1000, 108, $imgDetails['file_name'], './images/store-banner/');
			//@copy('./images/store-banner/'.$imgDetails['file_name'], './images/store-banner/thumb/'.$imgDetails['file_name']);
			//$this->ImageResizeWithCrop(780, 108, $imgDetails['file_name'], './images/store-banner/thumb/');
			
			$fileDetails = 	$imgDetails['file_name'];
			
			$this->seller_model->update_details(SELLER,array('seller_store_image'=>$fileDetails),array('seller_email'=>$this->session->userdata('shopsy_session_user_email')));
			
	    	$returnStr['status_code'] = 1;
		}else {
			$returnStr['message'] = "Can\'t be upload";
		}
		echo json_encode($returnStr);
	}
	
	/*
	* 
	* Ajax Image Upload Shop profile image
	* 
	*/
	public function upload_product_image_profile(){
		$returnStr['status_code'] = 0;
		$config['overwrite'] = FALSE;
    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
//	    $config['max_size'] = 2000;
	    $config['upload_path'] = './images/users';
	    $this->load->library('upload', $config);
		if ( $this->upload->do_upload('thefile')){
	    	$imgDetails = $this->upload->data();
	    	$returnStr['image']['url'] = base_url().'images/users/'.$imgDetails['file_name'];
	    	$returnStr['image']['width'] = $imgDetails['image_width'];
	    	$returnStr['image']['height'] = $imgDetails['image_height'];
	    	$returnStr['image']['name'] = $imgDetails['file_name'];
	    	$this->ImageResizeWithCrop(600, 600, $imgDetails['file_name'], './images/users/');
			//@copy('./images/store-banner/'.$imgDetails['file_name'], './images/store-banner/thumb/'.$imgDetails['file_name']);
			//$this->ImageResizeWithCrop(780, 108, $imgDetails['file_name'], './images/store-banner/thumb/');
			
			$fileDetails = 	$imgDetails['file_name'];
			
			$this->seller_model->update_details(USERS,array('thumbnail'=>$fileDetails),array('id'=>$this->checkLogin('U')));
			
	    	$returnStr['status_code'] = 1;
		}else {
			$returnStr['message'] = "Can\'t be upload";
		}
		echo json_encode($returnStr);
	}	
	
	/*
	* 
	* Social media update for shop banner page
	* 
	*/
	public function socialmediaupdate(){
		
		//echo '<pre>'; print_r($_POST); die;
		
		$this->seller_model->update_details(USERS,array($this->input->post('id')=>$this->input->post('idval')),array('id'=>$this->checkLogin('U')));
		return 1;
		
	}
	
	/*
	* 
	* Store set up Page 
	* 
	*/
	public function storesetupfirstpage(){
		
		$dataArrVal = array();
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArr[$key] = trim(addslashes($val));
			}
		}
		
		$condition =array('seller_id'=>$this->checkLogin('U'));
		$this->seller_model->update_details(SELLER,$dataArr,$condition);
		$this->setErrorMessage('success','Store Setup Successfully Updated.');
		return 1;
		
	}
	
	/*
	* 
	* Ajax select for shipping country list from add shop list items 
	* 
	*/
	public function load_ajax_shipping_list($i,$selected_country=''){	 
		
		$selected_countryArr=explode(':',urldecode($selected_country));
		#print_r($selected_country); die;
		$selected_countryArr[1]; #die;
		$countryList= $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		echo '<tr id="tab_'.$i.'"><td><p id="shipping_to_'.$i.'_lab" ></p><select name="shipping_to[]" id="shipping_to_'.$i.'" class="shipping_to" style="width:200px; padding: 3px 4px; box-shadow: none; margin: 0px; border: 1px solid rgb(205, 205, 205);" onchange="display_sel_val(this); toggleDisability(this);">';
		echo '<option value="">Select a location</option>';
		foreach($countryList as $country) 
		{
			if (in_array($country->name,$selected_countryArr, TRUE)){ echo'<option value="'.$country->name.'" disabled>'.$country->name.'</option>';}
			else{echo'<option value="'.$country->id.'|'.$country->name.'">'.$country->name.'</option>';}			
		}			
		echo '</select><input type="hidden" name="ship_to_id[]" id="shipping_to_'.$i.'_id" />
		</td>
		<td><input type="text" value="" placeholder="'.$this->data['dcurrencySymbol'].':" class="form-control shipping_txt_bax"  name="shipping_cost[]" id="shipping_cost_'.$i.'"></td>
		<td><input type="text" value="" placeholder="'.$this->data['dcurrencySymbol'].':" class="form-control shipping_txt_bax"  name="shipping_with_another[]" id="shipping_with_another_'.$i.'"></td>
		<td><a class="close_icon left" onClick="close_shipping('.$i.')" href="javascript:void(0)" style="margin:7px 0 0 5px" id="'.$i.'"></a></td>
		</tr>
		';
	}
	
	/*
	* 
	* Ajax select for shipping country list from add shop list items 
	* param String $filename
	* 
	*/
	public function load_ajax_DigiFiles_list($filename){	 		
							$id=time();
							$path = "temp_digital_files/";
								echo '<tr>
                                	<td width="70%"> 
                                    	&nbsp;
										<a href="'.$path.$filename.'" target="_blank">'.$filename.'</a>
                                        <input type="hidden" value="'.$filename.'" class="DigiFiles" name="DigiFiles[]">
                                     </td>
                                    <td width="26%">
                                        <a class="close_icon" href="javascript:void(0);" style="margin:7px 0 0 5px" id="'.$id.'" onclick ="digitalfile_remove(this);"></a>
                                    </td>
                                </tr>';
	}
	
	/*
	* 
	* Ajax load file shop products
	* 
	*/
	public function ajax_load_Files(){	
		$errors='';$ext ="";
		$maxsize    = 2097152; #1048576 Bytes for 1MB
		$acceptable = array('gif','png' ,'jpg', 'bmp','doc','docx','txt','rtf','csv','ppt','pps','pptx','pdf','xls','rar','zip','tar.gz','mp3','wav','wma','3gp','avi','flv','mov','mp4','mpg','rm');
		$filename = $_FILES['file_upload']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(($_FILES['file_upload']['size'] >= $maxsize) || ($_FILES["file_upload"]["size"] == 0)) {
			$errors= 'File too large. File must be less than 2 megabytes.';
		}else if(!in_array($ext, $acceptable) || $ext=="") {
			$errors= 'Invalid file type.';
		}
		if($errors=='') {
			$path = "temp_digital_files/";		
			$file = preg_replace('/\s+/', '_',$_FILES["file_upload"]["name"]);		
			if($_FILES["file_upload"]["name"] != ''){
				move_uploaded_file($_FILES["file_upload"]["tmp_name"], $path.$file);
				echo "Success|".$file;
			}
		}else{
			echo "Errors|".$errors;
		}
	}
	
	/*
	* 
	* Shop appearance settings display
	* 
	*/
	public function shop_appearance_setting()
	{
		if ($this->checkLogin('U')!='')
		{
			if ((preg_match("/^[^\W_]+$/", $this->input->post('seller_businessname'))) != 1){
                                $this->setErrorMessage('error',$special_characters_not_allowed);
				redirect('appearance/returned/banner');	
                        }
// 			echo "<pre>"; print_r($_POST);
// 			print_r($_FILES);
// 			if ( $this->upload->do_upload('file'))
// 			{
// 				$imgDetails = $this->upload->data();
// 				$returnStr['image']['url'] = base_url().'images/store-banner/'.$imgDetails['file_name'];
// 				$returnStr['image']['width'] = $imgDetails['image_width'];
// 				$returnStr['image']['height'] = $imgDetails['image_height'];
// 				$returnStr['image']['name'] = $imgDetails['file_name'];
			
// 				//$this->ImageResizeWithCrop(760, 100, $imgDetails['file_name'], './images/store-banner/');
// 				$this->image_crop_process_auto(760, 100, $_POST['left'], $_POST['top'], $_POST['width'], $_POST['height'], $imgDetails['file_name'], './images/store-banner/');
			
// 				$fileDetails = 	$imgDetails['file_name'];
			
// 			}
			
			
// 			print_r($imgDetails);
// 			echo $fileDetails;
			
// 			die;
			
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];			
			$selectSeller_details=$this->seller_model->get_sellers_data(SELLER,$condition);
												
			if(count($selectSeller_details) == 1)  // if count 1 means user details exist in seller table,so we need to update the details else  need to insert details
			{
				$seourl = url_title(strip_tags($this->input->post('seller_businessname')), '-', TRUE);
				//$seourl = htmlentities($this->input->post('seller_businessname'));
				$checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
				$seo_count = 1;
				while ($checkSeo->num_rows()>0)
				{
					$seourl = $seourl.'-'.$seo_count;
					$seo_count++;
					$checkSeo = $this->product_model->get_all_details(SELLER,array('seourl'=>$seourl,'seller_id !='=>$loggeduserID));
				}
				$inputArrval1=array(
						'country' =>$this->input->post("country")
				);
				$this->db->where(array("id"=>$loggeduserID));
				$this->db->update(USER,$inputArrval1);
				// kethen was here, enabling Chinese shop names 25/1/2016
				// $seller_businessname =  strip_tags($this->input->post('seller_businessname'));
				$seller_businessname =  htmlentities($this->input->post('seller_businessname'));
				#echo $seller_businessname;die;
				if($seller_businessname == "" ){
					$shop_appreance=addslashes(artfill_lg('lg_shop_appreance_error','Please Check with your Shop Name'));
					$this->setErrorMessage('error',$shop_appreance);
					redirect('shop/sell');
				}
				// $seller_businessname = preg_replace("/[^A-Za-z0-9_\-]/", '', $seller_businessname);
				if($seller_businessname == "")
				{	
					$shop_appreance=addslashes(artfill_lg('lg_shop_appreance_error','Please Check with your Shop Name'));
					$this->setErrorMessage('error',$shop_appreance);
					redirect('shop/sell');
				}
				$data_to_update=array('seller_businessname' =>addslashes($seller_businessname),'seourl' => $seourl);
				//$data_to_update=array('seller_businessname' =>addslashes($seller_businessname),'seourl' => $seller_businessname);
				//print_r($data_to_update);die;
				$this->db->where(array('seller_id' => $loggeduserID));
				$this->db->update(SELLER,$data_to_update);
			
			}
			
			$shop_title=strip_tags ($this->input->post('shop_title'));
			
			$shop_banner=$this->input->post('shop_banner');
			if($this->input->post('local_markets')){$local_markets="Yes";} else{$local_markets="No";}
			$shop_announcement=strip_tags($this->input->post('shop_announcement'));
			$msg_to_buyers=strip_tags($this->input->post('msg_to_buyers'));
			$msg_to_buyers_for_digiitem=strip_tags($this->input->post('msg_to_buyers_for_digiitem'));
			
			
			$fb_link=$this->input->post('fb_link');
			$twitter_link=$this->input->post('twitter_link');
			
			
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			#$config['max_size'] = 2000;
			$config['upload_path'] = './images/store-banner';
			$this->load->library('upload', $config);
			
			//if ( $this->upload->do_upload('shop_banner'))
			if ( $this->upload->do_upload('file'))
			{
				$imgDetails = $this->upload->data();
				$returnStr['image']['url'] = base_url().'images/store-banner/'.$imgDetails['file_name'];
				$returnStr['image']['width'] = $imgDetails['image_width'];
				$returnStr['image']['height'] = $imgDetails['image_height'];
				$returnStr['image']['name'] = $imgDetails['file_name'];
				
				//$this->ImageResizeWithCrop(760, 100, $imgDetails['file_name'], './images/store-banner/');
				//$this->image_crop_process_auto(760, 100, $_POST['left'], $_POST['top'], $_POST['width'], $_POST['height'], $imgDetails['file_name'], './images/store-banner/');
				$this->image_crop_process_auto(1000, 315, $_POST['left'], $_POST['top'], $_POST['width'], $_POST['height'], $imgDetails['file_name'], './images/store-banner/');
				
				$fileDetails = 	$imgDetails['file_name'];
				
			}
			
				if($fileDetails==""){
						$inputArrVal=array(
							'shop_title' => $shop_title,
							'local_markets' => $local_markets,
							'shop_announcement' => $shop_announcement,
							'msg_to_buyers' => $msg_to_buyers,
							'msg_to_buyers_for_digiitem' => $msg_to_buyers_for_digiitem,
							'facebook_link' => $fb_link,
							'twitter_link' => $twitter_link
						);
				}
				else{
						$inputArrVal=array(
							'shop_title' => $shop_title,
							'seller_store_image' => $fileDetails,
							'local_markets' => $local_markets,
							'shop_announcement' => $shop_announcement,
							'msg_to_buyers' => $msg_to_buyers,
							'msg_to_buyers_for_digiitem' => $msg_to_buyers_for_digiitem,
							'facebook_link' => $fb_link,
							'twitter_link' => $twitter_link
						);			
				}
				
				$condition=array('seller_id' => $loggeduserID);
			
				$this->product_model->commonInsertUpdate(SELLER,'update',array('shop-banner','fb_link','left','top','width','height'),$inputArrVal,$condition);
				#echo $this->db->last_query()."<br>";die;
				
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				
				//print_r($this->data['selectSeller_details']); die;
				$shop_appreance=addslashes(artfill_lg('lg_shop_appreance_updated','Success! Your Shop Apperances Updated'));
				$this->setErrorMessage('success',$shop_appreance);
				redirect('shop/sell');
				       			
		}
	}
	
	
	/*
	* 
	* Shop Policy settings display
	* 
	*/
	public function shop_policy_setting()
	{
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];			
												
			
			$welcome_message=$this->input->post('welcome_message');
			$payment_policy=$this->input->post('payment_policy');
			$shipping_policy=$this->input->post('shipping_policy');
			$refund_policy=$this->input->post('refund_policy');
			$additional_information=$this->input->post('additional_information');
			$seller_information=$this->input->post('seller_information');
			
						$inputArrVal=array(
							'welcome_message' => $welcome_message,
							'payment_policy' => $payment_policy,
							'shipping_policy' => $shipping_policy,
							'refund_policy' => $refund_policy,
							'additional_information' => $additional_information,
							'seller_information' => $seller_information
						);			
				
				$condition=array('seller_id' => $loggeduserID);
			
				$this->product_model->commonInsertUpdate(SELLER,'update','',$inputArrVal,$condition);
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				$policy_update=addslashes(artfill_lg('lg_Success_Your_Shop_Policy_Updated','Success! Your Shop Policy Updated'));
				$this->setErrorMessage('success',$policy_update);
				redirect('shop/sell');
			
				       			
		}
	}
	
	/*
	* 
	* Add shop section list
	* 
	*/
	public function add_shop_section_list()
	{
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
						
			$section_name=$this->input->post('name');
			
			$section_id=time();			
			
				$dataArr=array(
					'seller_id' =>$loggeduserID,
					'section_name' => $section_name,
					'section_id' => $section_id,
				);			
				
				$condition=array('seller_id' => $loggeduserID);
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SHOP_SECTION_LIST,$condition);
				if($section_name.trim()==''){
					$this->setErrorMessage('error','Section name cannot be empty');
					redirect('shops/'.$this->data['selectSeller_details'][0]['seourl'].'/sections/All');
				}
				$this->seller_model->simple_insert(SHOP_SECTION_LIST,$dataArr);
				
				$this->setErrorMessage('success','Success! Section Created');
				redirect('shops/'.$this->data['selectSeller_details'][0]['seourl'].'/sections/'.$section_id);
			
				       			
		}
	}
	
	
	
	/*
	* 
	* Display the load shop owner profile page
	* 
	*/
	public function load_shopowner_profile(){
	
		$this->db->select("id,name");
		$this->db->from(COUNTRY_LIST);
		$this->data["data_country"]=$this->db->get();		
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		   
		$this->data['selectSeller_details']=$this->seller_model->display_seller_view_admin($loggeduserID);
		$this->load->view('site/shop/shop_owner',$this->data);
	}
	
	/*
	* 
	* update the seller profile page
	* 
	*/
	public function update_seller_profile(){
		if ($this->checkLogin('U')==''){
			$this->setErrorMessage('error','You must login');
			redirect('login');
		}
			 $city=addslashes(strip_tags(trim($this->input->post('city'))));
			 $country=addslashes(strip_tags(trim($this->input->post('country'))));
			 $about=addslashes(strip_tags(trim($this->input->post('about'))));
			 
			 if($_FILES['profile_pict']['name']!=""){
				$config['overwrite'] = FALSE;
	    		$config['allowed_types'] = 'jpg|jpeg|gif|png';
	    		$config['upload_path'] = 'images/users';
		    	$this->load->library('upload', $config);
			 	if ($this->upload->do_upload('profile_pict')){
		   			$logoDetails = $this->upload->data(); 
		    		$this->ImageResizeWithCrop(600, 600, $logoDetails['file_name'], './images/users/');
					@copy('./images/users/'.$logoDetails['file_name'], './images/users/thumb/'.$logoDetails['file_name']);
		    		$this->ImageResizeWithCrop(210, 210, $logoDetails['file_name'], './images/users/thumb/');
			 		$profile_image=$logoDetails['file_name'];
				 	$dataArr=array('city'=>$city,'country'=>$country,'about'=>$about,'thumbnail'=>$logoDetails['file_name']);
			 	}
			 	else{
				$problem=addslashes(artfill_lg('lg_problem','There was a problem with your image'));
					$this->setErrorMessage('error',$problem);
			 		redirect("public-profile");
				}
			}else{
				$dataArr=array('city'=>$city,'country'=>$country,'about'=>$about);
			}
			
			$this->seller_model->update_details(USERS,$dataArr,array('id'=>$this->checkLogin('U')));
			if($this->db->affected_rows()>0){
			$updation=addslashes(artfill_lg('lg_updation','Your profile successfully updated'));
				$this->setErrorMessage('success',$updation);
			 	redirect("shops/".$this->uri->segment(2, 0)."/profile");	
			}else{
			  $no_updation=addslashes(artfill_lg('lg_no_updation','No updation on your profile'));
				$this->setErrorMessage('success', $no_updation);
		 		redirect("shops/".$this->uri->segment(2, 0)."/profile");
			}
	}
	
	/*
	* 
	* Load and update the shop policies
	* 
	*/
	public function load_shop_policies(){
	
	
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		   
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		
			$this->data['userIdVal']=$loggeduserID;
		$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
		//echo '<pre>'; print_r($this->data['selectUser_details']);die;
		
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
			$this->data['shopproductfeed_details']=$shopproductfeed_details = $this->seller_model->get_shopproductfeed_details($loggeduserID)->result();
			
			if($this->data['selectSeller_details'][0]['seller_businessname']!=""){
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				#$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();	
				$product_list=$shop_sec['product_id'];
				$condition1 = " where (u.group='User' or u.group='Seller') and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." group by p.id order by p.created desc";
		
				$this->data['shopDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();				 	  
				$cond=array('seller_id' => $loggeduserID); 
				$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
				$this->data['Paidproduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Paid'));
				$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
				$this->data['shop_section_count']=count($this->data['shop_section_details']);
					
				$this->data['meta_title'] = $this->data['heading'] = 'Shop';
		}
		$this->load->view('site/shop/shop_policies',$this->data);
	}
	
	/*
	* 
	* Load the shop information and appearances
	* 
	*/
	public function load_info_appearance(){
		/*echo $this->uri->segment(2);
		echo $this->uri->segment(3); die;*/
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		
	  	$condition=array('seller_id' => $loggeduserID); 
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result();		
		$this->load->view('site/shop/shop_info_appearance',$this->data);
	}
	
	/*
	* 
	* Load the shop sections lists
	* 
	*/
	public function load_shop_sections(){
		
		$section=$this->data['section_id']= $this->uri->segment(4,0); 		
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		  
		$condition=array('seller_id' => $loggeduserID);  
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);		
		$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
		if($section=='All')
		{
			$condition1 = " where u.group='Seller' and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." group by p.id order by p.created desc";
		}
		else
		{
			foreach($this->data['shop_section_details'] as $shop_sec)
			{
				if($shop_sec['section_id']==$section)
				{
					$product_list=$shop_sec['product_id'];
					$condition1 = " where u.group='Seller' and FIND_IN_SET(p.id,'".$product_list."') and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." and FIND_IN_SET(p.id,'".$product_list."') group by p.id order by p.created desc";
				}
			}
		}
		
		$this->data['productDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();
		#echo $this->db->last_query(); die;
		#echo "<pre>"; print_r($this->data['productDetail']); die;		
		$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
		$this->data['shop_section_list']=$this->seller_model->get_sellers_data(SHOP_SECTION_LIST,$condition);
		$this->data['shop_section_count']=count($this->data['shop_section_list']);
		$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
		$this->load->view('site/shop/shop_sections',$this->data);
	}
	
	/*
	* 
	* Delete the shop sections
	* 
	*/
	public function delete_shop_sections(){
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$status=$this->input->post('status');
			$section=$this->input->post('section');
			$name=$this->input->post('name');
				$CondArr=array(
					'seller_id' => $loggeduserID,
					'section_id' => $section,
				);			
			$this->seller_model->commonDelete(SHOP_SECTION_LIST,$CondArr);
			$this->setErrorMessage('success','Successfully deleted the section "'.$name.'"');
			redirect('site/shop/load_shop_sections');		
				       			
		}
		
	}
	
	/*
	* 
	* Edit the shop section 
	* 
	*/
	public function edit_shop_section(){
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			
			$section=$this->input->post('section');
			$name=$this->input->post('name');
			if($name.trim()==''){
				$this->setErrorMessage('error','Section name cannot be empty');
				redirect('site/shop/load_shop_sections');
			}
			$dataArr = array('section_name' => $name);
			$condition=array('seller_id' => $loggeduserID,'id' => $section);
			$this->seller_model->shopSectionUpdate(SHOP_SECTION_LIST,$condition,$dataArr);
			#echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Successfully Updated the section "'.$name.'"');
			redirect('site/shop/load_shop_sections');		
				       			
		}
		
	}
	
	/*
	* 
	* Edit the shop section List
	* 
	*/
	public function edit_shop_sections_list(){
		if ($this->checkLogin('U')!='')
		{
			$checkloginIDarr=$this->session->all_userdata(); 
			$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];
			$condition=array('seller_id' => $loggeduserID); 
			$Seller_details=$this->seller_model->get_sellers_data(SELLER,$condition);
			$seourl=$Seller_details[0]['seourl'];
			
			$old_sec_id=$this->input->post('old_sec_id');
			$old_sec_prod=$this->input->post('old_sec_prod');
			$old_sec_count=$this->input->post('old_sec_count');
			
			$new_sec_id=$this->input->post('new_sec_id');
			$new_sec_prod=$this->input->post('new_sec_prod');
			$new_sec_count=$this->input->post('new_sec_count');
			
			if($old_sec_id!='All')
			{
				/*Get the Existing products in new Section List*/
				$newList= $this->product_model->get_all_details(SHOP_SECTION_LIST,array('seller_id' => $loggeduserID,'section_id' => $new_sec_id))->result_array();
				$new_sec_prod.=$newList[0]['product_id'];
				$new_sec_count=$new_sec_count+$newList[0]['shop_prod_count'];
				$dataArr = array('product_id' => $old_sec_prod,'shop_prod_count'=>$old_sec_count);
				$condition=array('seller_id' => $loggeduserID,'section_id' => $old_sec_id);
				$this->seller_model->shopSectionUpdate(SHOP_SECTION_LIST,$condition,$dataArr);
				#Update product into new list			
				$dataArr = array('product_id' => $new_sec_prod,'shop_prod_count'=>$new_sec_count);
				$condition=array('seller_id' => $loggeduserID,'section_id' => $new_sec_id);
				$this->seller_model->shopSectionUpdate(SHOP_SECTION_LIST,$condition,$dataArr);
			}
			else
			{
				$prod=explode(',',$new_sec_prod);
				$newProd=explode(',',$new_sec_prod);
				for($i=0;$i<count($prod)-1;$i++)
				{
					$oldList= $this->product_model->shop_section_list_exist($loggeduserID,$prod[$i]);
					$old_sec_prod=str_replace($prod[$i].',','',$oldList[0]['product_id']);
					$old_sec_count=$oldList[0]['shop_prod_count']-1;
					$dataArr = array('product_id' => $old_sec_prod,'shop_prod_count'=>$old_sec_count);
					$condition=array('seller_id' => $loggeduserID,'section_id' => $oldList[0]['section_id']);
					$this->seller_model->shopSectionUpdate(SHOP_SECTION_LIST,$condition,$dataArr);
					/*Get the Existing products in new Section List*/
					$newList= $this->product_model->get_all_details(SHOP_SECTION_LIST,array('seller_id' => $loggeduserID,'section_id' => $new_sec_id))->result_array();
					$new_sec_prod=$newList[0]['product_id'].$newProd[$i].',';
					$new_sec_count=$newList[0]['shop_prod_count']+1;
					#Update product into new list			
					$dataArr = array('product_id' => $new_sec_prod,'shop_prod_count'=>$new_sec_count);
					$condition=array('seller_id' => $loggeduserID,'section_id' => $new_sec_id);
					$this->seller_model->shopSectionUpdate(SHOP_SECTION_LIST,$condition,$dataArr);
				}
			}
			/*$this->setErrorMessage('success','Successfully moved "'.$new_sec_count.'" listing');
			redirect('shops/'.$seourl.'/sections/'.$new_sec_id);	*/	
		}
		
	}

	/*
	* 
	* Add product preview listing page
	* param String $seourl
	* 
	*/
	public function Preview($seourl){
		if ($this->checkLogin('U')!='' || $this->checkLogin('A')== 1){
			$dataArr=$this->data['preview_item_detail']=$this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl))->result_array();     
			$variation=$this->product_model->get_subproductdetail_Group(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id']),'attr_name');
	        $this->data['added_item_details']=$dataArr;
			if(count($variation)==0)
			{
				$this->data['variations_one']="";
				$this->data['variations_two']="";
			}
			if(count($variation)==1)
			{
				$this->data['variations_one']=$variation[0]['attr_name'];
				$this->data['variations_two']="";
				$this->data['variations_one_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[0]['attr_name']))->result_array();
			}
			if(count($variation)==2)
			{
				$this->data['variations_one']=$variation[0]['attr_name'];
				$this->data['variations_two']=$variation[1]['attr_name'];
				$this->data['variations_one_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[0]['attr_name']))->result_array();
				$this->data['variations_two_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[1]['attr_name']))->result_array();
			}
			$this->data['shipping_details']=$this->seller_model->get_all_details(SUB_SHIPPING,array('product_id'=> $this->data['preview_item_detail'][0]['id']))->result_array();
			#echo "<pre>"; print_r($this->data['shipping_details']); die;
 			$this->data['selectedSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());	
			$this->load->view('site/shop/listitem_preview',$this->data);
		}			
	}
	
	/*
	* 
	* Check the shop name duplicate function 
	* 
	*/
 function Load_ajax_shopName_check(){  
 //echo $this->input->get('s_name').'ccc'; die;
	 if($this->input->get('s_name') != ''){
	 $getShopname=$this->seller_model->get_shop_name($this->input->get('s_name'));
		 if($getShopname->num_rows() == 0) {
			 echo 'not exist';
		 } else {
		    echo 'exist';
		 }
	 }
 }
 
	/*
	* 
	* Check the ajax gift card status
	* 
	*/
  function ajax_gift_card_status(){  
	 if($this->input->get('status') == 1){
		$status='Yes';
	 } else {
		$status='No';
	 } 
	 $this->seller_model->update_details(SELLER,array('gift_card'=>$status),array('seller_id'=>$this->input->get('sell_id')));	 
	 
  }
  
  
	/*
	* 
	* Promote Shop in Shopsy
	* 
	*/
  public function promote_shop(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
		
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		   
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		$this->data['Seller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);

		
		$this->data['userIdVal']=$loggeduserID;
		$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
		//echo '<pre>'; print_r($this->data['selectUser_details']);die;
		
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
			$this->data['shopproductfeed_details']=$shopproductfeed_details = $this->seller_model->get_shopproductfeed_details($loggeduserID)->result();
			
			if($this->data['selectSeller_details'][0]['seller_businessname']!=""){
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				#$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();	
				$product_list=$shop_sec['product_id'];
				$condition1 = " where (u.group='User' or u.group='Seller') and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." group by p.id order by p.created desc";
		
				$this->data['shopDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();				 	  
				$cond=array('seller_id' => $loggeduserID); 
				$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
				$this->data['Paidproduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Paid'));
				$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
				$this->data['shop_section_count']=count($this->data['shop_section_details']);
					
				$this->data['meta_title'] = $this->data['heading'] = 'Promote Shop';
		}
		
			   
			$this->data['heading'] = 'Promote Shop';  
			$this->load->view('site/shop/promote_shop',$this->data);
			
		}
	}
	
	/*
	* 
	* insert / update the shop banner
	* 
	*/
	public function insertShopBanner(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {			
			
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 10000;
			$config['upload_path'] = './images/banner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('image')){
				$imgDetails = $this->upload->data();
				$ImageName = $imgDetails['file_name'];
				$this->ImageResizeWithCrop(1400, 400, $imgDetails['file_name'], './images/banner/');
			}else{
				$imgDetails = $this->upload->display_errors();
				$this->setErrorMessage('error',strip_tags($imgDetails));
				redirect('site/shop/promote_shop');
			}
			$dataArr = array('seller_banner' => $ImageName);
				$condition=array('seller_id'=>$this->checkLogin('U'));
				$this->seller_model->update_details(SELLER,$dataArr,$condition);	
				$this->setErrorMessage('success','Banner Updated successfully for your shop');
						
			redirect('site/shop/promote_shop');
		}
	}
	
	/*
	* 
	* Change the shop as featured or not using ajax
	* 
	*/
	function change_featuredShop_ajax(){
		if($this->input->get('fstatus') == '1'){
			$status='Yes';
		}else {
		  $status='No';
		}
	$this->seller_model->update_details(SELLER,array('featured_shop' => $status),array('seller_id' => $this->input->get('shop_id')));
	echo $this->db->last_query();
	}
	
	/*
	* 
	* Display the shop favorites
	* param String $seourl
	* 
	*/
	public function display_shop_favoriters($seourl){
	
		$this->data['shopInfo']=$shopInfo=$this->seller_model->get_shop_owner_detail($seourl)->result_array();
		$this->data['favUserList']=$favUserList=$this->product_model->getShopFavDetails($shopInfo[0]['seller_id']);
		#echo $this->db->last_query(); die;
		#echo "<pre>"; print_r($shopInfo); die;
		if (count($favUserList)>0){
			foreach ($favUserList as $favUser){
				$this->data['favoritersUserfavDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id']);
				$this->data['favoritersUserfavProdDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id'])->result_array();
			}
		}
		#echo "<pre>"; print_r($this->data['favoritersUserfavDetails']);die;
		$condition = array('id'=>$this->checkLogin('U'));
		$this->data['userProfileDetails'] = $this->product_model->get_all_details(USERS,$newdata,$condition)->result_array();
		$this->data['title'] = 'People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');
		$this->data['meta_title'] ='People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');	
		$this->data['meta_description'] =$currentcatDetails->seo_description;   	
		
		$this->load->view('site/shop/shop_favorites',$this->data);
	}
	
	/*
	* 
	* Contact Reviewer popup function
	* 
	*/
	public function contactReviewer(){
	
		$reviewer_id = $this->input->post('reviewer_id'); 
		$review_id = $this->input->post('review_id'); 
		$reporter_id = $this->input->post('reporter_id');
		
/* 		$userPurchase=$this->user_model->get_user_purchase_list($reviewer_id,$orderId);
		$purchaseProducts=$userPurchase->result(); */
		
		$reviewerVal = $this->user_model->get_all_details(USERS,array( 'id' => $reviewer_id));	
		$reporterVal = $this->user_model->get_all_details(USERS,array( 'id' => $reporter_id));	
		
		$popupVal = '<form method="post" action="site/shop/reportReview" onsubmit="return rattingValidation();">
		<div class="conversation" style="background:#fff;border-radius:8px;"> 
        	
            <div style="padding:20px;" class="conversation_container">
                <h2 class="conversation_headline">Report This Review.</h2>
                <div class="conversation_right">
                	<input type="hidden" name="reporter_id" id="reporter_id" value="'.$reporterVal->row()->id.'" />
                    <input type="hidden" name="reporter_email" id="reporter_email" value="'.$reporterVal->row()->email.'" />
                    <input type="hidden" name="reviewer_id" id="reviewer_id" value="'.$reviewerVal->row()->id.'" />
                    <input type="hidden" name="reviewer_email" id="reviewer_email" value="'.$reviewerVal->row()->email.'" />
                    <input type="hidden" name="review_id" id="review_id" value="'.$review_id.'" />
                    <textarea class="conversation-textarea" rows="8" name="description" id="description" placeholder="Message text" style="width:100%; margin:10px 0;"></textarea>
					<span id="descriptionErr" style="color:red;"></span>
                </div>
				
				<div class="modal-footer footer_tab_footer">
					<div class="btn-group">
						<input class="resending submit_btn" type="submit" value="Report">
						<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">Cancel</a>
					</div>
				</div>
				
				
            </div>
           
            
        </div>
		
		
		</form>';	
		
		echo $popupVal;		
		
		return;
	
	}
	
	/*
	* 
	* Report insert function
	* 
	*/
	public function reportReview(){
		if ($this->checkLogin('U') != ''){
			#echo ""; print_r($_POST); die;
			$this->user_model->commonInsertUpdate(REPORT_REVIEW,'insert',array(),array(),'');
			$this->setErrorMessage('success','Your Report has been submitted Successfully!.');
			redirect('shop/reviews');
		}
	}
	
	/*
	* 
	* Check the ajax shop banner size using ajax
	* 
	*/
	public function ajax_check_shop_mainBanner_size(){
		
		if($this->input->post('shop-banner') == 'shop-banner-img') {
			//list($w, $h) = getimagesize($_FILES["shop_banner"]["tmp_name"]);
			list($w, $h) = getimagesize($_FILES["file"]["tmp_name"]);
			if($w >= 1000 && $h >= 315){
			echo 'Success';
			} else {
			echo 'Error';
			}
		}else {
	        list($w, $h) = getimagesize($_FILES["image"]["tmp_name"]);
			if($w >= 1400 && $h >= 400){
			echo 'Success';
			} else {
			echo 'Error';
			}
		}
	}
	
	/*
	* 
	* Display the shop coupon cards
	* 
	*/
	public function display_couponcards(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
		
		
			$this->data['heading'] = 'Coupon Codes List';
			$condition = array('sell_id'=>$this->checkLogin('U'));
			$this->data['couponCardsList'] = $this->user_model->get_all_details(COUPONCARDS,$condition);
			
		$checkloginIDarr=$this->session->all_userdata(); 
		$loggeduserID=$checkloginIDarr['shopsy_session_user_id'];		   
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
		$this->data['Seller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);

		
		$this->data['userIdVal']=$loggeduserID;
		$this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
		//echo '<pre>'; print_r($this->data['selectUser_details']);die;
		
		$this->data['selectUser_details']=$this->seller_model->get_all_details(USER,array('id'=>$loggeduserID))->result_array();
			$this->data['shopproductfeed_details']=$shopproductfeed_details = $this->seller_model->get_shopproductfeed_details($loggeduserID)->result();
			
			if($this->data['selectSeller_details'][0]['seller_businessname']!=""){
				$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				#$this->data['shopDetail'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();	
				$product_list=$shop_sec['product_id'];
				$condition1 = " where (u.group='User' or u.group='Seller') and u.status='Active' and p.user_id=".$loggeduserID." or p.user_id=".$loggeduserID." group by p.id order by p.created desc";
		
				$this->data['shopDetail'] =$this->product_model->view_product_details_from_section($condition1)->result_array();				 	  
				$cond=array('seller_id' => $loggeduserID); 
				$this->data['product'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID))->result_array();
				$this->data['Paidproduct'] = $this->product_model->get_all_details(PRODUCT,array('user_id' => $loggeduserID,'pay_status'=>'Paid'));
				$this->data['shop_section_details']=$this->seller_model->getShopSectionDetails($loggeduserID);
				$this->data['shop_section_count']=count($this->data['shop_section_details']);
					
				$this->data['meta_title'] = $this->data['heading'] = 'Coupon Codes List';
		}
		

			$this->load->view('site/shop/shop_couponcard',$this->data);
		}
	}
	
	/*
	* 
	* Add the shop coupon cards
	* 
	*/
	public function add_couponcard(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Add New Coupon Code';
			$this->data['code'] = $this->get_rand_str('10');			
			$condition = array('code' => $this->data['code']);
			$couponcard_details= $this->user_model->get_all_details(COUPONCARDS,$condition);
			if ($couponcard_details->num_rows() == 0){
				$this->load->view('site/shop/shop_add_couponcard',$this->data);
			}
			else{
				$this->add_couponcard();
			}
		}
	}
	
	/*
	* 
	* Edit the shop coupon cards
	* 
	*/
	public function edit_couponcard(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Edit Coupon Code';
			$id = $this->uri->segment(4);
			$condition = array('id' => $id);
			$this->data['couponcard_details'] = $this->user_model->get_all_details(COUPONCARDS,$condition);
			if ($this->data['couponcard_details']->num_rows() == 1){
				$this->load->view('site/shop/shop_edit_couponcard',$this->data);
			}else {
				redirect('home');
			}
		}
	}
	
	/*
	* 
	* Insert / update the shop coupon cards
	* 
	*/
	public function insertEditCouponcard(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$excludeArr = array("coupon_id");
			$dataArr = array();
			
			$condition = array();
			if ($this->input->post('id') == ''){
				
				$this->user_model->commonInsertUpdate(COUPONCARDS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Coupon Code added successfully');
			}else {
				
				$condition = array('id' => $this->input->post('id'));
				$dataArrVal = array();
				foreach($this->input->post() as $key => $val){
					if(!(in_array($key,$excludeArr))){
						$dataArrVal[$key] = trim(addslashes($val));
					}
				}
				$coupon_old_data=$this->user_model->get_all_details(COUPONCARDS,$condition)->row();
				$new_qty = $coupon_old_data->purchase_count + $this->input->post('quantity');
				if($new_qty >= $coupon_old_data->quantity)
				{
					$dataArry_data = array('quantity'=>$new_qty);
					$dataArr = array_merge($dataArrVal,$dataArry_data);		
					$this->user_model->commonInsertUpdate(COUPONCARDS,'update',$excludeArr,$dataArr,$condition);
					$this->setErrorMessage('success','Coupon Code updated successfully');
				}else{
					$this->setErrorMessage('error','Problem in Coupon card quantity');
				}
			}
			redirect('shops/'.$this->data['currentshopurl'].'/coupon-code');
		}
	}
	
	/*
	* 
	* Display the shop contact users
	* 
	*/
	public function display_contact_user(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = $this->uri->segment(2).' :: User Contacts';
			$condition = array('sellerid'=>$this->checkLogin('U'));
			$this->data['contactUserList'] = $this->user_model->get_all_details(CONTACTSELLER,$condition);
			$this->load->view('site/shop/shop_contact_user',$this->data);
		}
	}
	/*
	* 
	* Display the shop contact particular users
	* 
	*/
	public function view_contact_user(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = $this->uri->segment(2).' :: View Message';
			$condition = array('sellerid'=>$this->checkLogin('U'),'id'=>$this->uri->segment(4));
			$this->data['contactUserInfo'] = $this->user_model->get_all_details(CONTACTSELLER,$condition);
			$this->load->view('site/shop/shop_contact_user_message',$this->data);
		}
	}
	
	/*
	* 
	* Delete the shop contact users
	* 
	*/
	public function delete_contact_user(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->user_model->commonDelete(CONTACTSELLER,$condition);
			if($this->lang->line('cont_conf')!='') { $cont_conf= stripslashes($this->lang->line('cont_conf')); } else $cont_conf ="Contact onformation deleted successfully";
			$this->setErrorMessage('success',$cont_conf);
			redirect('shops/'.$this->uri->segment(2,0).'/contact-user');
		}
	}
	/*
	* 
	* Display the shop contact users by popup
	* 
	*/
	public function contactuserpopup(){
	if($this->lang->line('view_usr_msg_replay_to')!='') { $view_usr_msg_replay_to= stripslashes($this->lang->line('view_usr_msg_replay_to')); } else $view_usr_msg_replay_to ="Replay to ";
		
		if($this->lang->line('re')!='') { $re= stripslashes($this->lang->line('re')); } else $re ="Re ";
		
		if($this->lang->line('user_msg_txt')!='') { $user_msg_txt= stripslashes($this->lang->line('user_msg_txt')); } else $user_msg_txt ="Message text";
		
		if($this->lang->line('user_send')!='') { $user_send= stripslashes($this->lang->line('user_send')); } else $user_send ="send";
		
		if($this->lang->line('user_cancel')!='') { $user_cancel= stripslashes($this->lang->line('user_cancel')); } else $user_cancel ="Cancel";
		
		
		$id = $this->input->post('id'); 
		$condition = array('sellerid'=>$this->checkLogin('U'),'id'=>$id);
		$contactUserInfo = $this->user_model->get_all_details(CONTACTSELLER,$condition);
		$popupVal = ' <form name="contactpeople" id="contactpeople" method="post" action="site/user/contactpeople" onsubmit="return contactsCheck();">
			<div class="conversation">
                <div style="padding:20px;" class="conversation_container">
                    <h2 class="conversation_headline">'.$view_usr_msg_replay_to.' : '.$contactUserInfo->row()->username.'</h2>
                    <div class="conversation_right">
                       
                            <input class="conversation-subject" type="text" name="subject" id="subject" placeholder="Subject" value="'.$re.':'.$contactUserInfo->row()->product_name.'" >
                            <textarea class="conversation-textarea" rows="11" name="message_text" id="message_text" placeholder="'.$user_msg_txt.'"></textarea>
                            <input type="hidden" name="sender_email" id="sender_email" value="'.$this->session->userdata['shopsy_session_user_email'].'" >
                            <input type="hidden" name="sender_id" id="sender_id" value="'.$this->session->userdata['shopsy_session_user_id'].'" >
                            <input type="hidden" name="receiver_email" id="receiver_email" value="'.$contactUserInfo->row()->useremail.'" >
                            <input type="hidden" name="receiver_id" id="receiver_id" value="'.$contactUserInfo->row()->user_id.'" >
                            <input type="hidden" name="current_user" value="'.$this->session->userdata['shopsy_session_user_name'].'" >
                            <input type="hidden" name="FromURL" value="ContactUser" >
                            
                            <span class="error" id="ErrPUP"></span>
                       		
                    </div> 
					
					<div class="modal-footer footer_tab_footer">
						<div class="btn-group">
								<input class="submit_btn" type="submit" value="'.$user_send.'" />
								<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel">'.$user_cancel.'</a>
						</div>
					</div>						
                </div>
            </div> 
			</form>';
		echo $popupVal;				
		return;
	}
	
	/*
	* 
	* Display the shop transaction 
	* 
	*/
	public function display_shop_transaction(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
			$this->data['heading'] = 'Shop Tranactions';
			$shop_id = $this->checkLogin('U');		
			$this->data['shop_trans_details'] = $this->seller_model->getShopTransactionDetails($shop_id);
			$this->load->view('site/shop/display_shop_tranaction',$this->data);
		}
	}
	
	/*
	* 
	* Display the shop particular transaction  
	* 
	*/
	public function view_shop_transaction(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = $this->uri->segment(2,0).' :: Tranactions';
			$transdate = $this->uri->segment(4,0);
			$shop_id = $this->checkLogin('U');		
			$condition = array('pay_date' => date("Y-m-d H:i:s",$transdate),'user_id'=> $shop_id);
			$this->data['productList'] = $this->product_model->view_product_details('  where p.pay_date="'.date("Y-m-d H:i:s",$transdate).'" and p.user_id='.$shop_id.' and u.group="Seller" and u.status="Active" or p.pay_date="'.date("Y-m-d H:i:s",$transdate).'" and p.user_id='.$shop_id.' group by p.id order by p.created desc');
			#echo "<pre>"; print_r($this->data['productList']); die;
			$this->load->view('site/shop/view_shop_tranaction',$this->data);
			
		}
	}
	
	/*
	* 
	* Display the shop orders 
	* 
	*/
	public function display_shop_orders(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Shop Orders';
			$shop_id = $this->checkLogin('U');		
			$this->data['user_details']=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));	
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
			
			$status = '';
			$order = $_GET['order'];
			
			$fro = $_GET['from'];
			if($fro!=''){
				$from = date("Y-m-d H:i:s", strtotime($fro));
			}else{
				$from = '';
			}
			
			$t = $_GET['to'];
			if($t !=''){
				$to = date("Y-m-d H:i:s", strtotime($t));
			}else{
				$to = '';
			}
			
			$id = $_GET['id'];
			//echo $id; die;
			
			if($order == 'cod')
		    {
				$this->data['orderList'] = $this->order_model->view_shop_cod_details('COD',$shop_id);
			}
		    else if($order == 'wiretransfer')
			{
				$this->data['orderList'] = $this->order_model->view_shop_wiretransfer_details('wire_transfer',$shop_id);
			}else if($order == 'westernunion')
			{
				$this->data['orderList'] = $this->order_model->view_shop_wiretransfer_details('western_union',$shop_id);
			}
			else
			{
				$this->data['orderList'] = $this->order_model->view_shop_order_details('Paid',$shop_id,$order,'',$from,$to,$id);
			}
			$this->data['orderDetails'] = $this->seller_model->get_total_order_amount($this->checkLogin('U') )->result();// total earnings
			$this->data['claim_amt']=$this->seller_model->get_claim_amount($this->checkLogin('U'))->result();// site earning without admin commission
			$this->data['admin_commission'] = $this->seller_model->get_admin_commission($this->checkLogin('U'))->result();//admin commission
			//echo "<pre>";print_r($this->data['admin_commission'] );die;
			$this->data['disputeDetail'] = $this->seller_model->get_dispute_order_amount($this->checkLogin('U'))->result();// dispute amount
			#echo $this->db->last_query();die;
			$this->data['paidDetails'] = $this->seller_model->get_total_paid_details($this->checkLogin('U') )->result();
		
			
			
			$this->load->view('site/shop/display_shop_orders',$this->data);
			
		}
	}
	
	
	/*
	 *
	 * Display the disputes
	 *
	 */
	public function disputes(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			
			$this->data['heading'] = 'Dispute Orders';
			$shop_id = $this->checkLogin('U');
			$this->data['user_details']=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
				
			//$order = $_GET['order'];
			$order = 'dispute';
			
			$this->data['orderListtoYou'] = $this->order_model->view_shop_order_details('Paid',$shop_id,$order);
			
			$this->data['orderListbyYou'] = $this->order_model->view_shop_order_details('Paid','',$order,$shop_id);
			
			$this->load->view("site/order/disputes",$this->data);
			
			
		}
	}
	
	
	/*
	* 
	* Display the shop COD orders 
	* 
	*/
	public function display_shop_cod_orders(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Shop Orders';
			$shop_id = $this->checkLogin('U');	
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);			
			$this->data['orderList'] = $this->order_model->view_shop_cod_details('COD',$shop_id);
			$this->load->view('site/shop/display_shop_cod_orders',$this->data);
		}
	}
	public function calculate_admin_commission(){
		$query="select sumTotal,id from ".USER_PAYMENT."";
		$amts=$this->order_model->ExecuteQuery($query)->result();
		
		$qury="select product_commission from ".ADMIN_SETTINGS." ";
		$commission=$this->order_model->ExecuteQuery($qury)->row()->product_commission;
		#echo $commission;die;
		foreach($amts as $amt){
			$admin_commission= $amt->sumTotal * (0.01 * $commission);			
			$this->order_model->update_details(USER_PAYMENT,array('admin_commission'=>$admin_commission),array('id'=>$amt->id));
		}
	}
	
	
	/*
	* 
	* Update the shop order status
	* 
	*/
	public function shoporder_update(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$dealCode = $this->input->post('dealCodeNumber');
			
			$shipping_status = $this->input->post('shipping_status');
			$dataArr = array('shipping_status'=>$shipping_status);	

			if($shipping_status == 'Delivered'){
				$check = "select * from ".USER_PAYMENT." where sell_id=".$this->checkLogin('U')." and dealCodeNumber ='".$dealCode."' GROUP BY dealCodeNumber";
				$checkstatus = $this->order_model->ExecuteQuery($check)->first_row();
				if($checkstatus->payment_type == 'COD' || $checkstatus->payment_type == 'wire_transfer'|| $checkstatus->payment_type == 'western_union'){
					$dataArr['status'] = 'Paid';
				}
				$dataArr['received_status'] = 'Product received';
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
				
			$condition=array('dealCodeNumber'=>$dealCode);
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
			
			//echo $this->db->last_query();
			
			$orderDetails = $this->order_model->get_all_details(USER_PAYMENT,$condition);
				
			$buyerDetails = $this->order_model->get_all_details(USERS,array('id'=>$orderDetails->row()->user_id));
				
			$sellerDetails = $this->order_model->get_all_details(USERS,array('id'=>$orderDetails->row()->sell_id));
				
			$newsid='35';
				
			$orderid = $dealCode;
			$orderstatus = $shipping_status;
			$content .="";
				
			$content .= "comment : ".$orderDetails->row()->statusMessage."<br>";
				
			if($shipping_status == Shipped){
				$content = 	"Estimated Delivery Date : ".$orderDetails->row()->estDate."<br>".
						"Shiping Id : ".$orderDetails->row()->trackingId."<br>";
			}
				
			$sender_email = $sellerDetails->row()->email;
			$receive_email =  $buyerDetails->row()->email;
			$cc_mail_id = $this->data['siteContactMail'];
				
			$template_values=$this->order_model->get_newsletter_template_details($newsid);
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
			/*echo $header;
			 echo $message; exit;*/
			//echo '<pre>'; print_r($email_values);	die;
			$email_send_to_common = $this->order_model->common_email_send($email_values);
			
			if($order_details){
				$this->setErrorMessage('success','Order Status Updated Successfully');
				//echo 'Success';
				redirect('shops/'.$this->data['selectSellershop_details']['0']['seourl'].'/shop-orders');
				
			}else{
				$this->setErrorMessage('error','Order Status Updated Failed');			
				//echo 'error';
				redirect('shops/'.$this->data['selectSellershop_details']['0']['seourl'].'/shop-orders');
				
			}
		}
	}
	
	
	/*
	* 
	* udpate the payment status
	* 
	*/
	public function payment_status(){
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$dealCode = $this->input->post('dealCodeNumber');
			$shipping_status = $this->input->post('payment_status');
			$dataArr=array('status'=>$shipping_status);
			$condition=array('dealCodeNumber'=>$dealCode);
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
			if($order_details){
			$dataArr=array('shipping_status'=>"Delivered");
			$condition=array('dealCodeNumber'=>$dealCode);
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
				$this->setErrorMessage('success','Order Status Updated Successfully');
				echo 'Success';
			}else{
				$this->setErrorMessage('error','Order Status Updated Failed');			
				echo 'error';
			}
		}
	}
	
	/*
	* 
	* View the particular order for shop 
	* 
	*/
	public function vieworder(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'View Order';
			$user_id = $this->uri->segment(4,0);
			$deal_id = $this->uri->segment(5,0);
			
			if($this->checkLogin('U')!=""){
				$activity_id=$deal_id;
				$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE user_id =".$user_id." AND activity_id=".$activity_id." AND (activity='order')");
			}
			#print_r( $this->db->last_query()); die;
			$this->data['ViewList'] = $this->order_model->view_orders($user_id,$deal_id);
			$this->load->view('admin/order/view_orders',$this->data);
		}
	}
	
	/*
	* 
	* Display the shop product listings 
	* 
	*/
	public function manageListings(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Manage Listings';
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());
			$condition = " where (p.status='Publish' or p.status='unpublish') and p.user_id=".$this->checkLogin('U')." and (u.group='User' or u.group='Seller') and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
			$this->data['feature_list']=$this->product_model->get_all_details(FEATURE_PACK,array('status'=>'Active'))->result();
			$this->data['shopDetail']=$this->product_model->view_product_details($condition)->result();
			#echo "<pre>";print_r($this->data['shopDetail']);die;
			#print_r($this->db->last_query());die;
			$this->load->view('site/shop/manage_listings',$this->data);
		}
	}
	
	/*
	* 
	* Add the bill address using ajax
	* 
	*/
	function addBillingAjax(){
		$loginUserId = $this->checkLogin('U');
		$condition =array('id' => $loginUserId);
		$dataArr = array('full_name'=>$this->input->post('full_name'),'address'=>$this->input->post('street'),'city'=>$this->input->post('city'),'state'=>$this->input->post('state'),'country'=>$this->input->post('country'),'postal_code'=>$this->input->post('postalcode'),'phone_no'=>$this->input->post('phone'));
		$this->order_model->update_details(USERS,$dataArr,$condition);
	}
	
	/*
	* 
	* Display the Commision tracking for shop
	* 
	*/
	public function display_commision_log(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Commision Log';
			$this->data['user_details']=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));		
			$this->data['commision_log']=$this->seller_model->get_all_details(VENDOR_PAYMENT,array('vendor_id'=>$this->checkLogin('U'),'status'=>'success'));	
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);
			$this->load->view('site/shop/display_commision_log',$this->data);
		}
	}
	
	/*
	* 
	* send withdraw request for shop
	* 
	*/
	public function send_withdraw_req(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Withdrawal Request';			
			$shop_id = $this->checkLogin('U');	
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);			
			$this->data['user_details']=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
			$this->data['orderDetails'] = $this->seller_model->get_total_order_amount($this->checkLogin('U') )->result();
			$this->data['orderDetails1'] = $this->seller_model->get_total_order_amounts($this->checkLogin('U') )->result();//site earnings
			$this->data['disputeDetail'] = $this->seller_model->get_dispute_order_amount($this->checkLogin('U'))->result();// dispute amount
			$this->data['codorder'] = $this->seller_model->get_cod_order_amount($this->checkLogin('U') )->result();	
			$this->data['claim_amt']=$this->seller_model->get_claim_amount($this->checkLogin('U'))->result();
			$this->data['paidDetails'] = $this->seller_model->get_total_paid_details($this->checkLogin('U') )->result();
			$this->load->view('site/shop/withdraw_req',$this->data);
		}
	}
	
	/*
	* 
	* send withdraw request for shop
	* 
	*/
	public function send_withdraw(){
		//error_reporting(-1);
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$condition =array('id' => $this->checkLogin('U'));
			$withdraw_amt=$this->input->post('withdraw_amt');
			if($withdraw_amt<=0){
				$this->setErrorMessage('error','Enter the requested amount as greater than zero');
				redirect($_SERVER['HTTP_REFERER']);
			}else if($withdraw_amt > $this->input->post('balance_amt')){
				$this->setErrorMessage('error','Enter the requested amount Less than Balance Amount');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$default_cur_get=$this->seller_model->get_all_details(CURRENCY,array('default_currency'=>'Yes','status'=>'Active'));
			$user_cur_get=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
			$default_cur=$default_cur_get->row()->currency_code;
			$user_cur=$user_cur_get->row()->currency;
			#echo $default_cur. "  user_cur ".$user_cur;die;
			if($default_cur!=$user_cur)	{		
				$curval=$this->data['currencyValue'];
				$withdraw_amt=$withdraw_amt/$curval;
			}  else {
				$withdraw_amt=$withdraw_amt;
				$curval=1;
				$curCurency=1;
			}
			$dataArr = array('send_req'=>'Yes','withdraw_amt'=>$withdraw_amt);		
			
			//print_r($dataArr);
			$this->seller_model->update_details(USERS,$dataArr,$condition);
			//echo $this->db->last_query();die;
			$this->send_withdraw_requestMail();
			$this->setErrorMessage('success','Your Request Sended Successfully');
			redirect("shop/sell");
		}
	}
	
	/*
	* 
	* sending mail for withdraw request for shop
	* 
	*/
	public function send_withdraw_requestMail(){
		$user_details=$this->seller_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$user_name=$user_details->row()->user_name;
		$withdraw_amt=$user_details->row()->withdraw_amt;
		$email=$user_details->row()->email;
		$full_name=$user_details->row()->full_name.' '.$user_details->row()->last_name;
			$newsid='2';
			$template_values=$this->product_model->get_newsletter_template_details($newsid);
			$adminnewstemplateArr=array('logo'=> $this->data['logo'],'user_name'=>$user_name,'footer_content'=> $this->config->item('footer_content'),'email_title'=> $this->config->item('email_title'));
			extract($adminnewstemplateArr);
			$subject = $template_values['news_subject'].' '.$this->config->item('email_title');
			$message .= '<!DOCTYPE HTML>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<meta name="viewport" content="width=device-width"/>
					<title>'.$adminnewstemplateArr['meta_title'].' - Share Things</title>
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
								'from_mail_id'=>$email,
								'mail_name'=>$full_name,		
								'to_mail_id'=>$sender_email,
								'subject_message'=>$subject,
								'body_messages'=>$message
								);
			#echo "<pre>"; print_r($email_values); #die;
			$email_send_to_common = $this->product_model->common_email_send($email_values);
		}
		
		public function gcard_status_change(){
			$seller_id=$this->checkLogin('U');
			$status=$this->input->post('status');
			$this->product_model->update_details(SELLER,array('gift_card'=>$status),array('seller_id'=>$seller_id));
			//echo $this->db->last_query(); die;
			echo "Success";
		}

public function display_shop_statistics(){
		$this->data['shopInfo']=$shopInfo=$this->seller_model->get_shop_owner_detail($seourl)->result_array();
		$this->data['favUserList']=$favUserList=$this->product_model->getShopFavDetails($shopInfo[0]['seller_id']);
		#echo $this->db->last_query(); die;
		#echo "<pre>"; print_r($shopInfo); die;
		if (count($favUserList)>0){
			foreach ($favUserList as $favUser){
				$this->data['favoritersUserfavDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id']);
				$this->data['favoritersUserfavProdDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id'])->result_array();
			}
		}
		#echo "<pre>"; print_r($this->data['favoritersUserfavDetails']);die;
		$condition = array('id'=>$this->checkLogin('U'));
		$this->data['userProfileDetails'] = $this->product_model->get_all_details(USERS,$newdata,$condition)->result_array();
		$this->data['title'] = 'People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');
		$this->data['meta_title'] ='People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');	
		$this->data['meta_description'] =$currentcatDetails->seo_description;   	
		
		$this->load->view('site/shop/shop_statistics',$this->data);
	}
		
} 

// Class ends
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */