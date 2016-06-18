<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Sms related functions
 * @author Casperon
 *
 */

class Sms_twilio extends MY_Controller { 
	function __construct(){
        parent::__construct();  error_reporting(-1);
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation','twilio'));		
		$this->data['loginCheck'] = $this->checkLogin('U');  
		$this->load->model(array('user_model'));
    }
    
  
	/** 
	 * 
	 * Send Otp Ajax function 
	 */
	function send_otp(){ 
		if ($this->checkLogin('U')==''){
			$this->setErrorMessage('success','Login Required');
			redirect('login');
		} 

		$otp_phone=$this->input->post('otp_phone');
		$phone_code=$this->input->post('phone_code');
		if($otp_phone != ''){
			$otp_number=rand(10000,99999); 
			$this->session->set_userdata('store_setup_otp',$otp_number);
			$from = $this->config->item('twilio_number');
			$to = $phone_code.$otp_phone;
			$message = 'Hai! your one time password is '.$otp_number;
			$response = $this->twilio->sms($from, $to, $message); 
			$this->user_model->update_details(USERS,array('mobile_otp_code' => $otp_number),array('id' => $this->checkLogin('U')));  #echo '<pre>'; print_r($response); 
			echo json_encode($otp_number); 
		} else {
			echo json_encode('error');
		}
	}
	
	/**
	* verify the otp for mobile sms verification
	*
	**/
	function confirm_mobile_verification(){ 
		if ($this->checkLogin('U')==''){
			$this->setErrorMessage('success','Login Required');
			redirect('login');
		} error_reporting(-1);
		$otp=$this->input->post('otp_code');
		$phone_number=$this->input->post('phone_number');
		$phone_code=$this->input->post('phone_code'); 
		if($otp == $this->session->userdata('store_setup_otp')){ 
			$phone_no = $phone_code.$phone_number; 
			$this->user_model->update_details(USERS,array('phone_no' => $phone_no,'mobile_verification' => 'Yes'),array('id' => $this->checkLogin('U')));
			$this->setErrorMessage('success','Your mobile number verification success.');
		} else { 
			$this->setErrorMessage('error','Code number can not be match.');
		}
		redirect('shop/sell');
	}

	 
}

?>