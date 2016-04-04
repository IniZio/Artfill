<?php

date_default_timezone_get('Asia/Hong_Kong');
define('TIMEZONE_GMT', '+8');

/**
* Base controller
* @author Artfill
*/
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		ob_start();
		ob_clean();
		$this->load->helper(array());
		$this->load->library(array('session'));
		// $this->load->set_header();
		// $this->load->model();

		$userdata = array(
            'artfill_session_user_id'    => '',
            'artfill_session_user_name'  => '',
            'artfill_session_user_email' => '',
            'artfill_session_user_role'  => '',
        );
        $this->session->set_userdata($userdata);
	}

	/**
    * 
    * Generate random string
    * @param Integer $length
    */
   public function get_rand_str($length='6'){
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
   }
}
?>