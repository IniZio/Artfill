<?php 

$this->load->view('site/templates/header');

$this->load->model('product_model');

$this->load->model('user_model');

//echo "<pre>";print_r($PublicProfile->row());

?>





<script src="js/jquery.colorbox.js"></script>

<script>

.$(document).ready(function(){

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

<script type="text/javascript" src="js/jquery-ui.min.js"></script>



<!-- Second, add the Timer and Easing plugins -->

<script type="text/javascript" src="js/jquery.timers-1.2.js"></script>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>



<!-- Third, add the GalleryView Javascript and CSS files -->

<script type="text/javascript" src="js/jquery.galleryview-3.0-dev.js"></script>

<script type="text/javascript">

	$(function(){

		$('#myGallery').galleryView();

	});

</script>



<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>



<script type="text/javascript">

		$(function() {

    		$(".slider_1").jCarouselLite({

        		btnNext: ".next_1",

        		btnPrev: ".prev_1",

				auto: false,

    			speed: 1000,

        		visible: 2

    		});

		});

		



</script>



<script src="js/popup.js" type="text/javascript"></script>



<div id="popupContact">

		



        

    <div class="overlay-content"  id="namechange-overlay">

                            <form class="namechange-overlay-form" method="post" action="#">

                <input type="hidden" name="_nnc" value="input" class="hidden csrf">

                <input type="hidden" name="member-id" value="45155540">

                <input type="hidden" name="current-first-name" value="Saravana" >

                <input type="hidden" name="current-last-name" value="S">

                <input type="hidden" name="action" value="namechange">



                <div class="overlay-header">

                    <h2><?php if($this->lang->line('user_change_rmv_name') != '') { echo stripslashes($this->lang->line('user_change_rmv_name')); } else echo 'Change or Remove Your Name'; ?></h2>

                    <p><?php if($this->lang->line('user_these_fields_fname') != '') { echo stripslashes($this->lang->line('user_these_fields_fname')); } else echo 'These fields are for your full name'; ?>.</p>

                </div>

                <div class="overlay-body change-name-overlay">

                    <div class="input-group input-group-stacked">

                        <label for="new-first-name"><?php if($this->lang->line('user_fname') != '') { echo stripslashes($this->lang->line('user_fname')); } else echo 'First Name'; ?></label>

                        <div class="pop-input"><input value="Saravana" name="new-first-name" id="new-first-name" maxlength="40" class="text" type="text" ></div>

                       

                    </div>

            		<div class="input-group input-group-stacked">

			            <label for="new-last-name"><?php if($this->lang->line('user_lname') != '') { echo stripslashes($this->lang->line('user_lname')); } else echo 'Last Name'; ?></label>

                        <div class="pop-input"><input value="S" id="new-last-name" name="new-last-name" maxlength="40" class="text" type="text"></div>

                        

                    </div>

                </div>

                <div class="overlay-footer">

                    <div class="primary-actions">

                        <div class="save-changes"><input type="submit" name="save" value="Save Changes"  disabled="disabled"></div>

                       <div class="popup-cancel"><input type="button" name="cancel" value="Cancel" id="popupContactClose"></div>

                    </div>

                </div>

            </form>

            </div>    

        

        

        

        

	</div>

	<div id="backgroundPopup"></div>



<section>

    	<div class="main">

        	

            <div class="community_page">

            	

                <div class="community_div">

                	<div class="community_left">

                    	<?php $this->load->view('site/user/sidebar');?>         

                                  

                    </div>

                    <div class="community_right" style="margin-left:15px; float:right; width:78%;">

                    	   

             <div class="split_prefile">

            <h2><?php if($this->lang->line('user_ur_pub_prof') != '') { echo stripslashes($this->lang->line('user_ur_pub_prof')); } else echo 'Your Public Profile'; ?></h2>

            <p><?php if($this->lang->line('user_every_page_anyone') != '') { echo stripslashes($this->lang->line('user_every_page_anyone')); } else echo 'Everything on this page can be seen by anyone'; ?></p>

            <a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']?>" class="button_view" >View Profile</a>

            <div class="clear"></div>

            <div class="close_content" id="alert_div">

            <p><?php if($this->lang->line('user_we_recently_updat') != '') { echo stripslashes($this->lang->line('user_we_recently_updat')); } else echo 'We recently updated the way we store and display your profile location to support new features.Check your location below and please update if necessary'; ?>.</p>

<a class="close_profile" onclick="hide_me()"></a>

            </div>

          </div>

        

          			<div class="pass">

         <form action="site/user/update_public_profile" method="post" enctype="multipart/form-data" id="profile_form" name="profile_form">  

          <div class="profile_field">

        	<label ><?php if($this->lang->line('user_prof_pictures') != '') { echo stripslashes($this->lang->line('user_prof_pictures')); } else echo 'Profile Picture'; ?></label>

           <div class="picture_edit" style="margin-left:13px">

            <img src="images/users/thumb/<?php if($PublicProfile->row()->thumbnail!=""){echo $PublicProfile->row()->thumbnail;}else{echo "profile_pic.png";}?>" />

            </div>

            <input type="file" class="shipping_fiel" style="margin:10px 0 0 10px" name="profile_pict"/>

            

            

        </div>

        <div class="clear"></div>

        <div class="profile_bor"></div>

          

           <div class="profile_field">

        	<label ><?php if($this->lang->line('user_ur_name') != '') { echo stripslashes($this->lang->line('user_ur_name')); } else echo 'Your Name'; ?></label>

            <span style="margin-left:13px"><?php echo $PublicProfile->row()->full_name;?></span>

            <a href="#" id="button"><?php if($this->lang->line('user_change_remove') != '') { echo stripslashes($this->lang->line('user_change_remove')); } else echo 'Change or Remove'; ?></a>

            </div>

            

         <div class="clear"></div>

       <div class="profile_bor"></div>

        <p class="text_profi"><?php if($this->lang->line('user_gender') != '') { echo stripslashes($this->lang->line('user_gender')); } else echo 'Gender'; ?></p>

       

        <div class="pro_check">

        	        <input name="gender" type="radio" value="Female"  style="float:left; margin-left:21px;" id="Female"/>

                     <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_female') != '') { echo stripslashes($this->lang->line('user_female')); } else echo 'Female'; ?></label>

         </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value="Male"  style="float:left;" id="Male"/>

                     <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_male') != '') { echo stripslashes($this->lang->line('user_male')); } else echo 'Male'; ?></label>

          </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value="Unspecified"  style="float:left;" id="Unspecified"/>

                     <label style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_rather_not_say') != '') { echo stripslashes($this->lang->line('user_rather_not_say')); } else echo 'Rather not say'; ?></label>

          </div>

          

            <div class="clear"></div>

       <div class="profile_bor"></div>

      

        <div class="text_arrow_main">

        <div class="text_arrow">

         <p><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo 'City'; ?></p>

       </div>

       </div>

        <div class="pro_check" style="width:79%; float:right; ">

        	        <input name="city" type="text" value="<?php echo $PublicProfile->row()->city;?>"  style=" width:61%; margin-left:33px;" class="shipping_fiel"/>

                    <div class="clear"></div>

                  <!--  <span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                    

         </div>

          <div class="clear"></div>

       <div class="profile_bor"></div>

        <div class="profile_field">

        	<label > <?php if($this->lang->line('user_birthday') != '') { echo stripslashes($this->lang->line('user_birthday')); } else echo 'Birthday'; ?></label>

             <select class="preview_pro" name="month" id="month">

                     <option>Month</option>

                     <?php for($i=1;$i<=12;$i++){?>

                     <option value="<?php echo $i;?>"><?php echo $i;?></option>

                     <?php }?>

             </select>

             

              <select class="preview_pro" style="width:12%;" name="day" id="day">

                     <option>Day</option>

                     <?php for($i=1;$i<=31;$i++){?>

                      <option value="<?php echo $i;?>"><?php echo $i;?></option>

                     <?php }?>

             </select>

           

            <span style="color:red" id="date_error"></span>

            </div>

            

            <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > About </label>

            <textarea class="shipping_fiel width_fileld_scroll" name="about"><?php echo $PublicProfile->row()->about;?></textarea>

            <div class="clear"></div>

           <span style="margin:10px 0 0 189px; float: left;"> Tell people a little about yourself.</span>

         

           

            

            </div>

              <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > Favorite Materials </label>

            <textarea class="shipping_fiel width_fileld_scroll" style="height:30px; ;" name="favorite_materials"><?php echo $PublicProfile->row()->favorite_materials;?></textarea>

            <div class="clear"></div>

           <span style="margin:10px 0 0 189px; float: left;"> Share up to 13 materials that you like. Separate each material with a comma.</span>

         

           </div>

           <div class="clear"></div>

       <div class="profile_bor"></div>

           <p class="text_profi">Include on Your Profile</p>

            <div class="field_account" style="margin-bottom:15px; margin-left:31px;">

        	        <input name="include_profile[]" type="checkbox" value="Shop"  style="float:left;" id="Shop"/>

                    <label style=" margin:0px 0 0 3px;" >Shop</label>

                    <div class="clear"></div>

                   <input name="include_profile[]" type="checkbox" value="Favorite_items" id="Favorite_items"  style="float:left;"/>

                    <label style=" margin:0px 0 0 3px;" >Favorite items</label>

                    <div class="clear"></div>

                     <input name="include_profile[]" type="checkbox" value="Favorite_shops" id="Favorite_shops"  style="float:left;"/>

                    <label style=" margin:0px 0 0 3px;" >Favorite shops</label>

                    <div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" value="Treasury_lists" id="Treasury_lists"  style="float:left;"/>

                    <label style=" margin:0px 0 0 3px;" >Treasury lists</label>

                    <div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" value="Teams" id="Teams"  style="float:left;"/>

                    <label style=" margin:0px 0 0 3px;" >Teams</label>

                  </div>

    

              </div>

          

            		

            <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="Save Changes" style=" margin-left:10px; margin-top:1px;" id="profile_submit" onclick="return date_validation();"/>

        

         

                    

                   </div>

           </form>

                </div>

            </div>

        </div>

    </section>

  



















    

    

<script>

document.getElementById("<?php echo $PublicProfile->row()->gender;?>").checked=true;



<?php if($PublicProfile->row()->birthday!=""){$dob=explode('-',$PublicProfile->row()->birthday);?>

document.getElementById("month").value="<?php echo $dob[0];?>";

document.getElementById("day").value="<?php echo $dob[1];?>";

<?php }?>



<?php $include_profile=explode(',',$PublicProfile->row()->include_profile);for($i=0;$i<sizeof($include_profile);$i++){?>

document.getElementById("<?php echo $include_profile[$i];?>").checked=true;

<?php }?>

</script>

<script>

function date_validation()

{

$("#date_error").html("");

var day=document.getElementById("day").value;

var month=document.getElementById("month").value;

	if(month==2)

	{

		if(day>28)

		{

			$("#date_error").html("Invalid date");

			return false;

		}

	}

	if(month==4||month==6||month==9||month==11)

	{

		if(day>30)

		{

			$("#date_error").html("Invalid date");

			return false;

		}

	}

	if((day>0&&month=="Month")||(month>0&&day=="Day"))	

	{

		$("#date_error").html("Invalid date");

			return false;

	}

}



function hide_me()

{

	//alert(element_id);

$("#alert_div").hide();	

}

</script>





<?php 

     $this->load->view('site/templates/footer');

?>