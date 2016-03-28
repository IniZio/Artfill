<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
* This model contains all db functions related to products
*/
class Product_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insert_product($product_name='', $seourl='')
	{
		$dataArr=array('product_name'=>$product_name, 'seourl'=>$seourl);
		$this->db->insert(PRODUCT, $dataArr);
	}
}