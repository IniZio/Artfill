<?php $this->load->view('site/templates/header');  ?>
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>

<link rel="stylesheet" href="css/jquery.ui.timepicker.css"/>
<link rel="stylesheet" href="css/jquery-ui.theme.css"/>
<script src="js/jquery.ui.timepicker.js"></script>
<script src="js/jquery.ui.core.js"></script>
<script type="text/javascript">
   /*  $(document).ready(function(){
        $('input[name="eventstartTime"]').ptTimeSelect();
		
		$('input[name="eventendTime"]').ptTimeSelect();
    }); */ 
</script>
<script>
$('#timepicker_minmax_inline').timepicker({
       // minTime: { hour: 9, minute: 15 },
        //maxTime: { hour: 16, minute: 30 },
        showLeadingZero: true
    });
    // to dinamically set the min and max time :
    function tpMinMaxSetMinTime( hour, minute ) {
        $('#timepicker_minmax_inline').timepicker('option', { minTime: { hour: hour, minute: minute} });
    }
    function tpMinMaxSetMaxTime( hour, minute ) {
        $('#timepicker_minmax_inline').timepicker('option', { maxTime: { hour: hour, minute: minute} });
    }
</script>

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

$(document).ready(function() {
   $('#eventstartTime').timepicker({
       showLeadingZero: false,
       onSelect: tpStartSelect,
      /*  maxTime: {
           hour: 16, minute: 30
       } */
   });
   $('#timepicker2').timepicker({
       showLeadingZero: false,
       onSelect: tpEndSelect,
      /*  minTime: {
           hour: 9, minute: 15
       } */
   });
});

// when start time change, update minimum for end timepicker
function tpStartSelect( time, endTimePickerInst ) {
   $('#timepicker2').timepicker('option', {
       minTime: {
           hour: endTimePickerInst.hours,
           minute: endTimePickerInst.minutes
       }
   });
}

// when end time change, update maximum for start timepicker
function tpEndSelect( time, startTimePickerInst ) {
   $('#eventstartTime').timepicker('option', {
       maxTime: {
           hour: startTimePickerInst.hours,
           minute: startTimePickerInst.minutes
       }
   });
}


</script>
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
            <li> <a href="manage-events" class="a_links"><?php if($this->lang->line('comm_events') != '') { echo stripslashes($this->lang->line('comm_events')); } else echo "Events"; ?></a></li>
            <span>&rsaquo;</span>
             <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_addevent') != '') { echo stripslashes($this->lang->line('com_addevent')); } else echo "Add Event"; ?></a></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content community_right">
      <div class="heading"><?php if($this->lang->line('com_eventst') != '') { echo stripslashes($this->lang->line('com_eventst')); } else echo "Eventst"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <div class="right_split">
            <div class="right_split">
             <?php $attributes = array('class' => 'form_container left_label', 'id' => 'addevent_form', 'enctype' => 'multipart/form-data');
							echo form_open_multipart('site/community/insertEvent',$attributes);
					?>
             <div class="new_post_content" style="width:124%;">          
                 
                    <div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('com_eventtitle') != '') { echo stripslashes($this->lang->line('com_eventtitle')); } else echo "Event Title"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
                        <input type="text" class="payment_txt required" name="eventTitle" id="eventTitle" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventTitle; }?>">
                    </div>
                   
                    <div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('shop_description') != '') { echo stripslashes($this->lang->line('shop_description')); } else echo "Description"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
                        <textarea class="payment_area required" name="eventDescription" id="eventDescription"><?php if(!empty($eventsList)){ echo $eventsList->row()->eventDescription; } ?></textarea>
                    </div>
                    <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('com_eventtype') != '') { echo stripslashes($this->lang->line('com_eventtype')); } else echo "Event Type"; ?></label>
                       <!-- <input name="rado" type="radio" value="Special" />-->
                      <div class="cardinfo_div" style="width:110px; float:left;">
                      
                      <input name="eventType" type="radio" value="Special" class="special_normal" style="margin-top:8px; float:left;" <?php if(!empty($eventsList)){ if($eventsList->row()->eventType=='Special'){?> checked="checked" <?php } } ?> />
                      <label style="width:60%; margin-right:0px;"><?php if($this->lang->line('com_special') != '') { echo stripslashes($this->lang->line('com_special')); } else echo "Special"; ?></label>
                     
                      </div>
                     
                       <div class="cardinfo_div" style="width:110px; float:left;">
                        <input name="eventType" type="radio" value="Normal" style="margin-top:8px; float:left;" class="special_normal"  <?php if(!empty($eventsList)){ if($eventsList->row()->eventType=='Normal'){?> checked="checked" <?php  } }else{ ?> checked="checked" <?php } ?> />
                        <label style="width:60%; margin-right:0px;  "><?php if($this->lang->line('com_normal') != '') { echo stripslashes($this->lang->line('com_normal')); } else echo "Normal"; ?></label>
                      </div>
                   </div>
                    <div class="cardinfo_div" id="specialEventsyle" <?php if(empty($eventsList)){ ?> style="display:none" <?php } ?> <?php if(!empty($eventsList)){ if($eventsList->row()->eventType=='Special'){?>  style="display:block" <?php } else{  ?> style="display:none"  <?php } ?> <?php  } ?>>
                    	<label><p class="teamnames"><?php if($this->lang->line('com_eventimage') != '') { echo stripslashes($this->lang->line('com_eventimage')); } else echo "Special Event Image"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
                        <input type="file" class="payment_txt <?php if(!empty($eventsList)){ if($eventsList->row()->imagePath==''){?> required <?php }} ?>" name="imagePath" id="imagePath" >
                    </div>
                    
                     <?php if(!empty($eventsList)){ if($eventsList->row()->eventType=='Special'){?> 
                      <div class="cardinfo_div" style="margin-left:180px;" >
                      
                     <img src="<?php echo base_url().EVENT_PATH.$eventsList->row()->imagePath; ?>" width="60px"  />
                     
                      </div>
                       <?php } } ?>
					<div class="input-group input-append date cardinfo_div" id="dateRangePicker">
						<label><p class="teamnames"><?php if($this->lang->line('com_eventdate') != '') { echo stripslashes($this->lang->line('com_eventdate')); } else echo "Event Date"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
						<input style="width: 288px;height: 29px; border-radius: 2px;" type="text" class="form-control payment_txt required" id="eventDate" name="eventDate" value="<?php if(!empty($eventsList)){ 
						$date = $eventsList->row()->eventDate;
						$date = str_replace('-', '/', $date);
						echo $eventDate = date('d/m/Y', strtotime($date));
						} ?>"/>
						<span style="display:none;" class="input-group-addon add-on"></span>
					</div>
                  <div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('com_eventstarttime') != '') { echo stripslashes($this->lang->line('com_eventstarttime')); } else echo "Event Start Time"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
						
                         <input type="text" readonly class="payment_txt required" name="eventstartTime"  id="eventstartTime" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventstartTime; } ?>">
						 
				</div>
				<div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('com_eventendtime') != '') { echo stripslashes($this->lang->line('com_eventendtime')); } else echo "Event End Time"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
						
                         <input type="text" readonly class="payment_txt required" name="eventendTime" id="timepicker2" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventendTime; } ?>">
						 
                 </div>
                 
                  <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('com_buttonname') != '') { echo stripslashes($this->lang->line('com_buttonname')); } else echo "Event Button Name"; ?></label>
                         <input type="text" name="eventButtonName" class="payment_txt" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventButtonName; } ?>" >
                   </div>
                   <div class="cardinfo_div">
                    	<label><?php if($this->lang->line('com_eventbutton') != '') { echo stripslashes($this->lang->line('com_eventbutton')); } else echo "Event Button Link"; ?></label>
                         <input type="text" name="eventLink" id="eventLink" class="payment_txt" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventLink; } ?>" onchange="return eventlinkcheck();">
                         <div class="clear"></div>
                         <span style="font-size:11px; color:#F00; float:right; margin-right:420px"><?php if($this->lang->line('com_note') != '') { echo stripslashes($this->lang->line('com_note')); } else echo 'Note: starts with "http://"'; ?></span>
                   </div>
                   <div class="cardinfo_div">
                    	<label><p class="teamnames"><?php if($this->lang->line('com_location') != '') { echo stripslashes($this->lang->line('com_location')); } else echo "Location"; ?></p><span style="color:#F00; margin: 0px;">*</span></label>
                         <input type="text" id="autocomplete" name="eventLocation" class="payment_txt required" placeholder="<?php echo artfill_lg('lg_enter_location','Enter a location');?>"value="<?php if(!empty($eventsList)){ echo $eventsList->row()->eventLocation; } ?>">
                   </div>
                    <input type="hidden" name="event_id" value="<?php if(!empty($eventsList)){ echo $eventsList->row()->id; } ?>" />
                    <input type="submit" value="<?php if($this->lang->line('user_submit') != '') { echo stripslashes($this->lang->line('user_submit')); } else echo "SUBMIT"; ?>" class="create_btn_1">
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
<script type="text/javascript">
$(document).ready(function(){
	$('#dateRangePicker').datepicker({
		todayBtn: "linked",
		clearBtn: true,
		autoclose: true,
		todayHighlight: true, 
		format: 'dd/mm/yyyy',
		beforeShow: function (input, inst) {
			setTimeout(function () {
            inst.dpDiv.css({
					top: 100,
					left: 200
				});
			}, 0);
		}
	});

});
function initialize(){
  autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{ types: ['geocode'] });
  google.maps.event.addListener(autocomplete, 'place_changed', function(){
	var place = autocomplete.getPlace();
  }); 
}
</script>
<script>
function eventlinkcheck(){
var lnk=document.getElementById('eventLink').value;
var res = lnk.substring(0, 7);
if(res!='http://'){
alert('In-valid Link');
return false;
} else {
return true;
}
}
</script>


<script type="text/javascript">      
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
.datepicker{z-index:9999 !important;}
</style>
<?php $this->load->view('site/templates/footer');  ?>