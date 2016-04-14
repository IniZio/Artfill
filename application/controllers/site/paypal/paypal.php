<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Paypal extends MY_Controller 
{
	
	
	function __construct()
	{
		parent::__construct();
		
		// Load helpers
		$this->load->helper('url');
		
		// Load PayPal library
		$this->config->load('paypal');
		
		$config = array(
			'Sandbox' => $this->config->item('Sandbox'), 			// Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'), 	// PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'), 	// PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'), 	// PayPal API signature of the API caller
			'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion'), 		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			'DeviceID' => $this->config->item('DeviceID'), 
			'ApplicationID' => $this->config->item('ApplicationID'), 
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);
		
		if($config['Sandbox'])
		{
			// Show Errors
			error_reporting(E_ALL ^ (E_NOTICE));
			ini_set('display_errors', '1');	
		}
		
		$this->load->library('paypal/Paypal_adaptive', $config);	
	}
	
	
	function display_in()
	{
		echo 'jaya'; die;
		#$this->load->view('adaptive_payments_demo');
	}
	
	
}

/* End of file adaptive_payments.php */
/* Location: ./system/application/controllers/paypal/adaptive_payments.php */