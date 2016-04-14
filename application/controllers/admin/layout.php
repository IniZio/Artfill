<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to Product management
 * @author Teamtweaks
 *
 */

class Layout extends MY_Controller {

	function __construct(){
	
		parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));
		$this->load->model('layout_model');
		if ($this->checkPrivileges('product',$this->privStatus) == FALSE){
			redirect('admin');
		}
	}
	public function add_layout_list(){
		$this->data['heading'] = 'Add Text Layout';
		$this->load->view('admin/layout/add_layout',$this->data);
	}

	public function insertEditLayout(){

		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$this->data['heading'] = 'Display Text Layout';
			$place = $this->input->post('place');
			$text = $this->input->post('text');

			$dataArr = array('place'=>$place,
							'text'=>$text);
			$this->layout_model->simple_insert(LAYOUT,$dataArr);
			$this->data['layoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);
			$this->setErrorMessage('success','Layout Added successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

	public function EditLayout(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {

			$layout_id = $this->input->post('layout_id');
			$condition =array('id'=>$layout_id);
			$text = $this->input->post('text');
			$dataArr = array('text'=>$text);
			$this->data['heading'] = 'Edit Layout List';
			$this->layout_model->update_details(LAYOUT,$dataArr,$condition);
			$this->setErrorMessage('success','Layout Updated successfully');
			redirect('admin/layout/display_layout_list');
		}
	}



	//Change the control options

	public function changecontrol(){
			
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->layout_model->commonInsertUpdate(CONTROLMGMT,'update',array('control_tbl_length','control'),array(),array('id'=>1));
			$this->setErrorMessage('success','Controls updated successfully');
			redirect('admin/layout/display_control_list');
		}
	}

	public function delete_layout(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$id = $this->uri->segment(4,0);
			$condition = array('id' => $product_id);
			$filearr=array("themecss_".$id."Home-page","themecss_".$id."Home-page.css","themecss_".$id."Search-page.css","themecss_".$id."Cart-page.css","themecss_".$id."Product-Detail-page.css","themecss_".$id."Shop-page.css","themecss_".$id."Seller-page.css","themecss_".$id."User-Profile-page.css","themecss_".$id."Favorite-page.css","themecss_".$id."Favorite-Shop-page.css","themecss_".$id."Community-Page.css","themecss_".$id."header.css","themecss_".$id."footer.css");			
			foreach($filearr as $f){
				$path="./theme/".$f;
				if(file_exists ($path)){
					unlink($path);
				}
			}
			$this->layout_model->commonDelete(THEME,array('id'=>$id));			
			$this->setErrorMessage('success','Theme deleted successfully');
			redirect('admin/layout/display_theme_list');
		}
	}
	public function EditviewLayout($id=''){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Edit Text Layout';

			$condition = array('id'=>$id);
			$this->data['EditlayoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);

			$this->load->view('admin/layout/edit_layout',$this->data);

		}
	}

	public function display_layout_list()
	{

		$this->data['heading'] = 'Text Layouts';
		$condition =array();
		$this->data['layoutList'] = $this->layout_model->get_all_details(LAYOUT,$condition);
		//echo $this->$db->last_query(); die;
		$this->load->view('admin/layout/display_layout',$this->data);
	}


	public function display_control_list()
	{


		$this->data['heading'] = 'Control List';
		$this->data['controlList'] = $this->layout_model->view_controller_details();
		//echo $this->$db->last_query(); die;
		//print_r($this->data['controlList']->result()); die;
			
		$this->load->view('admin/layout/display_control',$this->data);
	}
    public function display_theme_list()
	{
	$this->data['heading'] = 'Theme List';
	
    $this->data['theme_list'] = $this->layout_model->get_all_details(THEME,array(),array());
	#print_r($this->data['theme_list']);
	#exit;
	$this->load->view('admin/layout/display_theme_list',$this->data);
	}
	
	public function change_user_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$user_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			if($status == 'Active')
				$this->user_model->update_details(THEME,array('status' => 'Inactive'),array('status' => 'Active'));
			$newdata = array('status' => $status);
			$condition = array('id' => $user_id);
			$this->user_model->update_details(THEME,$newdata,$condition);
			$this->setErrorMessage('success','THEME Status Changed Successfully');
			redirect('admin/layout/display_theme_list');
		}
	}
	public function add_new_theme()
	{
	$this->data['heading'] = 'Add New Theme';
	$this->load->view('admin/layout/add_new_theme',$this->data);
	}
	
	 public function insettheme_data(){
	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		
		$data=array(
		"theme_name"=>$this->input->post('theme_name'),
		"status"=>"Inactive"
		);
		$theme_id=$this->layout_model->add_theme($data);
		#echo $theme_id;
		$condition = array();
		
		$themedetail= $this->user_model->get_all_details(THEME_LAYOUT,$condition);
		
		#print_r($themedetail);
		#exit;
		
		
		
		$config= '<?php ';
		foreach($themedetail->result() as $row){
		
		     #print_r($row);
			 #exit;
			 $key=$row->name;
			 #echo $key;
			 #exit;
			 $value=$row->value;
			
			$config .= "\n\$theme['$key'] = '$value'; ";
			
		}
		
		$config .= ' ?>';
		
		
		
		
		$file = 'theme/theme_'.$theme_id.'.php';
		
		file_put_contents($file, $config);
		#exit;
		redirect("admin/layout/display_theme_list");
		
	}
	}
	public function theme_update()
	{
	#echo "<pre>";
	#print_r($_POST);
	#exit;
	$tot=count($_POST['key']);
	
	$config= '<?php ';
	
	$theme_css='';
	
	for($i=0;$i<$tot;$i++)
	{
		
		     #print_r($row);
			 #exit;
			 $key=$_POST['key'][$i];
			#print_r($key);
			 #exit;
			 $value=$_POST['colorpick'][$i];
			
			$config .= "\n\$theme['$key'] = '$value'; ";
			if($key=="header_bg"&& $value!='')
			{
			$theme_css.="header{background:".$value."!important;}.header_top{background:".$value."!important;}";
			}
			else if($key=="header_searchbox_placeholder" && $value!='')
			{
			$theme_css.=".search-bl input[type='text'] {color:".$value.";}";
			}
			else if($key=="header_searchbox_border_color" && $value!='')
			{
			$theme_css.=".search-bl input[type='text'] {
            border:1px solid ".$value.";}";
			}
			
			else if($key=="header_search_button_bgcolor" && $value!='')
			{
			$theme_css.=".search-bl  .search-bt {

            background:".$value.";}";
			}
			else if($key=="header_search_button_color" && $value!='')
			{
			$theme_css.=".search-bl  .search-bt {
	        color:".$value.";}";
			}
			
			else if($key=="header_search_button_radius_color" && $value!='')
			{
			$theme_css.=".search-bl  .search-bt {
	         border:1px solid ".$value.";}";
			}
			else if($key=="browse_button_color" && $value!='')
			{
			$theme_css.=".act-browse-bt .browse {
	        color:".$value."!important;}";
			}
			else if($key=="browse_button_bgcolor" && $value!='')
			{
			$theme_css.=".act-browse-bt .btn-default {
	        background:".$value.";}";
			}
			else if($key=="browse_button_hoever_bgcolor" && $value!='')
			{
			$theme_css.=".act-browse-bt .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
            background-color:".$value.";}";
			}
			
			else if($key=="browse_button_hoever_color" && $value!='')
			{
			$theme_css.=".act-browse-bt .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
            color:".$value."!important;}";
			}
			
			else if($key=="header_text_color" && $value!='')
			{
			$theme_css.=".signin a
            {
	        color :".$value."!important;}.icon-text
            {
            color :".$value."!important;}";
			}
			else if($key=="signin_button_bgcolor" && $value!='')
			{
			$theme_css.=".signin .btn
            {
	        background-color:".$value."!important;}";
			}
			else if($key=="signin_button_color" && $value!='')
			{
			$theme_css.="           
	        .signin .btn a
            {
            color:".$value."!important;}";
	        }
			else if($key=="cart_notification_bgcolor" && $value!='')
			{
			$theme_css.=".shop-cart #CartCount1
            {
	         background-color:".$value.";}";
	        }
			else if($key=="cart_notification_color" && $value!='')
			{
			$theme_css.=".shop-cart #CartCount1
            {
	        color:".$value.";}";
	        }
			else if($key=="subcriber_head_color" && $value!='')
			{
			$theme_css.=".get-pro
            {
	        color: ".$value.";}";
	        }
			else if($key=="subscriber_place_holder_color" && $value!='')
			{
			$theme_css.="#emailtext 
            {
	        color:".$value.";}";
	        }
			else if($key=="subscriber_button_color" && $value!='')
			{
			$theme_css.=".subcribe-box .subscribe-form  .search-bt
            {
	        background:".$value."!important;}";
	        }
			else if($key=="subscriber_font_color" && $value!='')
			{
			$theme_css.=".subcribe-box .subscribe-form .search-bt
            {
	         color:".$value.";}";
	        }
			else if($key=="subscriber_radius_color" && $value!='')
			{
			$theme_css.=".subcribe-box .subscribe-form .search-bt
            {
	         border:1px solid ".$value.";}";
	        }
			else if($key=="footer_bg_color" && $value!='')
			{
			$theme_css.=".foot-bg
            {
	         background:none repeat scroll 0 0 ".$value."!important;}";
	        }
			else if($key=="footer_head_color" && $value!='')
			{
			$theme_css.=".footer-head
            {
            color:".$value."!important;}";
	        }
			else if($key=="footer-list_color" && $value!='')
			{
			$theme_css.=".footer-list li a
            {
	         color: ".$value."!important;}";
	        }
			else if($key=="language_color" && $value!='')
			{
			$theme_css.=".locale-settings li a
            {
	         color:".$value."!important;}";
	        }
			else if($key=="help_color" && $value!='')
			{
			$theme_css.=".help-bt
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="help_bg_color" && $value!='')
			{
			$theme_css.=".help-bt
            {
	         background-color:".$value."!important;}";
	        }
			else if($key=="copy_right_color" && $value!='')
			{
			$theme_css.=".bt-menu li 
            {
	        color:".$value."!important;}.bt-menu li a
           {
	        color:".$value."!important;}";
	        }
			else if($key=="open_shop_color" && $value!='')
			{
			$theme_css.=".footer-block a .op-bt
            {
	         color: ".$value."!important;}";
	        }
			else if($key=="open_shop_bgcolor" && $value!='')
			{
			$theme_css.=".footer-block a .op-bt
            {
	        background:".$value."!important;}";
	        }
			else if($key=="recent_favourite_banner_bgcolor" && $value!='')
			{
			$theme_css.=".image-credit-wrap
            {
	         background:".$value."!important;}";
	        }
			else if($key=="recent_favourite_color" && $value!='')
			{
			$theme_css.=".image-credit-wrap
            {
	        color:".$value."!important;}";
	        }
			else if($key=="banner_text_color" && $value!='')
			{
			$theme_css.=".hero-in .container .col-md-5
            {
	        color:".$value."!important;}";
	        }
			else if($key=="recent_fav_head_color" && $value!='')
			{
			$theme_css.="#recent
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="recent_fav_subhead_color" && $value!='')
			{
			$theme_css.="#recentsub
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="recent_fav_area_bgcolor" && $value!='')
			{
			$theme_css.="#recentdiv
            {
	         background-color:".$value."!important;}";
	        }
			else if($key=="cat_name" && $value!='')
			{
			$theme_css.=".cat-name a
            {
	        color:".$value."!important;}";
	        }
			else if($key=="price_color" && $value!='')
			{
			$theme_css.=".cat-price a
           {
	        color:".$value."!important;}";
	        }
			else if($key=="shop_name_color" && $value!='')
			{
			$theme_css.=".recent-right p
            {
	        color:".$value."!important;}";
	        }
			else if($key=="reviews_count_color" && $value!='')
			{
			$theme_css.=".review-txt
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="recent_div_inner_bgcolor" && $value!='')
			{
			$theme_css.=".rf-bl
            {
	         background-color: ".$value."!important;}";
	        }
			else if($key=="community_head_color" && $value!='')
			{
			$theme_css.="#community
             {
	         color:".$value."!important;}";
	        }
			else if($key=="community_subhead_color" && $value!='')
			{
			$theme_css.="#subcommunity
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="community_user_name_color" && $value!='')
			{
			$theme_css.=".ct-txt h3
            {
	        color:".$value."!important;}";
	        }
			else if($key=="community_count_color" && $value!='')
			{
			$theme_css.=".ct-txt p
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="community_div_bgcolor" && $value!='')
			{
			$theme_css.="#communitydiv
            {
	         background-color: ".$value."!important;}";
	        }
			else if($key=="community_div_innerbgcolor" && $value!='')
			{
			$theme_css.=".ct-block-cover
            {
	        background-color:".$value."!important;}";
	        }
			else if($key=="subscriber_div" && $value!='')
			{
			$theme_css.="#subscriberdiv
            {
	          background-color:".$value."!important;}";
	        }
			else if($key=="regional-setting-bgcolor" && $value!='')
			{
			$theme_css.=".regional-setting
            {
	         background-color: ".$value."!important;}";
	        }
			else if($key=="regional-setting-color" && $value!='')
			{
			$theme_css.=".regional-setting-left
            {
	         color:".$value."!important;}";
	        }
			else if($key=="prod_detail_shop_name" && $value!='')
			{
			$theme_css.=".shop-txt
            {
	        color: ".$value."!important;}.shop-name a{
            color:".$value."!important;}";
	        }
			else if($key=="favorite_shop_bgcolor" && $value!='')
			{
			$theme_css.=".btn-secondary
            {
	         background:".$value."!important;}";
	        }
			else if($key=="favorite_shop_color" && $value!='')
			{
			$theme_css.=".btn-secondary
            {
	        color:".$value."!important;}.btn-secondary a
            {
	        color:".$value."!important;}";
	        }
			else if($key=="shop_item_count_color" && $value!='')
			{
			$theme_css.=".rf-small a .listing-count
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="product_favouritehead_bgcolor" && $value!='')
			{
			$theme_css.=".favorites-nag
            {
	         background-color:".$value."!important;}";
	        }
			else if($key=="product_favouritehead_color" && $value!='')
			{
			$theme_css.=".nag-message h2
            {
	        color:".$value."!important;}.nag-message 
            {
	        color:".$value."!important;}";
	        }
			else if($key=="product_name_color" && $value!='')
			{
			$theme_css.=".listing-page-cart-inner h1
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="product_cost_color" && $value!='')
			{
			$theme_css.=".listing-page-cart-inner .cart-price
            {
	        color:".$value."!important;}";
	        }
			else if($key=="Quantity_color" && $value!='')
			{
			$theme_css.=".price_left label
            {
	        color:".$value."!important;}";
	        }
			else if($key=="Overview_color" && $value!='')
			{
			$theme_css.="#item-overview h3
            {
	         color:".$value."!important;}";
	        }
			else if($key=="overview_properties_color" && $value!='')
			{
			$theme_css.=".properties li
            {
	        color: ".$value."!important;}";
	        }
			else if($key=="add_to_cart_bgcolor" && $value!='')
			{
			$theme_css.="#add_to_cart
            {
	         background:".$value."!important;}";
	        }
			else if($key=="inner_cart_bgcolor" && $value!='')
			{
			$theme_css.=".listing-page-cart 
            {
	        background-color:".$value."!important;}";
	        }
			else if($key=="add_to_cart_color" && $value!='')
			{
			$theme_css.="#add_to_cart
            {
	        color:".$value."!important;}";
	        }
			else if($key=="add_to_cart_border_color" && $value!='')
			{
			$theme_css.="#add_to_cart
            {
	         border-color: ".$value."!important;}";
	        }
			else if($key=="favoutite_box_bgcolor" && $value!='')
			{
			$theme_css.="#favoriting-and-sharing
            {
	        background-color: ".$value."!important;}";
	        }
			else if($key=="related_listing_bgcolor" && $value!='')
			{
			$theme_css.=".related-listings
            {
	        background-color: ".$value."!important;}";
	        }
			else if($key=="related_listing_locationcolor" && $value!='')
			{
			$theme_css.=".ship-label
            {
	        color:".$value."!important;}";
	        }
			else if($key=="related_product_name_color" && $value!='')
			{
			$theme_css.=".info h3 a
             {
	         color: ".$value."!important;}";
	        }
			else if($key=="releated_cost_color" && $value!='')
			{
			$theme_css.=".info .cat-price
{
	color: ".$value."!important;}";
	        }
			else if($key=="active_tab_bgcolor" && $value!='')
			{
			$theme_css.=".nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
background:".$value."}";
	        }
			else if($key=="active_tab_color" && $value!='')
			{
			$theme_css.=".nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
color:".$value."!important;}";
	        }
			else if($key=="inactive_tab_bgcolor" && $value!='')
			{
			$theme_css.=".cart-tabs > li > a
            {
             background:".$value.";}";
	        }
			else if($key=="inactive_tab_color" && $value!='')
			{
			$theme_css.=".cart-tabs > li > a
            {
            color:".$value.";}";
	        }
			else if($key=="tab_hover_bgcolor" && $value!='')
			{
			$theme_css.=".nav > li > a:hover, .nav > li > a:focus
            {
             background-color:".$value."!important;}";
	        }
			else if($key=="itemdetail_color" && $value!='')
			{
			$theme_css.="#description-text
            {
            color:".$value."!important;}";
	        }
			else if($key=="payment_head_color" && $value!='')
			{
			$theme_css.=".processing-time
 {
color:".$value."!important;}";
	        }
			
			else if($key=="shipping_cost_policy_header_color" && $value!='')
			{
			$theme_css.=".estimate-shipping-title
{
color:".$value."!important;border-bottom: 1px solid ".$value."!important;}";
	        }
			else if($key=="shipping_cost_table_header_color" && $value!='')
			{
			$theme_css.=".tabbled .column-headers
{
color:".$value."!important;}";
	        }
			else if($key=="table_border_color_ship_policy" && $value!='')
			{
			$theme_css.=".list-table th, .list-table td 
{
 border-bottom: 1px solid ".$value."!important;}";
	        }
			else if($key=="ship_table_td_Color" && $value!='')
			{
			$theme_css.=".shipping .shipping-area{
   color:".$value."!important;}.shipping .shipping-value{
   color:".$value."!important;}";
	        }
			else if($key=="policy_color" && $value!='')
			{
			$theme_css.="#shop-policies .shipping .shipping-destination{
   color:".$value."!important;}#shop-policies .shipping .shipping-amount {
   color:".$value."!important;}";
	        }
			else if($key=="listed_on_report_color" && $value!='')
			{
			$theme_css.="#fineprint .clear li{
             color:".$value."!important;}#reporter-link-container a 
             {
             color:".$value."!important;}";
	        }
			else if($key=="favourite_tot_color" && $value!='')
			{
			$theme_css.="#fineprint .clear li a{
            color:".$value."!important;}";
	        }
			else if($key=="product_div_area" && $value!='')
			{
			$theme_css.=".content-seller{
   border:1px solid ".$value."!important;}";
	        }
			else if($key=="search_title_color" && $value!='')
			{
			$theme_css.=".standardized_filters .selected a{
           color:".$value."!important;}.shop-in li a{
           color:".$value."!important;}.input-group a{
            color:".$value."!important;}.categories li a{
            color:".$value."!important;}.shop-in li a
            {
            color:".$value."!important;}.changeable 
            {
            color:".$value."!important;}";
	        }
			else if($key=="catgory_filter_color" && $value!='')
			{
			$theme_css.=".input-group a{
            color:".$value."!important;}.categories li a{
            color:".$value."!important;}.shop-in li a
            {
            color:".$value."!important;}";
	        }
			else if($key=="search_product_title_color" && $value!='')
			{
			$theme_css.=".product_title a
            {
            color:".$value."!important;}";
	        }
			else if($key=="search_shop_title_color" && $value!='')
			{
			$theme_css.="#search_results .product_maker a
{
color:".$value."!important;}";
	        }
			else if($key=="search_cost_color" && $value!='')
			{
			$theme_css.=".product_price .currency_value 
{
color:".$value."!important;} .product_price .currency_code 
{
color:".$value."!important;}";
	        }
			else if($key=="search_item_count_color" && $value!='')
			{
			$theme_css.=".search-restrictions  
            {
            color:".$value."!important;}";
	        }
			else if($key=="search_by_color" && $value!='')
			{
			$theme_css.=".sort-options label 
            {
            color:".$value."!important;}";
	        }
			else if($key=="price_input_box_bordercolor" && $value!='')
			{
			$theme_css.="#price-editor .price-input 
 {
border:1px solid ".$value."!important;}";
	        }
			else if($key=="price_input_box_color" && $value!='')
			{
			$theme_css.="#price-editor .price-input
           {
            color:".$value."!important;}";
	        }
			else if($key=="price_range_button_color" && $value!='')
			{
			$theme_css.="#priceRangeButton
{
color:".$value."!important;}";
	        }
			else if($key=="price_button_bgcolor" && $value!='')
			{
			$theme_css.="#priceRangeButton
{
background:".$value."!important;}";
	        }
			else if($key=="price_button_bordercolor" && $value!='')
			{
			$theme_css.="#priceRangeButton
            {
             border-color:1px solid ".$value."!important;}";
	        }
			else if($key=="cart_title_color" && $value!='')
			{
			$theme_css.=".s-cart h1
{
color:".$value."!important;}.s-cart div h1{
color:".$value."!important;}";
	        }
			else if($key=="cart_head_color" && $value!='')
			{
			$theme_css.=".s-cart-bl-header h2
{
color:".$value."!important;}.shop-name1
{
color:".$value."!important;}";
	        }
			else if($key=="cart_head_shop_color" && $value!='')
			{
			$theme_css.=".s-cart-bl-header h2 a
{
color:".$value."!important;}";
	        }
			else if($key=="cart_head_bg_color" && $value!='')
			{
			$theme_css.=".s-cart-bl-header
            {
           background-color:".$value."!important;}.cart_items h2
          {
          background-color:".$value."!important;}";
	       }
		   else if($key=="cart_keep_shopping_bgcolor" && $value!='')
			{
			$theme_css.=".s-cart-button
             {
             background:".$value."!important;}.s-cart-button
             {
              background:".$value."!important;}";
	       }
		   else if($key=="cart_keep_shopping_color" && $value!='')
			{
			$theme_css.=".s-cart-button
{
color:".$value."!important;}";
	       }
		   else if($key=="proceed_to_checkout_color" && $value!='')
			{
			$theme_css.="#button-submit-merchant
{
color:".$value."!important;}";
	       }
		    else if($key=="proceed_to_checkout_bgcolor" && $value!='')
			{
			$theme_css.="#button-submit-merchant
        {
           background-color:".$value."!important;}";
	       }
		   else if($key=="cart_product_name_color" && $value!='')
			{
			$theme_css.=".s-item-details-right h3 a
           {
           color:".$value."!important;}";
	       }
		    else if($key=="cart_product_quantity_color" && $value!='')
			{
			$theme_css.=".s-quality
{
color:".$value."!important;}.s-actions li a
{
color:".$value."!important;}";
	       }
		   else if($key=="cart_ship_howto_pay_order_tot_color" && $value!='')
			{
			$theme_css.=".order-summay p
{
color:".$value."!important;}.order-payment h4
{
color:".$value."!important;}.grand-total
{
color:".$value."!important;}.monetary
{
color:".$value."!important;}";
	       }
		    else if($key=="cart_item_detail_color" && $value!='')
			{
			$theme_css.=".payment-total
{
color:".$value."!important;}";
	       }
		   else if($key=="after_home_your_feed_color" && $value!='')
			{
			$theme_css.=".feed-heading h1
{
color:".$value."!important;}";
	       }
		   else if($key=="after_login_bgcolor" && $value!='')
			{
			$theme_css.=".content-wrap
{
background-color:".$value."!important;}";
	       }
		   else if($key=="after_login_title_color" && $value!='')
			{
			$theme_css.=".trending-item h3
{
color:".$value."!important;}.gift-box h3{
color:".$value."!important;}.browse-ca h3
{
color:".$value."!important;}.blog h3
{
color:".$value."!important;}.post-title a{
color:".$value."!important;}.finds h3
{
color:".$value."!important;}.side-section h3
{
color:".$value."!important;}";
	       }
		   else if($key=="after_login_product_shop" && $value!='')
			{
			$theme_css.=".branding h3 a
        {
color:".$value."!important;}.listing-meta a{
color:".$value."!important;}";
	       }
		   else if($key=="after_login_cost_color" && $value!='')
			{
			$theme_css.=".currency-symbol
            {
            color:".$value."!important;}.currency-value
            {
            color:".$value."!important;}";
	       }
		   else if($key=="after_login_category_readmore_color" && $value!='')
			{
			$theme_css.=".promotional a
          {
     color:".$value."!important;}.blog h3 a{
color:".$value."!important;}.post-link
{
color:".$value."!important;}.ways-to-shop li a 
{
color:".$value."!important;}.poster-title a{
color:".$value."!important;}";
	       }
		   else if($key=="after_subscribe_buttonbg" && $value!='')
			{
			$theme_css.=".finds .btn-secondary
{
background:".$value."!important;}";
	       }
		   else if($key=="after_subscribe_color" && $value!='')
			{
			$theme_css.=".finds .btn-secondary
{
color:".$value."!important;}";
	       }
		   else if($key=="one_of_most_bgcolor" && $value!='')
			{
			$theme_css.=".context 
{
background:".$value."!important;}";
	       }
		   else if($key=="one_of_most_color" && $value!='')
			{
			$theme_css.=".context
            {
            color:".$value."!important;}";
	        }
			else if($key=="favorites_title_color" && $value!='')
			{
			$theme_css.=".avatar_menu span
            {
            color:".$value."!important;}";
	        }
			else if($key=="favorites_subtitle_color" && $value!='')
			{
			$theme_css.=".top_list a 
           {
          color:".$value."!important;}.collection_fav li p
          {
           color:".$value."!important;}.fav-detail h3{
           color:".$value."!important;}";
	        }
			else if($key=="favorites_follower_bgcolor" && $value!='')
			{
			$theme_css.=".owner-fav li a
            {
            background:".$value."!important;}";
	        }
			else if($key=="favorites_follower_color" && $value!='')
			{
			$theme_css.=".owner-fav li a span
            {
                color:".$value."!important;}";
	        }
			else if($key=="favorites_page_selected_color" && $value!='')
			{
			$theme_css.=".first_list_seleted  a 
             {
              color:".$value."!important;}";
	        }
			else if($key=="favorites_page_selected_bgcolor" && $value!='')
			{
			$theme_css.=".first_list_seleted  
            {
             background:".$value."!important;}";
	        }
			else if($key=="favorite_page_unselected_tab_color" && $value!='')
			{
			$theme_css.=".first_list2 
{
background:".$value."!important;}.first_list3 
{
background:".$value."!important;}";
	        }
			else if($key=="favorite_page_unselected_tab_bgcolor" && $value!='')
			{
			$theme_css.=".first_list2  a 
{
color:".$value."!important;}.first_list3  a 
{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_welcome_text_color" && $value!='')
			{
			$theme_css.=".top-warnig h3
{
color:".$value."!important;}.top-warnig p strong
{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_heading_side_link_color" && $value!='')
			{
			$theme_css.=".top-warnig a
{
color:".$value."!important;}.header_topright li a
{
color:".$value."!important;}.shopview_info a
{
color:".$value."!important;}.header_topright li a
{
color:".$value."!important;}.shop_name1_left a
{
color:".$value."!important;}.listing-thumb{
color:".$value."!important;}.shop_name2 a
{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_sub_text" && $value!='')
			{
			$theme_css.=".shop_name1_left span
{
color:".$value."!important;}.top-warnig p 
{
color:".$value."!important;}.shop_name2 span{
color:".$value."!important;}.new-user
{
color:".$value."!important;}.shopview_info label{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_product_color" && $value!='')
			{
			$theme_css.=".headline{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_cost_color" && $value!='')
			{
			$theme_css.=".listing-price span{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_head_color" && $value!='')
			{
			$theme_css.=".name-inner{
color:".$value."!important;}.add_steps li a
{
color:".$value."!important;}";
	        }
			else if($key=="shop_sell_head_bgcolor" && $value!='')
			{
			$theme_css.=".add_shop {
background:".$value.";}.add_steps {
background:".$value.";}";
	        }
			else if($key=="shop_sell_shopinfo_bgcolor" && $value!='')
			{
			$theme_css.=".W96{
background:".$value."!important;}";
	        }
			else if($key=="shop_name_head_Color" && $value!='')
			{
			$theme_css.=".shop_title{
color:".$value."!important;}";
	        }
			else if($key=="shop_name_head_subtext" && $value!='')
			{
			$theme_css.=".shop_details p{
color:".$value."!important;}.note
{
color:".$value."!important;}";
	        }
			else if($key=="shop_name_button_bgcolor" && $value!='')
			{
			$theme_css.="#save-btn{
background:".$value."!important;}#save_b
{
background:".$value."!important;}.tagBox-add-tag
{
background:".$value."!important;}#btnAdd
{
background:".$value."!important;}.btn_save_bill
{
background:".$value."!important;}#profile_submit
{
background:".$value."!important;}";
	        }
			else if($key=="shop_name__button_color" && $value!='')
			{
			$theme_css.="#profile_submit
{
color:".$value."!important;}#save-btn{
color:".$value."!important;}.tagBox-add-tag
{
background:".$value."!important;}#save_b
{
color:".$value."!important;}.tagBox-add-tag
{
color:".$value."!important;}#btnAdd
{
color:".$value."!important;}.btn_save_bill
{
color:".$value."!important;}";
	        }
			else if(trim($key)=="shop_list_head_Color" && $value!='')
			{
			$theme_css.="h4 {
            color:".$value."!important;}";
	        }
			else if($key=="shop_list_sub_color" && $value!='')
			{
			$theme_css.=".list_inner_fields label{
color:".$value."!important;}";
	        }
			else if($key=="shop_list_description_color" && $value!='')
			{
			$theme_css.=".list_inner_right  p{
color:".$value."!important;}.list_div p{
color:".$value."!important;}";
	        }
			else if($key=="shop_manage_list_head_color" && $value!='')
			{
			$theme_css.=".manage-listing-heading h1{
color:".$value."!important;}";
	        }
			else if($key=="shop_manage_list_subtext_color" && $value!='')
			{
			$theme_css.=".manage-listing-heading {
            color:".$value."!important;}.tab_form_list_table td{
            color:".$value."!important;}";
	        }
			else if($key=="shop_manage_list_product_color" && $value!='')
			{
			$theme_css.=".center-text div a{
            color:".$value."!important;}";
	        }
			else if($key=="shop_manage_list_table_bgcolor" && $value!='')
			{
			$theme_css.=".table-header{
            background:".$value."!important;}.list-heading
{
background:".$value."!important;}.list-display
{
background:".$value."!important;}.styleback td .shuffle
{
background:".$value."!important;}";
	        }
			else if($key=="shop_manage_list_table_color" && $value!='')
			{
			$theme_css.=".table-header{
          color:".$value."!important;}.list-heading
         {
          color:".$value."!important;}.list-display
        {
          color:".$value."!important;}";
	        }
			else if($key=="shop_payment_subtext_color" && $value!='')
			{
			$theme_css.=".list_inner_fields div{
color:".$value."!important;}.list-heading
         {
          color:".$value."!important;}.payment_div p{
color:".$value."!important;}.payment_check label{
color:".$value."!important;}.Authorize label{
 color:".$value."!important;}";
	        }
			else if($key=="shop_payment_subtitle_color" && $value!='')
			{
			$theme_css.=".payment_div h2{
color:".$value."!important;}";
	        }
			else if($key=="view_profile_home_side_head_color" && $value!='')
			{
			$theme_css.=".side_bar ul li a{
color:".$value."!important;}";
	        }
			else if($key=="view_profile_home_head_color" && $value!='')
			{
			$theme_css.=".split_prefile h2{
            color:".$value."!important;}";
	        }
			else if($key=="view_profile_home_sidebar_bgcolor" && $value!='')
			{
			$theme_css.=".side_bar{
            background:".$value."!important;}";
	        }
			else if($key=="view_profile_home_page_detail" && $value!='')
			{
			$theme_css.=".profile-module  {
            color:".$value."!important;}.extra li{
            color:".$value."!important;}";
	        }
			else if($key=="view_profile_home_page_edit_button_color" && $value!='')
			{
			$theme_css.=".split_prefile  a{
            color:".$value."!important;}";
	        }
			else if($key=="view_profile_home_page_edit_button_bgcolor" && $value!='')
			{
			$theme_css.=".split_prefile  a {
             background:".$value."!important;}";
	        }
			else if($key=="follower_page_tab_selected_color" && $value!='')
			{
			$theme_css.=".tab_model .selected a{
             color:".$value."!important;}";
	        }
			else if($key=="follower_page_tab_selected_bgcolor" && $value!='')
			{
			$theme_css.=".tab_model .selected{
             background:".$value."!important;}";
	        }
			else if($key=="activity_page_product_color" && $value!='')
			{
			$theme_css.=".product-dtl{
color:".$value."!important;}.activity-name
{
color:".$value."!important;}";
	        }
			else if($key=="purchases_head_bgcolor" && $value!='')
			{
			$theme_css.=".property_header{
background:".$value."!important;}";
	        }
			else if($key=="purchases_head_sub_color" && $value!='')
			{
			$theme_css.=".property_header p{
            color:".$value."!important;}.order_text
			{
			color:".$value."!important;
			}
			.trans_text
			{
			color:".$value."!important;
			}
			";
	        }
			else if($key=="purchases_shopt_text_color" && $value!='')
			{
			$theme_css.=".names-it a{
            color:".$value."!important;}.order_text-number
			{
			color:".$value."!important;
			}.tranr_text-number
			{
			color:".$value."!important;
			}
			.amt_text-number
			{
			color:".$value."!important;
			}
			";
	        }
			else if($key=="purchases_button_color" && $value!='')
			{
			$theme_css.=".property_left .button_view{
            color:".$value."!important;}.property_left .button_view2
			{
			color:".$value."!important;
			}
			";
	        }
			else if($key=="purchases_button_bgcolor" && $value!='')
			{
			$theme_css.=".property_left .button_view{
            background:".$value."!important;}.property_left .button_view2
			{
			background:".$value."!important;
			}
			";
	        }
			else if($key=="community_page_head_color" && $value!='')
			{
			$theme_css.=".heading{
            color:".$value."!important;}";
	        }
			else if($key=="community_page_head_active_bgcolor" && $value!='')
			{
			$theme_css.=".heading{
background:".$value."!important;}.menu_links .active{
background:".$value."!important;}";
	        }
			else if($key=="community_page_inactive_color" && $value!='')
			{
			$theme_css.=".menu_links li a{
            color:".$value."!important;}";
	        }
			else if($key=="community_page_inactive_bgcolor" && $value!='')
			{
			$theme_css.=".menu_links li{
             background:".$value."!important;}";
	        }
			else if($key=="community_page_tabletitle_color" && $value!='')
			{
			$theme_css.=".property_table td
{
color:".$value."!important;}";
	        }
			else if($key=="community_page_tablehead_bgcolor" && $value!='')
			{
			$theme_css.="#property_table thead tr{
background:".$value."!important;}#comment_table thead tr{
background:".$value."!important;}";
	        }
			else if($key=="community_page_button_bgcolor" && $value!='')
			{
			$theme_css.=".btn-danger{
background:".$value."!important;}.btn-warning
{background:".$value."!important;}.btn-success 
{
background:".$value."!important;}.dataTables_wrapper .paginate_button
{
background:".$value."!important;}";
	        }
			else if($key=="public_profile_page_sub_text" && $value!='')
			{
			$theme_css.=".split_prefile p{
color:".$value."!important;}";
	      }
		  else if($key=="public_profile_sub_title" && $value!='')
			{
			$theme_css.=".profile_field label{
color:".$value."!important;}
.text_profi{
color:".$value."!important;
}
.text_arrow p{
color:".$value."!important;
}

";
	      }
		  else if($key=="account_setting_page_title_color" && $value!='')
			{
			$theme_css.=".heading_account{
color:".$value."!important;}";
	      }
		   else if($key=="account_setting_page_head_bgcolor" && $value!='')
			{
			$theme_css.=".heading_account{
background:".$value."!important;}";
	       }
		   else if($key=="account_setting_page_activetab_bgcolor" && $value!='')
			{
			$theme_css.=".secondary-tabs li.active a, .secondary-tabs li a.active, .secondary-tabs li.ui-state-active a, .secondary-tabs li a.ui-state-active{
background:".$value."!important;}";
	       }
		    else if($key=="account_setting_page_activetab_color" && $value!='')
			{
			$theme_css.=".secondary-tabs li.active a, .secondary-tabs li a.active, .secondary-tabs li.ui-state-active a, .secondary-tabs li a.ui-state-active{
color:".$value."!important;}";
	       }
		   else if($key=="account_setting_page_inactivetab_bgcolor" && $value!='')
			{
			$theme_css.=".secondary-tabs li a{
background:".$value."!important;}";
	       }
		    else if($key=="account_setting_page_inactivetab_color" && $value!='')
			{
			$theme_css.=".secondary-tabs li a{
color:".$value."!important;}";
	       }
		  else if($key=="setting_page_field_label_color" && $value!='')
			{
			$theme_css.=".field_account label{
color:".$value."!important;}.shipping_field label{
color:".$value."!important;}.credit_field label{
color:".$value."!important;}";
	      }
		   else if($key=="setting_page_button_bgcolor" && $value!='')
			{
			$theme_css.=".password_btn{
background:".$value."!important;}";
	      }
		   else if($key=="settings_button_color" && $value!='')
			{
			$theme_css.=".password_btn{
color:".$value."!important;}";
	      }
		  else if($key=="community_page_banner_title_color" && $value!='')
			{
			$theme_css.=".panel_inner h1{
color:".$value."!important;}.comm_slider span{
color:".$value."!important;}.story_slider span{
color:".$value."!important;}";
	      }
		  else if($key=="community_page_link_color" && $value!='')
			{
			$theme_css.=".panel_inner a{
color:".$value."!important;}.social li a{
color:".$value."!important;}.comm_slider a{
color:".$value."!important;}";
	      }
		  else if($key=="community_page_description_color" && $value!='')
			{
			$theme_css.=".panel_inner p{
color:".$value."!important;}";
	      }
		  else if($key=="community_page_stories_color" && $value!='')
			{
			$theme_css.=".prot_tex{
color:".$value."!important;}";
	      }
		    else if($key=="event_page_title_color" && $value!='')
			{
			$theme_css.=".spl_head{
color:".$value."!important;}.panel_inner b{
color:".$value."!important;}.event_list_right1 span{
color:".$value."!important;}";
	      }
		   else if($key=="event_page_subtitle_color" && $value!='')
			{
			$theme_css.=".event_head{
color:".$value."!important;}";
	      }
		  else if($key=="event_page_decription_color" && $value!='')
			{
			$theme_css.=".special_event_right p{
color:".$value."!important;}.event_list_right1 p{
color:".$value."!important;}";
	      }
		   else if($key=="event_page_button_color" && $value!='')
			{
			$theme_css.=".asubscribe_btn{
color:".$value."!important;}.subscribe_btn {
color:".$value."!important;}";
	      }
		  else if($key=="event_page_button_bgcolor" && $value!='')
			{
			$theme_css.=".asubscribe_btn {
background:".$value."!important;}.subscribe_btn {
background:".$value."!important;}";
	      }
		  else if($key=="event_page_year_month_color" && $value!='')
			{
			$theme_css.=".event_list_left p {
color:".$value."!important;}";
	      }
		   else if($key=="event_page_info_color" && $value!='')
			{
			$theme_css.=".event_list_left1  {
color:".$value."!important;}.event_time
{
color:".$value."!important;}";
	      }
		  else if($key=="team_page_title_color" && $value!='')
			{
			$theme_css.=".community_right  h2{
color:".$value."!important;}";
	      }
		  else if($key=="team_page_subtitle_color" && $value!='')
			{
			$theme_css.=".team_info  a h2{
             color:".$value."!important;}";
	      }
		  else if($key=="teampage_description_color" && $value!='')
			{
			$theme_css.=".team_info  p{
         color:".$value."!important;}";
	      }
		  else if($key=="teampage_member_count" && $value!='')
			{
			$theme_css.=".team_member  p a{
          color:".$value."!important;}";
	      }
		  else if($key=="browse_page_title_color" && $value!='')
			{
			$theme_css.=".treasury-headline  h3{
           color:".$value."!important;}";
	      }
		  else if($key=="browse_page_link_color" && $value!='')
			{
			$theme_css.=".fav-item-name  {
             color:".$value."!important;}.fav_min_text a{
             color:".$value."!important;}.seller-inner
{
color:".$value."!important;}";
	      }
		   else if($key=="browse_page_shop_owner_color" && $value!='')
			{
			$theme_css.=".fav_min_text  span{
            color:".$value."!important;}";
	      }
		  else if($key=="browse_page_shop_count_color" && $value!='')
			{
			$theme_css.=".count-number{
color:".$value."!important;}";
	      }
		  else if($key=="gift_title_color" && $value!='')
			{
			$theme_css.=".currency_head span{
color".$value."!important;}";
	      }
		  else if($key=="gift_field_color" && $value!='')
			{
			$theme_css.=".to_mail{
color:".$value."!important;}.from 
{
color:".$value."!important;}.to{
color:".$value."!important;}.text__area label
{
color:".$value."!important;}.to_rmail
{
color:".$value."!important;}";
	      }
			 else if($key=="gift_button_color" && $value!='')
			{
			$theme_css.=".dolar-symbol 
{
color:".$value."!important;}.dolar-value
{
color:".$value."!important;}.dolar-code
{color:".$value."!important;}";
	      }
		  else if($key=="gift_buttonbg_color" && $value!='')
			{
			$theme_css.="curency_button li
{
background:".$value."!important;}";
	      }
		   else if($key=="gift_description_color" && $value!='')
			{
			$theme_css.=".foot_text span
{
color:".$value."!important;}.foot_text label
{
color:".$value."!important;}";
	      }
		  else if($key=="resgistry_page_title_color" && $value!='')
			{
			$theme_css.="#feed-header
{
color:".$value."!important;}";
	      }
		  else if($key=="resgistry_page_sub_title_color" && $value!='')
			{
			$theme_css.=".list-header h3{
color:".$value."!important;}";
	      }
		  else if($key=="resgitry_head_bgcolor" && $value!='')
			{
			$theme_css.=".registary_top {
background:".$value."!important;}";
	      }
		   else if($key=="resgitry_head_color" && $value!='')
			{
			$theme_css.=".registary_top {
color:".$value."!important;}";
	      }
		  else if($key=="registry_subhead_bgcolor" && $value!='')
			{
			$theme_css.=".registery-left .registary_list .list-header {
background:".$value."!important;}";
	      }
		   else if($key=="registry_weddinginfo_bgcolor" && $value!='')
			{
			$theme_css.=".registryhead .list-header {
            background:".$value."!important;}";
	        }
		   else if($key=="registry_cost_color" && $value!='')
			{
			$theme_css.=".registr_det_txt div  span{
            color:".$value."!important;}";
	        }
			 else if($key=="registry_sub_text_color" && $value!='')
			{
			$theme_css.=".content-date{
             color:".$value."!important;}.registr_det_txt div div
{
color".$value."!important;}:";
	        }
			else if($key=="shop_section_heading_color" && $value!='')
			{
			$theme_css.=".browse h2{
             color:".$value."!important;}.email_subscribe h2
            {
            color:".$value."!important;}.contact-detail p b
            {
           color:".$value."!important;}";
	        }
			else if($key=="shop_section_link_color" && $value!='')
			{
			$theme_css.=".names-it{
            color:".$value."!important;}.contact_shop_owner-popup
            {
           color:".$value."!important;}.imgaddres_left a
            {
             color:".$value."!important;}";
	        }
			
			else if($key=="shop_section_title_color" && $value!='')
			{
			$theme_css.=".art ul li a{
color:".$value."!important;}.contact_shop_owner-popup
{
color:".$value."!important;}.imgaddres_left a
{
color:".$value."!important;}";
	        }
			else if($key=="shop_section_info_text" && $value!='')
			{
			$theme_css.=".places{
color:".$value."!important;}.imgaddres_left p
{
color:".$value."!important;}.shop-giftcard-callout p span
{
color:".$value."!important;}";
	        }
			else if($key=="shop_section_head_bgcolor" && $value!='')
			{
			$theme_css.=".email_subscribe {
background:".$value."!important;}.imgaddres2 
{
background:".$value."!important;}.listings-title 
{
background:".$value."!important;}";
	        }
			else if($key=="shop_section_product_color" && $value!='')
			{
			$theme_css.=".product_title a{
color:".$value."!important;}";
	        }
			else if($key=="shop_section_shop_color" && $value!='')
			{
			$theme_css.=".product_maker a{
color:".$value."!important;}";
	        }
			else if($key=="shop_section_price_color" && $value!='')
			{
			$theme_css.=".currency_value {
color:".$value."!important;}.currency_code {
color:".$value."!important;}";
	        }
			else if($key=="shop_section_button_bgcolor" && $value!='')
			{
			$theme_css.=".subscribe_btn {
background:".$value."!important;}";
	        }
			else if($key=="shop_section_button_color" && $value!='')
			{
			$theme_css.=".subscribe_btn {
            color:".$value."!important;}";
	        }
			
		}
		
		$config .= ' ?>';
		
		$theme_id=$_POST['id'];
		
		
		$file = 'theme/theme_'.$theme_id.'.php';
		
		$css = 'theme/themecss_'.$theme_id.'.css';
		
		file_put_contents($file, $config);
		
		file_put_contents($css, $theme_css);
		redirect("admin/layout/display_theme_list");
	}
	public function write_css(){
	//	echo $this->input->post('theme_name');die;
		$theme_name='theme/themecss_'.$this->input->post('theme_name');
		$filename='theme/themecss_'.$this->input->post('theme_name')."".str_replace(" ","-",$this->input->post('page_name')).".css";
		file_put_contents($theme_name."header.css", $this->input->post('header_css'));
		file_put_contents($theme_name."footer.css", $this->input->post('footer_css'));
		file_put_contents($filename, $this->input->post('body_css'));
		echo 1;
	}
	public function edit_theme_name()
	{
	$this->data['heading'] = 'Edit Theme Name';
	$user_id = $this->uri->segment(4,0);
	$condition = array('id' => $user_id);
	$this->data['theme_name'] = $this->user_model->get_all_details(THEME,$condition);
	$this->load->view('admin/layout/edit_theme_name',$this->data);
	}
	public function restore_default(){
		$this->user_model->update_details(THEME,array('status'=>'Inactive'),array());
		//echo $this->db->last_query();die;
		$this->setErrorMessage('success','Default Theme Activated Successfully');
		redirect('admin/layout/display_theme_list');
	}
	public function update_theme_data()
	{
	#print_r($_POST);
	#exit;
	
	$data=array("theme_name"=>$this->input->post('theme_name'));
     $this->layout_model->update_name($data,$this->input->post('id'));
	redirect("admin/layout/display_theme_list");
		
	}
	public function display_theme_layout(){
		#die;
		$this->data['heading'] = 'Theme Layout';
		$sort=array("field"=>"id","type"=>"asc");
			
		$this->data['theme_layout'] = $this->layout_model->get_all_details(THEME_LAYOUT,array(),$sort);
		$this->data['theme_name']=$this->layout_model->get_all_details(THEME,array('id'=>$this->uri->segment(4,0)))->row()->id;
		if($this->session->userdata('Curr_theme_name')) {
			$this->session->set_userdata('Curr_theme_name',"");		
		}
		$this->session->set_userdata('Curr_theme_name',$this->data['theme_name']);
		$qury="select seourl from ".PRODUCT." where status='Publish' limit 1";
		$this->data['product_seo']='products/'.$this->layout_model->ExecuteQuery($qury)->row()->seourl;
		$qury="select seourl from ".SELLER." where status='active' limit 1";
		$this->data['shop_seo']='shop-section/'.$this->layout_model->ExecuteQuery($qury)->row()->seourl;
		
		$this->load->view('admin/layout/display_layout',$this->data);
	}

	public function editThemeLayout($id=''){
		$this->data['heading'] = 'Edit Theme Layout';
		$condition = array('id'=>$id);
		$this->data['themeDetail'] = $this->layout_model->get_all_details(THEME_LAYOUT,$condition);

		$this->load->view('admin/layout/edit_theme_layout',$this->data);

	}
	
	public function EditThemeLayoutProcess(){
		$excludeArr = array('theme_id');
		$dataArr = array();
		$condArr = array('id'=>$this->input->post('theme_id'));
		$this->layout_model->commonInsertUpdate(THEME_LAYOUT,'update',$excludeArr,$dataArr,$condArr);
		$this->setErrorMessage('success','Theme updated successfully');
		redirect('admin/layout/display_theme_layout');
	}

	public function change_layout_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$layout_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $layout_id);
			$this->layout_model->update_details(LAYOUT,$newdata,$condition);
			$this->setErrorMessage('success','layout '.$status.' Successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

	public function delete_layout_list(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$delete_layout_list_id = $this->uri->segment(4,0);
			$condition = array('id' => $delete_layout_list_id);
			if($condition!='')
			{
				$this->layout_model->commonDelete(LAYOUT,$condition);
			}
			$this->setErrorMessage('success','Layout deleted successfully');
			redirect('admin/layout/display_layout_list');
		}
	}

	public function set_default_theme(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->layout_model->update_details(THEME_LAYOUT,array('value'=>''),array());
			$this->setErrorMessage('success','Theme restored to default');
			redirect('admin/layout/display_theme_layout');
		}
	}

}