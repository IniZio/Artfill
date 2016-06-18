<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author Teamtweaks
 *
 */

class Community_news extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('community_news_model');
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
			$this->load->view('admin/community_news/display_blog_dashboard',$this->data);
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
	 * This function loads the Blog list page
	 */
	public function display_blog(){ 
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Community News';
			$condition = array();
			$this->data['postDetails']  =  $this->community_news_model->get_all_posts_common();
			$this->load->view('admin/community_news/display_blog',$this->data);
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
			$this->data['commentsDetails'] = $commentDetail =  $this->community_news_model->get_posts_comments($post_id);
			//echo count($commentDetail); die;
			//print_r($commentDetail); die;
			$this->load->view('admin/community_news/display_comments',$this->data);
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
			$this->load->view('admin/community_news/add_blog',$this->data);
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
			$this->data['posts_details'] = $this->community_news_model->get_single_posts($post_id);
			$this->load->view('admin/community_news/view_blog',$this->data);
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
			$page_name = $this->input->post('post_title');
			// echo '<pre>'; var_dump($_FILES); die;
				if(!empty($_FILES['post_image']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/community/news';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('post_image')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
					@copy('./images/community/news/'.$ImageName, './images/community/news/thumb/'.$ImageName);
					$this->ImageResizeWithCrop(145, 145, $ImageName, './images/community/news/thumb/');
					@copy('./images/community/news/'.$ImageName, './images/community/news/album/'.$ImageName);
					$this->ImageResizeWithCrop(450, 350, $ImageName, './images/community/news/album/');
					$imagesVal=$timeImg.$ImageName;
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('add-event'.$cat_id);
				}
				$image_data = array( 'post_image' => $imagesVal);
			}else{
				$image_data = array();
			}
			//$dataArr = array_merge($dataArr,$image_data);
			//echo '<pre>'; print_r($dataArr); die;
			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
				$seourl = url_title($page_name, '-', TRUE); 
				$dataArr = array('seourl' => $seourl);
				$dataArr = array_merge($dataArr,$image_data);
			if($cms_id == ''){
			$dataArr = array_merge($dataArr,array('posted_user_id'=>'1'));
                $this->community_news_model->commonInsertUpdate(NEWS,'insert',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Post insert successfully');
				redirect('admin/community_news/display_blog');				
			}else{
			$condition = array('post_id' => $cms_id);
					//print_r($dataArr); die;
				$this->community_news_model->commonInsertUpdate(NEWS,'update',$excludeArr,$dataArr,$condition);
				//echo $this->db->last_query(); die;
				$this->setErrorMessage('success','Post updated successfully');
				redirect('admin/community_news/display_blog');
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
			$this->data['cms_details'] = $this->community_news_model->get_all_details(NEWS,$condition);
				
			$this->load->view('admin/community_news/edit_blog',$this->data);
			
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
			$status = ($mode == '0')?'Unpublish':'active';
			$newdata = array('post_status' => $status);
			$condition = array('post_id' => $cms_id);
			$this->community_news_model->update_details(NEWS,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','News Status Changed Successfully');
			redirect('admin/community_news/display_blog');
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
			$status = ($mode == '0')?'Unpublish':'active'; 
			$newdata = array('comment_status' => $status);
			$condition = array('comment_id' => $cms_id);
			$this->community_news_model->update_details(NEWSCOMMENT,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Comment Status Changed Successfully');
			redirect('admin/community_news/display_comments/'.$orgNewsid);
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
			$this->community_news_model->update_details(CMS,$newdata,$condition);
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
			$this->community_news_model->commonDelete(NEWS,$condition);
			$this->setErrorMessage('success','Posts deleted successfully');
			redirect('admin/community_news/display_blog');
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
			$condition = array('comment_id' => $cms_id);
			$orgNewsid=$this->uri->segment(6,0); 
			$this->community_news_model->commonDelete(NEWSCOMMENT,$condition);
			$this->setErrorMessage('success','Comment deleted successfully');
			redirect('admin/community_news/display_comments/'.$orgNewsid);
		}
	}
	

	/**
	 * 
	 * This function change the Post pages status
	 */
	public function change_blog_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->community_news_model->activeInactivePost(NEWS,'post_id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Posts deleted successfully');
			}else {
				$this->setErrorMessage('success','Posts status changed successfully');
			}
			redirect('admin/community_news/display_blog');
		}
	}


	/**
	 * 
	 * This function change the Comments pages status
	 */
	public function change_comments_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->community_news_model->activeInactiveComment(NEWSCOMMENT,'comment_id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Comments deleted successfully');
			}else {
				$this->setErrorMessage('success','Comments status changed successfully');
			}
			redirect('admin/community_news/display_blog');
		}
	}

}
/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */