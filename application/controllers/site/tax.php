<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Tax extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','seller_model','user_model','order_model','tax_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
    }
    
  
	/** 
	 * 
	 * Displaying Tax List
	 */
	
	public function display_tax_list(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Display Tax List';
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());
			$this->data['seller_details']=$this->seller_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));	
			$this->data['tax_list']=$this->seller_model->get_all_details(SELLER_TAX,array('seller_id'=>$this->checkLogin('U')));	
			#echo "<pre>"; print_r($this->data['tax_list']->result()); die;
			$this->load->view('site/shop/display_tax_list',$this->data);
		}
	} 
	/** 
	 * 
	 * Load Tax Form for Add
	 */
	
	public function add_tax_form(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Add Tax';
			$this->data['country']=$this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
			$this->load->view('site/shop/add_tax_form',$this->data);
		}
	} 
	
	
	/** 
	 * 
	 * Load Tax Form for Edit
	 */
	
	public function edit_tax_form(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$this->data['heading'] = 'Edit Tax ';
			$taxId = $this->uri->segment(4);
			$this->data['taxDetails'] = $taxDetails =$this->user_model->get_all_details(SELLER_TAX,array('id'=>$taxId));
			//echo '<pre>'; print_r($this->data['taxDetails']->result());die;
			$this->data['country']=$this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
			$this->data['state']=$this->user_model->get_all_details(STATE_LIST,array('countryid'=>$taxDetails->row()->country_id),array(array('field'=>'name','type'=>'asc')))->result();
			$this->load->view('site/shop/edit_tax_form',$this->data);
		}
	} 
	
	/** 
	 * 
	 * Load State LIst for Country 
	 */
	
	public function insertEditTax(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$country_id = $this->input->post('country_name');
			$state_id = $this->input->post('state_name');
			$city_name = $this->input->post('city_name');
			$tax_amount = $this->input->post('tax');
			
			$tax_id = $this->input->post('tax_edit_id');
			
			
			$seourl = url_title($city_name, '-', TRUE);
			
			$GetCountry = array('id' => $country_id);
			$CountryDetails = $this->tax_model->get_all_details(COUNTRY_LIST,$GetCountry);
			
			$stateDetails = $this->tax_model->get_all_details(STATE_LIST,array('countryid'=>$country_id,'id'=>$state_id));
			
			$state_name=$stateDetails->row()->name;
			
			
			$sellerInfo=$this->seller_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));	
			
			/*if ($tax_id == ''){
				$condition = array('state_name' => $state_name,'city_name'=>$city_name,'seller_id'=>$this->checkLogin('U'));
				$duplicate_name = $this->tax_model->get_all_details(SELLER_TAX,$condition);
				if ($duplicate_name->num_rows() > 0){
					$this->setErrorMessage('error','This City already exists');
					redirect('shops/'.$sellerInfo->row()->seourl.'/add-tax');
				}
			}*/
			
			$tax_status = 'Active';
			
			$dataArr=array('seller_id'=>$this->checkLogin('U'),
										'city_name'=>$city_name,
										'state_name'=>$state_name,
										'state_code'=>$stateDetails->row()->state_code,
										'status'=>$tax_status,
										'dateAdded'=>$city_name,
										'tax_amount'=>$tax_amount,
										'country_id'=>$country_id,
										'country_code'=>$CountryDetails->row()->country_code,
										'country_name'=>$CountryDetails->row()->name,
										'seourl'=>$city_name,
			);
			
			
			$condition = array('id' => $tax_id);
			if ($tax_id == ''){
				$this->tax_model->simple_insert(SELLER_TAX,$dataArr);
				$tax_added=addslashes(af_lg('lg_tax_added','Tax added successfully'));
				$this->setErrorMessage('success',$tax_added);
			}else {
				unset($dataArr['seller_id']);unset($dataArr['seourl']);
				$this->tax_model->update_details(SELLER_TAX,$dataArr,$condition);
				$tax_updated=addslashes(af_lg('lg_tax_added','Tax updated successfully'));
				$this->setErrorMessage('success',$tax_updated);
			}	
			redirect('shops/'.$sellerInfo->row()->seourl.'/tax-list');
		}
	} 
	
	/** 
	 * 
	 * Load State LIst for Country 
	 * param int $country_id
	 */
	
	public function state_list_ajax($country_id=''){
		$state_list=$this->tax_model->get_all_details(STATE_LIST,array('countryid'=>$country_id));	
		$message = "";
		if($state_list->num_rows()>0){
			$message ='<option value="">Select State</option>';		
			foreach($state_list->result() as $row){
				$message.='<option value="'.$row->id.'">'.$row->name.'</option>';
			}
		}
		echo $message;
	} 
	
}
/* End of file user.php */
/* Location: ./application/controllers/site/user.php */