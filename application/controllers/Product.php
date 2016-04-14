<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
* Product controller
*/
class Product extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('cookie', 'form'));
		$this->load->library(array('form_validation','sesion'));
		$this->load->model(array('product_model'));
	}

	/**
	* Display insert product form
	* @return void
	*/
	public function insert_product_form()
	{
		if(true)//require: check if loginned
		{
			$this->load->view('site/product/add_product');
		}
	}

	/**
	* Function for inserting product
	* @param string seourl
	* @param string product_name
	* @return void
	*/
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

	/**
	* Display inserting / modifying product form
	* @return void
	*/
	public function edit_product_form()
	{
		$this->load->view('site/product/edit_product');
	}

	/**
	* Edit products
	* @return void
	*/
	public function edit_product()
	{
		 
	}

	/**
	* Delete products
	* @return void
	*/
	public function delete_product()
	{
		
	}

	/**
	* Display one product's details
	* @param string $seourl
	*/
	public function product_detail($seourl)
	{
		$condition=array('seourl'=>$seourl);
		$product=$this->product->get_all_details(PRODUCT, $condition,'', 1);
	}
}