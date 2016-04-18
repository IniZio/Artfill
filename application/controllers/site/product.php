<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Product extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation','currencyget'));		
		$this->load->model(array('product_model','user_model','seller_model','product_attribute_model','currency_model','multilanguage_model','order_model'));
		$this->load->library("session");
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['AdminloginCheck'] = $this->checkLogin('A');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}	 	
		
	 /* 	$result = $this->product_model->ExecuteQuery("UPDATE `shopsy_users` SET `affiliateId` = `user_name` WHERE `affiliateId` IS NULL OR `affiliateId` = '' ");

		$this->db->db_debug = 0; */
	 //	$languages = $this->multilanguage_model->get_language_list()->result_array();
	 	//echo $this->db->last_query()."<br>";
	 	
 		/* $this->product_model->ExecuteQuery("ALTER TABLE `".PRODUCT_EN."` ADD `pickup_option` varchar(255) NOT NULL");
 		/* $this->product_model->ExecuteQuery("ALTER TABLE  `".PRODUCT_EN."` ADD `currency_value` DECIMAL( 10, 3 ) NOT NULL");
	 	foreach($languages as $lang){
	 		
	 		$ln = $lang['lang_code'];
	 		
	 		$table = PRODUCT_EN;
	 		$ln_table = $table."_".$ln;
			
	 		#include('./geoplugin.php');
				
	 		$this->product_model->ExecuteQuery("ALTER TABLE `".$ln_table."` ADD `latitude` DECIMAL(10,7) NOT NULL AFTER `status`, ADD `longitude` DECIMAL(10,7) NOT NULL AFTER `latitude`");
	 		//echo $this->db->last_query(); 
	 		$this->product_model->ExecuteQuery("ALTER TABLE `".$ln_table."` CHANGE `latitude` `latitude` DECIMAL(10,7) NULL DEFAULT NULL");
	 		$this->product_model->ExecuteQuery("ALTER TABLE `".$ln_table."` CHANGE `longitude` `longitude` DECIMAL(10,7) NULL DEFAULT NULL");
	 		$this->product_model->ExecuteQuery("ALTER TABLE `".$ln_table."` ADD `product_type` ENUM('digital','physical') NOT NULL");
	 		$this->product_model->ExecuteQuery("ALTER TABLE `".$ln_table."` ADD `pickup_option` varchar(255) NOT NULL");
	 		
	 	}
		$this->db->db_debug = 1; */
    }
   
	/**
	 * 
	 * This function add the product
	 * 
	 * return Array
	 */
	public function add_shop_product(){	
		//echo "<pre>"; print_r($_POST); 
		
		if($this->checkLogin('U') != '' || $this->checkLogin('A') == 1){
			
			
			if($this->input->post('price_status') == 1)
			{
				$price = $this->input->post('price');	
			} else {
				$price = '';	
			}
				
			$default_cur_get=$this->product_model->get_all_details(CURRENCY,array('default_currency'=>'Yes','status'=>'Active'));
			$user_cur_get=$this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
			$default_cur=$default_cur_get->row()->currency_code;
			$user_cur=$user_cur_get->row()->currency;
			#echo $default_cur. "  user_cur ".$user_cur;die;
			if($default_cur!=$user_cur)	{		
				$curval=$this->data['currencyValue'];
				#echo $curval;die;
				$curCurency=$this->currencyget->currency_conversion(1,$default_cur,$user_cur);
				$price=$price/$curval;
			}  else {
				$price=$price;
				$curval=1;
				$curCurency=1;
			}
			
			//for multilanguage products
			$tablename = $_POST['tablename'];
			if(isset($tablename)){					
				$dataArr['product_name'] = $_POST['product_name'];
				$dataArr['description'] = $_POST['description'];
				$UPDATE_product_Seourl = $_POST['edit_product_id'];
					
				$this->product_model->update_details($tablename,$dataArr,array('seourl' => $UPDATE_product_Seourl));			
					
				if($this->input->post('AdminEditProduct')=='admin-edit-product'){
					//redirect('admin-preview/'.$UPDATE_product_Seourl);
					if($_POST['redirect_status'] == 'UnPublish'){
						redirect('shop/billing');
					}else{
						//redirect('products/'.$UPDATE_product_Seourl);
						redirect('/shop/sell');
					}
					
				}else{
					//redirect('preview/'.$UPDATE_product_Seourl);
					if($_POST['redirect_status'] == 'UnPublish'){
						redirect('shop/billing');
					}else{
						//redirect('products/'.$UPDATE_product_Seourl);
						redirect('/shop/sell');
					}
				}
			}
			
			//for multilanguage products//

	if($this->checkLogin('A') == 1){
		$status="Publish";
		$pay_status='Paid';
	}else if(($this->checkLogin('U')!='') && ($this->input->post('product_edit_status')!='')){
		if($this->input->post('product_edit_status') =='Publish'){
			$status="Publish";
			$pay_status='Paid';
		}else{
			$status="UnPublish";
			$pay_status='Pending';
		}	
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
				
				$this->db->select("membership_status");
				$this->db->from(SELLER);
				$this->db->where(array("seller_id"=>$userID));
				$SellerList=$this->db->get();
				if($SellerList->row()->member_status==1){
					$status="Publish";
					$pay_status='Paid';	
					$pay_type='Free';
					$pay_date=date("Y-m-d H:i:s");
				}else{
					$pay_type='';
					$pay_date='';
				}			
			}else{
			
				if($this->config->item('product_cost') <= 0.00){
					$status="Publish";
					$pay_status='Paid';
					$pay_type='Free';
					$pay_date=date("Y-m-d H:i:s");#date('Y-m-d');
				}else{
					$pay_type='';
					$pay_date='';
				}
			}			
			if($this->input->post('edit_product_id')==''){
				if($this->input->post('image_upload') == ''){ redirect($_SERVER['HTTP_REFERER']);}
			}
				$dir = getcwd()."/images/product/temp_img/";//dir absolute path
				$interval = strtotime('-24 hours');//files older than 24hours
				foreach (glob($dir."*.*") as $file) 
    			{
    			if (filemtime($file) <= $interval ) {unlink($file);}
				}				
				$dir = getcwd()."/temp_digital_files/";//dir absolute path
				$interval = strtotime('-24 hours');//files older than 24hours
				foreach (glob($dir."*.*") as $file) 
    			{
    			if (filemtime($file) <= $interval ) {unlink($file);}
				}
		
		$UPDATE_product_Seourl =  $this->input->post('edit_product_id');
		$made_by =  $this->input->post('about_item');
		$product_condition = $this->input->post('what_item');
		$maked_on = $this->input->post('when_made');
		$category1 =  $this->input->post('main_cat_id');
		$category_id = $category1;
		if($this->input->post('level1_sub_cat') != ''){
		$category2 =  $this->input->post('level1_sub_cat');
		$category_id.= ','.$category2;
		}
		if($this->input->post('level2_sub_cat') != ''){
		$category3 =  $this->input->post('level2_sub_cat');
		$category_id.= ','.$category3;
		}
		#echo $category_id;die;
		$product_name =  strip_tags($this->input->post('product_name'));		
		if($this->input->post('image_upload')!=''){
			$imgRnew0 = @explode('.',$this->input->post('image_upload'));
			$NewImg0 = url_title($imgRnew0[0], '-', TRUE);
			$image_upload0 = $NewImg0.'.'.$imgRnew0[1];
		}
		
		if($this->input->post('image_upload1')!=''){
			$imgRnew1 = @explode('.',$this->input->post('image_upload1'));
			$NewImg1 = url_title($imgRnew1[0], '-', TRUE);
			$image_upload1 = $NewImg1.'.'.$imgRnew1[1];
		}
		
		if($this->input->post('image_upload2')!=''){
			$imgRnew2 = @explode('.',$this->input->post('image_upload2'));
			$NewImg2 = url_title($imgRnew2[0], '-', TRUE);
			$image_upload2 = $NewImg2.'.'.$imgRnew2[1];
		}
		
		if($this->input->post('image_upload3')!=''){
			$imgRnew3 = @explode('.',$this->input->post('image_upload3'));
			$NewImg3 = url_title($imgRnew3[0], '-', TRUE);
			$image_upload3 = $NewImg3.'.'.$imgRnew3[1];
		}
		
		
		if($this->input->post('image_upload4')!=''){
			$imgRnew4 = @explode('.',$this->input->post('image_upload4'));
			$NewImg4 = url_title($imgRnew4[0], '-', TRUE);
			$image_upload4 = $NewImg4.'.'.$imgRnew4[1];
		}
				
		$timeImg=time();
			if($image_upload0 != '' || $this->input->post('existImage0') != ''){
				if($image_upload0 != ''){
				
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/org-image/'.$timeImg.'-'.$image_upload0);
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/mb/'.$timeImg.'-'.$image_upload0);
					$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$image_upload0);
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/mb/thumb/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(350, '', $timeImg.'-'.$image_upload0, './images/product/mb/thumb/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/mb/crop/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$image_upload0, './images/product/mb/crop/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload0, './images/product/');
					
					@copy('./images/product/'.$timeImg.'-'.$image_upload0, './images/product/thumb/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload0, './images/product/thumb/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/list-image/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload0, './images/product/list-image/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/cropsmall/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$image_upload0, './images/product/cropsmall/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/cropmed/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$image_upload0, './images/product/cropmed/');
					
					@copy('./images/product/temp_img/'.$image_upload0, './images/product/cropthumb/'.$timeImg.'-'.$image_upload0);
					$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$image_upload0, './images/product/cropthumb/');
					
					//$this->thumbimage_resize('images/product/mb/','images/product/mb/thumb/','350');

					$imagesVal=$timeImg.'-'.$image_upload0;
					
				}else if($this->input->post('existImage0') != ''){
					$imagesVal=$this->input->post('existImage0');	
				}
			}
			  
			if($image_upload1 != '' || $this->input->post('existImage1') != ''){
				if($image_upload1 != ''){
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/org-image/'.$timeImg.'-'.$image_upload1);
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/mb/'.$timeImg.'-'.$image_upload1);
					$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$image_upload1);
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/mb/thumb/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCrop(350, '', $timeImg.'-'.$image_upload1, './images/product/mb/thumb/');
						
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/mb/crop/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$image_upload1, './images/product/mb/crop/');
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload1, './images/product/');
					
					@copy('./images/product/'.$timeImg.'-'.$image_upload1, './images/product/thumb/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload1, './images/product/thumb/');
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/list-image/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload1, './images/product/list-image/');
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/cropsmall/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$image_upload1, './images/product/cropsmall/');
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/cropmed/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$image_upload1, './images/product/cropmed/');
					
					@copy('./images/product/temp_img/'.$image_upload1, './images/product/cropthumb/'.$timeImg.'-'.$image_upload1);
					$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$image_upload1, './images/product/cropthumb/');
					
					$imagesVal .=','.$timeImg.'-'.$image_upload1;
				}else if($this->input->post('existImage1') != ''){
					$imagesVal .=','.$this->input->post('existImage1');	
				}
			  }
			  
			  if($image_upload2 != '' || $this->input->post('existImage2')){
                  if($image_upload2 != ''){
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/org-image/'.$timeImg.'-'.$image_upload2);
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/mb/'.$timeImg.'-'.$image_upload2);
						$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$image_upload2);
						
						
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/mb/thumb/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCrop(350, '', $timeImg.'-'.$image_upload2, './images/product/mb/thumb/');
						
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/mb/crop/'.$timeImg.'-'.$image_upload1);
						$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$image_upload2, './images/product/mb/crop/');
						
						
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload2, './images/product/');
						@copy('./images/product/'.$timeImg.'-'.$image_upload2, './images/product/thumb/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload2, './images/product/thumb/');
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/list-image/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload2, './images/product/list-image/');
						
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/cropsmall/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$image_upload2, './images/product/cropsmall/');
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/cropmed/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$image_upload2, './images/product/cropmed/');
						
						@copy('./images/product/temp_img/'.$image_upload2, './images/product/cropthumb/'.$timeImg.'-'.$image_upload2);
						$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$image_upload2, './images/product/cropthumb/');
						
						$imagesVal.=','.$timeImg.'-'.$image_upload2;
					} 
					else if($this->input->post('existImage2') != '')
					{
						$imagesVal .=','.$this->input->post('existImage2');	
					}
			  }
			  
			  if($image_upload3 != '' || $this->input->post('existImage3')){
				   	if($image_upload3 != ''){
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/org-image/'.$timeImg.'-'.$image_upload3);
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/mb/'.$timeImg.'-'.$image_upload3);
						$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$image_upload3);
						
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/mb/thumb/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCrop(350, '', $timeImg.'-'.$image_upload3, './images/product/mb/thumb/');
						
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/mb/crop/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$image_upload3, './images/product/mb/crop/');
						
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload3, './images/product/');
						@copy('./images/product/'.$timeImg.'-'.$image_upload3, './images/product/thumb/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload3, './images/product/thumb/');
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/list-image/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload3, './images/product/list-image/');
						
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/cropsmall/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$image_upload3, './images/product/cropsmall/');
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/cropmed/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$image_upload3, './images/product/cropmed/');
						
						@copy('./images/product/temp_img/'.$image_upload3, './images/product/cropthumb/'.$timeImg.'-'.$image_upload3);
						$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$image_upload3, './images/product/cropthumb/');
						
						$imagesVal.=','.$timeImg.'-'.$image_upload3;
					}else if($this->input->post('existImage3') != ''){
						$imagesVal .=','.$this->input->post('existImage3');	
					}
			  }                        
			  
			  if($image_upload4 != '' || $this->input->post('existImage4')){
					if($image_upload4 != ''){ 
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/org-image/'.$timeImg.'-'.$image_upload4);
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/mb/'.$timeImg.'-'.$image_upload4);
						$this->ImageCompress('images/product/mb/'.$timeImg.'-'.$image_upload4);
						
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/mb/thumb/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCrop(350, '', $timeImg.'-'.$image_upload4, './images/product/mb/thumb/');
						
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/mb/crop/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCropping(350, 350, $timeImg.'-'.$image_upload4, './images/product/mb/crop/');
						
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload4, './images/product/');
						@copy('./images/product/'.$timeImg.'-'.$image_upload4, './images/product/thumb/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload4, './images/product/thumb/');
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/list-image/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload4, './images/product/list-image/');
						
						
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/cropsmall/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCropping(108, 92, $timeImg.'-'.$image_upload4, './images/product/cropsmall/');
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/cropmed/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCropping(285, 215, $timeImg.'-'.$image_upload4, './images/product/cropmed/');
						
						@copy('./images/product/temp_img/'.$image_upload4, './images/product/cropthumb/'.$timeImg.'-'.$image_upload4);
						$this->ImageResizeWithCropping(75, 75, $timeImg.'-'.$image_upload4, './images/product/cropthumb/');
						
						$imagesVal.=','.$timeImg.'-'.$image_upload4;
					}else if($this->input->post('existImage4') != ''){
						$imagesVal .=','.$this->input->post('existImage4');	
					}
			  }
			  
		//$imagesVal=$timeImg.'-'.$image_upload0.','.$Imgname1.','.$timeImg.'-'.$image_upload2.','.$timeImg.'-'.$image_upload3.','.$timeImg.'-'.$image_upload4;
		//echo $imagesVal; echo "<br>"; 
		$imagesVal = trim($imagesVal,",");
		//die;
		
		
		$description = $this->input->post('description');
		$tags = $this->input->post('jquery-tagbox-tags');
		$materials = $this->input->post('jquery-tagbox-materials'); 
        /*
         * Get product type and set price
         */
		
                $quantity = $this->input->post('quantity');
				$price_type =  $this->input->post('pricing_type');
                    //$price = $this->input->post('price');
                    $pricing_type = 'Fixed';
                    $auction_level = ''; 

			
		$giftcard='false';
		if($this->input->post('giftcard') == 'on'){
		$giftcard='true';
		} 
		
		$ship_duration = $this->input->post('ship_duration'); 
		if($ship_duration == 'custom')
		{
			$ship_duration=$this->input->post('processing_min').'-'.$this->input->post('processing_max').' '.$this->input->post('processing_time_units');
		}
		
			$ship_from=explode('|',$this->input->post('shipping_from'));
			$product_seller_id = rand(1111, 999999);
			
			//$insert_id =$this->db->insert_id();
			$seourlBase = $seourl = url_title($insert_id, '-', TRUE);
			
			if ($seourlBase == ''){
				$seourlBase = $seourl = $product_seller_id;
			}
			
			$seourl_check = '0';
			$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
			if ($duplicate_url->num_rows()>0){
				$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
			}else {
				$seourl_check = '1';
			}
			$urlCount = $duplicate_url->num_rows();
			while ($seourl_check == '0'){
				$urlCount++;
				$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
				if ($duplicate_url->num_rows()>0){
					$seourl = $seourlBase.'-'.$urlCount;
				}else {
					$seourl_check = '1';
				}
			}
			$pro_seo=$productsEo=$seourl;
			
			if($UPDATE_product_Seourl != ''){
				$modifyDate=date('Y-m-d H:i:s');	
				$createdDate=date('Y-m-d H:i:s');
			} else {
				$modifyDate=date('Y-m-d H:i:s');	
				$createdDate=date('Y-m-d H:i:s');
			}
		if($this->config->item('deal_of_day')=='Yes'){
			if($this->input->post('deal_date_from')!='')
			{
			$dealstartdate=date('Y-m-d',strtotime($this->input->post('deal_date_from')));
			
			}
			else
			{
			$dealstartdate=NULL;
			}
			if($this->input->post('deal_date_to')!='')
			{
			$dealenddate=date('Y-m-d',strtotime($this->input->post('deal_date_to')));
			}
			else
			{
			$dealenddate=NULL;
			}
			if($this->input->post('deal_time_from')!='')
			{
			$dealstarttime=date('H:i',strtotime($this->input->post('deal_time_from')));
			}
			else
			{
			$dealstarttime=NULL;
			}
			if($this->input->post('deal_time_to')!='')
			{
			$dealstimeto=date('H:i',strtotime($this->input->post('deal_time_to')));
			}
			else
			{
			$dealstimeto=NULL;
			}
			if($this->input->post('discount')!='')
			{
			$discount=$this->input->post('discount');
			}
			else
			{
			$discount=NULL;
			}
			if($dealstartdate && $dealenddate && $discount && $dealstimeto && $dealstarttime!=NULL)
			{
			$dodstatus='DOD';
			}
			}
			
			$shopDetails = $this->product_model->get_all_details(SELLER,array('seller_id'=>$userID));
			//print_r($shopDetails->result());
			 
			if($shopDetails->num_rows()>0){
				$address = str_replace(' ','+',$shopDetails->row()->shop_location);
				$url = "http://maps.google.com/maps/api/geocode/json?address=".$address;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response = json_decode($response);
				$lat = $response->results[0]->geometry->location->lat;
				$long = $response->results[0]->geometry->location->lng;
				
			}else{
				$lat = '';
				$long = '';
			}
			

			$dataArr = array(
			            'made_by' => $made_by,
						'product_condition' => $product_condition,						
						'modified' => $modifyDate,
						'created' => $createdDate,
						'maked_on' => $maked_on,
			            'product_name' => $product_name,
						'description' => $description,
						'price' => $price,
						'quantity' => $quantity,
						'image' => $imagesVal,
						'category_id' => $category_id,
						'tag' => $tags,
						'action'=>$dodstatus,
						'discount' =>$discount,
						'deal_date'=>$dealstartdate,
						'deal_date_to'=>$dealenddate,
						'deal_time_from' =>$dealstarttime,
						'deal_time_to' =>$dealstimeto,
						'materials' => $materials,
						'status' => $status, 
						'pay_status' => $pay_status, 
						'seourl' => $seourl,
						'gift_card' => $giftcard,
						'user_id' => $userID,
						'seller_product_id' => $product_seller_id,
						'ship_duration' => $ship_duration,
						'ship_from' => $ship_from[1],
						'pay_type' => $pay_type,
						'pay_date' => $pay_date,
                        'price_type' => $pricing_type,
						'product_type' => $this->input->post('item_name'),
                        'auction_level' => $auction_level,	
						'latitude' =>$lat,	
						'longitude' =>$long,
						'pickup_option' => $this->input->post('pickup_option')
						//'ship_details' => $shippingVal
						);
						#echo $this->data['currencyValue'];
						#echo "<pre>"; print_r($dataArr);  die;
			if($UPDATE_product_Seourl != ''){
				$redirect_status = $dataArr['status']; // for redirecting only
				unset($dataArr['seourl']);
				unset($dataArr['created']);
				unset($dataArr['user_id']);	
				unset($dataArr['status']);	
				unset($dataArr['pay_status']);	
				unset($dataArr['pay_type']);	
				unset($dataArr['pay_date']);	
				$prod_name_tmp = $dataArr['product_name'];
				$prod_desc_tmp = $dataArr['description'];
				
				if($this->session->userdata('language_code') != 'en'){
					unset($dataArr['product_name']);
					unset($dataArr['description']);
				}
				
				
				$this->product_model->edit_product($dataArr,array('seourl' => $UPDATE_product_Seourl));
				
				$productsEo=$UPDATE_product_Seourl;
				
				$redirect_seo = $productsEo;// for redirecting only
				
				$languages = $this->multilanguage_model->get_language_list()->result_array();
				//print_r($languages);
				//$this->session->userdata('language_code');
				
				foreach($languages as $lang){
						
					$ln = $lang['lang_code'];
				
					$table = PRODUCT_EN;
					$ln_table = $table."_".$ln;
						
					//echo $ln_table."####";
					//if()
					if($this->session->userdata('language_code') == $lang['lang_code']){
						$dataArr['product_name'] = $prod_name_tmp;
						$dataArr['description'] = $prod_desc_tmp;
					}else{
						unset($dataArr['product_name']);
						unset($dataArr['description']);
					}
						
					$this->product_model->edit_product($dataArr,array('seourl' => $UPDATE_product_Seourl),$ln_table);
					//echo $this->db->last_query()."<br>";
				}
				
			} else {
			   
				$this->product_model->add_product($dataArr);
			   //echo $this->db->last_query()."<br>";
			   
			   $insert_id = $this->db->insert_id();
			   $redirect_status = $dataArr['status'];// for redirecting only
			   
			   
			   //$insert_array = $this->product_model->get_all_details(PRODUCT,array('id'=>$insert_id))->result();
			   $insert_array = $this->product_model->get_all_details(PRODUCT_EN,array('id'=>$insert_id))->result();
			   
			   $redirect_seo = $insert_array[0]->seourl;// for redirecting only
			   
			   $languages = $this->multilanguage_model->get_language_list()->result_array();
			   
// 			   foreach($languages as $lang){
// 			   	$ln = $lang['lang_code'];
// 			   	$table = PRODUCT;
// 			   	$ln_table = $table."_".$ln;
// 			   	$this->product_model->simple_insert($ln_table,$insert_array[0]);
// 			   }
			   
			   
			   foreach($languages as $lang){
				   	//echo "<br>#######<br>";
				   	$ln = $lang['lang_code'];
				   		
				   	$table = PRODUCT_EN;
				   	$ln_table = $table."_".$ln;
				   	
				   	//echo $ln_table."<br>";
				   	
				   	$this->product_model->simple_insert($ln_table,$insert_array[0]);
				   	//echo $this->db->last_query()."<br>";
				   	
				   	$product_name = "product_name_".$ln;
				   	$description = "description_".$ln;
				   
				   	$lndataArr['product_name'] = $_POST[$product_name];
				   	$lndataArr['description'] = $_POST[$description];
				   
				   	if($lndataArr['product_name'] !='' || $lndataArr['description'] != ''){
				   		$this->product_model->update_details($ln_table,$lndataArr,array('id' => $insert_id));
				   	}
				   	//echo $this->db->last_query()."<br>";
			   }
			   
			}	
			//DIE;
			$product_id = $insert_id;
// use product_id as seourl after the insertion.
			$seourl = $product_id;
			$condition = array('id'=>$product_id);
			$dataArr = array('seourl'=>$product_id);
			$this->product_model->update_details(PRODUCT,$dataArr,$condition);
			$this->product_model->update_details(PRODUCT_EN,$dataArr,$condition);

			$insert_array = $this->product_model->get_all_details(PRODUCT_EN,array('id'=>$insert_id))->result();
			   
			$redirect_seo = $insert_array[0]->seourl;// for redirecting only
			
			$languages = $this->multilanguage_model->get_language_list()->result_array();
			
			foreach($languages as $lang){
				$ln = $lang['lang_code'];
				$table = PRODUCT_EN;
				$ln_table = $table."_".$ln;
				$this->product_model->update_details($ln_table,$dataArr,$condition);
			}

		

		if($this->input->post('pickup_option') !='collection'){
			
			if($this->input->post('item_name')=='physical'){
				if($this->input->post('shipping_to') != ''){	
					   if($UPDATE_product_Seourl != ''){
								$product_id=$this->input->post('edit_id');
								$this->product_model->commonDelete(SUB_SHIPPING,array('product_id' => $this->input->post('edit_id')));
									
					   }
						$ship_to = $this->input->post('shipping_to');  
						$ship_to_id = $this->input->post('ship_to_id');   //print_r($ship_to_id); die;
						$cost_individual = $this->input->post('shipping_cost');	
						$cost_with_another = $this->input->post('shipping_with_another');
						for($i=0; $i < sizeof($ship_to); $i++)
						{
								
								
								
							$ship_name=@explode('|', $ship_to[$i]);
							if($ship_to[$i] == 'Everywhere Else'){
								$shipName='Everywhere Else';
$shipName='Hong Kong';
								$shipId=232; 
								
							} else {
							$shipName=$ship_name[1];
$shipName='Hong Kong';
							$shipId=$ship_to_id[$i];
							}
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}		
								
								$cost_individual[$i]=$cost_individual[$i]/$curval;
								$cost_with_another[$i]=$cost_with_another[$i]/$curval;
								
							 $dataArrShip=array('product_id' => $product_id,'ship_id' => $shipId,'ship_name' => $shipName,'ship_cost' => $cost_individual[$i],'ship_seourl' => $seourl,'ship_other_cost' => $cost_with_another[$i]);
							//print_r( $dataArrShip); die;
							 $this->product_model->simple_insert(SUB_SHIPPING,$dataArrShip);
							
						}
				}
			}else if($this->input->post('item_name')=='digital'){
				if($UPDATE_product_Seourl != ''){
					$product_id=$this->input->post('edit_id');
					$this->product_model->commonDelete(SUB_SHIPPING,array('product_id' => $this->input->post('edit_id')));								
				}
				$shipName='Everywhere Else';
$shipName='Hong Kong';
				$seourlBase = $seourl = url_title($shipName, '-', TRUE);
				$seourl_check = '0';
				$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
				if ($duplicate_url->num_rows()>0){
					$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
				}else {
					$seourl_check = '1';
				}
				$urlCount = $duplicate_url->num_rows();
				while ($seourl_check == '0'){
					$urlCount++;
					$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
					if ($duplicate_url->num_rows()>0){
						$seourl = $seourlBase.'-'.$urlCount;
					}else {
						$seourl_check = '1';
					}
				}
				$dataArrShip=array('product_id'=> $product_id,'ship_id' => '232','ship_name' => 'Everywhere Else','ship_cost' => '0','ship_seourl' => $seourl,'ship_other_cost' => '0');
				$this->product_model->simple_insert(SUB_SHIPPING,$dataArrShip);
			}
	  	}else{
			if($UPDATE_product_Seourl != ''){
				$product_id=$this->input->post('edit_id');
				$this->product_model->commonDelete(SUB_SHIPPING,array('product_id' => $this->input->post('edit_id')));
				$this->product_model->update_details(PRODUCT,array('ship_from'=>''),array('id' => $this->input->post('edit_id')));
			}
		}
		$item_name = $this->input->post('item_name');  //physical or digital
		if($UPDATE_product_Seourl != ''){ 
			$product_id=$this->input->post('edit_id');
		    $this->product_model->delete_subproduct_all(array('product_id' => $this->input->post('edit_id')));
		}
		if($item_name == 'physical'){  //if is it physical item we should add the attributes to the sub products table else add digital file/ 
			if($UPDATE_product_Seourl != ''){
				
				if($this->input->post('exist_property_level')!=""){
					if($this->input->post('property_level')==''){
					$variation_name1 = $this->input->post('exist_property_level');
					}
					else{
						$variation_name1 = $this->input->post('property_level');
					}
				}
				else{
					$variation_name1 = $this->input->post('property_level');
				}
				
				/*If variation two existing*/
				if($this->input->post('exist_property_level1')!=""){
					if($this->input->post('property_level1')==''){
					$variation_name2 = $this->input->post('exist_property_level1');
					}
					else{
						$variation_name2 = $this->input->post('property_level1');
					}
				}
				else{
					$variation_name2 = $this->input->post('property_level1');
				}
								
			}
			else{
			$variation_name1 = $this->input->post('property_level');
			$variation_name2 = $this->input->post('property_level1');
			}			
			$variation_value1 = $this->input->post('variation_value');
			if($this->input->post('variation_scale1') != ''){
			    $variation_scale1 = $this->input->post('variation_scale1');
			}
			else{
				$variation_scale1='';
			}
			if($this->input->post('variation_scale2') != ''){
			    $variation_scale2 = $this->input->post('variation_scale2');
			}
			else{
				$variation_scale2='';
			}
				
			$variation_value2 =  $this->input->post('variation_value1');
				if($this->input->post('price_status') == 0){
					for($i=0;$i<sizeof($this->input->post('pricing'));$i++){
						$tpric = $this->input->post('pricing');
						$pricing1[] = $tpric[$i]/ $curval;
					}	
				}else{
					$pricing1 = array();
				}
				#echo "<pre>";print_r($this->input->post('pricing'));
			#print_r($pricing1); #die;
			$stock1 = $this->input->post('listing_variation');						
			$stock2 = $this->input->post('listing_variation1');			
					if($variation_name1 != '' && count($this->input->post('DigiFiles')) == 1 && $variation_value1 != ''){
							for($i=0; $i< sizeof($variation_value1); $i++){
								if($pricing1[$i] == 0) { $prcg=NULL; } else { $prcg= $pricing1[$i]; }					
								  $attr_array1 = array('attr_name' => $variation_name1,
													'attr_value' => $variation_value1[$i],
													//'attr_seourl' => $seourl,
													'pricing' => $prcg,
													'stock_status' => $stock1[$i],
													'product_id' => $product_id,
													'attr_scale' => $variation_scale1);
													
								  $this->product_model->add_subproduct_insert($attr_array1);
								  }
								/*   echo '<pre>'; print_r($attr_array1); //die;
								$attr_details = $this->product_model->get_sorted_array_values($attr_array1,'pricing','asc');	


								
									for($i=0; $i< sizeof($attr_array1); $i++){
									     $attr_data_arr = array('attr_name' => $attr_array1[$i]['attr_name'],
															'attr_value' => $attr_array1[$i]['attr_value'],
															//'attr_seourl' => $seourl,
															'pricing' =>(int)$attr_array1[$i]['pricing'],
															'stock_status' => $attr_array1[$i]['stock_status'],
															'product_id' => $product_id,
															'attr_scale' => $attr_array1[$i]['attr_scale']);
															
															echo '<pre>'; print_r($attr_data_arr); 
									     $this->product_model->add_subproduct_insert($attr_data_arr);	 							  
								    } */		
							# die;
					}
					if($variation_name2 != '' && count($this->input->post('DigiFiles')) == 1 && $variation_value2 != ''){
						    
							for($i=0; $i< sizeof($variation_value2); $i++){
								$attr_array2 = array('attr_name' => $variation_name2,
													'attr_value' => $variation_value2[$i],
													//'attr_seourl' => $seourl,
													//'pricing' => $pricing2[$i],
													'stock_status' => $stock2[$i],
													'product_id' => $product_id,
													'attr_scale' => $variation_scale2);
												//echo "<pre>";  print_r($attr_array2); die;
													//echo $this->db->last_query();
							$this->product_model->add_subproduct_insert($attr_array2);
							}
					} 
		}
		else if(count($this->input->post('DigiFiles')) > 1){  // if is it digital item  
					
			$digitalfile =  $this->input->post('DigiFiles');
			//echo "<pre>"; print_r($digitalfile); die;
			if($product_id == ''){
				$timeFile=time();
			} else {
				$timeFile='';
			}
			for($i=1; $i < sizeof($digitalfile); $i++){
			@copy('./temp_digital_files/'.$digitalfile[$i], './digital_files/'.$timeFile.$digitalfile[$i]);
			$digitalValues .=$timeFile.$digitalfile[$i].',';
			}
			$attr_digital = array('digital_item' => $digitalValues,'product_id' => $product_id); 
			$this->product_model->add_subproduct_insert($attr_digital);
		}
		
			
			/***********Set minimum base price in product table for sorting purpose*************/
			
			
			if($this->input->post('price_status') == 0){
				$subproduct_detail=$this->product_model->get_subproduct_minPrice_value($product_id);	
				#echo "<pre>";print_r($subproduct_detail->result());
				$base_price=$subproduct_detail->row()->pricing;
			} else {
				$base_price=$price/$curval;
			}
			#echo $base_price;
			$this->product_model->update_details(PRODUCT,array('base_price' => $base_price),array('id' => $product_id));
            $languages = $this->multilanguage_model->get_language_list()->result_array();	
		   	foreach($languages as $lang){
			   	$ln = $lang['lang_code'];
			   		
			   	$table = PRODUCT_EN;
			   	$ln_table = $table."_".$ln;

		   		$this->product_model->update_details($ln_table,array('base_price' => $base_price),array('id' => $product_id));
		   	}			
			#echo $this->db->last_query();die;
		
			$shop_fav_list=$this->product_model->get_all_details(FAVORITE,array('shop_id'=>$userID));
			$shopdet=$this->product_model->get_all_details(SELLER,array('seller_id'=>$userID));
			#echo "<pre>";print_r($shopdet->result());die;
			foreach($shop_fav_list->result() as $Shp_fav)
			{
				$sentfav_list=$this->product_model->get_all_details(USERS, array('id'=>$Shp_fav->user_id));//'like_of_like'=>'Yes'));						
						$noty_email_arr=explode(',',$sentfav_list->row()->notification_email);
						#echo "<pre>";print_r($noty_email_arr);#die;
						if(in_array('fav_shop_pro',$noty_email_arr)){
								
							
								#echo "<pre>";print_r($this->data['userDetails']);die;
								$shop_Name=$shopdet->row()->seller_businessname;
								//$pro_seo=$seourl;
								
								$newsid='32';
								
								$template_values=$this->user_model->get_newsletter_template_details($newsid);

								$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo']);
								extract($adminnewstemplateArr);
								$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
								$message .= '<!DOCTYPE HTML>
									<html>
									<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
									<meta name="viewport" content="width=device-width"/>
									<title>'.$template_values['news_subject'].'</title>
									<body>';
								include('./newsletter/registeration'.$newsid.'.php');	
								
								$message .= '</body>
									</html>';
									

								if($template_values['sender_name']=='' && $template_values['sender_email']==''){
									$sender_email=$this->config->item('site_contact_mail');
									
									$sender_name=$this->config->item('email_title');
								}else{
									$sender_name=$template_values['sender_name'];
									$sender_email=$template_values['sender_email'];
								}
								$email_values = array('mail_type'=>'html',
													'from_mail_id'=>$sender_email,
													'mail_name'=>$sender_name,
													'to_mail_id'=>$sentfav_list->row()->email,
													'subject_message'=>'Favourite',
													'body_messages'=>$message
												);
													
								#echo '<pre>'; print_r($email_values); die;

								$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
						}
			}//die;
			if($redirect_status == 'UnPublish'){
				$this->setErrorMessage('success','Product Added Successfully. Continue Payment to publish the product');
			}else{
				$this->setErrorMessage('success','Product Published Successfully');
			}
			
			if($this->input->post('AdminEditProduct')=='admin-edit-product'){
				//redirect('admin-preview/'.$productsEo);	
				//redirect('shop/sell');
				if($redirect_status == 'UnPublish'){	
					redirect('shop/billing');	
				}else{
					//redirect('products/'.$redirect_seo);
					redirect('/');
				}
				
				
			}else{
				//redirect('preview/'.$productsEo);
				//redirect('shop/sell');
				if($redirect_status == 'UnPublish'){
					redirect('shop/billing');
				}else{
					//redirect('products/'.$redirect_seo);
					redirect('/');
				}
			}
			//$this->load->view('site/shop/listitem_preview',$this->data);
		} else {
		$this->setErrorMessage('error','You Must Login First');
		redirect('');
		}
		
	}

	/**
	 * 
	 * This function edit the product view listing
	 * @param String $seourl
	 * 
	 * return Array
	 */	
	public function reviews($pType=''){
		if ($this->checkLogin('U') == ''){
			$lg_login=addslashes(shopsy_lg('lg_login','You must login'));
			$this->setErrorMessage('error',$lg_login);
			redirect(base_url());
		}
		$search_date =  date("Y-m-d H:i:s");
		if(isset($_GET['month'])){
			$search_month=$_GET['month'];
			$search_date= date("Y-m-d H:i:s", strtotime("-".$search_month." months"));
			//echo $search_date;die;
		}
		//echo $search_date;die;
		$shop_id=$this->user_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')))->row()->id;		
		$this->data['user_review'] = array();
		if($shop_id != ""){
			$this->data['user_review']= $this->user_model->get_my_product_review($shop_id,$search_date);
		}
		//echo $this->db->last_query();die;
		$this->data['my_review']=$this->user_model->get_my_reviews($this->checkLogin('U'),$search_date);
		
		$this->data['all_feedback']=$this->user_model->get_all_reviews($this->checkLogin('U'),$search_date,$shop_id);		
		$this->data['heading'] = $this->config->item('email_title').' - Review';
	
		$this->load->view("site/user/reviews",$this->data);
	}
   public function edit_shop_items($seourl){
   	
	   if($this->checkLogin('U') != '' || $this->checkLogin('A') == 1){
			$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());
			//$this->data['edit_item_detail']=$this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl)); 
			$this->data['edit_item_detail']=$this->product_model->get_all_details(PRODUCT_EN,array('seourl'=>$seourl)); 
			if($this->checkLogin('U') == $this->data['edit_item_detail']->row()->user_id){
				$this->data['catId']=$catId=explode(',',$this->data['edit_item_detail']->row()->category_id);
				$this->data['SubCatId1']=$this->product_model->get_all_details(CATEGORY,array('rootID'=> $catId[0],'status' =>'Active'))->result();
				$this->data['SubCatId2']=$this->product_model->get_all_details(CATEGORY,array('rootID'=> $catId[1],'status' =>'Active'))->result();
				//echo sizeof($this->data['SubCatId1']); die;
				#echo "<pre>";print_r($catId);die;
				$this->data['edit_attr_details']=$this->product_model->view_subproduct_details_join($this->data['edit_item_detail']->row()->id);
				//echo "<pre>"; print_r($this->data['edit_attr_details']->result_array()); 
				 $this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
				$this->data['edit_attr_check']=$this->product_model->get_subproductdetail_GroupEditpage(SUBPRODUCT,$this->data['edit_item_detail']->row()->id,'attr_name')->result_array();
				//echo '<pre>';print_r($this->data['edit_attr_check']->result_array()); die;
				//echo $this->db->last_query(); die;
				$this->data['edit_digital_check']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['edit_item_detail']->row()->id))->result_array();
				$this->data['variations_result']= $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array())->result();
				$this->data['shiptoDetail'] = $this->product_model->get_all_details(SUB_SHIPPING,array('product_id' => $this->data['edit_item_detail']->row()->id))->result();
				/* echo "<pre>";print_r($this->data['shiptoDetail']);
				die; */
				$this->data['seller_info']=$this->seller_model->get_sellers_data(SELLER,$condition);
				//Check product type
				$this->load->view('site/shop/edit_shop_listitems',$this->data);
			}else{
			$notableto_edit=addslashes(shopsy_lg('lg_notableto_edit','Your not suppose to edit this product'));
				$this->setErrorMessage('error',$notableto_edit);
				redirect('products/'.$seourl);
			}
			
		 }else {
			$this->setErrorMessage('error','You Must Login First');
			redirect('login');
		}
   }
	
   public function getLangProduct(){
	   	$id = $this->input->post('id');
	   	$condition = array('id' => $id);
	   	$ln = $this->input->post('ln');
	   	//$table = PRODUCT."_".$ln;
	   	$table = PRODUCT_EN."_".$ln;
	   	$data = $this->product_model->get_all_details($table,array('id'=>$id))->result_array();
	   	//echo "<pre>"; print_r($data);
	   	echo json_encode($data[0]);
   }
   
	/**
	 * 
	 * This function copy the product
	 * @param String $seourl
	 * 
	 * return Array
	 */	
	public function copy_shop_items($seourl){
		 if($this->checkLogin('U') != '' || $this->checkLogin('A') == 1){
			//$this->data['edit_item_detail']=$this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl)); 
			$this->data['edit_item_detail']=$this->product_model->get_all_details(PRODUCT_EN,array('seourl'=>$seourl)); 
			if($this->checkLogin('U') == $this->data['edit_item_detail']->row()->user_id){
				$this->data['catId']=$catId=explode(',',$this->data['edit_item_detail']->row()->category_id);
				$this->data['SubCatId1']=$this->product_model->get_all_details(CATEGORY,array('rootID'=> $catId[0],'status' =>'Active'))->result();
				$this->data['SubCatId2']=$this->product_model->get_all_details(CATEGORY,array('rootID'=> $catId[1],'status' =>'Active'))->result();
				//echo sizeof($this->data['SubCatId1']); die;
				#echo "<pre>";print_r($catId);die;
				$this->data['edit_attr_details']=$this->product_model->view_subproduct_details_join($this->data['edit_item_detail']->row()->id);
				//echo "<pre>"; print_r($this->data['edit_attr_details']->result_array()); 
				 $this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
				$this->data['edit_attr_check']=$this->product_model->get_subproductdetail_GroupEditpage(SUBPRODUCT,$this->data['edit_item_detail']->row()->id,'attr_name')->result_array();
				//echo '<pre>';print_r($this->data['edit_attr_check']->result_array()); die;
				//echo $this->db->last_query(); die;
				$this->data['edit_digital_check']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['edit_item_detail']->row()->id))->result_array();
				$this->data['variations_result']= $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array())->result();
				$this->data['shiptoDetail'] = $this->product_model->get_all_details(SUB_SHIPPING,array('product_id' => $this->data['edit_item_detail']->row()->id))->result();
				/* echo "<pre>";print_r($this->data['shiptoDetail']);
				die; */
				$this->data['seller_info']=$this->seller_model->get_sellers_data(SELLER,$condition);
				//Check product type
				$this->load->view('site/shop/copy_shop_listitems',$this->data);
			}else{
				$this->setErrorMessage('error','Your not suppose to copy this product');
				redirect('products/'.$seourl);
			}
		 } else {
			$this->setErrorMessage('error','You Must Login First');
			redirect('login');
		}
	}
	
	/**
	 * 
	 * This function load the category list 
	 * 
	 * return Array
	 */	
	public function load_category_Listpage(){ 
		$rootCat=explode('-',$this->uri->segment(2)); 
		if(is_numeric($rootCat[0])){
			$sortArr2 = array('field'=>'cat_position','type'=>'asc');
			$sortArr1 = array($sortArr2);
			$this->data['subCategories']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$rootCat[0],'status'=>'Active'),$sortArr1);
			$this->data['currentMainCategory']=$this->product_model->get_all_details(CATEGORY,array('id' => $rootCat[0],'status'=>'Active'))->row();
			
			if($this->data['currentMainCategory']->rootID == 0){
			$condition = " where p.status='Publish' and p.category_id LIKE '%".$rootCat[0]."' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
			$this->data['Main_cat_product_list']=$this->product_model->view_product_details($condition);
			
			$this->data['meta_title'] =$this->data['currentMainCategory']->seo_title;
			$this->data['title'] =$this->data['currentMainCategory']->seo_title;
			$this->data['meta_keyword'] =$this->data['currentMainCategory']->seo_keyword; 
			$this->data['meta_description'] =$this->data['currentMainCategory']->seo_description;   
			//echo $this->db->last_query(); 
			//echo "<pre>"; print_r($this->data['Main_cat_product_list']->result_array()); die; 
			
			}
			$this->load->view('site/list/category_listpage',$this->data);
		}else{
			show_404();
		}
	}	
	
	
	/**
	 * 
	 * This function load the product list 
	 * @param String $seourl
	 * 
	 * return Array
	 */	
	public function load_product_Listpage(){	
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		#$curUrl = @explode('?pg=',$CUrurl);
		if(substr_count($CUrurl,'?pg=') == 0){
			$curUrl = @explode('&pg=',$CUrurl);
		} else {
			$curUrl = @explode('?pg=',$CUrurl);
		}

		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg') * 8;
			$limitPaging = $paginationVal.',8 ';
		} else {
			$limitPaging = ' 8';
		}
		$newPage = $this->input->get('pg')+1;
		#$qry_str = $curUrl[0].'?pg='.$newPage;
		if(substr_count($curUrl[0],'?') >= 1){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		} else {
			$qry_str = $curUrl[0].'?pg='.$newPage;
		}
		$segmentArr=$this->uri->segment_array();
		$Catid=explode('-',$this->uri->segment(count($segmentArr))); 
		$sortArr2 = array('field'=>'cat_position','type'=>'asc');
		$sortArr1 = array($sortArr2);
		$currentcatDetails=$this->product_model->get_all_details(CATEGORY,array('id' => $Catid[0],'status'=>'Active'))->row();
		if($currentcatDetails->rootID == 0){
			if(!isset($_GET['ref'])){
				redirect('category-list/'.$this->uri->segment(count($segmentArr)));
			}
		}
		$this->data['currentsubCategory']=$currentcatDetails;
		$this->data['subCats']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$Catid[0],'status'=>'Active'),$sortArr1);
		$this->data['super_sub_catStatus']='Yes';
		$this->data['super_sub_catID']=$Catid[0];
		if($this->data['subCats']->num_rows() == 0){
			$this->data['super_sub_catStatus']='No';
			$this->data['subCats']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$currentcatDetails->rootID,'status'=>'Active'),$sortArr1);   
		}
		$Catid1=explode('-',$this->uri->segment(2)); 
		$this->data['footerSubcatList']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$Catid1[0],'status'=>'Active'),$sortArr1);
		$made_by='';
		if($this->input->get('marketplace') == 'handmade'){
		$filterid=1;
		$made_by="and p.made_by='".$filterid."'";
		} else if($this->input->get('marketplace') == 'vintage'){
		$filterid=2;
		$made_by="and p.made_by='".$filterid."'";
		}
		$minprice='';
		$maxprice='';
		if($this->input->get('max_price') != '' || $this->input->get('min_price') != ''){
			$minVal = $this->input->get('min_price')/$this->data['currencyValue']; $maxVal = $this->input->get('max_price')/$this->data['currencyValue'];  
			if($maxVal == ''){
				$price="and (p.base_price >= '".$minVal."')"; 
			}else { 
				$price="and (p.base_price >= '".$minVal."' and p.base_price <= '".$maxVal."')";
			}
		}
		$shipto='';  
		if($this->input->get('shipto') != ''){
			$shipto="and (ss.ship_id ='".$this->input->get('shipto')."' or ss.ship_id ='232')";
		}
		$shipfrom='';
		$location=mysql_real_escape_string($this->input->get('location'));
		if($location != ''){
			$shipfrom="and (u.city LIKE '%".$location."%' or u.district LIKE '%".$location."%' or u.state LIKE '%".$location."%' or u.country LIKE '%".$location."%')";
		}
		$gift_cards=''; 
			if($this->input->get('gift_cards') != ''){
			$gift_cards="and s.gift_card ='Yes'"; 
		} 
		//p.category_id LIKE '%,".$Catid[0]."'
		
		$subattr = '';
		if($this->input->get('color') != ''){
			$color = $this->input->get('color');
			$subattr = "and sub.attr_value='".$color."' ";
		}
		
		$condition = " where p.status='Publish' and p.pay_status='Paid' and FIND_IN_SET('".$Catid[0]."',p.category_id) ".$made_by." ".$gift_cards." ".$price." ".$prcing." ".$shipto." ".$shipfrom." and u.group='Seller' ".$subattr." and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc limit ".$limitPaging;
		
		$this->data['product_list']=$this->product_model->view_product_details($condition);
		
		#echo $this->db->last_query(); echo '<pre>'; print_r($this->data['product_list']->num_rows());die;
		
		if($this->data['product_list']->num_rows() > 0){
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: none;">No More Products</a>';
		}	
		$this->data['paginationDisplay'] = $paginationDisplay;
	    $this->data['countryList'] = $this->product_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')))->result();
		$this->data['heading'] =$currentcatDetails->seo_title;
		$this->data['meta_title'] =$currentcatDetails->seo_title;		
		$this->data['meta_keyword'] =$currentcatDetails->seo_keyword; 
		$this->data['meta_description'] =$currentcatDetails->seo_description;   
		$this->data['colorfilter'] = $this->product_model->ExecuteQuery("SELECT * FROM (`shopsy_subproducts`) WHERE `attr_name` = 'color' GROUP BY attr_value")->result();		
		if($this->uri->segment(2)){
			$this->data['lnk']="browse/".$this->uri->segment(2)."/";
		}
		$this->load->view('site/list/product_listpage',$this->data);
	}	
	
	/**
	 * 
	 * This function load the product list  using ajax
	 * @param String $cat_id
	 * 
	 * return Array
	 */
	function Load_ajax_products_list($cat_id){
		
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		#$curUrl = @explode('?pg=',$CUrurl);
		if(substr_count($CUrurl,'?pg=') == 0){
			$curUrl = @explode('&pg=',$CUrurl);
		} else {
			$curUrl = @explode('?pg=',$CUrurl);
		}

		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg') * 8;
			$limitPaging = $paginationVal.',8 ';
		} else {
			$limitPaging = ' 8';
		}
		
		$newPage = $this->input->get('pg')+1;
		#$qry_str = $curUrl[0].'?pg='.$newPage;
		if(substr_count($curUrl[0],'?') >= 1){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		} else {
			$qry_str = $curUrl[0].'?pg='.$newPage;
		}
		
	
	    if($this->input->get('cat_id') != ''){
			$made_by='';   
			if($this->input->get('marketplace') == 'handmade'){
				$filterid=1;
				$made_by="and p.made_by='".$filterid."'";
			} else if($this->input->get('marketplace') == 'vintage') {
				$filterid=2;
				$made_by="and p.made_by='".$filterid."'";
			}
			$minprice='';
			$maxprice='';
			if($this->input->get('max_price') != '' || $this->input->get('min_price') != ''){
				$minVal = $this->input->get('min_price')/$this->data['currencyValue']; $maxVal = $this->input->get('max_price')/$this->data['currencyValue'];  
				if($maxVal == ''){
					$price="and (p.base_price >= '".$minVal."')"; 
				}else { 
					$price="and (p.base_price >= '".$minVal."' and p.base_price <= '".$maxVal."')";
				}
			}
			$shipto='';  
			if($this->input->get('shipto') != ''){
				$shipto="and ss.ship_id ='".$this->input->get('shipto')."'";
			}
			$shipfrom='';
			$location=mysql_real_escape_string($this->input->get('location'));
			if($location != ''){
				$shipfrom="and (u.city LIKE '%".$location."%' or u.district LIKE '%".$location."%' or u.state LIKE '%".$location."%' or u.country LIKE '%".$location."%')";
			}
			$gift_cards=''; 
			if($this->input->get('gift_cards') != ''){
				$gift_cards="and s.gift_card ='Yes'";
			} 
			$cat_id=explode('-',$this->input->get('cat_id'));
			$condition = " where p.status='Publish' and p.pay_status='Paid' and FIND_IN_SET('".$cat_id[0]."',p.category_id) ".$made_by." ".$gift_cards." ".$price." ".$prcing." ".$shipto." ".$shipfrom." and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc limit ".$limitPaging;
		} 
		$product_list=$this->product_model->view_product_details($condition);  
		//echo $this->db->last_query(); 
		//echo '<pre>'; print_r($product_list->num_rows());die;
		
		if($product_list->num_rows() > 0){
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: none;">No More Products</a>';
		}	
		
		
		if($product_list->num_rows() > 0) {
			$i=0; $hover=0; foreach($product_list->result_array() as $products) {
			$Images=explode(',',$products['image']);
			$strhove="'".$hover."'";    // width="215" height="'.$Imgheight[$i].'"
			$prod_list='<div class="brick"> 
				<a href="products/'.$products['seourl'].'"> 
					<img src="images/product/org-image/'.$Images[0].'" width="100%">
				</a>
				<div class="info">
					<h3>'.$products['product_name'].'</h3>
					<span class="cat-name"><a href="shop-section/'.$products['shop_seourl'].'">'.$products['shop_name'].'</a></span>
					<span class="cat-name cat-price">
						<a href="products/'.$products['seourl'].'"> '.$this->data['currencySymbol']; 
						
						if($products['price'] != 0.00) { 
							$prod_list.=number_format($this->data['currencyValue']*$products['price'],2);
						} else { 
							$prod_list.=number_format($this->data['currencyValue']*$products['base_price'],2).'+'; 
						} 
						$prod_list.=$this->data['currencyType'].'</a> 
					</span> 
				 </div>
				 <div class="collections-ui">
			
					 <div  class="favorite-container">';

							if($this->data['loginCheck'] !=''){
								if($products['user_id']==$this->data['loginCheck']){
									$prod_list.='<button onclick="return ownProductFav();" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
										<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
									</button>';
								}else{
							$favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($products['id']));

							#print_r($favArr); die;

							if(empty($favArr)){ $status="'Fresh'";
							
							$prod_list.='<button onclick="return changeProductToFavourite('.stripslashes($products['id']).','.$status.');" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
								<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
							 </button>';

							  } else {        $status="'Old'";               

							$prod_list.='<button onclick="return changeProductToFavourite('.stripslashes($products['id']).','.$status.')" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>';

							 }}} else { $status="'Fresh'";

							$prod_list.='<button onclick="return changeProductToFavourite('.stripslashes($products['id']).','.$status.')" data-source="casanova"  class="btn-fave  inline-overlay-trigger btn-fave-action" type="button"> 
							<span class="icon"></span> <span class="ie-fix">&nbsp;</span> 
						 </button>';

							} 

						  $prod_list.='
					</div

                 <div  class="collect-container">
						 <button onclick="return hoverView(\''.$products['id'].$i.'\');"" class="btn-collect btn-dropdown  inline-overlay-trigger ollection-add-action" type="button"> 
							<span class="icon"></span> 
							<span class="icon-dropdown"></span> 
							<span class="ie-fix">&nbsp;</span>
						</button>
						
					  <div id="hoverlist'.$products['id'].$i.'" class="hover_lists">
						<h2>Your Lists</h2>
						<div class="lists_check">';
						foreach($userLists as $Lists){ 
							$haveListIn = $this->user_model->check_list_products(stripslashes($products['id']),$Lists['id'])->num_rows();
							#echo $haveListIn;
							if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
						
						 $prod_list.='<input type="checkbox" onclick="return addproducttoList(\''.$Lists['id'].'\',\''.stripslashes($products['id']).'\');" '.$chk.' />
						 <label>'.$Lists['name'].'</label> <br />';
						 } 
						 
						 if(!empty($userRegistry)){ 
								$haveRegisryIn = $this->user_model->check_registry_products($products['id'],$userRegistry->user_id)->num_rows();
								if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
							
							$prod_list.='<input type="checkbox"  onclick="return manageRegisrtyProduct(\''.$this->data['userRegistry']->user_id.'\',\''.$products['id'].'\');" '.$chk.' />
							<label><span class="registry_icon"></span>';
							if($this->lang->line('prod_wedding') != '') { $prod_list.=stripslashes($this->lang->line('prod_wedding')); } else $prod_list.='Wedding Registry </label>';
							 }  				
						  $prod_list.='</div>       
						  
						<div class="new_list">
							<form action="site/user/add_list" method="post">
								<input type="hidden" value="1" name="ddl" />
								<input type="hidden" value="'.$products['id'].'" name="productId" />
								<input type="text" placeholder="'; if($this->lang->line('user_new_list') != '') { $prod_list.=stripslashes($this->lang->line('user_new_list')); } else $prod_list.='New list" class="list_scroll" name="list" id="creat_list_'.$i.'" />								
								 <input type="submit" value="';if($this->lang->line('user_add') != '') { $prod_list .= stripslashes($this->lang->line('user_add')); } else $prod_list .= "Add"; $prod_list .='" class="primary-button" onclick="return validate_create_list(\''.$products['id'].$i.'\');" />
							</form>
						</div>
						
					</div> 		 
					
					 </div>
				</div> 								
			</div>';
			echo $prod_list;
			
	
			
			 echo '<script type="text/javascript">';
			echo 'var wall = new freewall("#freewall");
			wall.reset({
				selector: ".brick",
				animate: true,
				cellW: 200,
				cellH: "auto",
				onResize: function() {
					wall.fitWidth();
				}
			});
			
			wall.container.find(".brick img").load(function() {
				wall.fitWidth();
			});


</script> '; 
   
/*  echo "<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script> ";
 */
   $hover++;

       $i++;  if($i == 10) { $i=0;} }  
		echo '<div id="infscr-loading" style="text-align: center; display: none;"><span><img src="images/spinner.gif" alt="Loading..." /></span></div><div class="landing_pagination" id="landing_page_id" style="display: none;">'.$paginationDisplay.'</div>';
	}else{   
	$lin = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'],'?'));

	echo ' <section>

                       <div class="main">

                        <div style="margin:20px 0" class="search-error">

                       <h3 class="crumbs"> Darn. No items match your selections. </h3>

              <p class="newline"> Try <a href="'.$lin.'">showing all items .</a>  </p>

                           </div> 

                       </div> 

                </section>';

	}

}
	public function featureProPaginamtion(){
		//echo "asdf";
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$curUrl = @explode('&pg=',$CUrurl);

		if($this->input->get('pg') != ''){
			$paginationVal = ($this->input->get('pg') -1) * 12;
			$limitPaging = $paginationVal.',12 ';
		} else {
			$limitPaging = ' 12';
		}
		
		$newPage = $this->input->get('pg')+1;
		$order=' order by p.product_featured desc ';
		
		
			$qry_str1 = base_url();
			$qry_str = $qry_str1.'site/product/featureProPaginamtion?pg='.$newPage;
		
			
		$condition = " where fp.expire_date >='".date('Y-m-d')."'and fp.start_date <= '".date('Y-m-d')."' and fp.page='product detail' and p.status='Publish' and p.pay_status='Paid'  and u.group='Seller' and u.status='Active'  group by p.id ".$order." limit ".$limitPaging;
		$this->data['product_list'] = $this->product_model->view_product_details($condition,'opt');
		echo $this->db->last_query();
		if($this->data['product_list']->num_rows() > 0){
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: none;">No More Products</a>';
		}	
		$this->data['paginationDisplay'] = $paginationDisplay;
		$paginationview = $this->load->view('site/product/featureProDetail',$this->data,true);
		echo ($paginationview);
	}

	/**
	 * 
	 * This function load the product detail page
	 * @param String $seourl
	 * 
	 * return Array
	 */
	 
	public function display_product_detail($seourl){
	
			$dataArr=$this->data['preview_item_detail']=$this->product_model->view_published_product_detail($seourl)->result_array();   
			if(count($dataArr) == 0){
				show_404();
			}else{
				if($dataArr[0]['status'] == 'UnPublish' || $dataArr[0]['status'] == 'Pending'){ 
					if($dataArr[0]['user_id'] == $this->checkLogin('U') || $this->checkLogin('U')==1 || $this->checkLogin('A') != ''){					
					} else {
						show_404();
					}
				}
			}
			
			                     
			/* update View Count*/
			$dataArrw = array('view_count'=>$this->data['preview_item_detail'][0]['view_count']+1);
			$conditionw = array('seourl'=>$seourl);
			$this->product_model->update_details(PRODUCT,$dataArrw,$conditionw);
			if($this->checkLogin('U')!=""){
				$activity_id=$this->data['preview_item_detail'][0]['id'];
				$this->product_model->ExecuteQuery("UPDATE ".NOTIFICATIONS." SET `view_mode` = 'No' WHERE activity_id=".$activity_id." AND (activity='favorite item' OR activity='unfavorite item')");
			}
			#echo $this->db->last_query();die;
			$variation=$this->product_model->get_subproductdetail_Group(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id']),'attr_name');
	        $this->data['added_item_details']=$dataArr;
			
			if(count($variation)==0)
			{
				$this->data['variations_one']="";
				$this->data['variations_two']="";
			}
			if(count($variation)==1)
			{
				$this->data['variations_one']=$variation[0]['attr_name'];
				$this->data['variations_two']="";
				$this->data['variations_one_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[0]['attr_name']))->result_array();
			}
			if(count($variation)==2)
			{
				$this->data['variations_one']=$variation[0]['attr_name'];
				$this->data['variations_two']=$variation[1]['attr_name'];
				$this->data['variations_one_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[0]['attr_name']))->result_array();
				$this->data['variations_two_values']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'attr_name'=>$variation[1]['attr_name']))->result_array();
			}
			$columns='*';
			$sellerid=$dataArr['0']['user_id'];
			$product_id=$this->data['preview_item_detail'][0]['id'];
			$this->data['selectedSeller_details']=$this->seller_model->display_seller_view_admin($sellerid);
		$condition = " where p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' and p.id!='".$product_id."' and p.user_id='".$sellerid."' group by p.id order by p.created desc";
			$this->data['shopProductDetails'] = $this->product_model->view_product_details($condition)->result_array();	
			$this->data['ProductFavoriteCount']= $this->product_model->getUserFavoriteProductCount($product_id);
			#$this->data['productReview']=$this->product_model->get_all_details(PRODUCT_FEEDBACK,array('seller_product_id'=> $this->data['preview_item_detail'][0]['id'],'status'=>'Active'))->result_array();
			$this->data['shipping_details']=$this->product_model->get_all_details(SUB_SHIPPING,array('product_id'=> $this->data['preview_item_detail'][0]['id']))->result_array();
			$this->data['productReview']=$this->product_model->get_productfeed_details($this->data['preview_item_detail'][0]['user_id'])->result_array();
			//print_r($this->data['productReview']);die;
			$this->data['subProduct']=$this->product_model->get_all_details(SUBPRODUCT,array('product_id'=> $this->data['preview_item_detail'][0]['id'],'digital_item !='=>''));
		 $imgArr = explode(',', $this->data['preview_item_detail'][0]['image']);
			$img = '';
			foreach ($imgArr as $imgVal){
				if ($imgVal != ''){
					$img = $imgVal;
					break;
				}
			}
						//print_r($this->data['selectedSeller_details']->row()->seller_businessname);die;
			#echo "<pre>";print_r($this->data['productReview']); die;
			$this->data['heading'] = $this->data['preview_item_detail'][0]['product_name'].' by '.$this->data['selectedSeller_details'][0]['seller_businessname'].' on '.$this->config->item('email_title');
			$this->data['meta_title'] =$this->data['preview_item_detail'][0]['product_name'].' by '.$this->data['selectedSeller_details'][0]['seller_businessname'].' on '.$this->config->item('email_title');
			$this->data['meta_keyword'] =$this->data['preview_item_detail'][0]['tag'];
			$this->data['meta_description'] =substr($this->data['preview_item_detail'][0]['description'],0,150);
			$this->data['meta_product_img'] = $img;
			$this->data['meta_product_url'] = 'products/'.$this->data['preview_item_detail'][0]['seourl'];
			$order=' order by fp.id desc';
			$condition = " where fp.expire_date >='".date('Y-m-d')."'and fp.start_date <= '".date('Y-m-d')."' and fp.page='product detail' and p.status='Publish' and p.pay_status='Paid'  and u.group='Seller' and u.status='Active'  group by p.id ".$order." limit 12";
			$this->data['product_list'] = $this->product_model->view_product_details($condition,'opt');
			
			$qry_str1 = base_url();
			$qry_str = $qry_str1.'site/product/featureProPaginamtion?pg=2';
			#echo $this->data['product_list']->num_rows();die;
			if($this->data['product_list']->num_rows() > 0){
				$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
			}else{
				$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: none;"></a>';
			}	
			$this->data['paginationDisplay'] = $paginationDisplay;
			$this->load->view('site/product/product_detail',$this->data);
				
	}
	


	/**
	 * 
	 * This function delete the product in seller list
	 * 
	 */
	public function delete_product(){
		$pid = $this->uri->segment(2,0);
		if ($this->checkLogin('U')==''){
			redirect('login');
		}else {
			$productDetails = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
			if ($productDetails->num_rows()==1){
				if ($productDetails->row()->user_id == $this->checkLogin('U')){
					$this->product_model->commonDelete(USER_PRODUCTS,array('seller_product_id'=>$pid));
					$productCount = $this->data['userDetails']->row()->products;
					$productCount--;
					$this->product_model->update_details(USERS,array('products'=>$productCount),array('id'=>$this->checkLogin('U')));
					$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $productDetails->row()->id));
					$this->setErrorMessage('success','Product deleted successfully');
					redirect('user/'.$this->data['userDetails']->row()->user_name.'/added');
				}else {
					show_404();
				}
			}else {
				$productDetails = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
				if ($productDetails->num_rows()==1){
					if ($productDetails->row()->user_id == $this->checkLogin('U')){
						$this->product_model->commonDelete(PRODUCT,array('seller_product_id'=>$pid));
						$productCount = $this->data['userDetails']->row()->products;
						$productCount--;
						$this->product_model->update_details(USERS,array('products'=>$productCount),array('id'=>$this->checkLogin('U')));
						$this->product_model->commonDelete(SUBPRODUCT,array('product_id' => $productDetails->row()->id));
						$this->setErrorMessage('success','Product deleted successfully');
						redirect('user/'.$this->data['userDetails']->row()->user_name.'/added');
					}else {
						show_404();
					}
				}else {
					show_404();
				}
			}
		}
	}

	
	/**
	 * 
	 * This function load the level 1 subcategorty from add shop list items usign ajax
	 * 
	 */

	public function select_ajax_level1_subcategory(){
	  if($this->lang->line('shop_sub_selectcategory') != '') { 
			$sel_cat= stripslashes($this->lang->line('shop_sub_selectcategory')); 
		} 
		else {
			$sel_cat= "Select a sub category";
		}
	  
		$selectSubcatval = $this->product_model->get_all_details(CATEGORY,array('rootID'=>$this->input->get('main_cat_id'),'status'=> 'Active'));
		if($selectSubcatval->num_rows() > 0){
		 echo '<option value="">'.$sel_cat.'</option>';
		 foreach($selectSubcatval->result() as $MaincatValues) {
			 
         echo '<option value="'.$MaincatValues->id.'">'.$MaincatValues->cat_name.'</option>'; 
		 } } else {
		 
		 echo 'Nocat';}
		
	}
	
	/* Ajax select for level 2 subcategorty from add shop list items */
	/*public function select_ajax_level2_subcategory(){
		
	    for($i=0; $i<500000; $i++)
		{
			echo $i;
		}
		
		$selectSubcatval = $this->product_model->get_all_details(CATEGORY,array('rootID'=>$this->input->get('level1_sub_cat'),'status'=> 'Active'));
		
		 echo '<option>Select a category</option>';
		 foreach($selectSubcatval->result() as $MaincatValues) {
			 
                                echo '<option value="'.$MaincatValues->id.'">'.$MaincatValues->cat_name.'</option>'; 
		 }
		
	}*/
	
	/**
	 * 
	 * This function load the attribute option from add shop list items usign ajax
	 * 
	 */
	public function select_ajax_attr_options(){
		
		if($this->lang->line('shop_selavailableoptions') != '') {
			$sel_opt= stripslashes($this->lang->line('shop_selavailableoptions'));
		}
		else {
			$sel_opt= "Select available options";
		}
		
		if($this->lang->line('option_you_offer') != '') {
			$offer_opt= stripslashes($this->lang->line('option_you_offer'));
		}
		else {
			$offer_opt= "Enter the options you offer";
		}
		
		
		//echo $this->input->get('property_level'); die;
		              $select_attr_val = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array('attr_name' => $this->input->get('property_level'),'status'=> 'Active'));
                      $optionsVal=explode(',',$select_attr_val->row()->attr_options);
					  
					 // echo '<form >';
				      if(!empty($select_attr_val->row()->attr_options)){
				  
				        echo '<select style="width:30%" id="attr_options" onchange="return alpha_check(this);">';
				        echo '<option value="">'.$sel_opt.'</option>';
		                foreach($optionsVal as $variations) {
		        	                           echo '<option>'.$variations.'</option>';
											    }
                                
                           echo  '</optgroup>
                            <!--<optgroup label="Could not find a property">
                                <option >Add a new option</option>
                            </optgroup>--> </select>';
							
							if($select_attr_val->row()->scaling_option == 'Yes')
							{
								echo '<div style="display:none;" id="add_textbox_button"><br><br><span class="opition-offer">'.$offer_opt.'</span>';
			echo '<input id="option_value" type="text"  style="float:left; width:120px; height:27px;  font-size:12px; color:#333; padding:5px 6px;"/><input type="button" class="add_button" value="Add" onclick="return add_options_with_scal();"/></div>';
								echo '<script>$("#have_scalling").html("Yes");</script>';	
							}
							else
							{		
								echo '<script>$("#have_scalling").html("No");</script>';	  
							}
				  
				   } else {
					   echo '<div id="add_textbox_button"><br><br><span class="opition-offer" >'.$offer_opt.'</span>';
		   echo '<input id="option_value" type="text"  style="float:left; width:120px; height:27px;  font-size:12px; color:#333; padding:5px 6px;"/><input type="button" class="add_button" value="Add" onclick="return add_options_without_scale();"/></div>';
                          
				  }
	}
	
	
	/**
	 * 
	 * This function load the level 2 attribute option from add shop list items usign ajax
	 * 
	 */
	public function select_ajax_attr_options1(){
	
	if($this->lang->line('shop_selavailableoptions') != '') {
			$sel_opt= stripslashes($this->lang->line('shop_selavailableoptions'));
		}
		else {
			$sel_opt= "Select available options";
		}
		
		if($this->lang->line('option_you_offer') != '') {
			$offer_opt= stripslashes($this->lang->line('option_you_offer'));
		}
		else {
			$offer_opt= "Enter the options you offer";
		}
		
				  
				  $select_attr_val = $this->product_model->get_all_details(PRODUCT_ATTRIBUTE,array('attr_name' => $this->input->get('property_level1'),'status'=> 'Active'));
                      $optionsVal=explode(',',$select_attr_val->row()->attr_options);
					  
					  //echo '<form >';
				      if(!empty($select_attr_val->row()->attr_options)){
				  
				        echo '<select style="width:30%" id="attr_options1" onchange="return alpha_check1(this);">';
				        echo '<option value="">'.$sel_opt.'</option>';
		                foreach($optionsVal as $variations) {
		        	                           echo '<option>'.$variations.'</option>';
											    }
                                
                           echo  '</optgroup>
                            <!--<optgroup label="Could not find a property">
                                <option >Add a new option</option>
                            </optgroup>--> </select>';
							
							if($select_attr_val->row()->scaling_option == 'Yes')
							{
								echo '<div style="display:none;" id="add_textbox_button1"><br><br><span class="opition-offer" >'.$offer_opt.' </span>';
			echo '<input id="option_value1" type="text"  style="float:left; width:120px; height:27px;  font-size:12px; color:#333; padding:5px 6px;"/><input type="button" class="add_button" value="Add" onclick="return add_options_with_scal1();"/></div>'; //</form>
								echo '<script>$("#have_scalling1").html("Yes");</script>';	
							}
							else
							{		
								echo '<script>$("#have_scalling1").html("No");</script>';	  
							}
				  
				   } else {
					   echo '<div id="add_textbox_button1"><br><br><span class="opition-offer" >'.$offer_opt.'</span>';
		   echo '<input id="option_value1" type="text"  style="float:left; width:120px; height:27px;  font-size:12px; color:#333; padding:5px 6px;"/><input type="button" class="add_button" value="Add" onclick="return add_options_without_scale1();"/></div>'; //</form>
                          
				  }
	}
	
	
	
	/**
	 * 
	 * This function check the image1 width and size, copy the image to temp folder
	 * 
	 */
	public function ajax_load_images(){
		
			list($w, $h) = getimagesize($_FILES["image_upload"]["tmp_name"]);
			if($w >= 550 && $h >= 350){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["image_upload"]["name"]);
			    $NewImg = url_title($imgRnew[0], '-', TRUE);
		    	$ImgTmpName = $NewImg.'.'.$imgRnew[1];
			
				if($ImgTmpName != ''){
			 		move_uploaded_file($_FILES["image_upload"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
		   		}
			}else{
				$errormessage=addslashes(shopsy_lg('lg_upload_img_too_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 550 X 350 .'));
				echo 'Failure|'.$errormessage;
			}
				
	}
	
	
	/**
	 * 
	 * This function check the image2 width and size, copy the image to temp folder
	 * 
	 */
	public function ajax_load_images1(){
		   list($w, $h) = getimagesize($_FILES["image_upload1"]["tmp_name"]);
		if($w >= 550 && $h >= 350){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["image_upload1"]["name"]);
				$NewImg = url_title($imgRnew[0], '-', TRUE);
				$ImgTmpName = $NewImg.'.'.$imgRnew[1];
				if($ImgTmpName != ''){
					move_uploaded_file($_FILES["image_upload1"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
			   }
			}else{
			$errormessage=addslashes(shopsy_lg('lg_upload_img_too_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 550 X 350 .'));
				echo 'Failure|'.$errormessage;
			}				   
	}
	
	/**
	 * 
	 * This function check the image3 width and size, copy the image to temp folder
	 * 
	 */
	public function ajax_load_images2(){
		 list($w, $h) = getimagesize($_FILES["image_upload2"]["tmp_name"]);
			if($w >= 550 && $h >= 350){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["image_upload2"]["name"]);
				$NewImg = url_title($imgRnew[0], '-', TRUE);
				$ImgTmpName = $NewImg.'.'.$imgRnew[1];
				if($ImgTmpName != ''){
					move_uploaded_file($_FILES["image_upload2"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
			   }
			}else{
				$errormessage=addslashes(shopsy_lg('lg_upload_img_too_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 550 X 350 .'));
				echo 'Failure|'.$errormessage;
			}	
	}
	
	/**
	 * 
	 * This function check the image4 width and size, copy the image to temp folder
	 * 
	 */
	public function ajax_load_images3(){
		   list($w, $h) = getimagesize($_FILES["image_upload3"]["tmp_name"]);
			if($w >= 550 && $h >= 350){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["image_upload3"]["name"]);
				$NewImg = url_title($imgRnew[0], '-', TRUE);
				$ImgTmpName = $NewImg.'.'.$imgRnew[1];
				if($ImgTmpName != ''){
					move_uploaded_file($_FILES["image_upload3"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
			   }  
			}else{
				$errormessage=addslashes(shopsy_lg('lg_upload_img_too_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 550 X 350 .'));
				echo 'Failure|'.$errormessage;
			}	
		
	}
	
	/**
	 * 
	 * This function check the image5 width and size, copy the image to temp folder
	 * 
	 */
	public function ajax_load_images4(){
		    list($w, $h) = getimagesize($_FILES["image_upload4"]["tmp_name"]);
			if($w >= 550 && $h >= 350){
			
				$path = "images/product/temp_img/"; 
				$imgRnew = @explode('.',$_FILES["image_upload4"]["name"]);
				$NewImg = url_title($imgRnew[0], '-', TRUE);
				$ImgTmpName = $NewImg.'.'.$imgRnew[1];
				if($ImgTmpName != ''){
					move_uploaded_file($_FILES["image_upload4"]["tmp_name"], $path.$ImgTmpName);
					echo 'Success|'.$path.$ImgTmpName;
			   }
			 }else{
			$errormessage=addslashes(shopsy_lg('lg_upload_img_too_small','Upload Image Too Small. Please Upload Image Size More than or Equalto 550 X 350 .'));
				echo 'Failure|'.$errormessage;
			}	
	}
	
	
	/**
	 * 
	 * This function load the variation option using ajax
	 * 
	 */
	public function load_ajax_options_table($option_val,$scale,$status)
	{
		$idval=time();   if($scale == 'No'){ $scale='';}
		          echo ' <tr id="tab_'.$idval.'">
                            <td width="25%"  >'.rawurldecode($option_val).'&nbsp;<input type="hidden" value="'.rawurldecode($option_val).'" name="variation_value[]"/><span class=scale_change>'.$scale.'</span><input type="hidden" class="scale_change_txt" value="'.$scale.'" name="variation_scale1"/></td>
                            <td width="25%"><span class="price_box" style="display:'.$status.';">$&nbsp;<input type="text" name="pricing[]" style="width:70px;" class="priceingbox"></span>&nbsp;</td>
                            <td width="25%"><input type="checkbox"  id="'.$idval.'" class="stock"  onchange="return stock_check(this);" checked="checked"><input type="hidden" name="listing_variation[]" id="stock_opt_'.$idval.'" value="1"></td>
                             <td width="25%"><a href="javascript:void(0)" onclick="varaClose('.$idval.')"  class="close_icon"></a></td>
                        </tr>'; 
	}
	
	
	/**
	 * 
	 * This function load the variation 1 option using ajax
	 * 
	 */
	public function load_ajax_options_table1($option_val,$scale='')
	{
	//error_reporting(0);
		$idval1=time();
		          echo ' <tr>
                            <td width="25%">'.$option_val.'&nbsp;<input type="hidden" value="'.$option_val.'" name="variation_value1[]"/><span class=scale_change1>'.$scale.'</span><input type="hidden" class="scale_change_txt1" value="'.$scale.'" name="variation_scale2"/></td>
                            <td width="25%"><span class="price_box1" style="display:none">$&nbsp;<input type="text" name="pricing1[]" style="width:70px;" class="priceingbox1"></span>&nbsp;</td>
                            <td width="25%"><input type="checkbox" name="listing_variation1[]" id="'.$idval1.'" class="stock" value="1" onchange="return stock_check(this);" checked="checked"><input type="hidden" name="listing_variation1[]" id="stock_opt_'.$idval1.'" value="1"></td>
                             <td width="25%"><a href="javascript:void(0)"  class="close_icon1"></a></td>
                        </tr>'; 
	}
	
	/**
	 * 
	 * This function load the variation inner option using ajax
	 * 
	 */
	public function load_ajax_options_table_noScale($option_val,$status)
	{			
				$newRand = rand('111','999');
				//echo strlen($scale); die;  
				  if(strlen($option_val) > 0)
				  {
				         $idval=time();
		          echo ' <tr id="tab_'.$newRand.'">
                            <td width="25%">'.$option_val.'&nbsp;<input type="hidden" value="'.$option_val.'" name="variation_value[]"/></td>
                            <td width="25%"><span class="price_box" style="display:'.$status.';">$&nbsp;<input type="text" name="pricing[]" style="width:70px;" class="priceingbox"></span>&nbsp;</td>
                            <td width="25%"><input type="checkbox"  id="'.$idval.'" class="stock"  onchange="return stock_check(this);" checked="checked"><input type="hidden" name="listing_variation[]" id="stock_opt_'.$idval.'" value="1"></td>
                             <td width="25%"><a href="javascript:void(0)" onclick="varaClose('.$newRand.')"  class="close_icon"></a></td>
                        </tr>'; 
				  }
	}
	
	/**
	 * 
	 * This function load the variation inner 1 option using ajax
	 * 
	 */
   public function load_ajax_options_table_noScale1($option_val,$status)
	{			
				$newRand = rand('111','999');
				//echo strlen($scale); die;  
				  if(strlen($option_val) > 0)
				  {
				          $idval=time();
		          echo ' <tr id="tab_'.$newRand.'">
                            <td width="25%">'.$option_val.'&nbsp;<input type="hidden" value="'.$option_val.'" name="variation_value1[]"/></td>
                            <td width="25%"><span class="price_box1" style="display:none">$&nbsp;<input type="text" name="pricing[]" style="width:70px;" class="priceingbox1"></span>&nbsp;</td>
                            <td width="25%"><input type="checkbox"  id="'.$idval.'" class="stock"  onchange="return stock_check(this);" checked="checked"><input type="hidden" name="listing_variation1[]" id="stock_opt_'.$idval.'" value="1"></td>
                             <td width="25%"><a href="javascript:void(0)" onclick="varaClose('.$newRand.')"  class="close_icon"></a></td>
                        </tr>'; 
				  }
	}
	
	/**
	 * 
	 * This function load the variation option alpha values using ajax
	 * 
	 */
	public function load_ajax_options_div()
	{
				/*echo '<div style="float:right;">
						<a href="javascript:void(0)" onclick="return clear_data();" id="close_var_one" class="close_icon" style="display:none;"></a>
					</div>
					<div class="list_inner_right list_small_width" id="attr_loader" style="display:none">
						<img src="images/ajax_loading.gif" alt="loading variations" />
					</div>
					<div class="list_inner_right list_small_width" id="options_level" name="options_level" style="display:none"></div>
					<div class="list_inner_right list_small_width" id="attr_options_val" name="attr_options_val" style="display:none">
								<select onchange="return alpha_check(this);" id="checked_alpha_value" class="alpha_value_one">
										<option value="">Select available options...</option>
									 	<option>XXS</option>
									 	<option>XS</option>
									 	<option>S</option>
									 	<option>M</option>
									 	<option>L</option>
									 	<option>XL</option>
									 	<option>XXL</option> 
									 	<option>3XL</option>
                                    	<option>4XL</option>
                                    	<option>5XL</option>                               
                                    	<!--<optgroup label="Could not find a property">
                                        	<option >Add a new option</option>
                                    	</optgroup>-->
                                </select>
                            </div>
                            <div class="list_inner_fields" style="border-bottom:none;">
                                <label>&nbsp;</label> 
                                <div class="list_inner_right" id="options_table" style="display:none">
								<center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading1" /></center><br />
                                    <table width="100%" class="inner_table"  align="center" cellpadding="0" cellspacing="0" id="options_list">              
                                  <tbody>
                                    <tr>
                                       <td width="40%" ><strong>Options</strong></td>
                                       <td width="25%">
                                            <span class="non-pricing-mode">
                                                <a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt"  onclick="price_opt_click();">Add Pricing</a>
                                            </span>
                                            <span class="pricing-mode retail">
                                                <a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
                                                   <!--<span class="price-header-label retail">
                                                          Price
                                                    <small>USD</small>
                                                </span>-->
                                            </span>
                                        </td>
                                       <td  width="25%" ><strong>In Stock</strong></td>
                                       <td  width="10%" ></td>
                                    </tr>
                                </tbody>
                                </table>
                                </div>   
                            </div> ';*/
							
							
							
			echo '<div class="list_inner_right list_small_width" id="variations_level_div"></div><div style="float:right;">
                            	<a href="javascript:void(0)" onclick="return clear_data();" id="close_var_one" style="display:none;" class="close_icon"></a>
                            </div>
                            <div class="list_inner_right list_small_width" id="attr_loader" style="display:none"><img src="images/ajax_loading.gif" alt="loading variations" /></div>
                            <div class="list_inner_right list_small_width" id="options_level" name="options_level" style="display:none"></div>
                            <div class="list_inner_right list_small_width" id="attr_options_val" name="attr_options_val" style="display:none">
                                <select onchange="return alpha_check(this);" id="checked_alpha_value" class="alpha_value_one">
                                    <option value="">';if($this->lang->line('shop_selavailableoptions') != '') { echo stripslashes($this->lang->line('shop_selavailableoptions')); } else echo 'Select available options'; echo '...</option>
                                    <option>XXS</option>
                                    <option>XS</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                    <option>3XL</option>
                                    <option>4XL</option>
                                    <option>5XL</option>                               
                                    <!--<optgroup label="Couldnt find a property">
                                        <option >Add a new option</option>
                                    </optgroup>-->
                                </select>
                            </div>
                            <div class="list_inner_fields" style="border-bottom:none;">
                                <div class="list_inner_right" id="options_table" style="display:none">
                                <center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading1" /></center><br />

                                	<table width="100%" class="inner_table"  align="center" cellpadding="0" cellspacing="0" id="options_list">              
                                        <tbody>
                                            <tr style="background:#E9F6FC; margin: 0px; padding: 10px; width: 100%;">
                                               <td width="25%" ><strong>';if($this->lang->line('shop_options') != '') { echo stripslashes($this->lang->line('shop_options')); } else echo 'Options'; echo '</strong></td>
                                               <td width="25%">
                                                    <span class="non-pricing-mode">
                                                        <a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt" onclick="price_opt_click();">';if($this->lang->line('shop_addpricing') != '') { echo stripslashes($this->lang->line('shop_addpricing')); } else echo 'Add Pricing';echo '</a>
                                                    </span>
                                                    <span class="pricing-mode retail">
                                                        <a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
                                                           <!--<span class="price-header-label retail">
                                                                  Price
                                                            <small>USD</small>
                                                        </span>-->
                                                    </span>
                                                </td>
                                               <td  width="25%" ><strong>';if($this->lang->line('shop_instock') != '') { echo stripslashes($this->lang->line('shop_instock')); } else echo 'In Stock'; echo '</strong></td>
                                               <td  width="25%" ></td>
                                            </tr>
                                        </tbody>
                                	</table>
                                </div>   
                            </div> ';				
	}
	
	/**
	 * 
	 * This function load the variation option alpha values1 using ajax
	 * 
	 */
	public function load_ajax_options_div1()
	{
				/*echo '<div style="float:right;">
                              	<a href="javascript:void(0)" onclick="return clear_data1();" id="close_var_two" style="display:none;" class="close_icon"></a>
                             </div>
                             <div class="list_inner_right list_small_width" id="attr_loader1" style="display:none">
                              	<img src="images/ajax_loading.gif" alt="loading variations" />
                             </div>
                             <div class="list_inner_right list_small_width" id="options_level1" name="options_level1" style="display:none"></div>
                             <div class="list_inner_right list_small_width" id="attr_options_val1" name="attr_options_val1" style="display:none">
                                    <select onchange="return alpha_check1(this);" id="checked_alpha_value1" class="alpha_value_two">
                                        <option value="">Select available options...</option>
                                        <option>XXS</option>
                                        <option>XS</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                        <option>XXL</option>
                                        <option>3XL</option>
                                        <option>4XL</option>
                                        <option>5XL</option>                               
                                        <!--<optgroup label="Could not find a property">
                                            <option >Add a new option</option>
                                        </optgroup>-->
                                    </select>
                              </div>
                             <div class="list_inner_fields" style="border-bottom:none;">
                                    <label>&nbsp;</label> 
                                    <div class="list_inner_right" id="options_table1" style="display:none">
                                        <table width="100%" class="inner_table"  align="center" cellpadding="0" cellspacing="0" id="options_list1">  
										<center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading2" /></center><br />            
                                            <tbody>
                                                <tr>
                                                   <td width="40%" ><strong>Options</strong></td>
                                                   <td width="25%">
                                                        <span class="non-pricing-mode">&nbsp;
                                                        <!--<a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt1" onclick="price_opt_click1();">Add Pricing</a>-->
                                                        </span>
                                                        <span class="pricing-mode retail">
                                                            <a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
                                                               <!--<span class="price-header-label retail">
                                                                      Price
                                                                <small>USD</small>
                                                            </span>-->
                                                        </span>
                                                    </td>
                                                   <td  width="25%" ><strong>In Stock</strong></td>
                                                   <td  width="10%" ></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>   
                                </div>';*/
								
				echo ' <div style="float:right;">
                              	<a href="javascript:void(0)" onclick="return clear_data1();" id="close_var_two" style="display:none;" class="close_icon"></a>
                             </div>
                             <div class="list_inner_right list_small_width" id="attr_loader1" style="display:none">
                              	<img src="images/ajax_loading.gif" alt="loading variations" />
                             </div>
                             <div class="list_inner_right list_small_width" id="options_level1" name="options_level1" style="display:none"></div>
                             <div class="list_inner_right list_small_width" id="attr_options_val1" name="attr_options_val1" style="display:none">
                                    <select onchange="return alpha_check1(this);" id="checked_alpha_value1" class="alpha_value_two">
                                        <option value="">';if($this->lang->line('shop_selavailableoptions') != '') { echo stripslashes($this->lang->line('shop_selavailableoptions')); } else echo 'Select available options'; echo '...</option>
                                        <option>XXS</option>
                                        <option>XS</option>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                        <option>XXL</option>
                                        <option>3XL</option>
                                        <option>4XL</option>
                                        <option>5XL</option>                               
                                        <!--<optgroup label="Couldnt find a property">
                                            <option >Add a new option</option>
                                        </optgroup>-->
                                    </select>
                              </div>
                             <div class="list_inner_fields" style="border-bottom:none;">
                                    <div class="list_inner_right" id="options_table1" style="display:none">
                                    <center><img src="images/ajax-loader/ajax-loader(14).gif" alt="Adding variations" style="display:none;" id="variation_add_loading2" /></center>
                                        <table width="100%" class="inner_table"  align="center" cellpadding="0" cellspacing="0" id="options_list1">              
                                            <tbody>
                                                <tr style="background:#E9F6FC; margin: 0px; padding: 10px; width: 100%;">
                                                   <td width="25%" ><strong>';if($this->lang->line('shop_options') != '') { echo stripslashes($this->lang->line('shop_options')); } else echo 'Options'; echo '</strong></td>
                                                   <td width="25%">
                                                        <span class="non-pricing-mode">&nbsp;
                                                        <!--<a href="javascript:void(0)" class="enable-variations-pricing" id="price_opt1" onclick="price_opt_click1();">Add Pricing</a>-->
                                                        </span>
                                                        <span class="pricing-mode retail">
                                                            <a href="#variations-section" class="disable-variations-pricing remove button-remove"></a>
                                                               <!--<span class="price-header-label retail">
                                                                      Price
                                                                <small>USD</small>
                                                            </span>-->
                                                        </span>
                                                    </td>
                                                   <td  width="25%" ><strong>';if($this->lang->line('shop_instock') != '') { echo stripslashes($this->lang->line('shop_instock')); } else echo 'In Stock'; echo '</strong></td>
                                                   <td  width="25%" ></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>   
                                </div>';				
	}
	


	/**
	 * 
	 * This function search the products 
	 * @param String $item
	 * 
	 */
	
	public function search_product($item){

//echo "asasas"; die;
// 		$this->ImageResizeWithCrop(550, '', $timeImg.'-'.$image_upload1, './images/product/');
// 		$this->ImageResizeWithCrop(175, '', $timeImg.'-'.$image_upload1, './images/product/thumb/');
// 		$this->ImageResizeWithCrop(75, '', $timeImg.'-'.$image_upload1, './images/product/list-image/');
		
// 		$this->thumbimage_resize('images/product/org-image/','images/product/thumb/','175');
// 		$this->thumbimage_resize('images/product/org-image/','images/product/','550');
// 		$this->thumbimage_resize('images/product/org-image/','images/product/list-image/','75');
		
		
		if(isset($_SERVER['HTTPS'])){
        	$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
	    }else{
			$protocol = 'http://';
	    }	
		
		$CUrurl = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$curUrl = @explode('&pg=',$CUrurl);
		
		if($this->input->get('pg') != ''){
			$paginationVal = $this->input->get('pg') * 12;
			$limitPaging = $paginationVal.',12 ';
		} else {
			$paginationVal=12;
			$limitPaging = ' 12';
		}
		$newPage = $this->input->get('pg')+1;
		
		if(strpos($CUrurl,'?') !== false){
			$qry_str = $curUrl[0].'&pg='.$newPage;
		}else{
			$qry_str = $curUrl[0].'?pg='.$newPage; 
		}

		$item_search='';  $s_key='';
		$s_key=strip_tags(mysql_real_escape_string($this->input->get('item'))); 
		if($s_key != ''){
			$checkShopName=$this->product_model->get_all_details(SELLER,array('seller_businessname' => $s_key,'status' => 'active'));
			if($checkShopName->num_rows() == 1){ 
			redirect('shop-section/'.$checkShopName->row()->seourl);
			}
			$this->data['searchKey'] =$s_key;
			$item_search="and (p.product_name LIKE '%".$s_key."%' or p.tag LIKE '%".$s_key."%' or p.materials LIKE '%".$s_key."%')";
			$item_search1="and (product_name LIKE '%".$s_key."%' or tag LIKE '%".$s_key."%' or materials LIKE '%".$s_key."%')";
		}
	      //echo 'sdfbjh'; die;
		$segmentArr=$this->uri->segment_array();
		$this->data['cats1']='No';
		$this->data['cats2']='No';
	    if($this->uri->segment(3) != '') {
			$Catid1=explode('-',$this->uri->segment(3)); 
			$sortArr2 = array('field'=>'cat_position','type'=>'asc');
			$sortArr1 = array($sortArr2);
			$this->data['cat1']=$this->product_model->get_all_details(CATEGORY,array('id' => $Catid1[0],'status'=>'Active'))->row();
			$this->data['cats1']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$Catid1[0],'status'=>'Active'),$sortArr1);

			if($this->uri->segment(4) != '') {
				$Catid2=explode('-',$this->uri->segment(4));
				$this->data['cat2']=$this->product_model->get_all_details(CATEGORY,array('id' => $Catid2[0],'status'=>'Active'))->row();
				$this->data['cats2']=$this->product_model->get_all_details(CATEGORY,array('rootID'=>$Catid2[0],'status'=>'Active'),$sortArr1);
					
				if($this->uri->segment(5) != '') {
					$Catid3=explode('-',$this->uri->segment(5));
					$this->data['cat3']=$this->product_model->get_all_details(CATEGORY,array('id' => $Catid3[0],'status'=>'Active'))->row();
		    	}
		   }
		}
		
		//echo $item_search; die;
		
		$marketplace1=array_search('handmade',$segmentArr); 
		$made_by='';
		if($this->uri->segment($marketplace1) != ''){
		$filterid=1;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		$marketplace2=array_search('vintage',$segmentArr);
		if($this->uri->segment($marketplace2) != ''){
		$filterid=2;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		$marketplace3=array_search('supplies',$segmentArr);
		if($this->uri->segment($marketplace3) != ''){
		$filterid=3;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		
		$minprice='';
		$maxprice='';  
		if($this->input->get('max_price') != '' || $this->input->get('min_price') != '' || $this->input->get('price') != ''){
			$minVal = mysql_real_escape_string($this->input->get('min_price')); $maxVal = mysql_real_escape_string($this->input->get('max_price'));  			

			if($minVal == ''){
				$minVal=0;
			}
			if($maxVal == ''){
				$price="and (p.base_price >='".$minVal."')"; 
			}else { 
				$price="and (p.base_price >='".$minVal."' and p.base_price <='".$maxVal."')";
			}	
		} 
		
		$shipto='';  
		if($this->input->get('shipto') != ''){
		$shipto="and (ss.ship_id ='".mysql_real_escape_string($this->input->get('shipto'))."' or ss.ship_id ='232')"; 
		} 
		$shipfrom='';
		$location=mysql_real_escape_string($this->input->get('location'));
		if($location != ''){
		$shipfrom="and (p.ship_from LIKE '%".$location."%')"; 
		}
		
		$gift_cards='';  $gift='';
		if($this->input->get('gift_cards') != ''){
		$gift_cards="and s.gift_card ='Yes'";
		$gift=$this->input->get('gift_cards');
		} 
		$this->data['gift']=$gift;
		$category='';
		if($this->uri->segment(3) != ''){
			$catid=explode('-',$this->uri->segment(count($segmentArr)));
		$category="and FIND_IN_SET('".mysql_real_escape_string($catid[0])."',p.category_id)";
		$category1="and FIND_IN_SET('".mysql_real_escape_string($catid[0])."',category_id)";
		}
		
		
		$order='';
		if($this->input->get('order') == 'date_desc'){   
			$order="order by p.created desc";
		} else if($this->input->get('order') == 'most_relevant'){   
			$order="order by p.category_id asc";
		}else if($this->input->get('order') == 'price_asc'){   
			$order="order by p.base_price asc";
		} else if($this->input->get('order') == 'price_desc'){
			$order="order by p.base_price desc";
		}		

		$subattr = '';
		if($this->input->get('color') != ''){
			$color = addslashes($this->input->get('color'));
			$subattr = "and sub.attr_value='".$color."' "; 
		}
        
		$product_type = '';
		$dealday = "";
		if($this->input->get('dealday') != ''){
			$deal = $this->input->get('dealday');
			if($deal == "today"){
				$dealday = " and p.action = 'DOD' and concat_ws(' ',p.deal_date,p.deal_time_from) <= now() and  concat_ws(' ',p.deal_date_to,p.deal_time_to) >= now() ";
			}else if($deal == 'upcoming'){
				$dealday = " and p.action = 'DOD' and p.deal_date <='".date('Y-m-d', strtotime(date('Y-m-d').' +1day' ))."' and p.deal_date_to >='".date('Y-m-d', strtotime(date('Y-m-d').' +1day' ))."'";
			}
			
		}
		#echo $dealday;die;
		if($this->config->item('product_cost') == 0)
			$condition = " where (fp.expire_date >='".date('Y-m-d')."'and fp.start_date <= '".date('Y-m-d')."' and fp.page = 'search') and p.status='Publish' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$shipto." ".$shipfrom." ".$product_type." ".$dealday." and u.group='Seller' and u.status='Active' ".$subattr." group by p.id ".$order." limit ".$limitPaging;
		else	
			$condition = " where (fp.expire_date >='".date('Y-m-d')."'and fp.start_date <= '".date('Y-m-d')."' and fp.page='search') and p.status='Publish' and p.pay_status='Paid' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$shipto." ".$shipfrom." ".$product_type." ". $dealday." and u.group='Seller' and u.status='Active' ".$subattr." group by p.id ".$order." limit ".$limitPaging;
		$this->data['product_list1'] = $this->product_model->view_product_details($condition,'opt');
		$this->data['product_list2'] =array();
		//echo $this->db->last_query();die;
		
		if($this->data['product_list1']->num_rows() < 12){
			//$Feature_prod = array_column($this->data['product_list1']->result_array(),'id');
			//print_r($Feature_prod);die;
			
			if($this->input->get('flag') != ""){
				$limitPaging =$this->input->get('flag')." ,".($paginationVal - $this->data['product_list1']->num_rows());
				
			}else if($this->input->get('pg') == "" ){
				$limitPaging =($paginationVal - $this->data['product_list1']->num_rows());
			}
			if($this->config->item('product_cost') == 0)
				$condition = " where  p.status='Publish' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$shipto." ".$shipfrom." ".$product_type." ".$dealday." and u.group='Seller' and u.status='Active' ".$subattr."  and p.seourl NOT IN ( select product_seo from ".FEATURE_PRODUCT." where start_date <= '".date('Y-m-d')."' and expire_date >= '".date('Y-m-d'). "' and page = 'search' ) group by p.id ".$order." limit ".$limitPaging ;
			else	
				$condition = " where  p.status='Publish' and p.pay_status='Paid' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$shipto." ".$shipfrom." ".$product_type." ". $dealday." and u.group='Seller' and u.status='Active' ".$subattr." and p.seourl NOT IN ( select product_seo from ".FEATURE_PRODUCT." where start_date <= '".date('Y-m-d')."' and expire_date >= '".date('Y-m-d'). "' and page = 'search' )  group by p.id ".$order." limit ".$limitPaging;
			 
			$this->data['product_list2'] = $this->product_model->view_product_details($condition,'opt');
		}
			#echo $this->db->last_query();die;	
		$this->data['product_list'] = array_merge($this->data['product_list1']->result_array(),$this->data['product_list2']->result_array());
		
		
		if($this->config->item('product_cost') != 0)
			$condition = " where p.status='Publish' and p.pay_status='Paid' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$prcing." ".$shipto." ".$shipfrom." ".$product_type." ".$dealday." and u.group='Seller' and u.status='Active' ".$subattr." group by p.id ".$order."";	
		else
			$condition = " where p.status='Publish' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$prcing." ".$shipto." ".$shipfrom." ".$product_type." ".$dealday." and u.group='Seller' and u.status='Active' ".$subattr." group by p.id ".$order."";	
		//print_r($condition);die;
		$this->data['product_count']=$this->product_model->view_product_details_count($condition);
		
		$priceRange=$this->db->query("select max(`base_price`) as maxprice,min(`base_price`) as minprice from ".PRODUCT." where `status`='Publish' ".$category1." ".$item_search1." ");
		#echo $this->db->last_query();#die;
		 $this->data['max_base_price']=$priceRange->row()->maxprice;
		  $this->data['min_base_price']=$priceRange->row()->minprice;
		#echo  $this->data['max_base_price']."          ".  $this->data['min_base_price'];die;
		$this->data['countTitle'] =$this->data['product_count']->num_rows().' '.shopsy_lg('lg_items','Items');
		if($this->data['product_list1']->num_rows < 12 && $this->data['product_list1']->num_rows !=0 ){
			#$qry_str = $curUrl[0].'?pg='.$newPage. '?flag='.((12-$this->data['product_list1']->num_rows())+1); 
			if(strpos($CUrurl,'?') !== false){
				$qry_str = $curUrl[0].'&pg='.$newPage. '&flag='.(12-$this->data['product_list1']->num_rows());
			}else{
				$qry_str = $curUrl[0].'?pg='.$newPage. '?flag='.(12-$this->data['product_list1']->num_rows()); 
			}
		}
		#echo $qry_str;die;
		if(count($this->data['product_list']) > 0){ 			
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" href="'.$qry_str.'" style="display: none;">See More Products</a>';
		}else{
			$paginationDisplay  = '<a title="'.$newPage.'" class="landing-btn-more" style="display: block;">No More Products</a>';
		}	
		$this->data['paginationDisplay'] = $paginationDisplay;
		
		$this->data['title'] ='Search items in '.$this->config->item('email_title');
		$this->data['meta_title'] ='Search items in '.$this->config->item('email_title');
		$this->data['meta_keyword'] ='Search items in '.$this->config->item('email_title');
		$this->data['meta_description'] =$currentcatDetails->seo_description;   
	
		$this->data['color'] = $this->product_model->ExecuteQuery("SELECT attr_options FROM (`shopsy_product_attribute`) WHERE `attr_name` = 'color'")->result_array();
                $this->data['colorfilter'] = explode(",",$this->data['color']['0']['attr_options']);
                
//                print_r($this->data['color']);
//                print_r($this->data['colorfilter']);
//                die;
		$this->load->view('site/product/product_search',$this->data);
	}
	
	/**
	 * 
	 * This function display the product favorites 
	 * parma String $seourl
	 * 
	 */
	public function display_product_favoriters($seourl){
		$condition = " where p.status='Publish' and p.seourl='".$seourl."' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";		
		$this->data['prodInfo']=$prodInfo=$this->product_model->view_product_details($condition)->result();
		$this->data['favUserList']=$favUserList=$this->product_model->getProductFavDetails($prodInfo[0]->id);
					#echo "<pre>"; print_r($favUserList);die;
		if (count($favUserList)>0){
			foreach ($favUserList as $favUser){
				$this->data['favoritersUserfavDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id']);
				$this->data['favoritersUserfavProdDetails'][$favUser['user_id']] = $this->user_model->get_userfav_products($favUser['user_id'])->result_array();
			}
		}
		#echo "<pre>"; print_r($this->data['favoritersUserfavDetails']);die;
		$condition = array('id'=>$this->checkLogin('U'));
		$this->data['userProfileDetails'] = $this->product_model->get_all_details(USERS,$condition)->result_array();
		$this->data['title'] = 'People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');
		$this->data['meta_title'] ='People who have favorited '.$prodInfo[0]->product_name.' by '.$prodInfo[0]->shop_name.' - '.$this->config->item('meta_title');	
		$this->data['meta_description'] =$currentcatDetails->seo_description;   
		
		if(count($prodInfo) > 0){
			$this->load->view('site/product/product_favorites',$this->data);
		}else{
			show_404();
		}
		
		
	}
	
	/*
	* 
	* DeleteShopProducts
	* 
	*/
	
	public function DeleteShopProducts(){
		$deleteProducts =$this->input->post('deleteProducts');
		foreach($deleteProducts as $PrdId){
			//$this->product_model->commonDelete(PRODUCT,array('id' =>$PrdId));
			//$this->product_model->update_details(PRODUCT,array('status' => 'Deleted'),array('id' =>$PrdId));
			$this->product_model->update_details(PRODUCT_EN,array('status' => 'Deleted'),array('id' =>$PrdId));
			
			$languages = $this->multilanguage_model->get_language_list()->result_array();
			
			foreach($languages as $lang){
				$ln = $lang['lang_code'];
				$table = PRODUCT_EN;
				$ln_table = $table."_".$ln;
				$this->product_model->update_details($ln_table,array('status' => 'Deleted'),array('id' =>$PrdId));
			}
			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	/**
	 * 
	 * laod more ajax for product search
	 * 
	 */
	public function ajax_search_product(){	
	#die;
	//echo "<pre>";print_r($this->input->post());die;
	
	
	$loginCheck = $this->checkLogin('U');	
		$item_search='';  $s_key='';
		$s_key=strip_tags(mysql_real_escape_string($this->input->get('item'))); 
		if($s_key != ''){
			$checkShopName=$this->product_model->get_all_details(SELLER,array('seller_businessname' => $s_key,'status' => 'active'));
			if($checkShopName->num_rows() == 1){ 
			redirect('shop-section/'.$checkShopName->row()->seourl);
			}
			$this->data['searchKey'] =$s_key;
			$item_search="and (p.product_name LIKE '%".$s_key."%' or p.tag LIKE '%".$s_key."%' or p.materials LIKE '%".$s_key."%')";
		}
		$segmentArr=$this->uri->segment_array();
		$this->data['cats1']='No';
		$this->data['cats2']='No';
	    
		$marketplace1=array_search('handmade',$segmentArr); 
		$made_by='';
		if($this->uri->segment($marketplace1) != ''){
		$filterid=1;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		$marketplace2=array_search('vintage',$segmentArr);
		if($this->uri->segment($marketplace2) != ''){
		$filterid=2;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		$marketplace3=array_search('supplies',$segmentArr);
		if($this->uri->segment($marketplace3) != ''){
		$filterid=3;
		$made_by="and p.made_by='".$filterid."'"; 
		} 
		$minprice='';
		$maxprice='';  
		if($this->input->get('max_price') != '' || $this->input->get('min_price') != '' || $this->input->get('price') != ''){
			$minVal = $this->input->get('min_price')/$this->data['currencyValue']; 
			$maxVal = $this->input->get('max_price')/$this->data['currencyValue'];  		
			if($this->input->get('price') != ''){
				$priceArr=@explode('-',$this->input->get('price'));
				if($priceArr[0] == 'under'){
					$minVal = 0; 
				} else {
					$minVal = $priceArr[0]/$this->data['currencyValue']; 
				}
				if($priceArr[count($priceArr)]-1 == 'over'){
					$maxVal = ''; 
				} else {
					$maxVal = $priceArr[count($priceArr)-1]/$this->data['currencyValue']; 
				}

			}
			
			if($maxVal == ''){
				$price="and (p.base_price >='".$minVal."')"; 
			}else { 
				$price="and (p.base_price >='".$minVal."' and p.base_price <='".$maxVal."')";
			}		
		} 
		$shipto='';  
		if($this->input->get('shipto') != ''){
		$shipto="and (ss.ship_id ='".$this->input->get('shipto')."' or ss.ship_id ='232')"; 
		} 
		$shipfrom='';
		$location=mysql_real_escape_string($this->input->get('location'));
		if($location != ''){
		$shipfrom="and (u.city LIKE '%".$location."%' or u.district LIKE '%".$location."%' or u.state LIKE '%".$location."%' or u.country LIKE '%".$location."%')"; 
		}
		
		$gift_cards='';  $gift='';
		if($this->input->get('gift_cards') != ''){
		$gift_cards="and s.gift_card ='Yes'";
		$gift=$this->input->get('gift_cards');
		} 
		$this->data['gift']=$gift;
		$category='';
		if($this->uri->segment(8) != ''){
			$catid=explode('-',$this->uri->segment(count($segmentArr)));
		$category="and FIND_IN_SET('".$catid[0]."',p.category_id)";
		}
		
		$order='';
		if($this->input->get('order') == 'date_desc'){   
			$order="order by p.created desc";
		} else if($this->input->get('order') == 'most_relevant'){   
			$order="order by p.category_id asc";
		}else if($this->input->get('order') == 'price_asc'){   
			$order="order by p.base_price asc";
		} else if($this->input->get('order') == 'price_desc'){
			$order="order by p.base_price desc";
		}		

		#echo "<br><pre>"; print_r($product_list); die;
		$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
		$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
		$condition = " where p.status='Publish' and p.pay_status='Paid' ".$item_search." ".$category." ".$made_by." ".$gift_cards." ".$price." ".$prcing." ".$shipto." ".$shipfrom." and u.group='Seller' and u.status='Active' or  p.status='Publish' and p.user_id=0  group by p.id ".$order." LIMIT ".$offset.",".$postnumbers."";
		$this->data['product_list']=$product_list=$this->product_model->view_product_details($condition);
		
		$productsDetail=$product_list->result_array();
	//	echo"<br>           ". $this->db->last_query(); die;		
		#echo "<br><pre>"; print_r($product_list); die;			
				if(!empty($productsDetail)){ $i=0;
				foreach($productsDetail as $proddetails){
                  	$imgSplit = explode(",",$proddetails['image']); 
					
				$shopDet = $this->product_model->get_business_name($proddetails['user_id']);
				#echo '<pre>';print_r($shopDet->result());
				
            	 $content .='<li>     
                    <div class="product_img">
                                <div class="product_hide">                                    
                                    <div class="product_fav">';                             
										if($loginCheck !=''){										
											if($proddetails['user_id']==$this->data['loginCheck']){ 
												$prod_list.='<a href="javascript:void(0);" onclick="return ownProductFav();">
																		<input type="submit" value="" class="hoverfav_icon" />
																	</a>';
											}else{
                                        $favArr = $this->product_model->getUserFavoriteProductDetails(stripslashes($proddetails['id']));
                                        if(empty($favArr)){ 
                                       $content .='<a href="javascript:void(0);" onclick="return changeProductToFavourite(\''.stripslashes($proddetails['id']).'\',\'Fresh\');">
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                         } else {                        
                                       $content .='<a href="javascript:void(0);" onclick="return changeProductToFavourite(\''.stripslashes($proddetails['id']).'\',\'Old\');">
                                            <input type="submit" value="" class="hoverfav_icon1" />
                                        </a>';
                                        }} }else {
                                         $content .='<a href="login" >
                                            <input type="submit" value="" class="hoverfav_icon" />
                                        </a>';
                                          }
                                     $content .='</div>                                       
                                    <div class="hoverdrop_icon">
                                    	<a href="javascript:hoverView(\''.$proddetails['id'].$i.'\');">  </a>
                                        	<div class="hover_lists" id="hoverlist'.$proddetails['id'].$i.'">
                                               	<h2>';
												if($this->lang->line('user_your_lists') != '') {  $content .= stripslashes($this->lang->line('user_your_lists')); } else  $content .= "Your Lists";  $content .='</h2>
                                                <div class="lists_check">';
                                                	foreach($this->data['userLists'] as $Lists){
													$haveListIn = $this->user_model->check_list_products(stripslashes($proddetails['id']),$Lists['id'])->num_rows();
													if($haveListIn>0){$chk='checked="checked"';}else{ $chk='';}
                                                     $content .='<input type="checkbox" class="check_box" onclick="return addproducttoList(\''.$Lists['id'].'\',\''.stripslashes($proddetails['id']).'\');" '.$chk.'/>
                                                    <label>'.$Lists['name'].'</label>';
                                                     } 
                                                     if(!empty($this->data['userRegistry'])){
														$haveRegisryIn = $this->user_model->check_registry_products($proddetails['id'],$this->data['userRegistry']->user_id)->num_rows();
														if($haveRegisryIn>0){$chk='checked="checked"';}else{ $chk='';}
													 $content .='<input type="checkbox" class="check_box" onclick="return manageRegisrtyProduct(\''.$this->data['userRegistry']->user_id.'\',\''.$proddetails['id'].'\');" '.$chk.' />
													<label><span class="registry_icon"></span>';
													if($this->lang->line('prod_wedding') != '') {  $content .= stripslashes($this->lang->line('prod_wedding')); } else  $content .= "Wedding Registry"; $content .='</label>';
													 }  
                                                    $content .='</div>                                                    
                                                    <div class="new_list">
                                                    <form method="post" action="site/user/add_list">
                                                        <input type="hidden" value="1" name="ddl" />
                                                        <input type="hidden" value="'.$proddetails['id'].'" name="productId" />
                                                        <input type="text" placeholder="';if($this->lang->line('user_new_list') != '') { $content .= stripslashes($this->lang->line('user_new_list')); } else $content .= "New list"; $content .='" class="list_scroll" name="list" id="creat_list_'.$proddetails['id'].$i.'" />
                                                        <input type="submit" value="';if($this->lang->line('user_add') != '') { $content .= stripslashes($this->lang->line('user_add')); } else $content .= "Add"; $content .='" class="primary-button" onclick="return validate_create_list(\''.$proddetails['id'].$i.'\');" />
                                                    </form>
                                                </div>
                                        	</div>	
                                    	
                                   	</div>  
                               </div>
                      
                        <a href="products/'.$proddetails['seourl'].'">
                            <img  src="';if(!empty($imgSplit[0])){ $content .='images/product/thumb/'.stripslashes($imgSplit[0]); } else { $content .="images/dummyProductImage.jpg";  }$content .='" 
                              alt="'.stripslashes($proddetails['product_name']).'" title="'.stripslashes($proddetails['product_name']).'" width="350px" height="400px" />
                        </a>';
                     $starttime=$proddetails['deal_date']." ".$proddetails['deal_time_from'];
					
					if($this->config->item('deal_of_day')=='Yes')
		  {
		  if($proddetails['action']=='DOD' && $proddetails['discount']!=0 &&  date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')) {
                    $content .='<div class="offer-tag">
									<p class="off-price">'.$proddetails['discount'].'% 0ff</p>
								</div>';
								$offer=($proddetails['discount']/100)*$proddetails['price'];	
                   } }else{
				   $offer='0';
                       }	
                                
                     $content .='</div><div class="product_title"><a href="products/'.$proddetails['seourl'].'">'.$proddetails['product_name'].'</a></div>
                    <div class="product_maker"><a href="shop-section/'.$shopDet->row()->shop_seourl.'">'.$shopDet->row()->shop_name.'</a></div>
                    <div class="product_price">';
							if($proddetails['price'] != 0.00) {
						if($proddetails['action']=='DOD' && $this->config->item('deal_of_day')=='Yes' && date('Y-m-d H:i',strtotime($starttime)) <=date('Y-m-d H:i')){
                        $content .='<span class="currency_value" style="text-decoration:line-through;">'.$this->data['currencySymbol'].' '. number_format($this->data['currencyValue']*$proddetails['price'],2).'</span>
                        <span class="currency_code">'.$this->data['currencyType'].'</span>';
						$remainbal=$proddetails['price']-$offer;
						$content .='<span class="currency_value" >'.$this->data['currencySymbol'].' '. number_format($this->data['currencyValue']*$remainbal,2).'</span>
                        <span class="currency_code">'.$this->data['currencyType'].'</span>';
                         }
						 else
						 {
						 $content .='<span class="currency_value">'.$this->data['currencySymbol'].' '. number_format($this->data['currencyValue']*$proddetails['price'],2).'</span>
                        <span class="currency_code">'.$this->data['currencyType'].'</span>';
						 }
						 
						 } else { 
                        $content .='<span class="currency_value">'.$this->data['currencySymbol'].' '.number_format($this->data['currencyValue']*$proddetails['pricing'],2).'+'.'</span>
                        <span class="currency_code">'.$this->data['currencyType'].'</span>';
                         }
                   $content .=' </div>
                            
                </li> ';
				$i++;	} 	}  else { $content=''; }
				echo $content;
	}
	/**
	* Adding Product using csv file
	* Upload csv file 
	* Extract the values and import into the table
	*/
	public function upload_the_file()
	{
		if($this->checkLogin('U')=='')
		{
			redirect('login');
		}
		else
		{
			$file = $this->input->post('upload_csv');
			
			#echo "fsdfd".$file;die;
			$fileDirectory ='./images/csv';
			if(!is_dir($fileDirectory))
			{
				mkdir($fileDirectory,0777);
			}
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$config['upload_path'] = $fileDirectory;
			$config['allowed_types'] = '*';

			$this->load->library('upload', $config);

			$file_element_name = 'upload_csv';
			if( $this->upload->do_upload('upload_csv'))
			{
				$fileDetails = $this->upload->data();
				$coun = 0; $row = 1;
				$handle = fopen($fileDirectory."/".$fileDetails['file_name'],"r");
				if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE)
				{
					$data_format = array('type','product_condition','when_did_you_make_it','category','name','description','image','price','quantity','country','ship_cost','ship_cost_with_other');
					if ($data_format==$data1){
						fclose($handle);
						$handle = fopen($fileDirectory."/".$fileDetails['file_name'],"r");
						while(($data = fgetcsv($handle, 10000, ",")) !== FALSE){
							if($row == 1){ $row++; continue; }
							$finalImgArr=array();
							$who_made_it 			=  		$data[0];
							$what_is_it 			      	=  		$data[1];
							$when_did_you_make_it 	=  		$data[2];
							$category 				=  		$data[3];
							$name					=  		$data[4];
							$description 			=  		$data[5];
							$image 					=  		$data[6];
							$price 					=  		$data[7];
							$quantity 				=  		$data[8];
							$country 				=  		$data[9];
							$ship_cost 				=  		$data[10];
							$ship_cost_with_other 	=  		$data[11];


							$price_range = 0;
							if ($sale_price>0 && $sale_price<21)
								$price_range = '1-20';
							else if ($sale_price>20 && $sale_price<101)
								$price_range = '21-100';
							else if ($sale_price>100 && $sale_price<201)
								$price_range = '101-200';
							else if ($sale_price>200 && $sale_price<501)
								$price_range = '201-500';
							else if ($sale_price>500)
								$price_range = '501+';
							
							if($who_made_it=='handmade'){
								$made_by=1;
							}else if($who_made_it=='vintage'){
								$made_by=2;
							}else if($who_made_it=='craft supply'){
								$made_by=3;
							}
							
							if($what_is_it=='finished'){
								$product_condition=1;
							}else if($what_is_it=='unfinished'){
								$product_condition=2;
							}
							
							$maked_on=str_replace('-',',',$when_did_you_make_it);


							$seller_product_id = mktime();
							$checkId = $this->check_product_id($seller_product_id);
							while ($checkId->num_rows()>0){
								$seller_product_id = mktime();
								$checkId = $this->check_product_id($seller_product_id);
							}

							/****----------Move image to server-------------****/

							$image_url = $image;
							
							$imageurlArr=@explode(',',$image);
							foreach($imageurlArr as $image_url){

							$img_data = file_get_contents($image_url);

							$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
							$img_name_arr = explode('.', $img_full_name);
							$img_name = $img_name_arr[0];
							$ext = $img_name_arr[1];
							$ext_arr = explode('?', $ext);
							$ext = $ext_arr[0];
							if (!$ext) $ext='jpg';
							$new_name = str_replace(array(',','$','(',')','~','&'), '', $img_name.mktime().'.'.$ext);
							$new_img = 'images/product/temp_img/'.$new_name;

							file_put_contents($new_img, $img_data);

							/****----------Move image to server-------------****/

							$image_name = $new_name;

							#$this->imageResizeWithSpace(600, 600, $image_name, './images/product/');
							
							@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
							@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
							$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
							@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
							$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
							@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
							$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');
							
							$finalImgArr[]=$image_name;
							}
							
							$finalimage_name = implode(',', $finalImgArr);

							$catArr = $this->product_model->get_all_details(CATEGORY,array('cat_name'=>$category));
							if ($catArr->num_rows()>0){
								$category_id_arr = array($catArr->row()->id);
								while ($catArr->row()->rootID>0){
									$catArr = $this->product_model->get_all_details(CATEGORY,array('id'=>$catArr->row()->rootID));
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
							$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
							$modifyDate='';
							if($this->checkLogin('U')==1){
								$status='Publish';
								$pay_status='Paid';
							}else{
								$status='UnPublish';
								$pay_status='Pending';
							}
						 	$ship_duration='';
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
										'status' => $status, 
										'pay_status' => $pay_status, 
										'seourl' => $seourl,
										'ship_duration' => $ship_duration,
										'ship_from' => $country,
										'user_id' => $this->checkLogin('U')
										);
							
							$this->product_model->simple_insert(PRODUCT,$insertdata);
							$idArr = $this->product_model->get_last_insert_id();
							
							$ship_to = $this->input->post('shipping_to');  
							$ship_to_id = $this->input->post('ship_to_id'); 
							
							$cost_individual = $ship_cost;	
							$cost_with_another = $ship_cost_with_other;
							$shipName=$country;
$shipName='Hong Kong';
							$countryInfo = $this->product_model->get_all_details(COUNTRY_LIST,array('name'=>$country),array(array('field'=>'name','type'=>'asc')));
							$shipId=$countryInfo->row()->id; 
							
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
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
						 	$this->product_model->simple_insert(SUB_SHIPPING,$dataArrShip);
						 
							$usrdetails = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
							if($usrdetails->num_rows()>0)
							{
								$prodCount = $usrdetails->row()->products;
								$prodCount = $prodCount+1;
								$this->product_model->update_details(USERS,array('products'=>$prodCount),array('id'=>$this->checkLogin('U')));
							}

							$row++;
						}
						fclose($handle);
						$this->setErrorMessage('success','Your csv file is uploaded and the product details are added');
						redirect(base_url().'upload-products');
					}else {
						fclose($handle);
						$this->setErrorMessage('error','The coloumns in this csv file does not match to the database');
						redirect('upload-products');
					}

				}
				fclose($handle);
				$this->setErrorMessage('error','The coloumns in this csv file does not match to the database');
				redirect('upload-products');
			}else {
				$this->setErrorMessage('error',strip_tags($this->upload->display_errors()));
				redirect(base_url().'upload-products');
			}
		}
			
	}
	
	/**
	 * 
	 * Check the product duplicate id
	 * param Int $pid
	 * 
	 */
	public function check_product_id($pid=''){
		$checkId = $this->product_model->get_all_details(USER_PRODUCTS,array('seller_product_id'=>$pid));
		if ($checkId->num_rows()==0){
			$checkId = $this->product_model->get_all_details(PRODUCT,array('seller_product_id'=>$pid));
		}
		return $checkId;
	}
	
	/**
	 * 
	 * Upload the product form for csv file upload
	 * 
	 */
	public function upload_product_form(){
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Upload CSV';
    		$this->data['countryList'] = $this->user_model->get_all_details(COUNTRY_LIST,array(),array(array('field'=>'name','type'=>'asc')));
	    	$this->data['shippingList'] = $this->user_model->get_all_details(SHIPPING_ADDRESS,array('user_id'=>$this->checkLogin('U')));
    		$this->load->view('site/shop/upload_csv',$this->data);
    	}
	}
	
	/**
	 * 
	 * Edit the bulk product functions
	 * 
	 */
	public function edit_bulk_product(){
		$products=$this->input->post('products');
		$category=$this->input->post('category');
		$quantity=$this->input->post('quantity');
		$status=$this->input->post('status');
		
		$productArr=@explode(',',$products);
		
		$catArr = $this->product_model->get_all_details(CATEGORY,array('id'=>$category));
		if ($catArr->num_rows()>0){
			$category_id_arr = array($catArr->row()->id);
			while ($catArr->row()->rootID>0){
				$catArr = $this->product_model->get_all_details(CATEGORY,array('id'=>$catArr->row()->rootID));
				if ($catArr->num_rows()>0){
					$category_id_arr[] = $catArr->row()->id;
				}else {
					break;
				}
			}
			$category_id = implode(',',array_reverse($category_id_arr));
		}
		foreach($productArr as $prd_id){			
			$dataarray=array('quantity' => $quantity,'category_id' => $category_id,'status' => $status);
			$this->product_model->update_details(PRODUCT,$dataarray,array('id'=>$prd_id));
		}
		$this->setErrorMessage('success','Your Products are Updated Successfully');
		
	}
	
	
	/**
	 * 
	 * Custom Field Selection while Uploading CSV File
	 * 
	 */
	public function custom_upload_product_form(){
		if ($this->checkLogin('U')==''){
    		redirect(base_url().'login');
    	}else {
    		$this->data['heading'] = 'Upload CSV';
			$this->data['Coloums'] =array('');
    		$this->load->view('site/shop/custom_upload_csv',$this->data);
    	}
	}
	
	/**
	 * 
	 * Custom Uploading File for CSV upload
	 * 
	 */
	public function custom_uploading_file(){
		$file = $this->input->post('upload_csv');
		$fileDirectory ='./images/csv';
		if(!is_dir($fileDirectory)){
			mkdir($fileDirectory,0777);
		}
		$config['overwrite'] = FALSE;
		$config['remove_spaces'] = TRUE;
		$config['upload_path'] = $fileDirectory;
		$config['allowed_types'] = 'csv';

		$this->load->library('upload', $config);

		$file_element_name = 'upload_csv';
		if( $this->upload->do_upload('upload_csv')){
			$fileDetails = $this->upload->data();
			$coun = 0; $row = 1;
			$handle = fopen($fileDirectory."/".$fileDetails['file_name'],"r");
			$data1 = fgetcsv($handle, 10000, ",");
#			if(sizeof($data1)>2){
			if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE){
				echo 'Success|'.$fileDetails['file_name'];
			}else{
				echo 'Failure|CSV File cannot uploaded';
			}
		}else {
			echo 'Failure|'.strip_tags($this->upload->display_errors());
		}
		fclose($handle);
	}
	public function get_coloum_names($file_name=''){
		$fileDirectory ='./images/csv';
		$handle = fopen($fileDirectory."/".$file_name,"r");
		$data = fgetcsv($handle, 10000, ",");
		#echo implode('|^|',$data);
		if(!empty($data)){
			$select='<select><option value="">Select Column</option>';
			foreach($data as $cols){
				$select.='<option>'.$cols.'</option>';
			}
			$select.='</select>';
		}else{
			$select='';
		}
		echo $select;
		fclose($handle);
	}
	public function custom_upload_the_file(){
		#echo "<pre>"; print_r($_POST); die;
			$file_name = $this->input->post('file_name');
			$final_selected_col = $this->input->post('final_selected_col');
			$dummy_dataArr=@explode('|^|',$final_selected_col);
			
			$original_data_format = array('type','product_condition','when_did_you_make_it','category','name','description','image','price','quantity','country','ship_cost','ship_cost_with_other');
			$dummy_indexVal=array();
			$fileDirectory ='./images/csv';			
			$handle = fopen($fileDirectory."/".$file_name,"r");
			if(($datatemp = fgetcsv($handle, 10000, ",")) !== FALSE){
				$indexVal=0;
				foreach($dummy_dataArr as $val){
					$dummy_indexVal[$original_data_format[$indexVal]]=array_search($val,$datatemp);
					$indexVal++;
				}
			}
			fclose($handle);
			
			#echo "<pre>"; print_r($dummy_indexVal);
			$retmsg='Failure';
				$coun = 0; $row = 1;				
				$handle = fopen($fileDirectory."/".$file_name,"r");
				if(($data1 = fgetcsv($handle, 10000, ",")) !== FALSE)
				{					
					
						fclose($handle);
						$handle = fopen($fileDirectory."/".$file_name,"r");
						while(($data = fgetcsv($handle, 10000, ",")) !== FALSE){
							if($row == 1){ $row++; continue; }
							$finalImgArr=array();
							$who_made_it 			=  		$data[$dummy_indexVal['type']];
							$what_is_it 			=  		$data[$dummy_indexVal['product_condition']];
							$when_did_you_make_it 	=  		$data[$dummy_indexVal['when_did_you_make_it']];
							$category 				=  		$data[$dummy_indexVal['category']];
							$name					=  		$data[$dummy_indexVal['name']];
							$description 			=  		$data[$dummy_indexVal['description']];
							$image 					=  		$data[$dummy_indexVal['image']];
							$price 					=  		$data[$dummy_indexVal['price']];
							$quantity 				=  		$data[$dummy_indexVal['quantity']];
							$country 				=  		$data[$dummy_indexVal['country']];
							$ship_cost 				=  		$data[$dummy_indexVal['ship_cost']];
							$ship_cost_with_other 	=  		$data[$dummy_indexVal['ship_cost_with_other']];


							$price_range = 0;
							if ($sale_price>0 && $sale_price<21)
								$price_range = '1-20';
							else if ($sale_price>20 && $sale_price<101)
								$price_range = '21-100';
							else if ($sale_price>100 && $sale_price<201)
								$price_range = '101-200';
							else if ($sale_price>200 && $sale_price<501)
								$price_range = '201-500';
							else if ($sale_price>500)
								$price_range = '501+';
							
							if($who_made_it=='handmade'){
								$made_by=1;
							}else if($who_made_it=='vintage'){
								$made_by=2;
							}else if($who_made_it=='craft supply'){
								$made_by=3;
							}else{
								$made_by=1;
							}
							
							if($what_is_it=='finished'){
								$product_condition=1;
							}else if($what_is_it=='unfinished'){
								$product_condition=2;
							}else{
								$product_condition=1;
							}
							
							$maked_on=str_replace('-',',',$when_did_you_make_it);


							$seller_product_id = mktime();
							$checkId = $this->check_product_id($seller_product_id);
							while ($checkId->num_rows()>0){
								$seller_product_id = mktime();
								$checkId = $this->check_product_id($seller_product_id);
							}

							#****----------Move image to server-------------****#

							$image_url = $image;
							
							$imageurlArr=@explode(',',$image);
							foreach($imageurlArr as $image_url){

							$img_data = file_get_contents($image_url);
							if($img_data!=''){
								$img_full_name = substr($image_url, strrpos($image_url, '/')+1);
								$img_name_arr = explode('.', $img_full_name);
								$img_name = $img_name_arr[0];
								$ext = $img_name_arr[1];
								$ext_arr = explode('?', $ext);
								$ext = $ext_arr[0];
								if (!$ext) $ext='jpg';
								$new_name = str_replace(array(',','$','(',')','~','&'), '', $img_name.mktime().'.'.$ext);
								$new_img = 'images/product/temp_img/'.$new_name;
	
								file_put_contents($new_img, $img_data);
	
								#****----------Move image to server-------------****
	
								$image_name = $new_name;
	
								#$this->imageResizeWithSpace(600, 600, $image_name, './images/product/');
								
								@copy('./images/product/temp_img/'.$image_name, './images/product/org-image/'.$image_name);
								@copy('./images/product/temp_img/'.$image_name, './images/product/'.$image_name);
								$this->ImageResizeWithCrop(550, 350, $image_name, './images/product/');
								@copy('./images/product/'.$image_name, './images/product/thumb/'.$image_name);
								$this->ImageResizeWithCrop(175, 150, $image_name, './images/product/thumb/');
								@copy('./images/product/temp_img/'.$image_name, './images/product/list-image/'.$image_name);
								$this->ImageResizeWithCrop(75, 75, $image_name, './images/product/list-image/');
							}else{
								$finalImgArr[]='noimage.jpg';
							}	
								$finalImgArr[]=$image_name;
								}
								
								$finalimage_name = implode(',', $finalImgArr);
							

							$catArr = $this->product_model->get_all_details(CATEGORY,array('cat_name'=>$category));
							if ($catArr->num_rows()>0){
								$category_id_arr = array($catArr->row()->id);
								while ($catArr->row()->rootID>0){
									$catArr = $this->product_model->get_all_details(CATEGORY,array('id'=>$catArr->row()->rootID));
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
							$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->product_model->get_all_details(PRODUCT,array('seourl'=>$seourl));
								if ($duplicate_url->num_rows()>0){
									$seourl = $seourlBase.'-'.$urlCount;
								}else {
									$seourl_check = '1';
								}
							}
							$modifyDate='';
							if($this->checkLogin('U')==1){
								$status='Publish';
								$pay_status='Paid';
							}else{
								$status='UnPublish';
								$pay_status='Pending';
							}
						 	$ship_duration='';
							
							$countryInfos = $this->product_model->get_all_details(COUNTRY_LIST,array('country_code'=>$country),array(array('field'=>'name','type'=>'asc')));
							if($countryInfos->num_rows()>0){
								$country=$countryInfos->row()->name; 
							}else{
								$countryInfos = $this->product_model->get_all_details(COUNTRY_LIST,array('country_code'=>'US'),array(array('field'=>'name','type'=>'asc')));
								$country=$countryInfos->row()->name;
							}
							
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
										'status' => $status, 
										'pay_status' => $pay_status, 
										'seourl' => $seourl,
										'ship_duration' => $ship_duration,
										'ship_from' => $country,
										'user_id' => $this->checkLogin('U')
										);
							
							$this->product_model->simple_insert(PRODUCT,$insertdata);
							$idArr = $this->product_model->get_last_insert_id();
							
							$ship_to = $this->input->post('shipping_to');  
							$ship_to_id = $this->input->post('ship_to_id'); 
							
							$cost_individual = $ship_cost;	
							$cost_with_another = $ship_cost_with_other;
							$shipName=$country;
$shipName='Hong Kong';
							$countryInfo = $this->product_model->get_all_details(COUNTRY_LIST,array('country_code'=>$country),array(array('field'=>'name','type'=>'asc')));
							if($countryInfo->num_rows()>0){
								$shipId=$countryInfo->row()->id; 
							}else{
								$countryInfo = $this->product_model->get_all_details(COUNTRY_LIST,array('country_code'=>'US'),array(array('field'=>'name','type'=>'asc')));
								$shipId=$countryInfo->row()->id;
							}
							
							$seourlBase = $seourl = url_title($shipName, '-', TRUE);
							$seourl_check = '0';
							$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
							if ($duplicate_url->num_rows()>0){
								$seourl = $seourlBase.'-'.$duplicate_url->num_rows();
							}else {
								$seourl_check = '1';
							}
							$urlCount = $duplicate_url->num_rows();
							while ($seourl_check == '0'){
								$urlCount++;
								$duplicate_url = $this->product_model->get_all_details(SUB_SHIPPING,array('ship_seourl'=>$seourl));
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
						 	$this->product_model->simple_insert(SUB_SHIPPING,$dataArrShip);
						 
							$usrdetails = $this->product_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
							if($usrdetails->num_rows()>0)
							{
								$prodCount = $usrdetails->row()->products;
								$prodCount = $prodCount+1;
								$this->product_model->update_details(USERS,array('products'=>$prodCount),array('id'=>$this->checkLogin('U')));
							}

							$row++;
						}
						fclose($handle);
						$retmsg='Success';					

				}
				fclose($handle);
		echo $retmsg;
	}
	public function custom_upload_csv_status($status=''){
		if($status=='Success'){
			$this->setErrorMessage('success','Your csv file is uploaded and the product details are added');
			redirect('shop/sell');
		}else{
			$this->setErrorMessage('error','Your products are not added, please give corresponding values in you file');
			redirect('custom-upload-products');
		}
	}
	
	public function images_resize(){
		echo "############";
//  		$this->thumbimage_resize('images/product/org-image/','images/product/thumb/','245');
//  		$this->thumbimage_resize('images/product/org-image/','images/product/','550');
//  		$this->thumbimage_resize('images/product/org-image/','images/product/list-image/','75');
		$this->thumbimage_resize('images/product/org-image/','images/product/mb/thumb/','350');
		echo "############";
	}
	
	public function images_crop(){
		echo "############";
// 			$this->thumbimage_resize('images/product/org-image/','images/product/cropsmall/','108','92');
// 			$this->thumbimage_resize('images/product/org-image/','images/product/cropmed/','285','215');
// 			$this->thumbimage_resize('images/product/org-image/','images/product/cropthumb/','75','75');
			
// 		if( is_dir('images/product/mb/crop/') ) {
// 			echo "The Directory {$new_path} exists";
// 		}else{
// 			echo "The Directory {$new_path} not exists";
// 			mkdir('images/product/mb/crop/');
// 		}
// 		die;

		$this->thumbimage_resize('images/product/org-image/','images/product/mb/crop/','350','350');
		echo "############";
	}
	
	public function insertShopLatLng(){
		$seller = $this->user_model->get_all_details(SELLER,array());
		$addressArr = array("Bengali Square, Indore, Madhya Pradesh 452016","Kempegowda International Airport, Bengaluru, Karnataka","Madiwala Ayyappa Temple Bus Stop, Hosur Road, Madiwala, Bengaluru, Karnataka","Anna Nagar West Extension, Chennai, Tamil Nadu","Thousand Lights Mosque, Chennai, Tamil Nadu","Ayanavaram Bus Depot, Bangaru Street, Chinna Chembarambakkam, Chennai, Tamil Nadu","Texas Infotech 97, Market Street, Sembium Sembium Chennai, Tamil Nadu 600011","Vyasarpadi Jeeva Railway Station, Perambur Main Road, Binny Garden, Chennai, Tamil Nadu","Villivakkam Bus Stand MTH Road Reddy St Villivakkam, Konnur Chennai, Tamil Nadu 600049","New Delhi Automobile Services, Nigdi, Pimpri-Chinchwad, Maharashtra","Maharashtra Tea House, Nehru Road, Park Society, Mumbai, Mumbai Suburban, Maharashtra","the tamil nadu state apex co operative bank limited near Madipakkam Bus Stop, Madipakkam Road, Madipakkam, Chennai, Tamil Nadu","Argentina Grocery Inc, East Villa Street, Pasadena, CA, United States","Braun Athletic Center, Pasadena, CA, United States","Braata Distributing, Airport Loop Drive, Costa Mesa, CA, United States","Florida Street, Huntington Beach, CA, United States","Los Angeles International Airport, World Way, Los Angeles, CA, United States","University of Houston, Calhoun Road, Houston, TX, United States","Florida Street, Huntington Beach, CA, United States","Kadamba Hotel BMS Bus Stand Near Bangalore University Kengeri Main Rd Bengaluru, Karnataka 560060","Gyana Bharati Complex, Netaji, Subhas Road, Opposite Bangalore University Hostel, Mallathalli Bengaluru, Karnataka 560056","Pantarapalya, Nayanda Halli Bengaluru, Karnataka 560039","100 Feet Ring Road,Banashankari Stage III Banashankari Bengaluru, Karnataka 560085","Plot No. 1, Nelson Manickam Road Survey No. 627, Poonamalee High Road, Aminjikarai Chennai, Tamil Nadu 600029","#5,Victoria Hostel Rd, Chennai, Tamil Nadu 600005 Chepauk, Triplicane Chennai, Tamil Nadu 600005","Corporation School Road 4th Cross Street, Lake Area, Nungambakkam Chennai, Tamil Nadu 600034","Opposite Ram Theater 1st Gaangaiaman Kovil Street Kodambakkam Chennai, Tamil Nadu 600024","No.31, Jawaharlal Nehru Salai, 100ft Road, Vadapalani, Near MMDA Signal Chennai, Tamil Nadu 600026","7th St Anna Nagar West Chennai, Tamil Nadu 600040","TVS 30 Feet Rd Korattur Chennai, Tamil Nadu 600076","Post Baug 11, Ambattur, Near Telephone Exchange Ambattur Ambattur Chennai, Tamil Nadu 600053","151 Texas Mulberry, San Antonio, TX, United States","New Jersey 38, Cherry Hill, NJ, United States","United States Field Hockey, Moorestown, NJ, United States","Frances S. DeMasi Middle School, Evesboro Medford Road, Evesham Township, NJ, United States","france telecom near Castelnau-de-Lévis, France","Cabine France Telecom Le Bourg 81600 Técou France","Italy Europe Tours, Gazzera, Metropolitan City of Venice, Italy","USAA, Fredericksburg Road, San Antonio, TX, United States","texaco near Houston Independent School District, Fulton Meadows Lane, Houston, TX, United States","Texaco Houston, Fulton Street, Houston, TX, United States","Houston Community College, Fulton Street, Houston, TX, United States","Houston Food Bank-Keegan Center Kitchen, Houston","2682 N Fwy Service Rd Houston, TX 77009 USA","University of Houston, Calhoun Road, Houston, TX, United States","Texas 151, San Antonio, TX, United States","Alaska Capital, East Dimond Boulevard, Anchorage, AK, United States","alaska usa federal credit union","Alaska USA West Abbott Road Branch 8475 Hartzell Rd Anchorage, AK 99507 United States","T Nagar Bus Terminus, South Usman Road, T.Nagar, Chennai, Tamil Nadu","The Houstonian Hotel Club And Spa, Chandra Layout, Bengaluru, Karnataka","Consulate General of Argentina, Wilshire Boulevard, Los Angeles, CA, United States","University of Houston, Calhoun Road, Houston, TX, United States","University Club at Irvine 801 E Peltason Dr Irvine, CA 92697 United States","Seattle Aquarium, Alaskan Way, Seattle, WA, United States","Chiricahua National Monument 12856 E Rhyolite Creek Rd Willcox, AZ 85643 United States","MIND Research Institute 111 Academy Drive #100 Irvine, CA 92617 United States","Crevier Classic Cars 365 Clinton St Costa Mesa, CA 92626 United States","Los Angeles International Airport 1 World Way Los Angeles, CA 90045 United States","Costa Mesa Self Storage 3180 Red Hill Ave Costa Mesa, CA 92626 United States");
		if($seller->num_rows()>0){
			foreach($seller->result() as $index => $value){
				shuffle($addressArr);
				$location = $addressArr[0];
				//if($value->shop_location ==''){
					$this->user_model->update_details(SELLER,array('shop_location'=>$location),array('id'=>$value->id));
				//}
			}
			$count=0;
			foreach($seller->result() as $_seller){
				$count++;
				$location = $_seller->shop_location;
				if($location!=''){
					$result = $this->get_lat_long($location);
				}else{
					$address = "Houston Heights, Houston, TX, United States";
					$result = $this->get_lat_long($address);
				}
				$LatLng = array_filter(explode(',', $result));
				$this->user_model->update_details(SELLER,array('latitude'=>$LatLng[0],'longitude'=>$LatLng[1]),array('id'=>$_seller->id));
				if($count > 10){
					$count = 0;
					sleep(5);
				}
			}
		} 
	}
	public function insertProductLatLng(){
		$product = $this->user_model->get_all_details(PRODUCT,array());
		if($product->num_rows()>0){
			$count=0;
			foreach($product->result() as $_product){
				$count++;
				$UserId = $_product->user_id;
				$seller = $this->user_model->get_all_details(SELLER, array('seller_id'=>$UserId));
				if($seller->num_rows()>0){
					$result = $this->get_lat_long($seller->row()->shop_location);
				}else{
					$address = "Houston Heights, Houston, TX, United States";
					$result = $this->get_lat_long($address);
				}
				$LatLng = array_filter(explode(',', $result));
				$this->user_model->update_details(PRODUCT,array('latitude'=>$LatLng[0],'longitude'=>$LatLng[1]),array('id'=>$_product->id)); 
				if($count > 10){
					$count = 0;
					sleep(5);
				}
			}	
		}
	}
	public function get_lat_long($address){
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
		$geo = json_decode($geo, true);
		if($geo['status'] = 'OK') {
		  $latitude = $geo['results'][0]['geometry']['location']['lat'];
		  $longitude = $geo['results'][0]['geometry']['location']['lng'];
		}
		return $latitude.','.$longitude;
	}
	
	
	public function addProductConstraint(){
		$languages = $this->multilanguage_model->get_language_list()->result_array();
		$tablelist = $this->data['mulitiLangTable'];
		
		$table = PRODUCT_EN;
		//$qry1 = "ALTER TABLE ".PRODUCT_EN." ENGINE = InnoDB";
		//$this->multilanguage_model->ExecuteQuery($qry1);
		
// 		$qryCheck = "SHOW CREATE TABLE ".$table ."";
// 		$created = $this->multilanguage_model->ExecuteQuery($qryCheck);
// 		echo "<pre>"; print_r($created->result());
		
		foreach($languages as $lang){
			$ln = $lang['lang_code'];
			
			
			$ln_table = $table."_".$ln;
	
			//$qry2 = "ALTER TABLE ".$ln_table." ENGINE = InnoDB";
			//$this->multilanguage_model->ExecuteQuery($qry2);
			
			
				//$qry3 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `delete_".$ln_table."` FOREIGN KEY (`id`) REFERENCES ".$table." (`id`) ON DELETE CASCADE";
				//$this->multilanguage_model->ExecuteQuery($qry3);
				
				//$qry4 = "ALTER TABLE ".$ln_table." ADD CONSTRAINT `statuschange_".$ln_table."` FOREIGN KEY (status, id) REFERENCES ".$table." (status, id) ON UPDATE CASCADE";
				//$this->multilanguage_model->ExecuteQuery($qry4);
			
			
			if ($this->db->table_exists($ln_table)){
	
				// 		   					$qry3 = "ALTER TABLE ".$ln_table."
				//    						 ADD CONSTRAINT `deleterow_".$ln."` FOREIGN KEY (`id`) REFERENCES `shopsy_category` (`id`) ON DELETE CASCADE";
				// 		   					$this->multilanguage_model->ExecuteQuery($qry3);
					
				//echo $this->db->last_query()."<br>";
				//echo $this->db->last_query()."<br>";
				

			}else{
	
	
	
			}
			
			
			
			$qryCheck = "SHOW CREATE TABLE ".$ln_table ."";
			$created = $this->multilanguage_model->ExecuteQuery($qryCheck);
			echo "<pre>"; print_r($created->result());
			echo "#########################.<br>";
			
		}
	}
	
}
/*End of file product.php */
/* Location: ./application/controllers/site/product.php */