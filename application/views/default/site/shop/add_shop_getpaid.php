<?php 

$this->load->view('site/templates/shop_header');//$checkloginIDarr=$this->session->all_userdata(); echo "<pre>"; print_r($checkloginIDarr);

?>
<?php $footstop = $this->_ci_cached_vars["languageCode"] == "zh_HK" ? "。" : "." ?>
<style>

</style>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		 
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		file_browser_callback : "ajaxfilemanager",
		relative_urls : false,
		convert_urls: false,
		// Example content CSS (should be your site CSS)
		content_css : "css/default/example.css",
		 
		// Drop lists for link/image/media/template dialogs
		//template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
		 
		// Replace values for the template plugin
		template_replace_values : {
		username : "Some User",
		staffid : "991234"
		}
		});
		
		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash": 
					break;
				case "file":
					break;
				default:
					return false;
			}
            tinyMCE.activeEditor.windowManager.open({
                url: '<?php echo base_url();?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
            return false;			
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;
		}
</script>

<script type="text/ecmascript" src="js/site/custom_validation.js" ></script>
<script type="text/ecmascript" src="js/jquery.validate.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
$('.payment_mode').click(function(){
var chk_arr =  document.getElementsByName("payment_mode[]");
var chklength = chk_arr.length;  
var flag=0;
for(k=0;k< chklength;k++)
{
    if(chk_arr[k].checked == true){
	flag = 1;
	}
}

if(flag == 1){
$('#overall_err').html('');
}
 });
});
</script>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<?php //print_r($selectSeller_details);

$payment_mode=explode(",",$selectSeller_details[0]['payment_mode']);
//print_r($payment_mode);die;

?>
<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

<div class="main">

		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links"><?php if($this->lang->line('landing_your_shop') != '') { echo stripslashes($this->lang->line('landing_your_shop')); } else echo 'Your shop'; ?></a></li>
		   <span>&rsaquo;</span>
		   <li><?php if($this->lang->line('Get_paid') != '') { echo stripslashes($this->lang->line('Get_paid')); } else echo 'Get paid'; ?></li>
        </ul>


<div class="shop_details">

    			<span class="shop_title"><?php if($this->lang->line('shop_methods') != '') { echo stripslashes($this->lang->line('shop_methods')); } else echo 'Payment methods you accept'; ?><?php echo $footstop ?></span>                

				<div class="list_div1">

                	<div class="list_inner_fields" style="border:none">

                    	<div id="pay_text" class="pay_text" style="float:left;width:60%;margin:5px 0 20px;font-size:14px;line-height:22px;">

                        	<?php if($this->lang->line('shop_direct') != '') { echo stripslashes($this->lang->line('shop_direct')); } else echo 'Direct payment through'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_available') != '') { echo stripslashes($this->lang->line('shop_available')); } else echo 'is not yet available in your country. Please select one of the payment methods below'; ?><?php echo $footstop ?>

                        </div>

                        <img src="images/paypal.png" style="float:right; opacity:0.3" />

                    </div>            

                </div>

    			<div class="payment_div">

                	<h2><?php if($this->lang->line('shop_other') != '') { echo stripslashes($this->lang->line('shop_other')); } else echo 'Other payment options'; ?> </h2>

                    <!--<p><?php if($this->lang->line('shop_eligible') != '') { echo stripslashes($this->lang->line('shop_eligible')); } else echo 'These are not eligible for our'; ?> <a href="javascript: void(0);"><?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_protection') != '') { echo stripslashes($this->lang->line('shop_protection')); } else echo 'Seller Protection Program'; ?>.</a> </p>-->

                    <p class="pay_p"><?php if($this->lang->line('shop_recommend') != '') { echo stripslashes($this->lang->line('shop_recommend')); } else echo 'We recommend also signing up above to ensure'; ?> <?php echo $this->config->item('email_title'); ?> <?php if($this->lang->line('shop_redeemed') != '') { echo stripslashes($this->lang->line('shop_redeemed')); } else echo 'gift cards and credits can be redeemed in your shop'; ?><?php echo $footstop ?> </p>

                </div>

    <form method="post" action="site/shop/shop_getpaid_details" id="shop_payment">

		<div class="list_div" style="border-radius:5px 5px 0 0; margin:5px 0 0">

        	<span id="overall_err" class="errors_msg"></span>
<?php if($paypal_adaptive_settings['status']=='Enable'){ ?>
				<div class="payment_check">     
				
                <input type="checkbox" id="paypaladpt"  class = "payment_mode"  name="payment_mode[]"  value="PayPal Adaptive" />
                <label for="paypaladpt"><?php if($this->lang->line('shop_pay_adaptive') != '') { echo stripslashes($this->lang->line('shop_pay_adaptive')); } else echo 'PayPal Adaptive'; ?></label>
                <div class="payment_hide" style="display:none;" id="paypal_adap">
                <p><?php if($this->lang->line('shop_payments') != '') { echo stripslashes($this->lang->line('shop_payments')); } else echo 'Payments are sent to this email'; ?>. </p>
				<input type="hidden" id="ppsandbox"  name="PayPal_mode" value="Sandbox" />
                <table>
                	
                    <tr>
                    	<td><label><?php if($this->lang->line('shop_pay_merchant_mail') != '') { echo stripslashes($this->lang->line('shop_pay_merchant_mail')); } else echo 'PayPal Merchant Email'; ?> </label></td>
                        <td><input type="text" class="payment_txt required" id="merchantemail" name="Paypal_merchant_email" value="<?php echo $selectSeller_details[0]['Paypal_merchant_email']; ?>" /></td>
                        <td><span id="merchantemailErr" class="errors_msg"></span></td>
                    </tr>  
                                   
                </table>
                </div>
             <?php if (in_array("PayPal Adaptive", $payment_mode)) {echo '<script>$("#paypaladpt").prop("checked", true);$("#paypal_adap").css("display","block")</script>';	} ?>
            </div>
			<?php }else{ ?>
				<?php if($paypal_ipn_settings['status']=='Enable'){ ?>
            <div class="payment_check">                        

                <input type="checkbox" id="paypal" onchange="return shop_payment_disp1('paypal','paypal_wrap');" class = "payment_mode" name="payment_mode[]"  value="PayPal" />

                <label for="paypal"><?php if($this->lang->line('shop_pay') != '') { echo stripslashes($this->lang->line('shop_pay')); } else echo 'PayPal'; ?></label>

                <div class="payment_hide" style="display:none;" id="paypal_wrap">

                <p><?php if($this->lang->line('shop_payments') != '') { echo stripslashes($this->lang->line('shop_payments')); } else echo 'Payments are sent to this email'; ?>. </p>
			<input type="hidden" id="ppsandbox" name="PayPal_mode" value="Sandbox" />
                <table>

                	
                    <tr>

                    	<td><label><?php if($this->lang->line('shop_paypalaccount') != '') { echo stripslashes($this->lang->line('shop_paypalaccount')); } else echo 'PayPal account email'; ?> </label></td>

                        <td><input type="text" class="payment_txt required" id="emailaddress" name="PayPal_email" value="<?php echo $selectSeller_details[0]['PayPal_email']; ?>" /></td>

                        <td><span id="emailaddressErr" class="errors_msg"></span></td>

                    </tr>  
                </table>
                </div>

                <?php if (in_array("PayPal", $payment_mode)) {echo '<script>$("#paypal").prop("checked", true);$("#paypal_wrap").css("display","block")</script>';	} ?>

            </div>
			
			<?php }if($authorize_net_settings['status']=='Enable'){?>		
            <div class="Authorize">

                <input type="checkbox" id="Authorize"  class = "payment_mode" name="payment_mode[]" value="Authorize" onchange="return shop_payment_disp2('Authorize','Authorize_wrap')"/><label for="Authorize"><?php if($this->lang->line('shop_author') != '') { echo stripslashes($this->lang->line('shop_author')); } else echo 'Authorize'; ?></label>

                <div class="payment_hide" style="display:none;" id="Authorize_wrap">

                <p><?php if($this->lang->line('shop_creditcard_authorize') != '') { echo stripslashes($this->lang->line('shop_creditcard_authorize')); } else echo 'Credit Card (Authorize.net)'; ?> </p>
		<!--<input type="hidden" id="sandbox" name="PayPal_email" value="Sandbox" />-->
                <table>

                	

                    <tr>

                    	<td><label><?php if($this->lang->line('shop_loginid') != '') { echo stripslashes($this->lang->line('shop_loginid')); } else echo 'Login ID'; ?></label></td>

                        <td><input type="text" class="payment_txt required"  id="authorize_id" name="authorize_id" value="<?php echo $selectSeller_details[0]['authorize_id']; ?>"/></td>

                        <td><span id="authorize_idErr" class="errors_msg"></span></td>

                    </tr>

                    <tr>

                    	<td><label><?php if($this->lang->line('shop_transactionkey') != '') { echo stripslashes($this->lang->line('shop_transactionkey')); } else echo 'Transaction Key'; ?></label></td>

                        <td><input type="text" class="payment_txt required"  id="authorize_key" name="authorize_key" value="<?php echo $selectSeller_details[0]['authorize_key']; ?>"/></td>

                        <td><span id="authorize_keyErr" class="errors_msg"></span></td>

                    </tr>                    

                </table>

                </div>

                <?php if (in_array("Authorize", $payment_mode)) {echo '<script>$("#Authorize").prop("checked", true);$("#Authorize_wrap").css("display","block");</script>';} ?>

            </div>               
			
			<?php }if($stripe_settings['status']=='Enable'){?>
            <div class="Authorize">
                <input type="checkbox" id="Stripe" class = "payment_mode"  name="payment_mode[]" value="Stripe" onchange="return shop_payment_disp4('Stripe','Stripe_wrap')"/><label for="Authorize"><?php if($this->lang->line('shop_stripe') != '') { echo stripslashes($this->lang->line('shop_stripe')); } else echo 'Stripe'; ?></label>
                <div class="payment_hide" style="display:none;" id="Stripe_wrap">
                
				<input type="hidden" id="sandbox" name="stripe_mode" value="Sandbox" />
                <table>
                	<tr>
                    	<td><label><?php if($this->lang->line('shop_secret_key') != '') { echo stripslashes($this->lang->line('shop_secret_key')); } else echo 'Stripe Secret Key '; ?></label></td>
                        <td><input type="text" class="payment_txt required"  id="stripe_secret_key" name="stripe_secret_key" value="<?php echo $selectSeller_details[0]['stripe_secret_key']; ?>"/></td>
                        <td><span id="stripe_secret_keyErr" class="errors_msg"></span></td>
                    </tr>
                    <tr>
                    	<td><label><?php if($this->lang->line('shop_public_key') != '') { echo stripslashes($this->lang->line('shop_public_key')); } else echo 'Stipe Publishable Key'; ?></label></td>
                        <td><input type="text" class="payment_txt required"  id="stripe_publish_key" name="stripe_publish_key" value="<?php echo $selectSeller_details[0]['stripe_publish_key']; ?>"/></td>
                        <td><span id="stripe_publish_keyyErr" class="errors_msg"></span></td>
                    </tr>                    
                </table>
                </div>
				
                <?php if (in_array("Stripe", $payment_mode)) {echo '<script>$("#Stripe").prop("checked", true);$("#Stripe_wrap").css("display","block");</script>';} ?>
            </div>  
			<?php } ?>
			<?php } ?>
			 <div class="clear"></div>
           <div class="Cod">
                <input type="checkbox" id="Cod" class = "payment_mode"  name="payment_mode[]" value="COD" onchange="return shop_payment_disp4('Cod','Cod_wrap')"/><label for="Cod"><?php if($this->lang->line('shop_cod') != '') { echo stripslashes($this->lang->line('shop_cod')); } else echo 'Cash on Delivery'; ?></label>
                <div class="payment_hide" style="display:none;" id="Cod_wrap">
                <p><?php if($this->lang->line('shop_cod') != '') { echo stripslashes($this->lang->line('shop_cod')); } else echo 'Cash on Delivery Enabled'; ?> </p>
                
                </div>
                <?php  #cod_payment
#if($selectUser_details[0]["cod_available"]=="Yes")
if($this->config->item('cod_payment')=="Yes")
{
  if(in_array("COD", $payment_mode)) {echo '<script>$("#Cod").prop("checked", true);$("#Cod_wrap").css("display","block");</script>';} } 
else
{
  echo '<script>$(".Cod").css("display","none");</script>';
}  
  ?>
            </div> <div class="clear"></div>  
			 <div class="wire_transfer">
                <input type="checkbox" id="wire_transfer" class = "payment_mode"  name="payment_mode[]" value="wire_transfer" onchange="return shop_payment_disp3('wire_transfer','wire_transferwrap')"/><label for="wire_transfer"><?php if($this->lang->line('wire_transfer') != '') { echo stripslashes($this->lang->line('wire_transfer')); } else echo 'Wire Transfer'; ?></label>
                <div class="payment_hide" style="display:none;" id="wire_transferwrap">
				<p><?php if($this->lang->line('wire_transfer_enabled') != '') { echo stripslashes($this->lang->line('wire_transfer_enabled')); } else echo 'Wire Transfer Enabled'; ?></p>
                <textarea  style="width:370px;" name="wiretransfer_details" class="tipTop mceEditor"></textarea>
               
                </div>
				
                <?php  #cod_payment
#if($selectUser_details[0]["cod_available"]=="Yes")
if($this->config->item('cod_payment')=="Yes")
{
  if(in_array("wire_transfer", $payment_mode)) {echo '<script>$("#wire_transfer").prop("checked", true);$("#wire_transferwrap").css("display","block");</script>';} } 
else
{
  echo '<script>$(".wire_transfer").css("display","none");</script>';
}  
  ?>
            </div> <div class="clear"></div>  
			 <div class="western_union">
                <input type="checkbox" id="western_union" class = "payment_mode"  name="payment_mode[]" value="western_union" onchange="return shop_payment_disp3('western_union','western_unionwrap')"/><label for="western_union"><?php if($this->lang->line('western_union') != '') { echo stripslashes($this->lang->line('western_union')); } else echo'Western Union'; ?></label>
                <div class="payment_hide" style="display:none;" id="western_unionwrap">
                <p><?php if($this->lang->line('western_union_enabled') != '') { echo stripslashes($this->lang->line('western_union_enabled')); } else echo 'Western union Enabled'; ?> </p>
                  <textarea  style="width:370px;" name="westernunion_details"class="tipTop mceEditor"></textarea>
                </div>
                <?php  #cod_payment
#if($selectUser_details[0]["cod_available"]=="Yes")
if($this->config->item('cod_payment')=="Yes")
{
  if(in_array("western_union", $payment_mode)) {echo '<script>$("#western_union").prop("checked", true);$("#western_unionwrap").css("display","block");</script>';} } 
else
{
  echo '<script>$(".western_union").css("display","none");</script>';
}  
  ?>
            </div>  <div class="clear"></div>  
			</div>
            <?php /* if (in_array("Payu", $payment_mode)) {  ?>
            <div class="Payu">
                <input type="checkbox" id="Payu"  name="payment_mode[]" value="Payu" onchange="return shop_payment_disp3('Payu','Payu_wrap')"/><label for="Authorize"><?php if($this->lang->line('shop_payu') != '') { echo stripslashes($this->lang->line('shop_payu')); } else echo 'PayU'; ?></label>
                <div class="payment_hide" style="display:none;" id="Payu_wrap">
                <p><?php if($this->lang->line('shop_Payu') != '') { echo stripslashes($this->lang->line('shop_Payu')); } else echo 'Pay U '; ?> </p>
                <table>
                	<tr>
                    	<td><label><?php if($this->lang->line('shop_mode') != '') { echo stripslashes($this->lang->line('shop_mode')); } else echo 'Mode'; ?></label></td>
                        <td>	
                        	<?php if($selectSeller_details[0]['payu_mode']=='Live'){} ?>
                        	<input type="radio" id="live" name="payu_mode" value="Live" <?php if($selectSeller_details[0]['payu_mode']=='Live'){ echo 'checked="checked"'; } ?> />
                            <label for="live" style="float:none !important;"><?php if($this->lang->line('payu_live') != '') { echo stripslashes($this->lang->line('payu_live')); } else echo 'Live'; ?></label>
                            <input type="radio" id="sandbox" name="payu_mode" value="Sandbox" <?php if($selectSeller_details[0]['payu_mode']=='Sandbox'){ echo 'checked="checked"'; } ?>/>
                            <label for="sandbox" style="float:none !important;"><?php if($this->lang->line('payu_sandbox') != '') { echo stripslashes($this->lang->line('payu_sandbox')); } else echo 'Sandbox'; ?></label>
                        </td>
                        <td><span id="authorize_modeErr" class="errors_msg"></span></td>
                    </tr>
                    <tr>
                    	<td><label><?php if($this->lang->line('payu_merchant_id') != '') { echo stripslashes($this->lang->line('payu_merchant_id')); } else echo 'Merchant ID'; ?></label></td>
                        <td><input type="text" class="payment_txt"  id="payu_merchant_id" name="payu_merchant_id" value="<?php echo $selectSeller_details[0]['payu_merchant_id']; ?>"/></td>
                        <td><span id="payu_merchant_idErr" class="errors_msg"></span></td>
                    </tr>
                    <tr>
                    	<td><label><?php if($this->lang->line('payu_salt') != '') { echo stripslashes($this->lang->line('payu_salt')); } else echo 'Salt '; ?></label></td>
                        <td><input type="text" class="payment_txt"  id="payu_salt" name="payu_salt" value="<?php echo $selectSeller_details[0]['payu_salt']; ?>"/></td>
                        <td><span id="payu_saltErr" class="errors_msg"></span></td>
                    </tr> 
                     <tr>
                    	<td><label><?php if($this->lang->line('payu_email') != '') { echo stripslashes($this->lang->line('payu_email')); } else echo 'Pay U Email '; ?></label></td>
                        <td><input type="text" class="payment_txt"  id="payu_email" name="payu_email" value="<?php echo $selectSeller_details[0]['payu_email']; ?>"/></td>
                        <td><span id="payu_saltErr" class="errors_msg"></span></td>
                    </tr>                    
                </table>
                </div>
                <?php if (in_array("Payu", $payment_mode)) {echo '<script>$("#Payu").prop("checked", true);$("#Payu_wrap").css("display","block");</script>';} ?>
            </div>
            <?php } */ ?>
				

        </div>            

        <div class="payment_btn">

        	<input type="submit" class="btn_save_bill" value="<?php if($this->lang->line('user_save') != '') { echo stripslashes($this->lang->line('user_save')); } else echo 'Save'; ?>" onclick="return shop_payment_validation();"/>

        </div>

	</form>

</div>

</div>

</section>
</div>
<script type="text/javascript">
$('#shop_payment').validate();
</script>
<script>
	$('#paypaladpt').change(function(){
		if($('#paypaladpt').is(':checked'))
		{
			$('#paypal_adap').css('display','block');
		}else{
			$('#merchantemail').val('');
			$('#paypal_adap').css('display','none');
		}
	});
</script>
<?php 
$this->load->view('site/templates/footer');
?>

