<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<?php $pagArr = array('shop','shops','policies','promote-shop','people','gift-cards');
	if(!in_array($this->uri->segment(1),$pagArr)){?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php } ?>-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
if($this->config->item('publish')!='Production'){	
	$chkPrv=$this->product_model->checkLogin('A');
	if($chkPrv==''){
		
		echo '<title>Coming Soon</title>';
		echo '<div style="background-color:#131521; width:100%;"><div style="margin: 0 auto; width:1300px;"><img src="images/under_maintainence.jpg" alt="under maintainence"></div></div>';
	
		/*$this->data['site_error_msg']=$this->config->item('site_error_msg');
		$this->data['title']=$this->config->item('site_error_msg');
		$this->data['page']=$this->config->item("d_mode");
		
		$pageDetails = $this->product_model->get_all_details(CMS,array('seourl'=>$this->config->item("d_mode"),'status'=>'Publish'));
    	if ($pageDetails->num_rows() == 0){
    		show_404();
    	}else {
    		if ($pageDetails->row()->meta_title != ''){
	    		$this->data['heading'] = $pageDetails->row()->meta_title;
				$this->data['meta_title'] = $pageDetails->row()->meta_title;
			}
			if ($pageDetails->row()->meta_tag != ''){
		    	$this->data['meta_keyword'] = $pageDetails->row()->meta_tag;
			}
			if ($pageDetails->row()->meta_description != ''){
		    	$this->data['meta_description'] = $pageDetails->row()->meta_description;
			}
    		$this->data['heading'] = $pageDetails->row()->meta_title;
    		$this->data['pageDetails'] = $pageDetails;
			
			}
		$this->load->view("site/cms/page_mode",$this->data);*/ // redirect(base_url()."pages/".$this->config->item("d_mode"));
		die;
	}
}

?>



<base href="<?php echo base_url(); ?>" />

	<?php if($this->config->item('google_verification')){ echo stripslashes($this->config->item('google_verification')); }
	if ($heading == ''){?>    
		<title><?php echo $title;?></title>
	<?php }else {?>
		<title><?php echo $heading;?></title>
	<?php }?>
	
<meta name="Title" content="<?php if($meta_title=='') { echo $this->config->item('meta_title'); } else { echo $meta_title; } ?>" />
<meta name="keywords" content="<?php if($meta_keyword=='') { echo $this->config->item('meta_keyword'); } else { echo $meta_keyword; } ?>" />
<meta name="description" content="<?php //if($meta_description==''){ echo $this->config->item('meta_description');}else{ echo $meta_description;}?>" />
	
<?php  if($this->uri->segment(1)=='products'){
  if($meta_product_img !=''){?>
<meta property="og:title" content="<?php if($meta_title=='') { echo $this->config->item('meta_title'); } else { echo $meta_title; } ?>"/>
<meta property="og:type" content="IMAGE"/>
<meta property="og:url" content="<?php echo base_url().$meta_product_url;?>"/>
<meta property="og:image" content="<?php echo base_url().'images/product/thumb/'.$meta_product_img?>" />
<meta property="og:site_name" content="shopsy-v2"/>
<!--<meta property="fb:admins" content="USER_ID"/>-->
<meta property="og:description"  content="<?php //if($meta_description==''){ echo $this->config->item('meta_description');}else{ echo $meta_description;}?>"/>

<?php }}?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'images/logo/'.$this->config->item('fevicon_image'); ?>">    
	
<?php 
	
	$this->load->view('site/templates/css_files',$this->data);
	$this->load->view('site/templates/script_files',$this->data);
	
?>
<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
<?php if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));} ?>

<!--header-->
<!--Theme settings-->
<?php 

$path='./theme/themecss_'.$themeLayout[0]['id'].'.css';
?>

<!--<script src="js/assets/jquery-v11.js"></script>
<script src="js/assets/bootstrap.min.js"></script>-->
