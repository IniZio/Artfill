<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Product management 
 * @author Teamtweaks
 *
 */ 

class Product extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('product_model');
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
			redirect('admin/product/display_product_list');
		}
	}	
	/**
	 * 
	 * This function loads the selling product list page
	 */
	public function display_product_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			//die;
			$this->data['heading'] = 'Product List';
			$this->data['feature_Pack_list']=$this->product_model->get_all_details(FEATURE_PACK,array('status'=>'Active'))->result();
			
			//$this->data['productCount'] =  $productCount = $this->product_model->view_product_details_count(' where (u.group="Seller" and u.status="Active") and p.status != "Deleted"  order by p.created desc')->row()->totalItem;
			
			$this->data['productCount'] =  $productCount = $this->product_model->view_product_details_count_admin(' where (u.group="Seller" and u.status="Active") and p.status != "Deleted"  order by p.created desc')->row()->totalItem;
			
//debug
//echo "artfill debug";
//echo $productCount;

			//echo '<pre>'; print_r($productCount);die;
			
			$prod_details=$this->product_model->get_product_count_details();	
			//echo $this->db->last_query(); die;
			$tot_prod='';
			$pub_prod='';
			$unpub_prod='';
			$del_prod='';
			foreach($prod_details->result() as $row){			
				if($row->status=='Publish'){
					$pub_prod=$row->prod_count;
				}
				if($row->status=='UnPublish'){
					$unpub_prod=$row->prod_count;
				}
				if($row->status=='Deleted'){
					$del_prod=$row->prod_count;
				}
				$total_prod+=$row->prod_count;
			}
			$fProd=$this->product_model->get_featured_product();
			$this->data['fcount']=$fProd->row()->featured_count;
			$psold=$this->product_model->get_product_soldDetails();
			$this->data['prod_sold']=$psold->row()->pcount;
			
			$pamt=$this->product_model->get_purchased_amount();
			$this->data['prod_pur']=$pamt->row()->amtpurchased;
			$pro_prod=$this->product_model->get_promoted_details();
			$this->data['promo_prod']=$pro_prod->row()->promo_products;
			
			$this->data['total_prod']=$total_prod;
			$this->data['publish_prod']=$pub_prod;
			$this->data['unpublish']=$unpub_prod;
			$this->data['deleted']=$del_prod;
			
			$this->data['seller_detail'] = $this->product_model->get_all_details(USERS,array('group'=> "Seller"));
			/* if(isset($_GET['status'])){ 
				$status=$_GET['status'];
				$cond=' AND p.status='.$status.'';
			} */
			
//	echo '<pre>'; print_r($productCount);die;
			if($productCount > 1000){			
				$searchPerPage = 50;
// 			if($productCount > 10){
// 				$searchPerPage = 5;
				$paginationNo = $this->uri->segment(4);  
				if($paginationNo == ''){
					$paginationNo = 0;
				} else {
					$paginationNo = $paginationNo;
				}	
				if($this->input->get('fvalue')!=''){
					$fvalue = $this->input->get('fvalue');
					if($fvalue =='name'){
						$cond="  p.product_name LIKE '%".$this->input->get('svalue')."%'";
					}elseif($fvalue =='price'){
						$price = array_filter(explode('-', $this->input->get('pvalue')));
						if($price[1]!=''){
							$cond="  p.base_price BETWEEN '".$price[0]."' and '".$price[1]."'";
						}else{
							$cond="  p.base_price >='".$price[0]."'";
						}						
					}elseif($fvalue =='created'){
						$cond="  p.created >='".$this->input->get('fromDate')."' and p.created <='".$this->input->get('toDate')."'";
					}elseif($fvalue =='qty'){
						$qty = array_filter(explode('-', $this->input->get('qvalue')));
						if($qty[1]!=''){
							$cond="  p.quantity BETWEEN '".$qty[0]."' and '".$qty[1]."'";
						}else{
							$cond="  p.quantity >='".$qty[0]."'";
						}
					}else{
						$cond="  p.status='".$this->input->get('stvalue')."'";
					}
					$this->data['productList'] = $this->product_model->view_product_details('  where  ( u.status="Active" and s.status="active") and '.$cond.' group by p.id order by p.created desc LIMIT '.$paginationNo.', '.$searchPerPage.'','opt');
					/* echo $this->db->last_query();
					echo $this->data['productList']->num_rows();
					die;   */
				}elseif(isset($_GET['status'])){ 
					$status=$_GET['status'];
					$cond="  p.status='".$status."'";
					$this->data['productList'] = $this->product_model->view_product_details('  where  '.$cond.' group by p.id order by p.created desc LIMIT '.$paginationNo.', '.$searchPerPage.'','opt');	
				}elseif(isset($_GET['featured'])){
				
				//echo "asdf";die;
					//$cond="  p.product_featured='".$_GET['featured']."'";
					$cond="  p.feature_expire >= '".date('Y-m-d')."'";
					$this->data['productList'] = $this->product_model->view_product_details_feature('  where  ( u.status="Active") and '.$cond.' group by p.id order by p.created desc LIMIT '.$paginationNo.', '.$searchPerPage.'','opt');	
					//echo $this->db->last_query();die;
				}elseif(isset($_GET['promo'])){
					$cond="  p.product_promoted='".$_GET['promo']."'";
					$this->data['productList'] = $this->product_model->view_product_details('  where (u.group="Seller" and u.status="Active" and s.status="active") and '.$cond.' group by p.id order by p.created desc LIMIT '.$paginationNo.', '.$searchPerPage.'','opt');
				} else {
					$this->data['productList'] = $this->product_model->view_product_details('  where (u.group="Seller" and u.status="Active" and s.status="active") and  p.status != "Deleted" '.$cond.' group by p.id order by p.created desc LIMIT '.$paginationNo.', '.$searchPerPage.'','opt');	
				}
				//echo $this->db->last_query();die;
				//echo("<pre>"); print_r($this->data['productList']->result());die;
				$searchbaseUrl = 'admin/product/display_product_list/';
				$config['num_links'] = 3;
				$config['display_pages'] = TRUE; 
				$config['base_url'] = $searchbaseUrl;
				$config['total_rows'] = $productCount;
				$config["per_page"] = $searchPerPage;
				$config["uri_segment"] = 4;
				$config['first_link'] = '';
				$config['last_link'] = '';
				$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="current"><a href="javascript:void(0);" style="cursor:default;">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['first_link'] = 'First';
				$config['last_link'] = 'Last';
				
				if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
				
				$this->pagination->initialize($config); 
				 $paginationLink = $this->pagination->create_links(); 
				$this->data['paginationLink'] = $paginationLink;
				
				//echo $this->db->last_query(); die;
				$this->load->view('admin/product/display_product_list_pagination',$this->data);
			} else {	
				if(isset($_GET['status'])){ 
					$status=$_GET['status'];
					$cond="  p.status='".$status."'";
					$this->data['productList'] = $this->product_model->view_product_details('  where  '.$cond.' group by p.id order by p.created desc ','opt');	
				}	
				elseif(isset($_GET['featured'])){
					//$cond="  p.product_featured='".$_GET['featured']."'";
					$cond="  p.feature_expire >= '".date('Y-m-d')."' and p.status='Publish'";
					$this->data['productList'] = $this->product_model->view_product_details_feature('  where '.$cond.' group by p.id order by p.created desc ','opt');	
				//echo $this->db->last_query();die;
				}
				elseif(isset($_GET['promo'])){
					$cond="  p.product_promoted='".$_GET['promo']."'";
					$this->data['productList'] = $this->product_model->view_product_details('  where '.$cond.' group by p.id order by p.created desc ','opt');
				}
				else {
					$this->data['productList'] = $this->product_model->view_product_details('  where (u.group="Seller" and u.status="Active") and  p.status != "Deleted" group by p.id order by p.created desc ','opt');	
				}
				//echo $this->db->last_query(); die;
				$this->load->view('admin/product/display_product_list',$this->data);
			}
		}
	}
	public function recent_product_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
				
			$this->data['heading'] = 'Product List';
				
			$this->data['productCount'] =  $productCount = $this->product_model->view_product_details_count_admin('where (u.group="Seller" and u.status="Active") and p.status != "Deleted" and p.created >= DATE_SUB(NOW(),INTERVAL 07 DAY) order by p.created desc')->row()->totalItem;

//debug
//echo "debug artfill";
//echo $productCount;

			
			$this->data['productList'] = $this->product_model->view_product_details(' where p.status="Publish" and p.created >= DATE_SUB(NOW(),INTERVAL 07 DAY)  group by p.id order by p.created desc ','opt');
			
			$this->data['seller_detail'] = $this->product_model->get_all_details(USERS,array('group'=> "Seller"));
			
			//echo $this->db->last_query();
			
			//print_r($this->data['productList']); die;

/*			
			$prod_details=$this->product_model->get_product_count_details();
			//echo $this->db->last_query(); die;
			$tot_prod='';
			$pub_prod='';
			$unpub_prod='';
			$del_prod='';
			
			foreach($prod_details->result() as $row){
				if($row->status=='Publish'){
					$pub_prod=$row->prod_count;
				}
				if($row->status=='UnPublish'){
					$unpub_prod=$row->prod_count;
				}
				if($row->status=='Deleted'){
					$del_prod=$row->prod_count;
				}
				$total_prod+=$row->prod_count;
			}
			
			$fProd=$this->product_model->get_featured_product();
			$this->data['fcount']=$fProd->row()->featured_count;
			
			$psold=$this->product_model->get_product_soldDetails();
			$this->data['prod_sold']=$psold->row()->pcount;
				
			$pamt=$this->product_model->get_purchased_amount();
			$this->data['prod_pur']=$pamt->row()->amtpurchased;
			
			$pro_prod=$this->product_model->get_promoted_details();
			$this->data['promo_prod']=$pro_prod->row()->promo_products;
				
			$this->data['total_prod']=$total_prod;
			$this->data['publish_prod']=$pub_prod;
			$this->data['unpublish']=$unpub_prod;
			$this->data['deleted']=$del_prod;
				
			
				
				if(isset($_GET['status'])){
					$status=$_GET['status'];
					$cond="  p.status='".$status."'";
					$this->data['productList'] = $this->product_model->view_product_details('  where '.$cond.' group by p.id order by p.created desc ','opt');
				}else {
					$this->data['productList'] = $this->product_model->view_product_details('  where (u.group="Seller" and u.status="Active") and  p.status != "Deleted" '.$cond.' group by p.id order by p.created desc ','opt');
				}
				//echo $this->db->last_query(); die;
*/				
				
				$this->load->view('admin/product/display_recentproduct_list.php',$this->data);
			
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
	public function display_FeaturePackage_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Feature Package List';
			$this->data['feature_pack'] = $this->product_model->get_all_details(FEATURE_PACK,array());
			#echo "<pre>";print_r($this->data['feature_pack']->result());
			$this->load->view('admin/product/display_FeaturePackage_list',$this->data);
		}
	}
	public function edit_pack()
	{
		//echo "asdfasd";die;
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			//echo "asdfa";
			$this->data['heading'] = 'Edit Package';
			$id = $this->uri->segment(4,0);
			//echo $id;
			$this->data['pack_det'] = $this->product_model->get_all_details(FEATURE_PACK,array('id'=>$id));
			//echo $this->bd->last_query();
			//echo "<pre>";print_r($this->data['pack_det']);die;
			$this->load->view('admin/product/edit_package',$this->data);
		}
	}
	/********************************Starting of feature package management*******************************************/
	public function EditPack()
	{
		#echo "<pre>";;print_r($this->);die;
		if ($this->input->post('status') != ''){
				$pack_status = 'Active';
			}else {
				$pack_status = 'Inactive';
			}
		$dataArr=array(
				'name'=>$this->input->post('pack_name'),
				'days'=>$this->input->post('pack_day'),
				'amount'=>$this->input->post('pack_amount'),
				'status'=>$pack_status
				);
		$sql=$this->product_model->update_details(FEATURE_PACK,$dataArr,array('id'=>$this->input->post('pack_id')));
		$this->setErrorMessage('success','Package Status updated Successfully');
		redirect('admin/product/display_FeaturePackage_list');
	}
	public function view_pack()
	{
		$this->data['heading'] = 'View Package';
		$id=$this->uri->segment(4,0);
		$this->data['pack_det']=$this->product_model->get_all_details(FEATURE_PACK,array('id'=>$id));
		$this->load->view('admin/product/view_Package',$this->data);
	}
	public function delete_pack()
	{
		$id=$this->uri->segment(4,0);
		$this->product_model->commonDelete(FEATURE_PACK,array('id'=>$id));
		$this->setErrorMessage('success','Package Deleted Successfully');
		redirect('admin/product/display_FeaturePackage_list');
	}
	public function change_pack_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$pack_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $pack_id);
			$this->product_model->update_details(FEATURE_PACK,$newdata,$condition);
			$this->setErrorMessage('success','Package Status Changed Successfully');
			redirect('admin/product/display_FeaturePackage_list');
		}
	}
	public function change_feature_status_global()
	{
		if($_POST['checkboxID']!=''){
		
			if($_POST['checkboxID']=='0'){
				redirect('admin/product/add_feature_package/0');
			}else{
				redirect('admin/product/add_feature_package/'.$_POST['checkboxID']);			
			}
	
		}else{
			if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
				$data =  $_POST['checkbox_id'];
				if (strtolower($_POST['statusMode']) == 'delete'){
					//echo" <pre>";print_r($data[1]);
					for ($i=0;$i<count($data);$i++){  
						if($data[$i] == 'on'){
							unset($data[$i]);
						}
					}
					foreach ($data as $pack_id){
						echo $pack_id;
						if ($pack_id != ''){
							$this->product_model->commonDelete(FEATURE_PACK,array('id'=>$pack_id));						
							
						}
						echo $this->db->last_query();
					}
				}
				
				$this->product_model->activeInactiveCommon(FEATURE_PACK,'id');
				if (strtolower($_POST['statusMode']) == 'delete'){
					$this->setErrorMessage('success','Packages deleted successfully');
				}else {
					$this->setErrorMessage('success','Packages status changed successfully');
				}
				redirect('admin/product/display_FeaturePackage_list');
			}
		}
	}
	public function add_feature_package(){
		$this->data['heading'] = 'Add New Package';
		$this->load->view('admin/product/add_feature_package',$this->data);
	}
	public function insertPack(){
		#echo "<pre>";print_r($this->input->post());die;
		if ($this->input->post('status') != ''){
				$pack_status = 'Active';
			}else {
				$pack_status = 'Inactive';
			}
		$dataArr=array(
				'name'=>$this->input->post('pack_name'),
				'days'=>$this->input->post('Pack_days'),
				'amount'=>$this->input->post('Pack_amount'),
				'status'=>$pack_status
				);
		$sql=$this->product_model->simple_insert(FEATURE_PACK,$dataArr);
		redirect('admin/product/display_FeaturePackage_list');
		
	}
	/********************************End of feature product management******************************************/
	/**
	 * 
	 * This function loads the deleted product list form
	 */
	public function product_recycle_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Deleted Product List';
			$this->data['productList'] = $this->product_model->view_product_details('  where p.status="Deleted" group by p.id order by p.created desc');
			//echo $this->db->last_query();die;
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
	public function add_product_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Product';
			$this->data['Product_id'] = $this->uri->segment(4,0);
			$this->data['categoryView'] = $this->product_model->view_category_details();
			$this->data['atrributeValue'] = $this->product_model->view_atrribute_details();
			$this->data['PrdattrVal'] = $this->product_model->view_product_atrribute_details();
			$this->data['CntyVal'] = $CntyVal = $this->product_model->view_product_shipping_details();			
			$this->load->view('admin/product/add_product',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert and edit product
	 */
	public function insertEditProduct(){
//		echo "<pre>";print_r($_POST);die;
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
			$excludeArr = array("gateway_tbl_length","imaged","productID","changeorder","status","category_id","attribute_name","attribute_val","attribute_weight","attribute_price","product_image","userID","product_attribute_name","product_attribute_val","attr_name1","attr_val1");
			
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
							'list_value' => $list_val_str
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
			if ($product_id == ''){
				$condition = array();
				$this->product_model->commonInsertUpdate(PRODUCT,'insert',$excludeArr,$dataArr,$condition);
				
				$product_id = $this->product_model->get_last_insert_id();
				
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
			
			redirect('admin/product/display_product_list');
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
	/**
	 * 
	 * This function update the product  price range in db
	 * Param String Mode 
	 * Param Int Price range of product
	 * Param Int ProductId
	 * Param array product details
	 */
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
			//$this->product_model->update_details(PRODUCT,$newdata,$condition);
			$this->product_model->update_details(PRODUCT_EN,$newdata,$condition);
			$this->setErrorMessage('success','Product Status Changed Successfully');
			redirect('admin/product/display_product_list');
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
	
	/**
	 * 
	 * This function delete the selling product record from db
	 */
	public function delete_product(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			//$old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
			$old_product_details = $this->product_model->get_all_details(PRODUCT_EN,array('id'=>$product_id));
			$this->update_old_list_values($product_id,array(),$old_product_details);
			$this->update_user_product_count($old_product_details);
			$this->product_model->update_details(PRODUCT,array('status' => 'Deleted'),$condition);
			//$this->product_model->commonDelete(PRODUCT,$condition);
			//$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $product_id));
			$this->setErrorMessage('success','Product deleted successfully');
			redirect('admin/product/display_product_list');
		}
	}
	public function delete_product_permanently(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$product_id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			
			$this->product_model->commonDelete(PRODUCT,$condition);
			$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $product_id));
			$this->setErrorMessage('success','Product deleted successfully');
			redirect('admin/product/display_product_list');
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
	/**
	 * 
	 * This function update user likes of a product
	* Param Int ProductId
	 */
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
	/**
	 * 
	 * This function update user own list for product
	 *	Param Int ProductId
	 */
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
	/**
	 * 
	 * This function update the product count in db
	 * Param Array product details
	 */
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
				if (strtolower($_POST['statusMode']) == 'deletep'){
					for ($i=0;$i<count($data);$i++){  
						if($data[$i] == 'on'){
							unset($data[$i]);
						}
					}
					foreach ($data as $product_id){
						if ($product_id!=''){
							/* $old_product_details = $this->product_model->get_all_details(PRODUCT,array('id'=>$product_id));
							$this->update_old_list_values($product_id,array(),$old_product_details);
							$this->update_user_product_count($old_product_details); */
							$this->product_model->commonDelete(PRODUCT,array('id'=>$product_id));
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
	/**
	 * 
	 * This function loads the list record from db
	 */
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
	
	public function change_seller()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$var [status_code] = 0;
			$user_id = $this->input->post ( 'user_id' );
			$product_id = $this->input->post ( 'product_id' );
			$product_name = $this->input->post ( 'product_name' );
			$condition=array('id' => $product_id);
			$excludeArr=array("product_id","product_name","user_id");
			$dataArr=array('user_id' => $user_id );
				
	
			if ($dataArr != '') {
					
				$this->product_model->update_details( PRODUCT, $dataArr, $condition );
				$var [status_code] = 1;
			}
			echo json_encode ( $var );
		}
	}
	function get_feature_contents(){
		$this->data['feature_Pack_list']=$this->product_model->get_all_details(FEATURE_PACK,array('status'=>'Active'))->result();
		$this->data['p_seourl']=$p_seourl=$this->product_model->get_all_details(PRODUCT,array('id'=>$this->input->post('pid')))->row()->seourl;
		$this->data['pid']=$this->input->post('pid');		
		$this->data['product_feature']=$this->product_model->get_all_details(FEATURE_PRODUCT,array('product_seo'=>$p_seourl))->result_array();
		
		return $this->load->view('admin/product/feature_colorbox',$this->data);
	}
	function unfeaturePro_page(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->product_model->commonDelete(FEATURE_PRODUCT,array('product_seo'=>$this->input->post('seourl'),'page'=>$this->input->post('page')));
			echo $this->db->last_query();
			$this->product_model->update_details(PRODUCT,array('product_featured' => 'No'),array('seourl' => $this->input->post('seourl')));
			echo $this->db->last_query();
			echo 1;
		}
	}
	function change_featuredproduct_ajax(){
		$f_product=$this->product_model->get_all_details(PRODUCT,array('id'=>$this->input->get('featured_product_id')));			
		if($this->input->get('un_feature') == '0'){
			$status='Yes';
			$packagedet=$this->product_model->get_all_details(FEATURE_PACK,array('id'=>$this->input->get('pack_id')));			
			$expire= date('Y-m-d', strtotime($this->input->get('eventDate').' +'.$packagedet->row()->days.'day'));			
			$no_slots=0;
			if($this->input->get('Page') == 'home'){
				$slot_dates=$this->product_model->get_feature_poducts(date("Y-m-d", strtotime($this->input->post('eventDate'))),$expire);
				$no_slots= $slot_dates->num_rows();
			}
			//echo "<pre>";print_r($slot_dates->result());die;
				
			if($no_slots < 3 ){
				$dataArr=array(
							'pack_id'=>$this->input->get('pack_id'),
							'user_id'=>1,
							'amount'=>$packagedet->row()->amount,
							'expire_date'=>$expire,
							'product_seo'=>$f_product->row()->seourl,
							'start_date'=>date("Y-m-d", strtotime($this->input->get('eventDate'))),
							'page'=>$this->input->get('Page')
						);
				$this->product_model->simple_insert(FEATURE_PRODUCT,$dataArr);
				$this->product_model->update_details(PRODUCT,array('product_featured' => $status,'feature_expire'=>$expire),array('id' => $this->input->get('featured_product_id')));
				$this->setErrorMessage('success','Product successfully featured');			
				redirect('admin/product/display_product_list');
			}else{
				$this->setErrorMessage('error','Slot not Available');			
				redirect('admin/product/display_product_list');			
			}			
		
		}else {
			$status='No';
			$this->product_model->commonDelete(FEATURE_PRODUCT,array('product_seo'=>$f_product->row()->seourl));
			$this->product_model->update_details(PRODUCT,array('product_featured' => $status),array('id' => $this->input->get('featured_product_id')));
			$this->setErrorMessage('success','Product successfully unfeatured');			
			redirect('admin/product/display_product_list');
		}
		

	}
	
	function change_promoteproduct_ajax(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
	
			$mode = $this->uri->segment(4,0);
			$product_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Unpromote':'Promote';
			$newdata = array('product_promoted' => $status);
			$condition = array('id' => $product_id);
			$this->product_model->update_details(PRODUCT,$newdata,$condition);
			$this->setErrorMessage('success','Product Promote Status Changed Successfully');
			redirect('admin/product/display_product_list');
				
	
		}
	}
}

/* End of file product.php */
/* Location: ./application/controllers/admin/product.php */