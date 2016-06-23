<?php  $this->load->view('site/templates/header');  ?>
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>
<script src="js/jquery.validate.js"></script>
<script>$(document).ready(function(){$("#addevent_form").validate(); });</script>
<style>
.error{
color:#FF0000!important;
}
</style>
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<!--selection-->
<div id="profile_div">
<section class="container">	
    	<div class="main">
        <div class="wrapper">
        <ul class="bread_crumbs">
        	<li> <a href="<?php echo base_url();?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
             <span>&rsaquo;</span>
            <li> <a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="a_links"><?php if($this->lang->line('comm_account') != '') { echo stripslashes($this->lang->line('comm_account')); } else echo "Your Account"; ?></a></li>
             <span>&rsaquo;</span>
            <li> <a href="manage-teams" class="a_links"><?php if($this->lang->line('com_manageteam') != '') { echo stripslashes($this->lang->line('com_manageteam')); } else echo "Manage Team"; ?></a></li>
             <span>&rsaquo;</span>
            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_addteam') != '') { echo stripslashes($this->lang->line('com_addteam')); } else echo "Add Team"; ?></a></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content community_right">
      <div class="heading"><?php if($this->lang->line('user_teams') != '') { echo stripslashes($this->lang->line('user_teams')); } else echo "Teams"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <div class="right_split">
            <div class="right_split">
           <?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addevent_form', 'enctype' => 'multipart/form-data');
							echo form_open_multipart('site/community/insertTeam',$attributes); ?>
             <div class="new_post_content" style="width:124%;">          
                  
                    <div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('com_teamname') != '') { echo stripslashes($this->lang->line('com_teamname')); } else echo "Team Name"; ?></p><span class="important-symbol" style="color:#F00;">*</span></label>
                        <input type="text" name="teamName" id="teamName" class="payment_txt required" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamName; }?>" >
                    </div>
                   
                 
                    <div class="cardinfo_div">
                    	<label> <p class="teamnames"><?php if($this->lang->line('shop_description') != '') { echo stripslashes($this->lang->line('shop_description')); } else echo "Description"; ?></p><span class="important-symbol" style="color:#F00;">*</span></label>
                        <textarea class="payment_area required" name="teamshortDescription" id="teamshortDescription"><?php if(!empty($teamList)){ echo $teamList->row()->teamShortdescription; } ?></textarea>
                    </div>
                    
                     <?php /*?><div class="cardinfo_div">
                    	<label>Description</label>
                        <textarea class="payment_area" name="teamDescription" id="teamDescription"><?php if(!empty($teamList)){ echo $teamList->row()->teamName; }?></textarea>
                    </div><?php */?>
                    
                     <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('com_whocan') != '') { echo stripslashes($this->lang->line('com_whocan')); } else echo "Who can join?"; ?></label>
                        <textarea class="payment_area" name="teamRules" id="teamRules"><?php if(!empty($teamList)){ echo $teamList->row()->teamRules; } ?></textarea>
                    </div>
                     <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('com_teamlogo') != '') { echo stripslashes($this->lang->line('com_teamlogo')); } else echo "Team Logo"; ?><span style="color:#F00;"></span></label>
						
						  <div class="input-change"><div style ="width: 260px;"><input type="button" onclick="document.getElementById('teamImage').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo "Choose File"; ?> ..."> <b class="no_file_selected">
						  
						 <div id="image_text" style="width:150px;"> <?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo "No File Selected"; ?></div></b></div></div><br/> <br/> <br/>
                    </div>
					<div style="display:none;">
						<input type="file" class="payment_txt" name="teamImage" id="teamImage" >
					</div>
                     <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('shop_tags') != '') { echo stripslashes($this->lang->line('shop_tags')); } else echo "Tags"; ?> </label>
                       <!-- <textarea class="payment_area tags tipTop required" name="teamTags" id="tags_Amt"></textarea>-->
                        <input name="teamTags" class="required  tipTop" style="display:block; width:290px" id="tags_Amt" type="text" tabindex="7" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamTags; } ?>" />
						<span style="color:red"> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; <?php echo af_lg('lg_tags','Eg: tag1,tag2,tag3'); ?></span>
                    </div>
                    
                    
                    <?php /*?><div class="cardinfo_div">
                   <label>Tags</label>
                   <div class="form_input">
                     <input name="amounts" class="payment_area" style="display:none;width: 39% !important;" id="tags_Amt" type="text" value=""/>
                    <!-- <span class="label_intro">Example : tag1,tag2,tag3</span>-->
                   </div>
                 </div><?php */?>
                    
                       <input type="hidden" name="team_id" value="<?php if(!empty($teamList)){ echo $teamList->row()->id; } ?>" />
                      <input type="submit" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "SUBMIT"; ?>" class="create_btn_1" style="float:left!importantt;">
               </div> 
               </form>                                
            <!--rightsplit-->
            </div>
            </div>
            </div>
            </div>
        </div>
     </div>
</section>
</div>
<!--selection-->
<script src="js/chosen.jquery.js"></script>
<script type="text/javascript" src="js/custom-scripts1.js"></script>

<script src="js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="js/jquery.ui.touch-punch.js"></script>
<script src="js/chosen.jquery.js"></script>
<script src="js/uniform.jquery.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/accordion.jquery.js"></script>
<script src="js/autogrow.jquery.js"></script>
<script src="js/duallist.jquery.js"></script>
<script src="js/input-limiter.jquery.js"></script>
<script src="js/inputmask.jquery.js"></script>
<script src="js/iphone-style-checkbox.jquery.js"></script>
<script src="js/raty.jquery.js"></script>
<script src="js/stepy.jquery.js"></script>
<script src="js/vaidation.jquery.js"></script>
<script src="js/validation.js"></script>
<script>$(document).ready(function(){

	
	$('#teamImage').on('change',function(){

		$('.no_file_selected').text(this.value);                           
		                            });
    

	});
	document.getElementById('teamImage').onchange = function () {
	document.getElementById('image_text').innerHTML=this.value;
  //alert('Selected file: ' + this.value);
};
	
	</script>
<?php  $this->load->view('site/templates/footer');  ?>