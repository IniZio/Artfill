<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Spam extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model'));
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
		if ($this->checkPrivileges('complaints',$this->privStatus) == FALSE){
			redirect('admin');
		}	 	
    }
	
	public function index(){
		
    }
   
	/**
	 * 
	 * This function loads the spam product  list page  
	 */
	public function spam_product_List(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Product Complaints List';
			$condition = " where p.id = spam.product_id and spam.product_id IS NOT NULL group by p.id";
			$this->data['spamList'] = $this->product_model->view_spam_product_reports($condition);
			$this->load->view('admin/spam_report/display_product_spam',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the spam shop  list page 
	 */
	public function spam_shop_List(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Shop Complaints List';
			$condition = " where u.id = spam.seller_id and spam.seller_id IS NOT NULL group by spam.seller_id";
			$this->data['spamList'] = $this->product_model->view_spam_shop_reports($condition);
			
			$this->load->view('admin/spam_report/display_shop_spam',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the user view page   //view_product_spam_reply
	 */
	public function view_product_spam(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Product Complaint Details';
			$spam_product_id = $this->uri->segment(4,0); 
			$condition = " where spam.product_id = '".$spam_product_id."'";
			$this->data['spamList'] = $this->product_model->view_spam_product_details($condition);
			
			$this->load->view('admin/spam_report/view_product_spam',$this->data);
			
			
		}
	}
	/**
 *
 * This function loads the spamed shop  
 */

	
	public function view_shop_spam(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Shop Complaint Details';
			$spam_product_id = $this->uri->segment(4,0); 
			$condition = " where spam.seller_id = '".$spam_product_id."'";
			$this->data['spamList'] = $this->product_model->view_spam_shop_details($condition);
			
			$this->load->view('admin/spam_report/view_shop_spam',$this->data);
			
			
		}
	}
	
	
		/**
	 * 
	 * This function loads the view product spam reply  
	 */
	public function view_product_spam_reply(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Complaint Details And Reply';
			$spam_product_id = $this->uri->segment(4,0); 
			$condition = " where spam.id = '".$spam_product_id."'";
			$this->data['spamList'] = $this->product_model->view_spam_product_details($condition)->row();
			
			$this->load->view('admin/spam_report/display_product_spam_reply',$this->data);
			
			
		}
	}
	/**
 *
 * This function loads the view shop spam reply  
 */

	public function view_shop_spam_reply(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Complaint Details And Reply';
			$spam_product_id = $this->uri->segment(4,0); 
			$condition = " where spam.id = '".$spam_product_id."'";
			$this->data['spamList'] = $this->product_model->view_spam_shop_details($condition)->row();
			
			$this->load->view('admin/spam_report/display_shop_spam_reply',$this->data);
			
			
		}
	}
	
	
	
	
	
		/**
	 * 
	 * This function loads the view product spam admin tto user through email reply  
	 */
	public function spam_admin_reply(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			
			
			$message='<html><body>
			<div style=" width:400px; background-color:#CFF; border:#000 solid">
			<div style="width:400; background-color:#33CCFF;  border:#000">
			<span><h1>Spam Reply From '.$this->config->item('email_title').'</h1></span>
			</div>
			<h2>Hi '.$this->input->post('to_name').'!</h2>
			<div style="width:auto; background-color:#FFF">
			<p>'.$this->input->post('message').'</p>
			</div>
			<h3>Thank You for spam report..</h3>
			</div>
			';
			
			$email_values = array('mail_type'=>'html',
								'from_mail_id'=>$this->config->item('site_contact_email'),
								'mail_name'=>$this->config->item('email_title'),
								'to_mail_id'=>$this->input->post('to_mail'),
								'subject_message'=>$this->input->post('subject'),
								'body_messages'=>$message
								);
			  // $email_send_to_common = $this->user_model->common_email_send($email_values);
				$this->setErrorMessage('success','Reply sent to user successfully !');
				redirect('admin/spam/spam_product_List');
		}
	}
	
		/**
	 * 
	 * This function loads the user view page delete_product_spam
	 */
	public function delete_spam_products(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {  
			$currency_id = $this->uri->segment(4,0);  
			$condition = array('product_id' => $currency_id);
			$this->product_model->commonDelete(SPAM_REPORT,$condition);
			$this->setErrorMessage('success','Spam report removed successfully');
			redirect('admin/spam/spam_product_List');
			
			
		}
	}
	
		/**
	 * 
	 * This function delete the spam report of shop
	 */
	
	public function delete_spam_shops(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {  
			$currency_id = $this->uri->segment(4,0);  
			$condition = array('id' => $currency_id);
			$this->product_model->commonDelete(SPAM_REPORT,$condition);
			$this->setErrorMessage('success','Spam report removed successfully');
			redirect('admin/spam/spam_shop_List');
			
			
		}
	}
		/**
	 * 
	 * This function delete the spam report of product
	 */
	public function delete_product_spam_record(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else { 
			$currency_id = $this->uri->segment(4,0); //echo $this->uri->segment(5,0); die;
			$condition = array('id' => $currency_id);
			$this->product_model->commonDelete(SPAM_REPORT,$condition); 
			$this->setErrorMessage('success','Spam report removed successfully');
			redirect('admin/spam/view_product_spam/'.$this->uri->segment(5,0));
			
			
		}
	}	/**
	 * 
	 * This function delete the spam report of shop
	 */
	
	
	public function delete_shop_spam_record(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else { 
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->product_model->commonDelete(SPAM_REPORT,$condition); 
			$this->setErrorMessage('success','Spam report removed successfully');
			redirect('admin/spam/view_shop_spam/'.$this->uri->segment(5,0));
			
			
		}
	}
	
	
	
}
/*End of file market.php */
/* Location: ./application/controllers/site/market.php */
