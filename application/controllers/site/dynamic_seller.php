<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * 
 * User related functions
 * @author Teamtweaks
 *
 **/ 

class Dynamic_seller extends MY_Controller { 

	function __construct(){
	
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->library('session');
		$this->load->model('user_model');
    }
	
	/**
	 * 
	 * This function create the 2100 sellers dynamically
	 * 
	 */
	public function seller_create(){
		
		for($s=1580;$s<=2100;$s++){
		
			$password = '123456';
		
			$fullname = 'seller'.$s;
			$email = 'seller'.$s.'@gmail.com';
			$lastname = 's'.$s;
			$pwd = md5($password);
			$username = stripslashes('seller'.$s);
									
			$dataArr = array('full_name'=>$fullname,'user_name'=>$username,'last_name'=>$lastname,'email'=>$email,'password'=>$pwd,'status'=>'Active','group'=>'seller','is_verified'=>'Yes','commision'=>$this->config->item('product_commission'));
			$this->user_model->simple_insert(USERS,$dataArr);
			$lastInsId = $this->db->insert_id();
			
			$shopName = ucwords($fullname.' Shop');
			$seourl = url_title($shopName, '-', TRUE);
			
			$sellerArr = array('seller_id'=>$lastInsId,'seller_businessname'=>$shopName,'seourl'=>$seourl,'seller_email'=>$email,'seller_username'=>$username,'seller_firstname'=>$fullname,'seller_lastname'=>$lastname,'status'=>'active','featured_shop'=>'No','shop_title'=>$shopName);
			$this->user_model->simple_insert(SELLER,$sellerArr);
						
		}
	}
	
	/**
	 * 
	 * This function create the 2100 users dynamically
	 * 
	 */
	public function user_create(){
		
		for($s=1;$s<=2100;$s++){
		
			$password = '123456';
		
			$fullname = 'user'.$s;
			$email = 'user'.$s.'@gmail.com';
			$lastname = 'u'.$s;
			$pwd = md5($password);
			$username = stripslashes('user'.$s);
						
			$dataArr = array('full_name'=>$fullname,'user_name'=>$username,'last_name'=>$lastname,'email'=>$email,'password'=>$pwd,'status'=>'Active','group'=>'user','is_verified'=>'Yes','commision'=>$this->config->item('product_commission'));
			$this->user_model->simple_insert(USERS,$dataArr);
						
		}
	}
	
	/**
	 * 
	 * This function create the 250 category dynamically
	 * 
	 */
	public function category_create(){
		
		for($s=1;$s<=250;$s++){
		
			$categoryname = 'Category'.$s;
			$catseourl = url_title($categoryname, '-', TRUE);
			$seotitle = $categoryname;
			$seokeyword = $categoryname;
			$seodescrip = $categoryname;
												
			$dataArr = array('cat_name'=>$categoryname,'rootID'=>'0','seourl'=>$catseourl,'status'=>'Active','seo_title'=>$seotitle,'seo_keyword'=>$seokeyword,'seo_description'=>$seodescrip);
			$this->user_model->simple_insert(CATEGORY,$dataArr);
			$lastInsId = $this->db->insert_id();
			
			for($p=1;$p<=5;$p++){
			
				$subcatname = 'Subcategory'.$s.$p;
				$subcatseourl = url_title($subcatname, '-', TRUE);
				$subseotitle = $subcatname;
				$subseokeyword = $subcatname;
				$subseodescrip = $subcatname;
													
				$SubdataArr = array('cat_name'=>$subcatname,'rootID'=>$lastInsId,'seourl'=>$subcatseourl,'status'=>'Active','seo_title'=>$subseotitle,'seo_keyword'=>$subseokeyword,'seo_description'=>$subseodescrip);
				$this->user_model->simple_insert(CATEGORY,$SubdataArr);
			}
						
		}
	}
	
	/**
	 * 
	 * This function create the product deponds on admin product
	 * 
	 */
	public function product_create(){
	
		$this->db->select('id,user_name');
		$this->db->from(USERS);
		$this->db->where('group','seller');
		$SellerVal = $this->db->get();
		
		#echo '<pre>'; print_r($SellerVal->result());die;
		$catArr = array('1','2','3');
		$this->db->select('id');
		$this->db->from(CATEGORY);
		$this->db->where('rootID','0');
		$this->db->where_not_in('id',$catArr);
		$CategoryVal = $this->db->get();
		
		//echo '<pre>'; print_r($CategoryVal->result_array());die;
		$catVal = $CategoryVal->result_array();
		$sp=0;
		foreach($SellerVal->result() as $sellerId){
			if($sellerId->id!='1'){
				
				$catId = $catVal[$sp]['id'];
				
				if($catId==''){
					$sp=0;
				}
				
				$this->db->select('*');
				$this->db->from(PRODUCT);
				$this->db->where('user_id','1');
				$productVal = $this->db->get();
				
				
				
				$this->db->select('GROUP_CONCAT(id) as SubCatId');
				$this->db->from(CATEGORY);
				$this->db->where('rootID',$catId);
				$SubCategoryVal = $this->db->get();
				
				$subcatId = $SubCategoryVal->row()->SubCatId;
				
				#echo '<pre>'; print_r($SubCategoryVal->row()->SubCatId); die;
				if($subcatId!=''){
					$catIDVal = $catId.','.$subcatId;
				}else{
					$catIDVal = $catId;
				}
				
				$excludeArr = array('id','seller_product_id','category_id','user_id');
				$inputArr = array();
				foreach ($productVal->result_array() as $key => $vals){
					foreach ($vals as $key => $val){
					
					if (!in_array($key, $excludeArr)){
						$inputArr[$key] = $val;
					}else{
						if($key=='seller_product_id'){
							$inputArr[$key] = $this->get_rand_val('6');
						}
						if($key=='user_id'){
							$inputArr[$key] = $sellerId->id;
						}
						if($key=='category_id'){
							$inputArr[$key] = $catIDVal;
						}
					}
					}
				//echo '<pre>'; print_r($inputArr);
				$this->db->insert(PRODUCT,$inputArr);
				#echo '<br>'.$this->db->insert_id();
				}
				
				$sp++;
			
			}
			
		
		}
		
	}
	
	/**
	 * 
	 * This function return the random values
	 * @param int $length
	 * 
	 */
	 public function get_rand_val($length='6'){
			return substr(str_shuffle("0123456789"), 0, $length);
	}
	
	/**
	 * 
	 * This function update the dublicate seourls
	 * 
	 */
	public function dublicate_seourl(){
		
		$this->db->select('seourl');
		$this->db->from(PRODUCT);
		$this->db->group_by('seourl');
		$productVal = $this->db->get();
		#echo '<pre>'; print_r($productVal->result()); die;
		
		foreach($productVal->result() as $producval){
		
			$this->db->select('id,seourl');
			$this->db->from(PRODUCT);
			$this->db->where('seourl',$producval->seourl);
			$productsVal = $this->db->get();
			
			$s=1;	
			foreach($productsVal->result() as $productVals){
				//echo '<br>'.$productVals->id;
				$dataArr = array('seourl'=>$producval->seourl.$s);
				$this->user_model->update_details(PRODUCT,$dataArr,array('id'=>$productVals->id));
				#echo '<br>'.$this->db->last_query();
				$s++;
			}
		
		}
		
		
	
	}
	
}
/* End of file dynamic seller.php */
/* Location: ./application/controllers/site/dynamic seller.php */