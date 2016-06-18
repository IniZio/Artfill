<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This controller contains the functions related to unavailable messages
 * @author Newman
 *
 */

class Info extends MY_Controller {

	function __construct(){ 
        parent::__construct();
        $this->load->library('session');
        $this->data['userId']=$this->checkLogin('U');
	$this->data['loginCheck']=$this->checkLogin('U');
	$this->load->model(array('user_model'));
	}

	function about(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/about', $this->data);
	}
	
	function company(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/company', $this->data);
	}
	
	function joinus(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/joinus', $this->data);
	}
	
	function terms(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/terms', $this->data);
	}
	
	function privacy(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/privacy', $this->data);
	}
	
	function faq(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/info/faq', $this->data);
	}
}
?>