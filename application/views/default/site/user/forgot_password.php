<?php $this->load->view('site/templates/header'); ?>

<!--selection-->

<section class="container">

    	<div class="main">

        	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="login" class="a_links"><?php echo shopsy_lg('lg_login','Login'); ?></a></li>
		   <span>&rsaquo;</span>          
           <li><?php echo shopsy_lg('lg_fgt_pwd','Forgot Password'); ?></li>
        </ul>	

            <div class="community_page">

            	

                <div class="community_div">

                	

                    <div class="community_right wdt-size">

                    	   

                    <div class="pass" style="width:650px; border:#EDEDE7 solid 3px;">

                 	 <div class=" forgot_titles" ><?php if($this->lang->line('user_fgt_pwd') != '') { echo stripslashes($this->lang->line('user_fgt_pwd')); } else echo 'Forgot your password?'; ?></div>

                 	 <p class="forgot_text"><?php if($this->lang->line('user_enter_email_rest') != '') { echo stripslashes($this->lang->line('user_enter_email_rest')); } else echo "Enter your email address and we'll send you a link to reset your password."; ?></p>

                    		<form method="post" action="site/user/forgot_password_user"  name = "target" id = "target"  class="frm clearfix forgot-form"><input type='hidden' />

                 			 <div class="field_account"><span style="color:#F00; margin: 0 0 0 30px;" class="redFont" id="email_warn"></span>  

        	       			 <input type="text" id= "emailids" name ="emailids" class="input_forgot"/>

                             </div>

                  				 <div class="clear"></div>

          					<input type="submit" class="password_btn" id="forgot_submit" value="<?php if($this->lang->line('forgot_reset_pwd') != '') { echo stripslashes($this->lang->line('forgot_reset_pwd')); } else echo 'Reset Password'; ?>" style=" margin-left:29px; margin-top:1px;" />

                    </form>

                  </div>

                </div>	

               </div>

              </div>

             </div>

        </div>

    </section>

    <script type="text/javascript">

			/*Forgot validation start */

	$("#forgot_submit").click(function()

	{

		if(jQuery.trim($("#emailids").val()) == '')

		{

			$("#email_warn").html('');

			$('#email_warn').html(lg_pls_enter_valid_email);	

			$("#emailids").focus();

			return false;

			

		}

		else

		{	

			$("#target").submit();

		}

	});

	

	/** forgot pwd end **/

		</script>

    

<!--selection-->

<?php $this->load->view('site/templates/footer');?>





