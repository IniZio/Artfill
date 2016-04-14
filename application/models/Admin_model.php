<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* This model contains all db functions related to admin management
*/
class Admin_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Add admin role to a user
	 * @return void
	 */
	public function insert_admin()
	{
		
	}
}