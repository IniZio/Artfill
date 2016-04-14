<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Zendesk related functions
 * @author Casperon
 *
 */

class Zendesk extends MY_Controller { 
	function __construct(){
        parent::__construct(); 
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('zendesk_model'));
		$this->data['loginCheck'] = $this->checkLogin('U'); 
		$zendesk=array('api_key'=> $this->config->item('zendesk_api'),
										'user'=> $this->config->item('zendesk_email'),
										'subDomain'=> $this->config->item('zendesk_subdomain_name'),
										'suffix'=>'.json'
										); 
		$this->load->library('zendeskclass',$zendesk);	
		#error_reporting(-1);
    }
    
  
	/** 
	 * 
	 * Displaying Zendesk List
	 */
	
	public function display_zendesk_tickets(){ 	
		if ($this->checkLogin('U') == ''){ 
			redirect('login');
		}else {  
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);	
			$this->data['heading'] = 'Display Zendesk Tickets';
			$this->data['seller_details']=$seller_details = $this->zendesk_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));			 
			#echo '<pre>'; print_r($seller_details->result()); die;
			$zen_user_id = $seller_details->row()->zendesk_id;   #'823889381';
			if($zen_user_id != ''){
				$this->data['zendesk_tickets']=$zendesk_tickets = $this->zendeskclass->call('/users/'.$zen_user_id.'/tickets/requested', '', 'GET');	
			} 
			$this->data['zen_user_id'] = $zen_user_id;
			$tickets = $zendesk_tickets->tickets; 
			if(is_array($tickets) && !empty($tickets)){
				$this->data['tickets'] = $this->zendesk_model->get_sorted_array_object_values($tickets,'updated_at','desc');	
			}else{
				$this->data['tickets'] = $tickets;	
			}
			$this->load->view('site/zendesk/display_zendesk_tickets',$this->data);
		}  
	} 
	
	/**
	*
	*View zendesk ticket
	**/
	function view_zendesk_ticket(){
		$ticket_id = $this->uri->segment(2);
		$this->data['heading'] = 'View Zendesk Ticket';
		$ticket_details = $this->zendeskclass->call('/tickets/'.$ticket_id.'/comments', '', 'GET');
		$ticket = $this->zendeskclass->call('/tickets/'.$ticket_id, '', 'GET');
		$this->data['ticket_details'] = $ticket_details->comments;
		$this->data['ticket'] = $ticket->ticket;
		#echo '<pre>'; print_r($ticket);  die;
		$this->load->view('site/zendesk/view_zendesk_ticket',$this->data);
	}
	
	
	/** 
	 * 
	 * Load Zendesk Form for Add
	**/
	public function create_zendesk_user(){
		$user_id=$this->input->post('user_id'); 
		$user_name=$this->input->post('user_name');
		$email_id=$this->input->post('email_id');
		$ticket_data['user'] = array("name" => $user_name,
															 "email" => $email_id
															);

		$data = $this->zendeskclass->call("/users", $ticket_data, "POST"); #echo '<pre>'; print_r($data);  die;
		
		if($data->error == ''){
			$zendesk_user_id = $data->user->id;
		} else if($data->error == 'RecordInvalid'){
		
			$get_usersList = $this->zendeskclass->call("/users", "", ""); #curl https://{subdomain}.zendesk.com/api/v2/users.json #next_page
			#echo '<pre>'; print_r($get_usersList->users); die;
			if($get_usersList->next_page == ''){
				foreach($get_usersList->users as $zenusers){
					if($email_id == $zenusers->email){
						$zendesk_user_id = $zenusers->id; break;
					}
				}
			} else {
				$this->setErrorMessage('error',$data->details->email[0]->description);
			}
		} else {
			$this->setErrorMessage('error',$data->error);
		}
		
		if($zendesk_user_id != ''){
			$data_to_update = array('zendesk_id' => $zendesk_user_id);
			$this->zendesk_model->update_details(SELLER,$data_to_update,array('seller_id' => $user_id));
		}

		if($this->input->post('return_url') != ''){
			if($zendesk_user_id != ''){
				$this->setErrorMessage('success','You have successfully created account with zendesk.');
			}
			redirect($this->input->post('return_url'));
		}
	} 
	
	/** 
	 * 
	 * Create Zendesk Ticket
	**/
	public function create_zendesk_ticket(){  
		$ticket_data['ticket'] = $this->input->post('ticket'); 
		$url = $this->input->post('url'); 
		$dispute_id = $this->input->post('dispute_id');  
		$input_type = $this->input->post('type');  
		if(!empty($ticket_data)){ 
			$data = $this->zendeskclass->call($url, $ticket_data, $input_type);
		}
		#echo '<pre>'; print_r($_POST);  echo '<pre>'; print_r($data); 
		if($data->ticket->id != '' && $dispute_id != ''){
			$this->zendesk_model->update_details(ORDER_CLAIM,array('zendesk_ticket_id' => $data->ticket->id),array('id' => $dispute_id));	
		}
	} 

	/** 
	 * 
	 * Create Zendesk Ticket From vendor page
	**/
	public function create_vendor_zendesk_ticket(){  
		if ($this->checkLogin('U') == ''){ 
			redirect('login');
		}
		$ticket_data['ticket'] = $_POST;   
		if(!empty($ticket_data)){ 
			$data = $this->zendeskclass->call('/tickets', $ticket_data, 'POST');
		}
		#echo '<pre>'; print_r($data); die;
		if($data->ticket->id != ''){
			$this->setErrorMessage('success','Your ticket has been submitted successfully.');
		} else {
			$this->setErrorMessage('error','Error while submitting your ticket, Please try again.');
		}
		redirect('zendesk-tickets');
		
	} 
	
	/** 
	 * 
	 * Create Zendesk Ticket
	**/
	public function update_zendesk_ticket(){  
		$ticket_data['ticket'] = $this->input->post('ticket'); 
		$url = $this->input->post('url'); 
		if(!empty($ticket_data)){ 
			$data = $this->zendeskclass->call($url, $ticket_data, 'PUT');
		}
	} 
}
/* End of file zendesk.php */
/* Location: ./application/controllers/site/zendesk.php */