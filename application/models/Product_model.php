<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* This model contains all db functions related to products
*/
class Product_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Insert product
	 * @param  string $product_name
	 * @param  string $seourl url for product to be accessed
	 * @return void
	 */
	public function insert_product($product_name='', $seourl='')
	{
		$dataArr=array('product_name'=>$product_name, 'seourl'=>$seourl);
		$this->db->insert(PRODUCT, $dataArr);
	}
}