<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to cms management 
 * @author Teamtweaks
 *
 */

class Shop extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('seller_model');
		if ($this->checkPrivileges('shop',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the cms list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/cms/display_blog');
		}
	}
	
	/**
	 * 
	 * This function loads the cms list page
	 */
	public function display_shop(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Lists';
			$condition = array();
			
			$shopCount  =  $this->seller_model->getShopDetailsCount();
			$this->data['shopCount'] = $shopCount; 
			
			$this->data['activeCount'] = $this->seller_model->getShopDetailsCount('active');
			$this->data['inactiveCount'] = $this->seller_model->getShopDetailsCount('inactive');
			$this->data['deletedCount'] =  $this->seller_model->getShopDetailsCount('deleted');
			$this->data['waitingCount'] =  $this->seller_model->getShopDetailsCount('waiting');
			
			if($_GET['status']){$status = $_GET['status'];}
			if($status == 'active'){ $shopCount = $this->data['activeCount'];}
			if($status == 'inactive'){ $shopCount = $this->data['inactiveCount'];}
			if($status == 'waiting'){ $shopCount = $this->data['waitingCount'];}
			if($status == 'deleted'){ $shopCount = $this->data['deletedCount'];}
			
			if($shopCount > 1000){			
				$searchPerPage = 50;
// 			if($shopCount > 10){			
// 				$searchPerPage = 5; 
				$paginationNo = $this->uri->segment(4);  
				if($paginationNo == ''){
					$paginationNo = 0;
				} else {
					$paginationNo = $paginationNo;
				}
				
				$sortArr2 = array('field'=>'created','type'=>'Desc');
				$sortArr1 = array($sortArr2);
				
				$this->data['shopDetails']  =  $this->seller_model->getShopDetailsView($paginationNo,$searchPerPage,$status,$sortArr1);

				//echo $this->db->last_query(); die;
				$searchbaseUrl = 'admin/shop/display_shop/';


				
				$config['num_links'] = 3;
				$config['display_pages'] = TRUE; 
				//$config['base_url'] = $searchbaseUrl.'?'.http_build_query($_GET);
				$config['base_url'] = $searchbaseUrl;
				$config['total_rows'] = $shopCount;
				$config["per_page"] = $searchPerPage;
				$config["uri_segment"] = 4;
				$config['first_link'] = '';
				$config['last_link'] = '';
				$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="current"><a href="javascript:void(0);" style="cursor:default;">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['first_link'] = 'First';
				$config['last_link'] = 'Last';
				
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				//$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
				
				$this->pagination->initialize($config); 
				$paginationLink = $this->pagination->create_links(); 
				$this->data['paginationLink'] = $paginationLink;
				
				$this->load->view('admin/shop/display_shop_pagination',$this->data);
				
			} else {
				
				$sortArr2 = array('field'=>'created','type'=>'Desc');
				$sortArr1 = array($sortArr2);
				
				$this->data['shopDetails']  =  $this->seller_model->getShopDetails('',$status,$sortArr1);
				//echo '<pre>';print_r($this->data['shopDetails']);die;
				//echo '<pre>';print_r($this->db->last_query());die;

				$this->load->view('admin/shop/display_shop',$this->data);
			}
			
		}
	}
	function change_featuredShop_ajax(){
		if($this->input->get('fstatus') == '1'){
			$status='Yes';
		}else {
		  $status='No';
		}
	$this->seller_model->update_details(SELLER,array('featured_shop' => $status),array('seller_id' => $this->input->get('shop_id')));
	redirect('admin/shop/display_shop');
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
			$this->data['cms_details'] = $this->seller_model->get_all_details(CMS,$condition);
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
	 * This function loads the user view page
	 */
	public function view_shop(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Shop';
			$post_id = explode('-',$this->uri->segment(4,0));
			$condition = array('user_id' => $post_id[1],'status' => 'Publish');
			$this->data['active_count'] = $this->seller_model->get_all_details(PRODUCT,$condition);
			$condition = array('user_id' => $post_id[1],'status' => 'UnPublish');
			$this->data['inactive_count'] = $this->seller_model->get_all_details(PRODUCT,$condition);
		//	$condition = array('post_id' => $post_id);
			$this->data['shop_details'] = $this->seller_model->getShopDetails($post_id[0]);
			$this->load->view('admin/shop/view_shop',$this->data);
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
			
			if ($page_name == ''){
				$this->setErrorMessage('error','Page name required');
				echo "<script>window.history.go(-1)</script>";exit();
			}

			$excludeArr = array("cms_id","hidden_page","subpage");
			$datestring = "%Y-%m-%d";
			$time = time();
				$seourl = url_title($page_name, '-', TRUE); 
				$dataArr = array('seourl' => $seourl);
			$condition = array('post_id' => $cms_id);

				//	print_r($dataArr); die;
				$this->seller_model->commonInsertUpdate(POSTS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Page updated successfully');
				redirect('admin/blog/display_blog');
			/*}*/
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
			$this->data['cms_details'] = $this->seller_model->get_all_details(POSTS,$condition);
				
			$this->load->view('admin/blog/edit_blog',$this->data);
			
		}
	}
	
	/**
	 * 
	 * This function change the cms page status
	 */
	public function change_shop_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0); 
			
			$status = ($mode == '0')?'inactive':'active';

			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->seller_model->update_details(SELLER,$newdata,$condition);
			$userVals = $this->seller_model->get_all_details(SELLER,array( 'id' => $cms_id));
			$userNamevals = $this->seller_model->get_all_details(USERS,array( 'id' => $userVals->row()->seller_id));
			
			if($status == 'active'){
				$newdata1 = array('group' => 'Seller');
				$role='Author';
			}else{
				$newdata1 = array('group' => 'User');				
				$role='Subscriber';				
			}

			$condition1 = array('id' => $userVals->row()->seller_id);
			$this->seller_model->update_details(USERS,$newdata1,$condition1);
			
			
			if($status == 'active'){
				//echo $this->db->last_query(); die;
				$newsid='33';
				$template_values=$this->user_model->get_newsletter_template_details($newsid);
				
				$cfmurl = base_url();
				$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
				
				$adminnewstemplateArr=array('seller'=>$userNamevals->row()->user_name,'email_title'=> 'Admin','logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
				
				extract($adminnewstemplateArr);
				//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
				$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body>';
				include('./newsletter/registeration'.$newsid.'.php');
				
				$message .= '</body>
				</html>';
				
				/* if($template_values['sender_name']=='' && $template_values['sender_email']==''){
				 $sender_email=$this->data['siteContactMail'];
				 $sender_name=$this->data['siteTitle'];
				 }else{
				 $sender_name=$template_values['sender_name'];
				 $sender_email=$template_values['sender_email'];
				 } */
				
				$name = 'Admin';
				
				$email_values = array('mail_type'=>'html',
						'from_mail_id'=>$this->config->item('email'),
						'mail_name'=>$name,
						'to_mail_id'=>$userVals->row()->seller_email,
						'subject_message'=>$template_values['news_subject'],
						'body_messages'=>$message
				);
				//echo "<pre>"; print_r($email_values);				die;
				
				$email_send_to_common = $this->user_model->common_email_send($email_values);
					
			}
			
			$this->setErrorMessage('success','Shop Status Changed Successfully');
			//redirect('wp_change_role.php?un='.$userNamevals->row()->user_name.'&roles='.$role);
			redirect('admin/shop/display_shop');
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
			$this->seller_model->update_details(CMS,$newdata,$condition);
			$this->setErrorMessage('success','Page Hidden Mode Changed Successfully');
			redirect('admin/shop/display_shop');
		}
	}
	
	/**
	 * 
	 * This function delete the cms page from db
	 */
	public function delete_shop(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			$this->seller_model->commonDelete(SELLER,$condition);
			$this->setErrorMessage('success','Shop deleted successfully');
			redirect('admin/shop/display_shop');
		}
	}
	
	/**
	 * 
	 * This function change the cms pages status
	 */
	public function change_shop_status_global(){
		
		//echo "<pre>"; print_r($_POST); 
		
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->seller_model->activeInactiveCommon(SELLER,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Seller deleted successfully');
			}else {
				if(strtolower($_POST['statusMode']) == 'active'){
					
					$check = $_POST['checkbox_id'];
					foreach( $check as $id){
						
						$userVals = $this->seller_model->get_all_details(SELLER,array( 'id' => $id));
						$userNamevals = $this->seller_model->get_all_details(USERS,array( 'id' => $userVals->row()->seller_id));
						//print_r($userNamevals); die;
						//echo $userNamevals->row()->user_name."asasas";
						$newsid='33';
						$template_values=$this->user_model->get_newsletter_template_details($newsid);
						
						$cfmurl = base_url();
						$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
						
						$adminnewstemplateArr=array('seller'=>$userNamevals->row()->user_name,'email_title'=> 'Admin','logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
						
						extract($adminnewstemplateArr);
						//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
						$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
						
						$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body>';
						include('./newsletter/registeration'.$newsid.'.php');
						
						$message .= '</body>
				</html>';
						
						/* if($template_values['sender_name']=='' && $template_values['sender_email']==''){
						 $sender_email=$this->data['siteContactMail'];
						 $sender_name=$this->data['siteTitle'];
						 }else{
						 $sender_name=$template_values['sender_name'];
						 $sender_email=$template_values['sender_email'];
						 } */
						
						$name = 'Admin';
						
						$email_values = array('mail_type'=>'html',
								'from_mail_id'=>$this->config->item('email'),
								'mail_name'=>$name,
								'to_mail_id'=>$userVals->row()->seller_email,
								'subject_message'=>$template_values['news_subject'],
								'body_messages'=>$message
						);
						//echo "<pre>"; print_r($email_values);			
						
						$email_send_to_common = $this->user_model->common_email_send($email_values);
						
					}
				}
				$this->setErrorMessage('success','Seller status changed successfully');
			}
			redirect('admin/shop/display_shop');
		}
	}
	
	/*View the shop payments*/
	public function view_shop_transaction(){
		
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Transactions';
			$shop_id = $this->uri->segment(4,0);		
			$this->data['shop_trans_details'] = $this->seller_model->getShopTransactionDetails($shop_id);
			#echo '<pre>'; print_r($this->data['shop_trans_details']);die;
			$this->load->view('admin/shop/display_shop_tranaction',$this->data);
		}
	}
	/**
	 * 
	 * This function views the shop transaction
	 */
	public function view_shop_trans(){
		
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Shop Transactions Details';
			$transdate = $this->uri->segment(4,0);
			$shop_id = $this->uri->segment(5,0);		
			$condition = array('pay_date' => date("Y-m-d H:i:s",$transdate),'user_id'=> $shop_id);
			#$this->data['productList'] = $this->seller_model->get_all_details(PRODUCT,$condition);
			$this->data['productList'] = $this->product_model->view_product_details('  where p.pay_date="'.date("Y-m-d H:i:s",$transdate).'" and p.user_id='.$shop_id.' and u.group="Seller" and u.status="Active" or p.pay_date="'.date("Y-m-d H:i:s",$transdate).'" and p.user_id='.$shop_id.' group by p.id order by p.created desc');

			#echo "<pre>"; print_r($this->data['productList']->result());die;
			$this->load->view('admin/shop/shop_tranaction_details',$this->data);
		}
	}
}

/* End of file cms.php */
/* Location: ./application/controllers/admin/cms.php */