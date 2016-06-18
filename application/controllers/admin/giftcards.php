<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * This controller contains the functions related to giftcards management 
 * @author Teamtweaks
 *
 */
class Giftcards extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('giftcards_model');
		if ($this->checkPrivileges('giftcards',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the giftcards list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * This function loads the giftcards dashboard
	 */
	public function display_giftcards_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Gift Cards Dashboard';
			$condition = 'order by `created` desc';
			$this->data['giftCardsList'] = $this->giftcards_model->get_giftcard_details($condition);
			$this->load->view('admin/giftcards/display_giftcards_dashboard',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the giftcards list page
	 */
	public function display_giftcards(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Gift Cards List';
			$condition = array();
			$this->data['giftCardsList'] = $this->giftcards_model->get_all_details(GIFTCARDS,$condition);
			$this->load->view('admin/giftcards/display_giftcards',$this->data);
		}
	}
	
	/**
	 * 
	 * Change the giftcards settings
	 */
	public function insertEditGiftcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else { //echo '<pre>'; print_r($_FILES); die;
			$excludeArr = array("gift_image","imggg"); 
			
			//$excludeArr1 = array("gift_image"); 
			$dataArr1 = array(); 
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
		    //$config['max_size'] = 2000;
			
		    $config['upload_path'] = './images/giftcards';
		    $this->load->library('upload', $config);
			//$allImages=
			
			$image = $this->input->post('imggg', TRUE ) ; 
			//echo $image; die;
			if($this->upload->do_multi_upload('gift_image')){
		    	$logoDetails = $this->upload->get_multi_upload_data();
				//print_r($logoDetails); die;
				 foreach ($logoDetails as $fileDetails){
				 	@copy('./images/giftcards/'.$fileDetails['file_name'], './images/giftcards/thumb/'.$fileDetails['file_name']);
				 	$this->ImageResizeWithCrop(70, 70, $fileDetails['file_name'], './images/giftcards/thumb/');
					@copy('./images/giftcards/'.$fileDetails['file_name'], './images/giftcards/album/'.$fileDetails['file_name']);
					$this->ImageResizeWithCrop(615, 135, $fileDetails['file_name'], './images/giftcards/album/');
		    		$ImageName .= $fileDetails['file_name'].','; 
					//echo $ImageName; die;
				}
				//$allImages = $allImages.','.$ImageName; 
				
				$allImages = $image.','.$ImageName; 
				//print_r($allImages); die;
			}
			$dataArr['image'] = $allImages; //die;
			
			$condition = array('id' => '1');
			($this->config->item('giftcard_id') == '') ? $modeVal = 'insert' : $modeVal = 'update';
			//echo '<pre>'; print_r($_POST); var_dump($this->config->item('giftcard_id')); 
			if($this->upload->do_multi_upload('gift_image')!='')
			{
				$this->giftcards_model->commonInsertUpdate(GIFTCARDS_SETTINGS,$modeVal,$excludeArr,$dataArr,$condition);
			}
			else
			{
				$this->giftcards_model->commonInsertUpdate(GIFTCARDS_SETTINGS,$modeVal,$excludeArr,$dataArr1,$condition);
			}
			$this->giftcards_model->saveGiftcardSettings();
			$this->setErrorMessage('success','Giftcards settings updated successfully');
			redirect('admin/giftcards/edit_giftcards_settings');
		}
	}
	
	/**
	 * 
	 * This function loads the edit giftcards settings
	 */
	public function edit_giftcards_settings(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Giftcards Settings';
			$this->data['giftcards_settings'] = $this->giftcards_model->get_all_details(GIFTCARDS_SETTINGS,array());
			$this->load->view('admin/giftcards/edit_giftcards_settings',$this->data);
		}
	}
	
	/**
	 * 
	 * Ajax function for delete the Giftcard image
	 */
	
	public function editgitcardPictures(){
		$ingIDD = $this->input->post('imgId');
		$currentPage = $this->input->post('cpage');
		$id = $this->input->post('val');
		//echo '<pre>'; print_r($_POST);
		
		$productImage = explode(',',$this->session->userdata('giftcard_image_'.$ingIDD));
		//echo '<pre>'; print_r($productImage); 
		if(count($productImage) < 2) {
			echo json_encode("No");exit();
		} else {
			$empImg = 0;
			foreach ($productImage as $product) {
				if ($product != ''){
					$empImg++;
				}
			}
			if ($empImg<2){
				echo json_encode("No");exit();
			}
			$this->session->unset_userdata('giftcard_image_'.$ingIDD);
			$resultVar = $this->setPictureProducts($productImage,$this->input->post('position'));
			$insertArrayItems = trim(implode(',',$resultVar)); //need validation here...because the array key changed here 
			//echo '<pre>'; print_r($insertArrayItems); 
			
			
			$this->session->set_userdata(array('giftcard_image_'.$ingIDD => $insertArrayItems));	
			$dataArr = array('image' => $insertArrayItems);
			$condition = array('id' => $ingIDD);
			$this->giftcards_model->update_details(GIFTCARDS_SETTINGS,$dataArr,$condition);
			//echo $this->db->last_query(); die;
			echo json_encode($insertArrayItems);
		}
	}
	
	/**
	 * 
	 * This function delete the giftcard from db
	 */
	public function delete_giftcard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$gift_id = $this->uri->segment(4,0);
			$condition = array('id' => $gift_id);
			$this->giftcards_model->commonDelete(GIFTCARDS,$condition);
			$this->setErrorMessage('success','Giftcard deleted successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * Changing giftcard mode as Disable | Enable
	 */
	public function change_giftcards_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$status = ($mode == '1')?'Enable':'Disable';
			$condition = array('id' => '1');
			$data = array('status'=>$status);
			$this->giftcards_model->update_details(GIFTCARDS_SETTINGS,$data,$condition);
			$this->giftcards_model->saveGiftcardSettings();
			$this->setErrorMessage('success','Giftcards '.$status.'d Successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
	
	/**
	 * 
	 * This function delete the giftcards 
	 */
	public function change_giftcards_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->giftcards_model->activeInactiveCommon(GIFTCARDS,'id');
			$this->setErrorMessage('success','Giftcards deleted successfully');
			redirect('admin/giftcards/display_giftcards');
		}
	}
}

/* End of file giftcards.php */
/* Location: ./application/controllers/admin/giftcards.php */