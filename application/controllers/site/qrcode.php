<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* QR code testing
*/
class Qrcode extends MY_Controller
{
	
	function __construct()
	{
        parent::__construct();
		$this->load->library('ciqrcode');
	}

	public function index()
	{
		$params['data'] = 'This is a text to encode become QR Code';
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		$this->ciqrcode->generate($params);

		echo '<img src="'.base_url().'/images/tes.png" />';
	}
}