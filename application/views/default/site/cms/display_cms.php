<?php
	$this->load->view('site/templates/header');
?>

<?php if (isset($active_theme) && $active_theme->num_rows() != 0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Product-Detail-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>footer.css" rel="stylesheet">
<?php }?>

<style>
.cms_content_about{float: left;
width: 100%;
margin: 20px 0px;
border: 1px solid #fff;
border-radius: 5px;
padding: 10px 25px;
background:#fff;

}

.shop_title_abt{
    float: left;
    width: 97%;
	font-weight:bold;
	font-size:22px;
	padding:15px 0px;
}
</style>


<?php if($pageDetails->row()->seourl == 'contact-us') {

$this->load->view('site/cms/contact');



 ?>




<?php } else {?>



  <section class="container">
    	<div class="main">
		<ul class="bread_crumbs">

        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>

            <span>&rsaquo;</span>

           <li><?php echo $pageDetails->row()->page_title; ?></li>

              </ul>
		
		
		
            <div class="cms_content_about">

            <div class="shop_title_abt"><?php echo $pageDetails->row()->page_title; ?></div>

            <div class="inner-container-cms">  <?php 

            	if ($pageDetails->num_rows()>0){

            		echo $pageDetails->row()->description;

            	}

            	?>				
				
			<?php if($this->uri->segment(2) == 'contact-us' && $this->session->userdata['shopsy_session_user_name'] != ''){?>
			<script src="js/jquery.validate.js"></script>    
			<script>$(document).ready(function(){$("#feedBackform").validate(); });</script>
				<h2>Send Your Feedback </h2>
				<form  method="post" action="site/market/submitfeedBackform" id="feedBackform">

                     <div class="popup_login">								
						<label>User Name<span style="color:#F00;" class="redFont" id="user_nameErr">*</span></label>          								 
						<input type="text" class="search required" style="margin:0" name="user_name" id="user_name"/>						
						
						
						<label>Email<span style="color:#F00;" class="redFont" id="user_emailErr">*</span></label>          								 
						<input type="text" class="search required" style="margin:0" name="user_email" id="user_email"/>						
						
						
						<label>Subject<span style="color:#F00;" class="redFont" id="msg_subjectErr">*</span></label>          								 
						<input type="text" class="search required" style="margin:0" name="msg_subject" id="msg_subject"/>						
						
						
						<label>Comments<span style="color:#F00;" class="redFont" id="msg_contentErr">*</span></label>          								 
						<textarea type="text" class="search required" style="margin:0" name="msg_content" id="msg_content"></textarea>				
																					
					</div>
					
					<div class="popup_login">
						<input type="submit" value="Submit" class="btn-primary subscribe-link" />
					</div>		
				</form>
			<?php }?>	
				

            </div>

        </div>

    </section>
<?php }?>


<?php

$this->load->view('site/templates/footer');

?>