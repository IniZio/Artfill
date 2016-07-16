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

            <h2> <?php if($this->lang->line('user_ur_pub_prof') != '') { echo stripslashes($this->lang->line('user_ur_pub_prof')); } else echo 'Your Public Profile'; ?></h2>

            <p><?php if($this->lang->line('user_every_page_anyone') != '') { echo stripslashes($this->lang->line('user_every_page_anyone')); } else echo 'Everything on this page can be seen by anyone'; ?> </p>

            <a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']?>" class="button_view" ><?php if($this->lang->line('user_view_profile') != '') { echo stripslashes($this->lang->line('user_view_profile')); } else echo 'View Profile'; ?></a>

            <div class="clear"></div>

            <div class="close_content" id="alert_div" style="display:none">

            <p id="alert_message"><?php if($this->lang->line('user_we_recently_updat') != '') { echo stripslashes($this->lang->line('user_we_recently_updat')); } else echo 'We recently updated the way we store and display your profile location to support new features.Check your location below and please update if necessary'; ?>.</p>

			<a class="close_profile" onclick="hide_me()" style="cursor:pointer !important;"></a>

            </div>

          </div>

          

          			<div class="pass">

          <form action="site/user/update_public_profile" method="post" enctype="multipart/form-data" id="profile_form" name="profile_form">  


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