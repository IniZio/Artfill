<?php $this->load->view('site/templates/header');?>

<!--selection-->

<section class="container">

    	<div class="main">

        	<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
		   <span>&rsaquo;</span>
		   <li>Reopen account</li>
        </ul>

            <div class="community_page">

            	

                <div class="community_div">

                	

                    <div class="community_right wdt-size">

                    	   

                    <div class="pass" style="width:650px; border:#EDEDE7 solid 3px;">

                 	 <div class=" forgot_titles" ><?php if($this->lang->line('user_reopen_ur_acc') != '') { echo stripslashes($this->lang->line('user_reopen_ur_acc')); } else echo "Reopen your account"; ?></div>

                                      	 <p class="forgot_text"><?php if($this->lang->line('user_enter_email_ropen') != '') { echo stripslashes($this->lang->line('user_enter_email_ropen')); } else echo "Enter your email address and we'll send you a link to reopen your account"; ?></p>



                    		<form method="post" action="site/user/reopen_account_user"  name = "reopen_Form" id = "reopen_Form"  class="frm clearfix forgot-form"><input type='hidden' />

                 			 <div class="field_account"><span style="color:#F00; margin: 0 0 0 30px" class="redFont" id="email_warn"></span>  

        	       			 <input type="text" id= "emailid" name ="emailid" class="input_forgot"/>

                             </div>

                  				 <div class="clear"></div>

          					<input type="submit" class="password_btn" id="reopen_submit" value="<?php if($this->lang->line('user_reopen_acc') != '') { echo stripslashes($this->lang->line('user_reopen_acc')); } else echo "Reopen account"; ?>" style=" margin-left:29px; margin-top:1px;" />

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

	$("#reopen_submit").click(function()

	{

		if(jQuery.trim($("#emailid").val()) == '')

		{

			$("#email_warn").html('');

			$('#email_warn').html(lg_pls_enter_valid_email);	

			$("#emailid").focus();

			return false;

			

		}

		else

		{	

			$("#reopen_Form").submit();

		}

	});

	/** forgot pwd end **/

		</script>

<!--selection-->

<?php $this->load->view('site/templates/footer'); ?>

