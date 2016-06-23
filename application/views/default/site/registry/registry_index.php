<?php 
$this->load->view('site/templates/header'); 
?>




<script type="text/javascript">

$(document).ready(function() {		
	
	//Execute the slideShow
	slideShow();

});

function slideShow() {

	//Set the opacity of all images to 0
	$('#gallery a').css({opacity: 0.0});
	
	//Get the first image and display it (set it to full opacity)
	$('#gallery a:first').css({opacity: 1.0});
	
	//Set the caption background to semi-transparent
	$('#gallery .caption').css({opacity: 0.7});

	//Resize the width of the caption according to the image width
	$('#gallery .caption').css({width: $('#gallery a').find('img').css('width')});
	
	//Get the caption of the first image from REL attribute and display it
	$('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
	.animate({opacity: 0.7}, 400);
	
	//Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval('gallery()',6000);
	
}

function gallery() {
	
	//if no IMGs have the show class, grab the first image
	var current = ($('#gallery a.show')?  $('#gallery a.show') : $('#gallery a:first'));

	//Get next image, if it reached the end of the slideshow, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('caption'))? $('#gallery a:first') :current.next()) : $('#gallery a:first'));	
	
	//Get next image caption
	var caption = next.find('img').attr('rel');	
	
	//Set the fade in effect for the next image, show class has higher z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);

	//Hide the current image
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');
	
	//Set the opacity to 0 and height to 1px
	$('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
	
	//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
	$('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '20px'},500 );
	
	//Display the content
	$('#gallery .content').html(caption);
	
	
}

</script>
<style type="text/css">
body{
	font-family:arial
}

.clear {
	clear:both
}

#gallery  {
    height: 280px;
    margin: 30px 0;
	overflow: hidden;
    position: relative;
}
	#gallery a {
		float:left;
		position:absolute;
	}
	
	#gallery a img {
		border:none;
	}
	
	#gallery a.show {
		z-index:500
	}

	#gallery .caption {
		z-index:600; 

		color:#ffffff; 
		height:100px; 
		width:100%; 
		position:absolute;
		bottom:0;
	}

	#gallery .caption .content {
    bottom: 2px;
    left: 40px;
    margin: 0 0 20px 20px;
    position: absolute;
}
	
	#gallery .caption .content h3 {
		margin:0;
		padding:0;
		color:#1DCCEF;
	}
	
	
.aurtor-link-texr a{font-weight:bold; margin:0 0 0 4px }

</style>



<style>
#cboxLoadedContent{background:none;}


.registrycreatebtn{

border-radius: 2px; font-size: 12px;
    height: 25px;
    line-height: 15px;
    margin: 5px 5px 0 0;
    padding: 0;
    text-align: center;
    width: 168px;

}

.input-group{
box-shadow: 0 0 6px 0 #ccc;
    margin: 5px 0 0 8px;

}

</style>


<div id='registry_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="registry_index_contaner">
			     <form action="site/market/insertRegistry" method="post"> 
					<div style="background:#EAF7FD;heigth:400px; margin:0px" class="sign_in_form">
						<div style="border:none; margin:0; padding:0" class="sign_in_form-inner">
							<div style="float:left; width:100%;" class="sign_head5">
								<h2 style="font-size: 20px;"><?php if($this->lang->line('seller_wedding') != '') { echo stripslashes($this->lang->line('seller_wedding')); } else echo 'When is your wedding'; ?>?</h2> 
								<input type="text"  name="registryDate" id="registryDate" class="payment_txt required" placeholder="<?php echo af_lg('lg_select_date','Select the date');?>" value="" />	                 
								<div style="float: left;">					
									<div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="registryDate" data-link-format="yyyy-mm-dd">		
														
									</div>															
								</div>		
							</div> 
						  <div class="modal-footer footer_tab_footer">
								<div class="btn-group">
										 <input class="submit_btn" type="submit" value="<?php echo af_lg('lg_create_registry','Create Registry');?>" name="submitRegistry" />
										<a class="btn btn-default submit_btn" data-dismiss="modal" id="report-cancel"><?php if($this->lang->line('user_cancel') != '') { echo stripslashes($this->lang->line('user_cancel')); } else echo 'Cancel'; ?></a>
								</div>
							</div>		
						 </div>						 					
					</div>
                </form>
			 </div>
		 </div>
	</div>	
</div>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


<section>
    <div class="registary_landing_top">
        <div class="main">
			<div class="registary-left1">
				<div id="registary_landing_top-title">
					<a href="category-list/68-weddings"><?php if($this->lang->line('user_weddings') != '') { echo stripslashes($this->lang->line('user_weddings')); } else echo 'Weddings'; ?></a>
				</div>
				<h1>
					<div id="feed-header"><?php if($this->lang->line('seller_registry') != '') { echo stripslashes($this->lang->line('seller_registry')); } else echo 'Your Registry'; ?>  <a href="<?php echo current_url();?>" class="twitter-share-button" data-lang="en" data-count="none"><?php if($this->lang->line('shopsec_tweet') != '') { echo stripslashes($this->lang->line('shopsec_tweet')); } else echo 'Tweet'; ?></a></div>
				</h1>
			</div>
        </div>
    </div>
    <div class="main">
		<div class="banner-registarty">			  
			 <div class="banner_container">
						<h2 class="headline"><?php if($this->lang->line('seller_register') != '') { echo stripslashes($this->lang->line('seller_register')); } else echo 'Register with'; ?> <?php echo $this->config->item('email_title');?>.</h2> 
						<h2><?php if($this->lang->line('seller_uniquegifts') != '') { echo stripslashes($this->lang->line('seller_uniquegifts')); } else echo 'Unique gifts for the next chapter of your life'; ?>.</h2>
						<?php if($loginCheck!= '') {?>
						<a href="#registry_popup" data-toggle="modal">
							<input style=" margin: 30px 0 0 350px;" class="save_btn" type="button" value="<?php if($this->lang->line('seller_createregistry') != '') { echo stripslashes($this->lang->line('seller_createregistry')); } else echo 'Create Wedding Registry'; ?>">
						</a>
						<?php } else {?>
						<a href="login?action=registry" >
							<input style=" margin: 40px 0 0;" class="save_btn" type="button" value="<?php if($this->lang->line('seller_createregistry') != '') { echo stripslashes($this->lang->line('seller_createregistry')); } else echo 'Create Wedding Registry'; ?>">
						</a>
						 <?php }?>
						</div>
			<div id="gallery">
				<?php foreach($registryBannerList->result() as $BImg) {?>					
				<a style="cursor:default">
					<img src="images/banner/<?php echo $BImg->seller_banner;?>" alt="Pier" width="980" rel="<span style='color:#888;'>Photo by</span><a href='shop-section/<?php echo $BImg->seourl;?>'><?php echo $BImg->seller_businessname;?></a>"/>
				</a>
				<?php }?>
				<div class="caption"><div class="content"></div></div>
		     </div>			
		</div>
	</div>
</section>

<link href="datepicker/css/default/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript">
//this is for Date only	
 	$('.form_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		 startDate: new Date()
    });

</script>

<?php 
$this->load->view('site/templates/footer');
?>
