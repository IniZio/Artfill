<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 *
 */
class Shop_section extends MY_Controller {
	function __construct(){
        parent::__construct();
       // error_reporting(E_ALL);
		//echo "Asdf";
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','seller_model','user_model','shop_section_model'));
		$this->load->helper('url');
		//$this->load->model(array('product_model','shop','seller_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
		

	 		//$this->data['likedProducts'] = $this->shop->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}

		
    }
    
	public function index(){
	
		$this->get_shop_section_list();
    }
	
	
	/**
	 * This function is used to show the shop section details
	 *	
	 */

	public function get_shop_section_list()
	{
		//echo "im here";die;
		$this->data['get_seller_details'] = $this->shop_section_model->get_seller_details();
		$sellerId = $this->data['get_seller_details']['seller_id'];	
		$this->data['get_seller_sales_qry']= $get_seller_sales_qry = $this->shop_section_model->get_shop_selling_info();
		
		#echo "<pre>"; print_r($this->data['get_seller_details']); die;
		$this->load->library('pagination');
		$pagination_per_page = 16;// $this->config->item('pagination_per_page');
		$shop_name_seourl =urldecode ($this->uri->segment('2')); // Its a shop name seourl from  seller table
		//echo $shop_name_seourl;die;
		$section_condtion = SELLER.".seourl = '".$shop_name_seourl."'";	
		$sellerInfo=$this->shop_section_model->get_all_details(SELLER,array('seourl' => $shop_name_seourl,'status' => 'active'))->result_array();
		
		if(count($sellerInfo) == 0){		
			show_404();		
		}
		
		if($sellerInfo[0]['seller_id']!=''){
		$this->data['totProduct']=$totProduct=count($this->shop_section_model->get_all_details(PRODUCT,array('user_id' => $sellerInfo[0]['seller_id'],'status'=>'Publish'))->result_array());
				
		$get_shop_section_list  = $this->shop_section_model->get_shop_section_list($section_condtion);
		$get_shop_product_idlist  = $this->shop_section_model->get_shop_product_idlist();
		#echo "<pre>";print_r($get_shop_product_idlist); die;
		#$this->shop_section_model->get_all_details(PRODUCT,array('user_id' => $sellerInfo[0]['seller_id'],'status'=>'Publish'))->result_array()
		$shop_section_prod_ids = array();
		$section_prod_id_string = '';
		if($this->uri->segment(3)=='sales'){
			foreach($get_seller_sales_qry as $shop_product_idlist)
			{
				if($shop_product_idlist['product_id'] != '')
				{
					$section_prod_id_string.= $shop_product_idlist['product_id'].",";
				}
				 
			}
		}
		else{
			foreach($get_shop_product_idlist as $shop_product_idlist)
			{
				if($shop_product_idlist['product_id'] != '')
				{
					$section_prod_id_string.= $shop_product_idlist['product_id'].",";
				}
				 
			}
		}
		
		if(!isset($_GET['section_id'])){
			$get_shop_product_idlist  = $this->shop_section_model->get_all_details(PRODUCT,array('user_id' => $sellerInfo[0]['seller_id'],'status'=>'Publish'))->result_array();
		#echo "<pre>";print_r($get_shop_product_idlist); die;$this->shop_section_model->get_all_details(PRODUCT,array('user_id' => $sellerInfo[0]['seller_id'],'status'=>'Publish'))->result_array()
			$shop_section_prod_ids = array();
			$section_prod_id_string = '';
			foreach($get_shop_product_idlist as $shop_product_idlist)
			{
				if($shop_product_idlist['id'] != '')
				{
					$section_prod_id_string.= $shop_product_idlist['id'].",";
				}
				 
			}
			if($this->uri->segment(3)=='sales'){
				$shop_section_prod_ids = array();
				$section_prod_id_string = '';
				foreach($get_seller_sales_qry as $shop_product_idlist){
					if($shop_product_idlist['product_id'] != ''){
						$section_prod_id_string.= $shop_product_idlist['product_id'].",";
					}	 
				}
			}
			if($this->uri->segment(3)=='favorites'){
				$this->data['shopInfo']=$shopInfo=$this->seller_model->get_shop_owner_detail($this->uri->segment(2))->result_array();
				$this->data['favUserList']=$favUserList=$this->product_model->getShopFavDetails($shopInfo[0]['seller_id']);
				if (count($favUserList)>0){
					foreach ($favUserList as $favUser){
						$this->data['favoritersUserfavDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id']);
						$this->data['favoritersUserfavProdDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id'])->result_array();
					}
				}
				$condition = array('id'=>$this->checkLogin('U'));
				$this->data['userProfileDetails'] = $this->product_model->get_all_details(USERS,$newdata,$condition)->result_array();
			}
			$UserfollowDetails = $this->user_model->get_all_details(USERS,array('id'=>$sellerId));
			#echo "<pre>";print_r($UserfollowDetails->row());die;
			if($UserfollowDetails->num_rows()==1){
				$this->data['UserfollowDetails'] = $UserfollowDetails;
				$this->data['recentActivityDetails'] = $this->user_model->get_activity_details($UserfollowDetails->row()->id);
				$fieldsArr = array('*');
				$searchName = 'id';
				$searchArr = explode(',', $UserfollowDetails->row()->following);
				$searchArr1 = explode(',', $UserfollowDetails->row()->followers);
				$joinArr = array();
				$sortArr = array();
				$limit = '';
				////////////////Following//////////////////////
				$followingUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr,$joinArr,$sortArr,$limit);	
				/*  print_r($followingUserDetails->result_array());
				die; */ 
				$this->data['followingUserDetails'] = $followingUserDetails->result_array();
				if($followingUserDetails->num_rows()>0){
					foreach($followingUserDetails->result() as $followingUserRow){
						$this->data['followingUserfavDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id);
						$this->data['followingUserfavProdDetails'][$followingUserRow->id] = $this->user_model->get_userfav_products($followingUserRow->id)->result_array();						
					}
				}
				
				////////////////Followers//////////////////////
				$followerUserDetails = $this->product_model->get_fields_from_many(USERS,$fieldsArr,$searchName,$searchArr1,$joinArr,$sortArr,$limit);				
				$this->data['followerUserDetails'] = $followerUserDetails->result_array();
				if($followerUserDetails->num_rows()>0){
					foreach($followerUserDetails->result() as $followerUserRow){
						$this->data['followerUserfavProdDetails'][$followerUserRow->id] = $this->user_model->get_userfav_products($followerUserRow->id);
						$this->data['followerUserfavProdDetails'][$followerUserRow->id] = $this->user_model->get_userfav_products($followerUserRow->id)->result_array();						
					}
				}
			}else{
				$this->data['UserfollowDetails'] = '';
			}
		}
		$section_prod_id_string = rtrim($section_prod_id_string,',');
		if($section_prod_id_string != '')
		{
			$shop_section_prod_ids = explode(",",$section_prod_id_string);
			$shop_section_prod_ids = array_unique($shop_section_prod_ids);
		}
		//echo '<pre>'; print_r($shop_section_prod_ids); die;
		
		$pagination_no = 0;
		/* if($_GET['page'] != '')
		{
			$pagination_no = $_GET['page'];
		} */
		 if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$curUrl = @explode('&pg=',$CUrurl);

		if($this->input->get('pg') != ''){
			$pagination_no = $this->input->get('pg') * 16;
			//$limitPaging = $paginationVal.',12 ';
		} 
		$newPage = $this->input->get('pg')+1;
		
		if(strpos($CUrurl,'?') !== false){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		}else{
			$qry_str = $curUrl[0].'?pg='.$newPage; 
		} 
		#echo "<pre>";print_r($shop_section_prod_ids); die;
		if(!empty($shop_section_prod_ids))
		{
			
			$get_shop_selection_products_count = $this->shop_section_model->get_shop_selection_products($shop_section_prod_ids,'','',$sellerId);
			#echo $this->db->last_query();die;
			$get_shop_selection_products = $this->shop_section_model->get_shop_selection_products($shop_section_prod_ids,$pagination_no,$limit_val = $pagination_per_page,$sellerId);
			
			#echo "<pre>";print_r($get_shop_selection_products);echo "</pre>";
			#echo "<pre>";echo $this->db->last_query();die;
			#$get_shop_selection_products= $this->shop_section_model->get_all_details(PRODUCT,array('user_id' => $sellerInfo[0]['seller_id'],'status'=>'Publish'))->result_array();
		}
		else
		{
			$get_shop_selection_products_count = array();
			$get_shop_selection_products = array();
		}
		//echo "<pre>";print_r($get_shop_selection_products);die;
		 $get_query_string_vals = $_GET;
		 $shop_selection_query_string_uri = '';
		 foreach($_GET as $query_sting_uri_keys=>$query_sting_uri_vals)
		 {
		 	if($query_sting_uri_keys != 'page')
			{
		 		 
				$shop_selection_query_string_uri.= $query_sting_uri_keys."=".$query_sting_uri_vals."&";
				
			}
		 }
		 $condition = " WHERE s.seourl='".$shop_name_seourl."' group by a.product_id";
		/* if($this->input->get('search_query') != ""){
			$condition = " WHERE p.product_name = '".$this->input->get('search_query')."' and s.seourl='".$shop_name_seourl."' group by a.product_id";
		} */
		
		#echo $condition;die;
		$get_section_price_list = $this->product_model->view_product_details1($condition);
		#echo '<pre>'; print_r($get_section_price_list);die;
		
		
		$attribute_price_values = array();
		foreach($get_section_price_list->result_array() as $price_list_val)
		{
			$attribute_price_values[$price_list_val['id']] = $price_list_val['pricing'];
		}
		
		$this->data['attribute_price_values'] = $attribute_price_values;
		//echo "<pre>";print_r($attribute_price_values);die;
		 $shop_selection_query_string_uri = rtrim($shop_selection_query_string_uri,"&"); 
		 $shop_selection_query_string_uri = ltrim($shop_selection_query_string_uri,"&"); 
		 //echo $shop_selection_query_string_uri;die;
		 
		/* $config['base_url'] = base_url().'shop-section/'.$this->uri->segment(2)."?".$shop_selection_query_string_uri;
		$config['total_rows'] = count($get_shop_selection_products_count);
		$config['per_page'] = $pagination_per_page; 
		$config['page_query_string'] = TRUE;
		$config['last_link'] = FALSE;
		$config['first_link'] = FALSE;
		$config['prev_link'] = "<img src='images/dob2.png' class='previous_link_img'/>";
		$config['next_link'] = "<img src='images/nextview.png' class='next_link_img' />";
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config); 
	//	echo "<pre>";print_r($config);die;
		$pagination_links = $this->pagination->create_links();  */
		
		
		//echo "<pre>";print_r($shop_section_prod_ids);die;
		/**** Calculate shop home count start*******/
		$shop_section_count = 0;
		foreach($get_shop_section_list as $shop_seciton_dtls)
		{
			$shop_section_count+= $shop_seciton_dtls['shop_prod_count'];
		}
		/**** Calculate shop home count end *******/
		
		
		// echo $this->db->last_query();die;
		$Shopadmirers=$this->product_model->getShopFavDetails($sellerInfo[0]['seller_id']);
		$this->data['Shopadmirers']=count($Shopadmirers);
		
		$this->data['UserSellerDetails'] = $this->shop_section_model->get_all_details(USERS,array('id'=>$sellerId));
		
		//echo "<pre>";print_r($this->data['get_seller_details']);die;
		$this->data['shop_section_count'] = $shop_section_count;
		$this->data['pagination_links'] = $pagination_links;
		$this->data['get_shop_selection_products'] = $get_shop_selection_products;
		//echo "<pre>";	 print_r($this->data['get_shop_selection_products']); die;
		 if(count($this->data['get_shop_selection_products']) > 0){ 
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: block;">No More Products</a>';
		} 	
		$this->data['paginationDisplay'] = $paginationDisplay;
		//echo "<pre>";	 print_r($this->data['get_shop_selection_products']); die;
		$this->data['get_shop_owner_info'] = $this->shop_section_model->get_shop_owner_info();
		//echo "<pre>";print_r($this->data['get_shop_owner_info']);die;
		$this->data['get_shop_section_list'] = $get_shop_section_list;
		$this->data['meta_title'] = $this->data['heading'] = stripslashes($this->data['get_seller_details']['shop_title']).' on '.stripslashes($this->config->item('email_title'));
		$this->data['shopproductfeed_details']=$shopproductfeed_details = $this->seller_model->get_shopproductfeed_details($sellerInfo[0]['seller_id'])->result();
		#echo "<pre>"; print_r($shopproductfeed_details); die;
		
		$this->load->view('site/shop-section/shop_section_list.php',$this->data);
		}else{

				redirect('');
}		
		
	
	}	
	
		
	
		/**
	 * 
	 * This function is used for search the shop section 
	 * 
	 */
	function shop_section_search_form()
	{		
	
					//echo "asdf";die;
					$search_query = $this->input->post('search_query');
					$search_query_uri = 'search_query='.$search_query;
					$current_page_url = $this->input->post('current_page_url');
					$search_query_url = $current_page_url.$search_query_uri;
					
		redirect($search_query_url);
	}
	
} 

// Class ends
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */