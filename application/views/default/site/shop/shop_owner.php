<?php 

$this->load->view('site/templates/shop_header');
?>

<script src="js/popup.js" type="text/javascript"></script>

<script src="js/jquery.colorbox.js"></script>

<script>

$(document).ready(function(){

	$(".cboxClose1").click(function(){

		$("#cboxOverlay,#colorbox").hide();

	});

	$(".reg-popup").colorbox({width:"580px", height:"auto", inline:true, href:"#inline_reg"});

	//Example of preserving a JavaScript event for inline calls.

	$("#onLoad").click(function(){ 

		$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

		return false;

	});

});

</script>

<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>

		<div id="popupContact">

			<div class="overlay-content"  id="namechange-overlay">

            

            <form class="namechange-overlay-form" method="post" action="site/user/change_name" onsubmit="return validateName();">

                    <div class="overlay-header">

                        <h2><?php if($this->lang->line('user_change_rmv_name') != '') { echo stripslashes($this->lang->line('user_change_rmv_name')); } else echo 'Change or Remove Your Name'; ?></h2>

                        <p><?php if($this->lang->line('user_these_fields_fname') != '') { echo stripslashes($this->lang->line('user_these_fields_fname')); } else echo 'These fields are for your full name'; ?>.</p>

                    </div>

                    <div class="overlay-body change-name-overlay">

                        <div class="input-group input-group-stacked">

                            <label for="new-first-name"><?php if($this->lang->line('user_fname') != '') { echo stripslashes($this->lang->line('user_fname')); } else echo 'First Name'; ?></label>

                            <div class="pop-input">

                            	<input value="<?php echo $selectSeller_details[0]['full_name']?>" name="new-first-name" id="new-first-name" maxlength="40" class="text" type="text" >

                            </div>
                        </div>
                        <div class="input-group input-group-stacked">

                            <label for="new-last-name"><?php if($this->lang->line('user_lname') != '') { echo stripslashes($this->lang->line('user_lname')); } else echo 'Last Name'; ?></label>

                            <div class="pop-input">

                            	<input value="<?php echo $selectSeller_details[0]['last_name']?>" id="new-last-name" name="new-last-name" maxlength="40" class="text" type="text">

                            </div>

                        </div>

                    </div>

                    <span class="error" id="splErr"></span>

                    <div class="overlay-footer">

                        <div class="primary-actions">

                            <div class="save-changes">

                            	<input type="submit" name="save" value="<?php if($this->lang->line('user_save_changes') != '') { echo stripslashes($this->lang->line('user_save_changes')); } else echo 'Save Changes'; ?>" onclick="change_name();" >

                            </div>

                           	<div class="popup-cancel">

                            	<input type="button" name="cancel" value="<?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?>" id="popupContactClose">

                            </div>

                        </div>

                    </div>

            </form>

            </div>    

		</div>

<div id="backgroundPopup"></div>



    <section class="container">

        <div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('Shop_owner_Info') != '') { echo stripslashes($this->lang->line('Shop_owner_Info')); } else echo 'Shop owner Info'; ?></li>
        </ul>
		

            <div class="new_prof">            

                <div class="community_page">            	

                  <div class="community_right" style="margin: 0px; width: 98%;">

                        <div class="split_prefile">

                            <h2><?php if($this->lang->line('shop_publicprofile') != '') { echo stripslashes($this->lang->line('shop_publicprofile')); } else echo 'Create your public profile. Everything on this page can be seen by anyone'; ?><?php if($footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK") echo "。"; else echo "." ?></h2>

                            <!--<p>Everything on this page can be seen by anyone </p>-->

                            <!--<a href="view-profile.html" class="button_view" >View Profile</a>-->

                            <div class="clear"></div>

                        </div>

                        <form action="site/shop/update_seller_profile" method="post" enctype="multipart/form-data" id="profile_form" name="profile_form"> 

                            <div class="pass">

                                <div class="profile_field">

                                <label ><?php if($this->lang->line('user_prof_pictures') != '') { echo stripslashes($this->lang->line('user_prof_pictures')); } else echo 'Profile Picture'; ?> </label>

                                <div class="picture_edit" style="margin-left:13px">

                                <img src="images/users/thumb/<?php if($selectSeller_details[0]['thumbnail']!=""){echo $selectSeller_details[0]['thumbnail'];}else{echo "profile_pic.png";}?>" />

                                </div>

                                <input type="file" class="shipping_fiel" style="margin:10px 0 0 10px" name="profile_pict"/>

                            	</div>

                                <div class="clear"></div>

                                <div class="profile_bor"></div>

                                <div class="profile_field">

                                    <label ><?php if($this->lang->line('user_ur_name') != '') { echo stripslashes($this->lang->line('user_ur_name')); } else echo 'Your Name'; ?> </label>

                                    <span style="margin-left:13px"><?php echo $selectSeller_details[0]['full_name'].' '.$selectSeller_details[0]['last_name'] ?></span>

                                    <a href="javascript:void(0);" id="button"><?php if($this->lang->line('user_change_remove') != '') { echo stripslashes($this->lang->line('user_change_remove')); } else echo 'Change or Remove'; ?></a>

                                </div>

                                <div class="clear"></div>

                                <div class="clear"></div>

                                <div class="profile_bor"></div>

                                <!--<div  class="msg-idea">

                                    <p class="messgag">

                                    You must choose a city from the dropdown in order to have your shop appear in local search results.

                                    <a href="#">Learn more</a>

                                    </p>

                                    <span class="arrow_dwn"></span>

                                </div>-->

                                <div class="text_arrow_main">

                                    <div style="background:none" class="text_arrow">

                                        <p><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo "City"; ?></p>

                                    </div>

                                </div>

                                <div class="pro_check" style="width:79%; float:right; padding:9px 0 0 0 ">

                                    <input name="city" type="text" value="<?php echo $selectSeller_details[0]['city']; ?>"  style="margin-left: 14px;

    width: 64%;" class="shipping_fiel"/>

                                    <div class="clear"></div>

                                    <!--<span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                                </div>

                                <div class="clear"></div>

                                <div class="profile_bor"></div>

                                <div class="profile_field">

                                    <label > <?php if($this->lang->line('user_about') != '') { echo stripslashes($this->lang->line('user_about')); } else echo 'About'; ?> </label>

                                    <textarea class="shipping_fiel width_fileld_scroll" style="margin-left: 12px;" name="about"><?php echo $selectSeller_details[0]['about']; ?></textarea>

                                    <div class="clear"></div>

                                    <span style="margin:10px 0 0 200px; float: left;"> <?php if($this->lang->line('user_tell_people') != '') { echo stripslashes($this->lang->line('user_tell_people')); } else echo 'Tell people a little about yourself'; ?>.</span>

                                </div>

                            </div>

                            <div class="clear"></div>

                           	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_save_changes') != '') { echo stripslashes($this->lang->line('user_save_changes')); } else echo 'Save Changes'; ?>" style=" margin-left:10px; margin-top:1px;" />                           

                    	</form>

                    </div>

                    </div>

            </div>

        </div>

    </section> 	 	



<script type="text/javascript">

function validateName(){

	$('#splErr').hide();

	$('#splErr').html('');

	if($('#new-first-name').val().trim()==''){		

		$('#splErr').show();

		$('#splErr').html('Enter Your First Name.');

		return false;

	}

	if($('#new-last-name').val().trim()==''){		

		$('#splErr').show();

		$('#splErr').html('Enter Your Last Name.');

		return false;

	}

}

</script>

<?php 

$this->load->view('site/templates/footer');

?>