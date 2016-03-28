<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* Product controller
*/
class Productq extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insert_product_form()
	{
		//require: check if loginned
		{
			$this->load->view('product/add_product');
		}
	}

	public function insert_product($seourl='', $product_name='')
	{
		// if the seourl or product name already exists return error message
		// require: check if seourl and product name are valid in format
		if($this->product_model->check_exist(PRODUCT, array('seourl' => $seourl))){
			// require: append to message 'product urlname already in use'
		}
		if ($this->product_model->check_exist(PRODUCT, array('product_name'=>$product_name))){
			// require: append to message 'product name already in use'
		} else {
			$this->product_model->insert_product($product_name, $seourl);
		}
	}

	/*
	* Form for inserting / modifying product
	*/
	public function edit_product_form()
	{
		
	}
}