<?php $this->load->view('site/templates/header');  ?>

<script src="js/jquery.validate.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/default/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<script>$(document).ready(function(){$("#addevent_form").validate(); });</script>
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
<!--selection-->
<section class="container">
	
    	<div class="main">
        <div class="wrapper">
        <ul class="vertical_link">
        	<li> <a href="<?php echo base_url(); ?>" class="a_links">Home</a></li>
            <li> <a href="events" class="a_links">Events</a></li>
        </ul>
     
        <div class="clear"></div>
        <div class="community_head">
                	<h1><?php echo $heading; ?></h1>
                    <span></span>
                </div>
     
        	<div class="left_split">
            
            	<!-- Side Menu for Community Satart---------------------->
           			<?php  $this->load->view('site/community/templates/community_menu');  ?>
           		<!-- Side Menu for Community End---------------------->   
                   <div class="clear"></div>
                   <div class="middle_margin"></div>
                    <div class="side_panel">
                        	<h2>Sign up for the <?php echo $this->config->item('email_title'); ?> Success Newsletter</h2>
                            <input type="button" class="subscribe_btn" value="Subscribe">
                            <p style="margin:5px 0 0"><a href="#">See our other newsletters</a></p>
                        </div>  
                  
                  
                    <div class="side_link">
                     <ul>
                        
                        	<li><a href="#">Your Threads</a></li>
                            
                            <li><a href="#">What are Teams?</a></li>
                            
                            <li><a href="#">Fellowship Program</a></li>
                            
                            <li><a href="#">Community Guidelines</a></li>
                            
                        </ul>
                    
                    </div> 
                   
            </div>
            <div class="right_split">
             <?php $attributes = array('class' => 'form_container left_label', 'id' => 'addevent_form', 'enctype' => 'multipart/form-data');
							echo form_open_multipart('site/community/insertEvent',$attributes);
					?>
                    
             <div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0px; width:97%;">          
                 
                    <div class="cardinfo_div">
                    	<label>Event Title<span style="color:#F00;">*</span></label>
                        <input type="text" class="payment_txt required" name="eventTitle" id="eventTitle">
                    </div>
                   
                    <div class="cardinfo_div">
                    	<label>Description<span style="color:#F00;">*</span></label>
                        <textarea class="payment_area required" name="eventDescription" id="eventDescription"></textarea>
                    </div>
                    <div class="cardinfo_div">
                    	<label>Event Type</label>
                       <!-- <input name="rado" type="radio" value="Special" />-->
                      <div class="cardinfo_div" style="width:110px; float:left;">
                      
                      <input name="eventType" type="radio" value="Special" class="special_normal" style="margin-top:8px; float:left;" />
                      <label style="width:60%; margin-right:0px;">Special</label>
                     
                      </div>
                       <div class="cardinfo_div" style="width:110px; float:left;">
                       
                        <input name="eventType" type="radio" value="Normal" style="margin-top:8px; float:left;" class="special_normal" checked="checked" />
                        <label style="width:60%; margin-right:0px;  ">Normal</label>
                      </div>
                   </div>
                    <div class="cardinfo_div" id="specialEventsyle" style="display:none">
                    	<label>Special Event Image<span style="color:#F00;">*</span></label>
                        <input type="file" class="payment_txt required" name="imagePath" id="imagePath" >
                    </div>
                      <div class="cardinfo_div">
                    	<label>Event Date<span style="color:#F00;">*</span></label>
                         <input type="text" class="payment_txt datepicker required" name="eventDate" id="eventDate">
                        
                       
                    </div>
                    <div class="cardinfo_div">
                    	<label>Event Time<span style="color:#F00;">*</span></label>
                         <input type="text" class="payment_txt required" name="eventTime" id="eventTime">
                         <div class="clear"></div>
                         <span style="font-size:11px; color:#F00; float:right; margin-right:90px">Note: Please enter the correct time format, For your reference  " 12:00am - 11:59pm EST "</span>
                 </div>
                 
                  <div class="cardinfo_div">
                    	<label>Event Button Name</label>
                         <input type="text" name="eventButtonName" class="payment_txt">
                   </div>
                   <div class="cardinfo_div">
                    	<label>Event Button Link</label>
                         <input type="text" name="eventLink" class="payment_txt">
                   </div>
                   <div class="cardinfo_div">
                    	<label>Location</label>
                         <input type="text" name="eventLocation" class="payment_txt">
                   </div>
                    
                   
               </div>  
               
               <div class="list_div" style="width:97%;">
                    	
                      <input type="submit" value="SUBMIT" style="margin:0" class="create_btn_1" style="float:left!importantt;">
                    </div>
                </form>        
                                               
            
                    
            <!--rightsplit-->
            </div>
            </d6iv>
        </div>
        
    
 
	
</section>
<script type="text/javascript">
	window.onload = function(){
		
		new JsDatePick({
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
		});
	};
</script>
<!--selection-->
<?php $this->load->view('site/templates/footer');  ?>