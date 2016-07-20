<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
//echo "<pre>";print_r($PublicProfile->row());
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php } ?>
<script src="js/popup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jcarousellite_1.0.1.pack.js"></script>
<!-- header_end -->
<!-- section_start -->
		<div class="add_steps shop-menu-list">
			<div class="main">
				<?php $this->load->view('site/user/sidebar');?>     
			</div>
		</div>
<div id="profile_div">
	<section class="container">

    	<div class="main">

        	 <ul id="breadcrumbs" class="clear">

                <li>

                    <a itemprop="url" href="<?php echo base_url();?>"><span itemprop="title"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></span></a>

                    <span class="separator">›</span>            

                </li>

                <li> <?php echo $PublicProfile->row()->full_name." ".$PublicProfile->row()->last_name;?><?php if($this->lang->line('user_profiles') != '') { echo stripslashes($this->lang->line('user_profiles')); } else echo "'s profile"; ?>  </li>

            </ul>

            <div class="community_page">
			
			
            	

                <div class="community_div">


                    <div class="community_right">                    	   

             <div class="split_prefile">

            <h2> <?php if($this->lang->line('user_ur_pub_prof') != '') { echo "你的個人檔案"; } else echo 'Your Public Profile'; ?></h2>

            <a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']?>" class="button_view" ><?php if($this->lang->line('user_view_profile') != '') { echo stripslashes($this->lang->line('user_view_profile')); } else echo 'View Profile'; ?></a>

            <div class="clear"></div>

            <div class="close_content" id="alert_div" style="display:none">

            <p id="alert_message"><?php if($this->lang->line('user_we_recently_updat') != '') { echo stripslashes($this->lang->line('user_we_recently_updat')); } else echo 'We recently updated the way we store and display your profile location to support new features.Check your location below and please update if necessary'; ?>.</p>

			<a class="close_profile" onclick="hide_me()" style="cursor:pointer !important;"></a>

            </div>

          </div>

          

          			<div class="pass">

          <form action="site/user/update_public_profile" method="post" enctype="multipart/form-data" id="profile_form" name="profile_form">  

          <div class="profile_field">

        	<label ><?php if($this->lang->line('user_prof_pictures') != '') { echo stripslashes($this->lang->line('user_prof_pictures')); } else echo 'Profile Picture'; ?> </label>

           <div class="pass-right"><div class="picture_edit">

             <img src="<?php echo base_url();?>images/users/thumb/<?php if($PublicProfile->row()->thumbnail!=""){echo $PublicProfile->row()->thumbnail;}else{echo "profile_pic.png";}?>" />

            </div>
        <div class="upload_profile_12">
								
		<div>
			<input type="button" onclick="document.getElementById('user_profile_img').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo 'Choose File'; ?> ..." /><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo 'No File Selected'; ?> </b>
			<input type="file" id="user_profile_img" class="shipping_fiel_12" style="margin:10px 0 0 10px; color:#fff; display:none;" name="profile_pict" />
		     <label id="ErrImage" class="img-size"></label>
		</div>	
		
	   </div>
           <!-- <input type="file" class="shipping_fiel" style="margin:10px 0 0 10px; width: 22%;" name="profile_pict"/>-->

            </div>

            

        </div>

        <div class="clear"></div>

        <div class="profile_bor"></div>

          

           <div class="profile_field">

        	<label ><?php if($this->lang->line('user_full_name') != '') { echo stripslashes($this->lang->line('user_full_name')); } else echo 'Full Name'; ?> </label>
			
			<div class="pass-right">

            <span id="display_first_name"><?php echo $PublicProfile->row()->full_name." ".$PublicProfile->row()->last_name;?></span>

            <a id="button" style="cursor:pointer !important;"><?php if($this->lang->line('user_change_remove') != '') { echo stripslashes($this->lang->line('user_change_remove')); } else echo 'Change or Remove'; ?></a>
			
			</div>

            </div>

            

         <div class="clear"></div>

       <div class="profile_bor"></div>
	   
	   <div class="profile_field">

       <label><?php if($this->lang->line('user_gender') != '') { echo stripslashes($this->lang->line('user_gender')); } else echo 'Gender'; ?></label>

       <div class="pass-right">

        <div class="pro_check">

        	        <input name="gender" type="radio" value="Female"  style="float:left; cursor:pointer !important;" id="Female"/>

                     <span style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_female') != '') { echo stripslashes($this->lang->line('user_female')); } else echo 'Female'; ?></span>

         </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value="Male"  style="float:left;cursor:pointer !important;" id="Male"/>

                     <span style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_male') != '') { echo stripslashes($this->lang->line('user_male')); } else echo 'Male'; ?></span>

          </div>

          <div class="pro_check">

         

        	        <input name="gender" type="radio" value=""  style="float:left;cursor:pointer !important;" id="Unspecified"/>

                     <span style=" margin:3px 0 0 3px;" ><?php if($this->lang->line('user_rather_not_say') != '') { echo stripslashes($this->lang->line('user_rather_not_say')); } else echo 'Rather not say'; ?></span>

          </div>
		  
		  </div>
		  
		  
		  </div>

          

            <div class="clear"></div>

       <div class="profile_bor"></div>

      

        <div class="profile_field">


         <label><?php if($this->lang->line('user_city') != '') { echo stripslashes($this->lang->line('user_city')); } else echo 'City'; ?></label>


		<div class="pass-right">

        	        <input name="city" type="text" value="<?php echo $PublicProfile->row()->city;?>"  style=" width:38%;" class="shipping_fiel"/>

                    <div class="clear"></div>

                  <!--  <span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                    

         </div>

       </div>
	   
		   <div class="clear"></div>

       <div class="profile_bor"></div>
		
		<div class="profile_field">


         <label><?php if($this->lang->line('header_country') != '') { echo stripslashes($this->lang->line('header_country')); } else echo 'Country'; ?></label>

     
        <div class="pass-right">

        	        <select class="preview_pro" name="country" id="country" style="cursor:pointer !important; width: 278px;">
             	<option value=""><?php echo af_lg('lg_select','Select');?></option>
                	<?php foreach($data_country->result() as $countryName){ ?>
                        <option <?php if($countryName->name==$PublicProfile->row()->country) { ?> selected="selected"<?php } ?> value="<?php echo $countryName->name; ?>"><?php echo $countryName->name; ?></option>
                    <?php } ?>
             </select>

                    <div class="clear"></div>

                  <!--  <span style="margin:10px 0 0 35px; float:left;">Start typing and choose from a suggested city to help others find you. </span>-->

                    

         </div>
		 
		 </div>
          <div class="clear"></div>

       <div class="profile_bor"></div>

        <div class="profile_field">

        	<label > <?php if($this->lang->line('user_birthday') != '') { echo stripslashes($this->lang->line('user_birthday')); } else echo 'Birthday'; ?></label>
			
			
			<div class="pass-right">

             <select class="preview_pro" name="month" id="month" style="cursor:pointer !important;">

                     <option><?php if($this->lang->line('user_month') != '') { echo stripslashes($this->lang->line('user_month')); } else echo 'Month'; ?></option>

                     	<option value="1">January</option>

                        <option value="2">February</option>

                        <option value="3">March</option>

                        <option value="4">April</option>

                        <option value="5">May</option>

                        <option value="6">June</option>

                        <option value="7">July</option>

                        <option value="8">August</option>

                        <option value="9">September</option>

                        <option value="10">October</option>

                        <option value="11">November</option>

                        <option value="12">December</option>

             </select>

             

              <select class="preview_pro" style="width:12%;cursor:pointer !important;" name="day" id="day">

                     <option><?php if($this->lang->line('user_day') != '') { echo stripslashes($this->lang->line('user_day')); } else echo 'Day'; ?></option>

                     <?php for($i=1;$i<=31;$i++){?>

                      <option value="<?php echo $i;?>"><?php echo $i;?></option>

                     <?php }?>

             </select>

           

            <span style="color:red" id="date_error"></span>
			
			</div>

            </div>

            

            <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > <?php if($this->lang->line('user_about') != '') { echo stripslashes($this->lang->line('user_about')); } else echo 'About'; ?> </label>
			
			<div class="pass-right">

            <textarea class="shipping_fiel width_fileld_scroll" name="about"><?php echo htmlspecialchars(stripslashes($PublicProfile->row()->about));?></textarea>

            <div class="clear"></div>

           <span style="float: left;"> <?php if($this->lang->line('user_tell_people') != '') { echo stripslashes($this->lang->line('user_tell_people')); } else echo 'Tell people a little about yourself'; ?>.</span>

         
			</div>
           

            

            </div>

              <div class="clear"></div>

       <div class="profile_bor"></div>

       <div class="profile_field">

        	<label > <?php if($this->lang->line('user_fav_materials') != '') { echo stripslashes($this->lang->line('user_fav_materials')); } else echo 'Favorite Materials'; ?> </label>

			<div class="pass-right">
				
            <textarea class="shipping_fiel width_fileld_scroll" style="height:30px; ;" name="favorite_materials" id="favorite_materials"><?php echo htmlspecialchars( stripslashes($PublicProfile->row()->favorite_materials));?></textarea>

            <span class="error" id="favorite_materialsErr"></span>

            <div class="clear"></div>

           <span style="float: left;"> <?php if($this->lang->line('user_share_comma') != '') { echo stripslashes($this->lang->line('user_share_comma')); } else echo 'Share up to 13 materials that you like. Separate each material with a comma'; ?>.</span>

			</div>

           </div>

           <div class="clear"></div>

       <div class="profile_bor"></div>
	   
	   <div class="profile_field">

           <label><?php if($this->lang->line('user_include_profile') != '') { echo stripslashes($this->lang->line('user_include_profile')); } else echo 'Include on Your Profile'; ?></label>

           

           <?php if($PublicProfile->row()->include_profile != 'All') { ?>

           

           

            <div class="pass-right">

        	        <input name="include_profile[]" type="checkbox" value="Shop" class="chkb"  style="float:left;cursor:pointer !important;" id="Shop" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_shop') != '') { echo stripslashes($this->lang->line('user_shop')); } else echo 'Shop'; ?></label>

                    <div class="clear"></div>

                   <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_items" id="Favorite_items"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_fav_items') != '') { echo stripslashes($this->lang->line('user_fav_items')); } else echo 'Favorite items'; ?></label>

                    <div class="clear"></div>

                     <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_shops" id="Favorite_shops"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_fav_shops') != '') { echo stripslashes($this->lang->line('user_fav_shops')); } else echo 'Favorite shops'; ?></label>

                    <!--<div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Treasury_lists" id="Treasury_lists"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_treasury_lists') != '') { echo stripslashes($this->lang->line('user_treasury_lists')); } else echo 'Treasury lists'; ?></label>-->

                    <div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Teams" id="Teams"  style="float:left;cursor:pointer !important;" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo 'Teams'; ?></label>

                  </div>

                  <?php } else {?>

                  <div class="pass-right">

        	        <input name="include_profile[]" type="checkbox" value="Shop" class="chkb"  style="float:left;cursor:pointer !important;" id="Shop" checked="checked" />

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_shop') != '') { echo stripslashes($this->lang->line('user_shop')); } else echo 'Shop'; ?></label>

                    <div class="clear"></div>

                   <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_items" id="Favorite_items"  style="float:left;cursor:pointer !important;" checked="checked"/>

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_fav_items') != '') { echo stripslashes($this->lang->line('user_fav_items')); } else echo 'Favorite items'; ?></label>

                    <div class="clear"></div>

                     <input name="include_profile[]" type="checkbox" class="chkb" value="Favorite_shops" id="Favorite_shops"  style="float:left;cursor:pointer !important;" checked="checked"/>

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_fav_shops') != '') { echo stripslashes($this->lang->line('user_fav_shops')); } else echo 'Favorite shops'; ?></label>

                    <!--<div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Treasury_lists" id="Treasury_lists"  style="float:left;cursor:pointer !important;" checked="checked"/>

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_treasury_lists') != '') { echo stripslashes($this->lang->line('user_treasury_lists')); } else echo 'Treasury lists'; ?></label>-->

                    <div class="clear"></div>

                    <input name="include_profile[]" type="checkbox" class="chkb" value="Teams" id="Teams"  style="float:left;cursor:pointer !important;" checked="checked"/>

                    <label style=" margin:0px 0 0 3px;" ><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo 'Teams'; ?></label>

                  </div>

                  

                  <?php }?>

    

              </div>

          

            		

            <div class="clear"></div>

         

          	<input type="submit" class="password_btn" value="<?php if($this->lang->line('user_save_changes') != '') { echo stripslashes($this->lang->line('user_save_changes')); } else echo 'Save Changes'; ?>" style=" margin-left:10px; margin-top:1px;" id="profile_submit" onclick="return date_validation();"/>

        

         

                    

                   </div>

           </form>

                </div>

            </div>

        </div>

        </div>

    </section>
</div>
  

  <div id="popupContact">

		



        

    <div class="overlay-content"  id="namechange-overlay">

                <form class="namechange-overlay-form" method="post" action="site/user/change_name" onsubmit="return validateName();">

               <!-- <input type="hidden" name="_nnc" value="input" class="hidden csrf">

                <input type="hidden" name="member-id" value="45155540">

                <input type="hidden" name="current-first-name" value="Saravana" >

                <input type="hidden" name="current-last-name" value="S">

                <input type="hidden" name="action" value="namechange"> -->



                <div class="overlay-header">

                    <h2><?php if($this->lang->line('user_change_rmv_name') != '') { echo stripslashes($this->lang->line('user_change_rmv_name')); } else echo 'Change or Remove Your Name'; ?></h2>

                    <p><?php if($this->lang->line('user_these_fields_fname') != '') { echo stripslashes($this->lang->line('user_these_fields_fname')); } else echo 'These fields are for your full name'; ?>.</p>

                </div>

                <div class="overlay-body change-name-overlay">

                    <div class="input-group input-group-stacked">

                        <label for="new-first-name"><?php if($this->lang->line('user_fname') != '') { echo stripslashes($this->lang->line('user_fname')); } else echo 'First Name'; ?></label>

                        <div class="pop-input">

                        <input value="<?php echo $PublicProfile->row()->full_name?>" name="new-first-name" id="new-first-name" maxlength="40" class="text" type="text" >

                        </div>

                       

                    </div>

            		<div class="input-group input-group-stacked">

			            <label for="new-last-name"><?php if($this->lang->line('user_lname') != '') { echo stripslashes($this->lang->line('user_lname')); } else echo 'Last Name'; ?></label>

                        <div class="pop-input">

                        <input value="<?php echo $PublicProfile->row()->last_name?>" id="new-last-name" name="new-last-name" maxlength="40" class="text" type="text">

                        </div>

                        

                    </div>

                </div>

                <span class="error" id="splErr"></span>

                <div class="overlay-footer">

                    <div class="primary-actions">

                        <div class="save-changes"><input type="submit" name="save" value="<?php if($this->lang->line('user_save_changes') != '') { echo stripslashes($this->lang->line('user_save_changes')); } else echo 'Save Changes'; ?>"></div>

                       <div class="popup-cancel"><input type="button" name="cancel" value="<?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?>" id="popupContactClose"></div>

                    </div>

                </div>

            </form>

            </div>    

        

        

        

        

	</div>

	<div id="backgroundPopup"></div>

  

  <script>

document.getElementById("<?php if($PublicProfile->row()->gender==""){echo "Unspecified";}else{echo $PublicProfile->row()->gender;}?>").checked=true;



<?php if($PublicProfile->row()->birthday!=""){$dob=explode('-',$PublicProfile->row()->birthday);?>

document.getElementById("month").value="<?php echo $dob[0];?>";

document.getElementById("day").value="<?php echo $dob[1];?>";

<?php }?>



<?php $include_profile=explode(',',$PublicProfile->row()->include_profile);

for($i=0;$i<sizeof($include_profile);$i++){?>

 $('#<?php echo $include_profile[$i];?>').attr('checked',true);

<?php }?>

</script>

<script>

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

function date_validation()

{



var favorite_materials=$('#favorite_materials').val().split(',');

	$('#favorite_materialsErr').hide();

if(favorite_materials.length>13){

	$('#favorite_materialsErr').show();	

	$('#favorite_materialsErr').html('Maximum 13 materials are added');

	return false;

}



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



<script>

//function change_name()

//{

//	var first_name=document.getElementById("new-first-name").value;

//	var last_name=document.getElementById("new-last-name").value;

	

//	$.ajax({

//			url : '<?php echo base_url();?>site/user/change_name',

			//data : {firstname : first_name,lastname : last_name},

			//type : "post",

			

//			success:function(e){

//				alert(e);

				//$("#display_first_name_header").html(response.first_name);

				//$("#display_first_name").html(response.first_name);

				//$("#new-first-name").val(response.first_name);

				//$("#new-last-name").val(response.last_name);

				//$("#alert_div").css("display", "block");

				//$("#alert_message").html(response.msg);

//			},

//			error: function(er){

				

//				alert("error");

//			}

//			});

	

	

//}

</script>


<script>
$('#user_profile_img').change(function(){
	$('#no_file_selected').text($('#user_profile_img').val());
});
</script>


<?php 

     $this->load->view('site/templates/footer');

?>