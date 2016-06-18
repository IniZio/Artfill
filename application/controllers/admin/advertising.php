<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to advertising management
 * @author Teamtweaks
 *
 */

class Advertising extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('advertising_model');
		if ($this->checkPrivileges('advertising',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	/**
	 *
	 * This function loads the advertising list page
	 */
	 public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function loads the advertising list page
	 */
	public function display_advertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Advertising List';
			$condition = array();
			$this->data['advertisingList'] = $this->advertising_model->get_all_details(ADVERTISING,$condition,array(array('field' => 'id','type' => 'desc')));
			$this->load->view('admin/advertising/display_advertising',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the advertising add page
	 */
	public function add_advertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Advertising';
			$this->load->view('admin/advertising/add_advertising',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the advertising view page
	 */
	public function view_advertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {		
			$this->data['heading'] = 'View Advertising';
			if($this->uri->segment(4) != ''){
				$this->data['advertisingDetail']=$this->advertising_model->get_all_details(ADVERTISING,array('id' => $this->uri->segment(4)));
				$this->load->view('admin/advertising/view_advertising',$this->data);
			} else {
				redirect('admin');
			}
		}
	}
	/**
	 * 
	 * This function loads the advertising edit page
	 */
	public function edit_advertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Advertising';
			$advertising_id = $this->uri->segment(4,0);
			$condition = array('id' => $advertising_id);
			$this->data['advertisingDetail'] = $this->advertising_model->get_all_details(ADVERTISING,array('id'=>$advertising_id));			
			if ($this->data['advertisingDetail']->num_rows() == 1){
				$this->load->view('admin/advertising/edit_advertising',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	/**
	 * 
	 * This function delete the advertising 
	 */
	public function delete_advertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$advertising_id = $this->uri->segment(4,0);
			$condition = array('id' => $advertising_id);
			$this->advertising_model->commonDelete(ADVERTISING,$condition);
			$this->setErrorMessage('success','Advertising deleted successfully');
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function changes the advertising status
	 */
	public function change_advertising_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$advertising_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $advertising_id);
			$this->advertising_model->update_details(ADVERTISING,$newdata,$condition);
			$this->setErrorMessage('success','Advertising Status Changed Successfully');
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function changes the advertising status global
	 */
	public function change_advertising_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->advertising_model->activeInactiveCommon(ADVERTISING,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Advertising records deleted successfully');
			}else {
				$this->setErrorMessage('success','Advertising records status changed successfully');
			}
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function Add a new advertising to db
	 */
	public function insertAdvertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			#echo '<pre>'; print_r($_POST);
			#echo '<pre>'; print_r($_FILES); die;
			$excludeArr = array("status","advertising_image","img_size");
				
			if ($this->input->post('status') != ''){
				$advertising_status = 'Publish';
			}else {
				$advertising_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $advertising_status,
						'dateAdded'=>date('Y-m-d H:m:s')
			);
			if($_FILES['advertising_image']['name']!=""){	
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/advertising';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('advertising_image')){
					$logoDetails = $this->upload->data();
					if($this->input->post('img_size') != ''){
						$img_size=@explode('-',$this->input->post('img_size'));
						$this->imageResizeWithSpace($img_size[0], $img_size[1], $logoDetails['file_name'], './images/advertising/');
					}
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',strip_tags($logoDetails));
					redirect('admin/advertising/add_advertising');
				}
				$advertising_data = array( 'image' => $ImageName);
			}else{
				$advertising_data = array( 'image' => "");
			}

			$dataArr = array_merge($inputArr,$advertising_data);

			$this->advertising_model->commonInsertUpdate(ADVERTISING,'insert',$excludeArr,$dataArr);
			$this->setErrorMessage('success','Advertising added successfully');
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function edits a existing advertising in db
	 */
	public function editAdvertising(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {		
			$advertising_id = $this->input->post('advertising_id');
			$excludeArr = array("status","advertising_image","advertising_id","img_size");
				
			if ($this->input->post('status') != ''){
				$advertising_status = 'Publish';
			}else {
				$advertising_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $advertising_status
			);
				
			if($_FILES['advertising_image']['name']!=""){	
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/advertising';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('advertising_image')){
					$logoDetails = $this->upload->data();
					if($this->input->post('img_size') != ''){
						$img_size=@explode('-',$this->input->post('img_size'));
						$this->imageResizeWithSpace($img_size[0], $img_size[1], $logoDetails['file_name'], './images/advertising/');
					}
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',strip_tags($logoDetails));
					redirect('admin/advertising/add_advertising');
				}
				$advertising_data = array( 'image' => $ImageName);
			}else{
				$advertising_data = array();
			}
			
			$dataArr = array_merge($inputArr,$advertising_data); 
			
			$condition = array('id'=>$advertising_id);
			$this->advertising_model->commonInsertUpdate(ADVERTISING,'update',$excludeArr,$dataArr,$condition);
			$this->setErrorMessage('success','Advertising updated successfully');
			redirect('admin/advertising/display_advertising');
		}
	}
	/**
	 * 
	 * This function validate the advertising image
	 */
	function Ajax_banner_validate(){
		 list($w, $h) = getimagesize($_FILES["banner_image"]["tmp_name"]);
		 $img_size=@explode('-',$this->input->post('img_size')); 
			if($w >= $img_size[0] && $h >= $img_size[1]){
					echo 'Success|Success';
			}else{
				echo 'Failure|Please Upload Image Size  Equal to '.$img_size[0].' x '.$img_size[1].' Pixels .';
			}	
		
	}

}

/* End of file advertising.php */
/* Location: ./application/controllers/admin/advertising.php */