<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
//error_reporting(-1);
/**
 * 
 * Offer related functions
 * @author Casperon
 *
 */

class Seller_support extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('support_model'));

		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['AdminloginCheck'] = $this->checkLogin('A');
    }
	
	// FUNCTION TO VIEW TICKET CREATION PAGE.
	public function freshdesk(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else{
			$condition =array('seller_id'=>$this->checkLogin('U'));
			$this->data['seller_details'] = $this->support_model->get_all_details(SELLER,$condition);
			//echo $this->db->last_query(); die;
			if($this->data['seller_details']->num_rows() > 0){
				$this->load->view('site/freshdesk/freshdesk',$this->data);	
			}else{
				$this->setErrorMessage('error','Invalid Request , Please create your shop first.');
				redirect($_SERVER['HTTP_REFERER']);
			}	
		}
	}
	
	// FUNCTION TO CREATE TICKET IN FRESH DESK
	public function create_ticket(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else{
			$desc=$_POST['support_description'];
			$sub=$_POST['support_subject'];
			$email=$_POST['email'];
			$prior=$_POST['support_priority'];
			$status=$_POST['support_status'];
			
			if($this->config->item('fresh_desk_email') != ''){
				$ccEmail = $this->config->item('fresh_desk_email'); 
			} else {
				$ccEmail = $this->config->item('site_contact_mail'); 
			}


				$ticket_data = array(
					"helpdesk_ticket" => array(
						"description" => $desc,
						"subject" => $sub,
						"email" => $email,
						"priority" => $prior,
						"status" => $status
					),
					"cc_emails" => $ccEmail
				);

												
			$config['overwrite'] = FALSE;
			$config['allowed_types'] = 'jpeg|jpg|gif|doc|pdf|docx|csv|png';
			$config['max_size'] = 2000;
			$config['upload_path'] = './attachments/';
			$this->load->library('upload', $config);
			$AttachmentFile='';
			if($_FILES['AttachmentFile']['name'] != ''){
				if ( $this->upload->do_upload('AttachmentFile')){
					$attachDetails = $this->upload->data();
					$AttachmentFile = $attachDetails['file_name'];
				}else{
					$AttachmentFile = $this->upload->display_errors();
					$this->setErrorMessage('error',$AttachmentFile);
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
												
		if($AttachmentFile != ''){
				$AttachmentFilePath  =base_url().'attachments/'.$AttachmentFile;
				$AttachmentFilePathMime  = $this->support_model->get_file_mime_type(base_url().'attachments/'.$AttachmentFilePath);
				$attach[]=array("path" => $AttachmentFilePath, "name" => $AttachmentFile,"type" => $AttachmentFilePathMime);
		} 
			if($AttachmentFile != ''){ 
				$result = $this->support_model->freshdesk_create_ticket_with_attachements($ticket_data,$attach);
			}else{				 
				$result=$this->support_model->freshdesk_create_ticket($ticket_data); 		
			}		
			
			$seller_freshdesk_id = $result->helpdesk_ticket->requester_id;  
			

			if($seller_freshdesk_id != ''){  
				$seller_freshdesk_id_check = $this->support_model->get_all_details(SELLER,array('freshdesk_id' => $seller_freshdesk_id,'seller_id' => $this->checkLogin('U')));
				if($seller_freshdesk_id_check->num_rows() == 0){ echo '---seller_freshdesk_id_check';
					$this->support_model->update_details(SELLER,array('freshdesk_id' => $seller_freshdesk_id),array('seller_id' => $this->checkLogin('U')));
				}
			}
			
			
		$ticket_id=$result->helpdesk_ticket->display_id;

		if($ticket_id != ''){
		$submitted=addslashes(artfill_lg('lg_ur_ticket_submitted','Your ticket submitted successfully'));
			$this->setErrorMessage('success',$submitted);
			redirect('view-ticket/'.$ticket_id);
		} else {
		$not_submitted=addslashes(artfill_lg('lg_ur_ticket_notsubmitted','Ticket not submitted, Please try again later'));
			$this->setErrorMessage('error',$not_submitted);
			redirect($_SERVER['HTTP_REFERER']);
		}
		}
	}
	
	public function freshdesk_view_message(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else{
			$condition =array('seller_id'=>$this->checkLogin('U'));
			$this->data['seller_details'] = $this->support_model->get_all_details(SELLER,$condition);
			$display_id=$this->uri->segment(2);
			$ticket_data1 = array('display_id'=>$display_id);
			$this->data['heading'] = 'Seller Support Ticket View';
			$this->data['freshdesk_view']= $freshdesk_view = $this->support_model->freshdesk_view_message($ticket_data1);  
			
			$requester_id=$freshdesk_view->helpdesk_ticket->requester_id; 

			$seller_data = $this->support_model->get_all_details(SELLER,array('seller_id' => $this->checkLogin('U')))->row();
			
			$this->data['seller_info'] =  $seller_data;

			if($freshdesk_view->errors->error == ''){
				if($seller_data->freshdesk_id == $requester_id){
					$this->load->view('site/freshdesk/freshdesk_view_message',$this->data);
				} else {
				$not_permitted_toview=addslashes(artfill_lg('lg_no_permission','You are not permitted to view this ticket'));
					$this->setErrorMessage('error',$not_permitted_toview);
					redirect('view-ticket-list/'.$seller_data->seourl);
				}
			} else {
				$this->setErrorMessage('error',$freshdesk_view->errors->error);
				redirect('view-ticket-list/'.$seller_data->seourl);
			}
		}
	}
	
	function send_ticket_note(){
		
		$filesList=$_FILES;  
		$ticket_id =$this->input->post('ticket_id');
		$body =$this->input->post('ticket_reply_textarea');
		
		$ticket_data = array(
					"helpdesk_note" => array("body"=>$body,"private" => 'false')
		);
		
		
		if(!empty($ticket_data)){
				$fd_domain = $this->config->item('fresh_desk_link');
				$token = $this->config->item('fresh_desk_key');
				$json_body = json_encode($ticket_data);
				$header[] = "Content-type: application/json";
				$connection = curl_init("$fd_domain/helpdesk/tickets/$ticket_id/conversations/note.json");
				curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($connection, CURLOPT_HTTPHEADER, $header);
				curl_setopt($connection, CURLOPT_HEADER, false);
				curl_setopt($connection, CURLOPT_USERPWD, "$token");
				curl_setopt($connection, CURLOPT_POST, true);
				curl_setopt($connection, CURLOPT_POSTFIELDS, $json_body);
				curl_setopt($connection, CURLOPT_VERBOSE, 1);
				$response = curl_exec($connection);
				echo $response;
				#exit;
		}
		$ticket_msg=addslashes(artfill_lg('lg_ticket_msg_submitted','Ticket message submitted successfully'));
		$this->setErrorMessage('success',$ticket_msg);
		redirect('view-ticket/'.$ticket_id);
	}
	
	public function freshdesk_veiw_ticket(){
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			$condition =array('seller_id'=>$this->checkLogin('U'));
			$this->data['seller_details'] = $this->support_model->get_all_details(SELLER,$condition);
			$email=$this->session->userdata['shopsy_session_user_email'];
			if($this->uri->segment(3) == ''){
				$pageNo=1;
			} else {
				$pageNo=$this->uri->segment(3);
			}

				$ticket_data1 = array(
					'email'=>$email,
					'filter_name' => 'all_tickets',
					'page'=>$pageNo
				);
				$this->data['heading'] = addslashes(artfill_lg('lg_seller_suport_ticket','Seller Support Ticket Lists'));
				$this->data['freshdesk_messages']=$freshdesk_messages=$this->support_model->freshdesk_view_ticket($ticket_data1);
				$freshdesk_messagesList=array_filter($freshdesk_messages);
				$ticketCount=count($freshdesk_messagesList);
				
				$nextBtn='Yes'; $prevBtn='Yes'; 
				if($ticketCount == 0 || $ticketCount < 30){
					$nextBtn='No';
				}
				if($pageNo==1){
					$prevBtn='No';
				}
				$this->data['nextBtn']=$nextBtn;
				$this->data['prevBtn']=$prevBtn;
				$this->data['ticketCount']=$ticketCount;
				$this->data['pageNo']=$pageNo;
				
				$this->load->view('site/freshdesk/freshdesk_message',$this->data);
		}
	}
	
	
}