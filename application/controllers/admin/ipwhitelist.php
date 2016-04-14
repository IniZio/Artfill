<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ipwhitelist extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('sliders_model');
		
    }
 public function display_all_ipwhitelisters(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'IP address White listers';
			$condition = array();
			$this->data['white_listers'] = $this->sliders_model->get_all_details(IPWHITELIST,$condition);
			//print_r($this->data['white_listers']);die;
			$this->load->view('admin/ipwhitelister/display_all_ipwhitelisters',$this->data);
		}
	}
public function add_ipaddress_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add new white IP address';
			$this->data['id'] = $this->uri->segment(4,0);
			$condition = array();
			$this->load->view('admin/ipwhitelister/add_new_ipwhitelister',$this->data);
			
		}
	}
public function add_ipaddress(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			
            $id = $this->input->post('id');
		    $created_on=$this->input->post('created_on');
			$ip_address = $this->input->post('ip_address');
			// print_r($id);die;
			
			$datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
            $time = time();

			if($ip_address == ''){
				$this->setErrorMessage('error','IP address required');
				redirect('admin/ipwhitelist/add_ipaddress_form');
			}

			$condition = array('ip_address' => $ip_address);
				//print_r($condition);die;
			//$duplicate_name = $this->category_model->get_all_details(CATEGORY,$condition);
			$duplicate_address = $this->sliders_model->get_all_details(IPWHITELIST,$condition);
			//print_r($duplicate_address);die;
			if ($duplicate_address->num_rows() > 0){
				$this->setErrorMessage('error','This IP address already exist');
				redirect('admin/ipwhitelist/add_ipaddress_form/'.$id);
				
			}

	     $dataArr = array('ip_address' => $ip_address,'id'=>$id,'created_on'=>$created_on);
						
		$this->sliders_model->add_ipaddress($dataArr); 
		$this->setErrorMessage('success','IP address successfully');
		redirect('admin/ipwhitelist/display_all_ipwhitelisters');
			 //redirect('admin/category/display_category_list');
		}
	}
  public function delete_ipaddress(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			
			$white_listers = $this->sliders_model->get_all_details(IPWHITELIST,array('id'=>$id));
			if ($white_listers->num_rows()>0)
				
				$condition = array('id' => $id);
				$this->sliders_model->commonDelete(IPWHITELIST,$condition);
				$this->setErrorMessage('success','Particular IP_address deleted successfully');
			}
			redirect('admin/ipwhitelist/display_all_ipwhitelisters');
		}
		

  public function change_ip_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
		
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','IP address deleted successfully');
			}
			redirect('admin/ipwhitelist/display_all_ipwhitelisters');
		}
	} 
			
	}		

			
			
			
	
	
