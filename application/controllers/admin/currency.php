<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Currency extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('location_model');
		if ($this->checkPrivileges('currency',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the location list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/location/display_user_list');
		}
	}
	
	/**
	 * 
	 * This function loads the currency list page
	 */
	public function display_currency_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Currency List';
			$condition = array();
			$this->data['currencyList'] = $this->location_model->get_all_details(CURRENCY,$condition);
			$this->load->view('admin/currency/display_currency',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the Country list page
	 */
	public function display_country_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else { 
			$this->data['heading'] = 'Country List';
			$condition = array();
			//$sortArr1 = array('field'=>'name','type'=>'asc');
			//$sortArr = array($sortArr1);
			$this->data['countryList'] = $this->location_model->get_all_details(LOCATIONS,$condition);
			$this->load->view('admin/location/display_country',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the location dashboard
	 */
	public function display_user_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'currency Dashboard';
			$condition = 'order by `created` desc';
			$this->data['currencyList'] = $this->user_model->get_location_details($condition);
			$this->load->view('admin/currency/display_currency_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new currency form
	 */
	public function add_currency_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Currency';
			$this->load->view('admin/currency/add_currency',$this->data);
		}
	}
	/**
	 * 
	 * This function insert and edit a user
	 */
	public function insertEditcurrency(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$currency_id = $this->input->post('id');
			$currency_name = $this->input->post('currency_name');
			$seourl = url_title($currency_name, '-', TRUE);
			if ($currency_id == ''){
				$condition = array('currency_name' => $currency_name);
				$duplicate_name = $this->location_model->get_all_details(CURRENCY,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','currency name already exists');
					redirect('admin/currency/add_currency_form');
				}
			}
			$excludeArr = array("id","status","currency_default","currency_symbol");
			
			if ($this->input->post('status') != ''){
				$currency_status = 'Active';
			}else {
				$currency_status = 'InActive';
			}
			
			$currency_value=$this->input->post('currency_value');

			$currency_data=array();
			$this->load->helper('text');
			$inputArr = array('status' => $currency_status,'currency_value'=>$currency_value,'currency_symbol'=>$this->input->post('currency_symbol'),'currency_name'=>$this->input->post('currency_name'));
			
			$dataArr = array_merge($inputArr,$currency_data);
			
			
			$condition = array('id' => $currency_id);
			if ($currency_id == ''){
				$this->location_model->commonInsertUpdate(CURRENCY,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Country added successfully');
			}else {
				//echo $curency_default;die;
				
				if($curency_default=='Yes'){
				//echo '<pre>';print_r($dataArr);die;
					$dataArr1=array('currency_default'=>'No');
					$this->location_model->update_details(CURRENCY,$dataArr1,array());
					//$conditionArr=array('id'=>$location_id);
					//$this->location_model->update_details(COUNTRY_LIST,$dataArr1,$conditionArr);
				}
				
				$this->location_model->commonInsertUpdate(CURRENCY,'update',$excludeArr,$dataArr,$condition);
				$this->location_model->saveCurrencySettings();
				$this->setErrorMessage('success','Currency updated successfully');
			}
			redirect('admin/currency/display_currency_list');
		}
	}
	
	/**
	 * 
	 * This function loads the edit user form
	 */
	public function edit_currency_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Currency';
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->data['currency_details'] = $this->location_model->get_all_details(CURRENCY,$condition);
			if ($this->data['currency_details']->num_rows() == 1){
				$this->load->view('admin/currency/edit_currency',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the currency status  //change_currency_default
	 */
	public function change_currency_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$currency_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'InActive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $currency_id);
			$this->location_model->update_details(CURRENCY,$newdata,$condition);
			$this->setErrorMessage('success','currency Status Changed Successfully');
			redirect('admin/currency/display_currency_list');
		}
	}
	
	
	/**
	 * 
	 * This function change the currency default currency
	 */
	public function change_currency_default(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$currency_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'No':'Yes';
			
			if($status == 'No'){
				$this->setErrorMessage('error','Sorry Atleat One Currency Should Be In Default Mode');
			    redirect('admin/currency/display_currency_list');
			} else {
			$this->location_model->update_details(CURRENCY,array('default_currency' => 'No'),array('default_currency' => 'Yes'));
			}
			$newdata = array('default_currency' => $status);
			$condition = array('id' => $currency_id);
			$this->location_model->update_details(CURRENCY,$newdata,$condition);
			$this->setErrorMessage('success','This Currency Changed As Default');
			redirect('admin/currency/display_currency_list');
		}
	}
	
	
	
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_currency(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View currency';
			$currency_id = $this->uri->segment(4,0);
			$condition = array('id' => $currency_id);
			$this->data['currency_details'] = $this->location_model->get_all_details(CURRENCY,$condition);
			if ($this->data['currency_details']->num_rows() == 1){
				$this->load->view('admin/currency/view_currency',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the user record from db
	 */
	public function delete_currency(){
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

/* End of file currency.php */
/* Location: ./application/controllers/admin/currency.php */