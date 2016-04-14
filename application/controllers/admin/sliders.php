<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to sliders management 
 * @author Teamtweaks
 *
 */

class Sliders extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('sliders_model');
		
    }
    
	/**
	 * 
	 * This function loads the sliders  list
	 */
	public function display_sliderslist(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Sliders list';
			$condition = array();
			$this->data['sliders_list'] = $this->sliders_model->get_all_details(HOME_SLIDERS,$condition);
			$this->load->view('admin/sliders/display_sliderslist',$this->data);
		}
	}
	
	/**
	 * 
	 * This function change the sliders  status
	 */
	public function change_sliders_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $id);
			$this->sliders_model->update_details(HOME_SLIDERS,$newdata,$condition);
			$this->setErrorMessage('success','Slider Status Changed Successfully');
			redirect('admin/sliders/display_sliderslist');
	}
	}
	/**
	 * 
	 * This function loads the add sliders form 
	 */
	public function add_slider_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add Slider';
			$condition = array();
			$this->load->view('admin/sliders/add_slider',$this->data);
			
		}
	}
	
	/**
	 * 
	 * This function insert and edit a sliders and his privileges
	 */
	public function insertEditslider(){
	   if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		
		    $datestring = "%y-%m-%d %H:%i:%s";
			$time = time();
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$description=$this->input->post('description');
			$status = $this->input->post('status');
			$link=$this->input->post('link');
			
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/sliders/';
			$this->load->library('upload', $config);
           
		   	
			$excludeArr = array("id");
			
       
            if ($this->upload->do_upload('image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
			    $inputArr= array('image'=>$ImageName);
			}
			else {
			$inputArr =array();
			}
          
           $user_data=array(
			                 'id'=>$id,
			                 'title'=>$title,
							'description'	=>$description,
							'created_date'	=>	mdate($datestring,$time),
			                'status'	=>	'Active');
	     
			$dataArr = array_merge($inputArr,$user_data);
		   // print_r($dataArr );die;
			$condition = array('id' =>$id);
			
		if ($id == ''){
				$this->user_model->commonInsertUpdate(HOME_SLIDERS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Slider added successfully');
			}else {
				$this->user_model->commonInsertUpdate(HOME_SLIDERS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Slider updated successfully');
				
			}
				redirect('admin/sliders/display_sliderslist');
		}
	}
		
	
	
	/**
	 * 
	 * This function loads the edit sliders form
	 */
	public function edit_sliders_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		    $id = $this->input->post('id');
			$this->data['heading'] = 'Edit Slider';
		    $id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$temp= $this->data['sliders_list'] = $this->sliders_model->get_all_details(HOME_SLIDERS,$condition);			
			if ($this->data['sliders_list']->num_rows() == 1){
				$this->load->view('admin/sliders/edit_slider',$this->data);
			}else {
				redirect('admin/sliders/display_sliderslist');
			}
		}
	} 
	
	/**
	 * 
	 * This function loads the sliders view page
	 */
	public function view_slider(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View slider';
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $id);
			$this->data['sliders_list'] = $this->user_model->get_all_details(HOME_SLIDERS,$condition);
			if ($this->data['sliders_list']->num_rows() == 1){
				$this->load->view('admin/sliders/view_slider',$this->data);
			}else {
				redirect('admin/sliders/display_sliderslist');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the sliders record from db
	 */
	public function delete_sliders(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			
			$sliders_list = $this->sliders_model->get_all_details(HOME_SLIDERS,array('id'=>$id));
			if ($sliders_list->num_rows()>0)
				
				$condition = array('id' => $id);
				$this->sliders_model->commonDelete(HOME_SLIDERS,$condition);
				$this->setErrorMessage('success','Slider deleted successfully');
			}
			redirect('admin/sliders/display_sliderslist');
		}
	
	
	/**
	 * 
	 * This function change the sliders status, delete the sliders record
	 */
	public function change_sliders_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->sliders_model->activeInactiveCommon(HOME_SLIDERS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Sliders deleted successfully');
			}else {
				$this->setErrorMessage('success','Sliders status changed successfully');
			}
			redirect('admin/sliders/display_sliderslist');
		}
	}
	public function ajax_check_slider_image_size(){
	list($w, $h) = getimagesize($_FILES["image"]["tmp_name"]);
			if($w >= 1400 && $h >= 400){
			echo 'Success';
			} else {
			echo 'Error';
			}
	}
}

/* End of file sliders.php */
/* Location: ./application/controllers/admin/sliders.php */
