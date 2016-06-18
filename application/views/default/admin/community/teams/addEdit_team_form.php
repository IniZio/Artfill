<?php //echo'<pre>';  print_r($teamList->row()); die;
$this->load->view('admin/templates/header.php'); 
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/default/styles_gmap.css" />
<style>
div.error {
background: url(images/alert.png) no-repeat left;
color: #DE5130;
display: inline-block;
font-size: 11px;
height: 13px;
margin: 3px;
padding-left: 21px;
padding-top: 2px;}

</style>
<script>
$(function(){
	setTimeout(function(){
	 $(".team_location").css('display','block');
	},2);
    $('#teamType').click(function() {
	if($('#teamType').attr('checked')){
       		 $(".team_location").show();
		}else{
			 $(".team_location").css('display','none');
		}
    });
});
</script>
<script>$(document).ready(function(){$("#addevent_form").validate(); });</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6><?php echo $heading; ?></h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addevent_form', 'enctype' => 'multipart/form-data');
							echo form_open_multipart('admin/community/insertTeam',$attributes); ?>
                    
						<ul>
							<li>
                                <div class="form_grid_12">
                                    <label class="field_title" for="attribute_name">Team Name<span class="req">*</span></label>
                                    <div class="form_input">
                                        <input name="teamName" id="teamName" type="text" tabindex="1" class="required large tipTop" title="Please enter the team name" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamName; }?>"/>
                                    </div>
                                </div>
							</li>
                            
                            <?php /*?><li>
                                <div class="form_grid_12">
                                	<div class="team_location">
                                	 <label class="field_title" for="attribute_name">Team Location<span class="req">*</span></label>
                                        <div class="form_input">
                                        <input id="geocomplete" name="teamLocation" type="text" placeholder="Type in an address" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamLocation; }?>" class="required large tipTop" title="Please enter the team location" />
                                            
                                            <br /><br /><div class="map_canvas"></div></div><br />
                                            
                                            <input name="lat" type="hidden" value="<?php if(!empty($teamList)){ echo $teamList->row()->lat; } ?>">
                                            <input name="lng" type="hidden" value="<?php if(!empty($teamList)){ echo $teamList->row()->lng; } ?>">
       										
                                            <!--<input type="hidden" name="zoom" id="zoom" value="6" />-->
                                    </div>
                                    </div>
                                    <label class="field_title" for="attribute_name">Team Type<span class="req"></span></label>
                                    <div class="form_input">
                                        <input name="teamType" id="teamType" type="checkbox" tabindex="1" class="checkbox tipTop" title="Please enter the team name" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamName; }?>"/>
                                    </div>
							</li><?php */?>
                            
                            <li>
                                <div class="form_grid_12">
                                  <label class="field_title" for="attribute_name">Description<span class="req">*</span></label>
                                    <div class="form_input">
                                    <textarea name="teamshortDescription" id="teamshortDescription"  tabindex="1" class="required input_grow tipTop" title="Please enter short description" cols="70" rows="5" ><?php if(!empty($teamList)){ echo $teamList->row()->teamShortdescription; } ?></textarea>
                                </div>
                                </div>
							</li>
                            
                             
                            
                             <li>
                                <div class="form_grid_12">
                                  <label class="field_title" for="attribute_name">Who can join?<span class="req"></span></label>
                                    <div class="form_input">
                                    <textarea name="teamRules" id="teamRules"  tabindex="1" class="input_grow tipTop" title="Please enter  description" cols="70" rows="9" ><?php if(!empty($teamList)){ echo $teamList->row()->teamRules; } ?></textarea>
                                </div>
                                </div>
							</li>
                            
                             <!--<li>
                                <div class="form_grid_12">
                                  <label class="field_title" for="attribute_name">Application questions<span class="req"></span></label>
                                    <div class="form_input">
                                    <textarea name="teamApplicationquestions" id="teamApplicationquestions"  tabindex="1" class="input_grow tipTop" title="Please enter  Application questions" cols="70" rows="9" ><?php if(!empty($teamList)){ echo $teamList->row()->teamApplicationquestions; } ?></textarea>
                                </div>
                                </div>
							</li>-->
                            
                            <li>
                                  <div class="form_grid_12">
                                   	 <label class="field_title" for="logo_image">Team Logo<span class="req"></span></label>
                                        <div class="form_input">
                                          <input name="teamImage" id="teamImage" type="file" tabindex="5" class="large  tipTop" title="Please select the Team logo image"/>
                                        </div>
                                        <?php if(!empty($teamList)){ ?>
                                 <br /><div class="form_input"><img src="<?php echo base_url().TEAM_PATH.$teamList->row()->teamImage;?>" width="100px"/></div>
                                 		<?php } ?>
                                  </div>
                            </li>
                            
                             <li>
                                <div class="form_grid_12">
                                  <label class="field_title" for="attribute_name">Tags <span class="req"></span></label>
                                    <div class="form_input">
                                    
                                    
                                     <input name="teamTags" class="required tags tipTop" style="display:none; width:110px;"  id="tags_Amt" type="text" tabindex="7" value="<?php if(!empty($teamList)){ echo $teamList->row()->teamTags; } ?>" />
                                </div>
                               </div>
							</li>
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req"></span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status" <?php if(!empty($teamList)){ if($teamList->row()->status=='Active') { ?> checked="checked"  <?php }}else{ ?> checked="checked" <?php } ?>id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="team_id" value="<?php if(!empty($teamList)){ echo $teamList->row()->id; } ?>" />
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>

 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
  

    <script src="<?php echo base_url(); ?>js/jquery.geocomplete.js"></script>

    <script>
      $(function(){
        $("#geocomplete").geocomplete({ 
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });
	$("#geocomplete").trigger("geocode");
        $("#find").click(function(){			
          $("#geocomplete").trigger("geocode");
        });
      });
    </script>

<?php 
$this->load->view('admin/templates/footer.php');
?>