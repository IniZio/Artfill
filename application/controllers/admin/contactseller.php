<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to payment gateway management
 * @author Teamtweaks
 *
 */

class Contactseller extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('contactseller_model');
		if ($this->checkPrivileges('contactshopowner',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the paygateway list
     */
   	public function index(){	
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/contactseller/display_contact_seller');
		}
	}
	
	/**
	 * 
	 * This function loads the Contact seller list
	 */
	public function display_contact_seller(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Contact Shop Owner';
			$condition = array();
			#$this->data['ContactList'] = $this->contactseller_model->get_all_details(CONTACTSHOPSELLER,$condition);
			$this->data['ContactList'] = $this->contactseller_model->get_all_contact_shop_details();
			
			#echo '<pre>'; print_r($this->data['ContactList']->result()); die;
			$this->load->view('admin/contactseller/display_contact_seller',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the edit gateway form
	 */
	public function view_contactseller_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Contact Shop Owner';
			$cont_Id = $this->uri->segment(4,0);
			$condition = array('id' => $cont_Id);
			$this->data['contact_seller_status'] = $this->contactseller_model->get_all_details(CONTACTSHOPSELLER,$condition);
			if ($this->data['contact_seller_status']->num_rows() == 1){
				$this->load->view('admin/contactseller/view_contact_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	/**
	 * 
	 * This function delete the Contact User from db
	 */
	public function delete_contactseller_info(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->contactseller_model->commonDelete(CONTACTSHOPSELLER,$condition);
			$this->setErrorMessage('success','Contact information deleted successfully');
			redirect('admin/contactseller/display_contact_seller');
		}
	}
	
	/**
	 * 
	 * This function change the contact seller status
	 */
	public function change_contact_seller_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				$mode = $this->uri->segment(4,0);
				$gateway_id = $this->uri->segment(5,0);
				$status = ($mode == '0')?'Disable':'Enable';
				$newdata = array('status' => $status);
				$condition = array('id' => $gateway_id);
				$this->contactseller_model->update_details(PAYMENT_GATEWAY,$newdata,$condition);
				$this->contactseller_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment Gateway Status Changed Successfully');
				redirect('admin/paygateway/display_gateway');
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/paygateway/display_gateway');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the seller request records
	 */
	public function change_contact_seller_status_global(){
		if (!$this->data['demoserverChk']){
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$this->contactseller_model->activeInactiveCommon(PAYMENT_GATEWAY,'id');
				$this->contactseller_model->savePaymentSettings();
				$this->setErrorMessage('success','Payment gateway records status changed successfully');
				redirect('admin/paygateway/display_gateway');
			}
		}else {
			$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
			redirect('admin/paygateway/display_gateway');
		}
	}
	
	/**
	 * 
	 * This function loads the Contact by product list
	 */
	public function display_askquestion_seller(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Questions From User to Shop Owner';
			$condition = array();
			#$this->data['ContactList'] = $this->contactseller_model->get_all_details(CONTACTSELLER,$condition);
			$this->data['ContactList'] = $this->contactseller_model->get_all_contact_shop_ask_details();
			
			#echo '<pre>'; print_r($this->data['ContactList']->result()); die;
			$this->load->view('admin/contactseller/display_askquestion_seller',$this->data);
		}
	}
	/**
	 * 
	 * This function delete the Contact by product from db
	 */
	public function delete_askquestion_info(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->contactseller_model->commonDelete(CONTACTSELLER,$condition);
			$this->setErrorMessage('success','Contact information deleted successfully');
			redirect('admin/contactseller/display_askquestion_seller');
		}
	}
	/**
	 * 
	 * This function loads the Contact by product form
	 */
	public function view_askquestion_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Questions From User';
			$cont_Id = $this->uri->segment(4,0);
			$condition = array('id' => $cont_Id);
			$this->data['contact_seller_status'] = $this->contactseller_model->get_all_details(CONTACTSELLER,$condition);
			if ($this->data['contact_seller_status']->num_rows() == 1){
				$this->data['prodDetails'] = $this->contactseller_model->get_all_details(PRODUCT,array('id'=>$this->data['contact_seller_status']->row()->product_id));
				$this->load->view('admin/contactseller/view_askquestion_seller',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function loads the offer by product form
	 */
	public function display_chat_offer(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Display Offers';
			$this->data['offer_details'] = $this->contactseller_model->get_all_offer_details();
			$this->load->view('admin/offers/display_chat_offer',$this->data);
			
		}
	}

	
}

/* End of file contactseller.php */
/* Location: ./application/controllers/admin/contactseller.php */