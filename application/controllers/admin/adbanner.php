<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Banner management
 * @author Teamtweaks
 *
 */

class Adbanner extends MY_Controller{  

	function __construct(){
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('Landing_model');
		if ($this->checkPrivileges('banner',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	
	public function display_ad_banner(){
	}
	
}