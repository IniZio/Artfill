<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Users extends MY_Controller {

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
		echo "dfg"; die;
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Product Feedback';
			$condition = array();
			$this->data['productFeedbackLists'] = $this->product_model->get_all_details(PRODUCT_FEEDBACK,$condition);
			print_r($this->data['productFeedbackLists']); die;
		//	$this->load->view('admin/paygateway/display_gateway',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the users list page
	 */
	

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */