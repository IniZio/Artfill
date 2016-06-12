<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
* implementing ajaxsearch
*/
class Ajaxsearch extends MY_Controller
{
	
	function __construct()
	{
		
	}

	public function index()
	{
		parent::__construct();
		$this->data = '';
		$this->load->view('site/templates/header_ajaxSearch', $this->data);
	}
}