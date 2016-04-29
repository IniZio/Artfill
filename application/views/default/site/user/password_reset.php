
<?php $this->load->view('site/templates/header'); ?>
<section class="container">

    <div class="main">
	
	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>           
		   <span>&rsaquo;</span>
		   <li>RESET PASSWORD</li>
        </ul>
        <div class="sign_in_container">
            <div class="sign_in_form">
                <div class="sign_in_form-inner">                   
                    <div class="register_container">					
						<form method="post" action="site/user/changePasssword">
                        <div class="popup_login">
								<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
                                    <label><?php if($this->lang->line('newpwd') != '') { echo stripslashes($this->lang->line('newpwd')); } else echo 'New Password'; ?></label>

                                    <input type="password" class="search" style="margin:0" name="newPassword" id="newPassword"/>

                                    <div style="color:red;" id="passErr"></div>

                                </div>
								
								<div class="popup_login">

                                    <label><?php if($this->lang->line('confpwd') != '') { echo stripslashes($this->lang->line('confpwd')); } else echo 'Confirm Password'; ?></label>

                                    <input type="password" class="search" style="margin:0" name="confPassword" id="confPassword"/>
                                    <div style="color:red;" id="confpassErr"> </div>
                                </div>								
							   <div class="popup_login" style="margin-bottom:15px">

                                    <input type="submit" class="submit_btn" onclick="return validatePwd();" value="<?php if($this->lang->line('reset') != '') { echo stripslashes($this->lang->line('reset')); } else echo 'Reset Password'; ?>" />
                                    <span id="loadErr"></span>
                                </div>
							<form>
                    </div>     
                </div>    
            </div>

        </div>

    </div>

</section>

<?php 

$this->load->view('site/templates/footer');

?>

<script>
function validatePwd(){
	
	var pwd=document.getElementById('newPassword').value;
	var cpwd=document.getElementById('confPassword').value;
	if(pwd.length>6 ){
		document.getElementById('passErr').innerHTML="Password Length Should be greater than 6 Character";
		return false;
	} else {
	
		document.getElementById('passErr').innerHTML="";
	}
	
	
	if(pwd==""){
		document.getElementById('passErr').innerHTML="Enter Password";
		return false;
	} else {
		document.getElementById('passErr').innerHTML="";
	}
	if(pwd!= cpwd){
		document.getElementById('confpassErr').innerHTML="Password doesn't Match";
		return false;
		 
	} else {
		document.getElementById('confpassErr').innerHTML="";
	
	} 
	
	if(cpwd==""){
		document.getElementById('confpassErr').innerHTML="Please Confirm your password";
		return false;
		
	} else {
		document.getElementById('confpassErr').innerHTML="";
	}
	

}
</script>

 