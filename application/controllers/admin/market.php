<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Market extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model'));
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();	 	
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
	 * This function loads the user view page 
	 */
	public function view_product_spam(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View currency';
			$spam_id = $this->uri->segment(4,0);
			$condition = " where spam.id = '".$spam_id."'";
			$this->data['spamList'] = $this->product_model->view_spam_product_reports($condition);
			$this->load->view('admin/spam_report/view_product_spam',$this->data);
			
			
		}
	}
		/**
	 * 
	 * This function loads the user view page delete_product_spam
	 */
	public function delete_product_spam(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->location_model->commonDelete(CURRENCY,$condition);
			$this->setErrorMessage('success','currency deleted successfully');
			redirect('admin/currency/display_currency_list');
			
			
		}
	}
	
	
	
}
/*End of file market.php */
/* Location: ./application/controllers/site/market.php */
