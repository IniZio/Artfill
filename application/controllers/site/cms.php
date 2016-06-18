<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * CMS related functions
 * @author Teamtweaks
 *
 */

class Cms extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
	/**
	 * 
	 * This function is used for list the cms pages
	 * 
	 */
	public function index(){
    	$seourl = $this->uri->segment(2);
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$seourl,'status'=>'Publish'));
		if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		if ($pageDetails->row()->meta_title != ''){
	    		$this->data['heading'] = $pageDetails->row()->meta_title;
				$this->data['meta_title'] = $pageDetails->row()->meta_title;
			}
			if ($pageDetails->row()->meta_tag != ''){
		    	$this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
			}
			if ($pageDetails->row()->meta_description != ''){
		    	$this->data['meta_description'] = $pageDetails->row()->meta_description;
			}
    		$this->data['heading'] = $pageDetails->row()->meta_title;
    		$this->data['pageDetails'] = $pageDetails;
			
			$this->data['SubPageDetails'] = $this->product_model->get_all_details(CMS,array('parent'=>$pageDetails->row()->id,'status'=>'Publish'));
			
			
			
			if($pageDetails->row()->parent > 0){
				$this->data['MainPageDets'] = $this->product_model->get_all_details(CMS,array('id'=>$pageDetails->row()->parent,'status'=>'Publish'));
				$this->data['MainPageCount'] = $this->data['MainPageDets']->num_rows();
			}else{
				$this->data['MainPageCount'] = 0;
			}
			
			
			
			
    		$this->load->view('site/cms/display_cms',$this->data);
    	}
    }
    
	/**
	 * 
	 * This function is used for list the particular cms pages
	 * 
	 */
	public function page_by_id(){
    	$cid = $this->uri->segment(2);
		$pageDetails = $this->product_model->get_all_details(CMS,array('id'=>$cid,'status'=>'Publish'));
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		if ($pageDetails->row()->meta_title != ''){
	    		$this->data['heading'] = $pageDetails->row()->meta_title;
				$this->data['meta_title'] = $pageDetails->row()->meta_title;
			}
			if ($pageDetails->row()->meta_tag != ''){
		    	$this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
			}
			if ($pageDetails->row()->meta_description != ''){
		    	$this->data['meta_description'] = $pageDetails->row()->meta_description;
			}
    		$this->data['heading'] = $pageDetails->row()->meta_title;
    		$this->data['pageDetails'] = $pageDetails;
    		$this->load->view('site/cms/display_cms',$this->data);
    	}
    }
	
	/**
	 * 
	 * This function is used for list the help cms pages
	 * 
	 */
	public function help() {
		$condition = " where status='Publish' order by id desc limit 3";
		$this->data['help_topic'] = $this->cms_model->get_help_topis($condition);
		$this->load->view('site/cms/help',$this->data);
	}
	
	/**
	 * 
	 * This function is used for search the help pages
	 * 
	 */
	public function search_help() {
		$condition_topic = " where status='Publish' order by id desc limit 3";
		$this->data['help_topic'] = $this->cms_model->get_help_topis($condition_topic);
		
		$this->data['keyword'] = $keyword = $this->input->get('keyword');
		
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$curUrl = @explode('&per_page=',$CUrurl);
		if($this->input->get('per_page') != ''){
			$paginationVal = $this->input->get('per_page');
			$limitPaging = $paginationVal.',5';
		} else {
			$limitPaging = '5';
		}
		
		/* if($keyword!=''){
			$condition .= 'description like "%'.$keyword.'%" and status="Publish"';
		} else {
			$condition .= 'status="Publish"';
		} */
		
		if($keyword!=''){			
			$condition .= '(description like "%'.$keyword.'%" or page_title like "%'.$keyword.'%") and status="Publish"';
		} else {
			$condition .= 'status="Publish"';
		}
		
		/* $conds = explode(' ',$condition); 
		if($conds[1]=='and'){
			unset($conds[1]);	
			foreach($conds as $condsLists){
				$Condition .= $condsLists;
			}
		} else {	
				foreach($conds as $condsLists){
				$Condition .= $condsLists.' ';
			}
		} */
		
		$Condition = $condition;
		
		$this->data['search_help_details'] = $search_help_details = $this->cms_model->display_help_details($Condition,$limitPaging,$order_by)->result_array();
		$this->data['search_help_detailsCount'] = $search_help_detailsCount = $this->cms_model->display_help_detailsCount($Condition)->result_array();
		
		/**** Pagination begins ****/
		
		$config['total_rows'] = sizeof($search_help_detailsCount);
        $config['per_page'] = 5;
		$config['base_url'] = $curUrl[0];
		$config['prev_link'] = '<span class="nexi"></span>';
		$config['next_link'] = '<span class="prei" ></span>';
		$config['num_links'] = 5;
		$config['page_query_string'] = TRUE;
		$config['display_pages'] = FALSE; 
		
		$this->data['per_page_list'] = $config['per_page'];	

		$this->pagination->initialize($config);
		$paginationLink = $this->pagination->create_links();//die;
		$this->data['paginationLink'] = $paginationLink;
			
		/**** Pagination ends ****/	
		$this->load->view('site/cms/help',$this->data);
	}
	
}
/*End of file cms.php */
/* Location: ./application/controllers/site/product.php */