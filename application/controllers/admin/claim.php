<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Claim extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('claim_model');
		$this->load->model('location_model');
		if ($this->checkPrivileges('currency',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
	
	/**
    * 
    * This function loads the claim list page
    */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/location/display_user_list');
		}
	}	
	/**
    * 
    * This function loads the claim list page
    */
	public function display_claim_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {   
			$this->data['heading'] = 'Dispute List';
			#$claim=$this->claim_model->get_all_details(ORDER_CLAIM,array());
			#$commt=$this->claim_model->get_all_details(ORDER_COMMENTS,array());
			#echo '<pre>'; print_r($claim->result());  echo '<pre>'; print_r($commt->result());  die;
			/*$condition = array();
			$this->data['currencyList'] = $this->location_model->get_all_details(CURRENCY,$condition);*/
			//$this->data['claimList'] = $this->claim_model->view_claim_details(' where (u.group="Seller" and u.status="Active") and p.status!="Deleted" and (up.status="Paid" and up.shipping_status!="Pending") group by oc.orderid order by oc.id desc');
			$this->data['claimList'] = $this->claim_model->view_claim_details(' where (us.group="Seller" and us.status="Active") group by oc.orderid order by oc.id desc');
			#print_r($this->data['claimList']); exit;
			$this->load->view('admin/claim/display_claim',$this->data);
		}
	}
	
	/**
    * 
    * This function loads the claim view page
    */
	public function view_claim_info() {
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$claim_id=$this->uri->segment(4,0);
			$this->data['heading'] = 'View Dispute Details';
			$this->data['claimSent'] = $claimComments = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$claim_id));
			$this->data['claimDetails']	= $this->claim_model->display_claim_details($claim_id);
			$this->data['claimComments'] = $claimComments = $this->claim_model->get_all_details(ORDER_COMMENTS,array('orderid'=>$claim_id),
			array(array('field'=>'post_time','type'=>'asc')));
			$this->load->view('admin/claim/view_claim',$this->data);
		}
	}
	
	/**
    * 
    * This function changes the claim status
    */
	public function change_claim_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$currency_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Closed':'Opened';
			$newdata = array('status' => $status);
			$condition = array('id' => $currency_id);
			$this->location_model->update_details(ORDER_CLAIM,$newdata,$condition);
			
			
			
		/***************        Zendesk Update Ticket Status   starts    **********************/
		if($this->config->item('zendesk_status')==="Active"){
			$get_diputeInfo = $this->location_model->get_all_details(ORDER_CLAIM,$condition);
			if($get_diputeInfo->row()->zendesk_ticket_id != '' && $get_diputeInfo->row()->zendesk_ticket_id != '0'){
				if($status == 'Closed'){
					$ticket_status = 'closed';
				} else {
					$ticket_status = 'open';
				}
			
				$ticket_data['ticket'] = array(
				'subject' => 'Dispute status updated for the order #'.$get_diputeInfo->row()->dealcodenumber,
				"comment" => array('public' => 'true','body' => 'Hi this dispute has been '.$status.' by admin'),
				'status' => $ticket_status
				);
				$ticket_data['url'] = '/tickets/'.$get_diputeInfo->row()->zendesk_ticket_id;
				$this->load->library('curl'); 
				$url = base_url().'site/zendesk/update_zendesk_ticket';
				$response = $this->curl->simple_post($url, $ticket_data);
			}
		}
		 /***********************      Zendesk Ticket updation ends        *************************/
 
			
			
			
			$this->setErrorMessage('success','Dispute Status Changed Successfully');
			redirect('admin/claim/display_claim_list');
		}
	}
	
	/**
    * 
    * This function update the claim type
    */
	public function update_claim() {
		$orderid = $dealCodeNumber = $this->input->post('dealCodeNumber');
		$sent_claim=$this->input->post('sent_claim');
		$post_message = $this->input->post('post_message');

		#$this->data['claimSent'] = $claimComments = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$dealCodeNumber));
		
		$data=array('sent_claim'=>$sent_claim);
		$data['status'] = 'Closed';
		
		$condition=array('dealcodenumber'=>$dealCodeNumber);
		$this->location_model->update_details(ORDER_CLAIM,$data,$condition);
		#echo $sent_claim; exit;
		if($sent_claim == 2){
			$this->location_model->update_details(USER_PAYMENT,array('claim_amount'=>''),$condition);
		}
		
		
		$this->data['buyerid'] = $buyerid = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderid));
		$this->data['sellerid'] = $sellerid = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderid));
		
		$buyeridd = $this->data['buyerid']->row()->buyer_id;
		$selleridd = $this->data['sellerid']->row()->seller_id;
		
		$this->data['buyeremail'] = $this->claim_model->get_all_details(USERS,array('id'=>$buyeridd));
		$this->data['selleremail'] = $this->claim_model->get_all_details(USERS,array('id'=>$selleridd));
		$buyeremaill = $this->data['buyeremail']->row()->email;
		$selleremaill = $this->data['selleremail']->row()->email;
		$sellernamee = $this->data['selleremail']->row()->full_name;
		
		/* echo $buyeremaill;
		 echo $selleremaill; exit; */
		
		$sender_name = 'Admin';
		
				
		$dataArr = array(
				'orderid'=>$orderid,
				'posted_by'=>'admin',
				'posted_id'=>'1',
				'post_message'=>$post_message,
				'post_time'=>date('Y-m-d H:i:s'),
		);
		
		$this->claim_model->simple_insert(ORDER_COMMENTS,$dataArr);
		
		//echo "<pre>".$this->db->last_query(); print_r($dataArr); die;
		
		$claimDetails  = $this->location_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$dealCodeNumber));
		
		if($sent_claim == 1){
			$content = 'The discussion case '.$claimDetails->row->id.'  has been favoured towards Buyer';
		}else{
			$content = 'The discussion case '.$claimDetails->row->id.'  has been favoured towards Seller';
		}
		
		$newsid='36';
		
		$template_values=$this->location_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title');
		$discussionurl=base_url().'discussion/'.$orderid;
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'content'=>$content,'posted_by'=> $this->data['siteTitle'],'sender_name'=> 'Admin','orderid'=>$dealCodeNumber,'post_message'=>$post_message);
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');
		$message .= '</body>
		</html>';
		$email_values_admin = array('mail_type'=>'html',
				'from_mail_id'=>$this->data['siteContactMail'],
				'mail_name'=>$this->data['siteTitle'].' Admin',
				'to_mail_id'=>$buyeremaill,
				'cc_mail_id'=>$selleremaill,
				'subject_message'=>$template_values['news_subject'],
				'body_messages'=>$message
		);
		$email_send_to_common = $this->location_model->common_email_send($email_values_admin);
		
		//print_r($email_values_admin); exit;
		
		$this->setErrorMessage('success','Claim Details Updated Successfully');
		redirect('admin/claim/display_claim_list');
		
	}
	
	/**
    * 
    * This function add comments in the claim to seller & buyer
    */
	public function add_comments() {
		$orderid=$this->input->post('dealCodeNumber');
		$posted_by='admin';
		$posted_id='1';
		$post_message=$this->input->post('post_message');
		$post_time=date('Y-m-d H:i:s');
		
		$this->data['buyerid'] = $buyerid = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderid));
		$this->data['sellerid'] = $sellerid = $this->claim_model->get_all_details(ORDER_CLAIM,array('dealcodenumber'=>$orderid));
		$buyeridd = $this->data['buyerid']->row()->buyer_id; 
		$selleridd = $this->data['sellerid']->row()->seller_id; 
		
		$this->data['buyeremail'] = $this->claim_model->get_all_details(USERS,array('id'=>$buyeridd));
		$this->data['selleremail'] = $this->claim_model->get_all_details(USERS,array('id'=>$selleridd));
		$buyeremaill = $this->data['buyeremail']->row()->email;
		$selleremaill = $this->data['selleremail']->row()->email;
		$sellernamee = $this->data['selleremail']->row()->full_name;
		
		/* echo $buyeremaill;
		echo $selleremaill; exit; */
		
		$sender_name = 'Admin';
		
		$dataArr = array(
			'orderid'=>$orderid,
			'posted_by'=>$posted_by,
			'posted_id'=>$posted_id,
			'post_message'=>$post_message,
			'post_time'=>$post_time
		);
		#print_r($dataArr); exit;
		
		/*mailing process starts here*/
		$newsid='10';
		$template_values=$this->location_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title');
		$discussionurl=base_url().'discussion/'.$orderid;
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
		</html>';
		$email_values = array('mail_type'=>'html',
					'from_mail_id'=>$this->data['siteContactMail'],
					'mail_name'=>$this->data['siteTitle'].' Admin',
					'to_mail_id'=>$buyeremaill,
					'cc_mail_id'=>$selleremaill,
					'subject_message'=>$template_values['news_subject'],
					'body_messages'=>$message
					);
		$email_send_to_common = $this->location_model->common_email_send($email_values);
		
		/*mailing process starts here for admin*/
		$newsid='21';
		$template_values=$this->location_model->get_newsletter_template_details($newsid);
		$subject = 'From: '.$this->config->item('email_title');
		$discussionurl=base_url().'discussion/'.$orderid;
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'));
		extract($adminnewstemplateArr);
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
		$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		$message .= '</body>
		</html>';
		$email_values_admin = array('mail_type'=>'html',
					'from_mail_id'=>$this->data['siteContactMail'],
					'mail_name'=>$this->data['siteTitle'].' Admin',
					'to_mail_id'=>$this->data['siteContactMail'],					
					'subject_message'=>$template_values['news_subject'],
					'body_messages'=>$message
					);
		$email_send_to_common = $this->location_model->common_email_send($email_values_admin);
		//print_r($email_values_admin); exit;
		
		$this->claim_model->simple_insert(ORDER_COMMENTS,$dataArr);
		$this->setErrorMessage('success','Your Comment Posted Successfully');
		redirect('admin/claim/view_claim_info/'.$orderid);
	}
}
	
	
 
 /* End of file currency.php */
/* Location: ./application/controllers/admin/currency.php */