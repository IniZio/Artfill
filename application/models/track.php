<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Track extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model'));
		echo 'OOOOOOOOOO'; die;
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
		if ($this->checkPrivileges('complaints',$this->privStatus) == FALSE){
			redirect('admin');
		}	 	
    }
	
	public function index(){
		
    }
   
	
	/**
	 * 
	 * This function loads the track list page 
	 */
	public function track_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Track Labels List';
			$this->data['trackList'] = $this->product_model->get_all_discount_deatil(DISCOUNT,array());
			$this->load->view('admin/track/display_track',$this->data);
		}
	}
	public function add_track_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   echo 'f'; die;
			$this->data['heading'] = 'Add New Track Label';
			$this->load->view('admin/track/add_track',$this->data);
		}
	}
	public function edit_track_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Edit Track Label';
			$track_product_id = $this->uri->segment(4,0); 
			$this->data['trackDetail'] = $this->product_model->get_all_details(DISCOUNT,array('id' => $track_product_id));
			$this->load->view('admin/track/edit_track',$this->data);
		}
	}
	
	
	public function insertTrack(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$checktag = $this->seller_model->get_all_details(DISCOUNT,array('tag_name' => $this->input->post('tag_name')));
		    if($checktag->num_rows() == 1){
				if($checktag->row()->status == 'Active'){
					$this->setErrorMessage('error','Track tag name already exist.');
					echo "<script>window.history.go(-1)</script>";exit();
				} else { 
					$this->setErrorMessage('error','Track tag name already exist and  Deactivated.');
					echo "<script>window.history.go(-1)</script>";exit();
				}
		    }
			
			$excludeArr = array("status","track_id");
			if ($this->input->post('status') != ''){
				$track_status = 'Active';
			}else {
				$track_status = 'InActive';
			}
				
			$inputArr = array(
						'status' => $track_status
			);
		    $this->seller_model->commonInsertUpdate(DISCOUNT,'insert',$excludeArr,$inputArr);
		    $this->setErrorMessage('success','Track added successfully');
			redirect('admin/track/track_list');
		}
	}
	
	public function editTrack(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$checktag = $this->seller_model->get_all_details(DISCOUNT,array('tag_name' => $this->input->post('tag_name'),'id !=' => $this->input->post('track_id')));
		    if($checktag->num_rows() == 1){
				if($checktag->row()->status == 'Active'){
					$this->setErrorMessage('error','Already Track tag exist in this name.');
					echo "<script>window.history.go(-1)</script>";exit();
				} else { 
					$this->setErrorMessage('error','Already Track tag exist in this name and  Deactivated.');
					echo "<script>window.history.go(-1)</script>";exit();
				}
		    }
			
			
			$excludeArr = array("status","track_id");
			if ($this->input->post('status') != ''){
				$track_status = 'Active';
			}else {
				$track_status = 'InActive';
			}
				
			$inputArr = array(
						'status' => $track_status
			);
		    $this->seller_model->commonInsertUpdate(DISCOUNT,'update',$excludeArr,$inputArr,array('id' => $this->input->post('track_id')));
		    $this->setErrorMessage('success','Track Updated successfully');
			redirect('admin/track/track_list');
		}
	}
	
		
	
	/**
	 * 
	 * This function loads the user view page delete_product_track
	 */
	public function delete_track(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {  
			$track_id = $this->uri->segment(4,0);  
			$condition = array('id' => $track_id);
			$this->product_model->commonDelete(DISCOUNT,$condition);
			$this->setErrorMessage('success','track tag removed successfully');
			redirect('admin/track/track_list');
			
			
		}
	} 
	
	public function change_track_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$badge_id = $this->uri->segment(5,0); 
			$status = ($mode == '0')?'inactive':'active';
			$newdata = array('status' => $status);
			$condition = array('id' => $badge_id);
			$this->seller_model->update_details(DISCOUNT,$newdata,$condition);
			$this->setErrorMessage('success','Track Status Changed Successfully');
			redirect('admin/track/track_list');
		}
	}
	
	
	
}
/*End of file market.php */
/* Location: ./application/controllers/site/market.php */
