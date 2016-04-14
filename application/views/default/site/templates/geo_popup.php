<div class="regional-setting" style="display:block;">
<div class="main" id="content_geo">
<div style="text-align:left" class="regional-setting-left">
<h5><?php if($this->lang->line('land_regionalsettings') != '') { echo stripslashes($this->lang->line('land_regionalsettings')); } else echo "Hi! We'd like to set these regional settings for you"; ?>.</h5>
<h3><?php echo "English (".$GeoCountryCode."), ".$dcurrencySymbol." ".$GeoCurrencyArr->row()->currency_name." ".$dcurrencyType.", ". $GeoCountryArr->row()->name; ?> </h3>
</div>

<div class="regional-setting-right">
<input class="ok-button"  onclick="getAll(2);" value="<?php if($this->lang->line('land_okay') != '') { echo stripslashes($this->lang->line('land_okay')); } else echo "okay"; ?>" type="button">
<input class="canceling-button3" onClick="getAll(1);" value="<?php if($this->lang->line('land_nothanks') != '') { echo stripslashes($this->lang->line('land_nothanks')); } else echo "No thanks"; ?>" type="button">
</div>
</div>
</div>
<script type="text/javascript">
function getAll(val)
{
$.ajax({type:'post',
		url	: baseURL+'site/landing/change_geo_lang',
		data: {"lang_opt":val,},
		dataType: 'html',			
		success: function(response){
			//window.location.reload();
			$("#content_geo").html("<h3>Your Settings have been Saved Successfully</h3>");
			//$(".regional-setting").css("display","none");

			setTimeout(function() {
			    $('.regional-setting').fadeOut('fast');
			}, 1000); 
			
		}
	});
}
</script>