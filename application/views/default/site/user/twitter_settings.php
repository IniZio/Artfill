<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');

?>
<!-- section_start -->
<section class="container">
    	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="view-profile/<?php echo $this->uri->segment(3);?>" class="a_links"><?php echo $this->uri->segment(3);?></a></li>
		    <span>&rsaquo;</span>
           <li>Account settings</li>
        </ul>
		
            <div class="community_page">
                <div class="community_div" style="text-align:center;">
                	
                    <div class="" style="margin-left:15px; width:96%;">
                   
                  
                
                     <form method="post" action="site/user/twitter_signup" onsubmit="return password_validation();">
                     	<div class="pass">
                  <div class="heading_account" ><?php if($this->lang->line('twitter_register') != '') { echo stripslashes($this->lang->line('twitter_register')); } else echo "Twitter Registration Information"; ?></div>
                  <div class="field_account">
        	         <label ><?php if($this->lang->line('user_email') != '') { echo stripslashes($this->lang->line('user_email')); } else echo "Email"; ?> </label><p style="color:#F00; float:left;">*</p><span style="color:#F00;"  id="err_pass_email"></span>
                     <input type="text" class="search" style="margin:0" id="pass_email" name="pass_email"/>
                  </div>
        
                 <div class="field_account">
        	       <label ><?php if($this->lang->line('user_password') != '') { echo stripslashes($this->lang->line('user_password')); } else echo "Password"; ?></label><p style="color:#F00; float:left;">*</p> <span style="color:#F00;"  id="err_pass_password"></span>
                   <div class="clear"></div>
                   <input type="Password" class="search" style="margin:0" id="pass_password" name="pass_password"/>
                </div>
        
         <div class="field_account">
        	<label ><?php if($this->lang->line('user_cnfrm_pwd') != '') { echo stripslashes($this->lang->line('user_cnfrm_pwd')); } else echo "Confirm New Password"; ?></label><p style="color:#F00; float:left;">*</p> <span style="color:#F00;"  id="err_pass_confirm_password"></span>
            <input type="Password" class="search" style="margin:0" id="pass_confirm_password" name="pass_confirm_password"/>
        </div>
           <div class="clear"></div>
         
          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('form_update') != '') { echo stripslashes($this->lang->line('form_update')); } else echo "Update"; ?>" style=" margin-left:10px;" />
        
                 
                 </div>
         </form>        
         		
                 
                 			
           					
                     
                     
                     
                     
                    
                   </div>
                </div>
            </div>
        </div>
    </section>
<!-- section_end -->

<script type="text/javascript">
function password_validation(){ 
	$("#err_pass_email").html('');
	$("#err_pass_password").html('');
	$("#err_pass_confirm_password").html('');
	
	var emailAddr = $("#pass_email").val();
	var password = $("#pass_password").val();
	var confirm_password = $("#pass_confirm_password").val();
	if(emailAddr==''){
		$("#err_pass_email").html('Enter email id or username');
		return false;
	}else if(password==''){
		$("#err_pass_password").html('This Field required');
		return false;
	}else if(password!=confirm_password){
		$("#err_pass_confirm_password").html('Password and Confirm Password are missmatch');
		return false;
	}
}

function hideErrDiv(arg) {
	 $("#"+arg).hide("slow");
}

function hideErrDiv(arg) {
	 $("#"+arg).hide("slow");
}
</script>
<?php $this->load->view('site/templates/footer'); ?>