<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * This controller contains the functions related to Shipping management 
 * @author Teamtweaks
 *
 */
class Shipping extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('shipping_model'));
		if ($this->checkPrivileges('shipping_method',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/shipping/ShippingList');
		}
	}
	public function ShippingList(){
	
		$this->data['heading'] = "Shipping List";
		$this->data['shippingmethods'] = $this->shipping_model->get_all_details(SHIPPIN_METHODS,array());

		$this->load->view('admin/shipping/shippinglist',$this->data);
	}	
	public function installShipping(){
		$title = $this->uri->segment(4);
		$this->data['heading'] = "Edit ".$title;
		$shippingDetails = $this->shipping_model->get_all_details(SHIPPIN_METHODS, array('name'=> $title));
		if($shippingDetails->num_rows() >0){
			$this->data['shippingDetails'] = $shippingDetails;
		}else{
			$dataArr = array(
				'name' => $title,
				'status' => 'Inactive',
				'proceed' => 'Install'
			);
			$insert = $this->shipping_model->simple_insert(SHIPPIN_METHODS, $dataArr);
			$this->shipping_model->saveShippingSettings();
			$shippingDetails = $this->shipping_model->get_all_details(SHIPPIN_METHODS, array('name'=> $title));
			$this->data['shippingDetails'] = $shippingDetails;
		}
		$this->load->view('admin/shipping/'.$title, $this->data);
	}
	public function uninstallShipping(){
		$title = $this->uri->segment(4);
		$shippingDetails = $this->shipping_model->get_all_details(SHIPPIN_METHODS, array('name'=> $title));
		if($shippingDetails->num_rows() ==1){
			$this->shipping_model->commonDelete(SHIPPIN_METHODS, array('id'=>$shippingDetails->row()->id));
			$this->shipping_model->saveShippingSettings();
			$this->setErrorMessage('success','Successfully uninstalled '.$title.' Shipping.');
		}else{
			$this->setErrorMessage('error','Cannot Find '.$title.' Shipping.');
		}
		redirect('admin/shipping/Shippinglist');
	}
	public function insertShipping(){
		$sid = $this->input->post('sid');
		$title = $this->input->post('title');
		$excludeArr = array('sid','status','mode','title');
		foreach($this->input->post() as $key => $val){
			if (!in_array($key, $excludeArr)){
				$shippingSettings[$key] = $val;
			}
		}
		if($this->input->post('status') == 'on'){
			$status = 'Active';
		}else{
			$status = 'Inactive';
		}
		$dataArr = array(
			'settings' => serialize($shippingSettings),
			'sandbox' => $this->input->post('mode'),
			'status' => $status
		);
		$condition = array('id' => $sid);	
		if($sid!=''){
			$this->shipping_model->update_details(SHIPPIN_METHODS, $dataArr, $condition);
			$this->shipping_model->saveShippingSettings();
			$this->setErrorMessage('success','Successfully updated '.$title.' Shipping.');
		}else{
			$this->setErrorMessage('error','Cannot Find '.$title.' Shipping.');
		}
		redirect('admin/shipping/ShippingList');
	}
	public function editShipping(){
		if($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$title = $this->uri->segment(4,0);
			$this->data['heading'] = "Edit ".$title;
			$condition = array('name' => $title);
			$this->data['shippingDetails'] = $this->shipping_model->get_all_details(SHIPPIN_METHODS,$condition);
			if($this->data['shippingDetails']->num_rows() == 1){
				$this->load->view('admin/shipping/'.$title, $this->data);
			}else{
				$this->setErrorMessage('error','Cannot Find '.$title.' Shipping.');
				redirect('admin');
			}
		}
	}
}

/* End of file shipping.php */
/* Location: ./application/controllers/admin/shipping.php */