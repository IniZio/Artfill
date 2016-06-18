<?php //echo '<pre>';  print_r($eventsList->row()); die;
$this->load->view('admin/templates/header.php'); 
?>
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
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
    $('.special_normal').click(function() {
	if($('#specialEventsyle').css('display')=='none'){
        $("#specialEventsyle").css('display','block');
		}else{
			 $("#specialEventsyle").css('display','none');
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
							echo form_open_multipart('admin/community/insertEvent',$attributes);
					?>
                    
						<ul>
							<li>
                                <div class="form_grid_12">
                                    <label class="field_title" for="attribute_name">Event Title<span class="req">*</span></label>
                                    <div class="form_input">
                                        <input name="eventTitle" id="eventTitle" type="text" tabindex="1" class="required large tipTop" title="Please enter the event title" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventTitle; }?>"/>
                                    </div>
                                </div>
							</li>
                            
                            <li>
                                <div class="form_grid_12">
                                  <label class="field_title" for="attribute_name">Description<span class="req">*</span></label>
                                    <div class="form_input">
                                    <textarea name="eventDescription" id="eventDescription"  tabindex="1" class="required input_grow tipTop" title="Please enter short description" cols="70" rows="9" ><?php if(!empty($eventsList)){ echo $eventsList->row()->eventDescription; } ?></textarea>
                                </div>
                                </div>
							</li>
                            
                            <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Event Type<span class="req"></span></label>
                            	<div class="form_input">
									<div class="special_normal">
											<input type="checkbox" tabindex="11" name="eventType"  id="special_normal_special" class="special_normal"  <?php if(!empty($eventsList)){ if($eventsList->row()->eventType!='Normal'){ ?> checked="checked" <?php }} ?>/>
									</div>
                               </div>
							</div>
							</li>
                            
                            <li id="specialEventsyle" >
                                  <div class="form_grid_12">
                                   	 <label class="field_title" for="logo_image">Special Event Image<span class="req">*</span></label>
                                        <div class="form_input">
                                          <input name="imagePath" id="imagePath" type="file" tabindex="5" class="large tipTop" title="Please select the special event image"/>
                                        </div>
                                        <?php if(!empty($eventsList)){ ?>
                                 <br /><div class="form_input"><img src="<?php echo base_url().EVENT_PATH.$eventsList->row()->imagePath;?>" width="100px"/></div>
                                 		<?php } ?>
                                  </div>
                            </li>
                            
                            
                             <li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Event Date<span class="req">*</span></label>
							<div class="form_input">
							<?php // echo $eventsList->row()->eventDate; ?>
							
								<input name="eventDate" id="eventDate" type="text" tabindex="6" class="required small tipTop" title="Please select the date" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventDate; } ?>"/>
							</div>
							</div>
							</li>
                            
                             <li>
                                <div class="form_grid_12">
                                    <label class="field_title" for="attribute_name">Event Time<span class="req">*</span></label>
                                    <div class="form_input">
                                        <input name="eventTime" id="eventTime" type="text" tabindex="1" class="required large tipTop" title='Please enter the time, Ex: " 12:00am - 11:59pm EST "' value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventTime; } ?>"/>
                                         <div class="error">Note: Please enter the correct time format, For your reference &nbsp;" 12:00am - 11:59pm EST "</div>
                                    </div>
                                </div>
							</li>
                            
                            <li>
                                <div class="form_grid_12">
                                <label class="field_title" for="attribute_name">Event Link<span class="req"></span></label>
                                <div class="form_input">
                                    <input name="eventLink" id="eventLink" type="text" tabindex="1" class="large tipTop" title="Please enter the event link page" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventLink; } ?>"/>
                                    <br /><div class="error">Note: Please enter start with "http://"</div>
                                </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="form_grid_12">
                                <label class="field_title" for="attribute_name">Event Button Name<span class="req"></span></label>
                                <div class="form_input">
                                    <input name="eventButtonName" id="eventButtonName" type="text" tabindex="1" class="large tipTop" title="Please enter the event button name" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventButtonName; } ?>"/>
                                </div>
                                </div>
                            </li>
                            
                            
                            
                            <li>
                                <div class="form_grid_12">
                                <label class="field_title" for="attribute_name">Location<span class="req"></span></label>
                                <div class="form_input">
                                    <input name="eventLocation" id="eventLocation" type="text" tabindex="1" class="large tipTop" title="Please enter the event button name" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventLocation; } ?>"/>
                                </div>
                                </div>
                            </li>
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status"<?php if(!empty($eventsList)){ if($eventsList->row()->status=='Active') { ?> checked="checked"  <?php }}else{ ?> checked="checked" <?php } ?>id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    <input type="hidden" name="event_id" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->id; } ?>" />
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


<script src="js/datepicker.js"></script>

<script>
  $(function() {
    $( "#eventDate" ).datepicker();
	//$( "#eventDate" ).datepicker( "option", "dateFormat",'y-m-d' );
 });
  </script>
<script type="text/javascript">
	
	/* 	new JsDatePick({
			useMode:2,
			target:"eventDate",
			limitToToday:false,
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
	//	});
	 
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>