<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Admin controller
 */
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Redirects to admin login form if not loginned
     * @return void
     */
    public function index()
    {
        redirect('admin/adminlogin');
    }

    /**
     * Upgrades user to admin, verified by admin with a key
     * @param integer $user_id
     * @param string $key
     * @return void
     */
    public function insert_admin($user_id='', $key='')
    {

    }

    /**
     * Delete admin role from user
     * @param integer $user_id
     * @return void
     */
    public function delete_admin($user_id='')
    {
    	
    }
}
