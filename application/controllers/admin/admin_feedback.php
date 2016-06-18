<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Admin_feedback extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('user_model','seller_model'));
	
		if ($this->checkPrivileges('user',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
		public function display_product_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Product Feedback';
			$condition = array();
			$count_qry="select count(*) as total from ".PRODUCT_FEEDBACK."";
			$this->data['count_tot']=$this->product_model->ExecuteQuery($count_qry);
			#print_r($this->data['count_tot']->row());
			$count_qry="select count(*) as total from ".PRODUCT_FEEDBACK." where status='Active'";
			$this->data['count_active']=$this->product_model->ExecuteQuery($count_qry);
			#print_r($this->data['count_active']->row());
			$count_qry="select count(*) as total from ".PRODUCT_FEEDBACK." where status='Inactive'";
			$this->data['count_inactive']=$this->product_model->ExecuteQuery($count_qry);
		#	print_r($this->data['count_inactive']->row());die;
			if(isset($_GET['status'])){ 
				//$status="'status','".$_GET['status']."'";				
				$this->data['productFeedbackLists'] = $this->product_model->get_product_details($_GET['status']);
			}else {
					$this->data['productFeedbackLists'] = $this->product_model->get_product_details();
				}
				#echo $this->db->last_query();
			#print_r($this->data['productFeedbackLists']);die;
				$this->load->view('admin/feedback/display_product_feedback',$this->data);
		}
	}
	 /**
	 * 
	 * This function loads shops FEEDBACK
	 */
  
	public function display_shop_feedback(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Feedback';
			$condition = array();
			$this->data['shopFeedbackLists'] = $this->seller_model->get_shop_details();
			
				$this->load->view('admin/feedback/display_shop_feedback',$this->data);
		}
	}
	/**
	 * 
	 * This function loads product FEEDBACK
	 */
	public function view_product_feedback($id='')
	{ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
	
		}else {
		
			$condition = $id;
			$this->data['heading'] = 'View Product Feedback';
			$this->data['GetproductFeedbackLists'] = $this->product_model->get_productfeed_details_admin($condition);
			$this->load->view('admin/feedback/view_product_feedback',$this->data);
		}
	}
	/**
	 * 
	 * This function loads FEEDBACK report
	 */
	public function display_feedback_report()
	{ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
	
		}else {		
			$this->data['heading'] = 'View Feedback Report';
			$this->data['GetreportFeedbackLists'] = $this->seller_model->get_reviewreport_details();
			#echo "<pre>"; print_r($this->data['GetreportFeedbackLists']->result()); die; 
			$this->load->view('admin/feedback/display_feedback_report',$this->data);
		}
	}
	/**
	 * 
	 * This function loads  FEEDBACK
	 * Param Int sellerId
	 */
	public function view_feedback_report($id=''){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
	
		}else {
		
			$condition = $id;
			$this->data['heading'] = 'View Feedback Report';
			$this->data['GetproductFeedbackLists'] = $this->seller_model->get_reviewreport_details($condition);
			$this->load->view('admin/feedback/view_feedback_report',$this->data);
		}
	}
	/**
	 * 
	 * This function loads  FEEDBACK
	 * Param Int sellerId
	 */
	public function view_shop_feedback($id=''){
	 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
	
		}else {
		
			$condition = $id;
			$this->data['heading'] = 'View Shop Feedback';
			$this->data['GetproductFeedbackLists'] = $this->seller_model->get_shopfeed_details($condition);
				$this->load->view('admin/feedback/view_shop_feedback',$this->data);
		}
	}
	/**
	 * 
	 * This function Delete product FEEDBACK
	 * 
	 */
	
		public function delete_product_feedback(){
			if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_feedback_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_feedback_id);
			$reviewDetails = $this->user_model->get_all_details(PRODUCT_FEEDBACK,array('id'=>$product_feedback_id))->row();
			if($condition!='')
			{
				$this->product_model->commonDelete(PRODUCT_FEEDBACK,$condition);
			}			
			$query="SELECT AVG(rating) as shop_ratting,COUNT(*) as review_count  FROM ".PRODUCT_FEEDBACK." WHERE status='Active' and shop_id=".$reviewDetails->shop_id; 
			$shop_ratting=$this->user_model->ExecuteQuery($query)->row();
			$ratting=round($shop_ratting->shop_ratting,2);
			$review_count=$shop_ratting->review_count;
			$condition = array('seller_id'=>$reviewDetails->shop_id);
			$dataArr = array('shop_ratting'=>$ratting,'review_count'=>$review_count);
			$this->user_model->update_details(SELLER,$dataArr,$condition);		
			
			$this->setErrorMessage('success','Product feedback deleted successfully');
			redirect('admin/admin_feedback/display_product_feedback');
		}
	}
	/**
	 * 
	 * This function delete shops FEEDBACK
	 */
	
			public function delete_shop_feedback(){
			if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$shop_feedback_id = $this->uri->segment(4,0);
			$condition = array('id' => $shop_feedback_id);
			if($condition!='')
			{
				$this->seller_model->commonDelete(FEEDBACK,$condition);
			}
			$this->setErrorMessage('success','Product feedback deleted successfully');
			redirect('admin/admin_feedback/display_shop_feedback');
		}
	}
	/**
	 * 
	 * This function changes product FEEDBACK status
	 */
	public function change_product_feedback_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_feedback_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $product_feedback_id);
			$this->user_model->update_details(PRODUCT_FEEDBACK,$newdata,$condition);
			/*Update review and rating */			
			$reviewDetails = $this->user_model->get_all_details(PRODUCT_FEEDBACK,$condition)->row();
			
			$query="SELECT AVG(rating) as shop_ratting,COUNT(*) as review_count  FROM ".PRODUCT_FEEDBACK." WHERE status='Active' and shop_id=".$reviewDetails->shop_id; 
			$shop_ratting=$this->user_model->ExecuteQuery($query)->row();
			$ratting=round($shop_ratting->shop_ratting,2);
			$review_count=$shop_ratting->review_count;
			$condition = array('seller_id'=>$reviewDetails->shop_id);
			$dataArr = array('shop_ratting'=>$ratting,'review_count'=>$review_count);
			$this->user_model->update_details(SELLER,$dataArr,$condition);		
				
			$this->setErrorMessage('success','Product feedback Status '.$status.' Successfully');
			redirect('admin/admin_feedback/display_product_feedback');
		}
	}
	/**
	 * 
	 * This function changes shop FEEDBACK status
	 */
		public function change_shop_feedback_status(){
			if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$shop_feedback_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $shop_feedback_id);
			$this->user_model->update_details(FEEDBACK,$newdata,$condition);
			$this->setErrorMessage('success','Shop feedback Status '.$status.' Successfully');
			redirect('admin/admin_feedback/display_shop_feedback');
		}
	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */