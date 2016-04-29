<?php $this->load->view('site/templates/header');

 ?>
<script src="js/jquery/jRating.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/default/jRating.jquery.css" type="text/css" />	
    <div class="clear"></div>
<!--selection-->
<section>
	
    	<div class="main">
        <div class="wrapper">
        <ul class="vertical_link">
        	<li> <a href="<?php base_url(); ?>" class="a_links">Home</a></li>
            <li> <a href="javascript:void(0);" class="a_links">Product Feedback</a></li>
        </ul>
        <div class="blog_setup">
        <div class="heading" style="font-size:16px;">Feedback</div>
        
        
             
</div>

        <div class=" clear"></div>

 <!-- <div id='inline_reg' style='background:#fff;'>  
	
    <div class="popup_tab_content" style="min-height:380px;">-->
    	
        <div class="clear"></div>
       <form id="form3" method="post"  action="site/product/feedback" onsubmit="return AddFeedback();" enctype="multipart/form-data">

        <div class="popup_login" style=" margin-left:20px; margin-top:20px; width:59%;">
	<label style="font-size:14px;"><?php if($this->lang->line('feedback_title') != '') { echo stripslashes($this->lang->line('feedback_title')); } else echo "Title"; ?><span style="color:#F00; ">*</span><span style="color:#F00;" class="redFont" id="title_Err"></span></label>   
            <input type="text" name ="title" id= "title" class="search" style="margin:5px 0 8px 0px; width:61%;" />
            <label style="font-size:14px;"><?php if($this->lang->line('feedback_description') != '') { echo stripslashes($this->lang->line('feedback_description')); } else echo "Description"; ?></label>
            <textarea class="search" id="description" name = "description" style="height:60px; margin:5px 0 8px 0px; width:61%;"></textarea>
            <label style="font-size:14px;"><?php if($this->lang->line('feedback_star_rating') != '') { echo stripslashes($this->lang->line('feedback_star_rating')); } else echo "Star Rating"; ?></label>
               <div class="feedback_rating">
                 <div class="rating-text">
					<input type="hidden" name="store_name" id="store_name" value="<?php echo $userVal[0]['seller_businessname'];?>" />	
					<input type="hidden" name="seller_product_id" id="seller_product_id" value="<?php echo $productVal[0]['id'];?>" />	

                         <input type="hidden" name="rate" id="rate" value="<?php echo $loginCheck; ?>" />	
                    <input type="hidden" name="path" id="path" value="<?php echo base_url(); ?>" />	

                           <div class="exemple">
                    <?php if($loginCheck!=''){  ?>
                    
						<div class="star_rating">    
							<div class="exemple5" data="10_5"  style="width:60%;"></div>
                        </div>    
                         <?php }else{ ?>   
						<div class="star_rating" style="height:35px;">    	                         
                         	<div style="cursor:pointer;"><img src="images/10stars.png" alt="stars" onclick="javascript:sivarating();" /></div>
                            <div id="PetVoteRate"></div>
						</div>	                            
                         <?php } ?>
						</div>
                                <div class="clear"></div>
<br />
                     						<input type="hidden" name="rating_value" id="rating_value"  />	

                   </div>  
            	<img src="images/rating.png" />

            </div>
         
        </div>
        
        <div class="popup_login" style=" margin-left:10px;width:30%; ">
        	<div class="detailsplit  " style=" background:none; width:312px; height:300px;">
             <div class="clear"></div>
                                        <p style="margin-bottom:5px;"><?php echo $productVal[0]['product_name']; ?></p>
 				      <div class="item_left">
        
        <?php if($userVal[0]['product_template'] == 'left') { ?>
			
            <link type="text/css" rel="stylesheet" href="css/default/site/silde/store-1/jquery.galleryview-3.0-dev.css" />
            <script type="text/javascript" src="js/site/jquery-ui-1.8.18.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.timers-1.2.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.galleryview-3.0-dev.js"></script>
            
            <script type="text/javascript">
            	$(function(){
                	$('#myGallery').galleryView({
                    transition_speed: 2000, 	//INT - duration of panel/frame transition (in milliseconds)
                    transition_interval: 4000, 	//INT - delay between panel/frame transitions (in milliseconds)
                    easing: 'swing', 			//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)
                    show_panels: true, 				//BOOLEAN - flag to show or hide panel portion of gallery
					show_panel_nav: false, 			//BOOLEAN - flag to show or hide panel navigation buttons
                    enable_overlays: true, 			//BOOLEAN - flag to show or hide panel overlays
                                
                    panel_width: 200, 				//INT - width of gallery panel (in pixels)
					panel_height: 200, 				//INT - height of gallery panel (in pixels)
                    panel_animation: 'slide', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)
                    panel_scale: 'crop', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)
                    overlay_position: 'bottom', 	//STRING - position of panel overlay (bottom, top)
                    pan_images: true,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery
                    pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
                    pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)
                    start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads
                    show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery
                    show_filmstrip_nav: true, 		//BOOLEAN - flag indicating whether to display navigation buttons
                    enable_slideshow: false,			//BOOLEAN - flag indicating whether to display slideshow play/pause button
                    autoplay: false,				//BOOLEAN - flag to start slideshow on gallery load
                    show_captions: false, 			//BOOLEAN - flag to show or hide frame captions	
                    filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery
                    filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
                    filmstrip_position: 'left', 	//STRING - position of filmstrip within gallery (bottom, top, left, right)
                    frame_width: 65, 				//INT - width of filmstrip frames (in pixels)
                    frame_height: 90, 				//INT - width of filmstrip frames (in pixels)
                    frame_opacity: 1, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)
                    frame_scale: 'crop', 			//STRING - cropping option for filmstrip images (same as above)
                    frame_gap: 5, 					//INT - spacing between frames within filmstrip (in pixels)
                    show_infobar: false,				//BOOLEAN - flag to show or hide infobar
                    infobar_opacity: 1				//FLOAT - transparency for info bar
            	});
			});
		</script>
                        
		<!--slide script-->
            <ul id="myGallery">
          		<?php  $fileImage = @explode(',',$productVal[0]['image']); foreach($fileImage as $Imgs){ if($Imgs !=''){ ?>
            	<li><img src="<?php echo PRODUCTPATH.$Imgs; ?>"  alt="<?php echo $productVal[0]['product_name']; ?>" /></li>
                <?php }} ?>
            </ul>
             
        <?php } else if($userVal[0]['product_template'] == 'bottom'){ ?>
             
            <link type="text/css" rel="stylesheet" href="css/default/site/silde/store-2/jquery.galleryview-3.0-dev.css" />			
			<script type="text/javascript" src="js/site/jquery-ui-1.8.18.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.timers-1.2.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="js/site/slide/jquery.galleryview-3.0-dev.js"></script>
            <script type="text/javascript">
            $(function(){
            	$('#myGallery').galleryView({
                	transition_speed: 2000, 		//INT - duration of panel/frame transition (in milliseconds)
                    transition_interval: 4000, 		//INT - delay between panel/frame transitions (in milliseconds)
                    easing: 'swing', 				//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)
                    show_panels: true, 				//BOOLEAN - flag to show or hide panel portion of gallery
                    show_panel_nav: false, 			//BOOLEAN - flag to show or hide panel navigation buttons
                    enable_overlays: true, 			//BOOLEAN - flag to show or hide panel overlays
                                
                    panel_width: 183, 				//INT - width of gallery panel (in pixels)
                    panel_height: 183, 				//INT - height of gallery panel (in pixels)
                    panel_animation: 'slide', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)
                    panel_scale: 'crop', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)
                    overlay_position: 'bottom', 	//STRING - position of panel overlay (bottom, top)
                    pan_images: true,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery
                    pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
                    pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)
                    start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads
                    show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery
                    show_filmstrip_nav: true, 		//BOOLEAN - flag indicating whether to display navigation buttons
                    enable_slideshow: false,			//BOOLEAN - flag indicating whether to display slideshow play/pause button
                    autoplay: false,				//BOOLEAN - flag to start slideshow on gallery load
                    show_captions: false, 			//BOOLEAN - flag to show or hide frame captions	
                    filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery
                    filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
                    filmstrip_position: 'bottom', 	//STRING - position of filmstrip within gallery (bottom, top, left, right)
                    frame_width: 65, 				//INT - width of filmstrip frames (in pixels)
                    frame_height: 80, 				//INT - width of filmstrip frames (in pixels)
                    frame_opacity: 1, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)
                    frame_scale: 'crop', 			//STRING - cropping option for filmstrip images (same as above)
                    frame_gap: 5, 					//INT - spacing between frames within filmstrip (in pixels)
                    show_infobar: false,				//BOOLEAN - flag to show or hide infobar
                    infobar_opacity: 1				//FLOAT - transparency for info bar
            	});
			});
		</script>
                 
        		<ul id="myGallery">
           		<?php  $fileImage = @explode(',',$productVal[0]['image']);
						foreach($fileImage as $Imgs){ if($Imgs !=''){ ?>
            	<li><img src="<?php echo PRODUCTPATH.$Imgs; ?>"  alt="<?php echo $productVal[0]['product_name']; ?>" /></li>
                <?php }} ?>
			</ul>
          
        <?php } else if($userVal[0]['product_template'] == 'full'){ ?>
             
		<link rel="stylesheet" href="css/default/site/silde/store-3/nivo-slider.css" media="screen"/>
		<!--<script src="js/site/slide/store-3/jquery.1.6.2.min.js"></script>-->
        <script src="js/site/slide/store-3/jquery.nivo.slider.pack.js"></script>
        <script>
        	$(window).load(function() {
            	$('#slider').nivoSlider({
                	directionNavHide: false,
                    captionOpacity: 1,
                    prevText: '<',
                    nextText:'>'
                });
			});
		</script>
        
        <div class="product_view" style="background:none;">
        	<div id="banner">
				<div class="flexslider">
        
				   	<div class="slider-wrapper futurico-theme">
					    <div id="slider" class="nivoSlider"> 
                        <?php  $fileImage = @explode(',',$productVal[0]['image']);
							foreach($fileImage as $Imgs){ if($Imgs !=''){ ?>
			            		<img src="<?php echo PRODUCTPATH.$Imgs; ?>"  alt="<?php echo $productVal[0]['product_name']; ?>" />
            			<?php }} ?>
						</div>
						<div id="caption1" class="nivo-html-caption"> <strong>New Project</strong> <span></span> <em>Some description here</em>. </div>
						<div id="caption3" class="nivo-html-caption"> <strong>Image 3</strong> <span></span> <em>Some description here</em>. </div>
					</div>
				</div>
			</div>
		</div>
             
        <?php } ?>     
                                                           </div>
                                       
                                       
                                      
                                    </div>
            
            </div>
         
        </div>
        
        
        
        <div class="clear"></div>
        
        
          	<input type="submit" class="submit_1" value="Submit" style=" margin-left:20px; margin-top:10px" />
             
        
          
          	
  		<!--	  </div>  
    
 		 </div>-->
  
   </div>
      
 </div>
</div>
        
    
 
	
</section>
<!--selection-->
<script type="text/javascript">
		$(document).ready(function(){
			$('.exemple5').jRating({
				length:4.6,
				decimalLength:1,
				onSuccess : function(){
					alert('Success : your rate has been saved :)');
				},
				onError : function(){
					alert('Error : please retry');
				}
			});
		});
	</script>
<?php
$this->load->view('site/templates/footer');
?>