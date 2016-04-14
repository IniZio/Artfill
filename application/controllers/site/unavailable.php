<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This controller contains the functions related to unavailable messages
 * @author Newman
 *
 */

class Unavailable extends MY_Controller {

	function __construct(){ 
        parent::__construct();
        $this->load->library('session');
        $this->data['userId']=$this->checkLogin('U');
	$this->data['loginCheck']=$this->checkLogin('U');
	$this->load->model(array('user_model'));
	}

	function comingSoon(){
		$condition = array('email'=>$email);
		$userDetails = $this->user_model->get_all_details(USERS,$condition);
		$this->load->view('site/unavailable/coming_soon', $this->data);
	}

}
?>