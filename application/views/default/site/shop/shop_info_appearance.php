<?php 
$this->load->view('site/templates/shop_header');

?>
<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>

<link href="css/cropper.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">
    	<div class="main">
		
  
  <ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('info_appearance') != '') { echo stripslashes($this->lang->line('info_appearance')); } else echo 'Info and appearance'; ?></li>
        </ul>
		
		
            <div style="margin-top:20px" class="manage-listing-heading">
                <h1><?php if($this->lang->line('shop_appearance') != '') { echo stripslashes($this->lang->line('shop_appearance')); } else echo 'Info & Appearance'; ?> </h1>
                <p><?php if($this->lang->line('shop_fleshout') != '') { echo stripslashes($this->lang->line('shop_fleshout')); } else echo 'Flesh out your shop with the following information'; ?> </p>
            </div>            
            <form id="policies" class="shop-form-policies" action="site/shop/shop_appearance_setting" method="post" enctype="multipart/form-data" onsubmit="return image_validate()" style="width:1250px">
            
            <div class="shop-policies-section list_wrap">
            <div class="shop-form-section-inner">
            
            <div class="shop_member">
           <label class="label-text"><?php if($this->lang->line('comm_shopname') != '') { echo stripslashes($this->lang->line('comm_shopname')); } else echo 'Shop Name'; ?>  </label>
		   <div class="shop_member_right">
           <input type="text" class="checkout_txt" name="seller_businessname" id="seller_businessname" value="<?php  echo stripslashes(strip_tags($selectSeller_details[0]['seller_businessname'])); ?>" autocomplete="off" onCopy="return false" onDrag="return false" onDrop="return false"
 onblur="return check_shopname(this);"  onkeyup="return check_shopname(this);" style="width:425px; height:27px" />
            <div id="errMsg" style="color:#FF3333"></div>
			</div>
            </div>
             <hr>
             
             
            <div class="shop_member">
                <label class="label-text"><?php if($this->lang->line('shop_shoptitle') != '') { echo stripslashes($this->lang->line('shop_shoptitle')); } else echo 'Shop Title'; ?>  </label>
				<div class="shop_member_right">
                <input id="shop_title" class="headline-shop" type="text" maxlength="55" value="<?php  echo stripslashes(strip_tags($selectSeller_details[0]['shop_title'])); ?>" name="shop_title"  onKeyUp="change('shop_title','goo_item_title')" />
				</div>
            </div>                        
            <hr>
            
            
            <?php if($selectSeller_details[0]['seller_store_image'] != ''){ ?>
            <div class="shop_member">
                <label class="label-text">現時店鋪橫幅</label>
                <div class="shop_member_right"><img src="images/store-banner/<?php print_r($selectSeller_details[0]['seller_store_image']); ?>"/></div>
            </div>
            <hr>
            <?php }?>
            
            
			<div class="shop_member">
                <label class="label-text">上載店鋪橫幅</label>
				<div class="shop_member_right">
				<div class="input-change" ><div>
<!--  <input type="button" onclick="document.getElementById('shop_banner_img').click()" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo 'Choose File'; ?>..."/><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo 'No File Selected'; ?></b></div></div> -->
<input type="button" onclick="document.getElementById('inputImage').click();$('#showcropImage').show();" value="<?php if($this->lang->line('choose_file') != '') { echo stripslashes($this->lang->line('choose_file')); } else echo 'Choose File'; ?>..."/><b id="no_file_selected"><?php if($this->lang->line('no_file_selected') != '') { echo stripslashes($this->lang->line('no_file_selected')); } else echo 'No File Selected'; ?></b></div></div>

				
                <input type="file" name="shop_banner" id="shop_banner_img" />
                
                <div style="padding:0px 0px 0px 141px;"><img id="loadedImgshop" src="images/loader64.gif" style="widows:25px; height:25px; display:none" /></div>
                
                <p class="inline-message" id="ErrImage"><?php if($this->lang->line('shop_upload') != '') { echo stripslashes($this->lang->line('shop_upload')); } else echo 'Upload a .jpg, .gif or .png that is 760px by 100px and no larger than 2MB'; ?>.<!--<a href="javascript:void(0);"><?php if($this->lang->line('shop_getideas') != '') { echo stripslashes($this->lang->line('shop_getideas')); } else echo 'Get ideas'; ?>.</a>--></p>
                <input type="hidden" id="imageResult" value="failure"/>
				</div>
            </div>
  
<div class="shop_member" id="cropImage">
      
<div class="container">
    <div class="row">
    
      <div class="col-md-12" id="showcropImage" style="display:none;width:1050px">
        <!-- <h3 class="page-header">Demo:</h3> -->
        <div class="img-container" style="width:1050px">
          <img src="images/store-banner/default_avat.png" alt="Picture">
        </div>
      </div>
      <div class="col-md-3" >
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix" style="display:none;">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>
        </div>

        <!-- <h3 class="page-header">Data:</h3> -->
        <div class="docs-data" style="display:none;">
          <div class="input-group">
            <label class="input-group-addon" for="dataX">X</label>
            <input class="form-control" id="dataX" name="left" type="text" placeholder="x">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group">
            <label class="input-group-addon" for="dataY">Y</label>
            <input class="form-control" id="dataY" name="top" type="text" placeholder="y">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group">
            <label class="input-group-addon" for="dataWidth"><?php echo af_lg('lg_width','Width');?></label>
            <input class="form-control" id="dataWidth" name="width" type="text" placeholder="width">
            <span class="input-group-addon">px</span>
          </div>
          <div class="input-group">
            <label class="input-group-addon" for="dataHeight"><?php echo af_lg('lg_height','Height');?></label>
            <input class="form-control" id="dataHeight" name="height" type="text" placeholder="height">
            <span class="input-group-addon">px</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 docs-buttons">
        <!-- <h3 class="page-header">Toolbar:</h3> -->

      
        <div class="btn-group" style="display:none;">
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
       
            <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">

            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
              <span class="icon icon-upload"></span>
            </span>
          </label>
        </div>

        <div class="btn-group btn-group-crop" id="preview" style="display:none;">
          <button class="btn btn-primary" data-method="getCroppedCanvas" type="button">
            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
             <?php echo af_lg('lg_preview','preview');?>
            </span>
          </button>
        </div>

        <!-- Show the cropped image in modal -->
        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="getCroppedCanvasTitle"><?php echo af_lg('lg_cropped','Cropped');?></h4>
              </div>
              <div class="modal-body"></div>
              <!-- <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal" type="button">Close</button>
              </div> -->
            </div>
          </div>
        </div><!-- /.modal -->

      </div><!-- /.docs-buttons -->
      
    </div>
  </div>

  <!-- Alert -->
  <div class="docs-alert"><span class="warning message"></span></div>
      
  </div>
<hr>
  
            <div class="shop_member">
                <label style="margin-top:0" class="label-text"><?php if($this->lang->line('shop_local') != '') { echo stripslashes($this->lang->line('shop_local')); } else echo 'Local Markets'; ?> </label>
                <div class="shop_member_right">
                <input type="checkbox" <?php  if(stripslashes($selectSeller_details[0]['local_markets'])=="Yes"){ echo 'checked="checked"';} ?>  value="true" name="local_markets"><?php if($this->lang->line('shop_upcoming') != '') { echo stripslashes($this->lang->line('shop_upcoming')); } else echo 'Show upcoming local markets you will attend on your shop page'; ?>? </div>
            </div>            
            <hr>
            <div class="shop_member">
                <?php  /*<label class="label-text"><?php if($this->lang->line('shop_links') != '') { echo stripslashes($this->lang->line('shop_links')); } else echo 'Links'; ?></label>
                <table class="fb-table">
                    <tbody>
                        <tr class="fb-link">
                            <td class="shown"><label><?php if($this->lang->line('shop_facebook') != '') { echo stripslashes($this->lang->line('shop_facebook')); } else echo 'Facebook Page'; ?></label></td>
                            <td  class="fb-account "><a id="fb-account-link" href="javascript:void(0)"><?php if($this->lang->line('user_connect_facebook') != '') { echo stripslashes($this->lang->line('user_connect_facebook')); } else echo 'Connect with Facebook'; ?></a></td>
                        </tr>            
                        <tr class="fb-link">
                            <td class="shown"><label style="background-position: 0 -219px;"><?php if($this->lang->line('shop_twitter') != '') { echo stripslashes($this->lang->line('shop_twitter')); } else echo 'Twitter Page'; ?></label></td>                
                            <td  class="fb-account "><a id="fb-account-link" href="javascript:void(0);"><?php if($this->lang->line('user_connect_twitter') != '') { echo stripslashes($this->lang->line('user_connect_twitter')); } else echo 'Connect with Twitter'; ?></a></td>
                        </tr>
                    </tbody>
                </table>
                
               <div class="facebook-mesg">
                    <span class="blue_arrow"></span>
                    <p  class="inline-message"><?php if($this->lang->line('shop_enable') != '') { echo stripslashes($this->lang->line('shop_enable')); } else echo 'Enable to gain Facebook fans and Twitter followers for your shop'; ?>.
                    <!--<a href="javascript:void(0);"><?php if($this->lang->line('user_learn_more') != '') { echo stripslashes($this->lang->line('user_learn_more')); } else echo 'Learn more'; ?></a>-->.</p>            
                </div> 
                <hr>*/          ?>  
                <div class="shop_member">
                    <label class="label-text"> <?php if($this->lang->line('shop_announcement') != '') { echo stripslashes($this->lang->line('shop_announcement')); } else echo 'Shop Announcement'; ?>  </label>
                    <div class="shop_member_right"><textarea id="shop_announcement" class="message121" rows="4" name="shop_announcement" style="overflow: hidden; border-color:#ccc; height: 101px;"  onKeyUp="change('shop_announcement','goo_item_desc')"><?php  echo stripslashes($selectSeller_details[0]['shop_announcement']); ?></textarea>
                    <p class="inline-message"><?php if($this->lang->line('shop_additionalpolicies') != '') { echo stripslashes($this->lang->line('shop_additionalpolicies')); } else echo 'Additional policies, FAQs, custom orders, wholesale & consignment, guarantees, etc'; ?><?php if($footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK") echo "。"; else echo "." ?></p></div>
                    <div id="showpreview">
                        <p> <?php if($this->lang->line('shop_preview') != '') { echo stripslashes($this->lang->line('shop_preview')); } else echo 'Preview how your shop homepage will appear in Google search results'; ?>: </p>
                        <div class="preview-body"><p class="showing-msg"><span id="goo_item_title"><?php  echo stripslashes($selectSeller_details[0]['shop_title']); ?></span><span id="goo_item_desc"><?php  echo stripslashes(strip_tags($selectSeller_details[0]['shop_announcement'])); ?></span>. </p></div>
                        <!--<p class="prev-notebook"><?php if($this->lang->line('shop_havequestions') != '') { echo stripslashes($this->lang->line('shop_havequestions')); } else echo 'Have questions'; ?>?<a target="_blank" href="javascript:void(0);"> <?php if($this->lang->line('shop_learnabout') != '') { echo stripslashes($this->lang->line('shop_learnabout')); } else echo 'Learn about how your shop appears on Google'; ?>. </a></p> -->          
                    </div>
                </div>
                <hr>
                <div class="shop_member">
                    <label class="label-text"><?php if($this->lang->line('shop_message') != '') { echo stripslashes($this->lang->line('shop_message')); } else echo 'Message to Buyers'; ?> </label>
                    <div class="shop_member_right"><textarea id="msg_to_buyers" class="message121" rows="4" name="msg_to_buyers" style="overflow: hidden; height: 101px; border-color: #CCCCCC;"><?php  echo stripslashes(strip_tags($selectSeller_details[0]['msg_to_buyers'])); ?></textarea>
                    <p class="inline-message"><?php if($this->lang->line('shop_include') != '') { echo stripslashes($this->lang->line('shop_include')); } else echo 'We include this message on receipt pages and in the email buyers receive when they purchase from your shop'; ?><?php if($footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK") echo "。"; else echo "." ?> </p></div>
                </div>
			</div>
		</div>
        </div>
        <div class="wid">
            <span class="button-large">
                <span>
                    <input type="submit" id= "save_changes" value="<?php if($this->lang->line('user_save_changes') != '') { echo stripslashes($this->lang->line('user_save_changes')); } else echo "Save Changes"; ?>" />
					
				</span>
            </span>
        </div> 
			<div style="display:none;" id="error_msg"><span style="color: red;" ><?php if($this->lang->line('special_characters_not_allowed') != '') { echo stripslashes($this->lang->line('special_characters_not_allowed')); } else echo "You are not supposed to use any special characters for your shop name"; ?><span></div>
        <input type="hidden" id="shop-banner" name="shop-banner" value="shop-banner-img" />          
    	</form> 
		</div>
	</section> 	
</div>
<script type="text/javascript">

$(document).ready(function(){

$('#shop_banner_img').on('change',function(){
	$('#no_file_selected').text(this.value);                       
});


 $("#shop_banner_img").change(function(e) {
 	alert("b");
     for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        
         var file = e.originalEvent.srcElement.files[i];
       
         //var img = document.createElement("img");
         var reader = new FileReader();
         reader.onloadend = function() {
              	//img.src = reader.result;
         		//$("#img").attr("src",reader.result);
         		$("#cropImage img").attr("src",reader.result);
         }
         reader.readAsDataURL(file);
         //$("#shop_banner_img").after(img);
     }
 });

});    



//$("#showcropImage").hide();

</script>

 <script>
function check_shopname(val) {

	var shopname=$('#seller_businessname').val();  //^[a-zA-Z0-9]\s{2,20}$
		if(shopname.trim()=="" || shopname.trim()==null){
			  $("#errMsg").html(lg_enter_shopname);
			  return false;
		 } 

		$.get('site/shop/Load_ajax_shopName_check?s_name='+shopname, function(data) {
			if(data.trim() == 'exist'){ 
			 $("#errMsg").html(lg_shop_exist);
			 return false;
			 } else {
			 $("#errMsg").html('');

 			 }
		});
}
</script>

  <!--<script src="js/cropper/jquery.min.js"></script>
  <script src="js/cropper/bootstrap.min.js"></script>-->
  <script src="js/cropper/cropper.js"></script>
  <script src="js/cropper/main.js"></script>
<script>

$(".img-container > img").cropper({
	cropBoxResizable: false,
	dragCrop: false,
	  aspectRatio: 1000 / 315,
	  cropBoxMovable: true,
	  preview: ".img-preview",
	  crop: function(e) {
	    $("#dataX").val(Math.round(e.x));
	    $("#dataY").val(Math.round(e.y));
	    $("#dataHeight").val(Math.round(e.height));
	    $("#dataWidth").val(Math.round(e.width));
	    $("#dataRotate").val(e.rotate);
	    $("#dataScaleX").val(e.scaleX);
	    $("#dataScaleY").val(e.scaleY);
	  }
});

function image_validate(){
	
// 	if($("#imageResult").val() != 'success'){
// 		alert("Uploaded Image Too Small. Please Upload Image Size More than or Equalto 1000 X 315");
// 		return false;
// 	}
}
</script>
<?php // kethen was here, enabling Chinese shop names 25/1/2016 ?>
 <script>
	$('#save_changes').click(function(){
		// return true;
		var regx = /^[A-Za-z0-9 _.-]+$/;
		if(!(regx.test($('#seller_businessname').val())))
		{		
			$('#error_msg').css('display','block');
			return false;
		}else{
			$('#error_msg').css('display','none');
			return true;
		}
	});
 </script>
<?php 
$this->load->view('site/templates/footer');
?>