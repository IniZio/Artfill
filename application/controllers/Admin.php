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

    public function index()
    {
        redirect('admin/adminlogin');
    }

    /**
     * instead of just inserting, it upgrades user to admin, verified by admin with a key
     * @param Integer user_id, String key
     */
    public function insert_admin($user_id, $key)
    {

    }

    public function delete_admin($user_id)
    {
    	
    }
}
