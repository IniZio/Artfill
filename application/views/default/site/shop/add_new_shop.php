<?php
 
$this->load->view('site/templates/shop_header'); //$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);

?>

<?php $fullstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&amp;sensor=false"></script>
<div class="clear"></div>
<section class="container">

    	<div class="main">  	
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('comm_shopname') != '') { echo stripslashes($this->lang->line('comm_shopname')); } else echo 'Shop Name'; ?></li>
        </ul>
		<div  class="shop_details">
            <form action="your-shop" name="shop_name_form" id="shop_name_form" method="post" onsubmit="return check_shopname(this);">
            	<span class="shop_title"> <?php if($this->lang->line('comm_shopname') != '') { echo stripslashes($this->lang->line('comm_shopname')); } else echo 'Shop Name'; ?> </span>

                <p><?php if($this->lang->line('shop_name') != '') { echo stripslashes($this->lang->line('shop_name')); } else echo 'Your shop name appears with your items in the'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_marketplace') != '') { echo stripslashes($this->lang->line('shop_marketplace')); } else echo "marketplace. Pick a name that has personal significance or helps identify what's in your shop"; ?>.</p>
                <div style="width: 97%; padding: 30px 10px;" class="shop_name_save">

                	<label><?php if($this->lang->line('comm_shopname') != '') { echo stripslashes($this->lang->line('comm_shopname')); } else echo 'Shop Name'; ?></label>

                   <!-- <input type="text" class="checkout_txt" name="seller_businessname" id="seller_businessname" value="<?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?>" autocomplete="off"  onchange="return check_shopname()" style="width:425px; height:27px" />-->
                   <!--onkeypress="return blockSpecialChar(event)"      //onPaste="return false"-->

                    <input type="text" class="checkout_txt" name="seller_businessname" id="seller_businessname" value="<?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?>" autocomplete="off" onCopy="return false" onDrag="return false" onDrop="return false" 
  onblur="return check_shopname(this);"  onkeyup="return check_shopname(this);" style="width:425px; height:27px" />
                    <div id="errMsg" style="color:#FF3333"></div>

                    <span class="note"><?php if($this->lang->line('shop_change') != '') { echo stripslashes($this->lang->line('shop_change')); } else echo 'You can change your shop name later'; ?><?php echo $fullstop ?></span>
					
					<label><?php if($this->lang->line('com_location') != '') { echo stripslashes($this->lang->line('com_location')); } else echo 'Location'; ?></label>
					
					<input type="text" class="checkout_txt" name="shop_location" id="shop_location" placeholder="<?php echo af_lg('lg_enter_location','Enter a location');?>" value="<?php  echo stripslashes($selectSeller_details[0]['shop_location']); ?>" style="width:425px; height:27px; margin-left: 17px;" />
					
					<div id="errLocMsg" style="color:#FF3333"></div>
<div style="display:none;" id="error_msg"><span style="color: red;" ><?php if($this->lang->line('special_characters_not_allowed') != '') { echo stripslashes($this->lang->line('special_characters_not_allowed')); } else echo "You are not supposed to use any special characters for your shop name"; ?><span></div>
                </div>
               <!--<input type="submit" style="display:none" value="Save" id="submitName" class="save_btn" />-->

                <input type="button" onclick="return check_shopname(this);" id="save-btn" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" class="save_btn" />



              

                </form>

                 

            </div>

           

            

    	</div>
		
		</section>

     
 <script>

	var checkName = function(){
		var regx = /^[A-Za-z0-9 _.-]+$/;
		if(!(regx.test($('#seller_businessname').val())))
		{		
			$('#error_msg').css('display','block');
			return false;
		}else{
			$('#error_msg').css('display','none');
			return true;
		}
	};
function check_shopname(val) {

	//blockSpecialChar(); 
		var shopname=$('#seller_businessname').val();  //^[a-zA-Z0-9]\s{2,20}$
		var location =$('#shop_location').val();
		$('#errMsg').html('');
		$('#errLocMsg').html('');
		if(shopname.trim()=="" || shopname.trim()==null){
			$("#errMsg").html(lg_enter_shopname);
			return false;
		}else if(location== ""){
			$("#errLocMsg").html(lg_enter_your_location);
			return false;
		} 
		
		$.get('site/shop/Load_ajax_shopName_check?s_name='+shopname, function(data) {

			 if(data.trim() == 'exist'){ 

			 $("#errMsg").html(lg_shopname_already_exist);

			 return false;

			 } else {

			 $("#errMsg").html('');

			 var checksbt=val.id; // alert(checksbt);

				 if(checksbt == 'save-btn' && checkName())	{

				 $("#shop_name_form").submit();

				 }

				

			 }

		});

		

}





</script>



 <script type="text/javascript">

        function blockSpecialChar() {  

            //var k = e.keyCode;

            //return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57) || (k >= 106 && k <= 111));

			$('#seller_businessname').val($('#seller_businessname').val().replace(/[^A-Za-z0-9]/g, ''))

			

        }
function initialize(){
  autocomplete = new google.maps.places.Autocomplete((document.getElementById('shop_location')),{ types: ['geocode'] });
  google.maps.event.addListener(autocomplete, 'place_changed', function(){
	var place = autocomplete.getPlace();
  }); 
}
google.maps.event.addDomListener(window, 'load', initialize);





</script>

     
<?php 

$this->load->view('site/templates/footer');

?>

