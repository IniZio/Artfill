<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/

class Seller extends MY_Controller { 

	function __construct()
	{
	
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('user_model','seller_model','product_model'));
		
		
				
		$this->data['loginCheck'] = $this->checkLogin('U');
		
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->user_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
	
     }
    

	/**
	 * 
	 * This function is used for seller shop registration
	 * 
	 */
	public function seller_register_form()
	{
			$sellName =  @explode('-',$this->uri->segment(1)); 
		$this->data['heading'] = 'Seller '.ucfirst($sellName[1]).' - '.$this->config->item('meta_title');

		if ($this->checkLogin('U')!=''){

		$this->data['sellerVal'] = $this->seller_model->get_sellers_data(SELLER,$condition);
		$this->data['CatogoryVal'] = $this->seller_model->get_all_details(CATEGORY,$condition);
		//echo '<pre>'; print_r($this->data['CatogoryVal']->result());die;
		$this->data['UserVal'] = $this->user_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$this->load->view('site/seller/seller_register.php',$this->data);
			
		}else {
			$this->data['next'] = $this->input->get('next');
			//echo $this->data['next'];die;
			$this->data['heading'] = 'Sign in'; 
			$this->load->view('site/user/signup.php',$this->data);
		}
	}
	
	
	
	
	/**
	 * 
	 * This function is used for seller product details view
	 * 
	 */

	public function seller_product_view()
	{
		$product_seourl = $this->uri->segment(3, 0); 
		$seller_id = $this->uri->segment(2, 0);

		$this->data['userVal'] = $this->seller_model->get_userselldetail_data('product_template,seller_businessname,seourl,seller_id,seller_store_image,seller_email',$seller_id);
		$this->data['productVal'] = $productVal = $this->product_model->get_productdetail_data($product_seourl);
		 $_SESSION['product_name'] = '';
		 $_SESSION['prd_id'] ='';
		 $_SESSION['product_name'] =  $productVal[0]['product_name']; 
		 $_SESSION['prd_id'] = $prd_id = $productVal[0]['id']; 
		
		 $this->data['productFeedback'] = $productFeedback = $this->seller_model->get_product_feedback($prd_id);
		 $nametemp = $userVal[0]['product_template'];		
		 $pid = $this->data['productVal'][0]['id'];
								//print_r($this->data['productVal'] ); die;

		
		$this->data['PrdAttrName'] = $this->product_model->view_subproduct_details_group($pid);
		$this->data['PrdAttrVal'] = $this->product_model->view_subproduct_details_join($pid);
		//echo '<pre>'; print_r($this->data['productVal']); die;



		$this->data['heading'] = $this->data['productVal'][0]['product_name'];
		$this->data['meta_title'] = $this->data['productVal'][0]['meta_title'];
		$this->data['meta_keyword'] = $this->data['productVal'][0]['meta_keyword'];
		$this->data['meta_description'] = $this->data['productVal'][0]['meta_description'];
		$this->load->view('site/shop/productshop_template.php',$this->data);
			
		
	}	


 
	/**
	 * 
	 * This function is used for Seller Shop register and update view form
	 * 
	 */
	public function seller_signup() 
	{
	
	            extract($_POST);
				if ($this->checkLogin('U')!=''){
				 
			$returnStr['status_code'] = 0;
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['upload_path'] = './images/store-banner';
			$this->load->library('upload', $config);
		
			if($_FILES['seller_store_image']['size']!=0)
			{
			if ( $this->upload->do_upload('seller_store_image')){
					$imgDetails = $this->upload->data();
					$returnStr['image']['width'] = $imgDetails['image_width'];
	    			$returnStr['image']['height'] = $imgDetails['image_height'];
	    			$returnStr['image']['name'] = $imgDetails['file_name'];
	    					$this->ImageResizeWithCrop(1000, 108, $imgDetails['file_name'], './images/store-banner/');
								$returnStr['status_code'] = 1;
								}
							}

					$fileDetails = 	$imgDetails['file_name'];
					$condition123 = "where seller_email = '".$this->session->userdata('shopsy_session_user_email')."' ";
					$duplicateMail = $this->seller_model->get_sellers_details($condition123);
					if ($duplicateMail->num_rows()>0){
					
					if($_FILES['seller_store_image']['size']!=0){
					$this->seller_model->updateUserQuick($seller_nda,$seller_agreement,$fileDetails);
					$this->setErrorMessage('success','Your seller store details Updated Successfully');

						$returnStr['msg'] = 'Successfully registered';
						$returnStr['success'] = '1';			
						redirect($base_url.'/sell-update');
					}
					if($_FILES['seller_store_image']['size']==0){ 					
						$this->seller_model->updateUserQuicks($seller_nda,$seller_agreement);
						$this->setErrorMessage('success','Your seller store details Updated Successfully');
												
					redirect($base_url.'/sell-update');
					}
					
					}else {
					
					if($_FILES['seller_store_image']['size']!=0)
					{
					$this->seller_model->insertUserQuick($seller_nda,$seller_agreement,$fileDetails);
					$this->setErrorMessage('success','Your shop request sent, Admin contact you soon');

						redirect($base_url.'/sell-update');
					}
					if($_FILES['seller_store_image']['size']==0){
					$this->seller_model->insertUserQuicks($seller_nda,$seller_agreement);
					$this->setErrorMessage('success','Your seller shop request sent to Admin,please wait for Approval');
						redirect($base_url.'/sell-update');
					}
				
			}

  
}
}

	/**
	 * 
	 * This function is used for list all the product feedback
	 * 
	 */
public function prod_all_feedback() 
{
	$prodId = $this->uri->segment(1);
			$searchPerPage = 1;
		    $paginationNo = $this->uri->segment('4');  
			if($paginationNo == '')
			{
					$paginationNo = 0;
			}
			else
			{
					$paginationNo = $paginationNo;
			}

            $getTotalProdFeedback = $this->seller_model->get_product_feedback($prodId,$type='all','',''); 
	        $this->data['FeedbackDetails'] = $a = $this->seller_model->get_product_feedback($prodId,$type='all',$searchPerPage,$paginationNo); 
	
		    $searchbaseUrl = base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/'.$this->uri->segment('3'); 
			$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/page_prevt_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/page_next.png" />';
			$config['base_url'] = $searchbaseUrl;
			$config['total_rows'] = count($getTotalProdFeedback); 
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 4;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			$paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
 
	$this->load->view('site/user/product_all_feedback.php',$this->data);
}
	/**
	 * 
	 * This function is used for list all the product feedback
	 * 
	 */
public function prod_feedback() 
{
	$feedbackId = $this->uri->segment(1);

	$this->data['FeedbackDetails'] = $a = $this->seller_model->get_single_feedback($feedbackId); 
	//print_r($a); die; 
	$this->load->view('site/user/product_feedback.php',$this->data);
}
} // class ends

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */