<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Admin controller
*/
class Admin extends MY_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index(){
		redirect('admin/adminlogin');
	}
}