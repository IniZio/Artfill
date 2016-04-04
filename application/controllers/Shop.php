<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* Shop controller
*/
class Shop extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insert_shop_form()
	{
		$this->load->view('site/shop/insert_shop');
	}

	public function insert_shop()
	{
		$shopname = $this->input->post('shopname');
	}

	public function edit_shop_form()
	{
		$this->load->view('site/shop/edit_shop');
	}

	public function edit_shop()
	{
		
	}

	public function delete_shop()
	{
	}
}