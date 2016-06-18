<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Shop related functions
 * @author Teamtweaks
 *
 */

class Email extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','seller_model','user_model','email_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['AdminloginCheck'] = $this->checkLogin('A');
		$this->data['menu_open'] = '';
	
	 	
		if($this->checkLogin('U')==""){
			$this->setErrorMessage('error','You must login first!.');
			redirect("shop/sell");
		}
		
    }
	
	
	/** 
	 * 
	 * Displaying the inbox page
	 *
	 */
	public function index(){ 
		#$this->data['heading'] = 'Manage Shop Email';
		#$this->load->view('site/store/email/home',$this->data);
		if(isset($_GET['j'])){
			$this->getVal();
		die;
		}
		redirect(current_url().'/inbox');
    }
	
	/** 
	 * 
	 * Displaying the Compose mail page
	 *
	 */
	public function load_compose_mail(){ 
		$emailList=$this->email_model->getEmailList();		#echo '<pre>'; print_r($emailList); die;
		foreach($emailList as $em){
			$newEmail[]=$em['email'];
		}
		file_put_contents('email.json', json_encode($newEmail));
		$this->data['toEmail']='';
		if($this->input->get('to') != ''){
			$toEmail=$this->seller_model->check_email_list_exist('',$this->input->get('to'));
			if($toEmail->num_rows() >0){
				$this->data['toEmail']=$toEmail->row()->email;
			}else {
				$this->setErrorMessage('error','Sorry! Email id does not exist.');
				redirect('mail-contacts');
			}
		}
		$this->data['heading'] = 'Compose new email.';
		$this->data['email_List']=$this->seller_model->get_email_lists($this->checkLogin('U'));		
		$this->load->view('site/store/email/compose',$this->data);
	}
	
	/** 
	 * 
	 * Displaying the message page
	 *
	 */
	public function display_messages(){
		if ($this->checkLogin('U')!=''){
			$email=$this->session->userdata('shopsy_session_user_email');
			
			$typev= $this->uri->segment(3);
			if($this->uri->segment(4)==""){
				$pageVal=1;
			}else{
				$pageVal= substr($this->uri->segment(4),4);
				if($pageVal==1){
					redirect(base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));
				}
			} 
			$this->data['viewfolder'] =$typev;
			$this->data['totalMsg'] = $this->email_model->get_conversation_details($this->checkLogin('U'),$typev)->num_rows();
			$currPage=$pageVal;
			$this->data['perPage']=$perPage=10;
			$this->data['pagePos']=$pagePos=$currPage;
			$this->data['prevpagePos']=$prevpagePos=$currPage-1;
			$this->data['nextpagePos']=$nextpagePos=$currPage+1;
			$this->data['conversations'] = $this->email_model->get_conversation_details_page($this->checkLogin('U'),$typev,$perPage,$pagePos);
			$this->data['folder']=$typev;
			$this->data['heading'] =ucfirst($typev).' - '.$email.'-'.$this->config->item('email_title');	
			$this->load->view('site/store/email/home',$this->data);
		}else{
			$this->setErrorMessage('error','Login Required');	
			redirect('login');
		}
	}
	
	/** 
	 * 
	 * Get the current user messgaes
	 *
	 */
	public function getVal(){
		$vals=$this->email_model->get_all_details(CONTACTPEOPLE);
		echo "sad<pre>"; print_r($vals);
		echo "sad<pre>"; print_r($vals->result());
		$vals=$this->email_model->get_conversation_details($this->checkLogin('U'),'inbox');
		echo "sad<pre>"; print_r($vals); die;
	}
	
	/** 
	 * 
	 * Displaying the particular message page
	 *
	 */
	public function view_messages(){
		if ($this->checkLogin('U')!=''){
			$msgid=$this->uri->segment(5,0);
			$this->data['viewfolder'] =$this->uri->segment(4,0);
			
			$this->data['MessageDetail'] = $this->user_model->get_message_details($msgid);
			#echo $this->db->last_query(); die;
			
			
			#echo '<pre>'; print_r($this->data['MessageDetail']->result()); die;
			
			if($this->data['MessageDetail']->num_rows() >0){
			if($this->uri->segment(3)=="inbox"){
				$colstatus='receiver_status';
			}else if($this->uri->segment(3)=="sent"){
				$colstatus='sender_status';
			}else{
				if($this->data['MessageDetail']->row()->sender_id==$this->checkLogin('U')){
					$colstatus='sender_status';
				}else if($this->data['MessageDetail']->row()->receiver_id==$this->checkLogin('U')){
					$colstatus='receiver_status';
				}
			}
			$newdata=array($colstatus=>'Read');
			$condition = array('id' => $this->data['MessageDetail']->row()->id,'sender_status'=>!'Trash','receiver_status'=>!'Trash');

			$this->email_model->update_details(CONTACTPEOPLE,$newdata,$condition);
			}
			$this->data['heading'] =$this->data['MessageDetail']->row()->subject.' - '.$this->config->item('email_title');
			#echo $condition;
			#die;

			


			$this->load->view('site/store/email/view_message',$this->data);
		}else{
			$this->setErrorMessage('error','Login Required');	
			redirect('login');
		}
	}
	
	/** 
	 * 
	 * Update the message to starred message
	 *
	 */
	public function starredMsg(){
		if ($this->checkLogin('U')!=''){
			$user_id=$this->checkLogin('U');
			$id=$this->input->post('MsgId');
			$folder=$this->input->post('folder');
			$starred=$this->input->post('starred');
			if($folder=="Inbox"){
				$dataArr=array('receiver_starred'=>$starred);
			}else{
				$dataArr=array('sender_starred'=>$starred);
			}
			$condition=array('id'=>$id);
			$this->email_model->update_details(CONTACTPEOPLE,$dataArr,$condition);
			return true;
		}
	}
	
	/** 
	 * 
	 * Get the mails from ajax
	 *
	 */
	public function ajaxGetmail(){
		$keystr=$this->input->post('key'); 
		if($keystr != ''){
			$getEmail=$this->seller_model->get_Ajax_email_list($keystr);
			if($getEmail->num_rows() > 0){
				$mailsList=array(); $i=0;
				foreach($getEmail->result() as $mails){
						$mailsList[]=$mails->email;
					$i++;
				}
				echo json_encode($mailsList); die;
			}
		}
	}
	
	function common_mail_share(){ 
		if($this->checkLogin('U')==""){
				$this->setErrorMessage('error','You must login first!.');
				redirect("shop/sell");
		} #echo '<pre>'; print_r($_POST); die;
			$sender_email=$this->session->userdata['shopsy_session_user_email'];
			$sender_name=$this->session->userdata['shopsy_session_full_name'];
			$subject=$this->input->post('subject');
			$messageText=$this->input->post('message');
			
			if($tid=$this->input->post('tid'))
			{
			$tid=$this->input->post('tid');
			}
			else
			{
			$tid=time();
			}
			$footer_content=$this->config->item('footer_content');  
		    $toemailList = @explode(',',$this->input->post('email')); //exit;
			#echo '<pre>'; print_r( $toemailList); die;
		    $email=''; $ccmailArr=array(); 
		    for($i=0;$i<count($toemailList);$i++){
				$chk=$this->seller_model->check_email_list_exist(trim($toemailList[$i])); #echo '<pre>'; print_r($chk->result()); 
				if($chk->num_rows() == 1){	
					$email=$chk->row()->email;
					$mail_delivery="success";
				}else {
					$mail_delivery="failed";
				}
				$receiver_name=$chk->row()->full_name;
				#$ccmail=@implode(', ',$ccmailArr);
				#$ccArr={$ccmail};
				#$tid=time();
				$dataArry = array(
					'sender_email'=>$sender_email,
					'sender_id'=>$this->session->userdata['shopsy_session_user_id'],
					'receiver_email'=>$chk->row()->email,
					'receiver_id'=>$chk->row()->id,
					'subject'=>$subject,
					'message'=>$messageText,
					'dataAdded'=>date('Y-m-d H:i:s'),
					//'mail_type'=>'vendor',
					'tid'=>$tid
					//'delivery_status'=>$mail_delivery
				);
				

				if($chk->row()->email != ''){
					$this->user_model->simple_insert(CONTACTPEOPLE,$dataArry);
				}
			#echo $this->db->last_query(); die;
			
				$newsid='19';
				$template_values=$this->user_model->get_newsletter_template_details($newsid);
				$subject = $subject;
				#$user_name=$chk->row()->full_name;
				$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
				extract($adminnewstemplateArr);
				$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				$message="";
				$message .= '<!DOCTYPE HTML>
				<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<meta name="viewport" content="width=device-width"/><body >';
				include('./newsletter/registeration'.$newsid.'.php');	
				$message .= '</body>
			
				</html>';
				 #echo '<pre>';  print_r($prevMsg); die;
				$email_values = array('mail_type'=>'html',
								'from_mail_id'=>$sender_email,
								'mail_name'=>$sender_name,
								'to_mail_id'=>$chk->row()->email,
								'subject_message'=>$subject,
								'body_messages'=>$message
								);   
				if($chk->row()->email != ''){				#echo '<pre>'; print_r($email_values); die;
					$this->user_model->common_email_send($email_values);				
					$this->setErrorMessage('success','Email has been sent successfully!.');
				}else{
					$this->setErrorMessage('error','Email sent failed!.');
				}
			}
			redirect($this->data['globalshop_url'].'/email/inbox');
	}
	function load_mail_contacts(){
		if($this->checkLogin('U')==""){
				$this->setErrorMessage('error','You must login first!.');
				redirect("shop/sell");
		}
		$this->data['emailContacts']=$this->seller_model->get_email_lists($this->checkLogin('U'));
		#echo $this->db->last_query(); die;
		
		$this->data['heading'] ='Email contacts - '.$this->config->item('email_title');
		
		
		$this->load->view('site/store/email/contacts.php',$this->data);
		
	}
	
	public function deleteconversation(){
		$user_id=$this->uri->segment(4);
		$id=$this->uri->segment(5);
		$condition=array('id' =>$id);
		$vals=$this->email_model->get_all_details(CONTACTPEOPLE,$condition);
		
		if($vals->row()->receiver_id==$user_id){
			$newdata=array('receiver_status'=>'Trash');			
		}else if($vals->row()->sender_id==$user_id){
			$newdata=array('sender_status'=>'Trash');
		}
		$this->email_model->update_details(CONTACTPEOPLE,$newdata,$condition);
		#echo $this->db->last_query(); die;
		redirect($_SERVER["HTTP_REFERER"]);
	}
}



// Class ends
/*End of file email.php */
/* Location: ./application/controllers/site/email.php */	
		