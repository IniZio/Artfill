<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author Teamtweaks
 *
 */

class Blog extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('blog_model');
		if ($this->checkPrivileges('cms',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
	/**
	 * 
	 * This function loads the sellers dashboard
	 */
	public function display_blog_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Blog Dashboard';
			$this->load->view('admin/blog/display_blog_dashboard',$this->data);
		}
	}
	
	/**
    
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
	 * This function loads the user post Blog list page
	 */
	public function display_blog(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'User Blog Posts';
			$condition = array();

			$this->data['postDetails']  =  $this->blog_model->get_all_posts_common();
			$this->data['blog_posted_by'] = 'userpost';
			//echo "<pre>".$this->db->last_query();die;
			//echo "<pre>";print_r($this->data['postDetails']);die;
			$this->load->view('admin/blog/display_blog',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the admin post Blog list page
	 */
	public function display_blog_admin(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Admin Blog Posts';
			$condition = array();

			$this->data['postDetails']  =  $this->blog_model->get_all_posts_common_admin();
			$this->data['blog_posted_by'] = 'adminpost';
			//echo "<pre>".$this->db->last_query();die;
			//echo "<pre>";print_r($this->data['postDetails']);die;
			$this->load->view('admin/blog/display_blog',$this->data);
		}
	}

	
	/**
	 * 
	 * This function loads the Blog list page
	 */
	public function display_comments(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			 $post_id = $this->uri->segment(4,0); 
			$this->data['heading'] = 'Post Comments';
			$condition = array();
			$this->data['commentsDetails'] = $commentDetail =  $this->blog_model->get_posts_comments($post_id);
			//echo count($commentDetail); die;
			//print_r($commentDetail); die;
			$this->load->view('admin/blog/display_comments',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new Blog form
	 */
	public function add_post_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Post';
			$this->load->view('admin/blog/add_post_form',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the user view page
	 */
	public function view_blog(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Post';
			$post_id = $this->uri->segment(4,0);
		//	$condition = array('post_id' => $post_id);
			$this->data['posts_details'] = $this->blog_model->get_single_posts($post_id);
			$this->load->view('admin/blog/view_blog',$this->data);
		}
	}	
	/**
	 * 
	 * This function insert and edit a cms page
	 */
	public function insertEditPost(){
		//print_r($_POST); die;
/*		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {*/
			$cms_id = $this->input->post('cms_id'); 
			$redirect_to = $this->input->post('blog_posted_by');
			$page_name = $this->input->post('post_title');
			
			if ($page_name == ''){
				$this->setErrorMessage('error','Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}

			$excludeArr = array("cms_id","hidden_page","subpage","blog_posted_by");
			$datestring = "%Y-%m-%d";
			$time = time();
				$seourl = url_title($page_name, '-', TRUE); 
				$dataArr = array('seourl' => $seourl);
			if($cms_id == ''){
                $this->blog_model->commonInsertUpdate(POSTS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Post insert successfully');
				//redirect('admin/blog/display_blog');				
				redirect('admin/blog/display_blog_admin');
			}else{
			$condition = array('post_id' => $cms_id);
				//	print_r($dataArr); die;
				$this->blog_model->commonInsertUpdate(POSTS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Post updated successfully');
				
				
			if($redirect_to == 'adminpost')
			{
				redirect('admin/blog/display_blog_admin');
			}
			else
			{
				redirect('admin/blog/display_blog');
			}
			
			}
		}
	/**
	 * 
	 * This function loads the edit cms form
	 */
	public function edit_post_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Posts';
			$cms_id = $this->uri->segment(4,0);
			$condition = array('post_id' => $cms_id);
			$this->data['cms_details'] = $this->blog_model->get_all_details(POSTS,$condition);
			$this->data['blog_posted_by'] = $this->uri->segment(5);
			$this->load->view('admin/blog/edit_blog',$this->data);
			
		}
	}
	
	/**
	 * 
	 * This function change the cms page status
	 */
	public function change_blog_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0); 
			$status = ($mode == '0')?'admin_inactive':'active';
			$newdata = array('post_status' => $status);
			$condition = array('post_id' => $cms_id);
			$this->blog_model->update_details(POSTS,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Post Status Changed Successfully');
			
			$redirect_to = $this->uri->segment(6);
			
			if($redirect_to == 'adminpost')
			{
				redirect('admin/blog/display_blog_admin');
			}
			else
			{
				redirect('admin/blog/display_blog');
			}
			
			
			 
		}
	}
	/**
	 * 
	 * This function change the comment page status
	 */
	public function change_comment_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0); 
			$orgNewsid=$this->uri->segment(6,0); 
			$status = ($mode == '0')?'admin_inactive':'active'; 
			$newdata = array('comment_status' => $status);
			$condition = array('comment_id' => $cms_id);
			$this->blog_model->update_details(COMMENT,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Comment Status Changed Successfully');
			redirect('admin/blog/display_comments/'.$orgNewsid);
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
			$this->blog_model->update_details(CMS,$newdata,$condition);
			$this->setErrorMessage('success','Page Hidden Mode Changed Successfully');
			redirect('admin/cms/display_cms');
		}
	}
	
	/**
	 * 
	 * This function delete the blog post from db
	 */
	public function delete_blog(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('post_id' => $cms_id);
			$this->blog_model->commonDelete(POSTS,$condition);
			$this->setErrorMessage('success','Posts deleted successfully');
			
			$redirect_to = $this->uri->segment(5);
			
			if($redirect_to == 'adminpost')
			{
				redirect('admin/blog/display_blog_admin');
			}
			else
			{
				redirect('admin/blog/display_blog');
			}
			
			
			
			
			
			
			
			
			redirect('admin/blog/display_blog');
		}
	}
		/**
	 * 
	 * This function delete the comment post from db
	 */
	public function delete_comments(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$orgNewsid=$this->uri->segment(6,0); 
			$condition = array('comment_id' => $cms_id);
			$this->blog_model->commonDelete(COMMENT,$condition);
			$this->setErrorMessage('success','Comment deleted successfully');
			redirect('admin/blog/display_comments/'.$orgNewsid);
		}
	}
	

	/**
	 * 
	 * This function change the Post pages status
	 */
	public function change_blog_status_global(){
	
	
		$redirect_to = $this->uri->segment(4);
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->blog_model->activeInactivePost(POSTS,'post_id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Posts deleted successfully');
			}else {
				$this->setErrorMessage('success','Posts status changed successfully');
			}
			
			if($redirect_to == 'adminpost')
			{
				redirect('admin/blog/display_blog_admin');
			}
			else
			{
				redirect('admin/blog/display_blog');
			}
		}
	}


	/**
	 * 
	 * This function change the Comments pages status
	 */
	public function change_comments_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->blog_model->activeInactiveComment(COMMENT,'comment_id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Comments deleted successfully');
			}else {
				$this->setErrorMessage('success','Comments status changed successfully');
			}
			redirect('admin/blog/display_blog');
		}
	}

}
/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */