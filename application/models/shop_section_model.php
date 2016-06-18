<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to shop section requests
 * @author Teamtweaks
 *
 */
class Shop_section_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting shop section list details
    * @param String $condition
    */
 
 // Select all data

    public function get_shop_section_list($section_condtion = ''){
   		$this->db->select(SHOP_SECTION_LIST.'.*,'.SHOP_SECTION_LIST.'.id as shop_section_auto_id');
		$this->db->from(SHOP_SECTION_LIST);
		$this->db->join(SELLER,SELLER.'.seller_id='.SHOP_SECTION_LIST.'.seller_id');
		$this->db->where($section_condtion);
		//$this->db->where(SELLER.'.seourl',$section_condtion);
		$this->db->order_by(SHOP_SECTION_LIST.'.section_name','asc');
		$shop_list_query = $this->db->get();
		return $shop_list_result = $shop_list_query->result_array();
   }




	/**
    * 
    * Getting shop section list product details list
    * @param String $condition
    */
 	
	function get_shop_product_idlist()
	{
		$shop_name_seourl = $this->uri->segment('2'); // Its a shop name seourl from  seller table
		$section_id = $_GET['section_id'];
		
		$this->db->select(SHOP_SECTION_LIST.'.product_id');
		$this->db->from(SHOP_SECTION_LIST);
		$this->db->join(SELLER,SELLER.'.seller_id='.SHOP_SECTION_LIST.'.seller_id');
		$this->db->where(SELLER.'.seourl',$shop_name_seourl);
		if($section_id != '')
		{
			$this->db->where(SHOP_SECTION_LIST.'.section_id',$section_id);
		}
		$shop_prod_id_qry = $this->db->get();
		return $shop_prod_id_rslt = $shop_prod_id_qry->result_array();
	}



	/**
    * 
    * Getting shop section list product details list
    * @param String $condition
    */
 
 // Select all data

    public function get_shop_selection_products($shop_section_prod_ids = array(),$start_val = '',$limit_val = '',$sellerId=''){	
		//echo "<prE>";print_r($shop_section_prod_ids); 
		$this->db->select(PRODUCT.'.*,'.PRODUCT.'.id as product_id_no');
		$this->db->from(PRODUCT);
		//$this->db->join(SUBPRODUCT,SUBPRODUCT.'.product_id='.PRODUCT.'.id','inner');
		$where=array('status'=>'Publish');
		$this->db->where(PRODUCT.'.status','Publish');
		if($sellerId!=''){
			$this->db->where(PRODUCT.'.user_id',$sellerId);
		}
		//$this->db->where(SUBPRODUCT.'.pricing !=','');  
		
		if(!empty($shop_section_prod_ids) && $_GET['search_query'] == '')
		{
			$this->db->where_in(PRODUCT.'.id',$shop_section_prod_ids);
		}
		if($limit_val !='')
		{
			$this->db->limit($limit_val,$start_val);
		}		
		if($_GET['search_query'] != '')
		{
			//$this->db->like(PRODUCT.'.product_name',trim(addslashes($_GET['search_query'])));
			//$this->db->like(PRODUCT.'.description',trim(addslashes($_GET['search_query'])) );
			//$this->db->or_like(PRODUCT.'.product_name',trim(addslashes($_GET['search_query'])));
			$this->db->where('('.PRODUCT.'.description like  "%'.trim(addslashes($_GET['search_query'])).'%" OR '.PRODUCT.'.product_name like "%'.trim(addslashes($_GET['search_query'])).'%")');
		}
		$this->db->group_by(PRODUCT.'.id');
		
		if($_GET['order'] == 'price_desc')
		{
			$this->db->order_by(PRODUCT.'.price','desc');
		}else if($_GET['order'] == 'price_asc')
		{
			$this->db->order_by(PRODUCT.'.price','asc');
		}else if($_GET['order'] == 'date_desc')
		{
			$this->db->order_by(PRODUCT.'.created','desc');
		}else { 
			$this->db->order_by(PRODUCT.'.id','desc');
		}
		

		//$this->db->group_by(SUBPRODUCT.'.product_id');
		$shop_selection_products_qry = $this->db->get();
		
		return $shop_selection_products_rslt = $shop_selection_products_qry->result_array();
   }
   
   	/**
    * 
    * Getting shop seller details   
    */
 
    public function get_seller_details(){		
		$shop_name_seourl = $this->uri->segment('2'); // Its a shop name seourl from  seller table
		$this->db->select(SELLER.'.*');
		$this->db->from(SELLER);
		$this->db->where(SELLER.'.seourl',$shop_name_seourl);		
		$get_seller_details_qry = $this->db->get();
		return $get_seller_details_qry_rslt = $get_seller_details_qry->row_array();
   }
   
   /**
    * 
    * Getting shop owner details   
    */
 
    public function get_shop_owner_info(){		
		$shop_name_seourl = $this->uri->segment('2'); // Its a shop name seourl from  seller table
		$this->db->select('*');
		$this->db->from(SELLER);
		$this->db->join(USERS,USERS.'.id='.SELLER.'.seller_id');
		$this->db->where(SELLER.'.seourl',$shop_name_seourl);		
		$get_seller_details_qry = $this->db->get();
		return $get_seller_details_qry_rslt = $get_seller_details_qry->row_array();
   }
   /**
    * 
    * Getting sales details   
    */
   public function get_shop_selling_info(){		
		$shop_name_seourl = $this->uri->segment('2'); // Its a shop name seourl from  seller table
		$shop= $this->get_all_details(SELLER,array('seourl'=>$shop_name_seourl))->row_array();
		$this->db->select('p.product_id');
		$this->db->from(USER_PAYMENT.' as p');
		$this->db->join(PRODUCT.' as pd' , 'pd.id = p.product_id');
		$this->db->where('p.sell_id',$shop['seller_id']);		
		$this->db->group_by('pd.id'); 
		$get_seller_sales_qry = $this->db->get();
		return $get_seller_sales_qry = $get_seller_sales_qry->result_array();
   }
   
	
  }// Class ends