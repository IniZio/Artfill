<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author Teamtweaks
 *
 */

class Cms extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cms_model');
		$this->load->model('multilanguage_model');
		if ($this->checkPrivileges('cms',$this->privStatus) == FALSE){
			redirect('admin');
		}
		
		//$this->addCmsConstraint();
    }
    
    /**
     * 
     * This function loads the cms list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function loads the cms list page
	 */
	public function display_cms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Static Pages';
			$condition = array();
			$this->data['cmsList'] = $this->cms_model->get_all_details(CMS,$condition);
			//$this->data['cmsList'] = $this->cms_model->get_all_details(CMS_EN,$condition);
			$this->load->view('admin/cms/display_cms',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new cms form
	 */
	public function add_cms_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Main Page';
			$this->load->view('admin/cms/add_cms',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new subpage form
	 */
	public function add_subpage_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Sub Page';
			$condition = array('category' => 'Main');
			//$this->data['cms_details'] = $this->cms_model->get_all_details(CMS,$condition);
			$this->data['cms_details'] = $this->cms_model->get_all_details(CMS_EN,$condition);
			if ($this->data['cms_details']->num_rows() > 0){
				$this->load->view('admin/cms/add_sub_page',$this->data);
			}else {
				$this->setErrorMessage('error','You must add a main page first');
				redirect('admin/cms/display_cms');
			}
		}
	}
	
	/**
	 * 
	 * This function insert and edit a cms page
	 */
	public function insertEditCms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->input->post('cms_id');
			$parent_id = $this->input->post('parent');
			$page_name = $this->input->post('page_name');
			$subpage = $this->input->post('subpage');
			
			if ($subpage == 'subpage'){
				if ($parent_id == ''){
					$this->setErrorMessage('error','Select a main page');
					echo "<script>window.history.go(-1)</script>";exit();
				}
			}
			if ($page_name == ''){
				$this->setErrorMessage('error','Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$parent = '0';
			$category = 'Main';
			if ($parent_id != ''){
				$parent = $parent_id;
				$category = 'Sub';
			}
			if ($cms_id == ''){
				$condition = array('page_name' => $page_name);
			}else {
				$condition = array('page_name' => $page_name,'id !=' => $cms_id);
			}
			//$duplicate_name = $this->cms_model->get_all_details(CMS,$condition);
			$duplicate_name = $this->cms_model->get_all_details(CMS_EN,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Page name already exists');
				redirect('admin/cms/display_cms');
			}
			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
			if ($cms_id == ''){
				$hidden_page = $this->input->post('hidden_page');
				if ($hidden_page == 'on'){
					$hidden_page = 'Yes';
				}else {
					$hidden_page = 'No';
				}
				$seourl = url_title($page_name, '-', TRUE);
				$dataArr = array(
					'status' => 'Publish',
					'seourl' => $seourl,
					'hidden_page' => $hidden_page,
					'parent' => $parent,
					'category' => $category
				);
			}else {
				$dataArr = array('parent' => $parent);
			}
			$condition = array('id' => $cms_id);
			
			if ($cms_id == ''){
				//echo '<pre>'; print_r($dataArr); die;	
				//$this->cms_model->commonInsertUpdate(CMS,'insert',$excludeArr,$dataArr,$condition);
				$this->cms_model->commonInsertUpdate(CMS_EN,'insert',$excludeArr,$dataArr,$condition);
				$insert_id = $this->db->insert_id();
				
				if ($seourl == ''){
					$cms_id = $this->cms_model->get_last_insert_id();
					$seourl = $cms_id.'/'.str_replace(' ','',$page_name);
					//$this->cms_model->update_details(CMS,array('seourl'=>$seourl),array('id'=>$cms_id));
					$this->cms_model->update_details(CMS_EN,array('seourl'=>$seourl),array('id'=>$cms_id));
				}
				
				
				//$insert_array = $this->cms_model->get_all_details(CMS,array('id'=>$insert_id))->result();
				$insert_array = $this->cms_model->get_all_details(CMS_EN,array('id'=>$insert_id))->result();
				
				$languages = $this->multilanguage_model->get_language_list()->result_array();
				foreach($languages as $lang){
					$ln = $lang['lang_code'];
					//$table = CMS;
					$table = CMS_EN;
					$ln_table = $table."_".$ln;
					$this->cms_model->simple_insert($ln_table,$insert_array[0]);
					if ($seourl == ''){
						$cms_id = $this->cms_model->get_last_insert_id();
						$seourl = $cms_id.'/'.str_replace(' ','',$page_name);
						$this->cms_model->update_details($ln_table,array('seourl'=>$seourl),array('id'=>$cms_id));
					}
				}
				
				$this->setErrorMessage('success','Page added successfully');
				redirect('admin/cms/edit_cms_form/'.$insert_id.'');
				
			}else {
				$excludeArr[] = 'table';
				$table = $this->input->post('table');
				
				print_r($dataArr);
				$this->cms_model->commonInsertUpdate($table,'update',$excludeArr,$dataArr,$condition);
				//echo $this->db->last_query(); die;
				$this->setErrorMessage('success','Page updated successfully');
				redirect('admin/cms/display_cms');
			}
			//redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function loads the edit cms form
	 */
	public function edit_cms_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Page';
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			//$this->data['cms_details'] = $this->cms_model->get_all_details(CMS,$condition);
			$this->data['cms_details'] = $this->cms_model->get_all_details(CMS_EN,$condition);
			if ($this->data['cms_details']->num_rows() == 1){
				$condition = array('category' => 'Main');
				//$this->data['cms_main_details'] = $this->cms_model->get_all_details(CMS,$condition);
				$this->data['cms_main_details'] = $this->cms_model->get_all_details(CMS_EN,$condition);
				$this->load->view('admin/cms/edit_cms',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function change the cms page status
	 */
	public function change_cms_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			//$this->cms_model->update_details(CMS,$newdata,$condition);
			$this->cms_model->update_details(CMS_EN,$newdata,$condition);
			$this->setErrorMessage('success','Page Status Changed Successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function change the cms page display mode
	 */
	public function change_cms_mode(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0);
			$newdata = array('hidden_page' => $mode);
			$condition = array('id' => $cms_id);
			//$this->cms_model->update_details(CMS,$newdata,$condition);
			$this->cms_model->update_details(CMS_EN,$newdata,$condition);
			$this->setErrorMessage('success','Page Hidden Mode Changed Successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function delete the cms page from db
	 */
	public function delete_cms(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			//$this->cms_model->commonDelete(CMS,$condition);
			$this->cms_model->commonDelete(CMS_EN,$condition);
			$this->setErrorMessage('success','Page deleted successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function change the cms pages status
	 */
	public function change_cms_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			//$this->cms_model->activeInactiveCommon(CMS,'id');
			$this->cms_model->activeInactiveCommon(CMS_EN,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Pages deleted successfully');
			}else {
				$this->setErrorMessage('success','Pages status changed successfully');
			}
			redirect('admin/cms/display_cms');
		}
	}
	
	
	
	public function getCmsLangData(){
		$id = $this->input->post('id');
		$condition = array('id' => $id);
		$ln = $this->input->post('ln');
		//$table = CMS."_".$ln;
		$table = CMS_EN."_".$ln;
		$data = $this->cms_model->get_all_details($table,$condition)->result_array();
		//echo "<pre>"; print_r($data);
		echo json_encode($data[0]);
	}
	
	public function addCmsConstraint(){
		$languages = $this->multilanguage_model->get_language_list()->result_array();
		$tablelist = $this->data['mulitiLangTable'];
		foreach($languages as $lang){
			$ln = $lang['lang_code'];
			//		   			foreach($tablelist as $tablename){
			$table = CMS;
			$table = CMS_EN;
			$ln_table = $table."_".$ln;
	
			if ($this->db->table_exists($ln_table)){
	
				$qry3 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `deletecms_".$ln."` FOREIGN KEY (`id`) REFERENCES `shopsy_cms` (`id`) ON DELETE CASCADE";
				$this->cms_model->ExecuteQuery($qry3);
					
				echo $this->db->last_query()."<br>";
	
				$qry4 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `Cmsstatus_".$ln."` FOREIGN KEY (status, id) REFERENCES `shopsy_cms` (status, id) ON UPDATE CASCADE";
				$this->cms_model->ExecuteQuery($qry4);
				
				echo $this->db->last_query()."<br>";
				
				//$qry5 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `CmsHidden_".$ln."` FOREIGN KEY (hidden_page, id) REFERENCES `shopsy_cms` (hidden_page, id) ON UPDATE CASCADE";
				//$this->cms_model->ExecuteQuery($qry5);
				
				//echo $this->db->last_query()."<br>";
	
			}		
			//		   			}
		}
	}
	
	
	
}

/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */