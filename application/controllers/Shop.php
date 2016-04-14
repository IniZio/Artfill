<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
* Shop controller
*/
class Shop extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display insert shop form
	 * @return void
	 */
	public function insert_shop_form()
	{
		$this->load->view('site/shop/insert_shop');
	}

	/**
	 * Insert shop
	 * @return void
	 */
	public function insert_shop()
	{
		$shopname = $this->input->post('shopname');
	}
	/**
	 * Display edit shop form
	 * @return void
	 */
	public function edit_shop_form()
	{
		$this->load->view('site/shop/edit_shop');
	}

	/**
	 * Edit shop details
	 * @return void
	 */
	public function edit_shop()
	{
		
	}

	/**
	 * Delete shop
	 * @return void
	 */
	public function delete_shop()
	{
	}
}