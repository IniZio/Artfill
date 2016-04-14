<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Banner management
 * @author Teamtweaks
 *
 */

class Banner extends MY_Controller {  

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('banner_model');
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
			redirect('admin/banner/display_banner');
		}
	}
	/**
	 *
	 * This function loads the banner list page
	 */
	public function display_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Banner List';
			$condition = array();
			$this->data['bannerList'] = $this->banner_model->get_all_details(BANNER,$condition);
			$this->load->view('admin/banner/display_banner',$this->data);
		}
	}
	/**
	 *
	 * This function loads the shop banner list page
	 */
   public function display_shop_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Banner List';
			$condition = array();
			$this->data['bannerList'] = $this->banner_model->get_all_details(BANNER,$condition);
			$this->load->view('admin/shop_banner/display_shop_banner',$this->data);
		}
	}
	/**
	 *
	 * This function loads the add banner form
	 */
	public function add_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Banner';
			$this->load->view('admin/banner/add_banner',$this->data);
		}
	}
	/**
	 *
	 * This function loads the add shop banner form
	 */
    public function add_shop_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Banner';
			$this->load->view('admin/shop_banner/add_shop_banner',$this->data);
		}
	}
	/**
	 *
	 * This function insert the banner in db
	 */
	public function insertBanner(){
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
			if($_FILES['banner_image']['name'] !=''){	
				 list($w, $h) = getimagesize($_FILES["banner_image"]["tmp_name"]);
			if($w >= 600 && $h >= 400 && $w <= 700 && $h <= 500){
			} else {
			$this->setErrorMessage('error','Upload Image Too big or Too small ('.$w.' X '.$h.'). Please Upload Image Size Equalto 650 X 450');
			redirect('admin/banner/add_banner');
			}			
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/banner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
			}else{
				$logoDetails = $this->upload->display_errors();
				$this->setErrorMessage('error',strip_tags($logoDetails));
				redirect('admin/banner/add_banner_form');
			}
			}else{
			$this->setErrorMessage('error','Image Field Required');
			redirect('admin/banner/add_banner');
			}
			$banner_data = array( 'image' => $ImageName);

			$dataArr = array_merge($inputArr,$banner_data);

			$this->banner_model->commonInsertUpdate(BANNER,'insert',$excludeArr,$dataArr);
			$this->setErrorMessage('success','Banner added successfully');
			redirect('admin/banner/display_banner');
		}
	}
	/**
	 *
	 * This function changes banner status
	 */
	public function change_banner_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$banner_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $banner_id);
			$this->banner_model->update_details(BANNER,$newdata,$condition);
			$this->setErrorMessage('success','Banner Status Changed Successfully');
			redirect('admin/banner/display_banner');
		}
	}

	public function change_ads_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$ad_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			
			$newdata = array('status' => $status);
			$condition = array('id' => $ad_id);
			$this->banner_model->update_details('shopsy_ads',$newdata,$condition);
			$this->setErrorMessage('success','Ad Status Changed Successfully');
			
			redirect('admin/landing_banner/show_ads');
		}
	}
	
	
	public function edit_ads(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Ads Banner';
			
			$ad_id = $this->uri->segment(4,0);
					
			$condition = array('id' => $ad_id);
			$this->data['ads_details'] = $this->banner_model->get_all_details('shopsy_ads',$condition);
					
			$this->load->view('admin/banner/ads_edit_banner',$this->data);
		}
	}
	
	
		public function updateAds(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$ad_id = $this->input->post('ads_id');
			$ad_status = $this->input->post('status');
			$ad_path = $this->input->post('ad_script');
			if($ad_status==''){
				$ad_status = 'UnPublish';
				} else {
				$ad_status = 'Publish';
				}
		
			$ad_type = $this->input->post('ads_type');
			
			if($ad_type=="Image"){
			$inputArr = array(
						'ad_type' => 'Image',
						'status' => $ad_status
						
			);
				#var_dump($_FILE); die;
				
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/adsimage';
			$this->load->library('upload', $config);
			if( $this->upload->do_upload('ad_image1')){
				
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
				$ad_data = array( 'ad_image' => $ImageName);
			}else{
				$ad_data = array();
			}

			$dataArr = array_merge($inputArr,$ad_data);
			$condition = array('id'=>$ad_id);
			$this->banner_model->update_details('shopsy_ads',$dataArr,$condition);
			$this->setErrorMessage('success',"Ad's Image updated successfully");
			redirect('admin/landing_banner/show_ads');
			} else {
			
			
			$condition = array('id'=>$ad_id);
			$inputArr = array(
						'ad_image' => '',
						'ad_path' => $ad_path,
						'ad_type' => 'Script',
						'status' => $ad_status
				);
			$this->banner_model->update_details('shopsy_ads',$inputArr,$condition);
			$this->setErrorMessage('success',"Ad's Script updated successfully");
			redirect('admin/landing_banner/show_ads');
			
			}
		}
	}
	/**
	 *
	 * This function changes the banner status global
	 */
	public function change_banner_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->banner_model->activeInactiveCommon(BANNER,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Banner records deleted successfully');
			}else {
				$this->setErrorMessage('success','Banner records status changed successfully');
			}
			redirect('admin/banner/display_banner');
		}
	}
	/**
	 *
	 * This function delete the banner in db
	 */
	public function delete_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$banner_id = $this->uri->segment(4,0);
			$condition = array('id' => $banner_id);
			$this->banner_model->commonDelete(BANNER,$condition);
			$this->setErrorMessage('success','Banner deleted successfully');
			redirect('admin/banner/display_banner');
		}
	}
	/**
	 *
	 * This function loads the edit banner  page
	 */
	public function edit_banner(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Banner';
			$banner_id = $this->uri->segment(4,0);
			$condition = array('id' => $banner_id);
			$this->data['banner_details'] = $this->banner_model->get_all_details(BANNER,array('id'=>$banner_id));
			if ($this->data['banner_details']->num_rows() == 1){
				$this->load->view('admin/banner/edit_banner',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	/**
	 *
	 * This function edit the banner in db
	 */
	public function editBanner(){
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
			if($_FILES['banner_image']['name'] !=''){	
			list($w, $h) = getimagesize($_FILES["banner_image"]["tmp_name"]);
			if($w >= 600 && $h >= 400 && $w <= 700 && $h <= 500){
			} else {
			$this->setErrorMessage('error','Upload Image Too big or Too Small ('.$w.' X '.$h.'). Please Upload Image Size Equalto 650 X 450 ');
			redirect('admin/banner/edit_banner/'.$bid);
			}			
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
			$config['max_size'] = 2000;
			$config['upload_path'] = './images/banner';
			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('banner_image')){
				$logoDetails = $this->upload->data();
				$ImageName = $logoDetails['file_name'];
				$banner_data = array( 'image' => $ImageName);
			}else{
				$banner_data = array();
			}
            }
			$dataArr = array_merge($inputArr,$banner_data);
			$condition = array('id'=>$bid);
			$this->banner_model->commonInsertUpdate(BANNER,'update',$excludeArr,$dataArr,$condition);
			$this->setErrorMessage('success','Banner updated successfully');
			redirect('admin/banner/display_banner');
		}
	}
}

/* End of file banner.php */
/* Location: ./application/controllers/admin/banner.php */