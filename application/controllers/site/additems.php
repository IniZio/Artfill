<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Additems extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('mobile_model');
		
		/* $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(stripos($ua,'shopsymobileapp') === false) {
			show_404();
		} */ 
		
    }
    
  
	/** 
	 * 
	 * Loading Index Page for mobile app
	 */
	
	public function index(){
		echo 'Seller App';
	} 
	
	/** 
	 * 
	 * Adding items to the shop
	 */	
	public function add_item(){
		if(!empty($_FILES) || $_POST['existphoto1']!= ''){
			$imgsav="apptest/";
			$imgsavr="./apptest/";
			$imgArr=array();
			$productId=$_POST['productId'];
			if($_FILES['photo1']['size']>0 || $_POST['existphoto1']!= ''){
				if($_POST['existphoto1']!= ''){
					$imgArr[]=$_POST['existphoto1'];	
				}else if($_FILES['photo1']['size']>0){
					$data = file_get_contents($_FILES['photo1']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			if($_FILES['photo2']['size']>0 || $_POST['existphoto2']!= ''){
				if($_POST['existphoto2']!= ''){
					$imgArr[]=$_POST['existphoto2'];	
				}else if($_FILES['photo2']['size']>0){
					$data = file_get_contents($_FILES['photo2']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			if($_FILES['photo3']['size']>0 || $_POST['existphoto3']!= ''){
				if($_POST['existphoto3']!= ''){
					$imgArr[]=$_POST['existphoto3'];	
				}else if($_FILES['photo3']['size']>0){
					$data = file_get_contents($_FILES['photo3']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			if($_FILES['photo4']['size']>0 || $_POST['existphoto4']!= ''){
				if($_POST['existphoto4']!= ''){
					$imgArr[]=$_POST['existphoto4'];	
				}else if($_FILES['photo4']['size']>0){
					$data = file_get_contents($_FILES['photo4']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			if($_FILES['photo5']['size']>0 || $_POST['existphoto5']!= ''){
				if($_POST['existphoto5']!= ''){
					$imgArr[]=$_POST['existphoto5'];	
				}else if($_FILES['photo5']['size']>0){
					$data = file_get_contents($_FILES['photo5']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			if(count($imgArr)>0){
			
				###########################################
				#				Getting values from the app					#
				###########################################
				$product_name=$_POST['I_Tittle'];
				$description=$_POST['I_Desc'];
				$price=$_POST['I_Price'];
				$quantity=$_POST['I_Quantity'];
				$tags=$_POST['I_AddTag'];
				$materials=$_POST['I_AddMat'];
				
				$userID=intval($_POST['seller_id']);
				
				$abt_cat=$_POST['Add_Cat'];
				
				$shippingVal=$_POST['S_Profile'];
				$shippingArray=json_decode($shippingVal);
				###########################################
				#		User id, product status, and pay status			#
				###########################################
				if($userID == 1){
					$status="Publish";
					$pay_status='Paid';	
					$userID=1;
				} else {
					$status="UnPublish";
					$pay_status='Pending';
					$userID=$userID;
				} 
				
				###########################################
				#		Checking the fees for the product listing		#
				###########################################
				if($this->config->item('product_cost') <= '0.00'){
					$status="Publish";
					$pay_status='Paid';
					$pay_type='Free';
					$pay_date=date('Y-m-d');
				}else{
					$pay_type='';
					$pay_date='';
				}
				###########################################
				#				About and Category Section					#
				###########################################
				$abt_cat = json_decode($abt_cat);
				
				$about_1 =$abt_cat[0]->about_1;
				$about_2= $abt_cat[0]->about_2;
				$about_3 =$abt_cat[0]->about_3;

				switch ($about_1) {
					case "2131099714":
						$made_by=1;
						break;
					case "2131099717":
						$made_by=2;
						break;
					case "2131099720":
						$made_by=3;
						break;
					default:
						$made_by=1;
				}
				switch ($about_1) {
					case "2131099724":
						$product_condition=1;
						break;
					case "2131099727":
						$product_condition=2;
						break;
					default:
						$product_condition=1;
				}
				switch ($about_3) {
					case "2131099731":
						$maked_on="made_to_order";
						break;
					default:
						$maked_on="made_to_order";
				}
				
				$cat1= $abt_cat[0]->cat_1;
				$cat2= $abt_cat[0]->cat_2;
				$cat3= $abt_cat[0]->cat_3;
				$finalCatValue="";
				if($cat1!=''){
					$finalCatValue.=$cat1.',';
				}
				if($cat2!=''){
					$finalCatValue.=$cat2.',';
				}
				if($cat3!=''){
					$finalCatValue.=$cat3.',';
				}
				$category_id=rtrim($finalCatValue,',');


				
				###########################################
				#						Product SEO Generation					#
				###########################################
				$seourlBase = $seourl = url_title($product_name, '-', TRUE);
				$seourl_check = '0';
				$prdCol="`id`";
				$duplicate_url = $this->mobile_model->get_column_details(PRODUCT,array('seourl'=>$seourl),$prdCol);
				if ($duplicate_url->num_rows()>0){
					$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
				}else {
					$seourl_check = '1';
				}
				$urlCount = $duplicate_url->num_rows();
				while ($seourl_check == '0'){
					$urlCount++;
					$duplicate_url = $this->mobile_model->get_column_details(PRODUCT,array('seourl'=>$seourl),$prdCol);
					if ($duplicate_url->num_rows()>0){
						$seourl = $seourlBase.'-'.$urlCount;
					}else {
						$seourl_check = '1';
					}
				}
				$productsEo=$seourl;
				###########################################
				#								Image Uploading						#
				###########################################
				
				$imagesVal=array();
				foreach($imgArr as $img){
					$filename = './images/product/'.$img;	
					if(file_exists($filename)){
						$imagesVal[]=$img;
					}else{
						$timeImg=time();
						@copy($imgsavr.$img, './images/product/org-image/'.$timeImg.'-'.$img);
						@copy($imgsavr.$img, './images/product/mb/'.$timeImg.'-'.$img);
						$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$img,'',100);
						@copy($imgsavr.$img, './images/product/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(550, 350, $timeImg.'-'.$img, './images/product/');
						@copy('./images/product/'.$timeImg.'-'.$img, './images/product/thumb/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(175, 150, $timeImg.'-'.$img, './images/product/thumb/');
						@copy($imgsavr.$img, './images/product/list-image/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(75, 75, $timeImg.'-'.$img, './images/product/list-image/');
						$imagesVal[]=$timeImg.'-'.$img;
					}
				}
				$finalImageVal=@implode(',',$imagesVal);
				
				###########################################
				#	Shipping values for product table	  					#
				###########################################
				
				$ship_from =$shippingArray->ship_from;
				$ship_duration= $shippingArray->readytoShip;
								
				##########################################
				#	Making Data Array & Insert into database	  #
				##########################################
				$modifyDate=date('Y-m-d H:i:s');	
				$giftcard='false';
				$dataArr = array(
							'made_by' => $made_by,
							'product_condition' => $product_condition,
							'maked_on' => $maked_on,
							'modified' => $modifyDate,
							'product_name' => $product_name,
							'description' => $description,
							'price' => $price,
							'base_price' => $price,
							'quantity' => $quantity,
							'image' => $finalImageVal,
							'category_id' => $category_id,
							'tag' => $tags,
							'materials' => $materials,
							'status' => $status, 
							'pay_status' => $pay_status, 
							'seourl' => $seourl,
							'gift_card' => $giftcard,
							'user_id' => $userID,
							'seller_product_id' => time(),
							'ship_duration' => $ship_duration,
							'ship_from' => $ship_from,
							'pay_type' => $pay_type,
							'pay_date' => $pay_date
							);
				
				if($productId != ''){
					unset($dataArr['seourl']);
					unset($dataArr['user_id']);	
					unset($dataArr['status']);	
					unset($dataArr['pay_status']);	
					unset($dataArr['pay_type']);	
					unset($dataArr['pay_date']);	
					$this->product_model->edit_product($dataArr,array('id' => $productId));
					$product_id = $productId;
				}else{
					$this->product_model->add_product($dataArr);
					$product_id = $this->db->insert_id();
				}
				
				
				############################################
				#	Making Shipping Array & Insert into database	  #
				############################################
				
				$shopDest=$shippingArray->shipping;
				if(!empty($shopDest)){
					if($productId != ''){
						$this->product_model->commonDelete(SUB_SHIPPING,array('product_id' => $productId));
					}
					foreach($shopDest as $destination){
							$shipID =$destination->countryId;
							$shipName =$destination->country;
							$cost_individual= $destination->cost;
							$cost_with_another= $destination->withother;
							
							$countryCol="`id`";
							$countryDetails = $this->mobile_model->get_column_details(COUNTRY_LIST,array('id'=>$shipID),$countryCol);
							if($countryDetails->num_rows()>0){
								$shipId=$countryDetails->row()->id; 
								$seourlBase = $seourl = url_title($shipName, '-', TRUE);
								$seourl_check = '0';
								$shippingCol="`sid`";
								$duplicate_url = $this->mobile_model->get_column_details(SUB_SHIPPING,array('ship_seourl'=>$seourl),$shippingCol);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
								}else {
									$seourl_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($seourl_check == '0'){
									$urlCount++;
									$duplicate_url = $this->mobile_model->get_column_details(SUB_SHIPPING,array('ship_seourl'=>$seourl),$shippingCol);
									if ($duplicate_url->num_rows()>0){
										$seourl = $seourlBase.'-'.$urlCount;
									}else {
										$seourl_check = '1';
									}
								}					
								 $dataArrShip=array('product_id' => $product_id,
																	'ship_id' => $shipId,
																	'ship_name' => $shipName,
																	'ship_cost' => $cost_individual,
																	'ship_seourl' => $seourl,
																	'ship_other_cost' => $cost_with_another
																	);
								$this->mobile_model->simple_insert(SUB_SHIPPING,$dataArrShip);
							}
					}		
					$json_encode =  json_encode(array("status"=>"1","message"=>"Item Listed Successfully"));
				}else{
					$json_encode =  json_encode(array("status"=>"0","message"=>"Shipping Values are Missing"));
				}
			}else{
				$json_encode =  json_encode(array("status"=>"0","message"=>"Minimum one photo is required"));
			}
		}else{
			$json_encode =  json_encode(array("status"=>"0","message"=>"Minimum one photo is required"));
		}
		echo $json_encode;
	}
	
	/** 
	 * 
	 * Details for Edit Listings
	 */	
	public function editListings() {
		$sellerId=intval($_GET['sellerId']);	
		
		$sellerCol="`id`,`seller_id`";
		$sellerCheck = $this->mobile_model->get_column_details(SELLER,array('seller_id'=>$sellerId),$sellerCol);
		$prdDetails=array();
		if($sellerCheck->num_rows()>0){
			$productId=$_GET['productId'];	
			##Get product Info 
			$prdArr= $this->mobile_model->get_all_details(PRODUCT,array('user_id'=>$sellerId));
			if($prdArr->num_rows()>0){
				$json_encode = json_encode(array("status"=>(string)1,"prdDetails"=>$prdDetails));	
			}else{
				$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
			}
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"prdDetails"=>$prdDetails));	
		}
		echo $json_encode;
	}
	
	
	public function upload_product_image() {
	
	if(!empty($_FILES) || $_POST['existphoto1']!= ''){
			$imgsav="images/product/temp/";
			$imgsavr="./images/product/temp/";
			$imgArr=array();
			$productId=$_POST['productId'];
			if($_FILES['photo1']['size']>0 || $_POST['existphoto1']!= ''){
				if($_POST['existphoto1']!= ''){
					$imgArr[]=$_POST['existphoto1'];	
				}else if($_FILES['photo1']['size']>0){
					$data = file_get_contents($_FILES['photo1']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			if($_FILES['photo2']['size']>0 || $_POST['existphoto2']!= ''){
				if($_POST['existphoto2']!= ''){
					$imgArr[]=$_POST['existphoto2'];	
				}else if($_FILES['photo2']['size']>0){
					$data = file_get_contents($_FILES['photo2']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			if($_FILES['photo3']['size']>0 || $_POST['existphoto3']!= ''){
				if($_POST['existphoto3']!= ''){
					$imgArr[]=$_POST['existphoto3'];	
				}else if($_FILES['photo3']['size']>0){
					$data = file_get_contents($_FILES['photo3']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			if($_FILES['photo4']['size']>0 || $_POST['existphoto4']!= ''){
				if($_POST['existphoto4']!= ''){
					$imgArr[]=$_POST['existphoto4'];	
				}else if($_FILES['photo4']['size']>0){
					$data = file_get_contents($_FILES['photo4']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			if($_FILES['photo5']['size']>0 || $_POST['existphoto5']!= ''){
				if($_POST['existphoto5']!= ''){
					$imgArr[]=$_POST['existphoto5'];	
				}else if($_FILES['photo5']['size']>0){
					$data = file_get_contents($_FILES['photo5']['tmp_name']);
					$image = imagecreatefromstring( $data );
					$imgname=md5(time().rand(10,99999999).time()).".jpg";
					$savePath=$imgsav.$imgname;
					imagejpeg($image, $savePath, 99);
					$imgArr[]=$imgname;
				}
			}
			
			$imagelink = array();
			if(count($imgArr)> 0){
			    foreach($imgArr as $img){
					$imagelink [] =  array('image'=>base_url().'images/product/temp/'.$img);
				}
				$finalimage_name = implode(',', $imgArr);
				$json_encode =  json_encode(array("status"=>"1","message"=>"Upload Successfully","image"=>$finalimage_name,'imagelink'=>$imagelink));
			}else{
				$json_encode =  json_encode(array("status"=>"0","message"=>"Minimum one photo is required"));
			}
		}else{
			$json_encode =  json_encode(array("status"=>"0","message"=>"Minimum one photo is required"));
		}
		echo $json_encode;
	}
	
	
	public function delete_image_from_folder(){
	
		$imagelink = $this->input->post('imageurl');
		$imgArr= array_filter(@explode(',',$imagelink));
		if(count($imgArr)>0){
			foreach($imgArr as $img){
				$filename = './images/product/temp/'.$img;	
				if(file_exists($filename)){
					  unlink($filename);
				}
			}
		}
	}
	
	public function add_product_item(){
		
			$imgsav="images/product/temp/";
			$imgsavr="./images/product/temp/";
			$imagelink = $this->input->post('imageurl');
			$imgArr= array_filter(@explode(',',$imagelink));
			
			if(count($imgArr)>0){
			
				###########################################
				#				Getting values from the app					#
				###########################################
				$product_name=$_POST['I_Tittle'];
				$description=$_POST['I_Desc'];
				$price=$_POST['I_Price'];
				$quantity=$_POST['I_Quantity'];
				$tags=$_POST['I_AddTag'];
				$materials=$_POST['I_AddMat'];
				
				$userID=intval($_POST['seller_id']);
				
				$abt_cat=$_POST['Add_Cat'];
				
				$shippingVal=$_POST['S_Profile'];
				$shippingArray=json_decode($shippingVal);
				###########################################
				#		User id, product status, and pay status			#
				###########################################
				if($userID == 1){
					$status="Publish";
					$pay_status='Paid';	
					$userID=1;
				} else {
					$status="UnPublish";
					$pay_status='Pending';
					$userID=$userID;
				} 
				
				###########################################
				#		Checking the fees for the product listing		#
				###########################################
				if($this->config->item('product_cost') <= '0.00'){
					$status="Publish";
					$pay_status='Paid';
					$pay_type='Free';
					$pay_date=date('Y-m-d');
				}else{
					$pay_type='';
					$pay_date='';
				}
				###########################################
				#				About and Category Section					#
				###########################################
				$abt_cat = json_decode($abt_cat);
				
				$about_1 =$abt_cat[0]->about_1;
				$about_2= $abt_cat[0]->about_2;
				$about_3 =$abt_cat[0]->about_3;

				switch ($about_1) {
					case "2131099714":
						$made_by=1;
						break;
					case "2131099717":
						$made_by=2;
						break;
					case "2131099720":
						$made_by=3;
						break;
					default:
						$made_by=1;
				}
				switch ($about_1) {
					case "2131099724":
						$product_condition=1;
						break;
					case "2131099727":
						$product_condition=2;
						break;
					default:
						$product_condition=1;
				}
				switch ($about_3) {
					case "2131099731":
						$maked_on="made_to_order";
						break;
					default:
						$maked_on="made_to_order";
				}
				
				$cat1= $abt_cat[0]->cat_1;
				$cat2= $abt_cat[0]->cat_2;
				$cat3= $abt_cat[0]->cat_3;
				$finalCatValue="";
				if($cat1!=''){
					$finalCatValue.=$cat1.',';
				}
				if($cat2!=''){
					$finalCatValue.=$cat2.',';
				}
				if($cat3!=''){
					$finalCatValue.=$cat3.',';
				}
				$category_id=rtrim($finalCatValue,',');


				
				###########################################
				#						Product SEO Generation					#
				###########################################
				$seourlBase = $seourl = url_title($product_name, '-', TRUE);
				$seourl_check = '0';
				$prdCol="`id`";
				$duplicate_url = $this->mobile_model->get_column_details(PRODUCT,array('seourl'=>$seourl),$prdCol);
				if ($duplicate_url->num_rows()>0){
					$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
				}else {
					$seourl_check = '1';
				}
				$urlCount = $duplicate_url->num_rows();
				while ($seourl_check == '0'){
					$urlCount++;
					$duplicate_url = $this->mobile_model->get_column_details(PRODUCT,array('seourl'=>$seourl),$prdCol);
					if ($duplicate_url->num_rows()>0){
						$seourl = $seourlBase.'-'.$urlCount;
					}else {
						$seourl_check = '1';
					}
				}
				$productsEo=$seourl;
				###########################################
				#								Image Uploading						#
				###########################################
				
				$imagesVal=array();
				foreach($imgArr as $img){
					$filename = './images/product/'.$img;	
					if(file_exists($filename)){
						$imagesVal[]=$img;
					}else{
						$timeImg=time();
						@copy($imgsavr.$img, './images/product/org-image/'.$timeImg.'-'.$img);
						@copy($imgsavr.$img, './images/product/mb/'.$timeImg.'-'.$img);
						$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$img,'',100);
						@copy($imgsavr.$img, './images/product/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(550, 350, $timeImg.'-'.$img, './images/product/');
						@copy('./images/product/'.$timeImg.'-'.$img, './images/product/thumb/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(175, 150, $timeImg.'-'.$img, './images/product/thumb/');
						@copy($imgsavr.$img, './images/product/list-image/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCrop(75, 75, $timeImg.'-'.$img, './images/product/list-image/');
						
						@copy($imgsavr.$img, './images/product/mb/crop/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$img, './images/product/mb/crop/');
						
						@copy($imgsavr.$img, './images/product/cropsmall/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$img, './images/product/cropsmall/');
						
						@copy($imgsavr.$img, './images/product/cropmed/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$img, './images/product/cropmed/');
						
						@copy($imgsavr.$img, './images/product/cropthumb/'.$timeImg.'-'.$img);
						$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$img, './images/product/cropthumb/');
						
						
						$imagesVal[]=$timeImg.'-'.$img;
					}
				}
				$finalImageVal=@implode(',',$imagesVal);
				
				###########################################
				#	Shipping values for product table	  					#
				###########################################
				
				$ship_from =$shippingArray->ship_from;
				$ship_duration= $shippingArray->readytoShip;
								
				##########################################
				#	Making Data Array & Insert into database	  #
				##########################################
				$modifyDate=date('Y-m-d H:i:s');	
				$giftcard='false';
				$dataArr = array(
							'made_by' => $made_by,
							'product_condition' => $product_condition,
							'maked_on' => $maked_on,
							'modified' => $modifyDate,
							'product_name' => $product_name,
							'description' => $description,
							'price' => $price,
							'base_price' => $price,
							'quantity' => $quantity,
							'image' => $finalImageVal,
							'category_id' => $category_id,
							'tag' => $tags,
							'materials' => $materials,
							'status' => $status, 
							'pay_status' => $pay_status, 
							'seourl' => $seourl,
							'gift_card' => $giftcard,
							'user_id' => $userID,
							'seller_product_id' => time(),
							'ship_duration' => $ship_duration,
							'ship_from' => $ship_from,
							'pay_type' => $pay_type,
							'pay_date' => $pay_date
							);
				
				if($productId != ''){
					unset($dataArr['seourl']);
					unset($dataArr['user_id']);	
					unset($dataArr['status']);	
					unset($dataArr['pay_status']);	
					unset($dataArr['pay_type']);	
					unset($dataArr['pay_date']);	
					$this->product_model->edit_product($dataArr,array('id' => $productId));
					$product_id = $productId;
				}else{
					$this->product_model->add_product($dataArr);
					$product_id = $this->db->insert_id();
				}
				
				
				############################################
				#	Making Shipping Array & Insert into database	  #
				############################################
				
				$shopDest=$shippingArray->shipping;
				if(!empty($shopDest)){
					if($productId != ''){
						$this->product_model->commonDelete(SUB_SHIPPING,array('product_id' => $productId));
					}
					foreach($shopDest as $destination){
							$shipID =$destination->countryId;
							$shipName =$destination->country;
							$cost_individual= $destination->cost;
							$cost_with_another= $destination->withother;
							
							$countryCol="`id`";
							$countryDetails = $this->mobile_model->get_column_details(COUNTRY_LIST,array('id'=>$shipID),$countryCol);
							if($countryDetails->num_rows()>0){
								$shipId=$countryDetails->row()->id; 
								$seourlBase = $seourl = url_title($shipName, '-', TRUE);
								$seourl_check = '0';
								$shippingCol="`sid`";
								$duplicate_url = $this->mobile_model->get_column_details(SUB_SHIPPING,array('ship_seourl'=>$seourl),$shippingCol);
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
								}else {
									$seourl_check = '1';
								}
								$urlCount = $duplicate_url->num_rows();
								while ($seourl_check == '0'){
									$urlCount++;
									$duplicate_url = $this->mobile_model->get_column_details(SUB_SHIPPING,array('ship_seourl'=>$seourl),$shippingCol);
									if ($duplicate_url->num_rows()>0){
										$seourl = $seourlBase.'-'.$urlCount;
									}else {
										$seourl_check = '1';
									}
								}					
								 $dataArrShip=array('product_id' => $product_id,
																	'ship_id' => $shipId,
																	'ship_name' => $shipName,
																	'ship_cost' => $cost_individual,
																	'ship_seourl' => $seourl,
																	'ship_other_cost' => $cost_with_another
																	);
								$this->mobile_model->simple_insert(SUB_SHIPPING,$dataArrShip);
							}
					}		
					$json_encode =  json_encode(array("status"=>"1","message"=>"Item Listed Successfully"));
				}else{
					$json_encode =  json_encode(array("status"=>"0","message"=>"Shipping Values are Missing"));
				}
			}else{
				$json_encode =  json_encode(array("status"=>"0","message"=>"Minimum one photo is required"));
			}
		
		echo $json_encode;
	}
	
	
	
	
	
	
	
	
}

/* End of file additems.php */
/* Location: ./application/controllers/site/additems.php */