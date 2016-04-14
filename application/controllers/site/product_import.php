<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(-1);
/**
 * 
 * User related functions
 * @author Casperon
 *
 */

class Product_import extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->library("session");
		$this->load->model(array("import_model",'seller_model','multilanguage_model'));
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['AdminloginCheck'] = $this->checkLogin('A');
    }   
	
	/**
	* 
	* Load the options to import items
	* 
	**/
	public function upload_form(){
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Import Items';
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,$condition);	
			//echo $this->db->last_query(); die;
    		$this->load->view('site/import/select_upload_csv',$this->data);
    	}
	}
	/**
	* 
	* Load the form to upload the products from etsy 
	* 
	**/
	public function upload_etsy_form(){
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Import Items From Etsy';
    		$this->load->view('site/import/etsy_upload_csv',$this->data);
    	}
	}
	/**
	* Adding Product using csv file
	* Upload Etsy csv file
	* Extract the values and import into the database table
	**/
	public function import_from_etsy(){
		if($this->checkLogin('U')==''){
			redirect('login');
		}else{
			//echo "Asdf";die;
			ini_set('memory_limit',-1);
			ini_set('max_execution_time',-1);

			$userID=$this->checkLogin('U');
			$file = $this->input->post('etsy_upload');
			$fileDirectory ='./images/csv';
			if(!is_dir($fileDirectory)){
				mkdir($fileDirectory,0777);
			}
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$config['upload_path'] = $fileDirectory;
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			$file_element_name = 'etsy_upload';
			if($this->upload->do_upload('etsy_upload')){
				if($this->checkLogin('U') != ''){
					$userID=$this->checkLogin('U');
				} else {
					$userID=1;
				}
				if($userID == 1 && $userID!=''){
					$status="Publish";
					$pay_status='Paid';
				}else if($userID == 1){
					$status="Publish";
					$pay_status='Paid';	
				} else {
					$status="UnPublish";
					$pay_status='Pending';
				}
				if($this->config->item('membership') =='Yes'){
					$check_membership = $this->import_model->check_seller_membership($userID);
					if($check_membership->num_rows()>0){
						if($check_membership->row()->membership_status==1){
							$status="Publish";
							$pay_status='Paid';	
							$pay_type='Free';
							$pay_date=date("Y-m-d H:i:s");
						}else{
							$pay_type='';
							$pay_date='';
						}
					}else{
						$pay_type='';
						$pay_date='';
					}
				}else{
					if($this->config->item('product_cost') <= 0.00){
						$status="Publish";
						$pay_status='Paid';
						$pay_type='Free';
						$pay_date=date("Y-m-d H:i:s");
					}else{
						$pay_type='';
						$pay_date='';
					}
				}
				$fileDetails = $this->upload->data();
				$file_name= $fileDetails['file_name'];
				$itemcount = 0;
				$handle = fopen($fileDirectory."/".$file_name,"r");
				if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE){
					$data_format = array('TITLE','DESCRIPTION','PRICE','CURRENCY_CODE','QUANTITY','TAGS','MATERIALS','IMAGE1','IMAGE2','IMAGE3','IMAGE4','IMAGE5','VARIATION 1 TYPE','VARIATION 1 NAME','VARIATION 1 VALUES','VARIATION 2 TYPE','VARIATION 2 NAME','VARIATION 2 VALUES');					
					if ($data_format == $data1){
						fclose($handle);
						$handle = fopen($fileDirectory."/".$file_name,"r");
						while(($fdata = fgetcsv($handle, 10000, ",")) !== FALSE){
							$itemcount++;	
							if($itemcount == 1){ 
								continue; 
							}							
							$name 			=  		trim($fdata[0]);
							$description 	=  		trim($fdata[1]);
							$price 			=  		trim($fdata[2]);
							$currency_code 	=  		trim($fdata[3]);
							$quantity		=  		trim($fdata[4]);
							$tags 			=  		trim($fdata[5]);
							$materials 		=  		trim($fdata[6]);
							$image1 		=  		trim($fdata[7]);
							$image2 		=  		trim($fdata[8]);
							$image3 		=  		trim($fdata[9]);
							$image4 		=  		trim($fdata[10]);
							$image5 		=  		trim($fdata[11]);
							$var_one_type 	=  		trim($fdata[12]);
							$var_one_name	=  		trim($fdata[13]);
							$var_one_values	=  		trim($fdata[14]);
							$var_two_type 	=  		trim($fdata[15]);
							$var_two_name	=  		trim($fdata[16]);
							$var_two_values	=  		trim($fdata[17]);
							/* $default_cur_get = $this->import_model->get_all_details(CURRENCY,array('default_currency'=>'Yes','status'=>'Active'));
							$price = $price / $default_cur_get->row()->currency_value;
							$price = number_format($price, 8, '.', ''); */
							$category='';
							$price_range = 0;
							if ($price>0 && $price<21)
								$price_range = '1-20';
							else if ($price>20 && $price<101)
								$price_range = '21-100';
							else if ($price>100 && $price<201)
								$price_range = '101-200';
							else if ($price>200 && $price<501)
								$price_range = '201-500';
							else if ($price>500)
								$price_range = '501+';
							
							$made_by=1;
							$product_condition=1;							
							$maked_on='made_to_order';
							$seller_product_id = time();
							$checkId = $this->import_model->check_product_id($seller_product_id);
							while ($checkId->num_rows()>0){
								$seller_product_id = time();
								$checkId = $this->import_model->check_product_id($seller_product_id);
							}
							//echo "Asdf";
							$finalImgArr=array();
							/****----------Move image to server-------------****/
							if($image1!=''){
								
								$image_url = $image1; 
								$img_data = @file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								$this->ImageCompress('images/product/mb/'.$image_name);
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');
								
								
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/thumb/'.$image_name);
								$this->ImageResizeWithCrop(350, '', $image_name, './images/product/mb/thumb/');
								//echo "in ";die;	
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/crop/'.$image_name);
								$this->ImageResizeWithCropping(350, 350, $image_name, './images/product/mb/crop/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropsmall/'.$image_name);
								$this->ImageResizeWithCropping(108, 92, $image_name, './images/product/cropsmall/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropmed/'.$image_name);
								$this->ImageResizeWithCropping(285, 215, $image_name, './images/product/cropmed/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropthumb/'.$image_name);
								$this->ImageResizeWithCropping(75, 75, $image_name, './images/product/cropthumb/');
								$finalImgArr[]=$image_name;
							}//echo "asdf";
							if($image2!=''){
								$image_url=$image2;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/thumb/'.$image_name);
								$this->ImageResizeWithCrop(350, '', $image_name, './images/product/mb/thumb/');
								//echo "in ";die;	
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/crop/'.$image_name);
								$this->ImageResizeWithCropping(350, 350, $image_name, './images/product/mb/crop/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropsmall/'.$image_name);
								$this->ImageResizeWithCropping(108, 92, $image_name, './images/product/cropsmall/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropmed/'.$image_name);
								$this->ImageResizeWithCropping(285, 215, $image_name, './images/product/cropmed/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropthumb/'.$image_name);
								$this->ImageResizeWithCropping(75, 75, $image_name, './images/product/cropthumb/');
								
								$finalImgArr[]=$image_name;
							}
							if($image3!=''){
								$image_url=$image3;
								$img_data = @file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/thumb/'.$image_name);
								$this->ImageResizeWithCrop(350, '', $image_name, './images/product/mb/thumb/');
								//echo "in ";die;	
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/crop/'.$image_name);
								$this->ImageResizeWithCropping(350, 350, $image_name, './images/product/mb/crop/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropsmall/'.$image_name);
								$this->ImageResizeWithCropping(108, 92, $image_name, './images/product/cropsmall/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropmed/'.$image_name);
								$this->ImageResizeWithCropping(285, 215, $image_name, './images/product/cropmed/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropthumb/'.$image_name);
								$this->ImageResizeWithCropping(75, 75, $image_name, './images/product/cropthumb/');
								
								$finalImgArr[]=$image_name;
							}
							if($image4!=''){
								$image_url=$image4;
								$img_data = @file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/thumb/'.$image_name);
								$this->ImageResizeWithCrop(350, '', $image_name, './images/product/mb/thumb/');
								//echo "in ";die;	
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/crop/'.$image_name);
								$this->ImageResizeWithCropping(350, 350, $image_name, './images/product/mb/crop/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropsmall/'.$image_name);
								$this->ImageResizeWithCropping(108, 92, $image_name, './images/product/cropsmall/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropmed/'.$image_name);
								$this->ImageResizeWithCropping(285, 215, $image_name, './images/product/cropmed/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropthumb/'.$image_name);
								$this->ImageResizeWithCropping(75, 75, $image_name, './images/product/cropthumb/');
								
								$finalImgArr[]=$image_name;
							}
							if($image5!=''){
								$image_url=$image5;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/thumb/'.$image_name);
								$this->ImageResizeWithCrop(350, '', $image_name, './images/product/mb/thumb/');
								//echo "in ";die;	
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/crop/'.$image_name);
								$this->ImageResizeWithCropping(350, 350, $image_name, './images/product/mb/crop/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropsmall/'.$image_name);
								$this->ImageResizeWithCropping(108, 92, $image_name, './images/product/cropsmall/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropmed/'.$image_name);
								$this->ImageResizeWithCropping(285, 215, $image_name, './images/product/cropmed/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/cropthumb/'.$image_name);
								$this->ImageResizeWithCropping(75, 75, $image_name, './images/product/cropthumb/');
								
								$finalImgArr[]=$image_name;
							}
							$finalimage_name = @implode(',', $finalImgArr);
							//echo $finalimage_name;die;
							$catArr = $this->import_model->get_category_details(array('cat_name'=>$category));
							if ($catArr->num_rows()>0){
								$category_id_arr = array($catArr->row()->id);
								while ($catArr->row()->rootID>0){
									$catArr = $this->import_model->get_category_details(array('id'=>$catArr->row()->rootID));
									if ($catArr->num_rows()>0){
										$category_id_arr[] = $catArr->row()->id;
									}else {
										break;
									}
								}
								$category_id = implode(',',array_reverse($category_id_arr));
							}else {
								$category_id = '252';
							}
							
							
							$seourlBase = $seourl = url_title($name, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_product_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_product_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
														
							$modifyDate=date('Y-m-d H:i:s');
							$createdDate=date('Y-m-d H:i:s');
							
							$ship_duration='1 business day';
						 	$country='United States';
							$insertdata = array(
								'seller_product_id' => $seller_product_id,
								'made_by' => $made_by,
								'product_condition' => $product_condition,
								'created' => $createdDate,
								'modified' => $modifyDate,
								'maked_on' => $maked_on,
								'product_name' => $name,
								'description' => $description,
								'price' => $price,
								'base_price' => $price,
								'quantity' => $quantity,
								'image' => $finalimage_name,
								'category_id' => $category_id,
								'tag' => $tags,
								'materials' => $materials,
								'status' => $status, 
								'pay_status' => $pay_status, 
								'pay_type' => $pay_type, 
								'pay_date' => $pay_date, 
								'seourl' => $seourl,
								'ship_duration' => $ship_duration,
								'ship_from' => $country,
								'user_id' => $userID
							);							
							//print_r($insertdata);
							//$this->import_model->simple_insert(PRODUCT,$insertdata);
							$this->import_model->simple_insert(PRODUCT_EN,$insertdata); 
							$pid = $this->import_model->get_last_insert_id();
							$insertdata['id'] = $pid;
							
							$languages = $this->multilanguage_model->get_language_list()->result_array();
							
							foreach($languages as $lang){
								//echo "<br>#######<br>";
								$ln = $lang['lang_code'];
								 
								$table = PRODUCT_EN;
								$ln_table = $table."_".$ln;
							
								$this->import_model->simple_insert($ln_table,$insertdata);
								//echo $this->db->last_query()."<br>";
							}
							//echo "dfsdfs";
							$idArr = $this->import_model->get_last_insert_id();
							
							/********----------- SHIPPING COUNTRIES -----------********/
							$cost_individual = 0.00;	
							$cost_with_another = 0.00;
							$shipName=$country;
$shipName='Hong Kong';
							//echo $shipName;die;
							$countryInfo = $this->import_model->get_country_info(array('name'=>$country));
							//print_r($countryInfo);die;
							if($countryInfo->num_rows()>0){
								$shipId=$countryInfo->row()->id;
							}else{
								$shipId=215; 
								$countryInfo = $this->import_model->get_country_info(array('id'=>$shipId));
								$shipName=$countryInfo->row()->name;
$shipName='Hong Kong';
							}
							
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							//echo  $urlCount;
							//echo $seourl_check;
							//echo $seourl;die;
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
							//echo $seourl;
						 	$dataArrShip=array('product_id' => $idArr,
									'ship_id' => $shipId,
									'ship_name' => $shipName,
									'ship_cost' => $cost_individual,
									'ship_seourl' => $seourl,
									'ship_other_cost' => $cost_with_another
							);
							//print_r($dataArrShip);die;
						 	$this->import_model->simple_insert(SUB_SHIPPING,$dataArrShip);	
								//echo "asd";die;
							/********----------- SHIPPING COUNTRIES -----------********/
							
							
							/********----------- PRODUCT VARIATIONS -----------********/
							# Variation One Starts Here
							if($var_one_name!=''){
								$variation_name=$var_one_name;
								$variation_value=$var_one_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
																'status' => 'Active',
																'attr_seourl'=>$seourl,
																'scaling_option' => 'No'
																);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
												'attr_value' => trim($attr_value),
												'pricing' => $prcg,
												'stock_status' => 1,
												'product_id' => $idArr,
												'attr_scale' => $scale
												);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							
							# Variation Two Starts Here
							if($var_two_name!=''){
								$variation_name=$var_two_name;
								$variation_value=$var_two_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
										'status' => 'Active',
										'attr_seourl'=>$seourl,
										'scaling_option' => 'No'
										);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
											'attr_value' => trim($attr_value),
											'pricing' => $prcg,
											'stock_status' => 1,
											'product_id' => $idArr,
											'attr_scale' => $scale
											);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							/********----------- PRODUCT VARIATIONS -----------********/
						}
						if(is_resource($handle)){
							fclose($handle);
						}
					}
				}
				if(is_resource($handle)){
					fclose($handle);
				}//die;
				echo "asdf";
				$this->data['heading'] = 'Import Items From Etsy';
				$this->load->view('site/import/back_to_listings',$this->data);
			}
		}
	}
	/**
	* Adding Product using csv file
	* Extract the values and import into the database table
	**/
	public function import_from_etsy_curl($file_name,$userID){
			ini_set('memory_limit',-1);
			ini_set('max_execution_time',-1);

			$fileDirectory = base_url().'images/csv';
			if(!is_dir($fileDirectory)){
				mkdir($fileDirectory,0777);
			}
			if (file_exists($fileDirectory."/".$file_name)) {
				if($userID == 1 && $userID!=''){
					$status="Publish";
					$pay_status='Paid';
				}else if($userID == 1){
					$status="Publish";
					$pay_status='Paid';	
				} else {
					$status="UnPublish";
					$pay_status='Pending';
				}
				
				if($this->config->item('membership') =='Yes'){
					$check_membership = $this->import_model->check_seller_membership($userID);
					if($check_membership->num_rows()>0){
						if($check_membership->row()->membership_status==1){
							$status="Publish";
							$pay_status='Paid';	
							$pay_type='Free';
							$pay_date=date("Y-m-d H:i:s");
						}else{
							$pay_type='';
							$pay_date='';
						}
					}else{
						$pay_type='';
						$pay_date='';
					}
				}else{
					if($this->config->item('product_cost') <= 0.00){
						$status="Publish";
						$pay_status='Paid';
						$pay_type='Free';
						$pay_date=date("Y-m-d H:i:s");
					}else{
						$pay_type='';
						$pay_date='';
					}
				}
				
				
				$count = 0; $row = 0;
				$handle = fopen($fileDirectory."/".$file_name,"r");
				if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE){
					$data_format = array('TITLE','DESCRIPTION','PRICE','CURRENCY_CODE','QUANTITY','TAGS','MATERIALS','IMAGE1','IMAGE2','IMAGE3','IMAGE4','IMAGE5','VARIATION 1 TYPE','VARIATION 1 NAME','VARIATION 1 VALUES','VARIATION 2 TYPE','VARIATION 2 NAME','VARIATION 2 VALUES');
					if ($data_format==$data1){
						fclose($handle);
						$handle = fopen($fileDirectory."/".$file_name,"r");
						while(($fdata = fgetcsv($handle, 10000, ",")) !== FALSE){
							$row++; 
							if($row == 1){ 
								continue; 
							}
							/* if($row > ($startingRow+$countList)){ 
								exit; 
							} */
							$name 					=  		trim($fdata[0]);
							$description 			=  		trim($fdata[1]);
							$price 					=  		trim($fdata[2]);
							$currency_code 			=  		trim($fdata[3]);
							$quantity				=  		trim($fdata[4]);
							$tags 					=  		trim($fdata[5]);
							$materials 				=  		trim($fdata[6]);
							$image1 				=  		trim($fdata[7]);
							$image2 					=  		trim($fdata[8]);
							$image3 					=  		trim($fdata[9]);
							$image4 					=  		trim($fdata[10]);
							$image5 		  			=  		trim($fdata[11]);
							$var_one_type 		=  		trim($fdata[12]);
							$var_one_name		=  		trim($fdata[13]);
							$var_one_values	=  		trim($fdata[14]);
							$var_two_type 		=  		trim($fdata[15]);
							$var_two_name		=  		trim($fdata[16]);
							$var_two_values	=  		trim($fdata[17]);
							
							$category='';

							$price_range = 0;
							if ($price>0 && $price<21)
								$price_range = '1-20';
							else if ($price>20 && $price<101)
								$price_range = '21-100';
							else if ($price>100 && $price<201)
								$price_range = '101-200';
							else if ($price>200 && $price<501)
								$price_range = '201-500';
							else if ($price>500)
								$price_range = '501+';
							
							
							$made_by=1;
							$product_condition=1;							
							$maked_on='made_to_order';
							$seller_product_id = time();
							$checkId = $this->import_model->check_product_id($seller_product_id);
							while ($checkId->num_rows()>0){
								$seller_product_id = time();
								$checkId = $this->import_model->check_product_id($seller_product_id);
							}

							$finalImgArr=array();
						
							/****----------Move image to server-------------****/
							if($image1!=''){
								$image_url=$image1; 
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');
								
								$finalImgArr[]=$image_name;
							}
							if($image2!=''){
								$image_url=$image2;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image3!=''){
								$image_url=$image3;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image4!=''){
								$image_url=$image4;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image5!=''){
								$image_url=$image5;
								$img_data = file_get_contents($image_url);
								if(empty($img_data)){
									$image_name = "noimage.jpg";
								}else{
									$ext='jpg';
									$new_name=md5(time().rand(10,99999999).time()).".".$ext;
									$new_img = 'images/product/temp_img/'.$new_name;
									file_put_contents($new_img, $img_data);
									$this->ImageCompress($new_img);
									$image_name = $new_name;
								}
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if(!empty($finalImgArr)){
								$finalimage_name = @implode(',', $finalImgArr);
							}else{
								$finalimage_name = 'noimage.jpg';
							}
			
							$catArr = $this->import_model->get_category_details(array('cat_name'=>$category));
							if ($catArr->num_rows()>0){
								$category_id_arr = array($catArr->row()->id);
								while ($catArr->row()->rootID>0){
									$catArr = $this->import_model->get_category_details(array('id'=>$catArr->row()->rootID));
									if ($catArr->num_rows()>0){
										$category_id_arr[] = $catArr->row()->id;
									}else {
										break;
									}
								}
								$category_id = implode(',',array_reverse($category_id_arr));
							}else {
								$category_id = '252';
							}
							
							
							$seourlBase = $seourl = url_title($name, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_product_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_product_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
														
							$modifyDate=date('Y-m-d H:i:s');
							$createdDate=date('Y-m-d H:i:s');
							
							$ship_duration='1 business day';
						 	$country='United States';
							$insertdata = array(
										'seller_product_id' => $seller_product_id,
										'made_by' => $made_by,
										'product_condition' => $product_condition,
										'created' => $createdDate,
										'modified' => $modifyDate,
										'maked_on' => $maked_on,
										'product_name' => $name,
										'description' => $description,
										'price' => $price,
										'base_price' => $price,
										'quantity' => $quantity,
										'image' => $finalimage_name,
										'category_id' => $category_id,
										'tag' => $tags,
										'materials' => $materials,
										'status' => $status, 
										'pay_status' => $pay_status, 
										'pay_type' => $pay_type, 
										'pay_date' => $pay_date, 
										'seourl' => $seourl,
										'ship_duration' => $ship_duration,
										'ship_from' => $country,
										'user_id' => $userID
										);							
							
							//$this->import_model->simple_insert(PRODUCT,$insertdata);
							$this->import_model->simple_insert(PRODUCT_EN,$insertdata); 
							$languages = $this->multilanguage_model->get_language_list()->result_array();
							
							foreach($languages as $lang){
								//echo "<br>#######<br>";
								$ln = $lang['lang_code'];
								 
								$table = PRODUCT_EN;
								$ln_table = $table."_".$ln;
							
								$this->import_model->simple_insert($ln_table,$insertdata);
								//echo $this->db->last_query()."<br>";
							}
							
							$idArr = $this->import_model->get_last_insert_id();
							
							/********----------- SHIPPING COUNTRIES -----------********/
							$cost_individual = 0.00;	
							$cost_with_another = 0.00;
							$shipName=$country;
$shipName='Hong Kong';
							$countryInfo = $this->import_model->get_country_info(array('name'=>$country));
							if($countryInfo->num_rows()>0){
								$shipId=$countryInfo->row()->id;
							}else{
								$shipId=86; 
								$countryInfo = $this->import_model->get_country_info(array('id'=>$shipId));
								$shipName=$countryInfo->row()->name;
							}
							
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
					
						 	$dataArrShip=array('product_id' => $idArr,
									'ship_id' => $shipId,
									'ship_name' => $shipName,
									'ship_cost' => $cost_individual,
									'ship_seourl' => $seourl,
									'ship_other_cost' => $cost_with_another
							);
						 	$this->import_model->simple_insert(SUB_SHIPPING,$dataArrShip);							
							/********----------- SHIPPING COUNTRIES -----------********/
							
							
							/********----------- PRODUCT VARIATIONS -----------********/
							# Variation One Starts Here
							if($var_one_name!=''){
								$variation_name=$var_one_name;
								$variation_value=$var_one_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
																'status' => 'Active',
																'attr_seourl'=>$seourl,
																'scaling_option' => 'No'
																);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
																			'attr_value' => trim($attr_value),
																			'pricing' => $prcg,
																			'stock_status' => 1,
																			'product_id' => $idArr,
																			'attr_scale' => $scale
																			);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							
							# Variation Two Starts Here
							if($var_two_name!=''){
								$variation_name=$var_two_name;
								$variation_value=$var_two_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
																'status' => 'Active',
																'attr_seourl'=>$seourl,
																'scaling_option' => 'No'
																);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
																			'attr_value' => trim($attr_value),
																			'pricing' => $prcg,
																			'stock_status' => 1,
																			'product_id' => $idArr,
																			'attr_scale' => $scale
																			);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							/********----------- PRODUCT VARIATIONS -----------********/
							
						}
						
						fclose($handle);
					}
				}
				fclose($handle);
			}
	}
	
	
	public function import_from_etsy_old(){
		if($this->checkLogin('U')==''){
			redirect('login');
		}else{
			ini_set('memory_limit',-1);
			ini_set('max_execution_time',-1);

			$userID=$this->checkLogin('U');
			$file = $this->input->post('etsy_upload');
			$fileDirectory ='./images/csv';
			if(!is_dir($fileDirectory)){
				mkdir($fileDirectory,0777);
			}
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$config['upload_path'] = $fileDirectory;
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			$file_element_name = 'etsy_upload';
			if( $this->upload->do_upload('etsy_upload')){
			
				/******--------- Identify the User and  product status condition------------******/
				if($this->checkLogin('A') == 1 && $this->checkLogin('U')!=''){
					$status="Publish";
					$pay_status='Paid';
				}else if($this->checkLogin('U') == 1){
					$status="Publish";
					$pay_status='Paid';	
				} else {
					$status="UnPublish";
					$pay_status='Pending';
				} 
				if($this->checkLogin('U') != ''){
					$userID=$this->checkLogin('U');
				} else {
					$userID=1;
				}
				
				if($this->config->item('membership') =='Yes'){
					$check_membership = $this->import_model->check_seller_membership($userID);
					if($check_membership->num_rows()>0){
						if($check_membership->row()->membership_status==1){
							$status="Publish";
							$pay_status='Paid';	
							$pay_type='Free';
							$pay_date=date("Y-m-d H:i:s");
						}else{
							$pay_type='';
							$pay_date='';
						}
					}else{
						$pay_type='';
						$pay_date='';
					}
				}else{
					if($this->config->item('product_cost') <= 0.00){
						$status="Publish";
						$pay_status='Paid';
						$pay_type='Free';
						$pay_date=date("Y-m-d H:i:s");
					}else{
						$pay_type='';
						$pay_date='';
					}
				}
				
				$fileDetails = $this->upload->data();
				$coun = 0; $row = 1;
				$handle = fopen($fileDirectory."/".$fileDetails['file_name'],"r");
				if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE){
					$data_format = array('TITLE','DESCRIPTION','PRICE','CURRENCY_CODE','QUANTITY','TAGS','MATERIALS','IMAGE1','IMAGE2','IMAGE3','IMAGE4','IMAGE5','VARIATION 1 TYPE','VARIATION 1 NAME','VARIATION 1 VALUES','VARIATION 2 TYPE','VARIATION 2 NAME','VARIATION 2 VALUES');
					
					if ($data_format==$data1){
						fclose($handle);
						$handle = fopen($fileDirectory."/".$fileDetails['file_name'],"r");
						while(($fdata = fgetcsv($handle, 10000, ",")) !== FALSE){
							if($row == 1){ $row++; continue; }
							
							$name 					=  		trim($fdata[0]);
							$description 			=  		trim($fdata[1]);
							$price 						=  		trim($fdata[2]);
							$currency_code 		=  		trim($fdata[3]);
							$quantity					=  		trim($fdata[4]);
							$tags 						=  		trim($fdata[5]);
							$materials 				=  		trim($fdata[6]);
							$image1 					=  		trim($fdata[7]);
							$image2 					=  		trim($fdata[8]);
							$image3 					=  		trim($fdata[9]);
							$image4 					=  		trim($fdata[10]);
							$image5 		  			=  		trim($fdata[11]);
							$var_one_type 		=  		trim($fdata[12]);
							$var_one_name		=  		trim($fdata[13]);
							$var_one_values	=  		trim($fdata[14]);
							$var_two_type 		=  		trim($fdata[15]);
							$var_two_name		=  		trim($fdata[16]);
							$var_two_values	=  		trim($fdata[17]);
							
							$category='';

							$price_range = 0;
							if ($price>0 && $price<21)
								$price_range = '1-20';
							else if ($price>20 && $price<101)
								$price_range = '21-100';
							else if ($price>100 && $price<201)
								$price_range = '101-200';
							else if ($price>200 && $price<501)
								$price_range = '201-500';
							else if ($price>500)
								$price_range = '501+';
							
							
							$made_by=1;
							$product_condition=1;							
							$maked_on='made_to_order';


							$seller_product_id = time();
							$checkId = $this->import_model->check_product_id($seller_product_id);
							while ($checkId->num_rows()>0){
								$seller_product_id = time();
								$checkId = $this->import_model->check_product_id($seller_product_id);
							}

							
							$finalImgArr=array();
							/****----------Move image to server-------------****/
							if($image1!=''){
								$image_url=$image1;
								$img_data = file_get_contents($image_url);
								$ext='jpg';
								$new_name=md5(time().rand(10,99999999).time()).".".$ext;
								$new_img = 'images/product/temp_img/'.$new_name;
								file_put_contents($new_img, $img_data);
								$this->ImageCompress($new_img);
								$image_name = $new_name;
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image2!=''){
								$image_url=$image2;
								$img_data = file_get_contents($image_url);
								$ext='jpg';
								$new_name=md5(time().rand(10,99999999).time()).".".$ext;
								$new_img = 'images/product/temp_img/'.$new_name;
								file_put_contents($new_img, $img_data);
								$this->ImageCompress($new_img);
								$image_name = $new_name;
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image3!=''){
								$image_url=$image3;
								$img_data = file_get_contents($image_url);
								$ext='jpg';
								$new_name=md5(time().rand(10,99999999).time()).".".$ext;
								$new_img = 'images/product/temp_img/'.$new_name;
								file_put_contents($new_img, $img_data);
								$this->ImageCompress($new_img);
								$image_name = $new_name;
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image4!=''){
								$image_url=$image4;
								$img_data = file_get_contents($image_url);
								$ext='jpg';
								$new_name=md5(time().rand(10,99999999).time()).".".$ext;
								$new_img = 'images/product/temp_img/'.$new_name;
								file_put_contents($new_img, $img_data);
								$this->ImageCompress($new_img);
								$image_name = $new_name;
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							if($image5!=''){
								$image_url=$image5;
								$img_data = file_get_contents($image_url);
								$ext='jpg';
								$new_name=md5(time().rand(10,99999999).time()).".".$ext;
								$new_img = 'images/product/temp_img/'.$new_name;
								file_put_contents($new_img, $img_data);
								$this->ImageCompress($new_img);
								$image_name = $new_name;
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/mb/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');								
								$finalImgArr[]=$image_name;
							}
							
							$finalimage_name = implode(',', $finalImgArr);

							$catArr = $this->import_model->get_category_details(array('cat_name'=>$category));
							if ($catArr->num_rows()>0){
								$category_id_arr = array($catArr->row()->id);
								while ($catArr->row()->rootID>0){
									$catArr = $this->import_model->get_category_details(array('id'=>$catArr->row()->rootID));
									if ($catArr->num_rows()>0){
										$category_id_arr[] = $catArr->row()->id;
									}else {
										break;
									}
								}
								$category_id = implode(',',array_reverse($category_id_arr));
							}else {
								$category_id = '252';
							}
							
							
							$seourlBase = $seourl = url_title($name, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_product_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_product_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
							
							$modifyDate='';
							$ship_duration='1 business day';
						 	$country='United States';
							$insertdata = array(
										'seller_product_id' => $seller_product_id,
										'made_by' => $made_by,
										'product_condition' => $product_condition,
										'modified' => $modifyDate,
										'maked_on' => $maked_on,
										'product_name' => $name,
										'description' => $description,
										'price' => $price,
										'base_price' => $price,
										'quantity' => $quantity,
										'image' => $finalimage_name,
										'category_id' => $category_id,
										'tag' => $tags,
										'materials' => $materials,
										'status' => $status, 
										'pay_status' => $pay_status, 
										'seourl' => $seourl,
										'ship_duration' => $ship_duration,
										'ship_from' => $country,
										'user_id' => $userID
										);
							$this->import_model->simple_insert(PRODUCT,$insertdata);
							$idArr = $this->import_model->get_last_insert_id();
							
							/********----------- SHIPPING COUNTRIES -----------********/
							$cost_individual = 0.00;	
							$cost_with_another = 0.00;
							$shipName=$country;
$shipName='Hong Kong';
							$countryInfo = $this->import_model->get_country_info(array('name'=>$country));
							if($countryInfo->num_rows()>0){
								$shipId=$countryInfo->row()->id;
							}else{
								$shipId=86; 
								$countryInfo = $this->import_model->get_country_info(array('id'=>$shipId));
								$shipName=$countryInfo->row()->name;
							}
							
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->import_model->chk_shipping_seo($seourl);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
					
						 	$dataArrShip=array('product_id' => $idArr,
									'ship_id' => $shipId,
									'ship_name' => $shipName,
									'ship_cost' => $cost_individual,
									'ship_seourl' => $seourl,
									'ship_other_cost' => $cost_with_another
							);
						 	$this->import_model->simple_insert(SUB_SHIPPING,$dataArrShip);							
							/********----------- SHIPPING COUNTRIES -----------********/
							
							
							/********----------- PRODUCT VARIATIONS -----------********/					
							# Variation One Starts Here
							if($var_one_name!=''){
								$variation_name=$var_one_name;
								$variation_value=$var_one_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
																'status' => 'Active',
																'attr_seourl'=>$seourl,
																'scaling_option' => 'No'
																);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
																			'attr_value' => trim($attr_value),
																			'pricing' => $prcg,
																			'stock_status' => 1,
																			'product_id' => $idArr,
																			'attr_scale' => $scale
																			);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							
							# Variation Two Starts Here
							if($var_two_name!=''){
								$variation_name=$var_two_name;
								$variation_value=$var_two_values;
								$prcg=NULL;
								$scale='';
																
								$condition = array('attr_name' => $variation_name);
								$chkAttr = $this->import_model->chk_product_attribute($condition); 
								if ($chkAttr->num_rows()==0){
									$seourl = url_title($variation_name,'',TRUE);
									while ($seourl_check == '0'){
										$urlCount++;
										$duplicate_url = $this->import_model->chk_product_attribute(array('attr_seourl'=>$seourl));
										if ($duplicate_url->num_rows()>0){
											$seourl = $seourlBase.'-'.$urlCount;
										}else {
											$seourl_check = '1';
										}
									}
									$varArr = array( 'attr_name' => $variation_name,
																'status' => 'Active',
																'attr_seourl'=>$seourl,
																'scaling_option' => 'No'
																);
									$this->import_model->simple_insert(PRODUCT_ATTRIBUTE,$varArr);	
								}
								
								if($variation_value!=''){
									$variation_one_Arr=@explode(',',$variation_value);
									foreach($variation_one_Arr as $attr_value){
										if($attr_value!=''){
											$attr_array = array('attr_name' => trim($variation_name),
																			'attr_value' => trim($attr_value),
																			'pricing' => $prcg,
																			'stock_status' => 1,
																			'product_id' => $idArr,
																			'attr_scale' => $scale
																			);
											$this->import_model->simple_insert(SUBPRODUCT,$attr_array);
										}
									}
								}
							}
							/********----------- PRODUCT VARIATIONS -----------********/
							
							$row++;
						}
						fclose($handle);
						$this->setErrorMessage('success','Your Etsy Listings are imported successfully.');
						redirect(base_url().'shop/managelistings');
					}else {
						fclose($handle);
						$this->setErrorMessage('error','The coloumns in this csv file does not match with Etsy Listings.');
						redirect(base_url().'etsy-import');
					}
				}
				fclose($handle);
				$this->setErrorMessage('error','The coloumns in this csv file does not match with Etsy Listings.');
				redirect(base_url().'etsy-import');
			}else {
				$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
				redirect(base_url().'etsy-import');
			}
		}
			
	}
	
	
}
/*End of file product_import.php */
/* Location: ./application/controllers/site/product_import.php */
