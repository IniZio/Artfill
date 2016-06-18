<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Product management 
 * @author Teamtweaks
 *
 */ 

class Deals extends MY_Controller {

	function __construct(){
	
        parent::__construct();

		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('deals_model','product_model'));
		if ($this->checkPrivileges('product',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the product list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/deals/display_deal_lists');
		}
	}
	
	/**
	 * 
	 * This function loads the selling product list page
	 */
	public function display_deal_lists(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Deal of the day List';
			$this->data['minmax']=$this->deals_model->get_min_max();
			
			if(isset($_POST['submit']))
			{
			
			$amount=explode('-',$_POST['amount']);
	
	    $discount=explode('-',$_POST['discount']);
	#print_r($discount);
	#print_r($_POST);
	#exit;
	  $minamount=trim(str_replace('$','',$amount[0]));
	
	 $maxamount=trim(str_replace('$','',$amount[1]));
	
	  $mindiscount=trim(str_replace('%','',$discount[0]));
	
	 $maxdiscount=trim(str_replace('%','',$discount[1]));
			$this->data['checkin']=$_POST['checkin'];
			$this->data['checkout']=$_POST['checkout'];
			$this->data['mindiscount']=$mindiscount;
			$this->data['maxdiscount']=$maxdiscount;
			$this->data['minprice']=$minamount;
			$this->data['maxprice']=$maxamount;
			
			$this->data['productList']=$this->deals_model->filter_deal();
			}
			else
			{
			$this->data['productList'] = $productList = $this->deals_model->view_deal_details('  where (u.group="Seller" and u.status="Active" or p.user_id=1) and (a.pricing IS NOT NULL or p.price IS NOT NULL) and p.status != "Deleted" and p.action = "DOD" group by p.id order by p.created desc');
			
			#echo $this->db->last_query();
			}
			
			
			#echo $this->db->last_query();
			#exit;
			$this->load->view('admin/deals/display_deals_list',$this->data);
		}
	}

	/**
	 * 
	 * This function loads the affiliate product list page
	 */
	public function display_user_product_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Affiliate Product List';
			$this->data['productList'] = $this->product_model->view_notsell_product_details();
			$this->load->view('admin/product/display_user_product_list',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the deleted product list form
	 */
	public function product_recycle_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Deleted Product List';
			$this->data['productList'] = $this->product_model->view_product_details('  where (u.group="Seller" and u.status="Active" or p.user_id=0) and p.status="Deleted" group by p.id order by p.created desc');
			//echo '<pre>'; print_r(array('arrayOut' => $this->data['productList']->result_array())); die;
			$this->load->view('admin/product/recycle_product_list',$this->data);
		}
	}
	
	
	
	/**
	 * 
	 * This function loads the Seller user product list page
	 */
	public function display_seller_product_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Affiliate Product List';
			$this->data['productList'] = $this->product_model->view_notsell_product_details();
			$this->load->view('admin/product/display_user_product_list',$this->data);
		}
	}
	
	/**
	 * 
	 * This function loads the add new product form
	 */
	public function add_deal_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Deal';
			$this->data['Product_id'] = $this->uri->segment(4,0);
			$this->data['categoryView'] = $this->product_model->view_category_details();
			$this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
			$this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
			$this->data['CntyVal'] = $CntyVal = $this->product_model->view_product_shipping_details();			
			$this->load->view('admin/deals/add_deals',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit product
	 */
	public function insertEditDeal(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_name = strip_tags($this->input->post('product_name'));
			$product_id = $this->input->post('productID');
			if ($product_name == ''){
				$this->setErrorMessage('error','Product name required');
//				redirect('admin/product/add_product_form');
				echo "<script>window.history.go(-1)</script>";exit();
			}
			$sale_price = $this->input->post('sale_price');
			if ($sale_price == ''){
				$this->setErrorMessage('error','Sale price required');
//				redirect('admin/product/add_product_form');
				echo "<script>window.history.go(-1)</script>";exit();
			}else if ($sale_price <= 0){
				$this->setErrorMessage('error','Sale price must be greater than zero');
				echo "<script>window.history.go(-1)</script>";exit();
				//redirect('admin/product/add_product_form');
			}
			if ($product_id == ''){
				$old_product_details = array();
				$condition = array('product_name' => $product_name);
			}else {
				$old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
				$condition = array('product_name' => $product_name,'id !=' => $product_id);
			}
/*			$duplicate_name = $this->product_model->get_all_details(PRODUCT,$condition);
			if ($duplicate_name->num_rows() > 0){
				$this->setErrorMessage('error','Product name already exists');
				echo "<script>window.history.go(-1)</script>";exit();
			}
*/			$price_range = '';
			if ($sale_price>0 && $sale_price<21){
				$price_range = '1-20';
			}else if ($sale_price>20 && $sale_price<101){
				$price_range = '21-100';
			}else if ($sale_price>100 && $sale_price<201){
				$price_range = '101-200';
			}else if ($sale_price>200 && $sale_price<501){
				$price_range = '201-500';
			}else if ($sale_price>500){
				$price_range = '501+';
			}
			$excludeArr = array("gateway_tbl_length","imaged","productID","changeorder","status","category_id","attribute_name","attribute_val","attribute_weight","attribute_price","product_image","userID","product_attribute_name","product_attribute_val","attr_name1","attr_val1","action");
			
			if ($this->input->post('status') != ''){
				$product_status = 'Publish';
			}else {
				$product_status = 'UnPublish';
			}
			
			$seourl = url_title($product_name, '-', TRUE);
			$checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl,'id !='=>$product_id));
			$seo_count = 1;
			while ($checkSeo->num_rows()>0){
				$seourl = $seourl.'-'.$seo_count;
				$seo_count++;
				$checkSeo = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl,'id !='=>$product_id));
			}
			if ($this->input->post('category_id') != ''){
				$category_id = implode(',', $this->input->post('category_id'));
			}else {
				$category_id = '';
			}
			$ImageName = '';
			$list_name_str = $list_val_str = '';
			$list_name_arr = $this->input->post('attribute_name');
			$list_val_arr = $this->input->post('attribute_val');
			if (is_array($list_name_arr) && count($list_name_arr)>0){
				$list_name_str = implode(',', $list_name_arr);
				$list_val_str = implode(',', $list_val_arr);
			}
			
			
//			$option['attribute_name'] = $this->input->post('attribute_name');
//			$option['attribute_val'] = $this->input->post('attribute_val');
//			$option['attribute_weight'] = $this->input->post('attribute_weight');
//			$option['attribute_price'] = $this->input->post('attribute_price');
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = time();
			if ($product_id == ''){
				$inputArr = array(
							'created' => mdate($datestring,$time),
							'seourl' => $seourl,
							'category_id' => $category_id,
							'status' => $product_status,
							'list_name' => $list_name_str,
							'list_value' => $list_val_str,
							'price_range'=> $price_range,
//							'option' => serialize($option),
							'user_id' => $this->input->post('userID'),
							'action' => "DOD",

							'seller_product_id'	=> mktime()
				);
			}else {
				$inputArr = array(
							'modified' => mdate($datestring,$time),
							'seourl' => $seourl,
							'category_id' => $category_id,
							'status' => $product_status,
							'price_range'=> $price_range,
							'list_name' => $list_name_str,
							'list_value' => $list_val_str,
							'action' => "DOD"

//							'option' => serialize($option)
				);
			}
			//$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;
	    	$config['allowed_types'] = 'jpg|jpeg|gif|png';
//		    $config['max_size'] = 2000;
	    	$config['upload_path'] = './images/product';
		    $this->load->library('upload', $config);
			//echo "<pre>";print_r($_FILES);die;
		    if ( $this->upload->do_multi_upload('product_image')){
		    	$logoDetails = $this->upload->get_multi_upload_data();
			    foreach ($logoDetails as $fileDetails){
			    	$this->ImageResizeWithCrop(650, 360, $fileDetails['file_name'], './images/product/');
					@copy('./images/product/'.$fileDetails['file_name'], './images/product/thumb/'.$fileDetails['file_name']);
			    	$this->ImageResizeWithCrop(280, 206, $fileDetails['file_name'], './images/product/thumb/');					
		    		$ImageName .= $fileDetails['file_name'].',';
		    	}
			}
			if ($product_id == ''){
				$product_data = array( 'image' => $ImageName);	
			}else {
				$existingImage = $this->input->post('imaged');
			 
				$newPOsitionArr = $this->input->post('changeorder');
				$imagePOsit = array();
				 
				for($p=0;$p<sizeof($existingImage);$p++) {
					$imagePOsit[$newPOsitionArr[$p]] = $existingImage[$p];
				}
		
				ksort($imagePOsit);
				foreach ($imagePOsit as $keysss => $vald) {
				 $imgArraypos[]=$vald;
				}
				$imagArraypo0 = @implode(",",$imgArraypos);
				$allImages = $imagArraypo0.','.$ImageName;
				
				$product_data = array( 'image' => $allImages);
			}
			if ($product_id != ''){
				$this->update_old_list_values($product_id,$list_val_arr,$old_product_details);
			}
			$dataArr = array_merge($inputArr,$product_data);
			
			echo '<pre>'; print_r($dataArr);
			if ($product_id == ''){
				$condition = array();
			echo $this->product_model->commonInsertUpdate(PRODUCT,'insert',$excludeArr,$dataArr,$condition);
				
				echo $product_id = $this->product_model->get_last_insert_id();  die;
				
				$Attr_name_str = $Attr_val_str = '';
				$Attr_name_arr = $this->input->post('product_attribute_name');
				$Attr_val_arr = $this->input->post('product_attribute_val');
				if (is_array($Attr_name_arr) && count($Attr_name_arr)>0){				
					for($k=0;$k<sizeof($Attr_name_arr);$k++){
						$dataSubArr = '';
						$attrseourl = url_title($Attr_val_arr[$k], '-', TRUE);
						$dataSubArr = array('product_id'=> $product_id,'attr_id'=>$Attr_name_arr[$k],'attr_name'=>$Attr_val_arr[$k],'attr_seourl'=>$attrseourl);
						//echo '<pre>'; print_r($dataSubArr); 
						$this->product_model->add_subproduct_insert($dataSubArr);
					}
				}
				
				$this->setErrorMessage('success','Product added successfully');
				$product_id = $this->product_model->get_last_insert_id();
				$this->update_price_range_in_table('add',$price_range,$product_id,$old_product_details);
			}else {
				$condition = array('id'=>$product_id);
				$this->product_model->commonInsertUpdate(PRODUCT,'update',$excludeArr,$dataArr,$condition);
				
				$Attr_name_str = $Attr_val_str = '';
				$Attr_name_arr = $this->input->post('product_attribute_name');
				$Attr_val_arr = $this->input->post('product_attribute_val');
				if (is_array($Attr_name_arr) && count($Attr_name_arr)>0){				
					for($k=0;$k<sizeof($Attr_name_arr);$k++){
						$dataSubArr = '';
						$attrseourl = url_title($Attr_val_arr[$k], '-', TRUE);
						$dataSubArr = array('product_id'=> $product_id,'attr_id'=>$Attr_name_arr[$k],'attr_name'=>$Attr_val_arr[$k],'attr_seourl'=>$attrseourl);
						//echo '<pre>'; print_r($dataSubArr); 
						$this->product_model->add_subproduct_insert($dataSubArr);
					}
				}
				
				$this->setErrorMessage('success','Product updated successfully');
				$this->update_price_range_in_table('edit',$price_range,$product_id,$old_product_details);
			}
			
			//Update the list table
			if (is_array($list_val_arr)){
				foreach ($list_val_arr as $list_val_row){
					$list_val_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$list_val_row));
					if ($list_val_details->num_rows()==1){
						$product_count = $list_val_details->row()->product_count;
						$products_in_this_list = $list_val_details->row()->products;
						$products_in_this_list_arr = explode(',', $products_in_this_list);
						if (!in_array($product_id, $products_in_this_list_arr)){
							array_push($products_in_this_list_arr, $product_id);
							$product_count++;
							$list_update_values = array(
								'products'=>implode(',', $products_in_this_list_arr),
								'product_count'=>$product_count
							);
							$list_update_condition = array('id'=>$list_val_row);
							$this->product_model->update_details(LIST_VALUES,$list_update_values,$list_update_condition);
						}
					}
				}
			}
			
			//Update user table count
			if ($this->checkLogin('U') != ''){
				$user_details = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
				if ($user_details->num_rows()==1){
					$prod_count = $user_details->row()->products;
					$prod_count++;
					$this->product_model->update_details(USERS,array('products'=>$prod_count),array('id'=>$this->checkLogin('U')));
				}
			}
			
			redirect('admin/deals/display_deal_lists');
		}
	}
	
	
	/**
	 * 
	 * Update the products_count and products in list_values table, when edit or delete products
	 * @param Integer $product_id
	 * @param Array $list_val_arr
	 * @param Array $old_product_details
	 */
	public function update_old_list_values($product_id,$list_val_arr,$old_product_details=''){
		if ($old_product_details == '' || count($old_product_details)==0){
			$old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
		}
		$old_product_list_values = array_filter(explode(',', $old_product_details->row()->list_value));
		if (count($old_product_list_values)>0){
			if (!is_array($list_val_arr)){
				$list_val_arr = array();
			}
			foreach ($old_product_list_values as $old_product_list_values_row){
				if (!in_array($old_product_list_values_row, $list_val_arr)){
					$list_val_details = $this->product_model->get_all_details(LIST_VALUES,array('id'=>$old_product_list_values_row));
					if ($list_val_details->num_rows()==1){
						$product_count = $list_val_details->row()->product_count;
						$products_in_this_list = $list_val_details->row()->products;
						$products_in_this_list_arr = array_filter(explode(',', $products_in_this_list));
						if (in_array($product_id, $products_in_this_list_arr)){
							if (($key = array_search($product_id, $products_in_this_list_arr))!==false){
								unset($products_in_this_list_arr[$key]);
							}
							$product_count--;
							$list_update_values = array(
								'products'=>implode(',', $products_in_this_list_arr),
								'product_count'=>$product_count
							);
							$list_update_condition = array('id'=>$old_product_list_values_row);
							$this->product_model->update_details(LIST_VALUES,$list_update_values,$list_update_condition);
						}
					}
				}
			}
		}
		
		if ($old_product_details != '' && count($old_product_details)>0 && $old_product_details->num_rows()==1){
		
		/*** Delete product id from lists which was created by users ***/
		
			$user_created_lists = $this->product_model->get_user_created_lists($old_product_details->row()->seller_product_id);
			if ($user_created_lists->num_rows()>0){
				foreach ($user_created_lists->result() as $user_created_lists_row){
					$list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
					if (($key=array_search($old_product_details->row()->seller_product_id,$list_product_ids )) !== false){
						unset($list_product_ids[$key]);
						$update_ids = array('product_id'=>implode(',', $list_product_ids));
						$this->product_model->update_details(LISTS_DETAILS,$update_ids,array('id'=>$user_created_lists_row->id));
					}
				}
			}
		
		/*** Delete product id from product likes table and decrease the user likes count ***/
		
			$like_list = $this->product_model->get_like_user_full_details($old_product_details->row()->seller_product_id);
			if ($like_list->num_rows()>0){
				foreach ($like_list->result() as $like_list_row){
					$likes_count = $like_list_row->likes;
					$likes_count--;
					if ($likes_count<0)$likes_count=0;
					$this->product_model->update_details(USERS,array('likes'=>$likes_count),array('id'=>$like_list_row->id));
				}
				$this->product_model->commonDelete(PRODUCT_LIKES,array('product_id'=>$old_product_details->row()->seller_product_id));
			}
			
		/*** Delete product id from activity, notification and product comment tables ***/
			
			$this->product_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$old_product_details->row()->seller_product_id));	
			$this->product_model->commonDelete(NOTIFICATIONS,array('activity_id'=>$old_product_details->row()->seller_product_id));
			$this->product_model->commonDelete(PRODUCT_COMMENTS,array('product_id'=>$old_product_details->row()->seller_product_id));	
		
		}
	}
	
	public function update_price_range_in_table($mode='',$price_range='',$product_id='0',$old_product_details=''){
		$list_values = $this->product_model->get_all_details(LIST_VALUES,array('list_value'=>$price_range));
		if ($list_values->num_rows() == 1){
			$products = explode(',', $list_values->row()->products);
			$product_count = $list_values->row()->product_count;
			if ($mode == 'add'){
				if (!in_array($product_id, $products)){
					array_push($products, $product_id);
					$product_count++;
				}
			}else if ($mode == 'edit'){
				$old_price_range = '';
				if ($old_product_details!='' && count($old_product_details)>0 && $old_product_details->num_rows()==1){
					$old_price_range = $old_product_details->row()->price_range;
				}
				if ($old_price_range != '' && $old_price_range != $price_range){
					$old_list_values = $this->product_model->get_all_details(LIST_VALUES,array('list_value'=>$old_price_range));
					if ($old_list_values->num_rows() == 1){
						$old_products = explode(',', $old_list_values->row()->products);
						$old_product_count = $old_list_values->row()->product_count;
						if (in_array($product_id, $old_products)){
							if (($key=array_search($product_id, $old_products)) !== false){
								unset($old_products[$key]);
								$old_product_count--;
								$updateArr = array('products'=>implode(',', $old_products),'product_count'=>$old_product_count);
								$updateCondition = array('list_value'=>$old_price_range);
								$this->product_model->update_details(LIST_VALUES,$updateArr,$updateCondition);
							}
						}
					}
					if (!in_array($product_id, $products)){
						array_push($products, $product_id);
						$product_count++;
					}
				}else if ($old_price_range != '' && $old_price_range == $price_range){
					if (!in_array($product_id, $products)){
						array_push($products, $product_id);
						$product_count++;
					}
				}
			}
			$updateArr = array('products'=>implode(',', $products),'product_count'=>$product_count);
			$updateCondition = array('list_value'=>$price_range);
			$this->product_model->update_details(LIST_VALUES,$updateArr,$updateCondition);
		}
	}
	
	/**
	 * 
	 * Ajax function for delete the product pictures
	 */
	public function editPictureProducts(){
		$ingIDD = $this->input->post('imgId');
		$currentPage = $this->input->post('cpage');
		$id = $this->input->post('val');
		$productImage = explode(',',$this->session->userdata('product_image_'.$ingIDD));
		if(count($productImage) < 2) {
			echo json_encode("No");exit();
		} else {
			$empImg = 0;
			foreach ($productImage as $product) {
				if ($product != ''){
					$empImg++;
				}
			}
			if ($empImg<2){
				echo json_encode("No");exit();
			}
			$this->session->unset_userdata('product_image_'.$ingIDD);
			$resultVar = $this->setPictureProducts($productImage,$this->input->post('position'));
			$insertArrayItems = trim(implode(',',$resultVar)); //need validation here...because the array key changed here
			
			$this->session->set_userdata(array('product_image_'.$ingIDD => $insertArrayItems));	
			$dataArr = array('image' => $insertArrayItems);
			$condition = array('id' => $ingIDD);
			$this->product_model->update_details(PRODUCT,$dataArr,$condition);
			echo json_encode($insertArrayItems);
		}
	}
	
	/**
	 * 
	 * This function loads the edit product form
	 */
	public function edit_product_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Product';
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $this->product_model->view_product($condition);
			if ($this->data['product_details']->num_rows() == 1){
				$this->data['categoryView'] = $this->product_model->get_category_details($this->data['product_details']->row()->category_id);
				$this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
				$this->data['SubPrdVal'] = $this->product_model->view_subproduct_details($product_id);
				$this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
				//echo '<pre>'; print_r($this->data['SubPrdVal']->result()); die;
				$this->load->view('admin/product/edit-product',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/* Ajax update for edit product */
	public function ajaxProductAttributeUpdate(){
	
		$conditons = array('pid'=>$this->input->post('attId'));	
		$attrseourl = url_title($this->input->post('attval'), '-', TRUE);
		$dataArr = array('attr_id'=>$this->input->post('attname'),'attr_name'=>$this->input->post('attval'),'attr_seourl'=>$attrseourl);
		$subproductDetails = $this->product_model->edit_subproduct_update($dataArr,$conditons);
	}
	
	/**
	 * 
	 * This function change the selling product status
	 */
	public function change_product_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'UnPublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $product_id);
			$this->product_model->update_details(PRODUCT,$newdata,$condition);
			$this->setErrorMessage('success','Product Status Changed Successfully');
			redirect('admin/product/display_product_list');
		}
	}
	
	
	public function change_deals_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'UnPublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('id' => $product_id);
			$this->product_model->update_details(PRODUCT,$newdata,$condition);
			$this->setErrorMessage('success','Deal Status Changed Successfully');
			redirect('admin/deals/display_deal_lists');
		}
	}
	
	
	/**
	 * 
	 * This function change the affiliate product status
	 */
	public function change_user_product_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'UnPublish':'Publish';
			$newdata = array('status' => $status);
			$condition = array('seller_product_id' => $product_id);
			$this->product_model->update_details(USER_PRODUCTS,$newdata,$condition);
			$this->setErrorMessage('success','Product Status Changed Successfully');
			redirect('admin/product/display_user_product_list');
		}
	}
	
	/**
	 * 
	 * This function loads the product view page
	 */
	public function view_product(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Product';
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $this->product_model->get_all_details(PRODUCT,$condition);
			$this->data['shiptoDetail'] = $this->product_model->get_all_details(SUB_SHIPPING,array('product_id' => $product_id))->result();
			
			if ($this->data['product_details']->num_rows() == 1){
				$this->data['catList'] = $this->product_model->get_cat_list($this->data['product_details']->row()->category_id);
				$this->load->view('admin/product/view_product',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	
	public function view_deals(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Deal';
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$this->data['product_details'] = $this->product_model->get_all_details(PRODUCT,$condition);
			$this->data['shiptoDetail'] = $this->product_model->get_all_details(SUB_SHIPPING,array('product_id' => $product_id))->result();
			
			if ($this->data['product_details']->num_rows() == 1){
				$this->data['catList'] = $this->product_model->get_cat_list($this->data['product_details']->row()->category_id);
				$this->load->view('admin/deals/view_deals',$this->data);
			}else {
				redirect('admin');
			}
		}
	}
	
	/**
	 * 
	 * This function delete the selling product record from db
	 */
	public function delete_deals(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
			$this->update_old_list_values($product_id,array(),$old_product_details);
			$this->update_user_product_count($old_product_details);
			$this->product_model->update_details(PRODUCT,array('status' => 'Deleted'),$condition);
			//$this->product_model->commonDelete(PRODUCT,$condition);
			//$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $product_id));
			$this->setErrorMessage('success','Deal deleted successfully');
			redirect('admin/deals/display_deal_lists');
		}
	}
	
	/**
	 * 
	 * This function delete the affiliate product record from db
	 */
	public function delete_user_product(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_id = $this->uri->segment(4,0);
			$condition = array('seller_product_id' => $product_id);
			$old_product_details = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$product_id));
			$this->update_user_created_lists($product_id);
			$this->update_user_likes($product_id);
			$this->update_user_product_count($old_product_details);
			$this->product_model->commonDelete(USER_PRODUCTS,$condition);
			$this->product_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$product_id));	
			$this->product_model->commonDelete(NOTIFICATIONS,array('activity_id'=>$product_id));
			$this->product_model->commonDelete(PRODUCT_COMMENTS,array('product_id'=>$product_id));
			$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $product_id));
			$this->setErrorMessage('success','Product deleted successfully');
			redirect('admin/product/display_user_product_list');
		}
	}
	
	public function update_user_likes($product_id='0'){
		$like_list = $this->product_model->get_like_user_full_details($product_id);
		if ($like_list->num_rows()>0){
			foreach ($like_list->result() as $like_list_row){
				$likes_count = $like_list_row->likes;
				$likes_count--;
				if ($likes_count<0)$likes_count=0;
				$this->product_model->update_details(USERS,array('likes'=>$likes_count),array('id'=>$like_list_row->id));
			}
			$this->product_model->commonDelete(PRODUCT_LIKES,array('product_id'=>$product_id));
		}
	}
	
	public function update_user_created_lists($pid='0'){
		$user_created_lists = $this->product_model->get_user_created_lists($pid);
		if ($user_created_lists->num_rows()>0){
			foreach ($user_created_lists->result() as $user_created_lists_row){
				$list_product_ids = array_filter(explode(',', $user_created_lists_row->product_id));
				if (($key=array_search($pid,$list_product_ids )) !== false){
					unset($list_product_ids[$key]);
					$update_ids = array('product_id'=>implode(',', $list_product_ids));
					$this->product_model->update_details(LISTS_DETAILS,$update_ids,array('id'=>$user_created_lists_row->id));
				}
			}
		}
	}
	
	public function update_user_product_count($old_product_details){
		if ($old_product_details!='' && count($old_product_details)>0 && $old_product_details->num_rows()==1){		
			if ($old_product_details->row()->user_id > 0){
				$user_details = $this->product_model->get_all_details(USERS,array('id'=>$old_product_details->row()->user_id));
				if ($user_details->num_rows()==1){
					$prod_count = $user_details->row()->products;
					$prod_count--;
					if ($prod_count<0){
						$prod_count = 0;
					}
					$this->product_model->update_details(USERS,array('products'=>$prod_count),array('id'=>$old_product_details->row()->user_id));
				}
			}
		}
	}
	
	/**
	 * 
	 * This function change the selling product status, delete the selling product record
	 */
	public function change_product_status_global(){
	
		if($_POST['checkboxID']!=''){
		
			if($_POST['checkboxID']=='0'){
				redirect('admin/product/add_product_form/0');
			}else{
				redirect('admin/product/add_product_form/'.$_POST['checkboxID']);			
			}
	
		}else{
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$data =  $_POST['checkbox_id'];
				if (strtolower($_POST['statusMode']) == 'delete'){
					for ($i=0;$i<count($data);$i++){  
						if($data[$i] == 'on'){
							unset($data[$i]);
						}
					}
					foreach ($data as $product_id){
						if ($product_id!=''){
							$old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
							$this->update_old_list_values($product_id,array(),$old_product_details);
							$this->update_user_product_count($old_product_details);
						}
					}
				}
				$this->product_model->activeInactiveCommon_product(PRODUCT,'id');
				if (strtolower($_POST['statusMode']) == 'delete'){
					$this->setErrorMessage('success','Product records deleted successfully');
				}else {
					$this->setErrorMessage('success','Product records status changed successfully');
				}
				redirect('admin/product/display_product_list');
			}
		}
	}
	
	/**
	 * 
	 * This function change the affiliate product status, delete the affiliate product record
	 */
	public function change_user_product_status_global(){
	
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$data =  $_POST['checkbox_id'];
			if (strtolower($_POST['statusMode']) == 'delete'){
				for ($i=0;$i<count($data);$i++){  
					if($data[$i] == 'on'){
						unset($data[$i]);
					}
				}
				foreach ($data as $product_id){
					if ($product_id!=''){
						$old_product_details = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$product_id));
						$this->update_user_created_lists($product_id);
						$this->update_user_likes($product_id);
						$this->update_user_product_count($old_product_details);
						$this->product_model->commonDelete(USER_ACTIVITY,array('activity_id'=>$product_id));	
						$this->product_model->commonDelete(NOTIFICATIONS,array('activity_id'=>$product_id));
						$this->product_model->commonDelete(PRODUCT_COMMENTS,array('product_id'=>$product_id));
						$this->product_model->commonDelete(SUBPRODUCT,array('product_id'=>$product_id));
					}
				}
			}
			$this->product_model->activeInactiveCommon(USER_PRODUCTS,'seller_product_id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Product records deleted successfully');
			}else {
				$this->setErrorMessage('success','Product records status changed successfully');
			}
			redirect('admin/product/display_user_product_list');
		}
	}
	
	public function loadListValues(){
		$returnStr['listCnt'] = '<option value="">--Select--</option>';
		$lid = $this->input->post('lid');
		$lvID = $this->input->post('lvID');
		if ($lid != ''){
			$listValues = $this->product_model->get_all_details(LIST_VALUES,array('list_id'=>$lid));
			if ($listValues->num_rows()>0){
				foreach ($listValues->result() as $listRow){
					$selStr = '';
					if ($listRow->id == $lvID){
						$selStr = 'selected="selected"';
					}
					$returnStr['listCnt'] .= '<option '.$selStr.' value="'.$listRow->id.'">'.$listRow->list_value.'</option>';
				}
			}
		}
		echo json_encode($returnStr);
	}
}

/* End of file product.php */
/* Location: ./application/controllers/admin/product.php */