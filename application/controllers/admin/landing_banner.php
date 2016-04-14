<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Banner management
 * @author Teamtweaks
 *
 */

class Landing_banner extends MY_Controller {  

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('Landing_model');
		if ($this->checkPrivileges('banner',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}

	/**
	 *
	 * This function loads the banner list page
	 */
	public function index(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/landing_banner/landingdisplay_banner');
		}
	}
	/**
	 *
	 * This function loads the banner list page
	 */
	public function landingdisplay_banner(){
	if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$this->data['heading'] = 'Banner List';
			$condition = array();
			$this->data['bannerList'] = $this->Landing_model->get_all_details(LANDING_BANNER,$condition);
			$this->load->view('admin/banner/landingdisplay_banner',$this->data);
		
			
		}
		
	}
	/**
	 *
	 * This function loads the banner settings form
	 */
	public function banner_settings_from(){
		if ($this->checkLogin('A') == ''){
				redirect('admin');
		}
		
		$this->data['heading'] = 'Landing Banner Settings';
		$condition = array();
		$this->data['bannerSettings'] = $this->Landing_model->get_all_details(BANNER_SETTINGS,$condition);
		$this->load->view('admin/banner/landing_banner_settings',$this->data);
		
	}
	/**
	 *
	 * This function update the banner setting
	 */
	function update_banner_settings(){
		if ($this->checkLogin('A') == ''){
				redirect('admin');
		} 
		$banner_row_exist=$this->input->post('banner_row_exist');
		$excludeArr=array("banner_row_exist");
		$dataArr=array();

		if($banner_row_exist == 'Yes'){	
			$condition = array('id' => 1);
			$this->Landing_model->commonInsertUpdate(BANNER_SETTINGS,'update',$excludeArr,$dataArr,$condition);
		} else {
			$this->Landing_model->commonInsertUpdate(BANNER_SETTINGS,'insert',$excludeArr,$dataArr);
		}
		#echo $this->db->last_query(); die;
		$this->setErrorMessage('success','Banner settings updated successfully');
		redirect('admin/landing_banner/banner_settings_from');
		
	}
	/**
	 *
	 * This function load the add new banner form
	 */
	public function landingadd_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Banner';
			
			$condition = array();
			$this->data['bannerList'] = $this->Landing_model->get_all_details(LANDING_BANNER,$condition);
			$this->data['bannerList_count']=$this->data['bannerList']->num_rows() ;
			
		   	$this->load->view('admin/banner/landingadd_banner',$this->data);
		}
	}
	/**
	 *
	 * This function Insert the banner in db
	 */
    public function landinginsertBanner(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$excludeArr = array("status","banner_image");
				
			if ($this->input->post('status') != ''){
				$banner_status = 'Publish';
			}else {
				$banner_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $banner_status
			);
				
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/landingbanner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				
				$ImageName = $logoDetails['file_name'];
			}else{
				$logoDetails = $this->upload->display_errors();
				$this->setErrorMessage('error',strip_tags($logoDetails));
				redirect('admin/landing_banner/landingadd_banner');
			}
			$banner_data = array( 'image' => $ImageName);

			$dataArr = array_merge($inputArr,$banner_data);

			$this->Landing_model->commonInsertUpdate(LANDING_BANNER,'insert',$excludeArr,$dataArr);
			$this->setErrorMessage('success','Banner added successfully');
			redirect('admin/landing_banner/landingdisplay_banner');
		}
	}
	/**
	 *
	 * This function changes the banner status
	 */
	public function change_landingbanner_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$banner_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $banner_id);
			$this->Landing_model->update_details(LANDING_BANNER,$newdata,$condition);
			$this->setErrorMessage('success','Banner Status Changed Successfully');
			redirect('admin/landing_banner/landingdisplay_banner');
		}
	}
	/**
	 *
	 * This function delete the banner 
	 */
	public function landingdelete_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$banner_id = $this->uri->segment(4,0);
			$condition = array('id' => $banner_id);
			$this->Landing_model->commonDelete(LANDING_BANNER,$condition);
			$this->setErrorMessage('success','Banner deleted successfully');
			redirect('admin/landing_banner/landingdisplay_banner');
			//'./images/landingbanner';
		}
	}
	/**
	 *
	 * This function load the banner edit form 
	 */
	public function landingedit_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Banner';
			$banner_id = $this->uri->segment(4,0);
			$condition = array('id' => $banner_id);
			$this->data['banner_details'] = $this->Landing_model->get_all_details(LANDING_BANNER,array('id'=>$banner_id));
			if ($this->data['banner_details']->num_rows() == 1){
				$this->load->view('admin/banner/landingedit_banner',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	/**
	 *
	 * This function edit the banner in db
	 */
	public function landingeditBanner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$bid = $this->input->post('banner_id');
			$excludeArr = array("status","banner_image","banner_id");
				
			if ($this->input->post('status') != ''){
				$banner_status = 'Publish';
			}else {
				$banner_status = 'Unpublish';
			}
				
			$inputArr = array(
						'status' => $banner_status
			);
				
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
					
			$config['upload_path'] = './images/landingbanner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
				$banner_data = array( 'image' => $ImageName);
			}else{
				$banner_data = array();
			}

			$dataArr = array_merge($inputArr,$banner_data);
			$condition = array('id'=>$bid);
			$this->Landing_model->commonInsertUpdate(LANDING_BANNER,'update',$excludeArr,$dataArr,$condition);
			$this->setErrorMessage('success','Banner updated successfully');
			redirect('admin/landing_banner/landingdisplay_banner');
		}
	}
	/**
	 *
	 * This function check the banner image size
	 */
	public function ajax_check_banner_image_size(){
	list($w, $h) = getimagesize($_FILES["banner_image"]["tmp_name"]);
			if($w >= 1400 && $h >= 400){
			echo 'Success';
			} else {
			echo 'Error';
			}
	}
	/**
	 *
	 * This function loads ad page
	 */
	
		public function show_ads(){
		if ($this->checkLogin('A') == ''){
				redirect('admin');
		}
		
		$this->data['heading'] = 'Show Ads';
		$condition = array();
		$this->data['adSetting'] = $this->Landing_model->get_all_details('shopsy_ads',$condition);
		$this->load->view('admin/banner/ads_banner_settings',$this->data);
		
	}
	
}

/* End of file banner.php */
/* Location: ./application/controllers/admin/banner.php */